<?php
session_start();
spl_autoload_register(function($class){
	$class = str_replace('\\', '/', $class);
	$loading = [
		'models'
	];
	foreach($loading as $value){
		if (preg_match("/^$value/", $class)) include $_SERVER['DOCUMENT_ROOT'].'/application/'.$class.'.php';
	}
});

ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors', 1);
require_once('application/bootstrap.php');
