<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Extended_Model.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATION MODEL
class Location extends Extended_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 

		$this->load->model('model_result'); // success, message, data
		$this->load->helper('security');
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
		if ( !$this->check_valid_client_id($client_id))
			return new Model_Result(false, "Error: Invalid Client ID".$client_id);

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

	public function create_location($client_id, $location_name, $enabled = false)
	{
		$response_messages = array();
		if (!$this->check_valid_location_name(xss_clean(base64_decode($location_name))))
			array_push($response_messages, 'location_name_exists');
		if (!$this->check_valid_client_id($client_id))
			array_push($response_messages, 'client_id_invalid');

		if (count($response_messages) > 0)
			return false;

		$location = array('client_id' => $client_id, 'name' => xss_clean(base64_decode($location_name)), 'enabled' => ($enabled === 'true') ? 1 : 0);
		$this->db->insert('locations', $location);
		return $this->get_client_locations($client_id, true, false);
	}

	public function remove($location_id)
	{
		if (!$this->check_valid_location($location_id))
			return false;

		$remove_query = $this->db->delete('locations', array('id' => $location_id));
		return $remove_query;


	}
}