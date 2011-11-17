<?php

//conneccion a la db

class User_model extends CI_Model{

	function get_User()
	{
		$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> users;
		$query = array("nombre" => $name);
		return $collection->findOne($query);
	}
	
	function add_User($data)
	{
		$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> users;
		$collection->insert($data);
	}
	
	function update_User($data)
	{
		$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> users;
		$collection->update(array("nombre" => $data['name']), $data);
	}
	
	function delete_User()
	{
		$m = new Mongo();
		$db = $m -> entangle;
		$collection = $db -> users;
		$collection->remove(array("nombre" => $this->uri->segment(3)), array("JustOne" => true));
	}

}