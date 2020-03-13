<?php
class Model{
	protected static function getPDO(){
		$dsn = "mysql:host=localhost;port=3306;dbname=test;charset=utf8";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		];
		try {
			return new \PDO($dsn, 'root', '', $options);
		} catch (PDOException $e) {
			die('Подключение не удалось: ' . $e->getMessage());
		}
	}
	protected static function getArray($stmt){
		$output = [];
		foreach($stmt as $value) $output[] = $value;
		return $output;
	}
}
