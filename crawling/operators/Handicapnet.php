<?php
include_once('inc/simplehtmldom_1_5/simple_html_dom.php');


class Handicapnet {

	public function init($page, $db_update) {
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
	private function findTrips($html) {
		$trips = array();

		foreach ($html->find('.reiselistsub') as $trip) {

			$singleTrip = array("title" => trim($trip->find('b', 0)->plaintext), "excerpt" => trim($trip->find('a img')[0]->alt), "description" => trim($trip->find('span', 0)->plaintext), "img" => $trip->find('a img')[0]->src, "category" => "", "saison" => "", "price" => $this->formatPrice($trip->find('font b', 0)->plaintext), "booking_url" => $trip->find('a', 0)->href);

			array_push($trips, $singleTrip);
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
	private function formatDate($string) {
		$dateStrings = explode("bis", $string);
		$date = array();

		foreach ($dateStrings as $dateString) {
			$pos = strpos($dateString, ".201");
			$dateItem = explode(".", substr($dateString, ($pos - 6), 11));

			$dateFinal = trim($dateItem[2]) . '-' . trim($dateItem[1]) . '-' . trim($dateItem[0]);
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
	private function formatPrice($string) {
		$priceString = trim(str_replace("&nbsp;", "", $string));
		$priceString = explode(" ", $priceString);
		$price = array(
			"price_additional" => (preg_match("/[a-zA-Z]/", $priceString[0]) ? $priceString[0] : "")
		);

		foreach ($priceString as $item) {
			if(preg_match("/[0-9.-]/", $item)){
				$item = str_replace(",-", "", $item);
				$price['price'] = $item;
			}
		}

		return $price;
	}

}