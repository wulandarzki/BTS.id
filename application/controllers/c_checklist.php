<?php 
 
 
class C_checklist extends REST_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_checklist');
 
	}
    
    function get_checklist(){
        $data['checklist'] = $this->checklist->get_checklist()->result(); 
    } 
   
   function delete($id_anggota){
        $this->checklist->delete_checklist($id_anggota);
    }
    function get_checklist_byid(){
        $data['checklist'] = $this->checklist->get_checklist_id()->result(); 
    } 
    
    function create(){
        $checklist = $this->db->get('checklist', TRUE);
        $this->m_checklist->create_checklist($checklist);
    }

    function update(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');
     
        $data = array(
            'name' => $name,
            'item_name' => $item_name,
            'id_item' => $id_item
        );
     
        $where = array(
            'id_item' => $id_item
        );
     
        $this->m_checklist->update_data($where,$data,'checklist');
    }
}

