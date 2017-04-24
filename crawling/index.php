<?php
error_reporting(E_ALL);

//include_once('inc/ClassLoader.php');
include_once('config/config.php');

$result = tour_operators();

echo "<pre>";
var_dump( $result[0]["class"]->test() );
echo "</pre>";