<?php 

class M_checklist extends CI_Model{
    
    function get_checklist(){
        $this->db->get('checklist');
    }

    function delete_checklist(){
        $this->db->where('id_item', $id_item );
        $this->db->delete('id_item');
        return true;
        
    }

    function get_checklist_id(){
        $this->db->get_where('checklist', array(id_item=> $id));
    }

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
    }
}