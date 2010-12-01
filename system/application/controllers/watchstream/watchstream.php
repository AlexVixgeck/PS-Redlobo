<?php

class Watchstream extends Controller {

	function Watchstream()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('Header');
		$this->load->library('cdn');

		$this->load->helper('url');
		$this->load->helper('form');
		
		$this->load->model('watchstream_model');
		$this->load->model('avatar_model');
		$this->load->model('user_model');
	}
	
	function index()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$user_id = $this->dx_auth->get_user_id();
		
		$body_data['watched_by']			= $this->watchstream_model->watched_by($user_id);
		$body_data['is_watching'] 			= $this->watchstream_model->is_watching($user_id);

		$this->load->view('header', $header_data);
        $this->load->view('watchstream/list', $body_data);
        $this->load->view('footer');
	}
	
	function watch()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$watched_user = ltrim($this->uri->segment(1), '~');
		$watched_user_id = $this->user_model->get_user_by_name($watched_user);
		$user_id = $this->dx_auth->get_user_id();
		
		$err = $this->watchstream_model->add_watch($user_id, $watched_user_id);
		if($err < 0) {
			$body_data['watch_result'] = "You can'r watch yourself. Duh.";
		}
		elseif($err == 0) {
			$body_data['watch_result'] = "You've already watched this user.";
		}
		else {
			$body_data['watch_result'] = $watched_user . " has been added to your watchstream.";
		}
		
		$this->load->view('header', $header_data);
        $this->load->view('watchstream/add_watch', $body_data);
        $this->load->view('footer');	
	}
	
	function watchstream_dash()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }

		$watchstream_dash_data['watchstream_submissions']		= $this->watchstream_model->get_watchstream_submission_data($this->dx_auth->get_user_id(), 15);
		$watchstream_dash_data['watchstream_journals']			= $this->watchstream_model->get_watchstream_journal_data($this->dx_auth->get_user_id(), 10);
		
		$this->load->view('header', $header_data);
		$this->load->view('watchstream/watchstream_dash', $watchstream_dash_data);
		$this->load->view('footer');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
