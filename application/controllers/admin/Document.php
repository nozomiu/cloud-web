<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

    public function preUpload(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $opt_data = 'id='.$id;

            $durl = $apiHost.'/document/preUpload?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function preView(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $currentRev = $this->input->post('currentRev');

            $opt_data = 'id='.$id;
            if($currentRev){
                $opt_data .= '&currentRev='.$currentRev;
            }

            $durl = $apiHost.'/document/preView?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function preCheckIn(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $opt_data = 'id='.$id;

            $durl = $apiHost.'/document/preCheckIn?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function preDownload(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $currentRev = $this->input->post('currentRev');
            $opt_data = 'id='.$id.'&currentRev='.$currentRev;

            $durl = $apiHost.'/document/preDownload?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function prePdfDownload(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $currentRev = $this->input->post('currentRev');
            $opt_data = 'id='.$id.'&currentRev='.$currentRev;

            $durl = $apiHost.'/document/prePdfDownload?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function preEdit(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $opt_data = 'id='.$id;

            $durl = $apiHost.'/document/preEdit?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function detail(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->get('id');
            $revId = $this->input->get('revId');

			$durl = $apiHost.'/document/detail?id='.$id.'&revId='.$revId.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}
}
	public function revList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $docId = $this->input->get('docId');

            $durl = $apiHost.'/document/revList?docId='.$docId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
	public function checkNames(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $names = rawurlencode($this->input->get('names'));
			$fldId = $this->input->get('fldId');

            $durl = $apiHost.'/document/checkNames?names='.$names.'&fldId='.$fldId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function lock(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $lockType = $this->input->post('lockType')?$this->input->post('lockType'):'2';
            $opt_data = 'id='.$id.'&lockType='.$lockType;

            $durl = $apiHost.'/document/lock?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function unlocak(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $opt_data = 'id='.$id;

            $durl = $apiHost.'/document/unlock?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
}
?>