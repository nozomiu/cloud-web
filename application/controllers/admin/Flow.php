<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flow extends CI_Controller {
    public function index()
    {   
            $this->load->view('/admin/dms/flow');

    }
    public function submit(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            //$type = $this->input->post('type');
            $type = '1';
            $cacheId = $this->input->post('cacheId');
            $approvedBy = $this->input->post('approvedBy');
            $description = rawurlencode($this->input->post('description'));

            $durl = $apiHost.'/flow/submit?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'type='.$type.'&cacheId='.$cacheId.'&approvedBy='.$approvedBy.'&description='.$description;
            
            curl_request($durl,$post='1',$opt_data);

	}
}
        public function myRequest(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $status =  $this->input->get('status')?$this->input->get('status'):'';
            $pageNo =  $this->input->get('pageNo')?$this->input->get('pageNo'):'';
            $pageSize =  $this->input->get('pageSize')?$this->input->get('pageSize'):15;
            $totalNumber = $this->input->get('totalNumber');

            $durl = $apiHost.'/flow/myRequest?token='.$token.'&sessionId='.$sessionId;
            if($status){
                $durl .= '&status='.$status;
            }
            if($pageNo){
                $durl .= '&pageNo='.$pageNo;
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
        public function myApprove(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $status =  $this->input->get('status');
            $pageNo =  $this->input->get('pageNo');
            $pageSize =  $this->input->get('pageSize')?$this->input->get('pageSize'):15;

            $durl = $apiHost.'/flow/myApprove?status='.$status.'&pageNo='.$pageNo.'&pageSize='.$pageSize.'&token='.$token.'&sessionId='.$sessionId;
            
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

            $id =  $this->input->get('id');

            $durl = $apiHost.'/flow/detail?id='.$id.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }

}
        public function approve(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id =  $this->input->get('id');
            $status =  $this->input->get('status');

            $durl = $apiHost.'/flow/approve?id='.$id.'&status='.$status.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }

}
}
?>