<?php

class Crawling {

	/**
	 * Download Page by cURL
	 *
	 * @param $url
	 * @return mixed
	 */
	public function get_page_by_curl($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}


	/**
	 * Echo Trips or continue saving
	 *
	 * @param $page
	 * @param $trips
	 * @param $db_update
	 */
	public function success($page, $trips, $db_update){
		if(!$db_update){
			echo "<pre>";
			print_r($trips);
			echo "</pre>";
		}else{
			$this->saveDB($page, $trips);
		}
	}


	/**
	 * Save Trips in Database
	 *
	 * @param $page
	 * @param $trips
	 */
	public function saveDB($page, $trips) {
		$database = new DB();
		$database->beginTransaction();
		$database->query('INSERT INTO trips (
			 operator_id, 
			 title,
			 excerpt,
			 description,
			 category,
			 saison,
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
			 :category,
			 :saison,
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

		foreach ($trips as $singleTrip) {
			$database->bind(':operator_id', $page['operator_id']);
			$database->bind(':title', $singleTrip['title']);
			$database->bind(':excerpt', $singleTrip['excerpt']);
			$database->bind(':description', $singleTrip['description']);
			$database->bind(':category', $singleTrip['category']);
			$database->bind(':saison', $singleTrip['saison']);
			$database->bind(':image_teaser', $singleTrip['img']);
			$database->bind(':image_detail', '');
			$database->bind(':price', $singleTrip['price']['price']);
			$database->bind(':price_additional', $singleTrip['price']['price_additional']);
			$database->bind(':url_detail', '');
			$database->bind(':url_booking', $singleTrip['url']);
			$database->bind(':date_from', $singleTrip['date'][0]);
			$database->bind(':date_to', $singleTrip['date'][1]);
			$database->bind(':booking_status', $singleTrip['status']);
			$database->execute();
		}

		$database->endTransaction();
		echo "DB Update for " . $page['url'] . " OK.";
	}
}