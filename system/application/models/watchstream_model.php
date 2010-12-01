<?

class Watchstream_model extends Model {

    function Watchstream_model()
    {
        // Call the Model constructor
        parent::Model();
		
		$this->load->model('avatar_model');
    }
	
	function add_watch($user_id, $watched_user_id)
	{
		if($user_id == $watched_user_id) {
			//don't be redonkulous.
			return -1;
		}
		
		$this->db->where('user_id', $user_id);
		$this->db->where('watched_user_id', $watched_user_id);
		$this->db->from('watchstream_index');
		$count = $this->db->count_all_results();
		if($count >= 1) {
			//already watched.
			return 0;
		}
		
		$this->db->set('user_id', $user_id);
		$this->db->set('watched_user_id', $watched_user_id);
		
		$this->db->insert('watchstream_index');
		return 1;
	}
	
	function is_watching($user_id)
	{
		$this->db->select('watched_user_id');
		$this->db->where('user_id', $user_id);
		$this->db->from('watchstream_index');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function watched_by($user_id)
	{
		$this->db->select('user_id');
		$this->db->where('watched_user_id', $user_id);
		$this->db->from('watchstream_index');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_watchstream_data_count($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->from('watchstream_data');
		
		return $this->db->count_all_results();
	}
	
	function get_watchstream_watchers_count($user_id)
	{
		$this->db->where('watched_user_id', $user_id);
		$this->db->from('watchstream_index');
		
		return $this->db->count_all_results();
	}
	
	function get_watchstream_is_watching_count($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->from('watchstream_index');
		
		return $this->db->count_all_results();
	}
	
	function add_watchstream_data($user_id, $entry_id, $type)
	{
		$this->db->where('watched_user_id', $user_id);
		$this->db->from('watchstream_index');
		$query = $this->db->get();
		
		foreach($query->result_array() as $row)
		{
			//for now type = (1 = submission, 2 = journal, 3 = comments, 4 = watches, 5 = favs)
			$this->db->set('user_id', $row['user_id']);
			$this->db->set('entry_id', $entry_id);
			$this->db->set('type_id', $type);
		
			$this->db->insert('watchstream_data');
		}
		
	}
	
	function add_watchstream_comment($owner_id, $comment_id)
	{
		$this->db->set('user_id', $owner_id);
		$this->db->set('entry_id', $comment_id);
		$this->db->set('type_id', 3);
		$this->db->insert('watchstream_data');
	}
	
	function get_watchstream_submission_data($user_id, $limit = 20, $start = 1)
	{
		$sql = 'SELECT * FROM submissions WHERE id IN (SELECT entry_id FROM watchstream_data WHERE type_id=1 AND user_id=' . $user_id . ') LIMIT ' . $limit;
		$query = $this->db->query($sql);
		//$offset = $limit * $start - $limit;
		//$this->db->limit($limit, $offset);
		//$query = $this->db->get('watchstream_data');
		return $query->result_array();
	}
	
	function get_watchstream_journal_data($user_id, $limit = 20, $start = 1)
	{
		$sql = 'SELECT * FROM journal_entries WHERE id IN (SELECT entry_id FROM watchstream_data WHERE type_id=2 AND user_id=' . $user_id . ') LIMIT ' . $limit;
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
}

?>
