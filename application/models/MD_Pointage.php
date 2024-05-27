<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MD_Pointage extends CI_Model{
    public function getOne($where) {
        $this->db->where('id_pointage', $where);
        $query = $this->db->get('pointage'); 
        return $query->row(); 
    }
    function remplace_zero($value) {
        return ($value === '') ? 0 : $value;
    }
    public function insert($col1,$col2,$col3,$col4) {
        $sql = "insert into pointage (id_employe, horaire_jour, horaire_nuit, horaire_ferie) values ( %s, %s, %s, %s) ";
        $sql = sprintf($sql,$this->db->escape($col1),$this->db->escape($col2),$this->db->escape($col3),$this->db->escape($col4));
        $this->db->query($sql);
        //var_dump($sql);
        $insert_id = $this->db->insert_id();
        return $this->getOne($insert_id);
    }
    //DIM
    public function getlast($where) {
        $this->db->select("(horaire_jour + horaire_nuit) AS sd");
        $this->db->from('pointage');
        $this->db->where('id_employe', $where);
        $this->db->order_by('id_pointage','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();  
    }
    //NUIT
    public function getNight_Sup($where) {
        $this->db->select(" id_employe , SUM(horaire_jour) as sj ,  SUM(horaire_nuit) as sn , SUM(horaire_ferie) as sf,  SUM(horaire_jour) +  SUM(horaire_nuit)  as total_heure  , date_pointage");
        $this->db->from('pointage');
        $this->db->where('id_employe', $where);
        $this->db->group_by('date_pointage,id_employe');
        $this->db->order_by('date_pointage','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();  
    }
    //FERIE
    public function getFerie($where){
        $this->db->select("id_employe , SUM(horaire_jour) + SUM(horaire_nuit) as sj,SUM(horaire_ferie) as sf,date_pointage");
        $this->db->from('pointage');
        $this->db->where('id_employe', $where);
        $this->db->where('date_pointage', date('Y-m-d'));
        $this->db->where('horaire_ferie !=',0);
        $this->db->group_by('date_pointage,id_employe');
        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->row();  
    }
    public function majoration_dimanche($h,$emp,$pointage,$m){
        $this->load->model('MD_Horaire');
        $this->load->model('MD_Horaire_employe');
        $horaire = $this->MD_Horaire->getOne($h);
        //echo $horaire->id_horaire.' --- '.$pointage->id_pointage.' --- '.$horaire->pourcentage.' --- '.$pointage->horaire_jour;
        $this->MD_Horaire_employe->insert($horaire->id_horaire,$emp->id_employe,$horaire->pourcentage,$pointage->sd,$m);
    }
    public function majoration_nuit($h,$emp,$pointage,$m){
        $this->load->model('MD_Horaire');
        $this->load->model('MD_Horaire_employe');
        $horaire = $this->MD_Horaire->getOne($h);
        //echo $horaire->id_horaire.' --- '.$pointage->id_employe.' --- '.$horaire->pourcentage.' --- '.$pointage->sn;
        $this->MD_Horaire_employe->insert($horaire->id_horaire,$emp->id_employe,$horaire->pourcentage,$pointage->sn,$m);
    }
    public function majoration_ferie($h,$hf,$emp,$pointage,$m){
        $this->load->model('MD_Horaire');
        $this->load->model('MD_Horaire_employe');
        $horaire = $this->MD_Horaire->getOne($h);
        $val1 = 0; $val2 = 0;
        if(!empty($pointage)){
            $val1 =$pointage->sf;
            $val2 =  $pointage->sj;
        }
        //echo $horaire->id_horaire.' --- '.$emp->id_employe.' --- '.$horaire->pourcentage.' --- '. $val1.' --- '. $val2;
        $this->MD_Horaire_employe->insert($horaire->id_horaire,$emp->id_employe,$horaire->pourcentage,$val1,$m);
        $horaire1 = $this->MD_Horaire->getOne($hf);
        $this->MD_Horaire_employe->insert($horaire1->id_horaire,$emp->id_employe,$horaire1->pourcentage,$val2,$m);
    }
    public function heure_norm($emp,$val){
        $sh = $emp->salaire_semaine/$emp->horaire_semaine;
        $this->load->model('MD_Horaire');   $this->load->model('MD_Horaire_employe');
        $diff1 = $val - $emp->horaire_semaine; 
        $h1 = $this->MD_Horaire->getOne(1);
        $h2 = $this->MD_Horaire->getOne(2);
        $h3 = $this->MD_Horaire->getOne(3);
        if($diff1 > 0){
            //inserer HN a 100 %
            //echo '  RRESTE  = '.$diff1.'<br>';
            $this->MD_Horaire_employe->insert($h1->id_horaire,$emp->id_employe,$h1->pourcentage,$emp->horaire_semaine,$sh);
            $hs30 =  $diff1 - 8;
            if($hs30 > 0){
                //inserer HS a 30 %
                //echo '  AMBINY  = '. $hs30.'<br>';
                $this->MD_Horaire_employe->insert($h2->id_horaire,$emp->id_employe,$h2->pourcentage,8,$sh);
                $hs50 = $hs30 - 12;
                if($hs50 > 0){
                    //inserer HS a 50 %
                    //echo '  HUHU  = '. $hs50.'<br>';
                    $this->MD_Horaire_employe->insert($h3->id_horaire,$emp->id_employe,$h3->pourcentage,12,$sh);
                }else{
                      //inserer HS a 50 %
                    //echo '  HUHU--1  = '. $hs50.'<br>';
                    $this->MD_Horaire_employe->insert($h3->id_horaire,$emp->id_employe,$h3->pourcentage,$hs30,$sh);
                }
            }else{
                //inserer HS a 30 %
                //echo '  AMBINY--1  = '. $hs30.'<br>';
                $this->MD_Horaire_employe->insert($h2->id_horaire,$emp->id_employe,$h2->pourcentage,$diff1,$sh);
            }
        }else{
            //inserer HN a 100 %
            //echo '  RRESTE--1  = '.$diff1.'<br>';
            $this->MD_Horaire_employe->insert($h1->id_horaire,$emp->id_employe,$h1->pourcentage,$val,$sh);
        }
    }
}
?>