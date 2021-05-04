<?php

class Events extends CI_Controller {

	private $user_id;
	private $user_status;
	
	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_status = $this->session->userdata('user_status');
		$this->load->model('func');
		$this->load->helper('super_helper');
		$this->load->library('form_validation');
		$this->load->database();
		error_reporting(E_ALL);
	}
	
	function checknoty() {
		$this->s_auth_check($this->user_id);
		$user_id = $this->user_id;

		$events_all_view    = $this->func->select_user_my($user_id)['events_all_view'];
		$event_today_view   = $this->func->select_user_my($user_id)['event_today_view'];
		$event_vazhnoe_view = $this->func->select_user_my($user_id)['event_vazhnoe_view'];
		$mymail_view        = $this->func->select_user_my($user_id)['mymail_view'];

		$a = strtotime(date('Y-m-d'));

		$events_all    = $this->func->q("SELECT * from events where events_user_id_isp = $user_id and abs_date > '$events_all_view'");
		$event_today   = $this->func->q("SELECT * from events where events_user_id_isp = $user_id and abs_date > '$event_today_view' and n_date = '$a'");
		$event_vazhnoe = $this->func->q("SELECT * from events where events_user_id_isp = $user_id and abs_date > '$event_vazhnoe_view' and events_status_id = 1");
		$mymail        = $this->func->q("SELECT * from mail   where poluchatel_id      = $user_id and abs_date > '$mymail_view'");

		$noty = $this->func->q("SELECT * from users where user_id = '$user_id'")[0]['user_noty'];

		$result = [
			'noty'          => $noty,
			'events_all'    => count($events_all) ?: '',
			'event_today'   => count($event_today) ?: '',
			'event_vazhnoe' => count($event_vazhnoe) ?: '',
			'mymail'        => count($mymail) ?: '',
		];

		echo json_encode($result);
		$this->func->qn("UPDATE users SET user_noty = '[]' WHERE user_id = $user_id");
	}

	function index() {
		$this->s_auth_check($this->user_id);
		$user_id = $this->user_id;

		$user_id1 = $this->s_get('user_id1');
		$data['user_id1'] = $this->s_get('user_id1');
		$events_status_id1 = $this->s_get('events_status_id1');
		$data['events_status_id1'] = $this->s_get('events_status_id1');
		$finished_id1 = $this->s_get('finished_id1');
		$data['finished_id1'] = $this->s_get('finished_id1');

		$user_id2 = $this->s_get('user_id2');
		$events_status_id2 = $this->s_get('events_status_id2');
		$finished_id2 = $this->s_get('finished_id2');
		
		$data['btn_click'] = $this->s_post('add_event');
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['events_status'] = $this->func->select_event_statuses();
		$data['user_names'] = $this->func->select_user_names();
		$data['finished_id'] = $this->func->select_finished_id();
		// $data['user_statuses'] = $this->func->select_user_statuses_with_acc($this->user_status);

		$this->form_validation->set_rules('events_status_id', 'Статус', 'required|numeric');
		$this->form_validation->set_rules('n_date', 'Дата контроля', 'required|max_length[10]');
		$this->form_validation->set_rules('user_id', 'Кто задал', 'required|greater_than[0]');
		$this->form_validation->set_rules('comments', 'Комментарий задания', 'max_length[500]');
		$this->form_validation->set_rules('event_name', 'Название задания', 'required|max_length[100]');
		$this->form_validation->set_rules('event_text', 'Текст задания', 'required|max_length[700]');
		$this->form_validation->set_rules('nach_date', 'Начало задания', 'max_length[10]');
		$this->form_validation->set_rules('events_user_id_isp', 'Ответственный', 'required|greater_than[0]');
		// $this->form_validation->set_rules('file', 'Файл', 'required|greater_than[0]');

		if ($this->form_validation->run()) {
			
			$events_status_id = $this->s_post('events_status_id');
			$n_date = $this->s_post('n_date');
			$user_id = $this->s_post('user_id');
			$comments = $this->s_post('comments');
			$event_name = $this->s_post('event_name');
			$event_text = $this->s_post('event_text');
			$nach_date = $this->s_post('nach_date');
			$events_user_id_isp = $this->s_post('events_user_id_isp');
			$file = $this->s_post('file');
			
			$data['status'] = $this->func->add_new_event($events_status_id,$n_date,$user_id,$comments,$event_name,$event_text,$nach_date,$events_user_id_isp);
		}
		else {
			$data['status'] = FALSE;
		}

		$res = $this->s_pagination('events/index',$this->func->count_all_events($data['user_names'],$data['events_status']),15,3,'?'.http_build_query($_GET));
		$data['pag_links'] = $res['pag_links'];

		$data['events1'] = $this->func->select_events1($user_id,$user_id1,$events_status_id1,$finished_id1,$res['limit'],$res['offset']);
		$data['events2'] = $this->func->select_events2($user_id,$user_id1,$events_status_id1,$finished_id1,$res['limit'],$res['offset']);
		$data['events3'] = $this->func->select_events3($user_id,$user_id1,$events_status_id1,$finished_id1,$res['limit'],$res['offset']);
		$data['events4'] = $this->func->select_events4($user_id,$user_id1,$events_status_id1,$finished_id1,$res['limit'],$res['offset']);
		$data['events5'] = $this->func->select_events5($user_id,$user_id1,$events_status_id1,$finished_id1,$res['limit'],$res['offset']);
		$data['events6'] = $this->func->select_events6($user_id,$user_id1,$events_status_id1,$finished_id1,$res['limit'],$res['offset']);
	
		$data['p_events1'] = $this->func->select_events1($user_id,$user_id1,$events_status_id1,$finished_id1,0,0);
		$data['p_events2'] = $this->func->select_events2($user_id,$user_id1,$events_status_id1,$finished_id1,0,0);
		$data['p_events3'] = $this->func->select_events3($user_id,$user_id1,$events_status_id1,$finished_id1,0,0);
		$data['p_events4'] = $this->func->select_events4($user_id,$user_id1,$events_status_id1,$finished_id1,0,0);
		$data['p_events5'] = $this->func->select_events5($user_id,$user_id1,$events_status_id1,$finished_id1,0,0);
		$data['p_events6'] = $this->func->select_events6($user_id,$user_id1,$events_status_id1,$finished_id1,0,0);

		for($i = 1; $i <= 6; $i++) {
			$res = $this->s_pagination('events/index',count($data['p_events' . $i]),15,3,'?'.http_build_query($_GET));
			$data['pag_links' . $i] = $res['pag_links'];
		}
		
		$data['users_data'] = $this->func->select_users_data();

		$this->load->view('interface/head');
		$this->load->view('v_events',$data);
		$this->load->view('interface/footer');
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