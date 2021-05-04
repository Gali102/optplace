<?php

class m_add_clients extends CI_Model {
	
	function __construct () {
		parent::__construct();
		$this->load->database();
	}
	
	function insert_from_clients ($fname_client, $adress_client, $phone_m_client, $phone_h_client, $phone_j_client, $mail_client, $status_client, $comments_client) {
	
		$q1=$this->db->query(" 
			INSERT INTO clients
				(fname, adress, phone_m, phone_h, phone_j, mail, status, comments) 
			VALUES 
				('$fname_client', '$adress_client', '$phone_m_client', '$phone_h_client', '$phone_j_client', '$mail_client', '$status_client', '$comments_client')
		");
		return $q1;
	
	}
	
	function select_from_client_status () {
		$q=$this->db->query("select * from client_status");
		$result=$q->result();
		return $result;
	}
	
	function select_from_status_clients ($user_status) {
		if ($user_status == 1 || $user_status == 2) {
			$q=$this->db->query("select * from status_clients");
		}
		else {
			$q=$this->db->query("select * from status_clients WHERE access=0");
		}
		$result=$q->result();
		return $result;
	}
	
	function insert_from_cars_clients ($brand_car, $model_car, $grz_cars, $year_cars, $doc_insurance_cars, $name_insurance_cars, $fname_s, $fname_v) {
		
		$q2=$this->db->query("
			INSERT INTO cars_clients
				(id_client, brand, model, grz_car, year_car, doc_insurance, name_insurance, fname_s, fname_v)
			VALUES
				((select MAX(id_client) from clients), '$brand_car', '$model_car', '$grz_cars', '$year_cars', '$doc_insurance_cars', '$name_insurance_cars', '$fname_s', '$fname_v' )
		");
		return $q2;
	}
	
}

?>