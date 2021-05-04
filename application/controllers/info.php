<?php

class Info extends CI_Controller {

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

		$user_status_id1 = $this->s_get('user_status_id1');
		$otdel_id1 = $this->s_get('otdel_id1');
		$dolzhnost_id1 = $this->s_get('dolzhnost_id1');

		
		$data['btn_click'] = $this->s_post('add_user');
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['otdel_id'] = $this->func->select_user_otdel_statuses();
		$data['dolzhnost_id'] = $this->func->select_dolzhnost();

		// $res = $this->s_pagination('users/index',$this->func->count_users($user_status_id,$otdel_id,$dolzhnost_id),30,3,'?'.http_build_query($_GET));

		$this->form_validation->set_rules('user_name', 'ФИО пользователя', 'required|max_length[130]');
		$this->form_validation->set_rules('user_status_id', 'Статус', 'required|numeric');
		$this->form_validation->set_rules('user_login', 'Логин', 'required|max_length[50]|is_unique[users.user_login]');
		$this->form_validation->set_rules('user_pass', 'Пароль', 'required|max_length[100]');
		$this->form_validation->set_rules('otdel_id', '', 'required|max_length[10]');
		$this->form_validation->set_rules('dolzhnost_id', '', 'required|max_length[15]');
		
		if ($this->form_validation->run()) {
			$user_name = $this->s_post('user_name');
			$user_status_id = $this->s_post('user_status_id');
			$user_login = $this->s_post('user_login');
			$user_pass = $this->s_post('user_pass');
			$otdel_id = $this->s_post('otdel_id');
			$dolzhnost_id = $this->s_post('dolzhnost_id');
			
			$data['status'] = $this->func->add_new_user($user_name,$user_status_id,$user_login,$user_pass,$otdel_id,$dolzhnost_id);
			$data['users'] = $this->func->select_users($user_status_id1,$otdel_id1,$dolzhnost_id1);
			$this->load->view('interface/head');
			$this->load->view('v_info',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$data['users'] = $this->func->select_users($user_status_id1,$otdel_id1,$dolzhnost_id1);
			$this->load->view('interface/head');
			$this->load->view('v_info',$data);
			$this->load->view('interface/footer');
		}
	}
	
}
?>