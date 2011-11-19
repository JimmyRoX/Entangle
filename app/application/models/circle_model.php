<?php

class Circle_Model extends CI_Model{

	function get_Circle(){
		/*$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> circle;
		$query = array("nombre" => $name);
		return $collection->findOne($query);*/
	}

	function add_Circle($data){
		/*
		$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> circle;
		$collection->insert($data);
		*/
	}

	function update_Circle($data){
		/*$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> circle;
		$collection->update(array("nombre" => $data['name']), $data);
		*/
	}

	//Por el momento no habrá Delete
	function delete_Circle(){
		/*$m = new Mongo();
		 $db = $m -> entangle;
		$collection = $db -> users;
		$collection->remove(array("nombre" => $this->uri->segment(3)), array("JustOne" => true));
		*/
	}

}