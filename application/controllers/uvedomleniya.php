<?php

class Uvedomleniya extends CI_Controller {

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
		$user_id = $this->user_id;
		
		$user_id1 = $this->s_get('user_id1');
		$events_status_id1 = $this->s_get('events_status_id1');
		$finished_id1 = $this->s_get('finished_id1');
		
		$data['btn_click'] = $this->s_post('add_event');
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['events_status'] = $this->func->select_event_statuses();
		$data['user_names'] = $this->func->select_user_names();
		$data['finished_id'] = $this->func->select_finished_id();

		// $res = $this->s_pagination('events/index',$this->func->count_all_events($user_names,$events_status),50,3,'?'.http_build_query($_GET));
		
		$this->form_validation->set_rules('events_status_id', 'Статус', 'required|numeric');
		$this->form_validation->set_rules('n_date', 'Дата контроля', 'required|max_length[10]');
		$this->form_validation->set_rules('user_id', 'Ответственный', 'required|greater_than[0]');
		$this->form_validation->set_rules('comments', 'Комментарий задания', 'max_length[500]');
		$this->form_validation->set_rules('event_name', 'Название задания', 'required|max_length[100]');
		$this->form_validation->set_rules('event_text', 'Текст задания', 'required|max_length[700]');
		$this->form_validation->set_rules('nach_date', 'Начало задания', 'max_length[10]');
		
		if ($this->form_validation->run()) {
			
			$events_status_id = $this->s_post('events_status_id');
			$n_date = $this->s_post('n_date');
			$user_id = $this->s_post('user_id');
			$comments = $this->s_post('comments');
			$event_name = $this->s_post('event_name');
			$event_text = $this->s_post('event_text');
			$nach_date = $this->s_post('nach_date');
			
			$data['status'] = $this->func->add_new_event($events_status_id,$n_date,$user_id,$comments,$event_name,$event_text,$nach_date);
			$data['events11'] = $this->func->select_mail1($user_id);
			$data['events1'] = $this->func->select_events_all_1($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events2'] = $this->func->select_events_all_2($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events3'] = $this->func->select_events_all_3($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events4'] = $this->func->select_events_all_4($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events5'] = $this->func->select_events_all_5($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events6'] = $this->func->select_events_all_6($user_id,$user_id1,$events_status_id1,$finished_id1);
			$this->load->view('interface/head');
			$this->load->view('v_uvedomleniya',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$data['events11'] = $this->func->select_mail1($user_id);
			$data['events1'] = $this->func->select_events_all_1($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events2'] = $this->func->select_events_all_2($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events3'] = $this->func->select_events_all_3($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events4'] = $this->func->select_events_all_4($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events5'] = $this->func->select_events_all_5($user_id,$user_id1,$events_status_id1,$finished_id1);
			$data['events6'] = $this->func->select_events_all_6($user_id,$user_id1,$events_status_id1,$finished_id1);
			$this->load->view('interface/head');
			$this->load->view('v_uvedomleniya',$data);
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
