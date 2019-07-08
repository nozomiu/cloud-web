<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cession extends CI_Controller {

    public function scurrent(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $durl = $apiHost.'/session/current?token='.$token.'&sessionId='.$sessionId;
            
            header('Content-Type:application/json; charset=utf-8'); 
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $durl);
         curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC); 
         curl_setopt($curl,CURLOPT_HEADER,0);
         curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); 
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

         $result = curl_exec($curl);
            if($result === false){
                echo curl_errno($curl);
                exit();
            }
            
        $langs = json_decode($result,true);
        if(!$this->session->has_userdata('lang')){
            $this->session->set_userdata('lang',$langs['data']['lang']);
        }
           $this->session->set_userdata('doubleClick',$langs['data']['doubleClick']);
           $this->session->set_userdata('viewType',$langs['data']['viewType']);
           $this->session->set_userdata('editType',$langs['data']['editType']);
           $this->session->set_userdata('windowType',$langs['data']['windowType']);
           echo $result;

           curl_close($curl);
            
            

    }
}
    public function listSpace(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $durl = $apiHost.'/session/listSpace?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function changeSpace(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $spaceId = $this->input->post('spaceId');

            $durl = $apiHost.'/session/changeSpace?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'spaceId='.$spaceId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function changeModule(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $moduleType = $this->input->post('moduleType');

            $durl = $apiHost.'/session/changeModule?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'moduleType='.$moduleType;
            
            $this->session->set_userdata('mType',$moduleType);
            curl_request($durl,$post='1',$opt_data);

    }
}
    
}
?>