<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CT_A_Categorie extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('MD_Categorie');
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
        $data['list'] = $this->MD_Categorie->list_categorie();
		$this->viewer('/v_a_list_categorie',$data);
	}		
}
