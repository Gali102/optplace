<?php

class Profil extends CI_Controller { 

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
	
	function index($user_id) {
		$this->s_auth_check($this->user_id);
		// $user_id = $this->user_id;

		$data['btn_click'] = $this->s_post('update_user');
		// $data['btn_click'] = $this->s_post('update_user2');
		$data['user_status_id'] = $this->func->select_user_statuses();
		$data['otdel_id'] = $this->func->select_user_otdel_statuses();
		$data['dolzhnost_id'] = $this->func->select_dolzhnost();

		if($this->s_post('user_name')) {
			$this->form_validation->set_rules('user_name', 'ФИО пользователя', 'required|max_length[130]');
		}

		if($this->s_post('user_status_id')) {
			$this->form_validation->set_rules('user_status_id', 'Статус', 'required|greater_than[0]');
		}
		if($this->s_post('user_login')) {
			$this->form_validation->set_rules('user_login', 'Логин', 'required|max_length[15]');
		}
		if($this->s_post('otdel_id')) {
			$this->form_validation->set_rules('otdel_id', 'Организация', 'required|greater_than[0]');
		}
		if($this->s_post('dolzhnost_id')) {
			$this->form_validation->set_rules('dolzhnost_id', 'Должность', 'required|greater_than[0]');
		}

		$this->form_validation->set_rules('user_telephon','Номер телефона','max_length[100]');
		$this->form_validation->set_rules('user_email', 'Email', 'max_length[100]');

		if ($this->form_validation->run()) {
			$user_name = $this->s_post('user_name');
			$user_status_id = $this->s_post('user_status_id');
			$user_login = $this->s_post('user_login');
			$otdel_id = $this->s_post('otdel_id');
			$dolzhnost_id = $this->s_post('dolzhnost_id');
			$user_telephon = $this->s_post('user_telephon');
			$user_email = $this->s_post('user_email');

			$this->func->update_profil($user_id,$user_name,$user_status_id,$user_login,$otdel_id,$dolzhnost_id,$user_telephon,$user_email);
			$data['status'] = TRUE;
		} 
		else {
			$data['status'] = FALSE;
		}

		$data['users'] = $this->func->select_profil($user_id);
		$this->load->view('interface/head');
		$this->load->view('v_profil',$data);
		$this->load->view('interface/footer');
	}

}
?>