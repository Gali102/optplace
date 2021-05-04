<?php

class Add_otd extends CI_Controller {

	private $user_id;
	private $user_status;
	
	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_status = $this->session->userdata('user_status');
		$this->load->model('func');
		$this->load->helper('super_helper');
		$this->load->library('form_validation');
		error_reporting(E_ALL);
	}
	
	function index() {
		$this->s_auth_check($this->user_id);
		
		$data['btn_click'] = $this->s_post('add_org');
		
		$data['user_statuses'] = $this->func->select_user_statuses();
		
		$this->form_validation->set_rules('otdel_name', 'Название отдела', 'required|max_length[130]');
		
		if ($this->form_validation->run()) {
			$otdel_name = $this->s_post('otdel_name');
			
			$data['status'] = $this->func->add_new_otdel($otdel_name);
			$data['otdel_name'] = $this->func->select_otdels();
			$this->load->view('interface/head');
			$this->load->view('v_add_otd',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$data['otdel_name'] = $this->func->select_otdels();
			$this->load->view('interface/head');
			$this->load->view('v_add_otd',$data);
			$this->load->view('interface/footer');
		}
	}
	
	function change_pass() {
		$otdel_name = $this->s_post('otdel_name');
		echo $this->func->change_pass($otdel_name);
	}
	
}
?>