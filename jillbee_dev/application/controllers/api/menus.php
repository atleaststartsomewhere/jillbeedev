<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Menus extends API_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->helper('date_helper');
		$this->load->model('utility/api_response');
		$this->load->model('menu');
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
		// Required parameters
		$parameters = array('location', 'client');
		$parameterCheck = $this->parameters_exist($parameters, $this->get());
		if ( !$parameterCheck->success )
		{
			/* RESPONSE LOGGING: @param_exists */
			$messages = array('success', 'param_missing' => $parameterCheck->missing_parameters);
			$this->response(
				$this->api_response->make('param_exists', false, $messages, 
					get_class($this).'::'.__FUNCTION__, $this->get(), array()), 
			200);
			return;
		}
		// Optional parameters
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