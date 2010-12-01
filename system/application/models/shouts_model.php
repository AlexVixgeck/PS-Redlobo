<?

class Shouts_model extends Model {

    function Shouts_model()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function get_news($entries, $offset=NULL)
    {
		$this->db->select('news.id, news.user_id, news.title, news.content, news.avatar_id, news.post_date, users.username');
		$this->db->from('news');
		$this->db->join('users', 'news.user_id = users.id');
		$this->db->order_by('id', 'desc');

		if($offset) {
			$this->db->limit($entries, $offset);
		}
		else {
            $this->db->limit($entries);
		}

		$query = $this->db->get();
        return $query->result_array();
    }
	
	function get_regular_shouts($user_id, $limit = 20)
	{
		$this->db->where('for_user_id', $user_id);
		$this->db->where('private', 0);
		$this->db->order_by('timestamp', 'desc');
		$this->db->limit($limit);
		$this->db->from('shouts');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_all_shouts($user_id, $limit = 20)
	{
		$this->db->where('for_user_id', $user_id);
		$this->db->order_by('timestamp', 'desc');
		$this->db->limit($limit);
		$this->db->from('shouts');
		$query = $this->db->get();
		
		return $query->result_array();
	}

    function add_shout($for_user_id, $from_user_id, $message, $private = 0)
	{
		$this->db->set('for_user_id', $for_user_id);
		$this->db->set('from_user_id', $from_user_id);
		$this->db->set('timestamp', time());
		$this->db->set('message', $message);
		$this->db->set('private', $private);
		$this->db->set('deleted', 0);
		$this->db->insert('shouts');
		
	}
}

?>
