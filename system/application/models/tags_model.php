<?

class Tags_model extends Model {

    function Tags_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function get_user_tags($user_id)
	{
		$query = $this->db->query("SELECT * FROM tags_index WHERE submission_id IN (SELECT id FROM submissions WHERE owner_id=$user_id AND published=1)");
		foreach($query->result_array() as $row) {
		
		}
	}
	
	function tag_exists($tag)
	{
		$this->db->where('tag', $tag);
		$query = $this->db->get('tags');
		if($query->num_rows() >= 1) {
			$row = $query->row_array();
			return $row['id'];
		}
		else {
			return 0;
		}
	}

	function add_tags($submission_id, $tag_array)
	{
		foreach($tag_array as $tag)
		{
			//check to see if the tag exists in the tags table
			$tag_id = $this->tag_exists($tag);
			if($tag_id == 0) {
				//add tag
				$this->db->set('tag', $tag);
				$this->db->insert('tags');
				$tag_id = $this->db->insert_id();
			}
			
			//add tags_index entry
			$this->db->set('tag_id', $tag_id);
			$this->db->set('submission_id', $submission_id);
			$this->db->insert('tags_index');
		}
	}
	
	function get_most_popular_tags($limit)
	{
		$timestamp 		= time();
		$publish 		= 1;
		$title			= $this->db->escape($title);
		$description	= $this->db->escape($description);
		
		$sql = "UPDATE submissions SET title=$title, description=$description, timestamp=$timestamp, media_type_id=$media_type, category_id=$category, adult=$adult, published=$publish WHERE id=$submission_id";
		$this->db->query($sql);
	}
	
	function get_users_tags($user_id)
	{
		$sql = "SELECT * FROM tags_index WHERE submission_id IN(SELECT id FROM submissions WHERE owner_id=$user_id)";
		$query = $this->db->query($sql);
	}
}

?>
