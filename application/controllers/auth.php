<?php
	class Auth extends CI_Controller {
		function __construct() {
			parent::__construct();
			error_reporting(E_ALL);
		}
	
		function index() {
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('auth_login','Логин','required');
			$this->form_validation->set_rules('auth_pass','Пароль','required');
			if ($this->form_validation->run() == FALSE) {
				$data['auth_error'] = '';
				$this->load->view('interface/head_sign');
				$this->load->view('v_auth',$data);
				// $this->load->view('interface/footer');
			}
			else {
				$auth_login = $this->input->post('auth_login');
				$auth_pass = $this->input->post('auth_pass');
				$this->load->model('func');
				$result = $this->func->check_auth($auth_login,$auth_pass);
				if ($result == false) {
					$data['auth_error'] = 'Вы ввели неправильный логин или пароль';
					$this->load->view('interface/head_sign');
					$this->load->view('v_auth',$data);
					// $this->load->view('interface/footer');
				}
				else {
					$this->session->set_userdata('user_id',$result['user_id']);
					$this->session->set_userdata('user_status',$result['user_status_id']);
					$this->session->set_userdata('user_status_maj',$result['user_status_maj']);
					$this->session->set_userdata('user_name',$result['user_name']);
					header("Location: /index.php/glavnaya "); 
					// /index.php/events
				}
			}
		}
		
		function user_exit() {
			$this->session->set_userdata('user_id','');
			unset($_SESSION);
			$this->session->sess_destroy();
			header("Location: /index.php/auth"); 
		}
	}
?>
