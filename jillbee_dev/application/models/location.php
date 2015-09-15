<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { parent::__construct(); }
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_client_locations($client_id, $ordered=false, $enabledFilter=false)
	{
		// Validate Parameters
		if ( !isset($client_id) )
			return "Error [L.GCL.1]: Client ID not set";

		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('enabled', true);

		$this->db->order_by('name asc');
		$query = $this->db->get_where('locations', array('client_id' => $client_id));

		// Check Query
		if ( $query->num_rows() <= 0 )
			return "Error [L.GCL.2]: No results returned";

		return $query->result();
	}
	public function get_locations($ordered=false, $enabledFilter=false)
	{
		// Validate Parameters
		
		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('enabled', true);

		$this->db->order_by('name asc');
		$query = $this->db->get_where('locations');
		
		// Check Query
		if ( $query->num_rows() <= 0 )
			return "Error [L.GL.1]: No results returned";

		return $query->result();
	}
}