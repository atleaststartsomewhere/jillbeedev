<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class API_Controller extends REST_Controller {

	public function __construct()	{
		parent::__construct();
	}

	public function parameters_exist($parameter_list, $post_array) {

		$result = new stdClass();
		$missing_params = array();
		$existing_params = array();

		foreach ($parameter_list as $parameter) 
		{
			if (!isset($post_array[$parameter]))
				array_push($missing_params,$parameter);
			else
				array_push($existing_params,$parameter);
		}

		if (!empty($missing_params))
		{
			$result->success = false;
			$result->missing_parameters = $missing_params;
			$result->existing_parameters = $existing_params;
		}
		else
		{
			$result->success = true;
		}
		return $result;
	}
}