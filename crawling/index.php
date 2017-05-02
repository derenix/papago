<?php
error_reporting(E_ALL);

include_once('config/config.php');
include_once('demo/_demo.php');
include_once('inc/DB.php');
include_once('inc/Environment.php');
include_once('inc/ClassLoader.php');

$env = new Environment();
$database = new DB();


// ===============================================
// Load Operators
// ===============================================
$database->query('SELECT * FROM operators WHERE blacklist = :blacklist');
$database->bind(':blacklist', '0');

$operators = $database->resultset();



// ===============================================
// Load Class if Exist
// ===============================================
foreach ($operators as $operator) {
	$fileName = 'operators/' . $operator['class'] . '.php';

	if (file_exists($fileName)) {
		require_once $fileName;
		$class = new $operator['class'];
		$pages = array();


		// Get Pages per Operator
		// ==========================================
		if($env->isLocal()){
			$pages[0] = $demo_pages[$operator['operator_name']];
		}else{
			$database->query('SELECT * FROM pages WHERE operator_id = :operator_id');
			$database->bind(':operator_id', $operator['id']);

			$pages = $database->resultset();
		}

		// Execute Compiling
		foreach ($pages as $page) {
			$class->init($page);
		}
	}
}