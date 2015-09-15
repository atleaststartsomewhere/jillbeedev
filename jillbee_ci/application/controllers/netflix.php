<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
  public function index()
  {
    $this->load->view('require/top');
    $this->load->view('require/javascript');
    $this->load->view('require/body');
    $this->load->view('require/bottom');
  }

}