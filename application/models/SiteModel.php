<?php
class SiteModel extends Model {
	
	public function __construct() {
		parent::Model();
	}
	
	public function getPage($page=NULL) {
		
		$this->db->where('id_company', COMPANY_ID);

		if($page!=NULL)
		$this->db->where('page', $page);

		$this->db->order_by('page','asc');
		
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
		$check_page = $this->getPage($data['page']);
		
		if($data['id']=='new') {
			unset($data['id']);
			if(count($check_page)==0) {
				$this->insertPage($data);
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		else {	
			if( (count($check_page)==0) || ($check_page[0]['id'] == $data['id']) ) {
				$this->updatePage($data);
				return TRUE;
			}
			else {
				return FALSE;
			}			
		}
	}
		
	public function insertPage($data) {
		$this->db->insert('site-pages', $data);
	}
	
	public function updatePage($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('site-pages', $data);
	}
	
	public function deletePage($id) {
		$this->db->where('id', $id);
		$this->db->delete('site-pages'); 
	}
	
	
	public function getDivs($page, $div=NULL) {

		$this->db->where('id_page', $page);
		
		if($div!=NULL)
		$this->db->where('div_id', $div);
		
		$this->db->order_by('div_id','asc');
		
		$query = $this->db->get('site-divs');
		return $query->result_array();
	}

	
	public function getDivByID($id) {
		$this->db->where('id', $id);
		$query  = $this->db->get('site-divs');
		$result = $query->result_array();
		return $result[0];
	}
	
	public function setDiv($data) {
		
		//print_r($data); die();
		
		$check_div = $this->getDivs($data['id_page'], $data['div_id']);
		
		if($data['id']=='new') {
			unset($data['id']);
			if(count($check_div)==0) {
				$this->insertDiv($data);
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		else {	
			if( (count($check_div)==0) || ($check_div[0]['id'] == $data['id']) ) {
				$this->updateDiv($data);
				return TRUE;
			}
			else {
				return FALSE;
			}			
		}
	}
		
	public function insertDiv($data) {
		$this->db->insert('site-divs', $data);
	}
	
	public function updateDiv($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('site-divs', $data);
	}
	
	public function deleteDiv($id) {
		$this->db->where('id', $id);
		$this->db->delete('site-divs'); 
	}
}
