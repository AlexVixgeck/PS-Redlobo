<?php

class Comments extends Controller {

	function Comments()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('header');
		$this->load->library('cdn');

		$this->load->helper('url');

		$this->load->model('user_model');
		$this->load->model('avatar_model');
		$this->load->model('comments_model');
		$this->load->model('submission_model');
		$this->load->model('watchstream_model');
	}
	
	function index()
	{
		redirect('/home');
	}

	function reply()
	{
		if($this->dx_auth->is_logged_in() == FALSE)	{
			redirect('/auth/login');
		}

		$header_data = $this->header->get_header_data();
		
		
		if($this->uri->total_rsegments() == 4)
		{
			$submission_id 		= $this->uri->rsegment(3);
			$type_id			= $this->uri->rsegment(4);
		
			if(is_numeric($submission_id) && is_numeric($type_id))
			{
				$body_data['submission_id'] 	= $submission_id;
				$body_data['type_id']			= $type_id;
			}
		}
		else if($this->uri->total_rsegments() == 5)
		{
			$submission_id 		= $this->uri->rsegment(3);
			$type_id			= $this->uri->rsegment(4);
			$parent_id			= $this->uri->rsegment(5);
		
			if(is_numeric($submission_id) && is_numeric($type_id) && is_numeric($parent_id))
			{
				$body_data['submission_id']	= $submission_id;
				$body_data['type_id']		= $type_id;
				$body_data['parent_id'] 	= $parent_id;
			}
		}

		$this->load->view('header', $header_data);
        $this->load->view('comments/reply', $body_data);
        $this->load->view('footer');
	}

	function publish()
	{
		if($this->dx_auth->is_logged_in() == FALSE) {
            redirect('/auth/login');
        }

		$submission_id 		= $this->input->post('submission_id', TRUE);
		$type_id			= $this->input->post('type_id', TRUE);
		$subject			= $this->input->post('subject', TRUE);
		$comment			= $this->input->post('comment', TRUE);
		$parent_id			= $this->input->post('parent_id', TRUE);
		if(!$parent_id)
		{
			$parent_id 	= 0;
			$level		= 0;
		}
		else
		{
			//Get level
			$level = $this->comments_model->get_level($parent_id);
			$level++;
		}

		$comment_id = $this->comments_model->add_comment($submission_id, $type_id, $this->dx_auth->get_user_id(), $subject, $comment, 0, $parent_id, $level);
		$this->watchstream_model->add_watchstream_comment($this->submission_model->get_owner_id($submission_id), $comment_id);

		redirect('/home');
	}
}

/* End of file journals.php */
/* Location: ./system/application/controllers/journals.php */
