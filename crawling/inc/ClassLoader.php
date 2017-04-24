<?php
spl_autoload_register(function ($className) {
	$folder = 'operators/';
	if (file_exists($folder . $className . '.php')) {
		require_once $folder . $className . '.php';
		return true;
	}
	return false;
});