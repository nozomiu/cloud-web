<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabinet extends CI_Controller {

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
    	    $pageSize = $this->input->get('pageSize');
    	    $pageId = $this->input->get('pageId');
            $sort = $this->input->get('sort');
            $sortOrder = $this->input->get('sortOrder');

			$durl = $apiHost.'/cabinet/pageList?token='.$token.'&sessionId='.$sessionId;
			if($sort){
                if($sort == 'name'){
                    $sortField = $sort;
                }
                if($sort == 'sizeStr'){
                    $sortField = 'size';
                }
                if($sort == 'updatedDt'){
                    $sortField = 'updated_dt';
                }
                $durl = $apiHost.'/cabinet/pageList?token='.$token.'&sessionId='.$sessionId.'&sortField='.$sortField.'&sortDirection='.$sortOrder;
            }

			$data = curl_request($durl);

            echo $data['list'];

	}
}
	public function treelist(){
           if(IS_GET){

		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$durl = $apiHost.'/cabinet/treeList?token='.$token.'&sessionId='.$sessionId;
			
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

			$durl = $apiHost.'/cabinet/detail?id='.$id.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}
}
	public function create(){
           if(IS_POST){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

    	    $name = rawurlencode($this->input->post('name'));
            $description = rawurlencode($this->input->post('description'));
    	    $opt_data = 'name='.$name.'&description='.$description;

			$durl = $apiHost.'/cabinet/create?token='.$token.'&sessionId='.$sessionId;
			
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
            $description = rawurlencode($this->input->post('description'));
    	    $opt_data = 'id='.$id.'&name='.$name.'&description='.$description;

			$durl = $apiHost.'/cabinet/update?token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl,$post='1',$opt_data);

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

			$durl = $apiHost.'/cabinet/checkName?name="'.$name.'"&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}
}

}
?>