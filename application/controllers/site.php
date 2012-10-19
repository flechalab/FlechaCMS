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
    private function load_content($full=true) {
        $c     = 'content';
        $data  = array('header' => array('description' => 'flechaweb'));
        $pages = $this->SiteModel->getPage();
        foreach ($pages as $page) {
            $pageId                      = $page['id'];
            $pageName                    = $page['page'];
            $data[$c][$pageName]['info'] = $this->SiteModel->getPage($pageName);
            $data[$c][$pageName]['divs'] = $this->SiteModel->getDivs($pageId);
        }
        //var_dump($data);
        // load HTML class
        $this->html->output('html_page', $data);
    }

    /**
     * call load_template method to load template
     */
    public function index() {
        $this->html->displayHeaderAndFooter(true);
        $this->load_content();
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
