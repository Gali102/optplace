<?php

class Event extends CI_Controller {

	private $user_id;
	private $user_status;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_status = $this->session->userdata('user_status');
		$this->load->model('func');
		$this->load->helper('super_helper');
		$this->load->library('form_validation');
		error_reporting(E_ALL);
	}
	
	function index($event_id) {
		$this->s_auth_check($this->user_id);
		
		$data['btn_click'] = $this->s_post('update_event');
		if(!$data['btn_click']) {
			$data['btn_click'] = $this->s_post('add_event');
		}
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['events_status_id'] = $this->func->select_event_statuses();
		$data['user_id'] = $this->func->select_user_id();
		$data['finished_id'] = $this->func->select_finished_id();

		$this->form_validation->set_rules('event_name', 'Название задания', 'max_length[100]');
		$this->form_validation->set_rules('events_status_id', 'Статус', 'numeric');
		$this->form_validation->set_rules('n_date', 'Дата контроля', '');
		$this->form_validation->set_rules('user_id', 'Ответственный', 'max_length[15]');		
		$this->form_validation->set_rules('event_text', 'Текст задания', 'max_length[700]');
		$this->form_validation->set_rules('comments', 'Комментарий задания', 'max_length[500]');
		$this->form_validation->set_rules('finished_id', 'Статус задания', 'max_length[200]');

		if($this->s_post('events_user_id_isp')) {
			$this->form_validation->set_rules('events_user_id_isp', 'Ответственный', 'required|greater_than[0]');
		}

		if ($this->form_validation->run()) {
			
			$event_name = $this->s_post('event_name');
			$events_status_id = $this->s_post('events_status_id');
			$n_date = $this->s_post('n_date');
			$user_id = $this->user_id;
			$event_text = $this->s_post('event_text');
			$comments = $this->s_post('comments');
			$finished_id = $this->s_post('finished_id');
			$events_user_id_isp = $this->s_post('events_user_id_isp');
			$file = $this->s_post('file');

			$this->func->update_event($event_id,$event_name,$events_status_id,$n_date,$user_id,$event_text,$comments,$finished_id,$events_user_id_isp);

			$data['status'] = TRUE;
		}
		else {
			$data['status'] = FALSE;
		}

		$res = $this->s_pagination('event/index/' . $event_id,count($this->func->select_events_otvet($event_id,0,0)),30,4,'?'.http_build_query($_GET));
		$data['pag_links'] = $res['pag_links'];
		
		$otvety = $this->func->select_events_otvet($event_id,$res['limit'],$res['offset']);

		$data['users_data'] = $this->func->select_users_data();
		$data['event'] = $this->func->select_event($event_id);
		$data['events_otvet'] = $otvety;
		$this->load->view('interface/head');
		$this->load->view('v_event',$data);
		$this->load->view('interface/footer');
	}
	
	function otvet($event_id) {
		$this->s_auth_check($this->user_id);

		$this->form_validation->set_rules('user_poluch', 'Получатель', 'required|greater_than[0]');
		$this->form_validation->set_rules('otvet_text', 'Текст ответа', 'max_length[5000]');

		if ($this->form_validation->run()) {
			$user_id = $this->user_id;
			$user_poluch = $this->s_post('user_poluch');
			$otvet_text = $this->s_post('otvet_text');

			$this->func->add_events_otvet($event_id,$user_id,$user_poluch,$otvet_text);
			$data['status'] = TRUE;
		}
		else {
			$data['status'] = FALSE;
		}

		header('Location: /index.php/event/index/' . $event_id);
	}

}
?>