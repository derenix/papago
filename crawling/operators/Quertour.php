<?php
include_once('inc/simplehtmldom_1_5/simple_html_dom.php');


class Quertour{

	public function init($page, $db_update){
		$crawling = new Crawling();

		$data = $crawling->get_page_by_curl($page['url']);
		$html = str_get_html($data);
		$trips = $this->findTrips($html);

		$crawling->success($page, $trips, $db_update);
	}


	/**
	 * Find All Trips On Given Page
	 *
	 * @param $pages
	 * @return array
	 */
	private function findTrips($html){
		$trips = array();

		// search for every "saison" (eg Frühling, Sommer)
		// -----------------------------------------------
		foreach ($html->find('.reiseziele-list-saison') as $saison) {
			$global_trip_data = array(
				"saison" => $saison->find('.reiseziele-list-saison-header', 0)->plaintext
			);


			// search for every "category" (eg Flugreise, city-tours)
			// -----------------------------------------------
			foreach ($saison->find('.reiseziele-list-reise') as $category) {
				$global_trip_data["category"] = trim($category->find('.reiseziele-list-reise-header img', 0)->alt);


				// search for every "tripCollection" (eg diff trips-dates for one trip)
				// -----------------------------------------------
				foreach ($category->find('.reiseziele-list') as $tripCollection) {

					$singleTrip = array(
						"title" => $tripCollection->find('.reiseziele-list-headline', 0)->innertext,
						"excerpt" => $tripCollection->find('.reiseziele-list-name', 0)->innertext,
						"img" => $tripCollection->find('.reiseziele-list-image')[0]->src,
						"category" => $global_trip_data['category'],
						"saison" => $global_trip_data['saison'],
						"price" => $this->formatPrice($tripCollection->find('.reiseziele-list-header-right b', 0)->innertext)
					);


					// search for every "dates" in trip
					// -----------------------------------------------
					foreach ($tripCollection->find('.reiseziele-list-info-wrappers a') as $date_item) {
						$singleTrip["date"] = $this->formatDate($date_item->plaintext);
						$singleTrip["url"] = $date_item->href;
						$singleTrip["status"] = trim($date_item->find('.rt-link-status', 0)->plaintext);

						array_push($trips, $singleTrip);
					}
				}
			}
		}

		return $trips;
	}




	// ===========================================================================
	// Helper
	// ===========================================================================

	/**
	 * format Date (from/to)
	 *
	 * @param $string
	 * @return array
	 */
	private function formatDate($string){
		$dateStrings = explode("bis", $string);
		$date = array();

		foreach ($dateStrings as $dateString){
			$pos = strpos($dateString, ".201");
			$dateItem = explode(".", substr($dateString, ($pos - 6), 11));

			$dateFinal = trim($dateItem[2]) .'-'. trim($dateItem[1]) .'-'. trim($dateItem[0]);
			array_push($date, $dateFinal);
		}

		return $date;
	}


	/**
	 * format Price (addition/price)
	 *
	 * @param $string
	 * @return array
	 */
	private function formatPrice($string){
		$priceString = explode(" ", $string);

		return array(
			"price_additional" => (preg_match("/[a-zA-Z]/", $priceString[0]) ? $priceString[0] : ""),
			"price" => (preg_match("/[0-9.-]/", $priceString[1]) ? $priceString[1] : $priceString[1])
		);
	}

}