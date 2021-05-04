<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
	
	protected function s_pagination($url,$count_all,$limit,$uri_seg,$suff) {
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$config['suffix'] = $suff;
		$config['base_url'] = site_url($url);
		$config['total_rows'] = $count_all;
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_seg;

		$this->pagination->initialize($config);
		if ($this->uri->segment($uri_seg) == '') {
			$offset = 0;
		}
		else {
			$offset = $this->uri->segment($uri_seg);
		}
		$data['offset'] = $offset;
		$data['limit'] = $limit;
		$data['pag_links'] = $this->pagination->create_links();
		return $data;
	}
	
	protected function s_auth_check($user_id) {
		if (! $user_id) {
			 header ("Location: /index.php/auth");
		}
	}
	
	protected function s_get($name) {
		return $this->input->get($name);
	}
	
	protected function s_post($name) {
		return $this->input->post($name);
	}
	
	
} 


// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */


