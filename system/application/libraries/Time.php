<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Time {

	function Time()
	{
	}

	function unix_time_to_date($timestamp)
	{
		return date("F jS, Y g:i A", $timestamp);
	}
}

?>
