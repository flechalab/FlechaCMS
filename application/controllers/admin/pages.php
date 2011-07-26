<?php
/**
 * cms class to manage page info/content
 * @package FlechaCMS
 * @author  Fernando Dias
 */
class Pages extends CI_Controller {

    /**
     * page's id (number) 
     * @var integer
     */
    private $id    = 0;
    
    /**
     * array with page's data
     * @var array 
     */
    private $page  = array();
    
    /**
     * array with each div of page and a subarray with info about it
     * @var array
     */
    private $divs  = array();
	
    
    /**
     * Load libraries, models and templates
     */
	public function __construct() {
		parent::__construct();
        // profiler
		$this->output->enable_profiler(TRUE);
        // model layer
		$this->load->model('SiteModel');
        // html template constructor
		$this->load->library('Html');
        $this->html->setTemplateMode('adm');
		$this->load->library('DateFunctions');
        // login validation
        $this->load->library('session');
        $this->load->library('CheckLogin');
        $this->checklogin->check();
	}
	
	/**
	 * load list with pages on the site 
	 */
	function index() {
        $data               = array();
		$data['title']      = 'Lista de Páginas do Site';
		$data['subtitle']   = 'Clique sobre a página que deseja editar:';
		$data['submenu']    = TRUE;
		$data['uri']        = ADMIN_URL_PAGES;
		$pages              = $this->SiteModel->getPage(NULL, 'id');
		
		for ( $i=0; $i < count($pages); $i++ ) {
			$data['items'][$i]['id']      = $pages[$i]['id'];
			$data['items'][$i]['desc']    = (!empty($pages[$i]['title'])) ? 
                                            $pages[$i]['title'] : $pages[$i]['page'];
			$data['items'][$i]['tooltip'] = 'Atualizado em: ' .
			                                $this->datefunctions->
											dateTimeFormated($pages[$i]['updated_at']);
		}
		
		$this->html->output('admin/list', $data);
	}

    /**
     * form/set/update page on the site 
     * @param string $id 
     */
	function setUp($id) {

		// library -> form_validation
		$this->load->library('form_validation'); // ci  lib
        $this->load->library('ExtraValidation'); // ext lib
        $this->load->library('NormalizeChar');   // ext lib

        // setting array with form data
        $this->setId($id);
        $this->setPage();
        $this->setDivs();

        // set validation rules
		foreach($this->page as $key => $item) {
			$this->form_validation->set_rules($key, $item['title'], $item['validation']);
		}

        $this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
				
		if($this->form_validation->run()==FALSE) {
            // loading form (new/edit)
            $this->form();
		}		
		else {
            // saving the data form 
            $this->setData($_POST);
		}
	}
	

    /**
     * delete page
     * @param integer $id 
     */
	public function del($id) {

        //TODO exluir divs,
        // teste e vincular (dependencia) tab. divs com pages, para gerar erro
        // ao deletar sem apagar divs
        
		$this->SiteModel->deletePage($id);
		$data              = array();
		$data['message']   = 'Página excluida do Site!';
		$data['url']       = ADMIN_URL_PAGES;
		$this->html->output('admin/message', $data);
	}

    /**
     * getting id from item
     * @return integer
     */
    private function getId() {
		return $this->id;
    }

    /**
     * return page
     * @return string 
     */
    private function getPage() {
        return $this->page;
    }
    
    /**
     * array with div data
     * @return string 
     */
    private function getDivs() {
        return $this->divs;
    }

    /**
     * set id from item
     * @param integer $id 
     */
    private function setId($id) {
		$this->id = $id;
    }
    
