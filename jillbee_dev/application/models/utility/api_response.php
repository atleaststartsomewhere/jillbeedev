<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// UTILITY MODEL
class API_Response extends CI_Model
{
	// Lang File Array Keys
	public $external_prefix = "external_";
	public $internal_prefix = "internal_";

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
		$response->success 		= $success;
		$response->data 		= $dataObject;
		$response->messages		= $this->external_message($messages);
		$response->timestamp 	= $timestamp;
		if ( ENVIRONMENT == 'development' ) {
			$response->debug_messages 	= $this->internal_message($messages);
			$response->debug_function 	= '@'.$logic_point.': '.$function.'('.(empty($v = http_build_query(array_combine(array_keys($args), $args))) ? '' : $v).')';
		}
		return $response;
	}

	public function internal_log_message($success, $logic_point, $message, $function, $args, $timestamp)
	{
		$log_level='info';
		if (!$success)
			$log_level='debug';

		log_message($log_level, '=[API RESPONSE]======================================');
		log_message($log_level, ' time:          ' . $timestamp);
		log_message($log_level, ' ip-address:    ' . $_SERVER['REMOTE_ADDR']);		
		log_message($log_level, ' success:       ' . (($success)?'true':'false'));
		log_message($log_level, ' message:       ' . implode(", ", $message));
		log_message($log_level, ' logic:         ' . $logic_point);
		log_message($log_level, ' function:      ' . $function);
		log_message($log_level, ' args:          ' . (empty($v = http_build_query(array_combine(array_keys($args), $args))) ? '<none>' : $v));
		log_message($log_level, '====================================================');
	}

	public function external_message($lang_identifiers) 
	{
		$this->load->language('api_responses');
		$messages = array();
		foreach ( $lang_identifiers as $key => $val )
		{
			if(is_array($val))
			{
				foreach($val as $item)
					array_push($messages, sprintf($this->lang->line('external_'.$key), $item));
			}
			else
				array_push($messages, $this->lang->line('external_'.$val));
		}
		return $messages;
	}

	public function internal_message($lang_identifiers) 
	{
		$this->load->language('api_responses');
		$messages = array();
		foreach ( $lang_identifiers as $key => $val )
		{
			if(is_array($val))
			{
				foreach($val as $item)
					array_push($messages, sprintf($this->lang->line('internal_'.$key), $item));
			}
			else
				array_push($messages, $this->lang->line('internal_'.$val));
		}
		return $messages;
	}
}