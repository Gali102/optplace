<?php 

	if ( ! function_exists('create_input_for_filter')) {
		function create_input_for_filter($id,$name) {
			$f = 	"<div class='blocks' style='margin-left:2px; width: 100% ; height: 100%;'>";
			$f .= 	($name) ? "<label style='margin-left:2px; width: 100% ; height: 35px;' for='$id'>$name</label>" : '';
			$f .= 	"<input style='margin-left:2px; width: 100% ; height: 35px;' type='text' name='$id' id='$id' />
					</div>";
			return $f;
		}
	}
	
	if ( ! function_exists('create_select_for_filter')) {
		function create_select_for_filter($id,$name,$val,$data,$val_id,$val_name,$dis = 0) {
			$f = 	"<div class='blocks' style='margin-left:0px;'>";
			$f .=	($name) ? "<label for='$id' style='font-size: 1em; padding-top:7px;'>$name</label>" : '';
			$f .=	"<select style='width: 100% ; height: 35px; padding-left: 5px;' name='$id' id='$id'>";
			$f .=	"<option value='0'>Выберите</option>";

			foreach ($data as $items) {
				if ($val == $items[$val_id]) {
					$f .= "<option selected value='".$items[$val_id]."'>".$items[$val_name]."</option>";
				}
				else {
					$f .= "<option value='".$items[$val_id]."'>".$items[$val_name]."</option>";
				}
			}

			$f .=	"</select>
					</div>";
			return $f;
		}
	}
	
	if (! function_exists('create_date_for_filter')) {
		function create_date_for_filter ($id,$name) {
			$id_end = $id."_end";
			$f = 	"<div class='span3 blocks' style='margin-left:2px'>
					<label>$name</label>
					<span>С: </span><input style='width:70px;' type='text' name='$id' id='$id' />
					<span>По: </span><input style='width:70px;' type='text' name='$id_end' id='$id_end' />
					</div>";
			return $f;
		}
	}
	
	if ( ! function_exists('create_text_for_filter')) {
		function create_text_for_filter($id,$name,$str) {
			$f = 	"<div class='span3 blocks'>";
			$f .=	($name) ? "<label for='$id'>$name</label>" : '';
			$f .=	"<textarea name='$id' id='$id' rows='$str'></textarea>
					</div>";
			return $f;
		}
	}
	
	if ( ! function_exists('create_button_for_filter')) {
		function create_button_for_filter($span,$offset) {
			$f = 	"<div class='pull-right span$span ";
			$f .= ($offset) ? "offset$offset " : "";
			$f .= "blocks'>
					<label>&nbsp</label>
					<button type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					<button	type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button>
					</div>";
			return $f;
		}
	}
	
	// if ( ! function_exists('url_client')) {
	// 	function url_client() {
	// 		$f = 	"/index.php/client/index/";
	// 		return $f;
	// 	}
	// }


	if ( ! function_exists('url_calendar')) {
	 	function url_calendar() {
	 		$f = 	"/index.php/calendar/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_uvedomleniya')) {
	 	function url_uvedomleniya() {
	 		$f = 	"/index.php/uvedomleniya/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_mymail')) {
	 	function url_mymail() {
	 		$f = 	"/index.php/mymail/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_mymail1')) {
	 	function url_mymail1() {
	 		$f = 	"/index.php/mymail1/index/";
	 		return $f;
	 	}
	}


	if ( ! function_exists('url_files')) {
	 	function url_files() {
	 		$f = 	"/index.php/files/index/";
	 		return $f;
	 	}
	}
	
	if ( ! function_exists('url_event_today')) {
	 	function url_event_today() {
	 		$f = 	"/index.php/event_today/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_event_vazhnoe')) {
	 	function url_event_vazhnoe() {
	 		$f = 	"/index.php/event_vazhnoe/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_events_all')) {
	 	function url_events_all() {
	 		$f = 	"/index.php/events_all/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_events')) {
	 	function url_events() {
	 		$f = 	"/index.php/events/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_profil')) {
	 	function url_profil() {
	 		$f = 	"/index.php/profil/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_developer')) {
	 	function url_developer() {
	 		$f = 	"/index.php/developer/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_apartment')) {
	 	function url_apartment() {
	 		$f = 	"/index.php/apartment/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_zayavka')) {
	 	function url_zayavka() {
	 		$f = 	"/index.php/zayavka/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_infos')) {
	 	function url_infos() {
	 		$f = 	"/index.php/infos/index/";
	 		return $f;
	 	}
	}

	if ( ! function_exists('url_event')) {
	 	function url_event() {
	 		$f = 	"/index.php/event/index/";
	 		return $f;
	 	}
	} 
	
	if ( ! function_exists('url_chat')) {
		function url_chat() {
			$f = 	"/index.php/chat/index/";
			return $f;
		}
   } 

	// if ( ! function_exists('url_c_talks')) {
	// 	function url_c_talks() {
	// 		$f = 	"/index.php/talks/index/";
	// 		return $f;
	// 	}
	// }
	
	// if ( ! function_exists('url_c_dela')) {
	// 	function url_c_dela() {
	// 		$f = 	"/index.php/client_dela/index/";
	// 		return $f;
	// 	}
	// }
	
	if ( ! function_exists('add_form_input')) {
		function add_form_input($id,$name,$val,$required,$width,$length,$dis = 0) {
			$f = 	"<div class='control-group' style='margin-left:2px; width: 100% ; height: 100%;'>
			    	
					<div class='controls'>
					<input style='width:".$width."%; height: 35px; padding-left: 5px; ' type='text' name='$id' maxlength='$length' type='text' value='$val'";
			if ($dis) {
				$f .=	" disabled ";
			}
			$f .= 	"/>
					<label class='control-label' for='$id'>$name";
		    $f .= 	($required) ? "<span style='font-size:1.5em; color:red;'></span>" : "";
		    $f .= 	"</label>
					<span id='".$id."_error' class=''></span>
					</div>
					</div>";
			return $f;
		}
	}

	if ( ! function_exists('add_form_input_date')) { 
		function add_form_input_date($id,$name,$val,$required,$width,$length,$dis = 0) {
			$f = 	"<div class='control-group'>
					
					<div class='controls'>
					<input style='width:".$width."%; height: 35px; padding-left: 5px; 'type='text'  name='$id' maxlength='$length' type='text' value='$val' id='$id'";
			if ($dis) {
				$f .=	" disabled ";
			}
			$f .= 	"/>

					<label class='control-label' for='$id'>$name";
			$f .= 	($required) ? "<span style='font-size:1.5em; color:red;'></span>" : "";
			$f .= 	"</label>
			
					<span id='".$id."_error' class=''></span>
					</div>
					</div>";
			return $f;
		}
	}
	
	if ( ! function_exists('add_form_select')) {
		function add_form_select($id,$name,$val,$data,$val_id,$val_name,$required,$dis = 0) {
			$f = 	"<div class='control-group'>
					
					<div class='controls'>
					<select name='$id' style='width: 100% ; height: 35px; padding-left: 5px;' id='$id'";
			if ($dis) {
				$f .=	" disabled ";
			}
			$f .= 	">";
			if ($data) {
				foreach ($data as $items) { 
					if ($val == $items[$val_id]) {
						$f .= "<option selected value='".$items[$val_id]."'>".$items[$val_name]."</option>";
					}
					else {
						$f .= "<option value='".$items[$val_id]."'>".$items[$val_name]."</option>";
					}
				}
			}
			else {
				$f .= "<option style='color='#ff0000'>Обновите страницу</option>";
			}
			$f .=	"</select>

					<label class='control-label' style='padding-top:7px;' for='$id'>$name";
			$f .= 	($required) ? "<span style='font-size:1.5em; color:red;'>*</span>" : "";
			$f .=	"</label>

					<span id='".$id."_error' class=''></span>
					</div>
					</div>";
			return $f;
		}
	}

	// if ( ! function_exists('add_form_select1')) {
	// 	function add_form_select1($id,$name,$val,$data,$val_id,$val_name,$required,$dis = 0) {
	// 		$f = 	"<div class='control-group'>
	// 				<label class='control-label' for='$id'>$name";
	// 		$f .= 	($required) ? "<span style='font-size:1.5em; color:red;'>*</span>" : "";
			
	// 		$f .=	"</label>
	// 				<div class='controls'>
	// 				<select name='$id' id='$id'";
	// 		if ($dis) {
	// 			$f .=	" disabled ";
	// 		}
	// 		$f .= 	">";
	// 		if ($data) {
	// 			foreach ($data as $items) { 
	// 				if ($val == $items[$val_id]) {
	// 					$f .= "<option selected value='".$items[$val_id]."'>".$items[$val_name]."</option>";
	// 				}
	// 				else {
	// 					$f .= "<option value='".$items[$val_id]."'>".$items[$val_name]."</option>";
	// 				}
	// 			}
	// 		}
	// 		else {
	// 			$f .= "<option style='color='#ff0000'>Обновите страницу</option>";
	// 		}
	// 		$f .=	"</select>
	// 				<span id='".$id."_error' class=''></span>
	// 				</div>
	// 				</div>";
	// 		return $f;
	// 	}
	// }
	
	if ( ! function_exists('add_form_text')) {
		function add_form_text($id,$name,$val,$required,$width,$length,$dis = 0) {
			$f = 	"<div class='control-group'>
					
					<div class='controls'>
					<textarea style='width: ".$width."%;' rows=".$length." id='$id' name='$id'";
			if ($dis) {
				$f .=	" disabled ";
			}
			$f .= 	"> $val</textarea>

					<label class='control-label' for='$id'>$name";
			$f .=	($required) ? "<span style='font-size:1.5em; color:red;'></span>" : "";
			$f .=	"</label>

					<span id='".$id."_error' class=''></span>
					</div>
					</div>";
			return $f;
		}
	}
	
?>