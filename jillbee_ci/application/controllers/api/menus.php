<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Menus extends API_Controller {

	function Menus()	{
		parent::__construct();
		$this->load->helper('date_helper');
		$this->load->model('menu');
		$this->load->model('model_result');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Menu Endpoint
	//  Must supply a client id and location id, and returns the menu entries for the work week the current day belongs to
	//---------------------------------------------------------------------------------------------------------------
	// * = required
	//  Query
	//      client (int)*
	//      location (int)*
	//---------------------------------------------------------------------------------------------------------------
	public function index_get()
	{
		$parameters = array('location');
		$parameterCheck = $this->parameters_exist($parameters, $this->get());
		if ( !$parameterCheck->success )
		{
			$this->response(new Model_Result(false, $parameterCheck->message), 200);
			return;
		}
		// Check if optional client param is set
		$client = $this->get('client');
		if ( !isset($client) )
			$client = $this->session->userdata('client');
		//---------------------------------------------------------------------------------------------------------------
		if ( !$this->get('day') )
	  		$monday = get_monday(date('Y-m-d'));
		else
	  		$monday = get_monday($this->get('day'));

		$menu = $this->menu->get_menu($monday, $client, $this->get('location'));

		$this->response($menu, 200);
	}
}