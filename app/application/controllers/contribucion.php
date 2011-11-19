<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contribucion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$m = new Mongo();
		$this->db = $m->entangle;
		$this->instancias = $this->db->instancias;
	}

	public function index()
	{
		$this->show();
	}


	public function add()
	{
		if($this->input->post('add'))
		{
			$instancia_id = new MongoId($this->uri->segment(3));

			$contribucion = $this->input->post();

			$change = array('$push'=>
					array('contribuciones'=> $contribucion
					)
			);
			$instancia = $this->db->instancias->update(
				array('_id' => $instancia_id),
				$change
			);

			$this->instancias->insert($contribucion);
			redirect('add');	
			return;
		}
		$data = array();
		$data['admin'] = array('hugo', 'paco', 'luis');
		$data['title'] = 'Subir Contribución';

		//$modelo_id = new MongoId($this->uri->segment(3));
		//$modelo = $this->db->modelos->findOne(array('_id' => $modelo_id));
		//$data['modelo'] = $modelo;

		$modelos = array();
		foreach($this->db->modelos->find() as $modelo)
		{
			array_push($modelos,array(
				"nombre"=> $modelo['nombre'],
				"id"=> $modelo['_id']
			));
		}
		$data['modelos']=$modelos;

		$this->load->view('add_contribucion.php', $data);
	}

	public function show($modelo_id)
	{
		$contribuciones = $this->instancias->find(array("modelo"=>$modelo_id));

		$list = array();

		foreach($modelos as $m)
		{
			$list[] = array('nombre' => $m['nombre']);
		} 

		$this->load->view('list_contribucion', array('contribucion' => $list));

	}

	public function view($name = null)
	{
		
		if($name) {
			$contribucion = $this->instancias->findOne( array('contrib' => $name));
			if($contribucion)
			{
				$this->load->view('view_contribucion', array('contribucion' => $contribucion));
				return;
			}
		}

		show_404();
	}



	public function delete($name = null)
	{
		if($name)
		{
			$this->modelos->remove(array('nombre' => $name));
		}

		redirect('contribucion/show');
	}





}
