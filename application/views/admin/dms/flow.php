<?php
    if(!isset($this->session->sessionId)){
        header('Location: /');
        exit();
    }else{
        $this->config->load('api');
        $version  = $this->config->item('version');
        $langs  = $this->config->item('langs');
        $lang = $this->session->lang;
        $this->lang->load('main', $lang);
        $lang = $this->session->lang;
        $this->lang->load('main', $lang);
        $this->config->load('api');
        $api_host = $this->config->item('api_host');
        $api_port = $this->config->item('api_port');
        $doc_port = $this->config->item('doc_port');
        $apiHost  = $api_host.":".$api_port;
        $docHost  = $api_host.":".$doc_port;
    }
?>
<html lang="ch">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $this->lang->line('title');?></title>
    <meta itemprop="image" content="/statics/common/images/ico.png?ver=<?php echo $version;?>" />
    <link href="/statics/images/common/ico.png?ver=<?php echo $version;?>" rel="Shortcut Icon" type="image/x-icon">
    <link href="/statics/images/common/ico.png?ver=<?php echo $version;?>" rel="icon" type="image/x-icon">
    <link href="/statics/style/common.css?ver=<?php echo $version;?>" rel="stylesheet"/>
    <link href="/statics/style/font-awesome/css/font-awesome.css?ver=<?php echo $version;?>" rel="stylesheet">
    <script src="/static/js/jquery.min.js?ver=<?php echo $version;?>"></script>
    <script src="/statics/js/lib/code_beautify.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <script src="/static/js/dms/action.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/toastr.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap-table.min.js"></script>
    <script src="/static/js/bootstrap-table-zh-CN.min.js"></script>
    <link href="/static/layui/css/layui.css"  rel="stylesheet">
    <script src="/static/layui/layui.js"/></script>
    <script src="/static/js/dms/flow.js?ver=<?php echo $version;?>"></script>
    <link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/win10.css?ver=<?php echo $version;?>" id='link-theme-style'/>

