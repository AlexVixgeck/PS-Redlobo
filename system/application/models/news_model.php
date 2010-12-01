<?

class News_model extends Model {

    function News_model()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function get_news($entries, $offset=NULL)
    {
		$this->db->select('news.id, news.user_id, news.title, news.content, news.timestamp, users.username');
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
}

?>
