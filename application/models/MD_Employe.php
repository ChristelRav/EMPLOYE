<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Employe extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_employe', $where);
        $query = $this->db->get('employe'); 
        return $query->row(); 
    }
    public function list_employe_cours(){
        $this->db->select("*");
        $this->db->from('employe');
        $this->db->where('date_fin_contrat >=',date('Y-m-d'));
        $this->db->or_where('date_fin_contrat IS NULL', null, false);
        $query = $this->db->get();
        return $query->result();  
    }
    public function getEmploye_utilisateur($where) {
        $this->db->select("e.id_employe, e.nom, e.prenom, e.date_naissance, e.date_embauche, e.date_fin_contrat, 
        c.nom as categorie_nom, c.horaire_semaine, c.salaire_semaine, c.pourcentage_indemnite");
        $this->db->from('employe e');
        $this->db->join('categorie c', 'c.id_categorie = e.id_categorie');
        $this->db->where('id_utilisateur', $where);
        $query = $this->db->get(); 
        return $query->row(); 
    }
}
?>