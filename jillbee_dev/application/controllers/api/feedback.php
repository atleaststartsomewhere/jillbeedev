<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Feedback extends API_Controller {

	function Feedback()	{
		parent::__construct();
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// feedback Endpoint
	//  Must supply a text-block (email_body) and optional email address (email_from, that gets sent as an email to 
	//  Jillbee (returns success/fail)
	//---------------------------------------------------------------------------------------------------------------
	// * = required
	//  Query
	//      email_body (string)*
	//      email_from (string)
	//---------------------------------------------------------------------------------------------------------------
	public function index_post()
	{

	}
}