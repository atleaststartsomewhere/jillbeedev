<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// MODEL_RESULT UTILITY MODEL
class Model_Result extends CI_Model
{
	public $success;	// bool
	public $message;	// string
	public $data;		// untyped

	public function __construct($success=false,$message="Fatal Error: No Message to Display",$data=array()) {
		parent::__construct(); 

		$this->success = $success;
		$this->message = $message;
		$this->data = $data;
	}
}