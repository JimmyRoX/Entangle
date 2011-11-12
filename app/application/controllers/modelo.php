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
		$data = $this->input->post();

		//$this->model->add_record($data);
		$this->modelos->insert($data);
		print_r($data);
		
		//$this->load->view("modelo", $data);
	}

	public function add()
	{
		$data = array();
		$data['admin'] = array('hugo', 'paco', 'luis');

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

	public function view($name)
	{
		if($name) {
			$modelo = $this->modelos->findOne( array('nombre' => $name));
			$this->load->view('view_modelo', array('modelo' => $modelo));
		}
	}

}
