<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : WEEK
//---------------------------------------------------------------------------------------------------------------
class Week {
	public $client_id;
	public $location_id;
	public $days = array();

	public function __construct($date, $client_id, $location_id) {
		$CI =& get_instance();

		$this->client_id = $client_id;
		$this->location_id = $location_id;
		foreach ( get_5_days($date) as $key => $val )
		{
			$new_day = new Day($val, $client_id, $location_id);
			array_push($this->days, $new_day);
		}
	}
}