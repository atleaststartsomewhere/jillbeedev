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
		$error_message = "";

		if ( !$this->get('client') )
			$error_message .= " 'client' missing; ";
		if ( !$this->get('location') )
	  		$error_message .= " 'location' missing; ";

		if ( !empty($error_message) )
		{
	  		$this->response(new Model_Result(false, $error_message), 200);
	  		return;
		}
		//---------------------------------------------------------------------------------------------------------------
		if ( !$this->get('day') )
	  		$monday = get_monday(date('Y-m-d'));
		else
	  		$monday = get_monday($this->get('day'));

		$menu = $this->menu->get_menu($monday, $this->get('client'), $this->get('location'));

		$this->response($menu, 200);
	}
}