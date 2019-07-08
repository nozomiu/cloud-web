<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl extends CI_Controller {
        public function index()
        {   
            $this->load->view('/admin/curl/index');
        }        
		public function clist(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$refId =  $this->input->get('refId');
            $name =  $this->input->get('name');
            $refName =  $this->input->get('refName');
            $pageNo = $this->input->get('pageNo');
            $pageSize = $this->input->get('pageSize');
            $totalNumber = $this->input->get('totalNumber');
            if($totalNumber){
                $tNumber = '&totalNumber='.$totalNumber;
            }else{
                $tNumber = '';
            }

			$durl = $apiHost.'/curl/list?refId='.$refId.'&token='.$token.'&sessionId='.$sessionId.$tNumber;
            if($name){
                $durl = $durl.'&name='.$name;
            }
            if($refName){
                $durl = $durl.'&refName='.$refName;
            }
            if($pageNo){
                $durl = $durl.'&pageNo='.$pageNo;
            }
            if($pageSize){
                $durl = $durl.'&pageNo='.$pageSize;
            }
			
			curl_request($durl);

	}

}

	public function create()
	{
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            header('Content-Type:application/json; charset=utf-8'); 

            $jsondata = file_get_contents('php://input');

            $durl = $apiHost.'/curl/create?token='.$token.'&sessionId='.$sessionId;

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
    public function curlView()
    {   
        $this->load->view('/admin/curl/curlView');
    }
    public function pwdLogin()
    {   
        $this->load->view('/admin/curl/pwdLogin');
    }
    public function innerLogin()
    {   
        $this->load->view('/admin/curl/innerLogin');
    }
    public function curlList()
    {   
        $this->load->view('/admin/curl/curlList');
    }
    public function loadMore()
    {   
        $this->load->view('/admin/curl/loadMore');
    }   
    public function openCurl(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;

            $cid =  $this->input->get('cid');
            //$token =  $this->input->get('token');
            $sessionId =  $this->input->get('sessionid');
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $durl = $apiHost.'/cJson/openCurl?cid='.$cid.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function view(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId =  $this->input->get('sessionid');
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid =  $this->input->get('cid');
            $refId =  $this->input->get('refId');
            $revId =  $this->input->get('revId');

            $durl = $apiHost.'/cJson/view?cid='.$cid.'&refId='.$refId.'&revId='.$revId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function detail(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId =  $this->input->get('sessionid');
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid =  $this->input->get('cid');
            $refId =  $this->input->get('refId');

            $durl = $apiHost.'/cJson/detail?cid='.$cid.'&refId='.$refId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function openFolder(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId =  $this->input->get('sessionid');
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid =  $this->input->get('cid');
            $refId =  $this->input->get('refId');

            $durl = $apiHost.'/cJson/openFolder?cid='.$cid.'&refId='.$refId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function treeList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId =  $this->input->get('sessionid');
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid =  $this->input->get('cid');
            $refId =  $this->input->get('refId');

            $durl = $apiHost.'/cJson/treeList?cid='.$cid.'&refId='.$refId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function objList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId =  $this->input->get('sessionid');
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid =  $this->input->get('cid');

            $durl = $apiHost.'/cJson/objList?cid='.$cid.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function preDownload(){
           if(IS_GET){ 
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId =  $this->input->get('sessionid');
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid =  $this->input->get('cid');
            $refId =  $this->input->get('refId');

            $durl = $apiHost.'/cJson/preDownload?cid='.$cid.'&refId='.$refId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function loginpwd(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid = $this->input->post('cid');
            $password = $this->input->post('password');
            $opt_data = 'cid='.$cid.'&password='.$password;

            $durl = $apiHost.'/curl/login/pwd';
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function logininner(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $cid = $this->input->post('cid');
            $loginName = $this->input->post('loginName');
            $password = $this->input->post('password');
            $opt_data = 'cid='.$cid.'&loginName='.$loginName.'&password='.$password;

            $durl = $apiHost.'/curl/login/inner?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function log(){
           if(IS_GET){ 
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $curlId =  $this->input->get('curlId');
            $refId =  $this->input->get('refId');

            $durl = $apiHost.'/curl/log?curlId='.$curlId.'&refId='.$refId.'&token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl);

    }
}
    public function curlLog()
    {   
        $this->load->view('/admin/curl/curlLog');
    }   
    public function disable(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $ids = $this->input->post('ids');
            $opt_data = 'ids='.$ids;

            $durl = $apiHost.'/curl/disable?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function enable(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $ids = $this->input->post('ids');
            $opt_data = 'ids='.$ids;

            $durl = $apiHost.'/curl/enable?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
    public function cobjList(){
           if(IS_GET){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $curlId =  $this->input->get('curlId');

            $durl = $apiHost.'/curl/objList?curlId='.$curlId.'&token='.$token.'&sessionId='.$sessionId;
            curl_request($durl);

    }
}
    public function delObj(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $curlId = $this->input->post('curlId');
            $refId = $this->input->post('refId');
            $opt_data = 'curlId='.$curlId.'&refId='.$refId;

            $durl = $apiHost.'/curl/delObj?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}

}
?>