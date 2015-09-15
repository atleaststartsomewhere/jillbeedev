<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
	public function __construct() { parent::__construct(); }
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_menu($date)
	{
		// Get 5 days
		$day1 = date('Y-m-d', strtotime($date));
		$day2 = date('Y-m-d', strtotime("+1 day", strtotime($date)));
		$day3 = date('Y-m-d', strtotime("+2 day", strtotime($date)));
		$day4 = date('Y-m-d', strtotime("+3 day", strtotime($date)));
		$day5 = date('Y-m-d', strtotime("+4 day", strtotime($date)));

		
	}
}