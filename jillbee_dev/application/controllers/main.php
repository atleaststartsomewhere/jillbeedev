<?php defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');

		$this->input->set_cookie(base64_encode('client'), urlencode(base64_encode(1)), 0);

		//$this->output->cache(30);
		$this->output->set_header("HTTP/1.0 200 OK");
		$this->output->set_header("HTTP/1.1 200 OK");
		//$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_update).' GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Expires: ".gmdate('r'));

		$viewdata = array();
		$viewdata['react_url'] = base_url().REACT_LOCATION;
		//$viewdata['storedClientKey'] = base64_encode('client');
		//$viewdata['storedClientValue'] = base64_encode(1); // to do : dynamic based on client url
		
		/*$sessiondata = array('storedClientKey' => base64_encode('client'),
							'storedClientValue' => base64_encode(1)
						); // to do : dynamic based on client url
		$this->session->set_userdata($sessiondata);*/
		$this->load->view('react/index', $viewdata);

	}

	public function client()
	{
		echo $this->uri->segment(3);
	}
}