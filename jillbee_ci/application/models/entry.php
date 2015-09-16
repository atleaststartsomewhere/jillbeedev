<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CLASS : Entry
//---------------------------------------------------------------------------------------------------------------
class Entry  {
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

	public function __construct($entryObject, $client_id, $location_id) {
		$CI 
		$this->client_id = $client_id;
		$this->location_id = $location_id;

		$this->entry_id = $entryObject->id;
		$this->menu_item_id = $entryObject->menu_item_id;
		$this->date = $entryObject->date;
		$this->order = $entryObject->order;

		// Grab Menu Item "Template" Data
		$itemQuery = $this->db->get_where("menu_items", array('id' => $this->menu_item_id), 1);
		$itemResult = $itemQuery->first_row();
		$this->name = $itemResult->name;
		$this->ingredients = $itemResult->ingredients;

		// ALLERGIES
		$this->db->select("*");
		$this->db->from("allergies_entries");
		$this->db->join('allergies', 'allergies.id = allergies_entries.allergy_id');
		$this->db->where('allergies_entries.id', $this->entry_id);
		$this->db->where('allergies.enabled', true);

		$allergiesQuery = $this->db->get();

		foreach ( $allergiesQuery->result()  as $allergy )
		{
			$new_allergy = new AllergyC($allergy->id, $allergy->allergy_name);
			array_push($this->allergies,$new_allergy);
		}

		// VERSIONS
		$versionsQuery = $this->db->get_where("menu_items_versions", array("menu_item_id" => $this->menu_item_id));
		foreach ( $versionsQuery->result() as $version )
		{
			$new_version = new Version($version);
			array_push($this->versions,$new_version);
		}

		// RATINGS
		$ratingsQuery = $this->db->get_where("ratings", array("menu_item_id" => $this->menu_item_id, "client_id" => $this->client_id));
		foreach ( $ratingsQuery->result() as $rating ) 
			$this->rating += $rating->rating;
		if ( $ratingsQuery->num_rows() > 0 )
		{
			$this->rating_count = $ratingsQuery->num_rows();
			$this->rating = $this->rating/$this->rating_count;
		}
	}
}