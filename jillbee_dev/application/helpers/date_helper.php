<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_monday($date)
{
	$date_help = array("Monday" => "+0", "Tuesday" => "-1", "Wednesday" => "-2", "Thursday" => "-3",
	"Friday" => "-4", "Saturday" => "+2", "Sunday" => "+1");

    $param =  $date_help[date('l', strtotime($date))]." day";

    return date('Y-m-d', strtotime( $param, strtotime($date)));
}

function get_5_days($date)
{
	$date_help = array("Monday" => "+0", "Tuesday" => "+1", "Wednesday" => "+2", "Thursday" => "+3",
	"Friday" => "+4");

	$return = array();
	foreach ( $date_help as $key => $val )
		array_push($return, date('Y-m-d', strtotime($date_help[$key]." day", strtotime($date))));
	
	return $return;
}