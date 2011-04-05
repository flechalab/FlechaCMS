<?php
class ConfigModel extends Model {
	
	public function __construct() {
		parent::Model();
	}
	
	public function getConfig() {
		$query = $this->db->get('site-config');
		return $query->result_array();
	}

	public function getValue($config) {
		$this->db->where('config', $config);
		$query = $this->db->get('site-config');
		return $query->result_array();
	}

	public function setConfig($data) {

		$check = $this->getValue($data['config']);

		if(count($check)==0) {
			$this->insertConfig($data);
		}
		else {
			$this->updateConfig($data);
		}
		return true;
	}

	public function insertConfig($data) {
		$this->db->insert('site-config', $data);
	}
	
	public function updateConfig($data) {
		$this->db->where('config', $data['config']);
		$this->db->update('site-config', $data);
	}
	
	public function deleteConfig($config) {
		$this->db->where('config', $config);
		$this->db->delete('site-config');
	}
	
}
