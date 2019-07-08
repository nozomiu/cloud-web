<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class G extends CI_Controller {

	public function commonJs()
	{   
	    $this->config->load('api');
	    $paths  = $this->config->item('paths');
	    $version  = $this->config->item('version');
        $api_host = $this->config->item('api_host');
        $api_port = $this->config->item('api_port');
        $doc_port = $this->config->item('doc_port');
        $apiHost  = $api_host.":".$api_port;
        $docHost  = $api_host.":".$doc_port;
        $sessionId = $this->session->sessionId;
        $doubleClick = $this->session->doubleClick;
        $viewType = $this->session->viewType;
        $editType = $this->session->editType;
        $windowType = $this->session->windowType;
    	$securityKey = $this->config->item('securityKey');
    	$token = md5($securityKey.$sessionId.$securityKey);
	    $theConfig = array(
	    'paths'   =>  '/admin/',
	    'version'   =>  $version,
        'apiHost'   =>  $apiHost,
        'docHost'   =>  $docHost,
        'tokens'    =>  $token,
    	'sessions'  =>  $sessionId,
    	'doubleClick'  =>  $doubleClick,
    	'viewType'  =>  $viewType,
    	'editType'  =>  $editType,
    	'windowType'  =>  $windowType
	    );
	    $useTime = time();
	    echo 'G='.json_encode($theConfig).';';
	    $lang = $this->lang->load('main', 'cn');
        $linejs = $this->lang->linejs($lang);
		if(!$linejs){
			$linejs = '{}';
		}
        echo 'LNG='.$linejs.';G.useTime='.$useTime.';';
	}
	public function sessions()
	{   
	    $this->config->load('api');
        $sessionId = $this->session->sessionId;
	    $theConfig = array(
    	'sessions'  =>  $sessionId
	    );
	    header('Content-type:text/json'); 
	    $data = '{"code":200,"data":'.json_encode($theConfig).'}';
	    echo $data;
	}

}
?>