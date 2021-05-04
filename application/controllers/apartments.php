<?php

class Apartments extends CI_Controller {

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
		$developers_id1 = $this->s_get('developers_id1');
		
		$data['btn_click'] = $this->s_post('add_apartment');

		$data['otdelka_id'] = $this->func->select_otdelka();
		$data['quantity_rooms_id'] = $this->func->select_quantity_rooms();
		$data['price_metr_id'] = $this->func->select_price_metr();
		$data['city_id'] = $this->func->select_city();
		$data['price_id'] = $this->func->select_price();
		$data['finish_year_id'] = $this->func->select_finish_year();
		$data['dolzhnost_id'] = $this->func->select_dolzhnost();
		$data['developers_id'] = $this->func->select_developersss();

		$this->form_validation->set_rules('apartment_name', '', 'required|max_length[100]');
		$this->form_validation->set_rules('apartment_adress', '', 'required|max_length[100]');
		$this->form_validation->set_rules('apartment_ploshad', '', 'required|max_length[100]');
		$this->form_validation->set_rules('developers_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('user_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('finish_year_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('price_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('price_metr_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('city_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('otdelka_id', '', 'required|max_length[100]');
		$this->form_validation->set_rules('quantity_rooms_id', '', 'required|max_length[100]');		
		
		if ($this->form_validation->run()) {
			$apartment_name = $this->s_post('apartment_name');
			$apartment_adress = $this->s_post('apartment_adress');
			$apartment_ploshad = $this->s_post('apartment_ploshad');
			$developers_id = $this->s_post('developers_id');
			$user_id = $this->s_post('user_id');
			$finish_year_id = $this->s_post('finish_year_id');
			$price_id = $this->s_post('price_id');
			$price_metr_id = $this->s_post('price_metr_id');
			$city_id = $this->s_post('city_id');
			$otdelka_id = $this->s_post('otdelka_id');
			$quantity_rooms_id = $this->s_post('quantity_rooms_id');
			
			$data['status'] = $this->func->add_new_apartments($apartment_name,$apartment_adress,$apartment_ploshad,$developers_id,$user_id,$finish_year_id,$price_id,$price_metr_id,$city_id,$otdelka_id,$quantity_rooms_id);
			$data['apartments'] = $this->func->select_apartments($city_id1,$developers_id1);
			$this->load->view('interface/head');
			$this->load->view('v_apartments',$data);
			$this->load->view('interface/footer');
		}
		else {
			$data['status'] = FALSE;
			$data['apartments'] = $this->func->select_apartments($city_id1,$developers_id1);
			$this->load->view('interface/head');
			$this->load->view('v_apartments',$data);
			$this->load->view('interface/footer');
		}
	}
	
}
?>