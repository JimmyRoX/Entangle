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
		while($this->input->post("c$i._name"))
		{
			$contribution = array('name'=>$this->input->post("c$i._name"));
			$metadata = array();

			$j = 0;
			while($this->input->post("c$i._meta$j._name"))
			{
				$metadata[$this->input->post("c$i._meta$j._name")] = $this->input->post("c$i._meta$j._value");
				$j++;
			}
			$contribution['metadata'] = $metadata;
			
			array_push($contributions, $contribution);
			

			$referencias = array();
			$k = 0;
			while($this->input->post("c$i._ref$k._name"))
			{
				$referencias[$this->input->post("c$i._meta$k._name")] = $this->input->post("c$i._meta$k._value");
				$k++;
			}

			$i++;
			

		}
		
		$data = array(
			'name' => $this->input->post('name'),
			'contributions' => $contributions
			
			
			
		);
		//$this->model_model->add($data);
		$this->models->insert($data);
	}
}





/* End of file model.php */
/* Location: ./application/controllers/model.php */
