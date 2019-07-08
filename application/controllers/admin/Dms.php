<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dms extends CI_Controller {
    
        
	public function searchKeys(){   
		if(IS_GET){
	        $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$durl = $apiHost.'/dms/searchKeys?token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

            }
	}

	public function search(){   
		if(IS_GET){
	        $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

			$searchType = $this->input->get('searchType')?$this->input->get('searchType') : 1;
            $prtId = $this->input->get('prtId');
    	    $keyWord = urlencode($this->input->get('keyWord'));
            $title = urlencode($this->input->get('title'));
            $content = urlencode($this->input->get('content'));
            $desc = urlencode($this->input->get('desc'));
            $objType = $this->input->get('objType');
            $includeSubFolder = $this->input->get('includeSubFolder');
            $ignoreCase = $this->input->get('ignoreCase');
            $createdBy = $this->input->get('createdBy');
            $updatedBy = $this->input->get('updatedBy');
            $befCreatedTime = rawurlencode($this->input->get('befCreatedTime'));
            $aftCreatedTime = rawurlencode($this->input->get('aftCreatedTime'));
            $befUpdatedTime = rawurlencode($this->input->get('befUpdatedTime'));
            $aftUpdatedTime = rawurlencode($this->input->get('aftUpdatedTime'));
			$pageId = $this->input->get('pageId');
			$startId = $this->input->get('startId');
            $lastId = $this->input->get('lastId');
			$pageType = $this->input->get('pageType');
            $pageSize = $this->input->get('pageSize')?$this->input->get('pageSize'):'15';
            $sort = $this->input->get('sort');
            $sortOrder = $this->input->get('sortOrder');

            $durl = $apiHost.'/dms/search?token='.$token.'&sessionId='.$sessionId.'&keyWord='.$keyWord;
            if($searchType){
                $durl .= '&searchType='.$searchType; //父节点id
            }
            if($prtId){
                $durl .= '&prtId='.$prtId; //父节点id
            }
            if($pageId){
                $durl .= '&pageId='.$pageId;
            }
            if($startId){
                $durl .= '&startId='.$startId;
            }
            if($pageType){
                $durl .= '&pageType='.$pageType;
            }
            if($pageSize){
                $durl .= '&pageSize='.$pageSize;
            }
            if($title){
                $durl .= '&title='.$title; //文档标题搜索关键字
            }
            if($content){
                $durl .= '&content='.$content; //文档内容搜索关键字
            }
            if($desc){
                $durl .= '&desc='.$desc; //文档描述搜索关键字
            }
            if($objType != 0){
                $durl .= '&objType='.$objType; //文档搜索类型,文档柜：31，文件夹：32，文档：34
            }
            if($includeSubFolder){
                $durl .= '&includeSubFolder='.$includeSubFolder; //是否包含子文件，默认包含
            }
            if($ignoreCase){
                $durl .= '&ignoreCase='.$ignoreCase; //是否包含子文件，默认包含
            }
            if($createdBy){
                $durl .= '&createdBy='.$createdBy; //创建人ID
            }
            if($updatedBy){
                $durl .= '&updatedBy='.$updatedBy; //修改人ID
            }
            if($befCreatedTime){
                $durl .= '&befCreatedTime='.$befCreatedTime; //查询创建起始时间
            }
            if($aftCreatedTime){
                $durl .= '&aftCreatedTime='.$aftCreatedTime; //查询创建结束时间
            }
            if($befUpdatedTime){
                $durl .= '&befUpdatedTime='.$befUpdatedTime; //查询修改起始时间
            }
            if($aftUpdatedTime){
                $durl .= '&aftUpdatedTime='.$aftUpdatedTime; //查询修改结束时间
            }
            if($sort){
                if($sort == 'name'){
                    $sortField = 'name';
                }
                if($sort == 'size'){
                    $sortField = 'size';
                }
                if($sort == 'updatedDt'){
                    $sortField = 'updatedDt';
                }
                $durl = $durl.'&sortField='.$sortField.'&sortDirection='.$sortOrder;
            }
            //echo $durl;
			curl_request($durl);
        }    
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

            $prtId = $this->input->get('prtId');
            $pageNo = $this->input->get('pageNo');
            $pageSize = $this->input->get('pageSize');
            $totalNumber = $this->input->get('totalNumber');
            $sort = $this->input->get('sort');
            $sortOrder = $this->input->get('sortOrder');
            if($totalNumber){
                $tNumber = '&totalNumber='.$totalNumber;
            }else{
                $tNumber = '';
            }

			$durl = $apiHost.'/dms/pageList?prtId='.$prtId.'&pageNo='.$pageNo.'&pageSize='.$pageSize.'&token='.$token.'&sessionId='.$sessionId.$tNumber;
			if($sort){
                if($sort == 'name'){
                    $sortField = 'name';
                }
                if($sort == 'size'){
                    $sortField = 'size';
                }
                if($sort == 'updatedDt'){
                    $sortField = 'updated_dt';
                }
                $durl = $durl.'&sortField='.$sortField.'&sortDirection='.$sortOrder;
            }
			$codes = curl_request($durl);

	}

}

	public function relTags(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

    	    $objId = $this->input->get('objId');
    	    $tagIds = $this->input->get('tagIds');

			$durl = $apiHost.'/dms/relTags?objId='.$objId.'&tagIds='.$tagIds.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}

}


	public function unRelTags(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

    	    $objId = $this->input->get('objId');
    	    $tagIds = $this->input->get('tagIds');

			$durl = $apiHost.'/dms/unRelTags?objId='.$objId.'&tagIds='.$tagIds.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

	}

}
	public function dlog(){
           if(IS_GET){
		    $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
    	    $securityKey = $this->config->item('securityKey');
    	    $token = md5($securityKey.$sessionId.$securityKey);

    	    $refId = $this->input->get('refId');
    	    $pageSize = $this->input->get('pageSize');

			$durl = $apiHost.'/dms/log?refId='.$refId.'&pageSize='.$pageSize.'&token='.$token.'&sessionId='.$sessionId;
			
			curl_request($durl);

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
    	    $opt_data = 'objIds='.$objIds;

			$durl = $apiHost.'/dms/delete?token='.$token.'&sessionId='.$sessionId;
			
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

            $durl = $apiHost.'/dms/update?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'id='.$id.'&name='.$name.'&description='.$description;
            
            curl_request($durl,$post='1',$opt_data);

    }
} 
    public function cut(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objIds = $this->input->post('objIds');

            $durl = $apiHost.'/dms/cut?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objIds='.$objIds;
            
            curl_request($durl,$post='1',$opt_data);

    }
} 
    public function copy(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host');
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $objIds = $this->input->post('objIds');

            $durl = $apiHost.'/dms/copy?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'objIds='.$objIds;
            
            curl_request($durl,$post='1',$opt_data);

    }
} 
    public function paste(){
           if(IS_POST){
            $this->config->load('api');
            $api_host = $this->config->item('api_host'); 
            $api_port = $this->config->item('api_port');
            $apiHost  = $api_host.":".$api_port;
            $sessionId = $this->session->sessionId;
            $securityKey = $this->config->item('securityKey');
            $token = md5($securityKey.$sessionId.$securityKey);

            $id = $this->input->post('id');

            $durl = $apiHost.'/dms/paste?token='.$token.'&sessionId='.$sessionId;
            $opt_data = 'id='.$id;
            
            curl_request($durl,$post='1',$opt_data);

    }
} 

}
?>