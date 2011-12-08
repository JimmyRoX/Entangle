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

			echo '<pre>';

			$modelo = array();
			$modelo['nombre'] = $data['nombre'];

			$modelo['circle'] = array_map(function($id) { return new MongoId($id); }, $data['circle']);
									
			$modelo['tipoContrib'] = array();

			foreach($data['contrib'] as $key => $contrib)
			{
				$c = array();
				$c['nombre'] = $contrib['nombre'];
				$c['content'] = $contrib['content'];

				if(isset($contrib['metadata']))
				{
					$c['metadata'] = $contrib['metadata'];
				}
				else
				{
					$c['metadata'] = array();
				}

				if(isset($contrib['ref']))
				{
					$c['ref'] = $contrib['ref'];
				}
				else
				{
					$c['ref'] = array();
				}
								
				$display_name = $_FILES['contrib']['name'][$key]['widget_display'];
				$display_file = $_FILES['contrib']['tmp_name'][$key]['widget_display'];

				$c['widget_display'] = $this->grid->storeFile($display_file, array('filename' => $display_name));

				$browsing_name = $_FILES['contrib']['name'][$key]['widget_browsing'];
				$browsing_file = $_FILES['contrib']['tmp_name'][$key]['widget_browsing'];

				$c['widget_browsing'] = $this->grid->storeFile($browsing_file, array('filename' => $browsing_name));

				$modelo['tipoContrib'][$key] = $c;
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
		$modelo = $this->modelos->findOne( array('nombre' => $name));

		if($modelo) {			
			
			$data['modelo'] = &$modelo;

			$tipoContrib = $modelo['tipoContrib'];
			// LOLPHP: no funciona si usamos foreach($modelo['tipoContrib'] as &$contrib)
			foreach($tipoContrib as &$contrib)
			{
				$contrib['widget_browsing'] = $this->grid->get($contrib['widget_browsing']);
				$contrib['widget_display'] = $this->grid->get($contrib['widget_display']);
			}

			$modelo['tipoContrib'] = $tipoContrib;

			if($modelo)
			{

				$this->load->view('view_modelo', $data);
				return;
			}
		}

		show_404();
	}

	public function edit($name = null)
	{
		$modelo = $this->modelos->findOne( array('nombre' => $name));

		if($modelo) {			
			
			$data['modelo'] = &$modelo;
			$data['admin'] = $this->db->circles->find();

			// $tipoContrib = $modelo['tipoContrib'];
			// // LOLPHP: no funciona si usamos foreach($modelo['tipoContrib'] as &$contrib)
			
			// foreach($tipoContrib as &$contrib)
			// {
			// 	$contrib['widget_browsing'] = $this->grid->get($contrib['widget_browsing']);
			// 	$contrib['widget_display'] = $this->grid->get($contrib['widget_display']);
			// }


			// $modelo['tipoContrib'] = $tipoContrib;

			if($modelo)
			{
				$this->load->view('edit_modelo', $data);
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
		$submodel_id = new MongoId($this->input->get('submodel_id'));
		$contrib_nombre = $this->input->get('contrib_nombre');
		if($submodel_id && $contrib_nombre) {
			$submodel = $this->db->submodels->findOne(array('_id' => $submodel_id));
			$model = $this->modelos->findOne(array('_id' => $submodel['model']));

			$contribs = array();

			foreach($model['tipoContrib'] as $contrib)
			{
				
				if($contrib['nombre'] == $contrib_nombre)
					echo json_encode($contrib);
			}
		}
	}

	//Lista de nombres en json de los tipos de contribucion de un modelo dado
	public function contribuciones_json()
	{
		$submodel_id = new MongoId($this->input->get('submodel_id'));
		if($submodel_id) {
			$submodel = $this->db->submodels->findOne(array('_id' => $submodel_id));
			$model = $this->modelos->findOne(array('_id' => $submodel['model']));

			$contribs = array();

			foreach($model['tipoContrib'] as $contrib)
			{
				
				array_push($contribs,$contrib['nombre']);
					
			}
			echo json_encode($contribs);
		}
	}


}
