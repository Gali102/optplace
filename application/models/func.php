<?php

class Func extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/* упрощение доступа к функциям */

	function escape($query) {
		return $this->db->real_escape_string($query);
	}

	function q($query) {
		return $this->db->query($query)->result_array();
	}
	
	function q_one($query) {
		return $this->db->query($query)->row_array();
	}
	
	function qn($query) {
		return $this->db->query($query);
	}
	
	function q_count($query) {
		return $this->db->query($query)->num_rows();
	}
	
	function fil_input($name,$input) {
		if ($input) {
			return " AND $name like '%$input%' ";
		}
	}
	
	function fil_sel($name,$sel) {
		if (! is_numeric($sel)) return;
		if ($sel) {
			return " AND $name='$sel' ";
		}
	}
	
	function fil_date($name,$date,$date_end = false) {
		if (! $date) {
			$date = 0;
		}
		else {
			$w = explode('.',$date);
			$date = mktime(0,0,0,$w[1],$w[0],$w[2]);
		}
		if (! $date_end) {
			$date_end = 99999999999;
		}
		else {
			$e = explode('.',$date_end);
			$date_end = mktime(0,0,0,$e[1],$e[0],$e[2]);
		}
		return " AND $name between $date and $date_end ";
	}
	
	function limit($limit,$offset) {
		if($limit) {
			return " LIMIT $limit OFFSET $offset ";
		}
		else {
			return " ";
		}
	}	

	function check_auth($auth_login,$auth_pass) {
		$str = md5($auth_pass);
		$q = "SELECT * FROM users
			LEFT JOIN user_statuses
			ON users.user_status_id = user_statuses.user_status_id
									WHERE user_login = '$auth_login'
									AND user_pass = '$str'
									LIMIT 1";
		if ($this->q_count($q) === 1) {
			return $this->q_one($q);
		}
		else {
			return false;
		}
	}	

	function arrayMultiSort($array, $args = []) {
		usort(
			$array, function($a, $b) use ($args) {
				$res = 0;

				$a = (object)$a;
				$b = (object)$b;

				foreach($args as $k => $v) {
					if($a->$k == $b->$k) {
						continue;
					}

					$res = ($a->$k < $b->$k) ? -1 : 1;
					if($v == 'desc') {
						$res = -$res;
					}
					break;
				}

				return $res;
			}
		);

		return $array;
	}

	/* функции выборки */

	function select_events_otvet($event_id,$limit,$offset) {
		return $this->q("SELECT *
						FROM events_otvet
						WHERE event_id = '$event_id'
						ORDER BY izm_date DESC
						" . ($limit ? "LIMIT $limit OFFSET $offset" : ""));
	}
			
	function select_user_names() {
		return $this->q("SELECT user_id,user_name,users.user_status_id,user_status_maj FROM users
			LEFT JOIN user_statuses
			ON users.user_status_id = user_statuses.user_status_id");
	}

	function select_user_name() {
		return $this->q("SELECT user_name FROM users
			LEFT JOIN developers
			ON users.user_id = developers.user_id");
	}
	
	function select_profil($user_id) {
		return $this->q("SELECT *
							FROM users
							JOIN user_statuses ON users.user_status_id = user_statuses.user_status_id
							JOIN otdel ON users.otdel_id = otdel.otdel_id
							JOIN dolzhnost ON users.dolzhnost_id = dolzhnost.dolzhnost_id
							WHERE users.user_id = '$user_id'
							");
	} 

	function select_developer($developers) {
		return $this->q("SELECT *
							FROM developers
							JOIN users ON users.user_id = developers.user_id
							JOIN city ON city.city_id = developers.city_id
							WHERE developers.developers_id = '$developers'
							");
	} 

	function select_apartment($apartment_id) {
		return $this->q("SELECT *
							FROM apartment
							WHERE apartment.apartment_id = '$apartment_id'
							");
	} 

	function select_zayavka($zayavki_id) {
		return $this->q("SELECT *
							FROM zayavki
							WHERE zayavki.zayavki_id = '$zayavki_id'
							");
	} 

	function select_info_users($user_id) {
		return $this->q("SELECT *
							FROM users
							JOIN user_statuses ON users.user_status_id = user_statuses.user_status_id
							JOIN otdel ON users.otdel_id = otdel.otdel_id
							JOIN dolzhnost ON users.dolzhnost_id = dolzhnost.dolzhnost_id
							WHERE users.user_id = '$user_id'
							");
	} 

	function count_infos($user_id) {
		return [
			1 => $this->q("SELECT count(finished_id) as count
							FROM events
							WHERE events.events_user_id_isp = '$user_id' AND finished_id = '1'
			")[0]['count'],
			2 => $this->q("SELECT count(finished_id) as count
							FROM events
							WHERE events.events_user_id_isp = '$user_id' AND finished_id = '2'
			")[0]['count'],
			3 => $this->q("SELECT count(finished_id) as count
							FROM events
							WHERE events.events_user_id_isp = '$user_id' AND finished_id = '3'
			")[0]['count'],
			4 => $this->q("SELECT count(finished_id) as count
							FROM events
							WHERE events.events_user_id_isp = '$user_id' AND finished_id = '4'
			")[0]['count'],
			5 => $this->q("SELECT count(finished_id) as count
							FROM events
							WHERE events.events_user_id_isp = '$user_id' AND finished_id = '5'
			")[0]['count'],
		];
	}

	function select_event($event_id) {
		return $this->q("SELECT *
							FROM users 
							JOIN events ON events.events_user_id_isp = users.user_id
							JOIN finished ON events.finished_id = finished.finished_id
							WHERE events.event_id = '$event_id'
							");
	} 

	function select_user_events($user_id) {
		$q = "SELECT *
				FROM events 
				LEFT JOIN events_status ON events.events_status_id = events_status.events_status_id
				WHERE events.events_user_id_isp = $user_id
				and finished_id = 1
				ORDER BY events.n_date DESC ";

		return $this->q($q);
	}
	
	function select_event_statuses() {
		return $this->q("SELECT events_status_id,events_status_name
							FROM events_status");
	}	

	function select_finished_id() {
		return $this->q("SELECT finished_id,finished_name
							FROM finished");
	}	
	
	function select_user_statuses() {
		return $this->q("SELECT user_status_id,user_status_name
							FROM user_statuses");
	}

	function select_user_otdel_statuses() {
		return $this->q("SELECT otdel_id,otdel_name
							FROM otdel");
	}

	function select_developersss() {
		return $this->q("SELECT developers_id,developers_name
							FROM developers");
	}

	function select_dolzhnost() {
		return $this->q("SELECT dolzhnost_id,dolzhnost_name
							FROM dolzhnost");
	}

	function select_otdelka() {
		return $this->q("SELECT otdelka_id,otdelka_name
							FROM otdelka");
	}

	function select_quantity_rooms() {
		return $this->q("SELECT quantity_rooms_id,quantity_rooms_name
							FROM quantity_rooms");
	}

	function select_price_metr() {
		return $this->q("SELECT price_metr_id,price_metr_name
							FROM price_metr");
	}

	function select_price() {
		return $this->q("SELECT price_id,price_name
							FROM price");
	}

	function select_city() {
		return $this->q("SELECT city_id,city_name
							FROM city");
	}

	function select_status_zayavki_name() {
		return $this->q("SELECT status_zayavki_id,status_zayavki_name
							FROM status_zayavki");
	}

	function select_apartment_name_zav() {
		return $this->q("SELECT apartment_id,apartment_name
							FROM apartment");
	}

	function select_finish_year() {
		return $this->q("SELECT finish_year_id,finish_year_name
							FROM finish_year");
	}

	function select_user_id() {
		return $this->q("SELECT user_id,user_name
							FROM users");
	}

	function select_users_data() {
		$result = $this->q("SELECT * FROM users");
		$users = [];
		foreach($result as $row) {
			$users[$row['user_id']] = $row;
		}
		return $users;
	}

	function select_user_my($user_id) {
		$result = $this->q("SELECT * FROM users where user_id = '$user_id'")[0];
		return $result;
	}

	function select_users($user_status_id1,$otdel_id1,$dolzhnost_id1) {
		$q = "SELECT *
							FROM users
							JOIN user_statuses ON user_statuses.user_status_id = users.user_status_id
							JOIN otdel ON otdel.otdel_id = users.otdel_id
							JOIN dolzhnost ON dolzhnost.dolzhnost_id = users.dolzhnost_id";
		$q .= $this->fil_sel('users.user_status_id',$user_status_id1);
		$q .= $this->fil_sel('users.otdel_id',$otdel_id1);
		$q .= $this->fil_sel('users.dolzhnost_id',$dolzhnost_id1);
		
		return $this->q($q);
	}

	function select_developers($city_id1) {
		$q = "SELECT *
							FROM developers
							JOIN users ON users.user_id = developers.user_id
							JOIN city ON city.city_id = developers.city_id";
		$q .= $this->fil_sel('developers.city_id',$city_id1);
		
		return $this->q($q);
	}

	function select_zayavki($city_id1,$status_zayavki_id1) {
		$q = "SELECT zayavki.zayavki_id, zayavki.n_date, status_zayavki.status_zayavki_name, apartment.apartment_name, users.user_name, city.city_name 
							FROM zayavki
							JOIN status_zayavki ON status_zayavki.status_zayavki_id = zayavki.status_zayavki_id
							JOIN apartment ON apartment.apartment_id = zayavki.apartment_id
							JOIN users ON users.user_id = zayavki.user_id
							JOIN city ON city.city_id = zayavki.city_id";
		$q .= $this->fil_sel('zayavki.city_id',$city_id1);
		$q .= $this->fil_sel('zayavki.status_zayavki_id',$status_zayavki_id1);
		
		return $this->q($q);
	}

	function select_apartments($city_id1,$developers_id1) {
		$q = "SELECT apartment.apartment_id, apartment.apartment_name, developers.developers_name, users.user_name, city.city_name, price.price_name, apartment.apartment_ploshad 
							FROM apartment
							JOIN developers ON apartment.developers_id = developers.developers_id
							JOIN users ON apartment.user_id = users.user_id
							JOIN city ON apartment.city_id = city.city_id
							JOIN price ON apartment.price_id = price.price_id
							";
		$q .= $this->fil_sel('apartment.city_id',$city_id1);
		$q .= $this->fil_sel('apartment.developers_id',$developers_id1);
		
		return $this->q($q);
	}


							//JOIN developers ON developers.developers_id = apartment.developers_id


	function select_otdels() {
		return $this->q("SELECT otdel_name
							FROM otdel");
	}

	function select_dolzhnosts() {
		return $this->q("SELECT dolzhnost_name
		 				 FROM dolzhnost");
	}

	/* выборка почты */

	function select_mymail1($mail_id) {
		return $this->q("SELECT *
							FROM mail 
							LEFT JOIN users ON users.user_id = mail.user_id
							WHERE mail.mail_id = '$mail_id'
							");
	}

	function select_mail_allmy($user_id, $limit = 15, $offset = 0) {
		$sql = "SELECT * FROM mail LEFT JOIN users
			ON users.user_id = mail.poluchatel_id
			WHERE mail.poluchatel_id = $user_id OR mail.user_id = $user_id
			ORDER BY mail_id desc
			LIMIT $limit OFFSET $offset";
		$result1 = $this->q($sql);

		$sql = "SELECT * FROM mail LEFT JOIN users
			ON users.user_id = mail.user_id
			WHERE mail.poluchatel_id = $user_id OR mail.user_id = $user_id
			ORDER BY mail_id desc
			LIMIT $limit OFFSET $offset";
		$result2 = $this->q($sql); 

		$result = [];
		foreach($result1 as $i => &$unit) {
			$dir = $unit['poluchatel_id'] == $user_id ? 1 : 0;
			if($dir) {
				$unit['user_name'] = $result2[$i]['user_name'];
			}
			$unit['dir'] = $dir;
			$result[] = $unit;
		}
		return $result;
	}

	/* выборка событий */

	function select_events1($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT *
							FROM users
							JOIN events ON users.user_id = events.events_user_id_isp
							JOIN events_status ON events.events_status_id = events_status.events_status_id
							JOIN finished ON events.finished_id = finished.finished_id";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events2($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
							FROM users
							JOIN events ON users.user_id = events.events_user_id_isp
							JOIN events_status ON events.events_status_id = events_status.events_status_id
							JOIN finished ON events.finished_id = finished.finished_id";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events3($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
							FROM users
							JOIN events ON users.user_id = events.events_user_id_isp
							JOIN events_status ON events.events_status_id = events_status.events_status_id
							JOIN finished ON events.finished_id = finished.finished_id
							WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events4($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT *
							FROM users
							JOIN events ON users.user_id = events.events_user_id_isp
							JOIN events_status ON events.events_status_id = events_status.events_status_id
							JOIN finished ON events.finished_id = finished.finished_id
							WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events5($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
							FROM users
							JOIN events ON users.user_id = events.events_user_id_isp
							JOIN events_status ON events.events_status_id = events_status.events_status_id
							JOIN finished ON events.finished_id = finished.finished_id
							WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events6($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
							FROM users
							JOIN events ON users.user_id = events.events_user_id_isp
							JOIN events_status ON events.events_status_id = events_status.events_status_id
							JOIN finished ON events.finished_id = finished.finished_id
							WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	/* выборка важных задач */

	function select_events_vazhnoe1($user_id,$user_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.events_status_id = 1";
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_vazhnoe2($user_id,$user_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.events_status_id = 1";
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_vazhnoe3($user_id,$user_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.events_status_id = 1 and events.events_user_id_isp = $user_id";
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_vazhnoe4($user_id,$user_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.events_status_id = 1 and events.events_user_id_isp = $user_id";
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_vazhnoe5($user_id,$user_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.events_status_id = 1 and events.events_user_id_isp = $user_id";
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_vazhnoe6($user_id,$user_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.events_status_id = 1 and events.events_user_id_isp = $user_id";
		//$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	/* календарь */

	function my_calendar($fill=array()) { 
		$month_names=array("январь","февраль","март","апрель","май","июнь",
			"июль","август","сентябрь","октябрь","ноябрь","декабрь"); 
		if (isset($_GET['y'])) $y=$_GET['y'];
		if (isset($_GET['m'])) $m=$_GET['m']; 
		if (isset($_GET['date']) AND strstr($_GET['date'],"-")) list($y,$m)=explode("-",$_GET['date']);
		if (!isset($y) OR $y < 1970 OR $y > 2037) $y=date("Y");
		if (!isset($m) OR $m < 1 OR $m > 12) $m=date("m");

		$month_stamp=mktime(0,0,0,$m,1,$y);
		$day_count=date("t",$month_stamp);
		$weekday=date("w",$month_stamp);
		if ($weekday==0) $weekday=7;
		$start=-($weekday-2);
		$last=($day_count+$weekday-1) % 7;
		if ($last==0) $end=$day_count; else $end=$day_count+7-$last;
		$today=date("Y-m-d");
		$prev=date('?\m=m&\y=Y',mktime (0,0,0,$m-1,1,$y));  
		$next=date('?\m=m&\y=Y',mktime (0,0,0,$m+1,1,$y));
		$i=0;
	}

	/* выборка всех задач */

	function select_events_all_1($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT *
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE (events.events_user_id_isp = users.user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_all_2($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE (events.events_user_id_isp = users.user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_all_3($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_all_4($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_all_5($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	function select_events_all_6($user_id,$user_id1,$events_status_id1,$finished_id1,$limit,$offset) {
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE (events.events_user_id_isp = $user_id or events.user_id = $user_id)";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";
		$q .= $this->limit($limit,$offset);

		return $this->q($q);
	}

	/* выборка задач на сегодня */

	function select_events_today1($user_id,$user_id1,$events_status_id1,$finished_id1) {
		$a = date('d.m.Y');
		$a = mktime(0, 0, 0);
		$time = mktime(0,0,0);
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.n_date = $a";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";

		return $this->q($q);
	}

	function select_events_today2($user_id,$user_id1,$events_status_id1,$finished_id1) {
		$a = date('d.m.Y');
		$a = mktime(0, 0, 0);
		$time = mktime(0,0,0);
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.n_date = $a";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";

		return $this->q($q);
	}

	function select_events_today3($user_id,$user_id1,$events_status_id1,$finished_id1) {
		$a = date('d.m.Y');
		$a = mktime(0, 0, 0);
		$time = mktime(0,0,0);
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.n_date = $a and events.events_user_id_isp = $user_id";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";

		return $this->q($q);
	}

	function select_events_today4($user_id,$user_id1,$events_status_id1,$finished_id1) {
		$a = date('d.m.Y');
		$a = mktime(0, 0, 0);
		$time = mktime(0,0,0);
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.n_date = $a and events.events_user_id_isp = $user_id";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";

		return $this->q($q);
	}

	function select_events_today5($user_id,$user_id1,$events_status_id1,$finished_id1) {
		$a = date('d.m.Y');
		$a = mktime(0, 0, 0);
		$time = mktime(0,0,0);
		$q = "SELECT * 
				FROM users
				JOIN events ON users.user_id = events.events_user_id_isp
				JOIN events_status ON events.events_status_id = events_status.events_status_id
				JOIN finished ON events.finished_id = finished.finished_id
				WHERE events.n_date = $a and events.events_user_id_isp = $user_id";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";

		return $this->q($q);
	}

	function select_events_today6($user_id,$user_id1,$events_status_id1,$finished_id1) {
		$a = date('d.m.Y');
		$a = mktime(0, 0, 0);
		$time = mktime(0,0,0);
		$q = "SELECT * 
					FROM users
					JOIN events ON users.user_id = events.events_user_id_isp
					JOIN events_status ON events.events_status_id = events_status.events_status_id
					JOIN finished ON events.finished_id = finished.finished_id
					WHERE events.n_date = $a and events.events_user_id_isp = $user_id";
		$q .= $this->fil_sel('events.events_status_id',$events_status_id1);
		$q .= $this->fil_sel('events_user_id_isp',$user_id1);
		$q .= $this->fil_sel('events.finished_id',$finished_id1);
		$q .= " ORDER BY events.n_date DESC ";

		return $this->q($q);
	}
		
	/* подсчёт количества строк */	

	function count_users($user_status_id,$org_id,$dolzhnost_id) {
		$q = "SELECT users.user_id,users.dolzhnost_id FROM users
				JOIN user_statuses ON users.user_status_id = user_statuses.user_status_id
				WHERE 1=1";
		$q .= $this->fil_sel('users.user_status_id',$user_status_id);
		$q .= $this->fil_sel('users.org_id',$org_id);
		$q .= $this->fil_sel('users.dolzhnost_id',$dolzhnost_id);
		return $this->q_count($q);
	}

	function count_all_events($user_names,$events_status) {
		$q = "SELECT events.event_id FROM events
				LEFT JOIN events_status ON events.events_status_id = events_status.events_status_id
				LEFT JOIN users ON users.user_id = events.user_id
				WHERE 1=1";
		
		$q .= $this->fil_sel('events_user_id_isp',$user_names);
		$q .= $this->fil_sel('events.events_status_id',$events_status);
		
		return $this->q_count($q);
	}

	function count_mail($user_id, $dir = -1) {
		if($dir == 0) {
			$result = $this->q("SELECT * FROM mail WHERE poluchatel_id = $user_id");
		}
		elseif($dir == 1) {
			$result = $this->q("SELECT * FROM mail WHERE user_id = $user_id");
		}
		else {
			$result = $this->q("SELECT * FROM mail WHERE user_id = $user_id OR poluchatel_id = $user_id");
		}
		return count($result);
	}

	/* файлы */
	function select_files($role,$user_id,$limit,$offset) {
		$lo = $limit ? "LIMIT $limit OFFSET $offset" : "";

		$result1 = $this->q("SELECT * FROM events
			LEFT JOIN users
			ON users.user_id = events.user_id
			WHERE file <> '' " . ($role != 'a' ? "and events_user_id_isp = $user_id" : "") . "
			GROUP BY file
			$lo");
		$result2 = $this->q("SELECT * FROM mail
			LEFT JOIN users
			ON users.user_id = mail.user_id
			WHERE file <> '' " . ($role != 'a' ? "and poluchatel_id = $user_id" : "") . "
			GROUP BY file
			$lo");
		$result3 = $this->q("SELECT * FROM events_otvet
			LEFT JOIN users
			ON users.user_id = events_otvet.user_id
			WHERE file <> '' " . ($role != 'a' ? "and user_poluch = $user_id" : "") . "
			GROUP BY file
			$lo");

		$result = array_merge($result1, $result2, $result3);

		$dt = [];
		foreach($result as &$de) {
			$nd = false;
			if(!$nd && isset($de['nach_date'])) {
				$nd = $de['nach_date'];
			}
			if(!$nd && isset($de['date_otpr'])) {
				$nd = $de['date_otpr'];
			}
			if(!$nd && isset($de['izm_date'])) {
				$nd = $de['izm_date'];
			}
			$de['nach_date'] = $nd;
			$dt[] = $de;
		}
		$result = $dt;

		$result = $this->arrayMultiSort($result, ['nach_date' => 'desc']);
		return $result;
	}

	/* вставка */
				
	function add_new_user($user_name,$user_status_id,$user_login,$user_pass,$otdel_id,$dolzhnost_id) {
		$user_pass = md5($user_pass);
		return $this->qn("INSERT INTO users (user_name,user_status_id,user_login,user_pass,otdel_id,dolzhnost_id)
						  VALUES ('$user_name','$user_status_id','$user_login','$user_pass','$otdel_id','$dolzhnost_id')");
	}

	function add_new_developers($developers_name,$city_id,$user_id,$developers_phone,$developers_email,$developers_adress) {
		return $this->qn("INSERT INTO developers (developers_name,city_id,user_id,developers_phone,developers_email,developers_adress)
						  VALUES ('$developers_name','$city_id','$user_id','$developers_phone','$developers_email','$developers_adress')");
	}

	function add_new_zayavki($n_date,$city_id,$status_zayavki_id,$apartment_id,$user_id) {
		return $this->qn("INSERT INTO zayavki (n_date,city_id,status_zayavki_id,apartment_id,user_id)
						  VALUES ('$n_date','$city_id','$status_zayavki_id','$apartment_id','$user_id')");
	}

	function add_new_apartments($apartment_name,$apartment_adress,$apartment_ploshad,$developers_id,$user_id,$finish_year_id,$price_id,$price_metr_id,$city_id,$otdelka_id,$quantity_rooms_id) {
		return $this->qn("INSERT INTO apartment (apartment_name,apartment_adress,apartment_ploshad,developers_id,user_id,finish_year_id,price_id,price_metr_id,city_id,otdelka_id,quantity_rooms_id)
						  VALUES ('$apartment_name','$apartment_adress','$apartment_ploshad','$developers_id','$user_id','$finish_year_id','$price_id','$price_metr_id','$city_id','$otdelka_id','$quantity_rooms_id')");
	}

	function add_new_otdel($otdel_name) {
	 	return $this->qn("INSERT INTO otdel (otdel_name)
	 					  VALUES ('$otdel_name')");
    }
	
    function add_new_dolzhnosts($dolzhnost_name) {
	 	return $this->qn("INSERT INTO dolzhnost (dolzhnost_name)
	 					  VALUES ('$dolzhnost_name')");
    }

	function add_new_event($events_status_id,$n_date,$user_id,$comments,$event_name,$event_text,$nach_date,$events_user_id_isp) {
		$file = '';
		if (isset($_FILES['files'])) {
			$errors = array();
			foreach($_FILES['files']['name'] as $i => $v) {
				$file_name = $_FILES['files']['name'][$i];
				$file_size = $_FILES['files']['size'][$i];
				$file_tmp = $_FILES['files']['tmp_name'][$i];
				$file_type = $_FILES['files']['type'][$i];
				$file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i] )));
	
				$expensions = array("jpeg","jpg","png","txt","pdf");
	
				if ($file_size > 32*1000*100) {
					$errors[] = 'Файл не должен быть больше 32мб';
				}
	
				if (empty($errors) == TRUE) {
					move_uploaded_file($file_tmp, "files/".$file_name);
				}else{
					print $errors;
				}
			}
			$file = implode('|', $_FILES['files']['name']);
		}

		$time = mktime(0,0,0);
		$n_date_tmp = explode('.',$n_date);
		$n_date = mktime(0,0,0,$n_date_tmp[1],$n_date_tmp[0],$n_date_tmp[2]);

		$nach_date = date('d.m.Y');
		$time = mktime(0,0,0);
		$nach_date_tmp = explode('.',$nach_date);
		$nach_date = mktime(0,0,0,$nach_date_tmp[1],$nach_date_tmp[0],$nach_date_tmp[2]);
		$finished_id = 1;
		$result = $this->qn("INSERT INTO events (events_status_id,n_date,user_id,comments,event_name,event_text,nach_date,finished_id,events_user_id_isp,file)
						  VALUES ('$events_status_id','$n_date','$user_id','$comments','$event_name','$event_text','$nach_date','$finished_id','$events_user_id_isp','$file')
						  ");

		$event = $this->db->query("select * from events order by event_id desc limit 1")->result()[0];
		$noty = "Получено новое задание <a href=/index.php/event/index/$event->event_id>$event->event_name</a>"; 
		$this->add_noty($events_user_id_isp, $noty);

		return $result;
	}

	function add_events_otvet($event_id,$user_id,$user_poluch,$otvet_text) {
		$file = '';
		if (isset($_FILES['files'])) {
			$errors = array();
			foreach($_FILES['files']['name'] as $i => $v) {
				$file_name = $_FILES['files']['name'][$i];
				$file_size = $_FILES['files']['size'][$i];
				$file_tmp = $_FILES['files']['tmp_name'][$i];
				$file_type = $_FILES['files']['type'][$i];
				$file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i] )));
	
				$expensions = array("jpeg","jpg","png","txt","pdf");
	
				if ($file_size > 32*1000*100) {
					$errors[] = 'Файл не должен быть больше 32мб';
				}
	
				if (empty($errors) == TRUE) {
					move_uploaded_file($file_tmp, "files/".$file_name);
				}else{
					print $errors;
				}
			}
			$file = implode('|', $_FILES['files']['name']);
		}

	 	$izm_date = time();
	 	$result = $this->qn("INSERT INTO events_otvet (event_id,user_id,user_poluch,otvet_text,izm_date,file)
						   VALUES ('$event_id','$user_id','$user_poluch','$otvet_text','$izm_date','$file')");

		$event = $this->db->query("select * from events where event_id = $event_id")->result()[0];
		$noty = "Новое сообщение по задаче <a href=/index.php/event/index/$event->event_id>$event->event_name</a>"; 
		$this->add_noty($user_poluch, $noty);

		return $result;
	}

	function add_new_mail($date_otpr,$user_id,$poluchatel_id,$name_mail,$text_mail) {
		$file = '';
		if (isset($_FILES['files'])) {
			$errors = array();
			foreach($_FILES['files']['name'] as $i => $v) {
				$file_name = $_FILES['files']['name'][$i];
				$file_size = $_FILES['files']['size'][$i];
				$file_tmp = $_FILES['files']['tmp_name'][$i];
				$file_type = $_FILES['files']['type'][$i];
				$file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i] )));
	
				$expensions = array("jpeg","jpg","png","txt","pdf");
	
				if ($file_size > 32*1000*100) {
					$errors[] = 'Файл не должен быть больше 32мб';
				}
	
				if (empty($errors) == TRUE) {
					move_uploaded_file($file_tmp, "files/".$file_name);
				}else{
					print $errors;
				}
			}
			$file = implode('|', $_FILES['files']['name']);
		}

		$date_otpr = time();
		$result = $this->qn("INSERT INTO mail (date_otpr,user_id,poluchatel_id,name_mail,text_mail,file)
						  VALUES ($date_otpr,'$user_id','$poluchatel_id','$name_mail','$text_mail','$file')
						  ");

		$message = $this->db->query("select * from mail order by mail_id desc limit 1")->result()[0];
		$noty = "Получено новое сообщение <a href=/index.php/mymail1/index/$message->mail_id>$message->name_mail</a>"; 
		$this->add_noty($poluchatel_id, $noty);
		return $result;
	}

	/* обновление */

	function update_profil($user_id,$user_name,$user_status_id,$user_login,$otdel_id,$dolzhnost_id,$user_telephon,$user_email) {
		$sql = "UPDATE users SET
			" . ($user_name ? "user_name = '$user_name'," : "") . "
			" . ($user_status_id ? "user_status_id = '$user_status_id'," : "") . "
			" . ($user_login ? "user_login = '$user_login'," : "") . "
			" . ($otdel_id ? "otdel_id = '$otdel_id'," : "") . "
			" . ($dolzhnost_id ? "dolzhnost_id = '$dolzhnost_id'," : "") . "
			" . ($user_telephon ? "user_telephon = '$user_telephon'," : "") . "
			" . ($user_email ? "user_email = '$user_email'," : "") . "
			WHERE user_id = '$user_id'";
		
		$sql = preg_replace('/,\s+WHERE/', ' WHERE', $sql);

		return $this->qn($sql);
	}

	function update_developer($developers_id,$developers_name,$city_id,$user_id,$developers_phone,$developers_email,$developers_adress) {
		$sql = "UPDATE developers SET
			" . ($developers_name ? "developers_name = '$developers_name'," : "") . "
			" . ($city_id ? "city_id = '$city_id'," : "") . "
			" . ($user_id ? "user_id = '$user_id'," : "") . "
			" . ($developers_phone ? "developers_phone = '$developers_phone'," : "") . "
			" . ($developers_email ? "developers_email = '$developers_email'," : "") . "
			" . ($developers_adress ? "developers_adress = '$developers_adress'," : "") . "
			WHERE developers_id = '$developers_id'";
		
		$sql = preg_replace('/,\s+WHERE/', ' WHERE', $sql);

		return $this->qn($sql);
	}

	function update_apartment($apartment_id,$apartment_name,$apartment_adress,$apartment_ploshad,$developers_id,$user_id,$finish_year_id,$price_id,$price_metr_id,$city_id,$otdelka_id,$quantity_rooms_id) {
		$sql = "UPDATE apartment SET
			" . ($apartment_name ? "apartment_name = '$apartment_name'," : "") . "
			" . ($apartment_adress ? "apartment_adress = '$apartment_adress'," : "") . "
			" . ($apartment_ploshad ? "apartment_ploshad = '$apartment_ploshad'," : "") . "
			" . ($developers_id ? "developers_id = '$developers_id'," : "") . "
			" . ($user_id ? "user_id = '$user_id'," : "") . "
			" . ($finish_year_id ? "finish_year_id = '$finish_year_id'," : "") . "
			" . ($price_id ? "price_id = '$price_id'," : "") . "
			" . ($price_metr_id ? "price_metr_id = '$price_metr_id'," : "") . "
			" . ($city_id ? "city_id = '$city_id'," : "") . "
			" . ($otdelka_id ? "otdelka_id = '$otdelka_id'," : "") . "
			" . ($quantity_rooms_id ? "quantity_rooms_id = '$quantity_rooms_id'," : "") . "
			WHERE apartment_id = '$apartment_id'";
		
		$sql = preg_replace('/,\s+WHERE/', ' WHERE', $sql);

		return $this->qn($sql);
	}

	function update_zayavka($zayavki_id,$n_date,$city_id,$status_zayavki_id,$apartment_id,$user_id) {
		$sql = "UPDATE zayavki SET
			" . ($n_date ? "n_date = '$n_date'," : "") . "
			" . ($city_id ? "city_id = '$city_id'," : "") . "
			" . ($status_zayavki_id ? "status_zayavki_id = '$status_zayavki_id'," : "") . "
			" . ($apartment_id ? "apartment_id = '$apartment_id'," : "") . "
			" . ($user_id ? "user_id = '$user_id'," : "") . "
			WHERE zayavki_id = '$zayavki_id'";
		
		$sql = preg_replace('/,\s+WHERE/', ' WHERE', $sql);

		return $this->qn($sql);
	}

	function update_event($event_id,$event_name,$events_status_id,$n_date,$user_id,$event_text,$comments,$finished_id,$events_user_id_isp) {
		if($n_date) {
			$time = mktime(0,0,0);
			$n_date_tmp = explode('.',$n_date);
			$n_date = mktime(0,0,0,$n_date_tmp[1],$n_date_tmp[0],$n_date_tmp[2]);
		}

		$file = '';
		if (isset($_FILES['files'])) {
			$errors = array();
			foreach($_FILES['files']['name'] as $i => $v) {
				$file_name = $_FILES['files']['name'][$i];
				$file_size = $_FILES['files']['size'][$i];
				$file_tmp = $_FILES['files']['tmp_name'][$i];
				$file_type = $_FILES['files']['type'][$i];
				$file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i] )));
	
				$expensions = array("jpeg","jpg","png","txt","pdf");
	
				if ($file_size > 32*1000*100) {
					$errors[] = 'Файл не должен быть больше 32мб';
				}
	
				if (empty($errors) == TRUE) {
					move_uploaded_file($file_tmp, "files/".$file_name);
				}else{
					print $errors;
				}
			}
			$file = implode('|', $_FILES['files']['name']);
		}

		$sql = "UPDATE events SET "
			. ($event_name ? "event_name = '$event_name'," : "")
			. ($events_status_id ? "events_status_id = '$events_status_id'," : "")
			. ($n_date ? "n_date = '$n_date'," : "")
			. ($user_id ? "user_id = '$user_id'," : "")
			. ($event_text ? "event_text = '$event_text'," : "")
			. ($comments ? "comments = '$comments'," : "")
			. ($finished_id ? "finished_id = '$finished_id'," : "")
			. ($events_user_id_isp ? "events_user_id_isp = '$events_user_id_isp'," : "")
			. ($file ? "file = CONCAT(file, '|$file')," : "")
			. "WHERE event_id = '$event_id'";

		$sql = preg_replace('/,\s*WHERE/', ' WHERE', $sql);

		$result = $this->qn($sql);

		$noty = "Задание <a href=/index.php/event/index/$event_id>#$event_id</a> изменено"; 
		$this->add_noty($events_user_id_isp, $noty);

		return $result;
	}
	
	function accept_event($finished,$event_id) {
	 	$time = mktime(0,0,0);
	 	if ($finished == 1) { 
	 		return $this->qn("UPDATE events SET
	 						  finished = $finished
	 						  WHERE event_id = $event_id");
	 	}
	 	elseif ($finished == 2) { 
	 		return $this->qn("UPDATE events SET
	 						  finished = $finished,
	 						  p_date = $time
	 						  WHERE event_id = $event_id");
	 	}			  
	 	else {
	 		return false;
	 	}
	}
	
	function change_pass($user_id,$user_pass) {
		$user_pass = md5($user_pass);
		return $this->qn("UPDATE users SET
						  user_pass = '$user_pass'
						  WHERE user_id = '$user_id'");
	}
	
	function delete_event($event_id) {
		return $this->qn("DELETE FROM events
						  WHERE event_id = '$event_id'");
	}

	function delete_user($user_id) {
		return $this->qn("DELETE FROM users
						  WHERE user_id = '$user_id'");
	}

	function add_noty($user_id, $message) {
		//header('Content-type: text/plain');
		$user = $this->func->q("SELECT * from users where user_id = '$user_id'");

		if(!$user) {
			return false;
		}

		$noty = json_decode($user[0]['user_noty']);
		array_push($noty, $message);

		$sql = "UPDATE users SET user_noty = '" . mysql_real_escape_string(json_encode($noty)) . "' WHERE user_id = $user_id";
		$this->qn($sql);
		//die('');
	}

}