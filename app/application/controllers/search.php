<?php
class Search extends CI_Controller
{
	public function __constructor()
	{
		parent::__contructor();
		$this->connection = new Mongo();
		$this->db = $this->connection->admin;
		$this->instances = $this->db->instances;
	}

	
	function index()
	{
		$this->load->view('search_home');

	}
	
	function search_result()
	{
		$data=$this->input->post();
		
		//Obtenemos un cursor para obtener documentos de las instancias existentes, donde la contribucion
		//se llame como se indica
		$result=$this->instances->find(array('Contribucion'=>array('Nombre'=>data['contribucion'])));
		
		$this->load->view('search_result', $result);
	}
	
}

