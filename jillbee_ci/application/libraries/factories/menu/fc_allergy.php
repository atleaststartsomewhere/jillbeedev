<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Allergy
//---------------------------------------------------------------------------------------------------------------
class FC_Allergy {
	public $id;
	public $name;

	public function __construct($params) {
		$CI =& get_instance();

		if ( count($params) == 0 ) // is a library load
			return;

		$this->id = $params['allergy_id'];
		$this->name = $params['allergy_name'];
	}
}
