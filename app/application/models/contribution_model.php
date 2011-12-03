<?php

class Contribution_Model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
			
		//cargamos conección mongodb
		$this->connection = new Mongo('localhost:27017');
		$this->db = $this->connection->entangle;
		$this->contribs = $this->db->contribs;
	}

	function get_Contribution($id){
		$contrib_id = new MongoId($id);
		$contrib = $this->contribs->findOne(array('_id'=> $contrib_id));
		return $contrib;
	}
	
	function add_Contribution($contrib){
		$this->contribs->insert($contrib);
	}
	
	function list_Contributions(){
		$list_contrib = $this->contribs->find();
		return $list_contrib;
	}
	
	function update_Contribution($data){
		$this->contribs->update(array("name" => $data['name']), $data);
	}
	
	function delete_Contribution($id){
		$this->contribs->remove(array('_id' => new MongoId($id)));
	}

}
