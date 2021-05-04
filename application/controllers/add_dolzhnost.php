<?php

class Add_dolzhnost extends CI_Controller {

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
		
		$data['btn_click'] = $this->s_post('add_dol');
		
		$data['user_statuses'] = $this->func->select_user_statuses();
		
		$this->form_validation->set_rules('dolzhnost_name', 'Название должностей', 'required|max_length[130]');
		
		if ($this->form_validation->run()) {
			$dolzhnost_name = $this->s_post('dolzhnost_name');
			
			$data['status'] = $this->func->add_new_dolzhnosts($dolzhnost_name);
			$data['dolzhnost_name'] = $this->func->select_dolzhnosts();
			$this->load->view('interface/head');
			$this->load->view('v_add_dolzhnost',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$data['dolzhnost_name'] = $this->func->select_dolzhnosts();
			$this->load->view('interface/head');
			$this->load->view('v_add_dolzhnost',$data);
			$this->load->view('interface/footer');
		}
	}
	
}
?>