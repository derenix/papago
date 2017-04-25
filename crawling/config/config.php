<?php

$folder = "operators/";
require_once $folder . 'Quertour.php';

/**
 * Tour Operators
 *
 */
function tour_operators(){
	return [
		[
			"name" => "quertour",
			"url" => ["http://www.quertour.de/"],
			"class" => new Quertour(),
			"type" => "html"
		]
	];
}

;
