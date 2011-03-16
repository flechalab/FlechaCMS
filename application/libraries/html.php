<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Enter description here ...
 * @author fernandodias
 *
 */
Class Html {

	private $ci;
	private $template_mode;
	private $path;
	private $tinymce;
	
	/**
	 * 
	 * Enter description here ...
	 * @param $template_mode : web (page/site) adm (para area administrativa)
	 */
	public function __construct() {	
		$this->ci =& get_instance();
	}
	
	public function setTemplateMode($template) {
		$this->template_mode = $template;
	}
	
	public function output($template, $data, $header=NULL) {
		
		if($this->template_mode=='web') {
			$this->output_www($template, $data, $header);
		}
		
		if($this->template_mode=='adm') {
			$this->output_adm($template, $data);
		}
		
	}
	
	private function output_www($template, $data, $header) {
		// cabecalho da pagina (header)
		$this->ci->load->view('html_header', $header);
		$this->ci->load->view('html_menu');
		// template a ser carregado
		$this->ci->load->view($template, $data);
		// rodape
		$this->ci->load->view('html_footer');
	}
	
	
	private function output_adm($template, $data) {
		// title do header do html
		$header['title']       = SITE_NAME . ' : Área Administrativa';
		$header['description'] = 'Área Administrativa do Site : ' . SITE_NAME;
		// script para carregar tinymce
		if(isset($this->tinymce)) $header['tinymce'] = $this->tinymce;
		// titulo da pagina
		$data['top_title']     = 'Manutenção do Site';
		// cabecalho da pagina (header)
		$this->ci->load->view('admin/header', $header);
		// template a ser carregado
		$this->ci->load->view($template, $data);
		// rodape
		$this->ci->load->view('admin/footer');
	}
	
	public function set_css($filename) {
		$filename    = trim($filename);
		$header_css  = "<link rel='stylesheet' type='text/css' href='/lib/css/{$filename}.css' />" . chr(10);
		return $header_css;
	}
	
	public function set_js($filename) {
		$filename   = trim($filename);
		$header_js  = "<script type='text/javascript' src='/lib/js/{$filename}.js'></script>" . chr(10);
		return $header_js;
	}
	
	public function set_tinymce() {
		$this->ci->load->library('tinymce');
		$this->tinymce = $this->ci->tinymce->header();
	}
}