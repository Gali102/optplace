<?php

class c_client extends CI_Controller {

	private $user_id;
	private $user_status;
	
	function __construct() {
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_status = $this->session->userdata('user_status');
		error_reporting(E_ALL);
	}
	
	function index () {
		if (! $this->user_id) {
			 header ("Location: /autoreal/index.php/c_autorize");
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->load->model('m_client');
		$this->load->model('m_add_clients');
		$limit=30;
		$config['base_url'] = site_url("c_client/index");
		$config['total_rows'] = $this->m_client->count_all();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['pag_links'] = $this->pagination->create_links();
		if ($this->uri->segment(3) == '') {
			$offset = 0;
		}
		else {
			$offset = $this->uri->segment(3);
		}
		$data['client_status']=$this->m_add_clients->select_from_client_status ();
		$data['clients']=$this->m_client->select_all_clients ($limit,$offset);
		$this->load->view('interface/head');
		$this->load->view('v_clients',$data);
		$this->load->view('interface/footer');
	}
	
	function select_client ($client_id) {
	if (! $this->user_id) {
			 header ("Location: /autoreal/index.php/c_autorize");
		}
		$this->s_pagination();
		//$this->load->library('form_validation');
		$this->load->model('m_add_clients');
		$data['client_status']=$this->m_add_clients->select_from_client_status ();
		$this->form_validation->set_rules('fname_client', 'ФИО клиента', 'required|max_length[150]|min_length[3]');
		$this->form_validation->set_rules('adress_client', 'Адрес клиента', 'required|max_length[250]|min_length[3]');
		$this->form_validation->set_rules('phone_m_client', '№ Моб. телефона', 'required|numeric|max_length[11]');
		$this->form_validation->set_rules('phone_h_client', '№ Дом. телефона', 'numeric|max_length[11]');
		$this->form_validation->set_rules('phone_j_client', '№ Раб. телефона', 'numeric|max_length[11]');
		$this->form_validation->set_rules('mail_client', 'E-Mail', 'valid_email|max_length[100]');
		$this->form_validation->set_rules('comments_client', 'Комментарии', 'max_length[250]');
		$data['client_id'] = $client_id;
		$this->load->model('m_client');

		
		
		if ($this -> form_validation -> run() == FALSE) {
			$data['status']=' ';
			$data['clients']=$this->m_client->select_client ($client_id);
			$this->load->view('interface/head');
			$this->load->view('v_clients_pers',$data);	
			$this->load->view('interface/footer');
		
		}
		else {
		$fname_client=$this->input->post('fname_client');
		$adress_client=$this->input->post('adress_client');
		$phone_m_client=$this->input->post('phone_m_client');
		$phone_h_client=$this->input->post('phone_h_client');
		$phone_j_client=$this->input->post('phone_j_client');
		$mail_client=$this->input->post('mail_client');
		$status_client=$this->input->post('client_status');
		$comments_client=$this->input->post('comments_client');		
		
		$q=$this->m_client->update_client($client_id, $fname_client, $adress_client, $phone_m_client, $phone_h_client, $phone_j_client, $mail_client, $comments_client, $status_client);
		
		if ($q==TRUE){
					$data['status']='Данные успешно сохранены';
				}
				else {
					$data['status']='ERRORS! Данные не сохранены';
				}
			$data['clients']=$this->m_client->select_client ($client_id);
			$this->load->view('interface/head');
			$this->load->view('v_clients_pers',$data);
			$this->load->view('interface/footer');
		}
		
	}	
	
	function filter($fio,$ts,$phone/*,$balanse*/,$status) {
		if ($fio === '0000000000') {
			$fio = '';
		}
		if ($ts === '0000000000') {
			$ts = '';
		}
		if ($phone === '0000000000') {
			$phone = '';
		}
		/*if ($balanse === '0') {
			$balanse = '';
		}*/
		if ($status === '0') {
			$status = '';
		}
		$this->load->model("m_client");
		$q = $this->m_client->filter($fio,$ts,$phone,/*$balanse,*/$status);
		$result = json_encode($q);
		echo $result;
	}
	
}
?>