<?php

defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Extended Model
class Extended_Model extends CI_Model {

	public function __construct()	{
		parent::__construct();
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

	public function check_valid_location_name($location_name)
	{
		$query = $this->db->get_where('locations', array('name' => $location_name), 1);
		if ($query->num_rows() == 0)
			return true;
		else
			return false;
	}

	public function check_valid_location($location_id)
	{
		$query = $this->db->get_where('locations', array('id' => $location_id), 1);
		if ($query->num_rows() == 0)
			return false;
		else
			return true;
	}

}