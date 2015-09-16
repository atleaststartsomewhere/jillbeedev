<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Version
//---------------------------------------------------------------------------------------------------------------
class Version {
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

	public function __construct($versionObject) {
		$CI =& get_instance();

		$this->id = $versionObject->id;
		$this->menu_item_id = $versionObject->menu_item_id;
		$this->name = $versionObject->version_name;
		$this->calories = $versionObject->calories;
		$this->fat = $versionObject->fat;
		$this->carbohydrates = $versionObject->carbohydrates;
		$this->protein = $versionObject->protein;
		$this->sodium = $versionObject->sodium;
		$this->fiber = $versionObject->fiber;
		$this->sugar = $versionObject->sugar;
	}
}