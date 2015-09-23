<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Allergies extends API_Controller {

	function Allergies()	{
		parent::__construct();
		$this->load->model('allergy');
	}
  	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Allergy Endpoint
	//  Can optionally supply a client to get valid allergies for a client, or just all alergies (with not client param)
	//---------------------------------------------------------------------------------------------------------------
	// * = required
	//  Query
	//      client (int)
	//---------------------------------------------------------------------------------------------------------------
	public function index_get()
	{
		$client = $this->get('client');

		if ( isset($client) )
		{
			$allergy = $this->allergy->get_client_allergies($this->get('client'), $this->get('order'), $this->get('enabled'));
			$this->response($allergy, 200);
			return;
		}
		else
		{
			$allergy = $this->allergy->get_allergies($this->get('order'), $this->get('enabled'));
			$this->response($allergy, 200);
			return;
		}
	}
}