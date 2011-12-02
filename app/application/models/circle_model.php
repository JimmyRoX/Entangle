<?php

class Circle_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
			
		//cargamos conección mongodb
		$this->connection = new Mongo('localhost:27017');
		$this->db = $this->connection->entangle;
		$this->circles = $this->db->circles;
	}
	
	function get_Circle($name){
		$circle_document = $this->circles->findOne(array("name" => $name));
		return $circle_document;
	}

	function add_Circle($circle_document){
		$this->circles->insert($circle_document);
	}
	
	function get_AllCircles(){
		$circle_documents = $this->circles->find();
		return $circle_documents;
	}
	
	function update_Circle($data){
		$this->circles->update(array("name" => $data['name']), $data);
	}

	//Por el momento no habrá Delete
	function delete_Circle(){
	}

}