<?php

class User_Model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
			
		//cargamos conección mongodb
		$this->connection = new Mongo('localhost:27017');
		$this->db = $this->connection->entangle;
		$this->users = $this->db->users;
	}

	function get_User($name){
		$user_document = $this->users->findOne(array('nombre' => $name));
		return $user_document;
	}
	
	function add_User($user_document){
		$this->users->insert($user_document);
	}
	
	function get_AllUsers(){
		$user_documents = $this->users->find();
		return $user_documents;
	}
	
	function update_User($data){
		$this->users->update(array("nombre" => $data['name']), $data);
	}
	
	//Por el momento no habrá Delete
	function delete_User(){
		/*$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> users;
		$collection->remove(array("nombre" => $this->uri->segment(3)), array("JustOne" => true));
		*/
	}

}