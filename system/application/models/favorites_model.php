<?

class Favorites_model extends Model {

    function Favorites_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function add_favorites($submission_id, $user_id)
	{
		$this->db->set('submission_id', $submission_id);
		$this->db->set('user_id', $user_id);
		$this->db->insert('favorites');
	}
	
	function get_favorites($user_id, $limit = 9)
	{
		$sql = "SELECT * FROM submissions WHERE id IN (SELECT submission_id FROM favorites WHERE user_id=$user_id) LIMIT $limit";
		$query = $this->db->query($sql);
		$row = $query->result_array();
		return $row;
	}
	
	function delete_favorites($fav_id)
	{
		$this->db->where('id', $fav_id);
		$this->db->delete('favorites');
	}
}

?>
