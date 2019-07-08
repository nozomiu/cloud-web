<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C extends CI_Controller {

	public function index()
	{     
        $this->load->view('/admin/curl/c');
	}
	
}
?>