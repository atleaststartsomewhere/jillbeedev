<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Rating Unit Tests
//---------------------------------------------------------------------------------------------------------------
class Test_Ratings extends CI_Controller
{
  function Test_Ratings() { 
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
    $this->load->view('test/require/top', array('title' => 'Rating Unit Tests')); // Required first view

    // Test 1 - Valid Rating
    $parameters = array('client' => '1', 'item' => '1', 'rating' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'One', 'valid submission');
    $this->load->view('test/post', $viewdata);

    // Test 2 - Invalid client
    $parameters = array('client' => '0', 'item' => '1', 'rating' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'Two', 'Invalid client');
    $this->load->view('test/post', $viewdata);

    // Test 3 - Invalid rating
    $parameters = array('client' => '1', 'item' => '1', 'rating' => '0');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'Three', 'Invalid rating');
    $this->load->view('test/post', $viewdata);

    // Test 4 - Invalid item
    $parameters = array('client' => '1', 'item' => '0', 'rating' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'Four', 'Invalid item');
    $this->load->view('test/post', $viewdata);

    // Test 5 - Client missing
    $parameters = array('item' => '1', 'rating' => '0');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'Five', 'Client missing');
    $this->load->view('test/post', $viewdata);

    // Test 6 - Item missing
    $parameters = array('client' => '1', 'rating' => '0');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'Six', 'Item missing');
    $this->load->view('test/post', $viewdata);

    // Test 7 - Rating missing
    $parameters = array('client' => '1', 'item' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'Seven', 'Rating missing');
    $this->load->view('test/post', $viewdata);

    // Test 8 - Client and Item missing
    $parameters = array('rating' => '1');
    // url, parameter array, title, description
    $viewdata = $this->test_case('api/ratings/add/', $parameters, 'Eight', 'Client and Item missing');
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