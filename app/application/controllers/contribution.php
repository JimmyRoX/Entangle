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
		
		if($user == null)
		{
			redirect('login');
			return;
		}


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
	
	public function add_reference($id_contrib = null)
	{
		if($this->input->post('add'))
		{
			$input = $this->input->post();
			$reference = $input['reference'];
			
			unset($reference['target']);
			unset($reference['tipoRef']);	
			if($input['reference']['target']=="-1")
			{
				$contrib = $input['contribution'];

				$contrib['submodel'] = new MongoId($contrib['submodel']);
			
				if($input['is_file']=="true")
				{
					$name = $_FILES['content']['name'];
					$fileId = $this->grid->storeUpload('content',$name);
					$contrib['content'] = $fileId;
				}
				else
				$contrib['content'] = $input['content'];
				
				$this->contribution_model->add_Contribution($contrib);
				
				
				$reference[$input['reference']['tipoRef']] = $contrib['_id'];
			}
			else
			{
				$reference[$input['reference']['tipoRef']] = new MongoId($input['reference']['target']);
			}
			$this->contribution_model->add_Reference($input['contrib_id'], $reference);
			

			redirect('contribution');	
			return;
		}
		
	}
	
	public function show()
	{
		$data = array();
		
		//Verificamos si esta logueado
		$user = $this->user_model->get_User($this->session->userdata('username'));
		if($user == null)
		{
			redirect('login');
			return;
		}

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

	//Metadata de referencia junto con los posibles targets, en json.
	public function reference_json($id = null)
	{
		//Obtenemos el tipo de referencia
		$tipoRef = $this->input->get('tipoRef');
		$target = $this->input->get('target');

		if($id) {
			//Navegamos hasta la colección "models" para obtener los campos de metadata de la referencia
			$contribDoc = $this->contribution_model->get_Contribution($id);

			$submodelDoc = $this->submodel_model->get_Submodel($contribDoc['submodel']);

			$modelDoc = $this->db->models->findOne(array('_id' => new MongoId($submodelDoc['model'])));

			$reference = array();

			foreach($modelDoc['tipoContrib'] as $contrib)
			{
				
				if($contrib['nombre'] == $contribDoc['tipoContrib'] && array_key_exists("refs", $contrib))
				{
					foreach($contrib['refs'] as $ref)
					{
						//Buscamos la referencia por el nombre
						if($ref['name'] == $tipoRef)
						{
							//Buscamos las contribuciones existentes que pueden servir de target
							$contribs = $this->db->contribs->find(array('tipoContrib' => $ref['target']));
							while($contribs->hasNext())
							{
								$c = $contribs->getNext();
								$reference['contribs'][] = array("name"=>$c['metadata']['nombre'],"id"=>$c['_id']."");	
							}
						
							if(array_key_exists("metadata", $ref))
								$reference['metadata'] = $ref['metadata'];
							else
								$reference['metadata'] = array();

							break;
						}
					}
				}
				
				
				if($contrib['nombre'] == $target)
				{
					$reference['target'] = $contrib;
					break;
				}
			}

			echo json_encode($reference);
		}
	}
	
	//Listado de referencias de una contribución dada
	public function references_json()
	{
		$contribution_id = new MongoId($this->input->get('contribution_id'));
		if($contribution_id) {
			$contribDoc = $this->contribution_model->get_Contribution($contribution_id);

			$submodelDoc = $this->submodel_model->get_Submodel($contribDoc['submodel']);

			$modelDoc = $this->db->models->findOne(array('_id' => new MongoId($submodelDoc['model'])));
		
			$data = array();
			foreach($modelDoc['tipoContrib'] as $contrib)
			{
			
				if($contrib['nombre'] == $contribDoc['tipoContrib'] && array_key_exists("refs", $contrib))
				{
					foreach($contrib['refs'] as $ref)
					{
							$reference = array();
							$reference['name'] = $ref['name'];                               
							$reference['target'] = $ref['target'];
							$data[]= $reference;
					}
				}
			}
			echo json_encode($data);
		}
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
				array_push($contribs,array("nombre"=> $contrib['metadata']['nombre'],"id"=> $contrib['_id'].""));
			}
			echo json_encode($contribs);
		}
	} 





}
