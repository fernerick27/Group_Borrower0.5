<?php
	class Borrower_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}

		public function log_in($username, $password)
		{
			$this->load->database();
			$password = sha1($password);
			$stmt = "SELECT * FROM `borrower` WHERE email = '{$username}'  AND password = '{$password}'";
			$query = $this->db->query($stmt);
			return $query->result();
		}
	}
?>