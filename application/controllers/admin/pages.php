    <?php
/**
 * Classe do CMS para Manutencao das Paginas do Site
 * @package flecha-site
 */
class Pages extends CI_Controller {

    private $id    = 0;
    private $page  = array();
    private $divs  = array();
	
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
	
	/*
	 * Index function carrega lista das paginas atuais do site
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

	
	/*
	 * funcao com tomada de decisao para inserir ou atualizar registro de pagina do site
	 */
	function set($id) {

		//***********************************************************
		// preparando recurso do CI, validacoes, info de view e data
		//***********************************************************
		
		// helper -> form, url
		//$this->load->helper(array('form','url'));

		// library -> form_validation
		$this->load->library('form_validation'); // ci  lib
        $this->load->library('ExtraValidation'); // ext lib
        $this->load->library('NormalizeChar');   // ext lib

        // setting array with form data
        $this->setId($id);
        $this->setPage();
        $this->setDivs();

        // set das regras de validacao
		foreach($this->page as $key => $item) {
			$this->form_validation->set_rules($key, $item['title'], $item['validation']);
		}

        $this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
				
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
	
    
    /*
     * deleting page
     **/
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

    /*
     * getting id from uri segment
     **/
    private function getId() {
		return $this->id;
    }
    
    private function setId($id) {
		$this->id = $id;
    }
    
    private function getPage() {
        return $this->page;
    }
    
    /*
     * array with data to html/form
     **/
    private function setPage() {

		$this->page = array('id'      => array('title'     => '',
                                               'validation'=> '',
                                               'type'      => 'input',
                                               'value'     => $this->getId() ),
					        'page'    => array('title'     => 'ID Pagina',
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

    /* array with div data */
    private function getDivs() {
        return $this->divs;
    }

    /* array with div data */
    private function setDivs() {
        try {
            $this->divs = $this->SiteModel->getDivs($this->getId());
        }
        catch ( Exception $e ) {
            show_error($e->getMessage());
        }
    }
    
    /* display html form */
    public function form() {

        // carrega formulario
        $template = array( 'admin/form', 'html_page' );

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
    
    /* saving data */
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
            $template = 'admin/message';
            $this->html->output($template, $view);
        }
        catch ( Exception $e ) {
            show_error($e->getMessage());
        }
        /*
        $view = array();

        if( $this->SiteModel->log === TRUE ) {
            $view['message']  = 'Dados da Página salvos com sucesso';
            $view['url']      = '/admin/pages';
        }
        else {
            // messagem q pagina ja existe
            $view['message']  = 'Erro ao salvar Dados. ' .$this->SiteModel->log_msg;
            $view['url']      = 'Javascript:history.back();';
        }
        $template = 'admin/message';
        $this->html->output($template, $view);
         * 
         */
    }

    public function ajax($option=false, $id=false) {
        var_dump($option);        var_dump($id);
        if($option===false || $id===false) { die('Option Declaration Error'); }
        // TODO if option/method exists
        $this->setId($id);
        $get_option = 'get' . ucfirst($option);
        $set_option = 'set' . ucfirst($option);
        $this->$set_option();
        $this->html->output_ajax($this->$get_option());
    }

    public function json($option=false, $id=false) {
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