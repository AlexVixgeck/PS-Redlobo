<?

class Submission_model extends Model {

    function Submission_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function get_owner_id($submission_id)
	{
		$this->db->where('id', $submission_id);
		$query = $this->db->get('submissions');
		$query = $query->row_array();
		return $query['owner_id'];
	}

	function insert_submission($filename, $owner_id, $xres, $yres, $username)
	{
		$this->db->set('filename', $filename);
		$this->db->set('owner_id', $owner_id);
		$this->db->set('xres', $xres);
		$this->db->set('yres', $yres);
		$this->db->set('owner_name', $username);
		$this->db->insert('submissions');
		
		return $this->db->insert_id();
	}
	
	function approve_submission($submission_id, $title, $description, $media_type, $category, $adult, $species, $orientation)
	{
		$timestamp 		= time();
		$publish 		= 1;
		$title			= $this->db->escape($title);
		$description	= $this->db->escape($description);
		
		$sql = "UPDATE submissions SET title=$title, description=$description, timestamp=$timestamp, media_type_id=$media_type, category_id=$category, adult=$adult, published=$publish WHERE id=$submission_id";
		$this->db->query($sql);
	}
	
	function get_submission_info($submission_id)
	{
		$query = $this->db->get_where('submissions', array('id'=>$submission_id));
		$row = $query->row_array();
		return $row;
	}
	
	function get_category_types()
	{
		$query = $this->db->get('category_types');
		return $query->result_array();
	}
	
	function get_category_name_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('category_types');
		$row = $query->row_array();
		return $row['type'];
	}
	
	function get_media_types()
	{
		$query = $this->db->get('media_types');
		return $query->result_array();
	}
	
	function get_media_type_name_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('media_types');
		$row = $query->row_array();
		return $row['type'];
	}
	
	function get_orientation_types()
	{
		$query = $this->db->get('orientation_types');
		return $query->result_array();
	}
	
	function get_species_types()
	{
		$query = $this->db->get('species_types');
		return $query->result_array();
	}
	
	function get_submissions($limit, $adult = 0, $user = null, $start = 1)
	{
		if(isset($user)) {
			$this->db->where('owner_id', $user);
		}
		
		if($adult != 1) {
			$this->db->where('adult', 0);
		}
		
		$this->db->where('published', 1);
		$offset = $limit * $start - $limit;
		$this->db->limit($limit, $offset);
		$this->db->order_by('timestamp', 'desc');
		$query = $this->db->get('submissions');
		return $query->result_array();
	}
	
	function get_latest_submissions($limit, $user, $adult)
	{
		if(isset($user)) {
			$this->db->where('owner_id', $user);
		}
		
		if($adult != 1) {
			$this->db->where('adult', 0);
		}
		
		$this->db->where('published', 1);
		$this->db->limit($limit);
		$this->db->order_by('timestamp', 'desc');
		$query = $this->db->get('submissions');
		return $query->result_array();
	}
	
	function increase_view($submission_id)
	{
		$this->db->where('id', $submission_id);
		$this->db->from('submissions');
		$query = $this->db->get();
		
		$row = $query->row_array();
		
		$count = $row['views'] + 1;
		
		$this->db->where('id', $submission_id);
		$this->db->update('submissions', array('views'=>$count));
	}
	
	function get_featured_submission()
	{
		$this->db->where('published', 1);
		$this->db->limit(1);
		$this->db->order_by('timestamp', 'desc');
		$query = $this->db->get('submissions');
		return $query->row_array();
	}
}

?>
