<?php

	class User extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			
			//cargar librería, helper y modelo.
			$this->load->library(array('table','form_validation'));
			$this->load->helper('form', 'url');
			//$this->load->model('user_model','',TRUE);
		}
		
		function index(){
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			//reglas de validación.
			$this->form_validation->set_rules('name', 'Name', 'callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirm', 'Confirm', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('user_create_view');
			}
			else
			{
				$this->load->view('user_create_view_success');
			}
			//$this->load->view('user_create_view');
		}
		
		//Creamos usuarios: C
		function create(){
			$document = array(
				'name' => $this->input->post('name'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email')
			);		
			$this->user_model->add_User($document);
			$this->index();
		}
		
		//Listamos usuarios: R
		/*function view(){
			$user_documents = $this->user_model->get_AllUsers();
			$data = array('user_documents' => array());
			
			while($user_documents->hasNext()){
				$user_document = $user_documents->getNext();
				$data['documents'][] = array(
										'name' => $user_document['name'];
										'email' => $user_document['email'];
										);
			}
			$this->load->view('user_view', $data);
		}*/
		
		//Test básico, hay que hacer la query respectiva en Mongo
		function username_check($string){
			if ($string == 'test'){
				$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		
		function update(){
			
		}
		
		//Borrar usuarios: D
		function delete(){
			
		}
			
	}
?>