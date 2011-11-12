<?php

class Model extends CI_Model
{
	function get_records()
	{
		return $this->models->find();
	}

	function add_record($data)
	{
		$this->models->insert($data);
		return;
	}

	function update_record($data)
	{
		
	}

	function delete_record($data)
	{
	
	}
	
}
