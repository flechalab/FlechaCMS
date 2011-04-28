<?php
class UsersModel extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}
	
	public function getUser($id=NULL, $type='id') {
		
		$this->db->where('id_company', COMPANY_ID);

		if($type=='id' && $id!=NULL)
		$this->db->where('id', $id);

		if($type=='user' && $id!=NULL)
		$this->db->where('user', $id);

		$this->db->order_by('user','asc');
		
		$query = $this->db->get('site-users');
		return $query->result_array();
	}

	
	public function setUser($data) {
		$check_user = $this->getUser($data['id']);
		
		if($data['id']=='new') {
			unset($data['id']);
			if(count($check_user)==0) {
				$this->insertUser($data);
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		else {	
			if( (count($check_user)==0) || ($check_user[0]['id'] == $data['id']) ) {
				$this->updateuser($data);
				return TRUE;
			}
			else {
				return FALSE;
			}			
		}
	}
		
	public function insertUser($data) {
		$this->db->insert('site-users', $data);
	}
	
	public function updateUser($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('site-users', $data);
	}
	
	public function deleteUser($id) {
		$this->db->where('id', $id);
		$this->db->delete('site-users'); 
	}
	
}
