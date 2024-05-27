<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Horaire extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_horaire', $where);
        $query = $this->db->get('horaire'); 
        return $query->row(); 
    }
    public function list_horaire(){
        $this->db->select("*");
        $this->db->from('categorie');
        $query = $this->db->get();
        return $query->result();  
    }
}
?>