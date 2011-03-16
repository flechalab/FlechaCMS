<?php
class Divs extends Controller {
	
	public function __construct() {
		parent::Controller();
		//$this->output->enable_profiler(TRUE);
		$this->load->model('SiteModel');
		$this->load->library('Html');
		$this->load->library('dateFunctions');
		$this->html->setTemplateMode('adm');
	}
	
	
	/*
	 * Index function carrega lista das paginas atuais do site
	 */
	function index() {
	
		$page_id = $this->uri->segment(4);
		
		$page = $this->SiteModel->getPageByID($page_id);

		$data['title']   = '> Lista de Divs da Página ' . $page['page'] . ' (' . $page['title'] . ')';
		$data['page_id'] = $page_id;
		$data['items']   = $this->SiteModel->getDivs($page_id);

		for ( $i=0; $i < count($data['items']); $i++ ) {
			$data['items'][$i]['updated_at'] = $this->datefunctions->dateTimeFormated($data['items'][$i]['updated_at']);
		}
		
		$this->html->output('admin/divs_list', $data);
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
		$this->form_validation->set_rules('div_id', 'ID Div', 'required|alpha_numeric|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('div_type', 'Tipo', 'required');
		$this->form_validation->set_rules('div_title', 'Titulo', 'min_length[3]|max_length[200]');
		$this->form_validation->set_rules('div_content', 'Conteudo', '');

		// preparando data
		$data       = array('id'=>'', 'id_page'=>'', 
		                    'div_id'=>'', 'div_type'=>'', 
		                    'div_title'=>'', 'div_content'=>'');
		
		$data['id']      = $this->uri->segment(6);
		$data['id_page'] = $this->uri->segment(4);	
		
		//***********************************************************
		// carregando formulario (sem post) - opcao de novo ou edicao
		//***********************************************************
		
		if($this->form_validation->run()==FALSE) {

			// se id for numerico (=edicao), carrega valores do registro 
			if( is_numeric($data['id']) ) {
				$data = $this->SiteModel->getDivByID($data['id']);
			}

			$page = $this->SiteModel->getPageByID($data['id_page']);
			$data['title']   = '> Manutenção da Div da Página ' . $page['page'] . ' (' . $page['title'] . ')';
			
			// carrega formulario 
			$template = 'admin/divs_form';

			// setando script do tinymce
			$this->html->set_tinymce();
			
			$this->html->output($template, $data);
		}
		
		//***********************************************************
		// ao enviar formulario (post) processa gravacao de dados
		//***********************************************************
		else {
			
			// preparando data (com post)
			$data = array_merge($data, $_POST);
			
			$data['div_id']       = strtolower($data['div_id']);
			
			$result = $this->SiteModel->setDiv($data);
			
			if($result===TRUE) {
				// mensagem de dados gravados com sucesso
				$view['message'] = 'Dados da Div salvos com sucesso';
				$view['url']      = "/admin/pages/{$data['id_page']}/divs";
			}
			else {
				// messagem q pagina ja existe
				$view['message'] = 'Div já existe no Página. Utilize um outro ID';
				$view['url']      = 'Javascript:history.back();';
			}	
			
			$template = 'admin/message';

			$this->html->output($template, $view);
		}
		
	}
	
	public function del($id, $id_page) {
		$this->SiteModel->deleteDiv($id);
		$data['message']   = 'Div excluida da Página!';
		$data['url']       = "/admin/pages/{$id_page}/divs";
		$this->html->output('admin/message', $data);
	}
}