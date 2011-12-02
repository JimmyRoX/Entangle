<?php
class Widget extends CI_Controller
{
	function index()
	{
		$this->load->view('class_widget');

	}
	function content() 
	{
		$this->load->view('content_widget');
	}
	function popup()
	{
		$this->load->view('popup_widget');
	}
}

