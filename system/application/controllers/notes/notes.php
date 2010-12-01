<?php

class Notes extends Controller {

	function Notes()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('Header');
		$this->load->library('pagination');
		$this->load->library('cdn');
		$this->load->library('time');
		
		$this->load->helper('url');

		$this->load->model('notes_model');
		$this->load->model('user_model');
	}
	
	function index()
	{
		$header_data = $this->header->get_header_data();
		if($this->dx_auth->is_logged_in() == FALSE) {
			redirect('/auth/login');
		}
		
		$user_id = $this->dx_auth->get_user_id();
		$username = $this->dx_auth->get_username();

		$config['base_url'] 		= site_url() . '~' . $username . '/notes';
		$config['total_rows'] 		= $this->notes_model->get_notes_count($user_id);
		$config['per_page']			= '10';
		$this->pagination->initialize($config);

		$header_data = $this->header->get_header_data();

		if($this->uri->segment(3)) {
			$mail_data['messages']			= $this->notes_model->get_mail_entries($user_id, 10, $this->uri->segment(3));
		}
		else {
			$mail_data['messages']			= $this->notes_model->get_mail_entries($user_id, 10);
		}
		$mail_data['pagination_html'] 	= $this->pagination->create_links();
		$mail_data['mailbox_type'] = 1;		//1 - Inbox, 2 - Sent

		$this->load->view('header', $header_data);
		$this->load->view('notes/notes_nav_bar');
		$this->load->view('notes/notes_inbox', $mail_data);
		$this->load->view('footer');
	}
	
	function sent()
	{
		$header_data = $this->header->get_header_data();
		if($this->dx_auth->is_logged_in() == FALSE) {
			redirect('/auth/login');
		}
		
		$user_id = $this->dx_auth->get_user_id();
		$username = $this->dx_auth->get_username();
		
		$config['base_url'] 		= site_url() . '~' . $username . '/notes/sent';
		$config['total_rows'] 		= $this->notes_model->get_sent_notes_count($user_id);
		$config['per_page']			= '10';
		$this->pagination->initialize($config);

		if($this->uri->segment(4)) {
			$mail_data['messages']			= $this->notes_model->get_sent_entries($user_id, 10, $this->uri->segment(4));
		}
		else {
			$mail_data['messages']			= $this->notes_model->get_sent_entries($user_id, 10);
		}
		$mail_data['pagination_html'] 	= $this->pagination->create_links();
		$mail_data['mailbox_type'] = 2;		//1 - Inbox, 2 - Sent

		$this->load->view('header', $header_data);
		$this->load->view('notes/notes_nav_bar');
		$this->load->view('notes/notes_inbox', $mail_data);
		$this->load->view('footer');
	}
	
	function read()
	{
		$header_data = $this->header->get_header_data();
		if($this->dx_auth->is_logged_in() == FALSE) {
			redirect('/auth/login');
		}
		
		$note_id = $this->uri->segment(4);
		
		if(is_numeric($note_id)) {
			$note_data['message']		= $this->notes_model->get_note($note_id);
		}
		
		$this->load->view('header', $header_data);
		if($this->dx_auth->get_user_id() == $note_data['message']['to_user_id']) {
			$this->load->view('notes/notes_read', $note_data);
			$this->notes_model->touch_read($note_id);
		}
		else {
			$this->load->view('notes/notes_error');
		}
		$this->load->view('footer');
	}

	function write()
	{
		$header_data = $this->header->get_header_data();
		if($this->dx_auth->is_logged_in() == FALSE) {
			redirect('/auth/login');
		}

			$user = ltrim($this->uri->segment(1), '~');
	        $user_id = $this->user_model->get_user_by_name($user);
			
			$profile_header_data['profile_location']			= 6;
			$profile_header_data['profile_username'] 			= $user;
			$profile_header_data['profile_avatar_filename'] 	= $this->avatar_model->get_avatar($user_id);

			$mail_write_data['mail_username']					= $this->dx_auth->get_username();
			$mail_write_data['rcpt_username']					= $user;

			
            $mail_write_data['to_user_id']         				= $user_id;

			$this->load->view('header', $header_data);
			$this->load->view('profile/profile_header', $profile_header_data);
        	$this->load->view('notes/notes_write', $mail_write_data);
        	$this->load->view('footer');
	}

	function send()
	{
		if($this->dx_auth->is_logged_in() == FALSE) {
            redirect('/auth/login');
        }
		else {
			$to_user_name 	= $this->input->post('recipient');
			$subject		= $this->input->post('subject');
			$content		= $this->input->post('content');
			$to_user_id 	= $this->user_model->get_user_by_name($to_user_name);
			$from_user_id	= $this->dx_auth->get_user_id();

			$this->notes_model->insert_mail($to_user_id, $from_user_id, $subject, $content);
		}
		
		redirect('/home');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
