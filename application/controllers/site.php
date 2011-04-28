<?php
class Site extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->library('Html');
		$this->load->model('SiteModel');	
		$this->html->setTemplateMode('web');
	}
	
	private function load_template($page) {
		
		// preparing HTML
		$data['page']  = $this->SiteModel->getPage($page);

        if(empty($data['page'])) return false;

        $data['divs']  = $this->SiteModel->getDivs($data['page'][0]['id']);
		
		// preparing HEADER
		$header['title']       = $data['page']['0']['title'];
		$header['description'] = $data['page']['0']['tooltip'];
				
		// load HTML class
		$this->html->output('html_page', $data, $header);
	}
	
	public function index() {
		$this->load_template('home');
	}

	public function sobrenos() {
		$this->load_template('sobrenos');
	}
	
	public function servicos() {
		$this->load_template('servicos');
	}

	public function portifolio() {
		$this->load_template('portifolio');
	}
	
	public function contato() {
		$this->load_template('contato');
	}
	
}
