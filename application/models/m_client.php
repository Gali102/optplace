<?php

class m_client extends CI_Model {
	
	function __construct () {
		parent::__construct();
		$this->load->database();
	}
	function count_all() {
		return $this->db->query("SELECT clients.id_client, fname, grz_car, adress, phone_m, phone_h, phone_j, mail, name, comments
				FROM clients 
				LEFT JOIN client_status
				ON clients.status=client_status.id
				LEFT JOIN cars_clients
				ON cars_clients.id_client=clients.id_client")->num_rows;
	}
	
	function select_all_clients ($limit,$offset) {
		$q=$this->db->query("
				SELECT clients.id_client, fname, grz_car, adress, phone_m, phone_h, phone_j, mail, name, comments
				FROM clients 
				LEFT JOIN client_status
				ON clients.status=client_status.id
				LEFT JOIN cars_clients
				ON cars_clients.id_client=clients.id_client
				LIMIT $offset,$limit
			");
		$result=$q->result();
		return $result;	
	}
	
	function select_client ($client_id) {
		$q=$this->db->query ("
				SELECT id_client, fname, adress, phone_m, phone_h, phone_j, mail, status, name, comments
				FROM clients JOIN client_status
				ON clients.status=client_status.id
				WHERE id_client=$client_id
				ORDER BY fname
		");
		$result=$q->result();
		return $result;
	}

		function update_client ($client_id, $fname_client, $adress_client, $phone_m_client, $phone_h_client, $phone_j_client, $mail_client, $comments_client, $status_client) {
		$q=$this->db->query ("
			UPDATE clients 
			SET fname='$fname_client', adress='$adress_client', phone_m='$phone_m_client',
			phone_h='$phone_h_client', phone_j='$phone_j_client',
			mail='$mail_client', comments='$comments_client',
			status = '$status_client'
			WHERE id_client='$client_id'
		");
		$result=$q;
		return $result;		
		}
		
	function filter($fio,$ts,$phone,/*$balanse,*/$status) {
		$fio = urldecode($fio);
		$ts = urldecode($ts);
		$phone = urldecode($phone);
		$q = $this->db->query("SELECT clients.id_client,comments,fname,grz_car,adress,phone_m,mail,client_status.name,client_status.id
							   FROM clients, cars_clients, client_status
							   WHERE clients.id_client = cars_clients.id_client
							   AND clients.status = client_status.id
							   AND fname like '%$fio%'
							   AND grz_car like '%$ts%'
							   AND (phone_m like '%$phone%' OR phone_j like '%$phone%' OR phone_h like '%$phone%')
							   AND clients.status like '%$status%'");
		$result = $q->result();
		return $result;
	}
}
?>