<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : WEEK
//---------------------------------------------------------------------------------------------------------------
class FC_Week {
	public $client_id;
	public $location_id;
	public $days = array();

	public function __construct($params) {
		$CI =& get_instance();
		$CI->load->helper('date_helper');
		$CI->load->library('factories/menu/fc_day', array());
		
		if ( count($params) == 0 ) // is a library load, don't create a new object
			return;
		
		$date = $params['date'];
		$this->client_id = $params['client_id'];
		$this->location_id = $params['location_id'];

		foreach ( get_5_days($date) as $key => $val )
		{
			$parameters = array('date' => $val, 'client_id' => $this->client_id, 'location_id' => $this->location_id);
			$new_day = new FC_Day($parameters);
			array_push($this->days, $new_day);
		}
	}
}