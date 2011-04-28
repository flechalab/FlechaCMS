
<?php

class Admin extends CI_Controller {
	
    private $url = '/admin';

	public function __construct() {
		parent::__construct();
		$this->load->model('SiteModel');
		$this->load->library('Html');
		$this->html->setTemplateMode('adm');
	}
	
	public function index() {

		$this->login();

        $html = array();
		$html['title']     =  'Manutenção Geral do Site';
		$html['subtitle']  =  'Escolha uma das opções abaixo:';
		$html['submenu']   =  FALSE;
        $html['uri']       =  $this->url;
		$html['items']     =  array( array('id'      => 'pages',
			                               'desc'    => 'Páginas',
										   'tooltip' => 'Manutenção de Páginas'),
                                     array('id'      => 'users',
			                               'desc'    => 'Usuários',
										   'tooltip' => 'Manutenção de Usuários'),
                                     array('id'      => 'config',
			                               'desc'    => 'Configurações',
								   		   'tooltip' => 'Configurações do Site') );

		$this->html->output('admin/list', $html);
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
