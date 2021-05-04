<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_super extends CI_controller {
	
	public $super_baseurl;
	
	function __construct() {
		$this->super_baseurl = '/';
	}

	function pagination() {
	}
	
}