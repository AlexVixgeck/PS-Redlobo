<?php

class Shouts extends Controller {

	function Shouts()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('Header');
		
		$this->load->helper('url');

		$this->load->model('shouts_model');
	}
	
	function index()
	{
		redirect('/home');
	}
	
	function post()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		if($this->input->post('shout_message'))
		{
			$message 		= $this->input->post('shout_message', TRUE);
			$from_user_id 	= $this->dx_auth->get_user_id();
			$for_user_id 	= $this->input->post('for_user_id', TRUE);
			$private 		= $this->input->post('private', TRUE);
			
			$this->shouts_model->add_shout($for_user_id, $from_user_id, $message, $private);
		}
		
		redirect('/home');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
