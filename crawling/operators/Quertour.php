<?php
include_once('inc/simplehtmldom_1_5/simple_html_dom.php');


class Quertour{

	/**
	 * Find All Trips On Given Page
	 *
	 * @param $pages
	 * @return array
	 */
	private function findTrips($pages){
		$context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
		$trips_all = array();

		// crawl per page
		foreach ($pages as $page){
			$response = file_get_contents($page, false, $context);
			$html = str_get_html($response);

			$trips_per_page = array();
			foreach ($html->find('.reiseziele-list') as $element) {
				$trip = $this->getSingleTrip($element);
				array_push($trips_per_page, $trip);
			}

			// TODO: insert in DB per Page !
			array_push($trips_all, $trips_per_page);
		}

		// TODO: remove later
		return $trips_all;
	}


	/**
	 * Get Data from Single Trip
	 *
	 * @param $trip
	 * @return array
	 */
	private function getSingleTrip($trip){
		$reiseanbieter = "http://quertour.de/";
		$date = array();

		foreach ($trip->find('.reiseziele-list-info-wrappers a') as $date_item) {
			$date_detail = array(
				"date" => $date_item->plaintext,
				"url" => $reiseanbieter . $date_item->href
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


	/**
	 * Compile with Test Cases
	 *
	 * @return array
	 */
	public function test(){
		$test_pages = ['demo/quertour.html'];

		return $this->findTrips($test_pages);
	}
}