<?

class User_model extends Model {

    function User_model()
    {
        // Call the Model constructor
        parent::Model();
    }

	function get_user_by_name($user_name)
	{
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('username', $user_name);
		$query = $this->db->get();

		if($query->num_rows() == 0) {
			return NULL;
		}
		else {
			$row = $query->row_array();
			return $row['id'];
		}
	}
	
	function get_username_by_id($user_id)
	{
		$this->db->select('username');
		$this->db->from('users');
		$this->db->where('id', $user_id);
		
		$query = $this->db->get();
		$row = $query->row_array();
		return $row['username'];
	}
    
	/*
    function update_avatar($user_id, $new_avatar)
    {
		$data = array('file_name' => $new_avatar);
        $this->db->where('user_id', $user_id);
        $this->db->update('avatars', $data);
    }

	function insert_avatar($user_id, $new_avatar)
	{
		$data = array('user_id' => $user_id, 'file_name' => $new_avatar);
		$this->db->insert('avatars', $data);
	}
	*/
}

?>
