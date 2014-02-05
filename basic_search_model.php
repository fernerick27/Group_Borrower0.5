
<?php
	class Basic_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_search_res($search)
		{
			$this->load->database();
			$stmt = "SELECT * FROM author a, librarymaterial l
					WHERE (a.fname LIKE '{%{$search}%}' OR a.materialid LIKE '%{$search}%'
					OR a.mname LIKE '%{$search}%' OR a.lname LIKE '%{$search}%'
					OR l.materialid LIKE '%{$search}%' OR l.course LIKE '%{$search}%'
					OR l.type LIKE '%{$search}%'  OR l.name LIKE '%{$search}%'
					OR l.year LIKE '%{$search}%')	
					AND a.materialid = l.materialid ORDER BY l.name";
			
			echo $stmt;
			$query = $this->db->query($stmt);
			return $query->result();
		}
	}	
?>