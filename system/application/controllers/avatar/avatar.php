<?php

class Avatar extends Controller {

	function Avatar()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('Avatar_File_Operations');
		$this->load->library('header');
		$this->load->library('cdn');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('avatar_model');
	}
	
	function index()
	{
            redirect('/home');
	}

	function change_avatar()
	{
        $header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }

		$body_data['current_avatar'] = $this->avatar_model->get_avatar($this->dx_auth->get_user_id());
		$this->load->view('header', $header_data);
		$this->load->view('settings/settings_nav_bar');
		$this->load->view('settings/avatar', $body_data);
		$this->load->view('footer');
	}

	function avatar_upload()
	{
		$header_data = $this->header->get_header_data();
        if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$config['upload_path'] 		= './data/tmp/avatars';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '50';
		$config['max_width']		= '100';
		$config['max_height']		= '100';

		$this->load->library('upload', $config);

		$body_data['current_avatar'] = $this->avatar_model->get_avatar($this->dx_auth->get_user_id());

		if(!$this->upload->do_upload('location')) {
			$body_data['upload_error'] = $this->upload->display_errors();
			
			$this->load->view('header', $header_data);
			$this->load->view('settings/settings_nav_bar');
			$this->load->view('settings/avatar', $body_data);
			$this->load->view('footer');

		}
		else {
            $body_data['current_avatar'] = $this->avatar_model->get_avatar($this->dx_auth->get_user_id());

			$upload_data = $this->upload->data();
			$this->avatar_file_operations->finalize_avatar($this->dx_auth->get_user_id(), $upload_data['file_name']);

			$body_data['current_avatar'] = $this->avatar_model->get_avatar($this->dx_auth->get_user_id());
            $this->load->view('header', $header_data);
            $this->load->view('settings/settings_nav_bar');
            $this->load->view('settings/tmp_avatar_upload_success', $body_data);
            $this->load->view('footer');
		}
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
