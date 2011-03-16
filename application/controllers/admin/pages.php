<?php
class Pages extends Controller {
	
	private $html_title = 'Manutenção das Páginas do Site';
	
	public function __construct() {
		parent::Controller();
		//$this->output->enable_profiler(TRUE);
		$this->load->model('SiteModel');
		$this->load->library('Html');
		$this->load->library('DateFunctions');
		$this->html->setTemplateMode('adm');
		//Admin::checkLogin();
	}
	
	
	/*
	 * Index function carrega lista das paginas atuais do site
	 */
	function index() {
		$data['title'] = '> Lista de Páginas do Site';
		$data['items'] = $this->SiteModel->getPage();
		
		for ( $i=0; $i < count($data['items']); $i++ ) {
			$data['items'][$i]['updated_at'] = $this->datefunctions->dateTimeFormated($data['items'][$i]['updated_at']);
		}
		
		$this->html->output('admin/pages_list', $data);
	}
	
	
	/*
	 * funcao com tomada de decisao para inserir ou atualizar registro de pagina do site
	 */
	function set() {
		
		//***********************************************************
		// preparando recurso do CI, validacoes, info de view e data
		//***********************************************************
		
		// helper -> form, url
		$this->load->helper(array('form','url'));

		// library -> form_validation
		$this->load->library('form_validation');

		// set das regras de validacao
		$this->form_validation->set_rules('page', 'ID Pagina', 'required|alpha_numeric|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('title', 'Titulo', 'min_length[3]|max_length[200]');
		$this->form_validation->set_rules('header', 'Header', 'max_length[250]');
		$this->form_validation->set_rules('tooltip', 'Tooltip', 'max_length[250]');
		
		// preparando data
		$data       = array('id'=>'', 'id_company'=>'', 'page'=>'', 'title'=>'', 'header'=>'', 'tooltip'=>'');
		$data['id'] = $this->uri->segment(4);
		
		
		//***********************************************************
		// carregando formulario (sem post) - opcao de novo ou edicao
		//***********************************************************
		
		if($this->form_validation->run()==FALSE) {
			
			// se id for numerico (=edicao), carrega valores do registro 
			if( is_numeric($data['id']) ) {
				$data = $this->SiteModel->getPageByID($data['id']);
			}

			// carrega formulario 
			$template = 'admin/pages_form';
			
			$this->html->output($template, $data);
		}
		
		//***********************************************************
		// ao enviar formulario (post) processa gravacao de dados
		//***********************************************************
		else {
			
			// preparando data (com post)
			$data = array_merge($data, $_POST);
			
			$data['id_company'] = COMPANY_ID;
			$data['page']       = strtolower($data['page']);
			
			$result = $this->SiteModel->setPage($data);
			
			if($result===TRUE) {
				$view['message']  = 'Dados da Página salvos com sucesso';
				$view['url']      = '/admin/pages';
			}
			else {
				// messagem q pagina ja existe
				$view['message']  = 'Página já existe no Site. Utilize um outro ID';
				$view['url']      = 'Javascript:history.back();';
			}	
			
			$template = 'admin/message';

			$this->html->output($template, $view);
		}
		
	}
	
	public function del($id) {
		$this->SiteModel->deletePage($id);
		$data['message']   = 'Página excluida do Site!';
		$data['url']       = '/admin/pages';
		$this->html->output('admin/message', $data);
	}

}