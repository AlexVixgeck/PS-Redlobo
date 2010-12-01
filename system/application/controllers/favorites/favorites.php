<?php

class Favorites extends Controller {

	function Favorites()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('Header');
		
		$this->load->helper('url');

		$this->load->model('favorites_model');
	}
	
	function index()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$submission_id = $this->uri->segment(2);
		$user_id = $this->dx_auth->get_user_id();
		
		if(is_numeric($submission_id)) {
			$this->favorites_model->add_favorites($submission_id, $user_id);
		}
		
		redirect('/~' . $this->dx_auth->get_username() . '/');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
