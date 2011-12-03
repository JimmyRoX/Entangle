<?php
class submodelo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->connection = new Mongo();
		$this->db = $this->connection->entangle;
		
	}

	
	function index()
	{				
		$this->home_add_submodelo();
	}
	
	function home_add_submodelo()
	{
		$this->users = $this->db->users;		
		$users=$this->users->find();
		$users_name = null;
		foreach($users as $user)
		{
			$users_names[$user["name"]]=$user["_id"];
		}		
		
		$this->models = $this->db->models;		
		$models=$this->models->find();
		$models_name = null;
		foreach($models as $model)
		{
			$models_name[$model["nombre"]]=$model["_id"];
		}			
		
		$this->circles = $this->db->circles;		
		$circles=$this->circles->find();
		$circles_name = null;
		foreach($circles as $circle)
		{
			$circles_name[$circle["name"]]=$circle["_id"];
		}	
		
		//$data["usuarios"]=$users_names;
		$data["modelos"]=$models_name;
		$data["circulos"]=$circles_name;
		

		$this->load->view('add_submodelo', $data);
	}
	
	function add_submodelo()
	{
		$data=$this->input->post();
		
		$this->submodels = $this->db->submodels;
		
		$instance["nombre"]=$data["nombre"];
		$instance["modelo"]=$data["modelo"];		
		$instance["titulo"]=$data["titulo"];
		
		$circles=$data["circulo"];
		$circulos_array=array();
		
		$this->circles = $this->db->circles;
		foreach(array_keys($circles) as $circles_keys)
		{	
			$circle_query=$this->circles->findOne(array('_id' => new MongoId($circles[$circles_keys])));					
			array_push($circulos_array, array($circle_query['name']=>$circles[$circles_keys]));			
		}		
		$instance["circulo"]=$circulos_array;
								
		if($this->submodels->insert($instance))
			$result["result"]=true;
		else
			$result["result"]=false;
		
		$result["nombre"]=$instance["nombre"];
		
		$this->load->view('result_add_submodelo', $result);
	}
	
}
