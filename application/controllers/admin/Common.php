<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
    
        
	public function dmsDetail()
	{   
		$this->load->view('/admin/common/dmsdetail');
	}
	public function indexCard()
	{
		$this->load->view('/admin/common/indexCard');
	}
	public function accessLog()
	{
		$this->load->view('/admin/common/accessLog');
	}
	public function docVersion()
	{
		$this->load->view('/admin/common/docVersion');
	}
	public function permission()
	{
		$this->load->view('/admin/common/permission');
	}
	public function curlLog()
	{
		$this->load->view('/admin/common/curlLog');
	}
	public function docView()
	{
		$this->load->view('/admin/common/docView');
	}
	public function emptyTab()
	{
		$this->load->view('/admin/common/emptyTab');
	}
	public function search()
	{
		$this->load->view('/admin/common/search');
	}
	public function createFolder()
	{
		$this->load->view('/admin/common/createFolder');
	}
	public function PathList()
	{
		$this->load->view('/admin/common/PathList');
	}
}
?>