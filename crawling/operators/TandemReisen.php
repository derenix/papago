<?php
include_once('inc/simplehtmldom_1_5/simple_html_dom.php');

class TandemReisen {

	private $page;
	private $crawler;

	public function init($page, $db_update){
		$this->crawler = new Crawling();
		$this->page = $page;

		$data = $this->crawler->get_page_by_curl($page['url']);
		$html = str_get_html($data);
		$trips = $this->findTrips($html);

		$this->crawler->success($page, $trips, $db_update);
	}

	/**
	 * Find All Trips On Given Page
	 *
	 * @param $pages
	 * @return array
	 */
	private function findTrips($html){
		$trips = array();

		foreach ($html->find('#d_content_inner table tr') as $tripLine) {
			$cells = $tripLine->find("td");
			
			$categoriesTd = $cells[0];
			$tripDataTd = $cells[1];
			$internalNumberTd = $cells[2];
			$statusTd = $cells[3];

			$bookingUrl = $this->page["url"] . html_entity_decode($tripDataTd->find("span.fat a")[0]->href);
			$dateFromData = explode(" - ", $tripDataTd->find("a")[0]->text());

			$categories = [];
			foreach($categoriesTd->find("img") as $cat) {
				$categories[] = $cat->title;
			}

			$statusImg = $statusTd->find("img")[0];
			$bookingStatus = "";

			switch($statusImg->title) {
				case '_wenige-frei':
					$bookingStatus = "Wenige frei";
				break;
				case '_viele-frei':
					$bookingStatus = "Offen";
				break;
				case '_ausgebucht':
					$bookingStatus = "Ausgebucht";
				break;
				default:
					echo("[-] Unknown status: " . $statusImg->title . "\n");
			}

			$trips[] = [
				"title" => $tripDataTd->find("span.fat a")[0]->text(),
				"excerpt" => "",
				"description" => "",
				"saison" => "",
				"img" => "",
				"date" => $dateFromData,
				"category" => implode(", ", $categories),
				"url" => $bookingUrl,
				"status" => $bookingStatus,
				"price" => [
					"price" => $this->fetchPrice($bookingUrl),
					"price_additional" => ""
				]
			];
		}

		return $trips;
	}


	// ===========================================================================
	// Helper
	// ===========================================================================

	private function fetchPrice($url) {
		//echo "[*] Fetching " . $url . "\n";
		$data = $this->crawler->get_page_by_curl($url);
		$html = str_get_html($data);

		$fullPriceText = $html->find('img[src="img/icons/preise.gif"]')[0]->next_sibling()->plaintext;

		$lines = explode("\n", $fullPriceText);
		$price = explode(": ", trim($lines[0]))[1];

		return "Ab " . substr($price, 2) . " €";
	}

}