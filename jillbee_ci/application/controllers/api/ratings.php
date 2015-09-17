<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Ratings extends API_Controller {

	function Ratings()	{
		parent::__construct();
		$this->load->model('model_result');
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
		$parameters = array('client', 'item', 'rating');
		$parameterCheck = $this->parameters_exist($parameters, $this->post());
		if ( !$parameterCheck->success )
		{
			$this->response(new Model_Result(false, $parameterCheck->message), 200);
			return;
		}

		$result = $this->rating->add_rating($this->post('client'), $this->post('item'), $this->post('rating'));

		if ( $result->success )
		{
	  		$this->response($result, 200);
	  		return;
		}
		else
		{
	 		$this->response($result, 200);
	 		return;
		}
	}  
}