<?php
error_reporting(E_ALL);

include_once('config/config.php');
include_once('inc/DB.php');
include_once('inc/Crawling.php');
include_once('inc/Environment.php');
include_once('inc/ClassLoader.php');

$db_update = false;
if( isset($_GET["db"]) ){ $db_update = true; }

$database = new DB();
$database->query('SELECT * FROM operators WHERE blacklist = :blacklist');

if( isset($_GET["o"]) ){
	$database->query('SELECT * FROM operators WHERE blacklist = :blacklist AND operator_name = :operator_name');
	$database->bind(':operator_name', $_GET["o"]);
}

$database->bind(':blacklist', '0');
$operators = $database->resultset();

$onlyThisOperator = null;

if($argc > 1) {
	for($i=1; $i < $argc; $i++) {
		$switch = $argv[$i];

		switch($switch) {
			case "--operator":
			case "-o":
				$onlyThisOperator = $argv[++$i];
				break;
			case "--db-update":
				$db_update = true;
				break;
		}
	}
}

// ===============================================
// Load Class if Exist
// ===============================================
foreach ($operators as $operator) {
	if(!is_null($onlyThisOperator) && $operator["operator_name"] !== $onlyThisOperator) {
		continue;
	}

	$fileName = 'operators/' . $operator['class'] . '.php';

	if (file_exists($fileName)) {
		require_once $fileName;
		$class = new $operator['class'];
		$pages = array();


		// Get Pages per Operator
		// ==========================================
		$database->query('SELECT * FROM pages WHERE operator_id = :operator_id');
		$database->bind(':operator_id', $operator['id']);
		$pages = $database->resultset();

		// Start Crawling
		foreach ($pages as $page) {
			$class->init($page, $db_update);
		}
	}
}