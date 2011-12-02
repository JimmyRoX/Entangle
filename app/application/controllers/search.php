<?php
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->connection = new Mongo();
		$this->db = $this->connection->test;
		
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
		
		$this->instancias = $this->db->instancias;
		$tipo="";
		foreach($contribuciones as $instancia)
		{
			$instance = $this->instancias->findOne(array('_id' => $instancia['instancia']));
			$instancia['instancia']=$instance['nombre'];
			$tipo=$instancia['tipo'];
			array_push($instancias, $instancia);
		}	
		
		
		$this->load->view('search_result', array('instancias'=>$instancias, 'keyword' => $tipo));
	}
	
	function search_home()
	{
		$this->contribs = $this->db->contribs;		
		$cursor=$this->contribs->find(array(), array('tipo' => '1'));
			
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
		$contribuciones=$this->contribs->find(array('metadata.nombre'=> array('$regex' => '.*'.$keyword.'.*', '$options' => 'i'), 'tipo'=> array('$regex' => '.*'.$type.'.*')));
		$instancias=array();
		
		$this->instancias = $this->db->instancias;
		foreach($contribuciones as $instancia)
		{
			$instance = $this->instancias->findOne(array('_id' => $instancia['instancia']));
			$instancia['instancia']=$instance['nombre'];
			array_push($instancias, $instancia);
		}	
		
		
		$this->load->view('search_result', array('instancias'=>$instancias, 'keyword' => $keyword));
	}
	
}

