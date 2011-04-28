<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/* Ajax Library */
class AjaxReturn {

    private $instance;

    public function  __construct() {
        //parent::__construct();
        $this->instance =& get_instance();
    }

    public function get($class, $method, $params=false) {
        //var_dump($this->instance); die();
        if( isset($this->instance->$class) ) {
            throw new Exception('Instance Error! Class does not exists.');
        }
        //if( !method_exists($this->instance->$class, $method) ) {
		//	throw new Exception('Instance Error! Method does not exists.');
		//}

        echo $class . '/' . $method;
        echo call_user_func_array( array($this->instance->$class, $method), $params );
    }
}