<?php

class Vazhnoe extends CI_Controller {

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
		
		$data['btn_click'] = $this->s_post('update_event');
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['events_status_id'] = $this->func->select_event_statuses();
		// $data['user_names'] = $this->func->select_user_names();
		$data['user_id'] = $this->func->select_user_id();
		$data['finished_id'] = $this->func->select_finished_id();

		if ($this->form_validation->run()) {

			$data['status'] = TRUE;
			$this->load->view('interface/head');
			$this->load->view('v_vazhnoe',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$this->load->view('interface/head');
			$this->load->view('v_vazhnoe',$data);
			$this->load->view('interface/footer');
		}
	}
	
}
?>