<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Extended_Model.php';

class Rating extends Extended_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 
		$this->load->model('utility/api_response');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function add_rating($client_id, $menu_item_id, $rating)
	{
		// Validate
		$error_messages = array();
		if ( !$this->check_valid_client_id($client_id) )
			array_push($error_messages, 'Client ID ['.$client_id.']');
		if ( !$this->check_valid_menu_item_id($menu_item_id) )
			array_push($error_messages, 'Menu Item ID ['.$menu_item_id.']');
		if ( $rating > 5 || $rating < 1 )
			array_push($error_messages, 'Rating ['.$rating.']');
		if ( count($error_messages) > 0 )
			return $this->api_response->create(false, array('param_invalid' => $error_messages));
		// End-Validate

		// Run Query
		$ratingObject = array("client_id" => $client_id,
								"menu_item_id" => $menu_item_id,
								"rating" => $rating);
		$query = $this->db->insert("ratings", $ratingObject);

		// Send back new rating and count
		$rating = $this->get_rating($client_id, $menu_item_id);
		if ( !$rating['success'] )
			return $rating;
		else
			return $this->api_response->create(true, array('success'), $rating['data']);
	}

	public function get_rating($client_id, $menu_item_id)
	{
		// Validate
		$error_messages = array();
		if ( !$this->check_valid_client_id($client_id) )
			array_push($error_messages, 'Client ID ['.$client_id.']');
		if ( !$this->check_valid_menu_item_id($menu_item_id) )
			array_push($error_messages, 'Menu Item ID ['.$menu_item_id.']');
		if ( count($error_messages) > 0 )
			return $this->api_response->create(false, $error_messages);
		// End-Validate

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
			return $this->api_response->create(true, array('success'), $resultObject);
		}
		else
			return $this->api_response->create(false, array('no_rows'));			
	}
}