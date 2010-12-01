<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('Header');
		$this->load->library('time');
		$this->load->library('cdn');
		
		$this->load->helper('url');

		$this->load->model('news_model');
		$this->load->model('submission_model');
		$this->load->model('settings_model');
	}
	
	function index()
	{
		$header_data = $this->header->get_header_data();

		$body_data['news_data'] = $this->news_model->get_news(3);

		if($header_data['is_logged_in'] == TRUE) {
			$body_data['latest_submissions'] 		= $this->submission_model->get_latest_submissions(20, null, $this->settings_model->show_adult($this->dx_auth->get_user_id()));
			$body_data['featured_submission']		= $this->submission_model->get_featured_submission();
		}
		else {
			$body_data['latest_submissions'] 		= $this->submission_model->get_latest_submissions(20, null, 0);
			$body_data['featured_submission']		= $this->submission_model->get_featured_submission();
		}
	
		$this->load->view('header', $header_data);
		$this->load->view('body_home', $body_data);
		$this->load->view('footer');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
