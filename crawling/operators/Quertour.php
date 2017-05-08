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
		$date = array();

		foreach ($trip->find('.reiseziele-list-info-wrappers a') as $date_item) {
			$date_detail = array(
				"date" => $date_item->plaintext,
				"url" => $date_item->href
			);
			array_push($date, $date_detail);
		}

		$status = "";
		if ($trip->find('.ausgebucht', 0)) {
			$status = $trip->find('.ausgebucht', 0)->plaintext;
		}

		return array(
			"title" => $trip->find('.reiseziele-list-headline', 0)->innertext,
			"description" => $trip->find('.reiseziele-list-name', 0)->innertext,
			"price" => $trip->find('.reiseziele-list-header-right b', 0)->innertext,
			"img" => $trip->find('.reiseziele-list-image')[0]->src,
			"date" => $date,
			"status" => $status
		);
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
			$database->bind(':operator_id', $page['id']);
			$database->bind(':title', $trip['title']);
			$database->bind(':excerpt', '');
			$database->bind(':description', $trip['description']);
			$database->bind(':image_teaser', '');
			$database->bind(':image_detail', $trip['img']);
			$database->bind(':price', $trip['price']);
			$database->bind(':price_additional', '');
			$database->bind(':url_detail', '');
			$database->bind(':url_booking', $trip['date'][0]['url']);
			$database->bind(':date_from', $trip['date'][0]['date']);
			$database->bind(':date_to', '');
			$database->bind(':booking_status', $trip['status']);
			$database->execute();

			array_push($trips_all, $trip);
		}

		$database->endTransaction();
		echo "DB Update for " . $page['url'] . " OK.";
	}

}