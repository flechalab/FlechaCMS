<?php

class ExtraValidation extends CI_Form_validation {

    public function alpha_space($str) {

        if(!preg_match("/^([-a-z0-9_ ])+$/i", $str)) {
            $this->form_validation->set_message('alpha_space', 'Caracteres Invalidos.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

}


