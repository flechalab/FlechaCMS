<?php

class Admin extends CI_Controller {
	
    private $form;

	public function __construct() {
		parent::__construct();
        // html template constructor
		$this->load->library('Html');
        // model layer
        $this->load->model('SiteModel');
        $this->load->model('UserModel');
		$this->html->setTemplateMode('adm');
        // login validation
        $this->load->library('session');
        $this->load->library('CheckLogin');
	}
	
	public function index() {

        // login validation
        $this->checklogin->check();
        
        $html = array();
		$html['title']     =  'Manutenção Geral do Site';
		$html['subtitle']  =  'Escolha uma das opções abaixo:';
		$html['submenu']   =  FALSE;
        $html['uri']       =  ADMIN_URL_ADMIN;
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
/*
        $this->load->library('form_validation'); // ci  lib
        $this->load->library('ExtraValidation'); // ext lib
        $this->load->library('NormalizeChar');   // ext lib
*/
        // setting array with form data
        $this->form();

        /*
        // set das regras de validacao
		foreach($this->form as $key => $item) {
			$this->form_validation->set_rules($key, $item['title'], $item['validation']);
		}

        $this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
        */
        // carrega formulario
        $template = array( 'admin/form' );

        $data = array();
		$data['title']      = 'Login da Area de Manutencao do Site';
		$data['subtitle']   = '';
		$data['submenu']    = TRUE;
        $data['uri']        = ADMIN_URL_ADMIN;
        $data['form_url']   = ADMIN_URL_ADMIN . '/logon';
        $data['form_label'] = 'Digite seu Usuario/Senha:';
        $data['form']       = $this->form;

        $this->html->output($template, $data);
	}

	public function logon() {

        $this->form();
        
        if(!isset($_POST)) {
            header('Location: /admin/login');
        }
        
        $vars = $_POST;
        
		if( $this->form_validation->run() == FALSE ) {
            header('Location: /admin/login');
		}
        else {

            $user = $this->UserModel->getUser($_POST['user'], 'user');

            if( ($user==true) && (count($user)==1) && ($user[0]['pass']==md5($_POST['pass'])) ) {
                $this->session->set_userdata('adm_uid', $user[0]['user']);
                $this->session->set_userdata('adm_uname', $user[0]['name']);
                header('Location: /admin');
            }
        }
	}
	
	public function logout() {
        $this->session->sess_destroy();
		header('Location: /');
	}

    public function form() {

        $this->form = array( 'user' => array( 'title'     => 'Usuário',
                                              'validation'=> 'required|min_length[3]|max_length[50]',
                                              'type'      => 'input',
                                              'value'     => ''),

                             'pass' => array( 'title'     => 'Senha',
                                              'validation'=> 'required|min_length[3]|max_length[50]',
                                              'type'      => 'password',
                                              'value'     => '')
                           );
     
		$this->load->library('form_validation'); // ci  lib
        $this->load->library('ExtraValidation'); // ext lib
        $this->load->library('NormalizeChar');   // ext lib

        // set das regras de validacao
		foreach($this->form as $key => $item) {
			$this->form_validation->set_rules($key, $item['title'], $item['validation']);
		}

        $this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
        
    }
        
}
