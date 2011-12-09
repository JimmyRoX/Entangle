<?php

class User_Model extends CI_Model{
	
	/**
	* Constructor. Clase opera únicamente con MongoDB.
	* Clase simula ser un active record.
	*/
	public function __construct(){
		parent::__construct();
			
		//cargamos conección mongodb
		$this->connection = new Mongo('localhost:27017');
		$this->db = $this->connection->entangle;
		$this->users = $this->db->users;
	}

	// Obtener Usuario.
	function get_User($name){
		$user_document = $this->users->findOne(array("name" => $name));
		return $user_document;
	}
	
	// Agregar Usuario.
	function add_User($user_document){
		$this->users->insert($user_document);
	}
	
	// Obtener todos los Usuarios.
	function get_AllUsers(){
		$user_documents = $this->users->find();
		return $user_documents;
	}
	
	// Actualizar Usuario.
	function update_User($data){
		$this->users->update(array("name" => $data['name']), $data);
	}
	
	// Eliminar Usuario.
	function delete_User(){
		/*$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> users;
		$collection->remove(array("nombre" => $this->uri->segment(3)), array("JustOne" => true));
		*/
	}

}