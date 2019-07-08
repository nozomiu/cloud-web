<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends CI_Controller {
    
    public function create(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $prtId = $this->input->post('prtId');
			$name = rawurlencode($this->input->post('name'));
            $allowDocFormat = $this->input->post('allowDocFormat');
            $description = rawurlencode($this->input->post('description'));
            $opt_data = 'prtId='.$prtId.'&name='.$name.'&allowDocFormat='.$allowDocFormat.'&description='.$description;

            $durl = $apiHost.'/folder/create?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function update(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $name = rawurlencode($this->input->post('name'));
            $allowDocFormat = $this->input->post('allowDocFormat');
            $description = rawurlencode($this->input->post('description'));
            $opt_data = 'id='.$id.'&name='.$name.'&allowDocFormat='.$allowDocFormat.'&description='.$description;

            $durl = $apiHost.'/folder/update?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
	public function pageList(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$prtId = $this->input->get('prtId');
			$pageNo = $this->input->get('pageNo');
			$pageSize = $this->input->get('pageSize');
			$pageId = $this->input->get('pageId');

			$durl = $apiHost.'/folder/pageList?prtId='.$prtId.'&pageNo='.$pageNo.'&pageSize='.$pageSize.'&pageId='.$pageId.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}

}
	public function treeList(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$prtId = $this->input->get('prtId');

			$durl = $apiHost.'/folder/treeList?prtId='.$prtId.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);


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

			$durl = $apiHost.'/folder/detail?id='.$id.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}

}
	public function checkName(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$name = rawurlencode($this->input->get('name'));
			$id = $this->input->get('id');
			$prtId = $this->input->get('prtId');

			$durl = $apiHost.'/folder/checkName?name='.$name.'&id='.$id.'&prtId='.$prtId.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

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
            $opt_data = 'id='.$id;

            $durl = $apiHost.'/folder/preDownload?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }

}
    public function preDownloads(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objIds = $this->input->post('objIds');
            $currentRev = $this->input->post('currentRev');
            $opt_data = 'objIds='.$objIds;

            $durl = $apiHost.'/folder/preDownloads?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }

}

}
?>