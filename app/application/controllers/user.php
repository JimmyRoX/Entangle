<?php

	class User extends CI_Controller{
		
		function index(){
			$this->load->view('user_create_view');
		}
		
		function create(){
			$data = array(
				'name' => $this->input->post('name'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email')
			);
			
			$this->user_model->add_User($data);
			$this->index();
		}
			
	}