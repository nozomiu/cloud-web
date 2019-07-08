<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revision extends CI_Controller {

    public function promote(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $docId = $this->input->post('docId');
			$id = $this->input->post('id');
			$opt_data = 'docId='.$docId.'&id='.$id;

            $durl = $apiHost.'/revision/promote?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
	public function rdelete(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $docId = $this->input->post('docId');
			$id = $this->input->post('id');
			$opt_data = 'docId='.$docId.'&id='.$id;

            $durl = $apiHost.'/revision/delete?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
}
?>