<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Allergy extends CI_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { parent::__construct(); }
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_client_allergies($client_id, $ordered=false, $enabledFilter=false)
	{
		// Validate Parameters
		if ( !isset($client_id) )
			return "Error [MODEL.A.GCA.1]: Client ID not set";

		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('allergies.enabled', true);

		$this->db->order_by('name asc');
		$this->db->select("*");
		$this->db->from("allergy_clients");
		$this->db->join('allergies', 'allergies.id = allergies_clients.allergy_id');
		$this->db->where('allergies_clients.id', $client_id);

		$query = $this->db->get();

		// Check Query
		if ( $query->num_rows() <= 0 )
			return "Error [MODEL.A.GCL.2]: No results returned";

		return $query->result();
	}
	public function get_allergies($ordered=false, $enabledFilter=false)
	{
		// Validate Parameters
		
		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('enabled', true);

		$this->db->order_by('name asc');
		$query = $this->db->get_where('allergies');
		
		// Check Query
		if ( $query->num_rows() <= 0 )
			return "Error [MODEL.A.GL.1]: No results returned";

		return $query->result();
	}
}