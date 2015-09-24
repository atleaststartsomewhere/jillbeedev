<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Day
//---------------------------------------------------------------------------------------------------------------
class FC_Day {
	public $client_id;
	public $location_id;
	public $date;
	public $entries = array();
	public $num_entries = 0;

	public function __construct($params) {
		$CI =& get_instance();
		$CI->load->library('factories/menu/fc_entry', array());

		if ( count($params) == 0 ) // Is a library load, don't make a new object
			return;
		
		$date = $params['date'];
		$this->client_id = $params['client_id'];
		$this->location_id = $params['location_id'];
		$this->date = date('U', strtotime($date));

		$CI->db->order_by('order asc');
		$CI->db->where("id NOT IN (SELECT menu_entry_id from menu_entries_disabled_locations where location_id='".$this->location_id."')");
		$query = $CI->db->get_where('menu_entries', array("date" => $date, "client_id" => $this->client_id));
		if ( $query->num_rows() > 0 )
		{
			foreach ( $query->result() as $entry )
			{
				$parameters = array('entryObject' => $entry, 'client_id' => $this->client_id, 'location_id' => $this->location_id);
				$new_entry = new FC_Entry($parameters);
				array_push($this->entries, $new_entry);
				$this->num_entries++;
			}
		}
	}

}