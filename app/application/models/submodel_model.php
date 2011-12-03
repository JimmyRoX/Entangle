<?php

class Submodel_Model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
			
		//cargamos conección mongodb
		$this->connection = new Mongo('localhost:27017');
		$this->db = $this->connection->entangle;
		$this->submodels = $this->db->submodels;
	}

	function get_Submodel($id){
		$submodel_id = new MongoId($id);
		$submodel = $this->submodels->findOne(array('_id'=> $submodel_id));
		return $submodel;
	}
	
	function add_Submodel($submodel){
		$this->submodels->insert($submodel);
	}
	
	function list_Submodel(){
		$list_submodel = $this->submodels->find();
		return $list_submodel;
	}
	
	function update_Submodel($data){
		$this->submodels->update(array("name" => $data['name']), $data);
	}
	
	function delete_Submodel(){
	}

}
