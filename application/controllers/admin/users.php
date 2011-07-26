<?php
class Users extends CI_Controller {
	
	private $html_title = 'Manutenção de Usuários da área administrativa do Site';

	public function __construct() {
		parent::__construct();
        
        //TODO - user management
        echo 'Developing'; die();
        
		$this->output->enable_profiler(TRUE);
		$this->load->model('UsersModel');
		$this->load->library('Html');
		$this->html->setTemplateMode('adm');
	}


	/*
	 * Index function carrega lista das paginas atuais do site
	 */
	public function index() {
		$data['title'] = '> Lista de Usuários do Site';
		$data['items'] = $this->UsersModel->getUser();
				
		$this->html->output('admin/users_list', $data);
	}
	
	
	/*
	 * funcao com tomada de decisao para inserir ou atualizar registro de pagina do site
	 */
	public function set() {
		
		//***********************************************************
		// preparando recurso do CI, validacoes, info de view e data
		//***********************************************************
		
		// helper -> form, url
		$this->load->helper(array('form','url'));

		// library -> form_validation
		$this->load->library('form_validation');

		// set das regras de validacao
		$this->form_validation->set_rules('user', 'Usuário',   'trim|required|alpha_numeric|min_length[3]|max_length[100]|strtolower|xss_clean');
		$this->form_validation->set_rules('pass', 'Password',  'trim|max_length[250]|md5');
		$this->form_validation->set_rules('name', 'Nome',      'trim|required|callback_check_name|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('phone', 'Telefone', 'trim|alpha_numeric|min_length[7]|max_length[100]');
		$this->form_validation->set_rules('mail', 'E-mail',    'trim|required|valid_email');
		$this->form_validation->set_rules('active', 'Ativo',   'trim|required|numeric|min_length[1]|max_length[1]');
		
		// preparando data
		$data       = array('id'=>'', 'id_company'=>'', 'user'=>'', 'pass'=>'', 'name'=>'', 'phone'=>'', 'mail'=>'', 'active'=>'');
		$data['id'] = $this->uri->segment(4);
		
		
		//***********************************************************
		// carregando formulario (sem post) - opcao de novo ou edicao
		//***********************************************************
		
		if($this->form_validation->run()==FALSE) {
			
			// se id for numerico (=edicao), carrega valores do registro 
			if( is_numeric($data['id']) ) {
				$user = $this->UsersModel->getUser($data['id']);
				$data = $user[0];
			}

			// carrega formulario 
			$template = 'admin/users_form';
			
			$this->html->output($template, $data);
		}
		
		//***********************************************************
		// ao enviar formulario (post) processa gravacao de dados
		//***********************************************************
		else {
			
			// preparando data (com post)
			$data = array_merge($data, $_POST);
			
			$data['id_company'] = COMPANY_ID;
			//$data['user']       = strtolower($data['user']);
			
			$result = $this->UsersModel->setUser($data);
			
			if($result===TRUE) {
				$view['message']  = 'Dados do Usuário salvos com sucesso';
				$view['url']      = '/admin/users';
			}
			else {
				// messagem q pagina ja existe
				$view['message']  = 'Usuário existente. Utilize um outro ID de Usuário';
				$view['url']      = 'Javascript:history.back();';
			}	
			
			$template = 'admin/message';

			$this->html->output($template, $view);
		}
		
	}
	
	public function del($id) {
		$this->SiteModel->deleteUser($id);
		$data['message']   = 'Usuário excluido do Site!';
		$data['url']       = '/admin/users';
		$this->html->output('admin/message', $data);
	}
	
	
	public function check_name($value) {

		$rule = '#^[a-zA-Z0-9 ]*$#i';

		if(preg_match($rule, $value)) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('Nome informado não é válido.');
			return FALSE;
		}
	}
	
}

