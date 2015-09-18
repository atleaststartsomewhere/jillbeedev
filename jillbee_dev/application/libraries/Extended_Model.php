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



}