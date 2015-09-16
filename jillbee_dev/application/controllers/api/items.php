<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// LOCATIONS API CONTROLLER
// : index
class Items extends REST_Controller {

	function Items()	{
		parent::__construct();
		$this->load->model('menu_item');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Item Endpoint
	//  Must supply an item id, and the API gives you back it's name and ingredient string
	//---------------------------------------------------------------------------------------------------------------
	// * = required
	//  Query
	//      id (int)*
	//---------------------------------------------------------------------------------------------------------------
	public function index_get()
	{
		if ( !$this->get('id') )
		{
			$this->response(array("result" => "failure", "message" => "API Error: No 'id' supplied"), 200);
			return;
		}

		$item = $this->menu_item->get_item($this->get('id'));
		$this->response(array("result" => "success", "item" => $item), 200);
	}
}