<?php
namespace models;
use Model;
class Contact extends Model{
	public static function get($user_id){
		$pdo = parent::getPDO();
		$sql = "SELECT * FROM contacts ORDER BY name";
		if ($user_id) $sql = "
			SELECT
				c.*,
				IF(f.user_id, 1, 0) AS favorite
			FROM
				contacts c
			LEFT JOIN
				favorite f ON f.contact_id = c.id AND f.user_id = :user_id
			";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		try{
			$stmt->execute();
		} catch(\PDOException $e){
			print_r($e->errorInfo);
		}
		return parent::getArray($stmt);
	}
}