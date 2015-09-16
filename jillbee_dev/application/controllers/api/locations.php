<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Locations extends REST_Controller {

	function Locations()	{
		parent::__construct();
		$this->load->model('location');
	}
	//---------------------------------------------------------------------------------------------------------------
	// index [get]
	//		No parameters returns all locations in database
	//		Otherwise supplied parameters narrow results by client or filter the results
	//---------------------------------------------------------------------------------------------------------------
	// : client (optional)
	// : order (optional)
	// : enabled (optional)
	//-------------------------
	public function index_get() {
		// TO DO: Client ID will be encrypted, so decrypt and send to model
		if ( $this->get('client') )
		{
			$locations = $this->location->get_client_locations($this->get('client'), $this->get('order'), $this->get('enabled'));
			$this->response($locations, 200);
			return;
		}
		else
		{
			$locations = $this->location->get_locations($this->get('order'), $this->get('enabled'));
			$this->response($locations, 200);      
			return;
		}
	}
}