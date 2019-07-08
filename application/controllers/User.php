<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{   
        $this->config->load('api');
        $api_host = $this->config->item('api_host');
        $api_port = $this->config->item('api_port');
		if(IS_POST){
            $this->load->library('Captcha');
			$loginName = $this->input->post('loginName');
            $password = $this->input->post('password');
            $loginModel = $this->input->post('loginModel');
            $loginP = $this->input->post('loginP');
            //$verify = $this->input->post('verify');
            $verify = $this->config->item('verify');

            $captcha = new Captcha();

            $results = $captcha->validate($verify);
            
            if($verify) {
            $url = $api_host.':'.$api_port.'/user/jsonLogin';
            $opt_data = 'loginName='.$loginName.'&password='.$password.'&loginModel='.$loginModel.'&p='.$loginP;

            $curl = curl_init(); 
            curl_setopt($curl,CURLOPT_URL,$url); 
            curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC); 
            curl_setopt($curl,CURLOPT_HEADER,0);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); 
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$opt_data);

            $result = curl_exec($curl);

            if($result === false){
                echo curl_errno($curl);
                exit(); 
            }
            $manager = json_decode($result,true);

            if($manager['code'] == 200){
                $this->session->set_userdata('uid',$manager['data']['id']);
                $this->session->set_userdata('loginName',$manager['data']['loginName']);
                $this->session->set_userdata('sessionId',$manager['data']['sessionId']);
                //$this->session->set_userdata('lang',$manager['data']['lang']);
            }else{
                unset($_SESSION['sessionId']);
                session_destroy();
            }
            echo $result;

            curl_close($curl);
            }
            else{
                header('Content-type:text/json'); 
                $data = '{"code":444}';
                echo $data;
            }
 
		}

	}
    public function changePwd(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $oldPwd = $this->input->post('oldPwd');
            $newPwd = $this->input->post('newPwd');
            $opt_data = 'oldPwd='.$oldPwd.'&newPwd='.$newPwd;

            $durl = $apiHost.'/user/changePwd?token='.$token.'&sessionId='.$sessionId;
            
            curl_request($durl,$post='1',$opt_data);

    }
}
	public function home()
	{
		if($this->session->sessionId){
            $data['uid'] = $this->session->id;
			$data['sessionId'] = $this->session->sessionId;
			$data['loginName'] = $this->session->loginName;
            //$data['lang'] = $this->session->lang;
			$this->load->view($data);
			//echo $data['uid'];
		}
		else{
			echo $this->lang->line('Illegal');
		}
	}
	public function logout()
    {
        //清空session数组
        unset($_SESSION['sessionId']);
        //session_destroy();

        //删除客户端cookie 的 session id
        header('location:/');
    }
}
?>