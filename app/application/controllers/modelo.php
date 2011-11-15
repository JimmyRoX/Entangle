<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$m = new Mongo();
		$this->db = $m->entangle;
		$this->modelos = $this->db->modelos;
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
				$c['template']= $contrib['template'];

				$c['metadata'] = $contrib['metadata'];
				$c['ref'] = $contrib['ref'];

				$modelo['contrib'][] = $c;
			}

			$this->modelos->insert($modelo);
			redirect('modelo');	
			return;
		}

		$data = array();
		$data['admin'] = array('hugo', 'paco', 'luis');
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
			if($modelo)
			{
				$this->load->view('view_modelo', array('modelo' => $modelo));
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


}
