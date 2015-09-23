<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Rating Unit Tests
//---------------------------------------------------------------------------------------------------------------
class Test_Locations extends CI_Controller
{
  function Test_Locations() { 
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
  }
  /* Template: POST
    $parameters = array('client' => '1', 'item' => '1', 'rating' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'One', 'valid submission');
    $this->load->view('test/post', $viewdata);
  // Template: GET
    $parameters = array('client' => '1', 'item' => '1', 'rating' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'One', 'valid submission');
    $this->load->view('test/get', $viewdata);
  */
//---------------------------------------------------------------------------------------------------------------

  public function index() {
    $this->load->view('test/require/top', array('title' => 'Locations Unit Tests')); // Required first view

    // Test 1 - Valid no parameter
    $parameters = array('client' => '1', 'location_name' => base64_encode('test_building'), 'enabled' => 'false');
    // url, parameter array, title, description
    $viewdata = $this->test_case('admin/api/locations/create', $parameters, 'One', 'Valid Create Location');
    $this->load->view('test/post', $viewdata);

    // Test 1 - Valid no parameter
    $parameters = array('location_id' => '47');
    // url, parameter array, title, description
    $viewdata = $this->test_case('admin/api/locations/remove', $parameters, 'Two', 'Remove Location');
    $this->load->view('test/post', $viewdata);


    $this->load->view('test/require/bottom' ); // Required last view
  }

  // Required - Utility Function
  public function test_case($url, $values, $title, $description) {
    $test_case = array();
    $test_case['url'] = $url; // api endpoint
    $test_case['values'] = $values; // api parameters
    $test_case['title'] = $title; // number of test-case
    $test_case['description'] = $description;   
    return $test_case; 
  }

}