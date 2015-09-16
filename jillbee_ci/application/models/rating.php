<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends CI_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 
		$this->load->model('model_result'); // success, message, data
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function add_rating($client_id, $menu_item_id, $rating)
	{
		// Validate Parameters
		if ( !isset($client_id) )
			return new Model_Result(false, "Error: Missing Client ID");
		if ( !$this->check_valid_client_id($client_id) )
			return new Model_Result(false, "Error: Invalid Client ID >> ".$client_id);

		if ( !isset($menu_item_id) )
			return new Model_Result(false, "Error: Missing Menu Item ID");
		if ( !$this->check_valid_menu_item_id($menu_item_id) )
			return new Model_Result(false, "Error: Invalid Menu Item ID >> ".$menu_item_id);

		if ( !isset($rating) )
			return new Model_Result(false, "Error: Missing Rating");
		if ( $rating > 5 || $rating < 1 )
			return new Model_Result(false, "Error: Invalid Rating >> ".$rating);

		// Run Query
		$ratingObject = array("client_id" => $client_id,
								"menu_item_id" => $menu_item_id,
								"rating" => $rating);
		$query = $this->db->insert("ratings", $ratingObject);

		// Send back new rating and count
		$newRatingObject = new stdClass();
		$newRatingObject = $this->get_rating($client_id, $menu_item_id);
		return new Model_Result(true, "New Rating Recorded.",$newRatingObject);
	}

	public function get_rating($client_id, $menu_item_id)
	{
		$resultObject = new stdClass();
		$resultObject->rating = 0;
		$resultObject->rating_count = 0;

		$query = $this->db->get_where("ratings", array("menu_item_id" => $menu_item_id, "client_id" => $client_id));
		foreach ( $query->result() as $rating ) 
			$resultObject->rating += $rating->rating;
		if ( $query->num_rows() > 0 )
		{
			$resultObject->rating_count = $query->num_rows();
			$resultObject->rating = $resultObject->rating/$resultObject->rating_count;
		}
		return $resultObject;
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