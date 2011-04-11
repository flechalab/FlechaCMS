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
		$data             = array();
		$data['title']    = 'Lista de Páginas do Site';
		$data['subtitle'] = 'Clique sobre a página deseja para editar:';
		$data['uri']      = 'pages/';
		
		$pages            = $this->SiteModel->getPage(NULL, 'id');
		
		for ( $i=0; $i < count($pages); $i++ ) {
			$data['items'][$i]['id']      = $pages[$i]['id'];
			$data['items'][$i]['desc']    = $pages[$i]['title'];
			$data['items'][$i]['tooltip'] = 'Atualizado em: ' .
			                                $this->datefunctions->
											dateTimeFormated($pages[$i]['updated_at']);
		}
		
		$this->html->output('admin/list', $data);
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

		$id = $this->uri->segment(4); 
		$id = isset($id) ? $id : 0;

		$form = array('id'      => array('title'     => '',
                                         'validation'=> '',
                                         'value'     => $id),
					  'page'    => array('title'     => 'ID Pagina',
									     'validation'=> 'required|alpha_numeric|min_length[3]|max_length[100]',
									     'value'     => ''),
					  'title'   => array('title'     => 'Titulo',
                                         'validation'=> 'required|alpha_numeric|min_length[3]|max_length[200]',
                                         'value'     => ''),
                      'header'  => array('title'     => 'Sub Titulo',
                                         'validation'=> 'max_length[250]',
                                         'value'     => ''),
                      'tooltip' => array('title'     => 'Tooltip',
                                         'validation'=> 'max_length[250]',
                                         'value'     => '')
					);

		// set das regras de validacao
		foreach($form as $key => $item) {
			$this->form_validation->set_rules($key, $item['title'], $item['validation']);
		}
		
		// preparing data
		//$data         = array('id'=>'', 'id_company'=>'', 'page'=>'', 'title'=>'', 'header'=>'', 'tooltip'=>'');
		//$data['id']   = $this->uri->segment(4);
		//$data['form'] = $form;
		
		//***********************************************************
		// carregando formulario (sem post) - opcao de novo ou edicao
		//***********************************************************
		
		if($this->form_validation->run()==FALSE) {
			
			// se id for numerico (=edicao), carrega valores do registro 
			if ($form['id']['value'] > 0) {
                $values = $this->SiteModel->getPageByID($form['id']['value']);

                //$teste = array_map('array_push', array($form), array($values));
                
                foreach ($form as $key => $item) {
                    $form[$key]['value'] = $values[$key];
                }
            }

            // carrega formulario
			$template = 'admin/pages_form';
			var_dump($form); var_dump($values); var_dump($teste); die();
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

			$view = array();

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
		$data              = array();
		$data['message']   = 'Página excluida do Site!';
		$data['url']       = '/admin/pages';
		$this->html->output('admin/message', $data);
	}

}