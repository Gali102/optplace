<?php

class Glavnaya extends CI_Controller {

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

		$user_id1 = $this->s_get('user_id1');
		$events_status_id1 = $this->s_get('events_status_id1');
		$finished_id1 = $this->s_get('finished_id1');
		
		$data['btn_click'] = $this->s_post('add_event');
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['events_status'] = $this->func->select_event_statuses();
		$data['user_names'] = $this->func->select_user_names();
		$data['finished_id'] = $this->func->select_finished_id();

		// $res = $this->s_pagination('events/index',$this->func->count_all_events($user_names,$events_status),50,3,'?'.http_build_query($_GET));
		
		
		if ($this->form_validation->run()) {
			
			$data['status'] = $this->func->add_new_event($events_status_id,$n_date,$user_id,$comments,$event_name,$event_text,$nach_date,$events_user_id_isp);
			$this->load->view('interface/head');
			$this->load->view('v_glavnaya',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$this->load->view('interface/head');
			$this->load->view('v_glavnaya',$data);
			$this->load->view('interface/footer');
		}
	}
	
	function accept_event() {
		$this->load->model('func');
		$this->load->helper('super_helper');
		$finished = $this->s_post('ref');
		$event_id = $this->s_post('event_id');
		echo $this->func->accept_event($finished,$event_id);
	}
	
}
?>