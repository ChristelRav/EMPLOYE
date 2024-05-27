<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Fiche_Paie extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_fiche_paie', $where);
        $query = $this->db->get('fiche_paie'); 
        return $query->row(); 
    }
    public function list_categorie(){
        $this->db->select("*");
        $this->db->from('fiche_paie');
        $query = $this->db->get();
        return $query->result();  
    }
    public function insert($col1,$col2) {
        $sql = "insert into fiche_paie (id_employe, montant)  values ( %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2));
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    public function list_emp_payer(){
            $subquery = $this->db->select('MAX(date_fiche_paie)')
                                 ->from('fiche_paie')
                                 ->where('id_employe = e.id_employe', NULL, FALSE)
                                 ->get_compiled_select();

            $this->db->select('e.id_employe, e.id_categorie, e.nom, e.prenom, c.nom AS categorie_nom, e.date_embauche ,e.date_naissance , e.date_fin_contrat, SUM(fp.montant) AS total_montant');
            $this->db->select("($subquery) AS date_fiche_paie", FALSE);
            $this->db->from('fiche_paie fp');
            $this->db->join('employe e', 'fp.id_employe = e.id_employe');
            $this->db->join('categorie c', 'c.id_categorie = e.id_categorie');
            $this->db->group_by('e.id_employe, e.id_categorie, e.nom, e.prenom, c.nom, e.date_embauche ,e.date_naissance , e.date_fin_contrat');
            $query = $this->db->get();
            return $query->result();
    }
    public function stat_horaires(){
        $this->db->select("he.id_horaire,h.designation,he.pourcentage  ,SUM(total_heure) as th , SUM(total_heure) * he.pourcentage as montant");
        $this->db->from('horaire_employe he');
        $this->db->join('horaire h', ' h.id_horaire = he.id_horaire');
        $this->db->group_by('he.id_horaire,h.designation,he.pourcentage');
        $query = $this->db->get();
        return $query->result();  
    }
}
?>