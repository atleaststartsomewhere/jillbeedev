<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Extended_Model.php';

class Allergy extends Extended_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 
		$this->load->language('api_responses');
		$this->load->model('response');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_client_allergies($client_id, $ordered=false, $enabledFilter=false)
	{
		$response = new stdClass(); $response->message[asdfasdfakdfm;lasd]

		// Validate Parameters
		/* RESPONSE LOGGING: @param_validate */
		if ( !isset($client_id) )
			$this->response->add_messages($response, 'client_id_missing');
		if ( !$this->check_valid_client_id($client_id) )
			$param_messages .= $this->response->messages('client_id_invalid');



		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('allergies.enabled', true);

		$this->db->order_by('allergies.allergy_name asc');
		$this->db->select("*");
		$this->db->from("allergies_clients");
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

		$this->db->order_by('allergy_name asc');
		$query = $this->db->get_where('allergies');
		
		// Check Query
		if ( $query->num_rows() <= 0 )
			return "Error [MODEL.A.GL.1]: No results returned";

		return $query->result();
	}
}