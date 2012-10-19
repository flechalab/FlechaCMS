<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class to generate general HTML
 * @package FlechaCMS
 * @author  Fernando Dias
 */
Class Html {

    private $ci;
    private $template_mode;
    private $path;
    private $tinymce;
    private $displayHeader;
    private $displayFooter;

    /**
     * Enter description here ...
     * @param $template_mode : web (page/site) adm (para area administrativa)
     */
    public function __construct()
    {
        $this->ci = & get_instance();
    }

    public function setTemplateMode($template)
    {
        $this->template_mode = $template;
    }

    public function displayHeaderAndFooter($value)
    {
        $this->displayHeader = (boolean)$value;
        $this->displayFooter = (boolean)$value;
    }

    public function output($template, $data)
    {
        if ($this->template_mode == 'web') {
            $this->output_www($template, $data);
        } else if ($this->template_mode == 'adm') {
            $this->output_adm($template, $data);
        } else {
            throw new InvalidArgumentException('Template Mode not defined!');
        }
    }

    private function output_www($template, $data)
    {
        // cabecalho da pagina (header)
        if ( $this->displayHeader )
            $this->ci->load->view('html_header',
                            isset($data['header']) ? $data['header'] : null);
        // menu de navegacao
        $this->ci->load->view('html_menu', $data);
        // template(s) a ser carregado
        if (is_array($template)) {
            foreach ($template as $item) {
                //$this->ci->load->view($item, $data);
            }
        } else {
            foreach ($data['content'] as $content) {
                //var_dump($content);die();
                $this->ci->load->view($template, $content);
            }
        }
        // rodape
        if ( $this->displayFooter )
            $this->ci->load->view('html_footer');
    }

    private function output_adm($template, $data)
    {
        // title do header do html
        $header['title'] = SITE_NAME . ' : Área Administrativa';
        $header['description'] = 'Área Administrativa do Site : ' . SITE_NAME;
        // script para carregar tinymce
        if (isset($this->tinymce))
            $header['tinymce'] = $this->tinymce;
        // cabecalho da pagina (header)
        $this->ci->load->view('admin/header', $header);
        // template top/header a ser carregado
        $this->ci->load->view('admin/top', $data);

        // template a ser carregado
        if (is_array($template)) {
            foreach ($template as $item) {
                $this->ci->load->view($item, $data);
            }
        } else {
            $this->ci->load->view($template, $data);
        }

        // rodape
        $this->ci->load->view('admin/footer');
    }

    public function output_ajax($data)
    {
        if (is_array($data)) {
            //TODO
            //echo http_build_query( array_map('http_build_query', $data) );
            var_dump($data);
        } else {
            echo $data;
        }
    }

    public function output_json($data)
    {
        echo json_encode($data);
    }

    public function set_css($filename)
    {
        $filename = trim($filename);
        $header_css = "<link rel='stylesheet' type='text/css' href='/lib/css/{$filename}.css' />";
        return $header_css . chr(10);
    }

    public function set_js($filename)
    {
        $filename = trim($filename);
        $header_js = "<script type='text/javascript' src='/lib/js/{$filename}.js'></script>";
        return $header_js . chr(10);
    }

    public function set_tinymce()
    {
        $this->ci->load->library('tinymce');
        $this->tinymce = $this->ci->tinymce->header();
    }

}