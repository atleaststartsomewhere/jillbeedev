<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATION MODEL
class Location extends CI_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 

		$this->load->model('model_result'); // success, message, data
	}
	//---------------------------------------------------------------------------------------------------------------
	// get_client_locations [client_id*, ordered, enabledFilter]
	// 		Gets locations for a given client id
	//		Enabled filter (true) will only return rows with enabled=1
	//		Enabled filter (false) will return rows regardless of enabled value
	//		All rows will be ordered by name, but the order column will take precedence if ordered=true
	//---------------------------------------------------------------------------------------------------------------
	public function get_client_locations($client_id, $ordered=false, $enabledFilter=false)
	{
		// Validate Parameters
		if ( !isset($client_id) )
			return new Model_Result(false, "Error: Missing Client ID");

		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('enabled', true);

		$this->db->order_by('name asc');
		$query = $this->db->get_where('locations', array('client_id' => $client_id));

		// Check Query
		if ( $query->num_rows() <= 0 )
			return new Model_Result(false, "Error: No Results Found");

		return new Model_result(true, "Success: One or More Locations Sent", $query->result());
	}
	public function get_locations($ordered=false, $enabledFilter=false)
	{
		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('enabled', true);

		$this->db->order_by('name asc');
		$query = $this->db->get_where('locations');
		
		// Check Query
		if ( $query->num_rows() <= 0 )
			return new Model_Result(false, "Error: No Results Found");

		return new Model_result(true, "Success: One or More Locations Sent", $query->result());
	}
}