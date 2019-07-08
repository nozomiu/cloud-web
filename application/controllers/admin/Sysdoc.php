<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sysdoc extends CI_Controller {

	public function index()
	{   
			$this->load->view('/admin/sysdoc/index');
	}
	public function proces()
	{   
			$this->load->view('/admin/sysdoc/proces');
	}
}
?>