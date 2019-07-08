<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Org extends CI_Controller {
    
    public function relOrgList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $durl = $apiHost.'/org/relOrgList?token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);
	}
}
    public function getSubOrgTreeNode(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);
			
			$prtId = $this->input->get('prtId');

            $durl = $apiHost.'/org/getSubOrgTreeNode?prtId='.$prtId.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);
	}
}
    public function pageItemList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);
			
			$orgId = $this->input->get('orgId');
			$userName = rawurlencode($this->input->get('userName'));
            $pageNo = $this->input->get('pageNo');
            $pageSize = $this->input->get('pageSize');
            $totalNumber = $this->input->get('totalNumber');
            if($totalNumber){
                $tNumber = '&totalNumber='.$totalNumber;
            }else{
                $tNumber = '';
            }

            $durl = $apiHost.'/org/pageItemList?orgId='.$orgId.'&userName='.$userName.'&pageNo='.$pageNo.'&pageSize='.$pageSize.'&token='.$token.'&sessionId='.$sessionId.$tNumber;
			
			curl_request($durl);
	}
}

}
?>