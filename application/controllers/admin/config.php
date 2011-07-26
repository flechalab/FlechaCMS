<?php
class Config extends CI_Controller {
	
    /**
     * html title default to config page
     * @var string
     */
	private $html_title = 'Manutenção de Configurações do Site';

    /**
     * Load libraries, models and templates
     */
	public function __construct() {
		parent::__construct();
        
        // TODO config options
        echo 'Developing'; die();
        
		$this->output->enable_profiler(TRUE);
		$this->load->model('ConfigModel');
		$this->load->library('Html');
		$this->html->setTemplateMode('adm');
	}

    /**
     * Index function carrega lista das paginas atuais do site
     */
	public function index() {

        $data               = array();
		$data['title']      = 'Lista de Configurações do Site';
		$data['subtitle']   = '';
		$data['submenu']    = TRUE;
		$data['uri']        = ADMIN_URL_ADMIN;
		$config             = $this->ConfigModel->getConfig();

        var_dump($config); die();

		for ( $i=0; $i < count($pages); $i++ ) {
			$data['items'][$i]['id']      = $pages[$i]['id'];
			$data['items'][$i]['desc']    = (!empty($pages[$i]['title'])) ?
                                            $pages[$i]['title'] : $pages[$i]['page'];
			$data['items'][$i]['tooltip'] = 'Atualizado em: ' .
			                                $this->datefunctions->
											dateTimeFormated($pages[$i]['updated_at']);
		}


		
		$data['items'] = $this->ConfigModel->getConfig();
				
		$this->html->output('admin/list', $data);
	}
	
	
    /**
     * set/update site's configurations 
     */
    public function set() {
				
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
				
		if($this->form_validation->run()==FALSE) {
			
			// carrega valores do registro 
			$config = $this->ConfigModel->getConfig($data['config']);
			$data   = $config[0];

			// carrega formulario 
			$template = 'admin/config_form';
			
			$this->html->output($template, $data);
		}
		else {		
            try {
        		// preparando data (com post)
    			$data = array_merge($data, $_POST);
                $this->ConfigModel->setConfig($data);
				$view['message']  = 'Configurações foram salvas.';
				$view['url']      = '/admin/config';
                $template = 'admin/message';
    			$this->html->output($template, $view);
            }
            catch ( Exception $e ) {
                show_error($e->getMessage());
            }
		}
	}


	public function del($id) {
		//$this->SiteModel->deleteUser($id);
		$data['message']   = 'Configurações do Site não podem ser Excluidas!';
		$data['url']       = '/admin/users';
		$this->html->output('admin/message', $data);
	}
	

    /**
     * check if user/name is correct
     * @param  string  $value
     * @return boolean 
     */
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

