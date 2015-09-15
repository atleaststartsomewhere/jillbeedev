<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CDA API CONTROLLER
//---------------------------------------------------------------------------------------------------------------
// ENDPOINTS:
//---------------------------------------------------------------------------------------------------------------
class Api extends REST_Controller
{
  function Api()
  {
    parent::__construct();

    $this->load->helper('date_helper');

    $this->load->model('allergy');
    $this->load->model('location');
    $this->load->model('menu');
    $this->load->model('menu_item');
    $this->load->model('rating');
  }

  public function index_get()
  {

  }

  public function index_post()
  {

  }  
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Menu Endpoint
  //  Must supply a client id and location id, and returns the menu entries for the work week the current day belongs to
  //---------------------------------------------------------------------------------------------------------------
  // * = required
  //  Query
  //      client (int)*
  //      location (int)*
  //---------------------------------------------------------------------------------------------------------------
  public function menu_get()
  {
    $error_message = "";
    if ( !$this->get('client') )
      $error_message .= " 'client' missing; ";
    if ( !$this->get('location') )
      $error_message .= " 'location' missing; ";

    if ( !empty($error_message) )
    {
      $this->response(array("result" => "failure", "message" => "API Error: ".$error_message), 400);
      return;
    }

    //---------------------------------------------------------------------------------------------------------------
    if ( !$this->get('day') )
      $monday = get_monday(date('Y-m-d'));
    else
      $monday = get_monday($this->get('day'));

    $menu = $this->menu->get_menu($monday, $this->get('client'), $this->get('location'));

    $this->response($menu, 200);


  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Item Endpoint
  //  Must supply an item id, and the API gives you back it's name and ingredient string
  //---------------------------------------------------------------------------------------------------------------
  // * = required
  //  Query
  //      id (int)*
  //---------------------------------------------------------------------------------------------------------------
  public function item_get()
  {
    if ( !$this->get('id') )
    {
      $this->response(array("result" => "failure", "message" => "API Error: No 'id' supplied"),400);
      return;
    }

    $item = $this->menu_item->get_item($this->get('id'));
    $this->response(array("result" => "success", "item" => $item), 200);
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Location Endpoint
  //  No parameters returns all locations in database
  //  Otherwise supplied parameters narrow results by client or filter the results
  //---------------------------------------------------------------------------------------------------------------
  // * = required
  //  Query
  //      client (int)
  //  Query Options
  //      order (bool)
  //      enabled (bool)
  //---------------------------------------------------------------------------------------------------------------
  public function location_get()
  {
    // TO DO: Client ID will be encrypted, so decrypt and send to model
    if ( $this->get('client') )
    {
      $locations = $this->location->get_client_locations($this->get('client'), $this->get('order'), $this->get('enabled'));
      $this->response(array("result" => "success", "locations" => $locations), 200);
      return;
    }
    else
    {
      $locations = $this->location->get_locations($this->get('order'), $this->get('enabled'));
      $this->response(array("result" => "success", "locations" => $locations), 200);      
      return;
    }
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Allergy Endpoint
  //  Can optionally supply a client to get valid allergies for a client, or just all alergies (with not client param)
  //---------------------------------------------------------------------------------------------------------------
  // * = required
  //  Query
  //      client (int)
  //---------------------------------------------------------------------------------------------------------------
  public function allergy_get()
  {

  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Rating Endpoint
  //  Must supply an item ID and a rating (int) and the API saves the additional/new rating for the item off to the database
  //---------------------------------------------------------------------------------------------------------------
  // * = required
  //  Query
  //      item (int)*
  //      rating (int)*
  //---------------------------------------------------------------------------------------------------------------
  public function rating_post()
  {

  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // Meta Endpoint
  //  Must supply an endpoint parameter and the API returns a set of parameters the API has for developer
  //  assistance.
  //---------------------------------------------------------------------------------------------------------------
  // * = required
  //  Query
  //      endpoint (string)*
  //---------------------------------------------------------------------------------------------------------------
  public function meta_get()
  {
    // Endpoint definitions
    $menu = array(
              array('parameter' => 'client',
                'required' => 'yes',
                'expected' => 'integer'),
              array('parameter' => 'location',
                'required' => 'yes',
                'expected' => 'integer'),
              array('parameter' => 'date',
                'required' => 'no',
                'expected' => 'YYYY-MM-DD')
              );
    $item = array(
              array('parameter' => 'id',
                'required' => 'yes',
                'expected' => 'integer')
              );
    $location = array(
              array('parameter' => 'client',
                'required' => 'no',
                'expected' => 'integer'),
              array('parameter' => 'order',
                'required' => 'no',
                'expected' => 'true/false'),
              array('parameter' => 'enabled',
                'required' => 'no',
                'expected' => 'true/false')
              );

    // Verify endpoint parameter
    if ( !$this->get('endpoint') )
    {
      $this->response(array("message" => "API Error: No 'endpoint' supplied"),400);
      return;
    }
    // Show endpoint meta -->
    // ALL ENDPOINTS
    if ( $this->get('endpoint') === 'all' ) { $this->response(array("menu" => $menu, "item" => $item, "location" => $location), 200); return; }
    // MENU ENDPOINT
    else if ( $this->get('endpoint') === 'menu' ) { $this->response($menu, 200); return; }
    // ITEM ENDPOINT
    else if ( $this->get('endpoint') === 'item' ) { $this->response($item, 200); return; }
    // LOCATION ENDPOINT
    else if ( $this->get('endpoint') === 'location' ) { $this->response($location, 200); return; }
  }
}