<?php

	class Circle extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
				
			//cargar librería, helper y modelo.
			$this->load->library(array('table', 'form_validation'));
			$this->load->helper('form', 'url');
			$this->load->model('circle_model');
			$this->load->model('user_model');
		}
		
		function index(){
			
			//Reglas de validación
			$this->form_validation->set_rules('name', 'Name', 'callback_circlename_check');
			$this->form_validation->set_rules('adminname', 'Administrator Name', 'callback_username_exists');
			
			if ($this->form_validation->run() == FALSE){
				$this->load->view('circle_create_view');
				return;
			}
			
			self::create();
			
			$this->load->view('circle_create_view_success');
		}
		
		function create(){
			$i = 1;
			$data = array(
				'name' => $this->input->post('name'),
				'adminname' => $this->input->post('adminname'),
				'view' => $i,
				'edit' => $i,
				'invite' => $i,
				'member' => $i
				);
						
			$this->circle_model->add_Circle($data);
		}
		
		function username_exists($string){
			$document = $this->user_model->get_User($string);
			if($document){
				return TRUE;
			}
			$this->form_validation->set_message('username_check', 'This username does not exists.');
			return FALSE;
		}
		
		function circlename_check($string){
				
			if ($string == 'test'){
				$this->form_validation->set_message('circlename_check', 'The %s field can not be the word "test".');
				return FALSE;
			}
				
			$document = $this->circle_model->get_Circle($string);
				
			if($document['name'] == $string){
				$this->form_validation->set_message('circlename_check', 'This circle name is already taken.');
				return FALSE;
			}
			return TRUE;
		}
		
	}
?>