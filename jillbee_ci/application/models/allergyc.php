<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Allergy
//---------------------------------------------------------------------------------------------------------------
class AllergyC {
	public $id;
	public $name;

	public function __construct($allergy_id, $allergy_name) {
		$CI =& get_instance();

		$this->id = $allergy_id;
		$this->name = $allergy_name;
	}
}