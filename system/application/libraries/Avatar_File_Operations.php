<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avatar_File_operations {

	var $tmp_avatar_path;
	var $final_avatar_path;
	var $root_folder;

	function Avatar_File_operations()
	{
		$this->tmp_avatar_path		= 'data/tmp/avatars/';
    	$this->final_avatar_path	= 'data/avatars/';
		$this->root_folder			= '/home/anthro/public_html/';
	}

	function finalize_avatar($user_id, $new_avatar_filename)
	{
		$CI =& get_instance();
		$CI->load->model('avatar_model');
		$avatar_count = $CI->avatar_model->get_total_avatars($user_id);
		if($avatar_count >= 5) {
			//return 0, cuz they already have enough avatars.
			return 0;
			//move from tmp to final location
			//copy($this->root_folder . $this->tmp_avatar_path . $new_avatar, $this->root_folder . $this->final_avatar_path . $new_avatar);
			//delete tmp avatar
			//unlink($this->root_folder . $this->tmp_avatar_path . $new_avatar);
			//create new entry in avatar table
			//$CI->avatar_model->insert_avatar($user_id, $new_avatar);
		}
		else {
			$final_filename = time() . "." . $new_avatar_filename;
			//Copy new avatar to final destination.
			copy($this->root_folder . $this->tmp_avatar_path . $new_avatar_filename, $this->root_folder . $this->final_avatar_path . $final_filename);
			unlink($this->root_folder . $this->tmp_avatar_path . $new_avatar_filename);
			$avatar_id = $CI->avatar_model->insert_avatar($user_id, $final_filename);
			$CI->avatar_model->set_avatar($avatar_id, $user_id);
			
			return $final_filename;
		}
	}
}

?>
