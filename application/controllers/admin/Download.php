<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
    
    public function doc(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

            $downlaodKey = $this->input->get('downlaodKey');

			$durl = $apiHost.'/download/doc?downlaodKey='.$downlaodKey.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}
}


}
?>