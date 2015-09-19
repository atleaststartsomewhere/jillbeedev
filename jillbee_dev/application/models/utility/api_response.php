<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// UTILITY MODEL
class API_Response extends CI_Model
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
			$this->internal_log_message($success, $logic_point, $this->internal_message($messages), $function, $args, $timestamp);

		// Craft and Return Front-End Response
		$response 				= new stdClass();
		$response->success 		= true;
		$response->data 		= $dataObject;
		$response->messages		= $this->external_message($messages);
		$response->timestamp 	= $timestamp;
		if ( ENVIRONMENT == 'development' ) {
			$response->debug_messages 	= $this->internal_message($messages);
			$response->debug_function 	= '@'.$logic_point.': '.$function.'('.implode(",", $args).')';
		}
		return $response;
	}

	public function internal_log_message($success, $logic_point, $message, $function, $args, $timestamp)
	{
		$log_level='info';
		if (!$success)
			$log_level='error';

		log_message($log_level, '=[API RESPONSE]======================================');
		log_message($log_level, ' time:          ' . $timestamp);
		log_message($log_level, ' success:       ' . $success);
		log_message($log_level, ' message:       ' . implode(",", $message));
		log_message($log_level, ' logic:         ' . $logic_point);
		log_message($log_level, ' function:      ' . $function);
		log_message($log_level, ' args:          ' . implode(",", $args));
		log_message($log_level, '====================================================');
	}

	public function external_message($lang_identifiers) 
	{
		$this->load->language('api_responses');
		$messages = array();
		foreach ( $lang_identifiers as $id )
			array_push($messages, $this->lang->line('external_'.$id));
		return $messages;
	}

	public function internal_message($lang_identifiers) 
	{
		$this->load->language('api_responses');
		$messages = array();
		foreach ( $lang_identifiers as $id )
			array_push($messages, $this->lang->line('internal_'.$id));
		return $messages;
	}
}