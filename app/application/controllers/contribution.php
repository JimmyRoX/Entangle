<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contribution extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$m = new Mongo();
		$this->db = $m->entangle;
		
		$this->load->model('contribution_model');
		$this->load->model('submodel_model');
		$this->load->model('user_model');

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
			$contrib = $this->input->post();

			$contrib['submodel'] = new MongoId($contrib['submodel']);
			
			if($contrib['is_file']=="true")
			{
				$name = $_FILES['content']['name'];
				$fileId = $this->grid->storeUpload('content',$name);
				$contrib['content'] = $fileId;
			}
			unset($contrib['is_file']);
			unset($contrib['add']);			
			
			$this->contribution_model->add_Contribution($contrib);

			redirect('contribution');	
			return;
		}
		$data = array();
		
		$user = $this->user_model->get_User($this->session->userdata('username'));

		$submodelsDocs = array();
		foreach($user['acl'] as $circleId)
		{
			$submodelsResults = $this->db->submodels->find(array('circle.acl' => $circleId['circle']));
	
			while($submodelsResults->hasNext())
			{
				array_push($submodelsDocs,$submodelsResults->getNext());
			}
			
		}		


		$submodels = array();
		foreach($submodelsDocs as $submodel)
		{
			array_push($submodels,array(
				"nombre"=> $submodel['nombre'],
				"id"=> $submodel['_id']
			));
		}
		$data['submodels']=$submodels;
		
		$this->load->view('add_contribucion.php', $data);
	}
	
	public function add_reference()
	{
	}
	
	public function show()
	{
		$data = array();
		
		$user = $this->user_model->get_User($this->session->userdata('username'));

		$submodelsDocs = array();
		foreach($user['acl'] as $circleId)
		{
			$submodelsResults = $this->db->submodels->find(array('circle.acl' => $circleId['circle']));
	
			while($submodelsResults->hasNext())
			{
				array_push($submodelsDocs,$submodelsResults->getNext());
			}
			
		}		


		$submodels = array();
		foreach($submodelsDocs as $submodel)
		{
			array_push($submodels,array(
				"nombre"=> $submodel['nombre'],
				"id"=> $submodel['_id']
			));
		}
		$data['submodels']=$submodels;

		$this->load->view('list_contributions', $data);

	}

	public function view($id = null)
	{
		if($id) {
			$contribution = $this->contribution_model->get_Contribution($id);
			$this->load->view('view_contribucion', array('contribucion' => $contribution));
			return;
		}

		show_404();
	}



	public function delete($id = null)
	{
		if($id)
		{
			$this->contribution_model->delete_Contribution($id);
		}

		redirect('contribution');
	}

	//Listado de contribuciones en un submodelo dado
	public function contributions_json()
	{
		$submodel_id = new MongoId($this->input->get('submodel_id'));

		if($submodel_id) {
			$contribsDocs = $this->db->contribs->find(array('submodel' => $submodel_id));

			$contribs = array();

			while($contribsDocs->hasNext())
			{
				$contrib = $contribsDocs->getNext();
				array_push($contribs,array(
					"nombre"=> $contrib['metadata']['nombre'],
					"id"=> $contrib['_id'].""
				));
					
			}
			echo json_encode($contribs);
		}
	}





}
