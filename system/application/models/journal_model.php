<?

class Journal_model extends Model {

    function Journal_model()
    {
        // Call the Model constructor
        parent::Model();
    }

	//Insert a new journal entry. Content is already BBEncoded.
	function insert_journal_entry($user_id, $title, $content)
	{
		$datetime = date("Y-m-d H:i:s");
		$data = array('user_id' => $user_id, 'time' => $datetime, 'title' => $title, 'content' => $content);
		$this->db->insert('journal_entries', $data);
	}

	function get_journal_entry($entry_id)
	{
		$this->db->where('id', $entry_id);
		$query = $this->db->get('journal_entries');
		return $query->row_array();
	}

	function get_latest_journal_entries($user_id, $number)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('journal_entries', $number);
		return $query->result_array();
	}

	function get_journal_entries($user_id, $entries, $offset=NULL)
	{
		$this->db->from('journal_entries');
		$this->db->where('user_id', $user_id);

		if($offset) {
			$this->db->limit($entries, $offset);
		}
		else {
			$this->db->limit($entries);
		}

        $query = $this->db->get();
        return $query->result_array();
	}
    
	/*
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
	}
	*/
}

?>
