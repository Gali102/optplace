<?php

class Developers extends CI_Controller {

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
		
		$data['btn_click'] = $this->s_post('add_developers');

		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['city_id'] = $this->func->select_city();
		$data['user_name'] = $this->func->select_user_name();

		$this->form_validation->set_rules('developers_name', 'Название', 'required|max_length[330]');
		$this->form_validation->set_rules('city_id', '', 'required|max_length[10]');
		$this->form_validation->set_rules('user_id', '', 'required|max_length[50]');
		$this->form_validation->set_rules('developers_phone', 'Телефон', 'required|max_length[100]');
		$this->form_validation->set_rules('developers_email', 'Почта', 'required|max_length[100]');
		$this->form_validation->set_rules('developers_adress', 'Адрес', 'required|max_length[100]');
		
		if ($this->form_validation->run()) {
			$developers_name = $this->s_post('developers_name');
			$city_id = $this->s_post('city_id');
			$user_id = $this->s_post('user_id');
			$developers_phone = $this->s_post('developers_phone');
			$developers_email = $this->s_post('developers_email');
			$developers_adress = $this->s_post('developers_adress');

			$data['status'] = $this->func->add_new_developers($developers_name,$city_id,$user_id,$developers_phone,$developers_email,$developers_adress);
			$data['developers'] = $this->func->select_developers($city_id1);
			$data['users_data'] = $this->func->select_users_data();

			$this->load->view('interface/head');
			$this->load->view('v_developers',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$data['developers'] = $this->func->select_developers($city_id1);
			$this->load->view('interface/head');
			$this->load->view('v_developers',$data);
			$this->load->view('interface/footer');
		}
	}
	
}
?>