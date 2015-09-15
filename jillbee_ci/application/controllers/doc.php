<?php defined('BASEPATH') OR exit('No direct script access allowed');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// API Documentation Page
//---------------------------------------------------------------------------------------------------------------
class Doc extends CI_Controller
{
  function Doc()
  {
    parent::__construct();
    $this->load->helper('form');
  }

  public function index()
  {
    $this->load->view('doc/anchor_top');
    $this->load->view('doc/anchor_bottom');
  }

}