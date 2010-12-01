<?php

class Gallery extends Controller {

	function Gallery()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('header');
		$this->load->library('time');
		$this->load->library('cdn');
		$this->load->library('comment');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('avatar_model');
		$this->load->model('submission_model');
		$this->load->model('user_model');
		$this->load->model('comments_model');
		$this->load->model('settings_model');
	}
	
	function index()
	{
		print("TEST");
        print($this->time->unix_time_to_date(time()));

	}
	
	function view()
	{
		$header_data = $this->header->get_header_data();

		$submission_id = $this->uri->segment(2);
		$this->submission_model->increase_view($submission_id);
		$submission_info = $this->submission_model->get_submission_info($submission_id);
		
		$body_data['submission_id']					= $submission_info['id'];
		$body_data['submission_owner_id']			= $submission_info['owner_id'];
		$body_data['submission_filename']			= $submission_info['filename'];
		$body_data['submission_title']				= $submission_info['title'];
		$body_data['submission_description']		= $submission_info['description'];
		$body_data['submission_time']				= $this->time->unix_time_to_date($submission_info['timestamp']);
		$body_data['submission_xres']				= $submission_info['xres'];
		$body_data['submission_yres']				= $submission_info['yres'];
		$body_data['submission_views']				= $submission_info['views'];
		$body_data['submission_media_type']			= $this->submission_model->get_media_type_name_by_id($submission_info['media_type_id']);
		$body_data['submission_category']			= $this->submission_model->get_category_name_by_id($submission_info['category_id']);
		$body_data['submission_adult']				= $submission_info['adult'];
		
		$comments_data['submission_id']				= $submission_id;
		$comments_data['type_id']					= 1;
		
		$this->load->view('header', $header_data);
        $this->load->view('gallery/view', $body_data);
		$this->load->view('comments/view_comments', $comments_data);
        $this->load->view('footer');
		
	}
	
	function test_comments()
	{
		$this->comments_model->add_comment(48, 1, 5, "test", "bigger string", 0, 0);
	}
	
	function user_gallery()
	{
		$user = ltrim($this->uri->segment(1), '~');
		$user_id = $this->user_model->get_user_by_name($user);
		$header_data = $this->header->get_header_data();
		$profile_header_data['profile_username'] 			= $user;
		$profile_header_data['profile_avatar_filename'] 	= $this->avatar_model->get_avatar($user_id);
		$profile_header_data['profile_location']			= 4;
		$limit = 10;
		
		$page_number = $this->uri->segment(3, 1);
		
		if(is_numeric($page_number)) {
			$body_data['latest_submissions'] 			= $this->submission_model->get_submissions($limit, $this->settings_model->show_adult($this->dx_auth->get_user_id()), $user_id, $page_number);
			$gallery_navigation_data['nav_left_link'] 	= $page_number - 1;
			$gallery_navigation_data['nav_right_link']	= $page_number + 1;
		}
		else {
			$body_data['latest_submissions'] = $this->submission_model->get_submissions($limit, $this->settings_model->show_adult($this->dx_auth->get_user_id()), $user_id);
			$gallery_navigation_data['nav_left_link'] 	= 0;
			$gallery_navigation_data['nav_right_link']	= 1;
		}
		
		$gallery_navigation_data['username']		= $user;
		
		$this->load->view('header', $header_data);
		$this->load->view('profile/profile_header', $profile_header_data);
		$this->load->view('gallery/user_gallery_navigation', $gallery_navigation_data);
        $this->load->view('gallery/user_gallery', $body_data);
        $this->load->view('footer');
	}
	
	function test()
	{
		$header_data = $this->header->get_header_data();
		
		$this->load->view('header', $header_data);
        $this->load->view('gallery/viewtest');
        $this->load->view('footer');
	}
	
	function ajax_gallery()
	{
		$limit = 36;
		
		//$submissions = $this->submission_model->get_submissions($limit, null);
		
		$gallery_data['submissions'] = $submissions;
		$this->load->view('gallery/ajax_gallery', $gallery_data);
	}
	
	function ajax_get_latest()
	{
		//$limit = $this->input->post('limit');
		$limit = 20;
		$submissions = $this->submission_model->get_latest_submissions($limit, null);
		$gallery_data['submissions'] = $submissions;
		$this->load->view('gallery/ajax_gallery', $gallery_data);
	}
	
	function browse()
	{
		$header_data = $this->header->get_header_data();
		
		$limit = 20;
		
		$page_number = $this->uri->segment(2, 1);
		
		if(is_numeric($page_number)) {
			if($header_data['is_logged_in'] == TRUE) {
				$body_data['latest_submissions'] 			= $this->submission_model->get_submissions($limit, $this->settings_model->show_adult($this->dx_auth->get_user_id()), NULL, $page_number);
			}
			else {
				$body_data['latest_submissions'] 			= $this->submission_model->get_submissions($limit, 0, NULL, $page_number);
			}
			$browse_navigation_data['nav_left_link'] 	= $page_number - 1;
			$browse_navigation_data['nav_right_link']	= $page_number + 1;
		}
		else {
			if($header_data['is_logged_in'] == TRUE) {
				$body_data['latest_submissions'] = $this->submission_model->get_submissions($limit, $this->settings_model->show_adult($this->dx_auth->get_user_id()), NULL);
			}
			else {
				$body_data['latest_submissions'] = $this->submission_model->get_submissions($limit, 0, NULL);
			}
			$browse_navigation_data['nav_left_link'] 	= 0;
			$browse_navigation_data['nav_right_link']	= 1;
		}
		
		$this->load->view('header', $header_data);
		$this->load->view('gallery/browse_navigation', $browse_navigation_data);
		$this->load->view('gallery/browse', $body_data);
        $this->load->view('footer');
	}
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
