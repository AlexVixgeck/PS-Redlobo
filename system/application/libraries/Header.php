<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header {

	var $CI;

	function Header()
	{
		$this->CI =& get_instance();

		$this->CI->load->library('DX_Auth');

		$this->CI->load->model('avatar_model');
		$this->CI->load->model('watchstream_model');
		$this->CI->load->model('notes_model');
	}

	function get_header_data()
	{
		if($this->CI->dx_auth->is_logged_in()) {
			$header_data['is_logged_in'] = TRUE;
			$header_data['avatar_location'] = $this->CI->avatar_model->get_avatar($this->CI->dx_auth->get_user_id());
			$header_data['username'] = $this->CI->dx_auth->get_username();
			$header_data['watchstream_count'] = $this->CI->watchstream_model->get_watchstream_data_count($this->CI->dx_auth->get_user_id());
			$header_data['notes_count'] = $this->CI->notes_model->get_new_notes_count($this->CI->dx_auth->get_user_id());
			$header_data['user_id'] = $this->CI->dx_auth->get_user_id();
		}
		else {
			$header_data['is_logged_in'] = FALSE;
		}

		return $header_data;
	}
}

?>
