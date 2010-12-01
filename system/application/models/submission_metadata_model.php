<?
//Handle all the medadata manipulation methods for complex metadata types. (keywords, species, orientation)
class Submission_Metadata_model extends Model {

    function Submission_Metadata_model()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	////////////////////
	//Orientation stuff
	////////////////////
	
	function submission_add_orientaions($submission_id, $orientations_array)
	{
		//weird name, but its easier to pass an array of orientations thet repeated calls to a function
		foreach($orientations_array as $orientation_id)
		{
			$this->db->set('orientation_id', $orientation_id);
			$this->db->set('submission_id', $submission_id);
			$this->db->insert('orientation_index');
		}
	}
	
	////////////////////
	//Keyword stuff
	////////////////////
	
	function find_keyword_id($keyword)
	{
		//check to see if a keyword is in the database and adds if not.
		//returns the id of teh keyword reguardless.
		$this->db->select('id');
		$this->db->from('keywords');
		$this->db->where('keyword', $keyword);
		$query = $this->db->get();
		
		if($query->num_rows() == 0) {
			//not in database, so add it and return the id.
			$this->db->set('keyword', $keyword);
			$this->db->insert('keywords');
			
			return $this->db->insert_id();
		}
		else {
			//in database, so return id.
			$row = $query->row_array();
			return $row['id'];
		}
	}
	
	function submission_add_keywords($submission_id, $keyword_array)
	{
		foreach($keyword_array as $keyword)
		{
			$keyword_id = find_keyword_id($keyword);
			$this->db->set('keyword_id', $keyword_id);
			$this->db->set('submission_id', $submission_id);
			$this->db->insert('keywords_index');
		}
	}

	function get_keywords_by_submission_id($submission_id)
	{
		$results = array();
		//SubSelects are the shit!!!
		$sql = "SELECT keyword FROM keywords WHERE id IN (SELECT keyword_id FROM keywords_index WHERE submission_id=$submission_id)";
		$query = $this->db->query($sql);
		foreach($query->result_array() as $row)
		{
			array_push($results, $row['keyword']);
		}
		
		return $results;
	}
}

?>
