<?php
class instancia extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->connection = new Mongo();
		$this->db = $this->connection->test;
		
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
		
		$data["usuarios"]=$users_names;
		$data["modelos"]=$models_name;

		$this->load->view('add_instancia.php', $data);
	}
	
	function add_instancia()
	{
		$data=$this->input->post();
		
		$this->instancias = $this->db->instancias;
		
		$instance["nombre"]=$data["nombre"];
		$instance["modelo"]=$data["modelo"];
		//$instance["admins"]=$data["admins"];
		//$result=$this->models->find(array('contrib.nombre'=> array('$regex' => '.*clase.*')));
		
		$this->instancias->insert($instance);
		//$data = array('nombre' => $result['nombre']);
		$result["result"]=true;
		$result["nombre"]=$instance["nombre"];
		//$data["usuarios"]=$users_names;
		//$this->load->view('search_result', $data);
		$this->load->view('result_add_instancia.php', $result);
	}
	
}
