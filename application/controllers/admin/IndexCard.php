<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexCard extends CI_Controller {

    public function clist(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$name = rawurlencode($this->input->get('name'));
            $rights = $this->input->get('rights');
            $objIds = $this->input->get('objIds');
            $page = $this->input->get('page');
            $sq = '';
            if($page){
                $sq = '&page='.$page;
            }
            if($name){
                $sq .= '&name='.$name;
            }
			$durl = $apiHost.'/indexCard/list?token='.$token.'&sessionId='.$sessionId.$sq;
			
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

            $durl = $apiHost.'/indexCard/detail?id='.$id.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function attrList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $indexCardId = $this->input->get('indexCardId');

            $durl = $apiHost.'/indexCard/attrList?indexCardId='.$indexCardId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}   	
    public function attrValueList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $attrId = $this->input->get('attrId');

            $durl = $apiHost.'/indexCard/attrValueList?attrId='.$attrId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}   
    public function save(){
           
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            header('Content-Type:application/json; charset=utf-8'); 

            //$objId = $this->input->post('objId');
            //$indexCardId = $this->input->post('indexCardId');
            //$valueList = $this->input->post('valueList');
			//$attrType = $this->input->post('attrType');
			//$refId = $this->input->post('refId');
			//$valid = $this->input->post('valid');

            $jsondata = file_get_contents('php://input');

            $durl = $apiHost.'/indexCard/save?token='.$token.'&sessionId='.$sessionId;

            $curl = curl_init($durl);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS,$jsondata);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsondata))
            );
 
            $result = curl_exec($curl);
            if($result === false){
                echo curl_errno($curl);
                exit();
            }
        echo $result;
        curl_close($curl);
}  

}
?>