<?php

class Dash extends Controller {

	function Dash()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('header');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('user_model');
		$this->load->model('avatar_model');
		$this->load->model('journal_model');
	}
	
	function index()
	{
		$header_data = $this->header->get_header_data();

		$user = ltrim($this->uri->segment(1), '~');
		$user_id = $this->user_model->get_user_by_name($user);

		if($user_id == NULL) {
			$this->load->view('header', $header_data);
        	$this->load->view('profile_user/user_not_found');
        	$this->load->view('footer');
		}
		else {
			$profile_header_data['profile_username'] 			= $user;
			$profile_header_data['profile_avatar_location'] 	= $this->avatar_model->get_avatar($user_id);

			$profile_dash_data['journal_entries']				= $this->journal_model->get_latest_journal_entries($user_id, 3);
			$profile_dash_data['dash_username']					= $user;

			$this->load->view('header', $header_data);
			$this->load->view('profile_user/profile_header', $profile_header_data);
			$this->load->view('profile_user/dash', $profile_dash_data);
			$this->load->view('footer');
		}

	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
