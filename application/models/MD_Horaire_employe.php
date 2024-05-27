<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Horaire_employe extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_horaire_employe', $where);
        $query = $this->db->get('horaire_employe'); 
        return $query->row(); 
    }
    public function insert($col1,$col2,$col3,$col4,$col5) {
        $sql = "insert into horaire_employe  (id_horaire, id_employe, pourcentage, total_heure, salaire_horaire)  values ( %s, %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3),$this->db->escape($col4),$this->db->escape($col5));
        //var_dump($sql);
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function getDetail($where, $where1, $where2,$montant) {
        $this->db->select("*,  (".$montant."* pourcentage )/100 as taux_horaire,  total_heure * ((".$montant." * pourcentage )/100) as montant ");
        $this->db->from('horaire_employe');
        $this->db->where('id_employe', $where);
        $this->db->where('date_h', $where1);
        $this->db->where('id_horaire', $where2);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();  
    }
    public function getSum_Montant($montant,$where, $where1) {
        $this->db->select("SUM( total_heure * ((".$montant."* pourcentage )/100)) as montant_total  ");
        $this->db->from('horaire_employe');
        $this->db->where('id_employe', $where);
        $this->db->where('date_h', $where1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();  
    }
}
?>