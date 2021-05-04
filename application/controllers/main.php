<?php 
	class Main extends CI_Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			$btn = $this->s_post("apply_submit");
			$data['btn'] = $btn;
			$data['status'] = FALSE;
			if ($btn) {
				$client_fio = $this->s_post("client_fio");
				$client_tel = $this->s_post("client_tel");
				$client_adress= $this->s_post("client_adress");
				/*$difficulty = $this->input->post("difficulty");
				$extend = $this->input->post("extend");*/
				$description = $this->s_post("description");
				/*$cost = $this->input->post("cost");*/
				$this->load->model('model');
				$this->model->add_request($client_tel,$description);
				$data['status'] = $this->model->add_client($client_fio,$client_tel,$client_adress);
			}
			$this->load->view('interface/header');
			$this->load->view('main',$data);
			$this->load->view('interface/footer');
			
		}
	
	}
?>