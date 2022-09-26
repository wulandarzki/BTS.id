<?php 

class M_user extends CI_Model{
	function register($username, $password, $nama){

		$data_user = array(
			'username'=> $username,
			'password'=> password_hash($password),
			'nama'=> $nama
		);
		$this->db->insert('user', $data_user);

	}
	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}
}

