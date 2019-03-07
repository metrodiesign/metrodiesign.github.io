<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller {

	public function index()
	{
		$data['heading'] = '404 Page Not Found';
		$data['message'] = 'The page you requested was not found.';

		$this->load->view('errors/html/error_404', $data);
	}
}
