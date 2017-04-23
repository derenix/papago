<?php
error_reporting(E_ALL);

include_once('inc/simplehtmldom_1_5/simple_html_dom.php');

$url = 'demo/quertour.html';
$context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
$response = file_get_contents($url, false, $context);
$html = str_get_html($response);

$quertour_reisen = array();

foreach($html->find('.reiseziele-list') as $element) {

	$date = array();
	foreach ($element->find('.reiseziele-list-info-wrappers a') as $date_item) {
		$date_detail = array(
			"date" => $date_item->plaintext,
			"url" => $reiseanbieter . $date_item->href
		);
		array_push($date, $date_detail);
	}

	$status = "";
	if($element->find('.ausgebucht', 0)){
		$status = $element->find('.ausgebucht', 0)->plaintext;
	}

	$reise = array(
		"title" => $element->find('.reiseziele-list-headline', 0)->innertext,
		"description" => $element->find('.reiseziele-list-name', 0)->innertext,
		"price" => $element->find('.reiseziele-list-header-right b', 0)->innertext,
		"img" => $element->find('.reiseziele-list-image')[0]->src,
		"date" => $date,
		"status" => $status
	);

	array_push($quertour_reisen, $reise);
}

echo "<pre>";
var_dump($quertour_reisen);
echo "</pre>";