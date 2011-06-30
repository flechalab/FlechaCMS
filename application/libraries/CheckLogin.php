<?php
class CheckLogin {

    public function check() {
		$this->ci =& get_instance();

        if($this->ci->session->userdata('adm_uid')==FALSE) {            
            header('Location: /admin/login');
        }
        
	}

}