<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('factories/menu/fc_day', array());
	}

	public function index()
	{
		$params = array();
		$params['date'] = '2015-09-08';
		$params['client_id'] = '1';
		$params['location_id'] = '1';
		$new = new FC_Day($params);

		var_dump($new);
	}
}