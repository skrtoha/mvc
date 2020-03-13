<?php
namespace models;
use Model;
class User extends Model{
	/**
	 * [insert description]
	 * @param  [type] $fields [description]
	 * @return [type]         [description]
	 */
	public static function insert($fields){
		$pdo = parent::getPDO();
		$stmt = $pdo->prepare("INSERT INTO user(name, password) VALUES (:name, :password)");
		$stmt->bindValue('name', $fields['name']);
		$stmt->bindValue('password', md5($fields['password']));
		try {
			$stmt->execute();
		} catch (\PDOException $e) {
			return $e->errorInfo[2];
		}
		$last_id = $pdo->lastInsertId();
		return $last_id;
	}

	public static function get($params = []){
		$pdo = parent::getPDO();
		$where = '';
		if ($params['user_id']) $where .= " id = :user_id AND ";
		if (isset($params['name']) && isset($params['password'])){
			$where .= "name = '{$params['name']}' AND ";
			$where .= "password = '".md5($params['password'])."' AND ";
		}
		if ($where){
			$where = substr($where, 0, -4);
			$where = "WHERE $where";
		} 
		$stmt = $pdo->prepare("SELECT * FROM user $where");
		if (isset($params['name'])) $stmt->bindValue(':name', $params['name']);
		if (isset($params['password'])) $stmt->bindValue(':password', md5($params['password']));
		if (isset($params['user_id'])) $stmt->bindValue(':user_id', $params['user_id']);
		try {
			$stmt->execute();
		} catch (\PDOException $e) {
			echo $e->errorInfo;
		}
		return parent::getArray($stmt);
	}

	public static function addFavorite($fields, $isAdd = true){
		$pdo = parent::getPDO();
		if($isAdd) $stmt = $pdo->prepare("INSERT INTO favorite(user_id, contact_id) VALUES (:user_id, :contact_id)");
		else $stmt = $pdo->prepare("DELETE FROM favorite WHERE user_id = :user_id AND contact_id = :contact_id");
		$stmt->execute($fields);
		return true;
	}

	public static function getFavorites($user_id){
		$pdo = parent::getPDO();
		$stmt = $pdo->prepare("
			SELECT
				f.user_id,
				c.name
			FROM
				favorite f
			LEFT JOIN 
				contacts c ON c.id = f.contact_id
			WHERE
				f.user_id = :user_id
		");
		$stmt->execute(['user_id' => $user_id]);
		return parent::getArray($stmt);
	}
}