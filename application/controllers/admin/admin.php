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

		$this->login();

		$data['title']    = 'Manutenção do Site';
		$data['subtitle'] = 'Escolha uma das opções abaixo:';
		$data['uri']      = '';
		$data['items']    = array( array('id'      => 'pages',
			                             'desc'    => 'Páginas',
										 'tooltip' => 'Manutenção de Páginas'),
                                   array('id'      => 'users',
			                             'desc'    => 'Usuários',
										 'tooltip' => 'Manutenção de Usuários'),
                                   array('id'      => 'confifg',
			                             'desc'    => 'Configurações',
										 'tooltip' => 'Configurações do Site') );

		$this->html->output('admin/list', $data);

	}
	
	public function login() {
		
	}
	
	public function logon($user, $pass) {
		$user = $this->UserModel->getUser($user);
		
		if($user==true) {
			$_SESSION['user'] = $user;
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
