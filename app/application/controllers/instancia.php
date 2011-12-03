<?php
class instancia extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->connection = new Mongo();
		$this->db = $this->connection->entangle;
		
	}

	
	function index()
	{				
		$this->home_add_instancia();
	}
	
	function home_add_instancia()
	{
		$this->usuarios = $this->db->usuarios;		
		$users=$this->usuarios->find();
		$users_name = null;
		foreach($users as $user)
		{
			$users_names[$user["nombre"]]=$user["_id"];
		}		
		
		$this->modelos = $this->db->modelos;		
		$models=$this->modelos->find();
		$models_name = null;
		foreach($models as $model)
		{
			$models_name[$model["nombre"]]=$model["_id"];
		}			
		
		$this->circulos = $this->db->circulos;		
		$circles=$this->circulos->find();
		$circles_name = null;
		foreach($circles as $circle)
		{
			$circles_name[$circle["nombre"]]=$circle["_id"];
		}	
		
		$data["usuarios"]=$users_names;
		$data["modelos"]=$models_name;
		$data["circulos"]=$circles_name;
		

		$this->load->view('add_instancia.php', $data);
	}
	
	function add_instancia()
	{
		$data=$this->input->post();
		
		$this->instancias = $this->db->instancias;
		
		$instance["nombre"]=$data["nombre"];
		$instance["modelo"]=$data["modelo"];
		$instance["circulo"]=$data["circulo"];
				
		if($this->instancias->insert($instance))
			$result["result"]=true;
		else
			$result["result"]=false;
		
		$result["nombre"]=$instance["nombre"];
		
		$this->load->view('result_add_instancia.php', $result);
	}
	
}
