<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
	}

	public function index()
	{

	}

	public function add_rating()
	{
		$this->load->view('debug/anchor_top');
		$this->load->view('debug/add_rating');
		$this->load->view('debug/anchor_bottom');
	}
}