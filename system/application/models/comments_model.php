<?

class Comments_model extends Model {

    function Comments_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function add_comment($submission_id, $submission_type, $author_id, $title, $comment, $private, $parent_id, $level)
	{
		$this->db->set('submission_id', $submission_id);
		$this->db->set('submission_type', $submission_type);
		$this->db->set('author_id', $author_id);
		$this->db->set('title', $title);
		$this->db->set('comment', $comment);
		$this->db->set('deleted', 0);
		$this->db->set('private', $private);
		$this->db->set('timestamp', time());
		$this->db->set('parent_id', $parent_id);
		$this->db->set('level', $level);
		
		$this->db->insert('comments');
		
		return $this->db->insert_id();
	}
	
	function get_level($comment_id)
	{
		$this->db->where('id', $comment_id);
		$query = $this->db->get('comments');
		$query = $query->row_array();
		return $query['level'];
	}
	
	function get_comment($comment_id)
	{
		$this->db->where('id', $comment_id);
		$query = $this->db->get('comments');
		$query = $query->row_array();
		return $query;
	}
	
	function get_submission_comments($submission_id)
	{
		$this->db->order_by('timestamp', 'desc');
		$query = $this->db->get_where('comments', array('submission_id'=>$submission_id, 'submission_type'=>1, 'parent_id'=>0, 'private'=>0, 'deleted'=>0,));
		return $query->result_array();
	}
	
	function get_submission_comment_children($submission_id, $parent_id)
	{
		$query = $this->db->get_where('comments', array('submission_id'=>$submission_id, 'parent_id'=>$parent_id));
		return $query->result_array();
	}
	
	function get_author_id($comment_id)
	{
		$query = $this->db->get_where('comments', array('id'=>$comment_id));
		$query = $query->row_array();
		return $query['author_id'];
	}
}

?>
