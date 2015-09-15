<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_monday($date)
{
	$date_help = array("Monday" => "+0", "Tuesday" => "-1", "Wednesday" => "-2", "Thursday" => "-3",
	"Friday" => "-4", "Saturday" => "+2", "Sunday" => "+1");

    $param =  $date_help[date('l', strtotime($date))]." day";
    
    return date('Y-m-d', strtotime( $param, strtotime($date)));
}