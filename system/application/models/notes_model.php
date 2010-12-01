<?

class Notes_model extends Model {

    function Notes_model()
    {
        // Call the Model constructor
        parent::Model();
    }

	//Insert a new mail entry. Content is already BBEncoded.
	function insert_mail($to_user_id, $from_user_id, $title, $content, $original_mail_id=NULL)
	{
		$datetime = time();
		$data = array('to_user_id' => $to_user_id, 'original_mail_id' => $original_mail_id, 'read' => 0, 'from_user_id' => $from_user_id, 'time' => $datetime, 'title' => $title, 'content' => $content, 'deleted' => 0);
		$this->db->insert('notes', $data);
	}

	function get_mail_entry($mail_id)
	{
		$this->db->where('id', $mail_id);
		$query = $this->db->get('mail');
		return $query->row_array();
	}
	
	function get_note($note_id)
	{
		$this->db->where('id', $note_id);
		$query = $this->db->get('notes');
		return $query->row_array();
	}

	function get_mail_entries($user_id, $entries, $offset=NULL)
	{
		$this->db->select('notes.id, notes.read, notes.time, notes.title, notes.content, users.username');
		$this->db->from('notes');
		$this->db->join('users', 'notes.from_user_id = users.id');
		$this->db->where('to_user_id', $user_id);
		$this->db->order_by('time', 'desc');

		if($offset) {
			$this->db->limit($entries, $offset);
		}
		else {
			$this->db->limit($entries);
		}

        $query = $this->db->get();
        return $query->result_array();
	}
	
	function get_sent_entries($user_id, $entries, $offset=NULL)
	{
		$this->db->select('notes.id, notes.read, notes.time, notes.title, notes.content, users.username');
		$this->db->from('notes');
		$this->db->join('users', 'notes.from_user_id = users.id');
		$this->db->where('from_user_id', $user_id);
		$this->db->order_by('time', 'desc');

		if($offset) {
			$this->db->limit($entries, $offset);
		}
		else {
			$this->db->limit($entries);
		}

        $query = $this->db->get();
        return $query->result_array();
	}
    
    function touch_read($mail_id)
    {
		$data = array('read' => 1);
        $this->db->where('id', $mail_id);
        $this->db->update('notes', $data);
    }

	function get_notes_count($user_id)
	{
		$this->db->where('to_user_id', $user_id);
        $query = $this->db->get('notes');
        return $query->num_rows();
	}
	
	function get_sent_notes_count($user_id)
	{
		$this->db->where('from_user_id', $user_id);
		$query = $this->db->get('notes');
		return $query->num_rows();
	}
	
	function get_new_notes_count($user_id)
	{
		$this->db->where('to_user_id', $user_id);
		$this->db->where('read', 0);
        $query = $this->db->get('notes');
        return $query->num_rows();
	}
}

?>
