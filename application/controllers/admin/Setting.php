<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
    public function index(){   
            $this->load->view('/admin/setting/index');

    }
    public function info(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$durl = $apiHost.'/setting/info?token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}
}
    public function listSpace(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$durl = $apiHost.'/session/listSpace?token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}
}
    public function lang(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $value = $this->input->post('value');

            $durl = $apiHost.'/setting/lang?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'value='.$value;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
	public function searchType(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $value = $this->input->post('value');

            $durl = $apiHost.'/setting/searchType?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'value='.$value;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function doubleClick(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $value = $this->input->post('value');

            $durl = $apiHost.'/setting/doubleClick?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'value='.$value;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function viewType(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $value = $this->input->post('value');

            $durl = $apiHost.'/setting/viewType?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'value='.$value;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function editType(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $value = $this->input->post('value');

            $durl = $apiHost.'/setting/editType?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'value='.$value;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function window(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $value = $this->input->post('value');

            $durl = $apiHost.'/setting/window?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'value='.$value;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
}
?>