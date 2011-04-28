<?php
class ConfigModel extends CI_Model {
	
	public function __construct() {
        parent::__construct();
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
        try {
            $this->db->insert('site-config', $data);
        }
        catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
	public function updateConfig($data) {
        try {
            $this->db->where('config', $data['config']);
            $this->db->update('site-config', $data);
        }
        catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
	public function deleteConfig($config) {
        try {
            $this->db->where('config', $config);
            $this->db->delete('site-config');
        }
        catch (Exception $e) {
            throw new Exception('Error: ' . $e->getMessage() . chr(10));
        }
	}
	
}
