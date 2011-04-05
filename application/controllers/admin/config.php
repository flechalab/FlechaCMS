<?php
class Config extends Controller {
	
	private $html_title = 'Manutenção de Configurações do Site';

	public function __construct() {
		parent::Controller();
		//$this->output->enable_profiler(TRUE);
		$this->load->model('ConfigModel');
		$this->load->library('Html');
		$this->html->setTemplateMode('adm');
	}


	/*
	 * Index function carrega lista das paginas atuais do site
	 */
	public function index() {
		$data['title'] = '> Lista de Configurações do Site';
		$data['items'] = $this->ConfigModel->getConfig();
				
		$this->html->output('admin/config_list', $data);
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
		$this->form_validation->set_rules('config', 'Configuração',   'trim|required|alpha_numeric|min_length[3]|max_length[100]|strtolower|xss_clean');
		$this->form_validation->set_rules('value', 'Valor',    'trim|required|min_length[1]|max_length[100]');
		
		// preparando data
		$data       = array('id'=>'', 'config'=>'', 'value'=>'');
		$data['id'] = $this->uri->segment(4);
		
		
		//***********************************************************
		// carregando formulario (sem post) - opcao de novo ou edicao
		//***********************************************************
		
		if($this->form_validation->run()==FALSE) {
			
			// carrega valores do registro 
			$config = $this->ConfigModel->getConfig($data['config']);
			$data   = $config[0];

			// carrega formulario 
			$template = 'admin/config_form';
			
			$this->html->output($template, $data);
		}
		
		//***********************************************************
		// ao enviar formulario (post) processa gravacao de dados
		//***********************************************************
		else {
			
			// preparando data (com post)
			$data = array_merge($data, $_POST);
						
			$result = $this->ConfigModel->setConfig($data);
			
			if($result===TRUE) {
				$view['message']  = 'Configurações foram salvas.';
				$view['url']      = '/admin/config';
			}
			else {
				// messagem q pagina ja existe
				$view['message']  = 'Erro ao Salvar as Configurações do Site';
				$view['url']      = 'Javascript:history.back();';
			}	
			
			$template = 'admin/message';

			$this->html->output($template, $view);
		}
		
	}


	public function del($id) {
		//$this->SiteModel->deleteUser($id);
		$data['message']   = 'Configurações do Site não podem ser Excluidas!';
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

