<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment {

	var $CI;

	function Comment()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->library('cdn');

		$this->CI->load->model('tags_model');
	}
	
	function get_user_tags($user_id)
	{
		$tag_array = array();
		$tags = $this->CI->db->
	}
	
	function get_top_tags
}

?>
