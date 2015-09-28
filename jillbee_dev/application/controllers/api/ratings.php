<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class Ratings extends API_Controller {

	function __construct()	{
		parent::__construct();
		$this->load->model('rating');
		$this->load->model('utility/api_response');
	}

	public function add_post()
	{
		$requiredParameters = array('client', 'item', 'rating');
		$parameterCheck = $this->parameters_exist($requiredParameters, $this->post());
		if ( !$parameterCheck->success )
		{
			$this->response(
				$this->api_response->create(
					false, 
					array('param_missing' => $parameterCheck->missing_parameters)
				), 
				200
			);
			return;
		}

		$result = $this->rating->add_rating($this->post('client'), $this->post('item'), $this->post('rating'));

		if ( $result['success'] )
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