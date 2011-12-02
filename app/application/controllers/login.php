<?php
class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('user_model');
	}

	public function index() {
		$this->load->view('user_login_view');
	}

	public function submit() {

		if ($this->_submit_validate() == FALSE) {
			$this->index();
			return;
		}
		$data = $this->session->userdata('username');
		
		$this->load->view('user_login_success', $data);
	}

	private function _submit_validate() {
		
		$this->form_validation->set_rules('name', 'Username', 'trim|required|callback_authenticate');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_message('authenticate','Invalid login. Please try again.');
		
		return $this->form_validation->run();	
	}
	
	public function authenticate() {
	
		// get user document by name
		$udoc = $this->user_model->get_User($this->input->post('name'));
		if ($udoc) {
			
			// extensibilidad para match si se usa algún hash u objeto
			$upass = array('password' => $this->input->post('password'));
	
			// passwd match
			if ($udoc['password'] == $upass['password']) {
				unset($upass);
				$data = array(
					'username' => $udoc['name'],
					'acl' => $udoc['acl'],
					'logged_in' => TRUE
					);
				//guardamos las variables necesarias en el objeto sesion
				$this->session->set_userdata($data);
				return TRUE;
			}
			unset($upass);
		}
		return FALSE;
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
	
}