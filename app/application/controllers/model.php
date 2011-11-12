<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Controller {
	
	public function __constructor()
	{
		parent::__contructor();
		
		$this->load->helper('url');

		// Connect to Mongo
		$this->connection = new Mongo();

		// Select a database
		$this->db = $this->connection->admin;

		// Select a collection
		$this->models = $this->db->models;
	}

	public function index()
	{
		$this->load->view('create_model_view');
	}

	public function add()
	{
		
		$contributions = array();

		$i = 0;
		$j = 0;
		while($this->input->post("c$i._name"))
		{
			$contribution = array('name'=>$this->input->post("c$i._name"));
			$metadata = array();
			while($this->input->post("c$i._meta$j._name"))
			{
				$metadata[$this->input->post("c$i._meta$j._name")] = $this->input->post("c$i._meta$j._value");
				$j++;
			}
			$contribution['metadata'] = $metadata;
			$j = 0;
			array_push($contributions, $contribution);
		}
		
		$data = array(
			'name' => $this->input->post('name'),
			'contributions' => $contributions
			
			
			
		);
		$this->model_model->add($data);
	}
}





/* End of file model.php */
/* Location: ./application/controllers/model.php */
