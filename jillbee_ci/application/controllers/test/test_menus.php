<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Rating Unit Tests
//---------------------------------------------------------------------------------------------------------------
class Test_Menus extends CI_Controller
{
  function Test_Menus() { 
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
    $viewdata = $this->test_case(base_url().'index.php/api/ratings/add/', $parameters, 'One', 'valid submission');
    $this->load->view('test/get', $viewdata);
  */
//---------------------------------------------------------------------------------------------------------------

  public function index() {
    $this->load->view('test/require/top', array('title' => 'Menus Unit Tests')); // Required first view

    // Test 1 - Valid Menu
    $parameters = array('client' => '1', 'location' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/menus/', $parameters, 'One', 'Valid submission');
    $this->load->view('test/get', $viewdata);

    // Test 2 - Invalid client
    $parameters = array('client' => '0', 'location' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/menus/', $parameters, 'Two', 'Invalid client');
    $this->load->view('test/get', $viewdata);

    // Test 3 - Invalid location
    $parameters = array('client' => '1', 'location' => '0');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/menus/', $parameters, 'Three', 'Invalid location');
    $this->load->view('test/get', $viewdata);

    // Test 4 - Invalid client and location
    $parameters = array('client' => '0', 'location' => '0');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/menus/', $parameters, 'Four', 'Invalid client and location');
    $this->load->view('test/get', $viewdata);

    // Test 5 - Missing client
    $parameters = array('location' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/menus/', $parameters, 'Five', 'Missing client');
    $this->load->view('test/get', $viewdata);

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