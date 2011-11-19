<?php

	class Circle extends CI_Controller{
		
		function index(){
			$this->load->helper(array('form', 'url'));
			
			$this->load->library('form_validation');
					
			//Reglas de validación
			$this->form_validation->set_rules('name', 'Name', 'callback_circlename_check');
			$this->form_validation->set_rules('modelname', 'Model Name', 'callback_modelname_check');
			$this->form_validation->set_rules('adminname', 'Administrator Name', 'callback_username_check');
			
			if ($this->form_validation->run() == FALSE){
				$this->load->view('circle_create_view');
			}
			else{
				$this->load->view('circle_create_view_success');
			}
		}
		
		/**
		 * Crear Círculo
		 * Para mapear el círculo en la base de datos.
		 */
		function create(){
			$data = array(
				'name' => $this->input->post('name'),
				'modelname' => $this->input->post('modelname'),
				'adminname' => $this->input->post('adminname')
			);
						
			$this->circle_model->add_Circle($data);
			$this->index();
		}
		
		//Test básico, hay que hacer la query respectiva en Mongo
		function circlename_check($string){
			if ($string == 'test')
			{
				$this->form_validation->set_message('circlename_check', 'The %s field can not be the word "test"');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		
		function username_exists($string)
		{
			$check = $this->user_model->get_User($string);
			if ($check)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('username_exists', 'The specified username %s can not be the circle administrator.');
				return FALSE;
			}
		}
		
		function add_user()
		{
			
		}
	}