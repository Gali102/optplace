<?php

class Mymail extends CI_Controller {

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
		$user_id = $this->user_id;
		$this->s_auth_check($this->user_id);

		$data['btn_click'] = $this->s_post('add_event');

		$this->form_validation->set_rules('date_otpr', 'Дата контроля', 'max_length[10]');
		$this->form_validation->set_rules('user_id', 'Кто написал', 'required|greater_than[0]');
		$this->form_validation->set_rules('poluchatel_id', 'Кому написанно', 'max_length[500]');
		$this->form_validation->set_rules('name_mail', 'Название сообщения', 'required|max_length[100]');
		$this->form_validation->set_rules('text_mail', 'Текст сообщения', 'required|max_length[700]');
		
		if ($this->form_validation->run()) {
			$date_otpr = $this->s_post('date_otpr');
			$user_id = $this->s_post('user_id');
			$poluchatel_id = $this->s_post('poluchatel_id');
			$name_mail = $this->s_post('name_mail');
			$text_mail = $this->s_post('text_mail');
			
			$data['status'] = $this->func->add_new_mail($date_otpr,$user_id,$poluchatel_id,$name_mail,$text_mail);
			if($this->s_post('back_to')) {
				header('Location: ' . $this->s_post('back_to'));
				die();
			}
		}
		else {
			$data['status'] = FALSE;
		}

		$this->func->qn("UPDATE users SET mymail_view = '" . date('Y-m-d H:i:s') . "' where user_id = '$user_id'");

		$user_id1 = $this->s_get('user_id1');
		$data['user_id1'] = $this->s_get('user_id1');
		$events_status_id1 = $this->s_get('events_status_id1');
		$data['events_status_id1'] = $this->s_get('events_status_id1');
		$finished_id1 = $this->s_get('finished_id1');
		$data['finished_id1'] = $this->s_get('finished_id1');

		$user_id2 = $this->s_get('user_id2');
		$date_otpr2 = $this->s_get('date_otpr2');
		$mail_id2 = $this->s_get('mail_id2');
		$res = $this->s_pagination('mymail/index/',$this->func->count_mail($user_id),15,3,'?'.http_build_query($_GET));
		$data['pag_links'] = $res['pag_links'];
		// $user_id2,$date_otpr2,$mail_id2
		
		$data['user_statuses'] = $this->func->select_user_statuses();
		$data['events_status'] = $this->func->select_event_statuses();
		$data['user_names'] = $this->func->select_user_names();
		$data['finished_id'] = $this->func->select_finished_id();

		$data['allmy'] = $this->func->select_mail_allmy($user_id,$res['limit'],$res['offset']);

		$this->load->view('interface/head');
		$this->load->view('v_mymail',$data);
		$this->load->view('interface/footer');
	}
	
	function change_mail() {
		echo $this->func->change_pass($user_id);
	}

	function change_mail1() {
		echo $this->func->change_pass($user_id);
	}

}
?>