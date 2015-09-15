<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends CI_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { parent::__construct(); }
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function add_rating($client_id, $menu_item_id, $rating)
	{
		// Validate Parameters
		if ( !isset($client_id) )
			return "Error [MODEL.R.AR.1]: Client ID not set";
		if ( !$this->check_valid_client_id($client_id) )
			return "Error [MODEL.R.AR.2]: Invalid Client ID";

		if ( !isset($menu_item_id) )
			return "Error [MODEL.R.AR.3]: Menu Item ID not set";
		if ( !$this->check_valid_menu_item_id($client_id) )
			return "Error [MODEL.R.AR.4]: Invalid Menu Item ID";

		if ( !isset($rating) )
			return "Error [MODEL.R.AR.5]: Rating not set";
		if ( $rating > 5 || $rating < 1 )
			return "Error [MODEL.R.AR.6]: Invalid Rating: ".$rating;

		// Run Query
		$ratingObject = array("client_id" => $client_id,
								"menu_item_idd" => $menu_item_id,
								"rating" => $rating);
		$query = $this->db->insert("ratings", $ratingObject);

		return $query;
	}

	public function check_valid_client_id($client_id)
	{
		$query = $this->db->get_where('clients', array('id' => $client_id), 1);
		if ( $query->num_rows() == 0 )
			return false;
		else
			return true;
	}
	public function check_valid_menu_item_id($menu_item_id)
	{
		$query = $this->db->get_where('menu_items', array('id' => $menu_item_id), 1);
		if ( $query->num_rows() == 0 )
			return false;
		else
			return true;
	}
}