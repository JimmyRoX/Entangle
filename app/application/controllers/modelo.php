<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$m = new Mongo();
		$this->db = $m->entangle;
		$this->modelos = $this->db->models;
		$this->grid = $this->db->getGridFS();
	}

	public function index()
	{
		$this->show();
	}

	public function add()
	{
		if($this->input->post('add'))
		{
			$data = $this->input->post();

			$modelo = array();
			$modelo['nombre'] = $data['nombre'];
			$modelo['admin'] = $data['admin'];
			
			$modelo['contrib'] = array();


			foreach($data['contrib'] as $contrib)
			{
				$c = array();
				$c['nombre'] = $contrib['nombre'];
				//$c['template']= $contrib['template'];

				$c['metadata'] = $contrib['metadata'];
				$c['ref'] = $contrib['ref'];

				$modelo['contrib'][] = $c;
			}

			$this->modelos->insert($modelo);
			redirect('modelo');	
			return;
		}

		$data = array();
		$data['admin'] = $this->db->circles->find();
		$data['title'] = 'Crear modelo';

		$this->load->view('add_modelo.php', $data);
	}

	public function show()
	{
		$modelos = $this->modelos->find();

		$list = array();

		foreach($modelos as $m)
		{
			$list[] = array('nombre' => $m['nombre']);
		} 

		$this->load->view('list_modelo', array('modelo' => $list));

	}

	public function view($name = null)
	{
		if($name) {
			$modelo = $this->modelos->findOne( array('nombre' => $name));
			
			$data['modelo'] = $modelo;



			foreach($modelo['tipoContrib'] as $contrib)
			{
				$contrib['widget_browsing'] = $this->grid->findOne($contrib['widget_browsing']);
				$contrib['widget_display'] = $this->grid->findOne($contrib['widget_display']);
			}

			if($modelo)
			{

				$this->load->view('view_modelo', $data);
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

		redirect('modelo/show');
	}

	public function contribucion_json()
	{
		$modelo_id = new MongoId($this->input->get('modelo_id'));
		$contrib_nombre = $this->input->get('contrib_nombre');
		if($modelo_id && $contrib_nombre) {
			$modelo = $this->modelos->findOne(array('_id' => $modelo_id));

			foreach($modelo['contrib'] as $contrib)
			{
				
				if($contrib['nombre'] == $contrib_nombre)
					echo json_encode($contrib);
			}
		}
	}

	public function contribuciones_json()
	{
		$modelo_id = new MongoId($this->input->get('modelo_id'));
		if($modelo_id) {
			$modelo = $this->modelos->findOne(array('_id' => $modelo_id));
	
			$contribs = array();

			foreach($modelo['contrib'] as $contrib)
			{
				
				array_push($contribs,$contrib['nombre']);
					
			}
			echo json_encode($contribs);
		}
	}


}
