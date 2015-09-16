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
    $parameters = array();
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'One', 'Valid No Parameter');
    $this->load->view('test/get', $viewdata);

    // Test 2 - Valid Client, Order true, Enabled true
    $parameters = array('client' => '1', 'order' => 'true', 'enabled' => 'true');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Two', 'Valid Client, Order true, Enabled true');
    $this->load->view('test/get', $viewdata);

    // Test 3 - Invalid client, Order true, Enabled true
    $parameters = array('client' => '0', 'order' => 'true', 'enabled' => 'true');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Three', 'Invalid Client, Order true, Enabled true');
    $this->load->view('test/get', $viewdata);

    // Test 4 - Valid Client, Order False, Enabled true
    $parameters = array('client' => '1', 'order' => 'false', 'enabled' => 'true');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Four', 'Valid Client, Order False, Enabled true');
    $this->load->view('test/get', $viewdata);

    // Test 5 - Valid Client, Order true, Enabled false
    $parameters = array('client' => '1', 'order' => 'true', 'enabled' => 'false');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Five', 'Valid Client, Order true, Enabled false');
    $this->load->view('test/get', $viewdata);

    // Test 6 - Valid Client, Order and Enabled false
    $parameters = array('client' => '1', 'order' => 'false', 'enabled' => 'false');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Six', 'Order and Enabled False');
    $this->load->view('test/get', $viewdata);

    // Test 7 - Invalid Client, Order and Enabled false
    $parameters = array('client' => '0', 'order' => 'false', 'enabled' => 'false');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Seven', 'Invalid Client, Order and Enabled False');
    $this->load->view('test/get', $viewdata);

    // Test 8 - Enabled true Only
    $parameters = array('enabled' => 'true');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Eight', 'Enabled true Only');
    $this->load->view('test/get', $viewdata);

    // Test 9 - Order true Only
    $parameters = array('order' => 'true');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Nine', 'Order true Only');
    $this->load->view('test/get', $viewdata);

    // Test 10 - Valid Client Parameter Only
    $parameters = array('client' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Ten', 'Valid Client Only');
    $this->load->view('test/get', $viewdata);

    // Test 11 - Enabled false Only
    $parameters = array('enabled' => 'false');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Eleven', 'Enabled false Only');
    $this->load->view('test/get', $viewdata);

    // Test 12 - Order false Only
    $parameters = array('order' => 'true');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Twelve', 'Order false Only');
    $this->load->view('test/get', $viewdata);

    // Test 13 - Invalid Client Parameter Only
    $parameters = array('client' => '0');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/locations/', $parameters, 'Thirteen', 'Invalid Client Only');
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