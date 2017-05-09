<?php
include_once('inc/simplehtmldom_1_5/simple_html_dom.php');


class Quertour{

	public function init($page, $db_update){

		$trips_all = $this->findTrips($page);

		if(!$db_update){
			echo "<pre>";
			print_r($trips_all);
			echo "</pre>";
		}else{
			$this->handleData($page, $trips_all);
		}

	}


	private function handleData($page, $trips){
		$database = new DB();
		$database->beginTransaction();
		$database->query('INSERT INTO trips (
			 operator_id, 
			 title,
			 excerpt,
			 description,
			 image_teaser,
			 image_detail,
			 price, 
			 price_additional,
			 url_detail,
			 url_booking,
			 date_from,
			 date_to,
			 booking_status
			) VALUES (
			 :operator_id, 
			 :title,
			 :excerpt,
			 :description,
			 :image_teaser,
			 :image_detail,
			 :price, 
			 :price_additional,
			 :url_detail,
			 :url_booking,
			 :date_from,
			 :date_to,
			 :booking_status
			)');

		foreach ($trips as $trip) {
			foreach ($trip as $item) {
				$database->bind(':operator_id', $page['id']);
				$database->bind(':title', $item['title']);
				$database->bind(':excerpt', '');
				$database->bind(':description', $item['description']);
				$database->bind(':image_teaser', $item['img']);
				$database->bind(':image_detail', '');
				$database->bind(':price', $item['price']['price']);
				$database->bind(':price_additional', $item['price']['price_additional']);
				$database->bind(':url_detail', '');
				$database->bind(':url_booking', $item['url']);
				$database->bind(':date_from', $item['date'][0]);
				$database->bind(':date_to', $item['date'][1]);
				$database->bind(':booking_status', $item['status']);
				$database->execute();
			}
		}

		$database->endTransaction();
		echo "DB Update for " . $page['url'] . " OK.";
	}



	/**
	 * Find All Trips On Given Page
	 *
	 * @param $pages
	 * @return array
	 */
	private function findTrips($page){
		$context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
		$response = file_get_contents($page['url'], false, $context);
		$html = str_get_html($response);

		$trips_all = array();

		foreach ($html->find('.reiseziele-list') as $element) {
			$trip = $this->getSingleTrip($element);

			array_push($trips_all, $trip);
		}

		return $trips_all;
	}


	/**
	 * Get Data from Single Trip
	 *
	 * @param $trip
	 * @return array
	 */
	private function getSingleTrip($trip){
		$trips = array();

		$title = $trip->find('.reiseziele-list-headline', 0)->innertext;
		$description = $trip->find('.reiseziele-list-name', 0)->innertext;
		$price = $this->formatPrice($trip->find('.reiseziele-list-header-right b', 0)->innertext);
		$img = $trip->find('.reiseziele-list-image')[0]->src;

		foreach ($trip->find('.reiseziele-list-info-wrappers a') as $date_item) {
			$subTrip = array(
				"title" => $title,
				"description" => $description,
				"price" => $price,
				"img" => $img,
				"date" => $this->formatDate($date_item->plaintext),
				"url" => $date_item->href,
				"status" => $date_item->find('.rt-link-status', 0)->plaintext
			);

			array_push($trips, $subTrip);
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


	private function formatStatus($string){

	}

}