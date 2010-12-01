<?php

class Settings extends Controller {

	function Settings()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('form_validation');
		$this->load->library('Avatar_File_Operations');
		$this->load->library('header');
		$this->load->library('cdn');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('avatar_model');
		$this->load->model('settings_model');
	}
	
	function index()
	{
        $header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }

		$this->load->view('header', $header_data);
        $this->load->view('settings/settings_nav_bar');
        $this->load->view('settings/settings_main');
        $this->load->view('footer');

	}
	
	function info()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$preferences_data['preferences']		= $this->settings_model->get_user_preferences($this->dx_auth->get_user_id());
		
		$this->load->view('header', $header_data);
        $this->load->view('settings/settings_nav_bar');
        $this->load->view('settings/info', $preferences_data);
        $this->load->view('footer');
	}
	
	function update()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }

		//Lets make sure a user has a row in the user_preferences table
		$this->settings_model->check_if_preferences_exists($this->dx_auth->get_user_id());

		$this->settings_model->update_adult($this->dx_auth->get_user_id(), $this->input->post('AllowAdult'));

		redirect('/~' . $this->dx_auth->get_username() . '/settings');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
