<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Test extends REST_Controller
{
  public function index_get()
  {
    echo 'get<br /><form action="test" method="POST"><button type="submit">abc</button><input type="hidden" value="abc" name="xyz" /></form>';
    var_dump($this->query());
  }

  public function index_post()
  {
    echo 'post';
  }

  public function items_get()
  {
  	$date = $this->get("date");

  	echo $this->response(array('test' => date("Y-m-d", strtotime($date)), "items" => array("one" => "two")), 200);
  }

}