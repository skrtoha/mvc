<?php
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
require_once('application/bootstrap.php');
