<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
    
    public function docs(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $uploadKey = $this->input->post('uploadKey');
            $files = $this->input->post('files');
            $opt_data = 'uploadKey='.$uploadKey.'&files='.$files;

            $durl = $apiHost.'/upload/docs?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

	}
}


}
?>