<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_E_pointage extends CI_Controller {
	public function __construct() {
        parent::__construct();
         $this->load->model('MD_Employe');
         $this->load->model('MD_Pointage');
         $this->load->model('MD_Horaire');
         $this->load->model('MD_Horaire_employe');
         $this->load->model('MD_Fiche_Paie');
         if($this->session->userdata('user') === null) 
		{
			redirect('CT_Login/index?error=' . urlencode('Vous n`êtes pas connectée!'));
		}
    }
	private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
	public function index(){
        $data['jour'] = array("LUNDI", "MARDI", "MERCREDI","JEUDI","VENDREDI","SAMEDI","DIMANCHE");
		$this->viewer('/v_e_saisie_pointage',$data);
	}		
    public function inserer_pointage(){
        $emp = $this->MD_Employe->getEmploye_utilisateur($_SESSION['user'][0]['id_utilisateur']);   
        $data['jour'] = array("LUNDI", "MARDI", "MERCREDI","JEUDI","VENDREDI","SAMEDI","DIMANCHE");
        $sh = $emp->salaire_semaine/$emp->horaire_semaine;
        foreach ($data['jour'] as $j){
            $postJ = "jour" . $j;   $postN = "nuit" . $j;  $postF = "ferie" . $j;
            $jr = $this->MD_Pointage->remplace_zero($_POST[$postJ]) ;   $nt = $this->MD_Pointage->remplace_zero($_POST[$postN]) ;   $fr = $this->MD_Pointage->remplace_zero($_POST[$postF]) ;
            $this->MD_Pointage->insert($emp->id_employe,$jr,$nt,$fr);
        }
//--------------------------HEURE SUP
        $last = $this->MD_Pointage->getlast($emp->id_employe); 
        $ns =  $this->MD_Pointage->getNight_Sup($emp->id_employe);
        $data['total'] = $ns;
        $this->MD_Pointage->heure_norm($emp,$ns->total_heure);
//--------------------------NUIT
        $this->MD_Pointage->majoration_nuit(4,$emp,$ns,$sh);
//--------------------------DIMANCHE 
        $this->MD_Pointage->majoration_dimanche(5,$emp,$last,$sh);
//--------------------------FERIE = FERIE W
        $fr =   $this->MD_Pointage->getFerie($emp->id_employe);
        $this->MD_Pointage->majoration_ferie(6,7,$emp,$fr,$sh);  
        $data['hn'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),1,$sh);
        $data['hs30'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),2,$sh);
        $data['hs50'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),3,$sh);
        $data['hnuit'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),4,$sh);
        $data['hdim'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),5,$sh);
        $data['hf'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),6,$sh);
        $data['hfw'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),7,$sh);
        $this->viewer('/v_e_total_heure',$data);
    }
    public function fiche_paie(){
        $emp = $this->MD_Employe->getEmploye_utilisateur($_SESSION['user'][0]['id_utilisateur']); 
        $sh = $emp->salaire_semaine/$emp->horaire_semaine;
        $ns =  $this->MD_Pointage->getNight_Sup($emp->id_employe);
        $data['emp'] = $emp;
        $data['hn'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),1,$sh);
        $data['hs30'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),2,$sh);
        $data['hs50'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),3,$sh);
        $data['hnuit'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),4,$sh);
        $data['hdim'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),5,$sh);
        $data['hf'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),6,$sh);
        $data['hfw'] =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),7,$sh);
        $data['montant'] = $this->MD_Horaire_employe->getSum_Montant($sh,$emp->id_employe,date('Y-m-d'));
        //CONDITION INDEMNITE
        $i = $emp->pourcentage_indemnite;
        if( $ns->total_heure <= $emp->horaire_semaine){
            $i = 0;
        }
        $data['indemnite'] = ($data['montant']->montant_total * $i)/100;
        $data['totalP'] = $data['montant']->montant_total + $data['indemnite'];
        $this->MD_Fiche_Paie->insert($emp->id_employe,$data['totalP']);
        $data['total'] = $ns;
        $this->viewer('/v_e_fiche_paie',$data);
    }
    public function fiche_pdf(){
        $emp = $this->MD_Employe->getEmploye_utilisateur($_SESSION['user'][0]['id_utilisateur']); 
        $sh = $emp->salaire_semaine/$emp->horaire_semaine;
        $ns =  $this->MD_Pointage->getNight_Sup($emp->id_employe);
        $emp = $emp;
        $hn =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),1,$sh);
        $hs30 =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),2,$sh);
        $hs50 =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),3,$sh);
        $hnuit =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),4,$sh);
        $hdim =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),5,$sh);
        $hf =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),6,$sh);
        $hfw =  $this->MD_Horaire_employe->getDetail($emp->id_employe, date('Y-m-d'),7,$sh);
        $montant = $this->MD_Horaire_employe->getSum_Montant($sh,$emp->id_employe,date('Y-m-d'));
        //CONDITION INDEMNITE
        $i = $emp->pourcentage_indemnite;
        if( $ns->total_heure <= $emp->horaire_semaine){
            $i = 0;
        }
        $indemnite = ($montant->montant_total * $i)/100;
        $totalP = $montant->montant_total + $indemnite;
        //--PDF
        $this->load->library('Tableau');
        $header = array('Designation', 'total heure (h)', 'taux horaire', 'montant (Ar)');
        $resultats = array();
        $som = 0;
        $pdf = new Tableau();
        $pdf->AddPage();
        $pdf->details($header,$emp,$hn,$hs30,$hs50,$hnuit,$hdim,$hf,$hfw,$montant,$indemnite,$totalP);
        $pdf->Output();
    }
}
