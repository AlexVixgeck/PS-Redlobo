<?php

class Profile extends Controller {

	function Profile()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('Header');
		$this->load->library('time');
		$this->load->library('cdn');
		
		$this->load->helper('url');
		$this->load->helper('form');

		//$this->load->model('news_model');
		$this->load->model('submission_model');
		$this->load->model('user_model');
		$this->load->model('avatar_model');
		$this->load->model('journal_model');
		$this->load->model('favorites_model');
		$this->load->model('shouts_model');
		$this->load->model('watchstream_model');
	}
	
	function index()
	{
		$header_data = $this->header->get_header_data();

		$user = ltrim($this->uri->segment(1), '~');
		$user_id = $this->user_model->get_user_by_name($user);

		if($user_id == NULL) {
			$this->load->view('header', $header_data);
        	$this->load->view('profile/user_not_found');
        	$this->load->view('footer');
		}
		else {
			$profile_header_data['profile_location']			= 1;
			$profile_header_data['profile_username'] 			= $user;
			$profile_header_data['profile_avatar_filename'] 	= $this->avatar_model->get_avatar($user_id);

			$profile_dash_data['profile_user_id']				= $user_id;
			$profile_dash_data['journal_entries']				= $this->journal_model->get_latest_journal_entries($user_id, 3);
			$profile_dash_data['dash_username']					= $user;
			$profile_dash_data['fav_entries']					= $this->favorites_model->get_favorites($user_id);
			$profile_dash_data['watched_by']					= $this->watchstream_model->watched_by($user_id);
			$profile_dash_data['is_watching']					= $this->watchstream_model->is_watching($user_id);
			$profile_dash_data['latest_submissions']			= $this->submission_model->get_submissions(9, $user_id);
			
			if($user_id == $this->dx_auth->get_user_id()) {
				$profile_dash_data['shouts']					= $this->shouts_model->get_all_shouts($user_id);
			}
			else {
				$profile_dash_data['shouts']					= $this->shouts_model->get_regular_shouts($user_id);
			}
			
			$profile_dash_data['is_logged_in']					= $header_data['is_logged_in'];
			if($header_data['is_logged_in'] != FALSE) {
				$profile_dash_data['shout_for_user_id']			= $user_id;
				$profile_dash_data['shout_from_user_id']		= $this->dx_auth->get_user_id();
			}

			$this->load->view('header', $header_data);
			$this->load->view('profile/profile_header', $profile_header_data);
			$this->load->view('profile/dash', $profile_dash_data);
			$this->load->view('footer');
		}
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
