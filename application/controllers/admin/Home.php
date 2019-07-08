<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{   
	    
	    if($this->session->sessionId){
			$data['uid'] = $this->session->id;
			$data['loginName'] = $this->session->loginName;
			$data['sessionId'] = $this->session->sessionId;
			//$data['lang'] = $this->session->lang;
			$this->load->view('/admin/home/index',$data);
		}
		else{
			$this->load->view('/admin/home/logout');
		}

	}

	public function jsonLogout()
    {
    	$this->config->load('api');
		$api_host = $this->config->item('api_host');
		$api_port = $this->config->item('api_port');
		$apiHost  = $api_host.":".$api_port;
		$sessionId = $this->session->sessionId;
		$securityKey = $this->config->item('securityKey');
		$token = md5($securityKey.$sessionId.$securityKey);
		$opt_data = 'token='.$token.'&sessionId='.$sessionId;
		$durl = $apiHost.'/user/jsonLogout';
            
		curl_request($durl,$post='1',$opt_data);
		// if($manager['code'] == 200){
  //       //清空session数组
  //       unset($_SESSION);
  //       session_destroy();

  //       //删除客户端cookie 的 session id
  //       header('location:/');
		// }

    }
    public function logout()
    {
        //清空session数组
        unset($_SESSION);
        session_destroy();

        //删除客户端cookie 的 session id
        header('location:/');
    }
}
?>