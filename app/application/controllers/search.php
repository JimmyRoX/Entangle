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
		
		
		$cursor=$this->db->command(array('distinct' => 'contribs', 'key' => 'tipoContrib'));			
				
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
		
		
		$this->load->view('search_result', array('contribuciones'=>$instancias, 'keyword' => $tipo, 'tipos' => $cursor));
	}
	
	function get_file()
	{
		$id=$this->input->get('id');				
			
		$grid = $this->db->getGridFS();
		$file = $grid->get(new MongoId($id));
			
		/*
		$this->load->helper('download');
		$data = $file->getBytes();
		$name = $file->getFilename();
		force_download($name, $data);
		*/
		
		$this->load->view('get_file', array('id'=>$id, 'file'=>$file));
		
		
	}
	
	function search_home()
	{
		$this->contribs = $this->db->contribs;		
		
		$cursor=$this->db->command(array('distinct' => 'contribs', 'key' => 'tipoContrib'));			
		$data['tipos'] = $cursor;
				
		//$this->load->view('search_home', array('tipos' => $cursor));
		$this->load->view('home', array('tipos' => $cursor));
	}
	
	function search_result()
	{
		$data=$this->input->post();
		$keyword=$data['contribucion'];
		$type=$data['tipo'];
		$this->contribs = $this->db->contribs;
		
		
		$cursor=$this->db->command(array('distinct' => 'contribs', 'key' => 'tipoContrib'));			
				
		//Se obtiene lista de ids de acl del usuario logueado
		$acl_session = $this->session->userdata('acl'); 
		$acl_ids = array(); 
		if($acl_session!=null)
		foreach ($acl_session as $item)
		{
			foreach ($item as $acl)
			$acl_ids[]=$acl;			
		}
				
		//Se filtran los circulos con permiso de vision
		$acl_view = array();
		$this->circles = $this->db->circles;
		foreach ($acl_ids as $acl)
		{
			$circle = $this->circles->findOne(array('_id' => new MongoId($acl)));
			if ($circle['view']==1)
				$acl_view[]=$acl;
		}
		
		//$contribuciones=$this->contribs->find();
		$contribuciones=$this->contribs->find(array('metadata.nombre'=> array('$regex' => '.*'.$keyword.'.*', '$options' => 'i'), 'tipoContrib'=> array('$regex' => '.*'.$type.'.*')));	
		$instancias=array();
		
		$this->submodels = $this->db->submodels;
		foreach($contribuciones as $instancia)
		{
			$instance = $this->submodels->findOne(array('_id' => $instancia['submodel']));
			
			$circles_submodel = $instance['circle'];
			
			//Se añade la contribucion, solo si alguno de los circulos asociados a su submodelo
			//pertenecen a la lista de circulos con visible=1 que tiene asociada el usuario
			$salir=false;
			foreach($circles_submodel as $circle_submodel)
			{
				foreach($circle_submodel as $circle_item)
				{
					if (in_array($circle_item , $acl_view))
					{
						$instancia['submodel']=$instance['nombre'];
						$instancias[]=$instancia;
						//$instancia['circles']=$circles_submodel;
						$salir=true;
						break;
					}
				}
				if($salir)
					break;				
			}			
		}	
		
		
		$this->load->view('search_result', array('contribuciones'=>$instancias, 'keyword' => $keyword, 'tipos' => $cursor));
	}
	
}

