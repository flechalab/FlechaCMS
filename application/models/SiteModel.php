<?php
class SiteModel extends CI_Model {

    //public $log     = false;
    //public $log_msg = '';

    public function __construct() {
        parent::__construct();
	}
	
	public function getPage($page=NULL, $order='page') {
		$this->db->where('id_company', COMPANY_ID);
		if($page!=NULL) { $this->db->where('page', $page); }
		$this->db->order_by($order,'asc');
		$query = $this->db->get('site-pages');
        return $query->result_array();
	}

	public function getPageByID($id) {
		$this->db->where('id', $id);
		$query  = $this->db->get('site-pages');
		$result = $query->result_array();
		return $result[0];
	}
	
	public function setPage($data) {		
		if($data['id']=='0') {
			unset($data['id']);
    		$this->insertPage($data);
		}
		else {	
			$this->updatePage($data);
		}
	}
		
	public function insertPage($data) {
        try {
            $this->db->insert('site-pages', $data);
            //$this->log = true;
        }
    	catch(Exception $e) {
            //$this->log     = false;
            //$this->log_msg = 'Erro:' . $e->getMessage();
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
	public function updatePage($data) {
        try {
            $this->db->where('id', $data['id']);
            $this->db->update('site-pages', $data);
        }
    	catch(Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
	public function deletePage($id) {
        try {
        	$this->db->where('id', $id);
    		$this->db->delete('site-pages');
        }
    	catch(Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
	
	public function getDivs($page, $div=NULL) {
        //die($page.'/'.$div);
		$this->db->where('id_page', $page);
		if($div!=NULL) {
            $this->db->where('div_id', $div);
        }
		$this->db->order_by('div_id','asc');
		$query = $this->db->get('site-divs');
        if( isset($div) && !$this->db->affected_rows() > 0) {
            throw new Exception('Div informada Nao Localizada');
        }
		return $query->result_array();
	}

	
	public function getDivByID($id) {
		$this->db->where('id', $id);
		$query  = $this->db->get('site-divs');
		$result = $query->result_array();
		return $result[0];
	}
	
	
	public function setDiv($data) {
        //var_dump($data); die();
		if($data['id']=='0') {
			unset($data['id']);
    		$this->insertDiv($data);
		}
		else {
			$this->updateDiv($data);
		}
	}
		
	public function insertDiv($data) {
        try {
            $this->db->insert('site-divs', $data);
        }
    	catch(Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
	public function updateDiv($data) {
        try {
            $this->db->where('id', $data['id']);
            $this->db->update('site-divs', $data);
        }
        catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
	public function deleteDiv($div_id, $page) {
        try {
            $this->db->where( array('div_id'=>$div_id, 'id_page'=>$page) );
            $this->db->delete('site-divs');
            $rows = $this->db->affected_rows();
            if(!$rows>0) {
                throw new Exception('Erro ao Excluir Item');
            }
        }
        catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
}
