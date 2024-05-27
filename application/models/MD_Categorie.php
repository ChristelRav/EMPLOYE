<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Categorie extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_categorie', $where);
        $query = $this->db->get('categorie'); 
        return $query->row(); 
    }
    public function list_categorie(){
        $this->db->select("*");
        $this->db->from('categorie');
        $query = $this->db->get();
        return $query->result();  
    }
}
?>