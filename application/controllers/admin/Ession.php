<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ession extends CI_Controller {

    public function scurrent(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$durl = $apiHost.'/session/current?token='.$token.'&sessionId='.$sessionId;
			
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
    public function changeSpace(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $spaceId = $this->input->post('spaceId');

            $durl = $apiHost.'/session/changeSpace?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'spaceId='.$spaceId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function changeModule(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $moduleType = $this->input->post('moduleType');

            $durl = $apiHost.'/session/changeModule?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'moduleType='.$moduleType;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
	
}
?>