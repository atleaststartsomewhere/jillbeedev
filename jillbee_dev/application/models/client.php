<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/Extended_Model.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLIENT MODEL
class Client extends Extended_Model
{

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function __construct() { 
		parent::__construct(); 
	}

	public function get_by_name($string)
	{
		if ( !isset($string) )
			return;// TO DO: repond > missing param

		$query = $this->db->get_where('clients', array('name'), 1);
		if ( $query->num_rows() < 1 )
			return;// TO DO: repond > client not found

		return $query->result();
	}
}