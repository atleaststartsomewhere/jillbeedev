<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// MODEL_RESULT UTILITY MODEL
class Response extends CI_Model
{
	// Lang File Array Keys
	public $external_prefix = "external_";
	public $internal_prefix = "external_";

	public function __construct() {
		parent::__construct(); 
	}

	public function make($logic_point, $success, $messages, $function, $args, $dataObject)
	{
		$timestamp = date('r');
		// Craft and Log Error
		if ( !$success )
			$this->internal_log_message($success, $logic_point, $function, $args, $timestamp);
		// Craft and Return Front-End Response
		$response 				= new stdClass();
		$response->success 		= true;
		$response->data 		= $dataObject;
		$response->message 		= $external_message;
		$response->timestamp 	= $timestamp;
		if ( ENVIRONMENT == 'development' ) {
			$response->debug_message 	= $internal_message;
			$response->debug_function 	= '@'.$logic_point.': '.$function.'('.$args.')';
		}
		return $response;
	}

	public function internal_log_message($success, $logic_point, $function, $args, $timestamp)
	{
		$log_level='info';
		if (!$success)
			$log_level='error';

		log_message($log_level, '=[API RESPONSE]======================================');
		log_message($log_level, ' time:          ' . $timestamp);
		log_message($log_level, ' success:       ' . $success);
		log_message($log_level, ' logic:         ' . $logic_point);
		log_message($log_level, ' function:      ' . $function);
		log_message($log_level, ' args:          ' . implode(",", $args);
		log_message($log_level, '====================================================');
	}

	public function messages($lang_identifier) 
	{
		$this->load->language('api_responses');
		$ex = $this->lang->line('external_api_responses');
		$in = $this->lang->line('internal_api_responses');

		return $in . ',' . $ex . ',';
	}
}