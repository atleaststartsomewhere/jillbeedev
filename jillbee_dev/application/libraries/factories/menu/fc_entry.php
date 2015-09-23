<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Entry
//---------------------------------------------------------------------------------------------------------------
class FC_Entry {
	public $client_id;
	public $location_id;

	public $entry_id;
	public $menu_item_id;
	public $date;
	public $order;

	public $name;
	public $ingredients;
	public $rating = 0;
	public $rating_count = 0;
	public $allergies = array();
	public $versions = array();

	public function __construct($params) {
		$CI =& get_instance();
		$CI->load->library('factories/menu/fc_allergy', array());
		$CI->load->library('factories/menu/fc_version', array());

		if ( count($params) == 0 ) // Is a library load, don't make a new object
			return;

		$this->client_id = $params['client_id'];
		$this->location_id = $params['location_id'];

		$this->entry_id = $params['entryObject']->id;
		$this->menu_item_id = $params['entryObject']->menu_item_id;
		$this->date = $params['entryObject']->date;
		$this->order = $params['entryObject']->order;

		// Grab Menu Item "Template" Data
		$itemQuery = $CI->db->get_where("menu_items", array('id' => $this->menu_item_id), 1);
		$itemResult = $itemQuery->first_row();
		$this->name = $itemResult->name;
		$this->ingredients = $itemResult->ingredients;

		// ALLERGIES
		$CI->db->select("*");
		$CI->db->from("allergies_entries");
		$CI->db->join('allergies', 'allergies.id = allergies_entries.allergy_id');
		$CI->db->where('allergies_entries.menu_item_id', $this->menu_item_id);
		$CI->db->where('allergies.enabled', true);

		$allergiesQuery = $CI->db->get();

		foreach ( $allergiesQuery->result()  as $allergy )
		{
			$parameters = array('allergy_id' => $allergy->id, 'allergy_name' => $allergy->allergy_name);
			$new_allergy = new FC_Allergy($parameters);
			array_push($this->allergies,$new_allergy);
		}

		// VERSIONS
		$versionsQuery = $CI->db->get_where("menu_items_versions", array("menu_item_id" => $this->menu_item_id));
		foreach ( $versionsQuery->result() as $version )
		{
			$parameters = array('versionObject' => $version);
			$new_version = new FC_Version($parameters);
			array_push($this->versions,$new_version);
		}

		// RATINGS
		$ratingsQuery = $CI->db->get_where("ratings", array("menu_item_id" => $this->menu_item_id, "client_id" => $this->client_id));
		foreach ( $ratingsQuery->result() as $rating ) 
			$this->rating += $rating->rating;
		if ( $ratingsQuery->num_rows() > 0 )
		{
			$this->rating_count = $ratingsQuery->num_rows();
			$this->rating = $this->rating/$this->rating_count;
		}
	}
}