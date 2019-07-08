<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

    public function check(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $rights = $this->input->get('rights');
            $objIds = $this->input->get('objIds');

            $durl = $apiHost.'/permission/check?rights='.$rights.'&objIds='.$objIds.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function query(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->get('id');

            $durl = $apiHost.'/permission/query?id='.$id.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function queryDef(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->get('id');

            $durl = $apiHost.'/permission/queryDef?id='.$id.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function queryCustom(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->get('id');

            $durl = $apiHost.'/permission/queryCustom?id='.$id.'&token='.$token.'&sessionId='.$sessionId;
            
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
            $assigneeId = $this->input->post('assigneeId');
            $permission = $this->input->post('permission');

            $durl = $apiHost.'/permission/add?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objId='.$objId.'&assigneeId='.$assigneeId.'&permission='.$permission;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function adds(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objId = $this->input->post('objId');
            $assigneeIds = $this->input->post('assigneeIds');

            $durl = $apiHost.'/permission/adds?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objId='.$objId.'&assigneeIds='.$assigneeIds;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function syncDef(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');

            $durl = $apiHost.'/permission/syncDef?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'id='.$id;
            
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
            $objId = $this->input->post('objId');
            $assigneeId = $this->input->post('assigneeId');
            $permission = $this->input->post('permission');

            $durl = $apiHost.'/permission/update?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'id='.$id.'&objId='.$objId.'&assigneeId='.$assigneeId.'&permission='.$permission;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function del(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');
            $objId = $this->input->post('objId');

            $durl = $apiHost.'/permission/del?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'id='.$id.'&objId='.$objId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function inherit(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');

            $durl = $apiHost.'/permission/inherit?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'id='.$id;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function unInherit(){
            if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');

            $durl = $apiHost.'/permission/unInherit?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'id='.$id;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function assignee(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objId = $this->input->get('objId');

            $durl = $apiHost.'/permission/assignee?objId='.$objId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}

}
?>