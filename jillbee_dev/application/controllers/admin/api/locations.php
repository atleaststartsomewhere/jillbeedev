<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Locations extends API_Controller {

	function Locations()	{
		parent::__construct();
		$this->load->model('location');
		$this->load->model('utility/api_response');
	}

	public function create_post()
	{
		$client_id = $this->post('client');
		$location_name = $this->post('location_name');
		$response_messages = array();

		// Validate Parameters
		// RESPONSE LOGGING: @param_validate
		if ( !isset($client_id) )
			array_push($response_messages, 'client_id_missing');
		if ( !isset($location_name) )
			array_push($response_messages, 'location_name_missing');

		//

		if (count($response_messages) > 0)
		{
			$this->response($this->api_response->make('param_validate', false, $response_messages, __FUNCTION__, func_get_args(), array()), 200);
			return;
		}

			$locations = $this->location->create_location($this->post('client'), $this->post('location_name'), $this->post('enabled'));

			if ($locations == false)
			{
				$this->response(false, 200);
				return;
			}

			$this->response($this->api_response->make('create_success', $locations->success, array('success'), __FUNCTION__, func_get_args(), $locations), 200);
	}

	public function remove_post()
	{
		$location_id = $this->post('location_id');

		if (!isset($location_id))
		{
			$this->response($this->api_response->make('param_validate', false, array('location_id_missing'), __FUNCTION__, func_get_args(), array()), 200);
			return;
		}

		$remove = $this->location->remove($location_id);
		$this->response($remove, 200);

	}

	public function update()
	{

	}

	public function reorder()
	{

	}

	public function update_enabled_locations()
	{

	}

}