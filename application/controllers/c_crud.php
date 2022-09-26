<?php 
 
 
class C_crud extends REST_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_user');
 
	}

    function register(){
        if ($this->authtoken() == 'salah'){
            return $this->response(array('kode'=>'401', 'pesan'=>'signature tidak sesuai', 'data'=>[]), '401');
            die();
        }

        $username= $this->input->post('username');
        $password= $this->input->post('password');
        $email= $this->input->post('email');
    }


	function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
            );
        $cek = $this->m_user->cek_login("user",$where)->num_rows();
        
        if($cek > 0){
     
            $data_session = array(
                'nama' => $username,
                'status' => "login"
                );
     
            $this->session->set_userdata($data_session);
            $this->session->set_flashdata('success', 'User berhasil login');
        }else{
            return FALSE;
        }
    }
}
