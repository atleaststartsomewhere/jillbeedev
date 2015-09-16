<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Ratings extends REST_Controller {

	function Ratings()	{
		parent::__construct();
		$this->load->model('rating');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Rating Endpoint
	//  Must supply an item ID, a rating (int), client ID, and the API saves the additional/new rating for the item off to the 
	//  database
	//---------------------------------------------------------------------------------------------------------------
	// * = required
	//  Query
	//      item (int)*
	//      rating (int)*
	//      client (int)*
	//---------------------------------------------------------------------------------------------------------------
	public function add_post()
	{
		$error_message = '';

		if (!$this->post('item'))
	 		$error_message .= " 'item' missing; ";
		if (!$this->post('rating'))
	  		$error_message .= " 'rating' missing; ";
		if (!$this->post('client'))
	  		$error_message .= " 'client' missing; ";

		$result = $this->rating->add_rating($this->post('client'), $this->post('item'), $this->post('rating'));

		if ( $result['result'] )
		{
	  		$this->response(array("result" => true, $result['data']), 200);
	  		return;
		}
		else
		{
	 		$this->response(array("result" => false, $result['message']), 200);
	 		return;
		}
	}  
}