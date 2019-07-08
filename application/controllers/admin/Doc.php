<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doc extends CI_Controller {

	public function index()
	{   
			$this->load->view('/admin/dms/doc');

	}

}
?>