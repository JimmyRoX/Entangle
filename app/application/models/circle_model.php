<?php

class Circle_Model extends CI_Model{

	/**
	 * Constructor. Clase opera únicamente con MongoDB.
	 * Simula ser un active record.
	 */
	public function __construct(){
		parent::__construct();
			
		//cargamos conección mongodb
		$this->connection = new Mongo('localhost:27017');
		$this->db = $this->connection->entangle;
		$this->circles = $this->db->circles;
	}
	
	// Obtener Círculo.
	function get_Circle($name){
		$circle_document = $this->circles->findOne(array("name" => $name));
		return $circle_document;
	}

	// Agregar Círculo.
	function add_Circle($circle_document){
		$this->circles->insert($circle_document);
	}
	
	// Obtener todos los Círculos.
	function get_AllCircles(){
		$circle_documents = $this->circles->find();
		return $circle_documents;
	}
	
	// Actualizar Círculo.
	function update_Circle($data){
		$this->circles->update(array("name" => $data['name']), $data);
	}

	// Eliminar Círculo (p).
	function delete_Circle(){
	}

}