<style>
.frame-main .frame-right{left:100px;min-width:924px}
.list-type-header tr{font-size:12px}
#listContent,#main-title{font-size:12px}
.frame-right-main{width:924px}
#page-explorer{min-width:1024px;width:1024px}
.table-bordered{border:0}
.ui-state-default{padding-left:10px!important}
.file-continer{padding-top:36px!important}
#listContent .filename,#main-title .filename{width:160px;padding-left:15px;margin-left:0}
#listContent .filetype,#main-title .filetype{width:70px;text-align:left}
#listContent .filesize,#main-title .filesize{width:60px;text-align:left;padding-left:10px;padding-right:0}
#listContent .filetime,#main-title .filetime{width:120px;padding-right:6px}
#listContent .fileoperation,#main-title .fileoperation{width:120px;padding-right:0}
.list-type-header{display:table-header-group!important;width:100%!important;position:fixed!important;margin-top:-36px!important}
.ztree li.panelf{padding-top:0;cursor:pointer;text-decoration:none;display:block;margin:0;color:#333;vertical-align:top;line-height:34px;height:34px;padding-left:10px;border:1px solid #fff;position:relative}
.ztree li.panelf h3{font-size:12px;line-height:34px;height:34px}
.frame-right{display:none}
.active{display:block}
.ztree li.cur{background:#3b8cff;color:#FFF}
.open-window{padding:5px 14px!important}
</style>
</head>
<body style="overflow:hidden;" id="page-explorer">
<link href="/static/css/jquery-confirm.min.css"  rel="stylesheet">
<link href="/static/css/toastr.css"  rel="stylesheet">
<div class="full-background"></div>

<div class="frame-main" style="top:0">
    <div class="frame-left" id="frame-left" style="width:99px;">
        <ul id="accordion" class="ztree tab-buttons">
            <li class="panelf tab-button cur" data-tab="myRequest"><h3 ><?php echo $this->lang->line('myRequest');?></h3></li>
            <li class="panelf tab-button" data-tab="myApprove"><h3 ><?php echo $this->lang->line('myApprove');?></h3></li>
        </ul>
    </div>
<div class='frame-right active' id="tab-myRequest">
<div class='frame-right-main'>
<div class="tools">
    <div style="clear:both"></div>
</div>
</div>      
<div class='bodymain drag-upload-box menu-body-main' style="top:1px">

    <div id="rightContent" class="file-continer file-list-list">        
    <div id="centerDiv" class="tab-content">
        <!-- 组织文档模块 start-->
        <div role="tabpanel" class="tab-pane active" id="Recycle">
        <div class="frame-right-main">

            <div class="data-div">

                    <div class="device-listStyle table-responsive" >
                        <table contenteditable="false" id="myRequestListTable" data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex">
                            <thead id="main-title" class="list-type-header">
                    <tr>
                    <th class="ui-state-default" data-width="0px" data-radio="true" data-align="center" data-valign="middle"></th>
                    <th class="filetype" data-field="id" data-align="left" data-valign="middle"><?php echo $this->lang->line('Process_Number');?><span></span></th>
                    <th class="filename" data-field="name" data-align="left"><?php echo $this->lang->line('Process_Name')?><span></span></th>
                    <th class="fileoperation" data-field="applicantByName" data-align="left" data-valign="middle"><?php echo $this->lang->line('Applicant_Name')?></th>
                    <th class="fileoperation" data-field="approvedByName" data-escape="true" data-align="left" data-valign="middle"><?php echo $this->lang->line('Approver_Name')?><span></span></th>
                    <th class="filesize" data-field="status" data-align="left" data-valign="middle" data-formatter="FlowObj.Sstatus"><?php echo $this->lang->line('State')?><span></span></th>
                    <th class="filetime" data-field="createdDt" data-align="left" data-valign="middle" data-formatter="commobj.dateFormat"><?php echo $this->lang->line('Application_Time')?><span></span></th>
                    <th class="fileoperation" data-field="approvedByName" data-escape="true" data-align="left" data-valign="middle" data-formatter="FlowObj.operAtionFormat"><?php echo $this->lang->line('operAtion')?><span></span></th>
                    </tr>
                    </thead>
                            <tbody id="listContent" class="file-list-list">
                            </tbody>
                        </table>

                    </div>
            </div>      
            </div>
        </div>
        <!-- 组织文档模块 end-->
    </div>
    </div>
    </div>
    </div>
	<div class='frame-right' id="tab-myApprove">
<div class='frame-right-main'>
<div class="tools">
    <div style="clear:both"></div>
</div>
</div>      
<div class='bodymain drag-upload-box menu-body-main' style="top:1px">

    <div id="rightContent" class="file-continer file-list-list">        
    <div id="centerDiv" class="tab-content">
        <!-- 组织文档模块 start-->
        <div role="tabpanel" class="tab-pane active" id="Recycle">
        <div class="frame-right-main">

            <div class="data-div">

                    <div class="device-listStyle table-responsive" >
                        <table contenteditable="false" id="myApproveListTable" data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex">
                            <thead id="main-title" class="list-type-header">
                    <tr>
                    <th class="ui-state-default" data-width="0px" data-radio="true" data-align="center" data-valign="middle"></th>
                    <th class="filetype" data-field="id" data-align="left" data-valign="middle"><?php echo $this->lang->line('Process_Number');?><span></span></th>
                    <th class="filename" data-field="name" data-align="left"><?php echo $this->lang->line('Process_Name')?><span></span></th>
                    <th class="fileoperation" data-field="applicantByName" data-align="left" data-valign="middle"><?php echo $this->lang->line('Applicant_Name')?></th>
                    <th class="fileoperation" data-field="approvedByName" data-escape="true" data-align="left" data-valign="middle"><?php echo $this->lang->line('Approver_Name')?><span></span></th>
                    <th class="filesize" data-field="status" data-align="left" data-valign="middle" data-formatter="FlowObj.Sstatus"><?php echo $this->lang->line('State')?><span></span></th>
                    <th class="filetime" data-field="createdDt" data-align="left" data-valign="middle" data-formatter="commobj.dateFormat"><?php echo $this->lang->line('Application_Time')?><span></span></th>
					<th class="fileoperation" data-field="approvedByName" data-escape="true" data-align="left" data-valign="middle" data-formatter="FlowObj.operAtionFormat2"><?php echo $this->lang->line('operAtion')?><span></span></th>
                    </tr>
                    </thead>
                            <tbody id="listContent" class="file-list-list">
                            </tbody>
                        </table>

                    </div>
            </div>      
            </div>
        </div>
        <!-- 组织文档模块 end-->
    </div>
    </div>
    </div>
    </div>
<div class="modal fade" id="shareDetail" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="submit">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ></h4>
            </div>
            <div id="shareContainer" class="container-fluid" >
                
            </div>
            
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script> 
<script type="text/javascript" src="/admin/g/commonjs"></script>
<script type="text/javascript">
    //tab切换     
    $('.tab-button').click(function() {
        var tab = $(this).data('tab')
        $(this).addClass('cur').siblings('.tab-button').removeClass('cur');
        $('#tab-' + tab + '').addClass('active').siblings('.frame-right').removeClass('active');
    });
</script>

<script type="text/javascript">
        seajs.config({
        base: "/statics/js/",
        preload: [
            "lib/jquery-1.8.0.min",
        ],
        map:[
            [ /^(.*\.(?:css|js))(.*)$/i,'$1$2']
        ]
    });
</script>
<script>
    $(document).ready(function() {
        FlowObj.showmyRequestList();
		FlowObj.showmyApproveList();
    });
</script>
<script type="application/javascript" src="/static/js/dms/jquery-confirm.min.js"></script>
</body>
</body>
</html>