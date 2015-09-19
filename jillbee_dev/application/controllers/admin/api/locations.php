<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Locations extends API_Controller {

	function Locations()	{
		parent::__construct();
		$this->load->model('location');
	}

	public function create_post()
	{
		$client_id = $this->post('client');

		if ( isset($client_id) )
			$location = $this->post('client'), $this->post('building_name'), $this->post('enabled');
			$this->response($location, 200);
	}

	public function remove()

	{

	}

	public function update()
	{

	}
/*
	public function reorder()
	{

	}
*/
}