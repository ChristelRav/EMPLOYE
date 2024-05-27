<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_Accueil extends CI_Controller {
	public function __construct() {
        parent::__construct();
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
        $this->viewer('/v_a_accueil',array());
	}		
}
