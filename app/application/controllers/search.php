<?php
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->connection = new Mongo();
		$this->db = $this->connection->entangle;
		
	}

	
	function index()
	{
		$this->search_home();
	}
	
	function ref_search()
	{
		$data=$this->input->get('id');		
		$this->contribs = $this->db->contribs;
		
		//$contribuciones=$this->contribs->find();
		$contribuciones=$this->contribs->find(array('_id'=> new MongoId($data)));		
		$instancias=array();
		
		$this->instancias = $this->db->submodels;
		$tipo="";
		foreach($contribuciones as $instancia)
		{
			$instance = $this->instancias->findOne(array('_id' => $instancia['submodel']));
			$instancia['submodel']=$instance['nombre'];
			$tipo=$instancia['tipoContrib'];
			array_push($instancias, $instancia);
		}	
		
		
		$this->load->view('search_result', array('submodelos'=>$instancias, 'keyword' => $tipo));
	}
	
	function get_file()
	{
		$data=$this->input->get('id');		
		$this->fs = $this->db->fs;
		
		//$contribuciones=$this->contribs->find();
		$contribuciones=$this->contribs->find(array('_id'=> new MongoId($data)));		
		$instancias=array();
		
		$this->instancias = $this->db->submodels;
		$tipo="";
		foreach($contribuciones as $instancia)
		{
			$instance = $this->instancias->findOne(array('_id' => $instancia['submodel']));
			$instancia['submodel']=$instance['nombre'];
			$tipo=$instancia['tipoContrib'];
			array_push($instancias, $instancia);
		}	
		
		
		$this->load->view('search_result', array('submodelos'=>$instancias, 'keyword' => $tipo));
	}
	
	function search_home()
	{
		$this->contribs = $this->db->contribs;		
		
		$cursor=$this->db->command(array('distinct' => 'contribs', 'key' => 'tipoContrib'));			
		$data['tipos'] = $cursor;
		
		$this->load->view('search_home', $data);
	}
	
	function search_result()
	{
		$data=$this->input->post();
		$keyword=$data['contribucion'];
		$type=$data['tipo'];
		$this->contribs = $this->db->contribs;
		
		//$contribuciones=$this->contribs->find();
		$contribuciones=$this->contribs->find(array('metadata.nombre'=> array('$regex' => '.*'.$keyword.'.*', '$options' => 'i'), 'tipoContrib'=> array('$regex' => '.*'.$type.'.*')));	
		$instancias=array();
		
		$this->submodels = $this->db->submodels;
		foreach($contribuciones as $instancia)
		{
			$instance = $this->submodels->findOne(array('_id' => $instancia['submodel']));
			$instancia['submodel']=$instance['nombre'];
			array_push($instancias, $instancia);
		}	
		
		
		$this->load->view('search_result', array('submodelos'=>$instancias, 'keyword' => $keyword));
	}
	
}

