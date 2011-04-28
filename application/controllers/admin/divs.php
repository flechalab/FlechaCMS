<?php

/**
* Classe do CMS para Manutencao das Divs de cada pagina do Site
 * @package flecha-site
 */
class Divs extends CI_Controller {

    /**
     * id (autonum) da div
     * @access private
     * @var integer
     */
    private $id        = 0;

    /**
     * id (tag) da div
     * @access private
     * @var string
     */
    private $div_id    = '';

    /**
     * id da page ref. div
     * @access private
     * @var integer
     */
    private $page      = 0;

    /**
     * array com info (db pages) da pagina
     * @access private
     * @var array
     */
    private $page_data = array();

    /**
     * array com dados da div
     * @access private
     * @var array
     */
    private $div       = array();

	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->model('SiteModel');
		$this->load->library('Html');
		$this->load->library('dateFunctions');
		$this->html->setTemplateMode('adm');
    }
	
	
	/*
	 * Index function carrega lista das paginas atuais do site
	 */
	function index() {
        header('Location:/admin/pages');
	}
	
	
	/*
	 * funcao com tomada de decisao para inserir ou atualizar registro de pagina do site
	 */
	function set($id, $page) {
		//***********************************************************
		// preparando recurso do CI, validacoes, info de view e data
		//***********************************************************
		
		// library -> form_validation
		$this->load->library('form_validation'); // ci  lib
        $this->load->library('ExtraValidation'); // ext lib
        $this->load->library('NormalizeChar');   // ext lib

        $this->setPage($page);
        $this->setDivId($id);
        $this->setDiv();

        $this->getPageData($page);

        foreach ($this->div as $key => $item) {
            $this->form_validation->set_rules($key, $item['title'], $item['validation']);
        }

        $this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');

		// preparando data
		$data       = array('id'=>'', 'id_page'=>'', 
		                    'div_id'=>'', 'div_type'=>'', 
		                    'div_title'=>'', 'div_content'=>'');
		
		$data['id']   = $this->id;
		$data['page'] = $this->page;
		
		//***********************************************************
		// carregando formulario (sem post) - opcao de novo ou edicao
		//***********************************************************
		
		if($this->form_validation->run()==FALSE) {
            $this->form();
		}
		
		//***********************************************************
		// ao enviar formulario (post) processa gravacao de dados
		//***********************************************************
		else {
            $this->setData($_POST);
		}
		
	}

	public function del($id, $id_page) {
        try {
            $this->SiteModel->deleteDiv($id, $id_page);
            $data['message']   = 'Div excluida da Página!';
            $data['url']       = "/admin/pages/{$id_page}";
            $this->html->output('admin/message', $data);
        }
        catch (Exception $e) {
            show_error($e->getMessage());
        }
	}

    /*
     * getting id from div
     **/
    private function getDivId() {
		return $this->div_id;   
    }

    /*
     * getting id (autonum) from div
     **/
    private function getId() {
		return $this->id;
    }

    private function setDivId($div_id) {
        try {
            $this->id     = 0;
            $this->div_id = $div_id;
            if($div_id!='0') {
                $div       = $this->SiteModel->getDivs($this->page, $div_id);
                $this->id  = $div[0]['id'];
            }
        }
        catch (Exception $e) {
            show_error($e->getMessage());
        }
    }
    
    private function getPage() {
        return $this->page;
    }

    private function setPage($page) {
        $this->page = $page;
    }

    private function getPageData() {
        $this->page_data = $this->SiteModel->getPageByID($this->getPage());
    }

	private function getDiv() {
		return $this->div;
	}
    /*
     * array with data to html/form
     **/
    private function setDiv() {

		$this->div = array('div_id'      => array('title'     => 'Id do Bloco',
                                                  'validation'=> 'required|alpha_numeric|min_length[1]|max_length[50]',
                                                  'type'      => 'input',
                                                  'value'     => ($this->getDivId()=='0') ? '' : $this->getDivId() ),
                           'id'          => array('title'     => '',
                                                  'validation'=> '',
                                                  'type'      => 'input',
                                                  'value'     => ''),
            /*
					       'div_type'    => array('title'     => 'Tipo do Bloco',
									              'validation'=> 'required|alpha_numeric|min_length[1]|max_length[50]',
                                                  'type'      => 'input',
								                  'value'     => 'div'),
             * 
             */
					       'div_title'   => array('title'     => 'Titulo do Bloco',
                                                  'validation'=> 'max_length[100]',
                                                  'type'      => 'input',
                                                  'value'     => ''),
                           'div_content' => array('title'     => 'Conteudo',
                                                  'validation'=> '',
                                                  'type'      => 'textarea',
                                                  'value'     => '')
					       );

        // setting values if id exists
        if (!empty($this->div['div_id']['value'])) {
            $values = $this->SiteModel->getDivs($this->page, $this->div['div_id']['value']);
            foreach ($this->div as $key => $item) {
                $this->div[$key]['value'] = $values[0][$key];
            }
        }
    }


	private function setData($data) {
		// preparando data (com post)
		$data['div_id']   = strtolower($data['div_id']);
        $data['div_type'] = 'div';
        $data['id_page']  = $this->getPage();
        $data['id']       = $this->getId();

        try {
            $this->SiteModel->setDiv($data);
			// mensagem de dados gravados com sucesso
            $view = array();
			$view['message']  = 'Dados da Div salvos com sucesso';
			$view['url']      = "/admin/pages/{$data['id_page']}";
            $template = 'admin/message';
            $this->html->output($template, $view);
        }
        catch (Exception $e) {
            show_error($e->getMessage());
        }
	}

    private function form() {
        // carrega formulario
        $template = array('admin/form');

        $data = array();
		$data['title']      = 'Manutenção de Bloco de Site';
		$data['subtitle']   = 'Pagina: ' . $this->page_data['page'];
        $data['submenu']    = TRUE;
        $data['uri']        = $this->uri->uri_string(); 
        $data['form_url']   = $data['uri'];
        $data['form_label'] = 'Configurações do Bloco:';
        $data['form']       = $this->getDiv();  //data to form

        $this->html->set_tinymce();
        $this->html->output($template, $data);
    }
}