    /**
     * set array with data to html/form
     */
    private function setPage() {

		$this->page = array('id'      => array('title'     => '',
                                               'validation'=> '',
                                               'type'      => 'input',
                                               'value'     => $this->getId() ),
					        'page'    => array('title'     => 'ID Pagina (letras/numeros sem espaços)',
									           'validation'=> 'required|alpha_dash|min_length[3]|max_length[100]',
                                               'type'      => 'input',
									           'value'     => ''),
					        'header'  => array('title'     => 'Nome da Página/Link Menu',
                                               'validation'=> 'required|min_length[3]|max_length[200]',
                                               'type'      => 'input',
                                               'value'     => ''),
                            'title'   => array('title'     => 'Titulo',
                                               'validation'=> 'max_length[250]',
                                               'type'      => 'input',
                                               'value'     => ''),
                            'tooltip' => array('title'     => 'Dica/Tooltip',
                                               'validation'=> 'max_length[250]',
                                               'type'      => 'input',
                                               'value'     => '')
					       );

        // setting values if id exists
        if ($this->page['id']['value'] > 0) {
            $values = $this->SiteModel->getPageByID($this->page['id']['value']);
            foreach ($this->page as $key => $item) {
                $this->page[$key]['value'] = $values[$key];
            }
        }

    }

    /**
     * set divs property with data about page's divs from database
     */
    private function setDivs() {
        try {
            $this->divs = $this->SiteModel->getDivs($this->getId());
        }
        catch ( Exception $e ) {
            show_error($e->getMessage());
        }
    }
    
    /**
     * saving data in database
     * @param array $data 
     */
    public function setData($data) {
        // preparando data (com post)
        $data               = array_merge(array( 'id' => $this->getId() ), $data);
        $data['id_company'] = COMPANY_ID;
        //$data['page']       = $this->normalizechar->normalize($data['header']);
        //$data['page']       = $this->normalizechar->replaceSpaces($data['page']);

        try {
            $this->SiteModel->setPage($data);
            $view = array();
            $view['message']  = 'Dados da Página salvos com sucesso';
            $view['url']      = '/admin/pages';
            $template         = 'admin/message';
            $this->html->output($template, $view);
        }
        catch ( Exception $e ) {
            show_error($e->getMessage());
        }
    }
    
    /**
     * output html form to insert/update page's data
     */
    public function form() {

        // carrega formulario
        $template = array( 'admin' . DIRECTORY_SEPARATOR . 'form', 'html_page' );

        $data = array();
		$data['title']      = 'Manutenção de Página do Site';
		$data['subtitle']   = '';
		$data['submenu']    = TRUE;
        $data['uri']        = ADMIN_URL_PAGES;
        $data['form_url']   = ADMIN_URL_PAGES . '/' . $this->getId();
        $data['form_label'] = 'Configurações da Página:';
        $data['form']       = $this->getPage();  //data to form
        $data['page']       = $this->SiteModel->getPage( $data['form']['page']['value'] );  //data to html_page
        $data['divs']       = $this->getDivs();  //data to html_page
        
        $this->html->set_tinymce();
        $this->html->output($template, $data);
    }

    /**
     * method to return ajax(string) data about pages
     * @param string $option
     * @param string $id 
     */
    public function ajax($option=false, $id=false) {
        
        //TODO ajax - pages
        
        var_dump($option);        var_dump($id);
        if($option===false || $id===false) { die('Option Declaration Error'); }
        // TODO if option/method exists
        $this->setId($id);
        $get_option = 'get' . ucfirst($option);
        $set_option = 'set' . ucfirst($option);
        $this->$set_option();
        $this->html->output_ajax($this->$get_option());
    }

    /**
     * method to return json data about pages
     * @param string $option
     * @param string $id 
     */
    public function json($option=false, $id=false) {
        
        // TODO json - pages
        
        //var_dump($option);        var_dump($id);
        if($option===false || $id===false) { die('Option Declaration Error'); }
        // TODO if option/method exists
        $this->setId($id);
        $get_option = 'get' . ucfirst($option);
        $set_option = 'set' . ucfirst($option);
        $this->$set_option();
        $this->html->output_json($this->$get_option());
    }

}