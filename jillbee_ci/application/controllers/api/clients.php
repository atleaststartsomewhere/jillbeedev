<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLIENTS API CONTROLLER
// : index
class Clients extends API_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('location');
	}
	public function index_get() {
		$pClient = $this->get('client');
		
		if ( !isset($client) )
		{			
			// TO DO: fail response		
			return;
		}
		else
		{
			$pClient = base64_decode('client');
			$client = $this->client->get_by_name($pClient);
			$this->response($client, 200); // TO DO: api_response
		}
	}
}