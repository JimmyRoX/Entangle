<?php

	class Circle extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
				
			//cargar librería, helper y modelo.
			$this->load->library(array('table', 'form_validation'));
			$this->load->helper('form', 'url');
			$this->load->model(array('circle_model', 'user_model'));
		}
		
		function index(){
			self::create();
		}
		
		/**
		 * Metodo que crea un círculo. Validación y redirección según el caso.
		 */
		function create(){
			//Reglas de validacion
			$this->form_validation->set_rules('circle_name', 'Name', 'callback_circlename_check');
			
			if ($this->form_validation->run() == FALSE){
				$this->load->view('circle_create_view');
				return;
			}
			self::createDocument();
			
			$this->load->view('circle_create_view_success');
		}
		
		/**
		 * Crea el documento asociado para guardar el Circulo.
		 */
		function createDocument(){
			$document = array(
				'name' => $this->input->post('circle_name'),
			//permisos por defecto
				'view' => 1,
				'edit' => 1,
				'invite' => 1,
				'member' => 1
				);		
			$this->circle_model->add_Circle($document);
		}
		
		/**
		 * Chequeo del nombre de usuario (No se usa en este controlador).
		 * @param  $string : nombre de usuario.
		 * @return boolean : TRUE si existe, FALSE en caso contrario.
		 */
		function username_exists($string){
			$document = $this->user_model->get_User($string);
			if($document){
				return TRUE;
			}
			$this->form_validation->set_message('username_check', 'This username does not exists.');
			return FALSE;
		}
		
		/**
		 * Chequeo del nombre del circulo si ya existe o no.
		 * @param  $string : nombre que se quiere verificar.
		 * @return boolean : FALSE ya existe, TRUE si no existe.
		 */
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
		
		/**
		 * Actualizar un usuario (no se usa aún).
		 */
		function update(){
			$this->form_validation->set_rules('circle_name', 'Name', 'callback_circlename_check');	
			
			if ($this->form_validation->run() == FALSE){
				$this->load->view('circle_create_view');
				return;
			}
			self::editDocument();
			$this->load->view('circle_create_view');
		}
		
		function editDocument(){
			$document = array(
							'name' => $this->input->post('circle_name'),
			//permisos por defecto
							'view' => 1,
							'edit' => 1,
							'invite' => 1,
							'member' => 1
			);
			$this->circle_model->update_Circle($document);
		}
		
	}