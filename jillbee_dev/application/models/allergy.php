<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Extended_Model.php';

class Allergy extends Extended_Model
{

	public $id;				// int
	public $name;			// string

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 
		$this->load->model('utility/api_response');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_client_allergies($client_id, $ordered=false, $enabledFilter=false)
	{
		// Validate Parameters
		/* RESPONSE LOGGING: @param_validate */
		$response_messages = array();
		if ( !isset($client_id) )
			array_push($response_messages, 'client_id_missing');
		if ( !$this->check_valid_client_id($client_id) )
			array_push($response_messages, 'client_id_invalid');

		if ( count($response_messages) > 0 )
			return $this->api_response->make('param_validate', false, $response_messages, __FUNCTION__, func_get_args(), array());

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
		/* RESPONSE LOGGING: @check_query */
		if ( $query->num_rows() <= 0 )
			return $this->api_response->make('check_query', false, array('no_rows'), __FUNCTION__, func_get_args(), array());

		// Success
		/* RESPONSE LOGGING: @success */
		return $this->api_response->make('success', true, array('success'), __FUNCTION__, func_get_args(), $query->result());
	}
	public function get_allergies($ordered=false, $enabledFilter=false)
	{
		// Run Query
		if ($ordered === 'true')
			$this->db->order_by('order asc');
		if ($enabledFilter === 'true')
			$this->db->where('enabled', true);

		$this->db->order_by('allergy_name asc');
		$query = $this->db->get_where('allergies');
		
		// Check Query
		/* RESPONSE LOGGING: @check_query */
		if ( $query->num_rows() <= 0 )
			return $this->api_response->make('check_query', false, array('no_rows'), __FUNCTION__, func_get_args(), array());

		// Success
		/* RESPONSE LOGGING: @success */
		return $this->api_response->make('success', true, array('success'), __FUNCTION__, func_get_args(), $query->result());
	}
}