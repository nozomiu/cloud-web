<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recycle extends CI_Controller {
    public function index()
    {   
            $this->load->view('/admin/dms/Recycle');

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

            $objName = rawurlencode($this->input->get('objName'));
            $pageNo = $this->input->get('pageNo');
            $pageSize = $this->input->get('pageSize')?$this->input->get('pageSize'):'15';
            $pageId = $this->input->get('pageId');
            $totalNumber = $this->input->get('totalNumber');

            $durl = $apiHost.'/recycle/pageList?token='.$token.'&sessionId='.$sessionId;
            if($objName){
                $durl .= '&objName='.$objName;
            }
            if($pageNo){
                $durl .= '&pageNo='.$pageNo;
            }
            if($pageId){
                $durl .= '&pageId='.$pageId;
            }
            if($pageSize){
                $durl .= '&pageSize='.$pageSize;
            }
            if($totalNumber){
                $durl .= '&totalNumber='.$totalNumber;
            }
            curl_request($durl);

    }
}
    public function restore(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objId = $this->input->post('objId');

            $durl = $apiHost.'/recycle/restore?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objId='.$objId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function batchRestore(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objIds = $this->input->post('objIds');

            $durl = $apiHost.'/recycle/batchRestore?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objIds='.$objIds;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function delete(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objIds = $this->input->post('objIds');

            $durl = $apiHost.'/recycle/delete?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objIds='.$objIds;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function clean (){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $durl = $apiHost.'/recycle/clean?token='.$token.'&sessionId='.$sessionId;
            $opt_data = '';
            
            curl_request($durl,$post='1',$opt_data);

    }
}

}
?>