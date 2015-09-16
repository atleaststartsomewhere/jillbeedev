<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Rating Unit Tests
//---------------------------------------------------------------------------------------------------------------
class Test_Allergies extends CI_Controller
{
  function Test_Allergies() { 
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
    $this->load->view('test/require/top', array('title' => 'Allergies Unit Tests')); // Required first view

    // Test 1 - Valid Client
    $parameters = array('client' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/allergies/', $parameters, 'One', 'Valid client');
    $this->load->view('test/get', $viewdata);

    // Test 2 - Invalid client
    $parameters = array('client' => '0');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/allergies/', $parameters, 'Two', 'Invalid client');
    $this->load->view('test/get', $viewdata);

    // Test 2 - No client
    $parameters = array();
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/allergies/', $parameters, 'Three', 'No client');
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