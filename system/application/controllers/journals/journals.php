<?php

class Journals extends Controller {

	function Journals()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('header');
		$this->load->library('cdn');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('user_model');
		$this->load->model('avatar_model');
		$this->load->model('journal_model');
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
			$profile_header_data['profile_location']			= 3;
			$profile_header_data['profile_username'] 			= $user;
			$profile_header_data['profile_avatar_filename'] 	= $this->avatar_model->get_avatar($user_id);

			if($this->uri->segment(3) == FALSE) {
				//no journal_id, list users journal entries
				$journal_data['journal_username']				= $user;
                $journal_data['journal_entries']                = $this->journal_model->get_journal_entries($user_id, 100);

				$this->load->view('header', $header_data);
				$this->load->view('profile/profile_header', $profile_header_data);
				$this->load->view('journals/journal_list', $journal_data);
				$this->load->view('footer');
			}
			else {
				//journal_id found, display that entry.
				$journal_data['journal_avatar_location']		= $this->avatar_model->get_avatar($user_id);
				$journal_data['journal_username']				= $user;
				$journal_data['journal_entry'] 					= $this->journal_model->get_journal_entry($this->uri->segment(3));

				$this->load->view('header', $header_data);
            	$this->load->view('profile/profile_header', $profile_header_data);
            	$this->load->view('journals/journal_view', $journal_data);
            	$this->load->view('footer');
			}
		}
	}

	function write()
	{
		if($this->dx_auth->is_logged_in() == FALSE)	{
			redirect('/auth/login');
		}

		$user = ltrim($this->uri->segment(1), '~');
		$user_id = $this->user_model->get_user_by_name($user);
		
		if($this->dx_auth->get_username() != $user)	{
			redirect('/~' . $this->dx_auth->get_username() . '/journals/write');
		}

		$header_data = $this->header->get_header_data();
		$profile_header_data['profile_location']			= 3;
		$profile_header_data['profile_username'] 			= $user;
		$profile_header_data['profile_avatar_filename'] 	= $this->avatar_model->get_avatar($user_id);
		$journal_post_data['journal_username'] = $this->dx_auth->get_username();

		$this->load->view('header', $header_data);
        $this->load->view('profile/profile_header', $profile_header_data);
        $this->load->view('journals/journal_post', $journal_post_data);
        $this->load->view('footer');
	}

	function publish()
	{
		if($this->dx_auth->is_logged_in() == FALSE) {
            redirect('/auth/login');
        }

        $user = ltrim($this->uri->segment(1), '~');
        if($this->dx_auth->get_username() != $user) {
            redirect('/~' . $this->dx_auth->get_username() . '/journals/post');
        }

		$user_id 	= $this->dx_auth->get_user_id();
		$title 		= $this->input->post('title', TRUE);
		$content	= $this->input->post('content', TRUE);

		$this->journal_model->insert_journal_entry($user_id, $title, $content);

		$inserted_id = $this->db->insert_id();
		
		$this->watchstream_model->add_watchstream_data($user_id, $inserted_id, 2); // type = 2 journals.

		redirect('/~' . $this->dx_auth->get_username() . '/journals/' . $inserted_id);
	}
}

/* End of file journals.php */
/* Location: ./system/application/controllers/journals.php */
