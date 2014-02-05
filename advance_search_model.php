<?php
	class Advance_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_adv_search($search,$search_option,$type)
		{
			
			$this->load->database();
			$this->load->library("session");
			
			$conditions = array();
			$SO = $this->session->userdata('search_option');
			if(!empty($search_option)){
				foreach($search_option as $option) {
					
					//get the queries
					if($option=='author'){ //check if author is checked
						$conditions[] = "a.fname LIKE '%{$search}%' OR a.mname LIKE '%{$search}%' OR a.lname LIKE '%{$search}%'";
					}

					else if($option=='title'){ //check if title is checked
						$conditions[] = "l.name LIKE '%{$search}%'";
					}

					else if($option=='course'){ //check if course is checked
						$conditions[] = "l.course LIKE '%{$search}%'";
					}

					else if($option=='year'){ //check if year is checked
						$conditions[] = "l.year LIKE '%{$search}'";
					}
				}

				//query for type
				$lib_mat_type = "";
				if(!empty($type)) $lib_mat_type = "AND l.type LIKE '%{$type}%'";


				//final sql query
					/*$stmt = "SELECT * FROM author a, librarymaterial l WHERE
							.implode(' AND ', {$conditions}).'AND a.materialid = l.materialid
							ORDER BY l.name'";
					*/
					
					$stmt = "SELECT * FROM author a, librarymaterial l WHERE "
										. "(" . implode(' OR ', $conditions) .")". "{$lib_mat_type} AND a.materialid = l.materialid
										ORDER BY l.name";
				
				echo $stmt;
				$query = $this->db->query($stmt);
				return $query->result();	
			}else{
				//pag walang pinili sa checkboxes = general search
				
				$this->load->model('user/basic_search_model');
				$this->basic_search_model->get_search_res($search);
			}			
		}
	}	
?>