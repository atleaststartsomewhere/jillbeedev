<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Day
//---------------------------------------------------------------------------------------------------------------
class Day extends CI_Model {
	public $client_id;
	public $location_id;
	public $date;
	public $entries = array();
	public $num_entries = 0;

	public function Day($date, $client_id, $location_id) {
		parent::__construct();
		$this->load->model('entry');
		$this->date = $date;
		$this->client_id = $client_id;
		$this->location_id = $location_id;

		$this->db->order_by('order asc');
		$query = $this->db->get_where('menu_entries', array("date" => $date, "client_id" => $client_id));
		if ( $query->num_rows() > 0 )
		{
			foreach ( $query->result() as $entry )
			{
				$new_entry = new Entry($entry, $client_id, $location_id);
				array_push($this->entries, $new_entry);
				$this->num_entries++;
			}
		}
	}

}