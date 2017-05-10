<?php
include_once('inc/simplehtmldom_1_5/simple_html_dom.php');


class Test{

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

		// ...

		return $trips;
	}




	// ===========================================================================
	// Helper
	// ===========================================================================

	// ...

}