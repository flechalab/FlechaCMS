<?php
/* Ajax Controller */
class Ajax extends CI_Controller {

    public function  __construct() {
        parent::__construct();
		$this->load->library('AjaxReturn');
    }

    public function index() {
        echo 'Silence!';
    }

    public function get($class=false, $method=false, $params=false) {
        try {
            echo $this->ajaxreturn->get($class, $method, $params);
        }
        catch (Exception $e) {
            echo 'Error Loading Ajax Data: ' . $e->getMessage();
        }
    }
}