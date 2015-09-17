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
		$error_message = '';

		foreach ($parameter_list as $parameter) 
		{
			if (!isset($post_array[$parameter]))
			{
				$error_message .= $parameter . ' is missing; ';
			}
		}

		if (!empty($error_message))
		{
			$result->success = false;
			$result->message = $error_message;
		}
		else
		{
			$result->success = true;
		}
		return $result;
	}
}