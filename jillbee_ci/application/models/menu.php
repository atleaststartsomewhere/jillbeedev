<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Extended_Model.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : MENU
//---------------------------------------------------------------------------------------------------------------
class Menu extends Extended_Model
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
		$this->load->library('factories/menu/fc_week', array());
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_menu($date, $client_id, $location_id)
	{
		$parameters = array('date' => $date, 'client_id' => $client_id, 'location_id' => $location_id);
		$week = new FC_Week($parameters);
		return $week;
	}
}

