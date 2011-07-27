<?php
/**
 * cms class to manage page's divs content
 * @package FlechaCMS
 * @author  Fernando Dias
 */
class Divs extends CI_Controller {

    /**
     * id (autonum) da div
     * @access private
     * @var integer
     */
    private $id        = 0;

    /**
     * tag (id) da div
     * @access private
     * @var string
     */
    private $tag       = '';

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

    
    /**
     * load libraries, model and templates
     */
	public function __construct() {
		parent::__construct();
        // profiler
		//$this->output->enable_profiler(TRUE);
        // model layer
		$this->load->model('SiteModel');
        // html template constructor
		$this->load->library('Html');
		$this->load->library('dateFunctions');
		$this->html->setTemplateMode('adm');
        // login validation
        $this->load->library('session');
        $this->load->library('CheckLogin');
        $this->checklogin->check();
    }
	
    /**
     * do nothing
     */
	function index() {
        header('Location:/admin/pages');
	}
	
	
    /**
     * form - set/update page's div 
     * @param integer $id
     * @param string  $page 
     */
	function setUp($tag, $page) {
		//***********************************************************
		// preparando recurso do CI, validacoes, info de view e data
		//***********************************************************
		
		// library -> form_validation
		$this->load->library('form_validation'); // ci  lib
        $this->load->library('ExtraValidation'); // ext lib
        $this->load->library('NormalizeChar');   // ext lib

        $this->setPage($page);
        $this->setId($tag);

        $this->setPageData($page);
        $this->setDiv();

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

    /**
     * delete page's div 
     * @param integer $id
     * @param string  $id_page 
     */
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

    /**
     * getting id (autonum) from div
     * @return integer
     */
    private function getId() {
		return $this->id;
    }

    /**
     * return actual div's id tag
     * @return string
     */
    private function getTag() {
		return $this->tag;   
    }

    /**
     * return page id
     * @return integer
     */
    private function getPage() {
        return $this->page;
    }

    /**
     * return array with div's data 
     * @return type 
     */
	private function getDiv() {
		return $this->div;
	}
    
    /**
     * get div data from database and set obj property
     * @param string $div_id 
     */
    private function setId($tag) {
        try {
            $this->id    = 0;
            $this->tag   = $tag;
            if($tag!='0') {
                $div       = $this->SiteModel->getDivs($this->page, $tag);
                $this->id  = $div[0]['id'];
            }
        }
        catch (Exception $e) {
            show_error($e->getMessage());
        }
    }
    
    /**
     * set page id 
     * @param integer $page 
     */
    private function setPage($page) {
        $this->page = $page;
    }

    /**
     * get page data from database and set property
     */
    private function setPageData() {
        $this->page_data = $this->SiteModel->getPageByID($this->getPage());
    }
    
    /**
     * array with data to html/form
     */
    private function setDiv() {

		$this->div = array('div_id'      => array('title'     => 'Id do Bloco (letras/numeros sem espaços)',
                                                  'validation'=> 'required|alpha_numeric|min_length[1]|max_length[50]',
                                                  'type'      => 'input',
                                                  'value'     => ($this->getTag()=='0') ? '' : $this->getTag() ),
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


    /**
     * insert/update data from div 
     * @param array $data 
     */
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

    /**
     * array with data to generate div's form 
     */
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