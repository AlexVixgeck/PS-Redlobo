<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submission_File_Operations {

	var $tmp_avatar_path;
	var $final_avatar_path;
	var $root_folder;
	var $CI;

	function Submission_File_Operations()
	{
		$this->CI =& get_instance();
		
		$this->tmp_submission_path		= 'tmp/submissions/';
    	$this->final_submission_path	= 'submissions/';
		$this->root_folder				= '/home/anthro/public_html/data/';
	}
	
	function create_thumbnail($user_id, $filename)
	{
		$this->CI->load->library('image_lib');
		$this->CI->image_lib->clear();
		
		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $this->root_folder . $this->final_submission_path . $user_id . '/' . $filename;
		$config['new_image'] 		= $this->root_folder . $this->final_submission_path . $user_id . '/thumb.' . $filename;
		$config['dynamic_output'] 	= FALSE;
		$config['maintain_ratio'] 	= TRUE;
		$config['master_dim'] 		= "width";
		$config['width']			= 120;
		$config['height']			= 120;
		
		$this->CI->image_lib->initialize($config);
		
		$this->CI->image_lib->resize();
		
		
	}
	
	function create_halfsize($user_id, $filename)
	{
		$this->CI->load->library('image_lib');
		$this->CI->image_lib->clear();
		
		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $this->root_folder . $this->final_submission_path . $user_id . '/' . $filename;
		$config['new_image'] 		= $this->root_folder . $this->final_submission_path . $user_id . '/half.' . $filename;
		$config['dynamic_output'] 	= FALSE;
		$config['maintain_ratio'] 	= TRUE;
		$config['master_dim'] 		= "width";
		$config['width']			= 300;
		$config['height']			= 300;
		
		$this->CI->image_lib->initialize($config);
		
		$this->CI->image_lib->resize();
	}
	
	function create_submission_path($path)
	{
		//Called before moving a file from tmp to final dir. Check to see if path has
		//been created, and create if doesn't exist.
		if(file_exists($path))
		{
			return;
		}
		
		//path doesn't exists, so lets create it
		mkdir($path);
		return;
	}

	function finalize_submission($user_id, $filename)
	{
		$user_submission_path = $this->root_folder . $this->final_submission_path . $user_id;
		$this->create_submission_path($user_submission_path);
		
		//move from tmp to final location
		copy($this->root_folder . $this->tmp_submission_path . $filename, $user_submission_path . '/' . $filename);
		//delete tmp avatar
		unlink($this->root_folder . $this->tmp_submission_path . $filename);
	}
}

?>
