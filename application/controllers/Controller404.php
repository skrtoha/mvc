<?php
class Controller404 extends Controller{
	function __construct(){
		$this->view = new View();
	}

	function actionIndex(){
		$this->view->generate('404.tpl', 'main.tpl');
	}
}
