<?php

class Chat extends CI_Controller {

	private $user_id;
	private $user_status;
	private $chat_view;
	
	function __construct() {
		parent::__construct();
		$this->user_id =     $this->session->userdata('user_id');
		$this->user_status = $this->session->userdata('user_status');
		$this->chat_view =   $this->session->userdata('chat_view');
		$this->load->model('func');
		$this->load->helper('super_helper');
		$this->load->database();
		error_reporting(E_ALL);
	}
	
	function index() {
		$this->s_auth_check($this->user_id);
        $user_id = $this->user_id;

		$this->func->qn("UPDATE users SET chat_view = '" . date('Y-m-d H:i:s') . "' where user_id = '$user_id'");

		$data = [];
		$data['users_data'] = $this->func->select_users_data();

        $this->load->view('interface/head');
        $this->load->view('v_chat', $data);
        $this->load->view('interface/footer');
    }

    function getchat() {
		$this->s_auth_check($this->user_id);
        $user_id = $this->user_id;
		$chat_view = $user_id ? $this->func->select_user_my($user_id)['chat_view'] : '';

        $date = $this->s_post('date');
        $page = $this->s_post('page');

		$poluch_id = $this->s_post('poluch_id');

		$offChatWhere = "";
		$poluchWhere = "";
		if(!preg_match('/chat/', $page)) {
			$offChatWhere = "and date > '$chat_view' and user_id <> $user_id";
		}
		elseif($poluch_id) {
			$poluchWhere = "and ((poluch_id = $poluch_id and user_id = $user_id) or (user_id = $poluch_id and poluch_id = $user_id))";
		}
		else {
			$poluchWhere = "and poluch_id = $poluch_id";
		}
 
		$sql = "SELECT user_id, poluch_id, text, date from chat
			where date > '$date'
			$poluchWhere
			$offChatWhere
			order by date desc limit 100";

		$q = $this->db->query($sql);
		$result = $q->result();

		$this->func->qn("UPDATE users SET online = '" . date('Y-m-d H:i:s') . "' where user_id = '$user_id'");

		foreach($result as &$row) {
			$row->date_print = date('H:i:s d.m', strtotime($row->date . ' +2 hours'));
			$row->text = nl2br($row->text);
			$row->user_name = $row->user_id ? $this->func->select_user_my($row->user_id)['user_name'] : '';
		}

		$result = array_reverse($result);

		echo json_encode($result);
	}

	function getdialogs() {
		$this->s_auth_check($this->user_id);
		$user_id = $this->user_id;

		$sql = "SELECT user_id, poluch_id, text, date from chat
			where (user_id = $user_id or poluch_id = $user_id) and poluch_id <> 0
			order by date desc";

		$q = $this->db->query($sql);
		$result = $q->result();

		$with = 0;
		foreach($result as &$row) {
			$row->date_print = date('H:i:s d.m', strtotime($row->date . ' +2 hours'));
			$row->text = nl2br($row->text);
			$row->user_name = $row->user_id ? $this->func->select_user_my($row->user_id)['user_name'] : '';
			$row->poluch_name = $row->poluch_id ? $this->func->select_user_my($row->poluch_id)['user_name'] : '';

			if($row->poluch_id != $user_id) {
				$with = $row->poluch_id;
			}
			if($row->user_id != $user_id) {
				$with = $row->user_id;
			}

			$row->with_id = $with;
			$row->with_name = $with ? $this->func->select_user_my($with)['user_name'] : '';
		}

		echo json_encode($result);
    }
	
	function getusers() {
		$this->s_auth_check($this->user_id);

		$q = $this->db->query("SELECT users.user_id, user_name, online, user_status_maj, user_status_name
			from users
			left join user_statuses
			on user_statuses.user_status_id = users.user_status_id
			order by online desc");
		$result = $q->result();

		foreach($result as &$row) {
			$row->online_print = date('H:i:s d.m', strtotime($row->online . ' +2 hours'));
		}

		echo json_encode($result);
	}
	
    function post() { 
		$this->s_auth_check($this->user_id);
        $user_id = $this->user_id;
        $poluch_id = $this->s_post('poluch_id');

		$text = $this->s_post('text');
		$text = strip_tags($text, '<img>');
		//$text = htmlspecialchars($text);
		$text = trim($text);

		$result = $this->func->qn("INSERT INTO chat (user_id, poluch_id, text)
			VALUES ('$user_id', '$poluch_id', '$text')");

		$match = [];
		preg_match('/@(\S+)/u', $text, $match);

		if(@$match[1]) {
			$reply_name = preg_replace('/_/', ' ', $match[1]);
			$reply_name = preg_replace('/[,.?!]$/', '', $reply_name);

			$q = $this->db->query("select * from users where user_name = '$reply_name'");
			$user = $q->result();

			
			if($user) {
				$user = $user[0];
				$noty = "Вас ждут <a href=/index.php/chat/index>в чате</a> (" . date('H:i:s') . ")"; 
				$this->func->add_noty($user->user_id, $noty);
			}
		}

		echo 'ok';
    }

}