<?php
class ControllerPage extends Controller{
	function __construct(){
		$this->view = new View();
	}
	public function actionIndex(){
		return $this->view->generate('authorization.tpl', 'main.tpl', [
			'pageTitle' => 'Авторизация пользователя'
		]);
	}
	public function actionRegistration(){
		if (!empty($_POST)){
			if(empty($_POST['name']) || empty($_POST['password'])){
				return $this->view->generate('authorization.tpl', 'main.tpl', [
					'message' => 'Пароль и имя пользователя должны быть заполнены!',
					'params' => $_POST
				]);
			}
			$result = models\User::insert($_POST);
			if (!is_numeric($result)) return $this->view->generate('authorization.tpl', 'main.tpl', [
				'message' => $result,
				'params' => $_POST
			]);
			else{
				$_SESSION['user_id'] = $result;
				return $this->redirect('/page/contacts');
			} 
		}
		return $this->view->generate('authorization.tpl', 'main.tpl', [
			'pageTitle' => 'Регистрация пользователя'
		]);
	}
	public function actionAuthorization(){
		if (!empty($_POST)){
			$user = models\User::get([
				'name' => $_POST['name'],
				'password' => $_POST['password']
			]);
			$user = $user[0];
			if (empty($user)){
				return $this->view->generate('authorization.tpl', 'main.tpl', [
					'message' => 'Неверный логин или пароль',
					'pageTitle' => 'Авторизация пользователя',
					'params' => $_POST
				]);
			}
			else{
				$_SESSION['user_id'] = $user['id'];
				return $this->redirect('/page/contacts');
			}
		}
		return $this->view->generate('authorization.tpl', 'main.tpl', [
			'pageTitle' => 'Авторизация пользователя',
		]);
	}
	public function actionContacts(){
		if (!$_SESSION['user_id']) return $this->redirect('/page/authorization');
		$user = models\User::get(['user_id' => $_SESSION['user_id']]);
		return $this->view->generate('contacts.tpl', 'main.tpl', [
			'pageTitle' => 'Контакты',
			'contacts' => models\Contact::get($_SESSION['user_id']),
			'user' => $user[0]
		]);
	}
	public function actionFavorite(){
		if (!$_SESSION['user_id']) return $this->redirect('page/authorization');
		if (isset($_GET['action'])){
			$params = [
				'user_id' => $_SESSION['user_id'],
				'contact_id' => $_GET['contact_id']
			];
			switch($_GET['action']){
				case 'add':
					models\User::addFavorite($params);
					break;
				case 'remove':
					models\User::addFavorite($params, false);
					break;
			}
			$this->redirect('/page/contacts');
		}
		return $this->view->generate('contacts.tpl', 'main.tpl', [
			'pageTitle' => 'Избранное',
			'contacts' => models\User::getFavorites($_SESSION['user_id']),
			'user' => models\User::get(['user_id' => $_SESSION['user_id']])
		]);
	}
	public function actionExit(){
		unset($_SESSION['user_id']);
		$this->redirect('/page/authorization');
	}
}
