<?php

/**
 * front end - website page (controller)
 * @package FlechaCMS
 * @author  Fernando Dias
 */
class Site extends CI_Controller {

    /**
     * Load libraries, modes, template
     */
    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->load->library('Html');
        $this->load->model('SiteModel');
        $this->html->setTemplateMode('web');
    }

    /**
     * load page's template 
     * @param  string $page
     */
    private function load_template($page) {

        // preparing HTML
        $data['page'] = $this->SiteModel->getPage($page);

        if (empty($data['page']))
            return false;

        $data['divs'] = $this->SiteModel->getDivs($data['page'][0]['id']);

        // preparing HEADER
        $header['title'] = $data['page']['0']['title'];
        $header['description'] = $data['page']['0']['tooltip'];

        // load HTML class
        $this->html->output('html_page', $data, $header);
    }

    // TODO a general method to get each template file

    /**
     * call load_template method to load template
     */
    public function index() {
        $this->load_template('home');
    }

    /**
     * call load_template method to load template
     */
    public function sobrenos() {
        $this->load_template('sobrenos');
    }

    /**
     * call load_template method to load template
     */
    public function servicos() {
        $this->load_template('servicos');
    }

    /**
     * call load_template method to load template
     */
    public function portifolio() {
        $this->load_template('portifolio');
    }

    /**
     * call load_template method to load template
     */
    public function contato() {
        $this->load_template('contato');
    }

}
