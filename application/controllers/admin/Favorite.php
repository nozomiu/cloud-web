<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorite extends CI_Controller {
    public function index()
    {   
            $this->load->view('/admin/dms/Favorite');

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

            $pageNo = $this->input->get('pageNo');
            $pageSize = $this->input->get('pageSize')?$this->input->get('pageSize'):'15';
            $pageId = $this->input->get('pageId');
            $totalNumber = $this->input->get('totalNumber');

            $durl = $apiHost.'/favorite/pageList?token='.$token.'&sessionId='.$sessionId;

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
    public function add(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objId = $this->input->post('objId');

            $durl = $apiHost.'/favorite/add?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objId='.$objId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function rm(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objIds = $this->input->post('objIds');

            $durl = $apiHost.'/favorite/rm?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objIds='.$objIds;
            
            curl_request($durl,$post='1',$opt_data);

    }
}


}
?>