<?php

class Mymail1 extends CI_Controller {

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
	
	function index($mail_id) {
		$this->s_auth_check($this->user_id);
		
		$data['btn_click'] = $this->s_post('update_event');
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['events_status_id'] = $this->func->select_event_statuses();
		$data['user_id'] = $this->func->select_user_id();
		$data['finished_id'] = $this->func->select_finished_id();
		$data['user_names'] = $this->func->select_user_names();



		// $this->form_validation->set_rules('event_text1', 'Текст задания', 'max_length[500]');
		// $this->form_validation->set_rules('comments1', 'Комментарий задания', 'max_length[200]');

		if ($this->form_validation->run()) {
			
			$event_name = $this->s_post('event_name');
			$events_status_id = $this->s_post('events_status_id');
			$n_date = $this->s_post('n_date');
			$user_id = $this->s_post('user_id');
			$event_text = $this->s_post('event_text');
			$comments = $this->s_post('comments');
			$finished_id = $this->s_post('finished_id');
			$events_user_id_isp = $this->s_post('events_user_id_isp');
			$data['status'] = TRUE;
		}
		else {
			$data['status'] = FALSE;
		}
		$data['mymail1'] = $this->func->select_mymail1($mail_id);
		$this->load->view('interface/head');
		$this->load->view('v_mymail1',$data);
		$this->load->view('interface/footer');
	}
	
}
?>