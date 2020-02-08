<?php
namespace models;
use Model;
class Page extends Model{
	public static function getPages(){
		$pdo = parent::getPDO();
		$stmt = $pdo->prepare("SELECT * FROM pages");
		$stmt->execute();
		$output = array();
		foreach($stmt as $row) $output[] = $row;
		return $output;
	}
	public static function getPage($id){
		$pdo = parent::getPDO();
		$stmt = $pdo->prepare("SELECT * FROM pages WHERE id=:id");
		$stmt->execute([':id' => $id]);
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}