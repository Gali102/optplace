<?php

class Zayavki extends CI_Controller {

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

		$city_id1 = $this->s_get('city_id1');
		$status_zayavki_id1 = $this->s_get('status_zayavki_id1');
		
		$data['btn_click'] = $this->s_post('add_zayavka');

		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['city_id'] = $this->func->select_city();
		$data['user_name'] = $this->func->select_user_name();
		$data['status_zayavki_id'] = $this->func->select_status_zayavki_name();
		$data['apartment_id'] = $this->func->select_apartment_name_zav();

		$this->form_validation->set_rules('n_date', '', 'max_length[100]');
		$this->form_validation->set_rules('city_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('status_zayavki_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('apartment_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('user_id', '', 'required|max_length[100]');
		
		if ($this->form_validation->run()) {
			//$n_date_tmp = explode('.',$n_date);
			//$n_date = mktime(0,0,0,$n_date_tmp[1],$n_date_tmp[0],$n_date_tmp[2]);
			$n_date = date('d.m.Y');
			$city_id = $this->s_post('city_id');
			$status_zayavki_id = $this->s_post('status_zayavki_id');
			$apartment_id = $this->s_post('apartment_id');
			$user_id = $this->s_post('user_id');

			$data['status'] = $this->func->add_new_zayavki($n_date,$city_id,$status_zayavki_id,$apartment_id,$user_id);
			$data['zayavki'] = $this->func->select_zayavki($city_id1,$status_zayavki_id1);
			$data['users_data'] = $this->func->select_users_data();

			$this->load->view('interface/head');
			$this->load->view('v_zayavki',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$data['zayavki'] = $this->func->select_zayavki($city_id1,$status_zayavki_id1);
			$this->load->view('interface/head');
			$this->load->view('v_zayavki',$data);
			$this->load->view('interface/footer');
		}
	}
	
}
?>