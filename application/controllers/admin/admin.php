<?php

class Admin extends Controller {
	
	private $html_title = 'Manutenção Geral do Site';

	public function __construct() {
		parent::Controller();
		$this->load->model('SiteModel');
		$this->load->library('Html');
		$this->html->setTemplateMode('adm');
	
	}
	
	public function index() {
		$data['title'] = '> Manutenção do Site';
		$data['items'] = array('pages' => 'Páginas',
		                       'users' => 'Usuários');
				
		$this->html->output('admin/admin', $data);

	}
	
	
	
	public function login() {
		
	}
	
	public function logon($user, $pass) {
		$user = $this->SiteModel->getUser($user);
		
		if($user==true) {
		
		}
		
		
	}
	
	public function logout() {
		unset($_SESSION);
		destroy($_SESSION);
		header('/');	
	}
	
	public function checkLogin() {
		if(!$_SESSION['user']) {
			header('/');
		}
	}
}
