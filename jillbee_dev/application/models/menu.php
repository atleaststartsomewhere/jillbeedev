<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Classes in this file: Menu, Week, Day, Entry, Allergy, Version

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : MENU
//---------------------------------------------------------------------------------------------------------------
class Menu extends CI_Model
{
	public $days; 			// array of day
	/* day:
		date
		array of entries
			/* entry:
				id, item_id, item_name, ingredients, array of allergies, array of versions, rating avg, rating count
					/* allergy
						name
					/* version
						name, calories, fat, carbohydrates, protein, sodium, fiber, sugar
	*/
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 
		$this->load->helper('date_helper');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_menu($date, $client_id, $location_id)
	{
		// TO DO : Validating client ID and location ID
		$week = new Week($date, $client_id, $location_id);
		return $week;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : WEEK
//---------------------------------------------------------------------------------------------------------------
class Week {
	public $client_id;
	public $location_id;
	public $days = array();

	public function __construct($date, $client_id, $location_id) {
		$CI =& get_instance();

		$this->client_id = $client_id;
		$this->location_id = $location_id;
		foreach ( get_5_days($date) as $key => $val )
		{
			$new_day = new Day($val, $client_id, $location_id);
			array_push($this->days, $new_day);
		}
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Day
//---------------------------------------------------------------------------------------------------------------
class Day {
	public $client_id;
	public $location_id;
	public $date;
	public $entries = array();
	public $num_entries = 0;

	public function __construct($date, $client_id, $location_id) {
		$CI =& get_instance();
		$this->date = date('U', strtotime($date));
		$this->client_id = $client_id;
		$this->location_id = $location_id;

		$CI->db->order_by('order asc');
		$query = $CI->db->get_where('menu_entries', array("date" => $date, "client_id" => $client_id));
		if ( $query->num_rows() > 0 )
		{
			foreach ( $query->result() as $entry )
			{
				$new_entry = new Entry($entry, $client_id, $location_id);
				array_push($this->entries, $new_entry);
				$this->num_entries++;
			}
		}	}

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Entry
//---------------------------------------------------------------------------------------------------------------
class Entry {
	public $client_id;
	public $location_id;

	public $entry_id;
	public $menu_item_id;
	public $date;
	public $order;

	public $name;
	public $ingredients;
	public $rating = 0;
	public $rating_count = 0;
	public $allergies = array();
	public $versions = array();

	public function __construct($entryObject, $client_id, $location_id) {
		$CI =& get_instance();

		$this->client_id = $client_id;
		$this->location_id = $location_id;

		$this->entry_id = $entryObject->id;
		$this->menu_item_id = $entryObject->menu_item_id;
		$this->date = $entryObject->date;
		$this->order = $entryObject->order;

		// Grab Menu Item "Template" Data
		$itemQuery = $CI->db->get_where("menu_items", array('id' => $this->menu_item_id), 1);
		$itemResult = $itemQuery->first_row();
		$this->name = $itemResult->name;
		$this->ingredients = $itemResult->ingredients;

		// ALLERGIES
		$CI->db->select("*");
		$CI->db->from("allergies_entries");
		$CI->db->join('allergies', 'allergies.id = allergies_entries.allergy_id');
		$CI->db->where('allergies_entries.id', $this->entry_id);
		$CI->db->where('allergies.enabled', true);

		$allergiesQuery = $CI->db->get();

		foreach ( $allergiesQuery->result()  as $allergy )
		{
			$new_allergy = new AllergyC($allergy->id, $allergy->allergy_name);
			array_push($this->allergies,$new_allergy);
		}

		// VERSIONS
		$versionsQuery = $CI->db->get_where("menu_items_versions", array("menu_item_id" => $this->menu_item_id));
		foreach ( $versionsQuery->result() as $version )
		{
			$new_version = new Version($version);
			array_push($this->versions,$new_version);
		}

		// RATINGS
		$ratingsQuery = $CI->db->get_where("ratings", array("menu_item_id" => $this->menu_item_id, "client_id" => $this->client_id));
		foreach ( $ratingsQuery->result() as $rating ) 
			$this->rating += $rating->rating;
		if ( $ratingsQuery->num_rows() > 0 )
		{
			$this->rating_count = $ratingsQuery->num_rows();
			$this->rating = $this->rating/$this->rating_count;
		}
	}
}
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