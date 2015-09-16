<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Version
//---------------------------------------------------------------------------------------------------------------
class FC_Version {
	public $id;
	public $menu_item_id;
	public $name;
	public $calories;
	public $fat;
	public $carbohydrates;
	public $protein;
	public $sodium;
	public $fiber;
	public $sugar;

	public function __construct($params) {
		$CI =& get_instance();

		if ( count($params) == 0 ) // is a library load
			return;

		$this->id = $params['versionObject']->id;
		$this->menu_item_id = $params['versionObject']->menu_item_id;
		$this->name = $params['versionObject']->version_name;
		$this->calories = $params['versionObject']->calories;
		$this->fat = $params['versionObject']->fat;
		$this->carbohydrates = $params['versionObject']->carbohydrates;
		$this->protein = $params['versionObject']->protein;
		$this->sodium = $params['versionObject']->sodium;
		$this->fiber = $params['versionObject']->fiber;
		$this->sugar = $params['versionObject']->sugar;
	}
}