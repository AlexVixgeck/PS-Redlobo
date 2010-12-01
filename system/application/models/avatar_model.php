<?

class Avatar_model extends Model {

    function Avatar_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function get_total_avatars($user_id)
	{
		$this->db->from('avatars');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		
		return $query->num_rows();
	}

	function get_avatar($user_id)
	{
		if($this->get_total_avatars($user_id) < 1) {
			return "default.png";
		}
		
		//$this->db->select('file_name');
		$this->db->from('avatars');
		$this->db->where('user_id', $user_id);
		$this->db->where('selected', '1');
		$query = $this->db->get();

		$row = $query->row_array();
		return $row['file_name'];
	}
    
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
		
		return $this->db->insert_id();
	}
	
	function set_avatar($avatar_id, $user_id)
	{
		$data = array('selected' => '0');
		$this->db->where('user_id', $user_id);
		$this->db->update('avatars', $data);
		$data = array('selected' => '1');
		$this->db->where('id', $avatar_id);
		$this->db->update('avatars', $data);
	}
}

?>
