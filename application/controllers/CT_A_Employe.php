<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_A_Employe extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MD_Employe');
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
        $data['stat'] = $this->MD_Fiche_Paie->stat_horaires();
        $data['list'] = $this->MD_Fiche_Paie->list_emp_payer();
		$this->viewer('/v_a_list_employe',$data);
	}		
    public function simple(){
        $data['list'] = $this->MD_Employe->list_employe_cours();
		$this->viewer('/v_a_list_employe_simple',$data);
	}
}
