<?php

class Zayavka extends CI_Controller { 

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
	
	function index($zayavki_id) {
		$this->s_auth_check($this->user_id);
		// $user_id = $this->user_id;

		$data['btn_click'] = $this->s_post('update_zayavka');

		$data['user_id'] = $this->func->select_user_id();
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['city_id'] = $this->func->select_city();
		$data['user_name'] = $this->func->select_user_name();
		$data['status_zayavki_id'] = $this->func->select_status_zayavki_name();
		$data['apartment_id'] = $this->func->select_apartment_name_zav();
		//$data['user_name'] = $this->func->select_user_name();

		$this->form_validation->set_rules('n_date', '', 'max_length[100]');
		$this->form_validation->set_rules('city_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('status_zayavki_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('apartment_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('user_id', '', 'required|max_length[100]');	

		if ($this->form_validation->run()) {
			$n_date = date('d.m.Y');
			$city_id = $this->s_post('city_id');
			$status_zayavki_id = $this->s_post('status_zayavki_id');
			$apartment_id = $this->s_post('apartment_id');
			$user_id = $this->s_post('user_id');

			$this->func->update_zayavka($zayavki_id,$n_date,$city_id,$status_zayavki_id,$apartment_id,$user_id);
			$data['status'] = TRUE;
			//$data['users_data'] = $this->func->select_users_data();
		} 
		else {
			$data['status'] = FALSE;
			//$data['users_data'] = $this->func->select_users_data();
		}

		$data['zayavka'] = $this->func->select_zayavka($zayavki_id);
		$this->load->view('interface/head');
		$this->load->view('v_zayavka',$data);
		$this->load->view('interface/footer');
	}

}
?>