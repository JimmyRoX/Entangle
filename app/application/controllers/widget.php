<?php
class Widget extends CI_Controller
{
	function index()
	{
		$this->load->view('class_widget');

	}
	function content() 
	{
		if(($data['widget_file'] = $this->input->post('widget_file')) != "") {
			$this->load->helper('widget_parser');			
			$this->load->view('content_widget', $data);	
		}
		else $this->load->view('content_widget');

	}
	function popup()
	{
		$this->load->view('popup_widget');
	}
	function subject() 
	{
		$this->load->view('subject_widget');
	}
	function asdf() {
		$this->load->view('subject_widget');
	}
	function upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'html';
		$this->load->library('upload', $config);
				
		$this->upload->do_upload();
		$data = array('upload_data' => $this->upload->data());
		$data['widget_file'] = $data['upload_data']['full_path'];
		$data['widget_type'] = $this->input->post('widget_type');

		$this->load->view('class_widget', $data);
	}
}

