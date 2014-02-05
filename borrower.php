<?php 

/*
*	Filename: borrower.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrower extends CI_Controller {

	public function index(){
		$this->load->library("session");
		$data['header'] = 'Welcome Guest';

			if($this->session->userdata('fname'))
			{
				$data['header'] = "Hello ,{$this->session->userdata('fname')}";
				$this->load->view('user/header',$data);
				$this->load->view('user/logout');
				$this->load->view('user/search');
				$this->load->view('user/footer');
			}

			else
			{
				$this->load->view('user/header',$data);
				$this->load->view('user/login');
				$this->load->view('user/search');
				$this->load->view('user/footer');
				//$this->load->view('user/advance');
			}
	}

	public function login()
	{
				$this->load->library("session");
				$this->load->helper('url');

				$username = $this->input->post('username');
				$password =  $this->input->post('password');
				$this->load->model('user/borrower_model');
				$borrower_info = $this->borrower_model->log_in($username, $password);


				if($borrower_info)
				{
				$data['header'] = "Hello, {$borrower_info[0]->fname} ";
				$this->session->set_userdata('fname',$borrower_info[0]->fname);
				redirect('/borrower');
				}

				else
				{
					redirect('/borrower');
				}

	}

	public function logout()
	{
		$this->load->library("session");
		$this->session->sess_destroy();
		$this->load->helper('url');

		$data['header'] = 'Welcome Guest';
		redirect('/borrower');
		
	}

	public function search()
	{
		$search =  $this->input->post('searchbox');
		$this->load->model('user/basic_search_model');

		$result_info = $this->basic_search_model->get_search_res($search);
		var_dump($result_info);
	}

	public function advance_search()
	{
		
		$this->load->view('user/advance');
		//$this->load->model('user/advance_search_model');
		
		/*if($this->input->post('advance_search')){
			$search =  $this->input->post('advance_searchbox');
			$search_option = $this->input->post('option[]'); //array yung options
			$type = $this->input->post('type');
			
			$result_info = $this->advance_search_model->get_adv_search($search,$search_option,$type);
			var_dump($result_info);
		}*/
	}
	
	public function do_advance_search(){
		$search =  $this->input->post('advance_searchbox');
		
		$search_option = $this->input->post('option'); //array yung options
		$type = $this->input->post('type');
		
		$this->load->model('user/advance_search_model');
		$result_info = $this->advance_search_model->get_adv_search($search,$search_option,$type);
		var_dump($result_info);
	
	
	}
}