<?php

class Submission extends Controller {

	function Submission()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
		$this->load->library('form_validation');
		$this->load->library('Submission_File_Operations');
		$this->load->library('header');
		$this->load->library('cdn');

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('avatar_model');
		$this->load->model('submission_model');
		$this->load->model('watchstream_model');

	}
	
	function index()
	{
        redirect('/home');

	}
	
	function upload()
	{
		$header_data = $this->header->get_header_data();
		if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$this->load->view('header', $header_data);
        $this->load->view('upload/upload');
        $this->load->view('footer');
	}
	
	function metadata()
	{
		$header_data = $this->header->get_header_data();
		if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$config['upload_path'] 		= './data/tmp/submissions';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '2000';
		$config['remove_spaces']	= true;

		$this->load->library('upload', $config);


		if(!$this->upload->do_upload('location')) {
			$body_data['upload_error'] = $this->upload->display_errors();
			
			$this->load->view('header', $header_data);
	        $this->load->view('upload/upload_submission_failed', $body_data);
			$this->load->view('footer');

		}
		else {
			$upload_data = $this->upload->data();
			
			//add to DB
			$submission_id = $this->submission_model->insert_submission($upload_data['file_name'], $this->dx_auth->get_user_id(), $upload_data['image_width'], $upload_data['image_height'], $this->dx_auth->get_username());
			//Move the file into the right place
			$this->submission_file_operations->finalize_submission($this->dx_auth->get_user_id(), $upload_data['file_name']);
			//Create its thumbnail and half-sized copy
			$this->submission_file_operations->create_thumbnail($this->dx_auth->get_user_id(), $upload_data['file_name']);
			$this->submission_file_operations->create_halfsize($this->dx_auth->get_user_id(), $upload_data['file_name']);

			$body_data['submission_id'] 	= $submission_id;
			$body_data['user_id']			= $this->dx_auth->get_user_id();
			$body_data['filename']			= $upload_data['file_name'];
			$body_data['category_types']	= $this->submission_model->get_category_types();
			$body_data['media_types']		= $this->submission_model->get_media_types();
			$body_data['orientation_types']	= $this->submission_model->get_orientation_types();
			$body_data['species_types']		= $this->submission_model->get_species_types();
			
           	$this->load->view('header', $header_data);
           	$this->load->view('upload/approve_upload', $body_data);
           	$this->load->view('footer');
		}

	}
	
	function publish()
	{
		$header_data = $this->header->get_header_data();
		if($header_data['is_logged_in'] == FALSE) {
            redirect('/home');
        }
		
		$title 			= $this->input->post('title');
		$description 	= $this->input->post('description');
		$keywords		= $this->input->post('keywords');
		$media_type		= $this->input->post('media_type_id');
		$category		= $this->input->post('category_id');
		$adult			= $this->input->post('adult');
		$submission_id	= $this->input->post('submission_id');
		$orientation	= $this->input->post('orientation');
		$species		= $this->input->post('species');
		if(!$adult) {
			$adult = 0;
		}
		
			
		$this->submission_model->approve_submission($submission_id, $title, $description, $media_type, $category, $adult, $orientation, $species);
		$this->watchstream_model->add_watchstream_data($this->dx_auth->get_user_id(), $submission_id, 1); // 1 = submissions.
		// add keywords
		
		redirect('/view/' . $submission_id);
	}
	
	function upload_dynamic_resize()
	{
		$submission_id = $this->uri->segment(3);
		$submission_info = $this->submission_model->get_submission_info($submission_id);
		
		$config['image_library'] = 'gd2';
		$config['source_image']	= '/home/anthro/public_html/data/submissions/' . $submission_info['owner_id'] . '/' . $submission_info['filename'];
		$config['dynamic_output'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['master_dim'] = "width";
		$config['width']	 = 300;
		$this->load->library('image_lib', $config);
		
		$this->image_lib->resize();
	}

}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
