<?php
class ControllerPages extends Controller{
	function __construct(){
		$this->view = new View();
	}
	public function actionIndex(){
		$pages = models\Page::getPages();
		$this->view->generate('pages.tpl', 'main.tpl', ['pages' => $pages]);
	}
	public function actionPage(){
		$page = models\Page::getPage($_GET['id']);
		$this->view->generate('page.tpl', 'main.tpl', ['page' => $page[0]]);
	}
}
