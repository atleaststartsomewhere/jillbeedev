<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Extended_Model.php';

class Menu_Item extends Extended_Model
{

	public $id;				// int
	public $name;			// string
	public $ingredients;	// string
	public $allergies; 		// array 		// Joined from Allergies and Allergies_Entries table
	public $versions; 		// array 		// Joined from Menu_Items_Versions table

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { parent::__construct(); }
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_item($id)
	{
		// Validate Parameters
		if ( !isset($id) )
			return false;
		
		// Run Query
		$query = $this->db->get_where('menu_items', array('id' => $id), 1); // Limit 1
		// Check Query
		if ( $query->num_rows() <= 0 )
			return false;

		return $query->result();
	}
}