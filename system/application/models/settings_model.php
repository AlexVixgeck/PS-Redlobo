<?

class Settings_model extends Model {

    function Settings_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function show_adult($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_preferences');
		
		if($query->num_rows() == 0) {
			return 0;
		}
		
		$row = $query->row_array();
		
		if($row['allow_adult'] == 1) {
			return 1;
		}
		else {
			return 0;
		}
	}
	
	function check_if_preferences_exists($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_preferences');
		if($query->num_rows() == 0)
		{
			$this->db->set('user_id', $user_id);
			$this->db->insert('user_preferences');
		}
	}
    
    function get_user_preferences($user_id)
    {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_preferences');
        return $query->row_array();
    }
	
	function update_adult($user_id, $allow_adult)
	{
		$this->db->set('allow_adult', $allow_adult);
		$this->db->where('user_id', $user_id);
		$this->db->update('user_preferences');
	}
}

?>
