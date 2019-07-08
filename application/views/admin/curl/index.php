<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
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
?>
<html lang="ch">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $this->lang->line('title');?></title>
    <meta itemprop="image" content="/images/ico.png?ver=<?php echo $version;?>" />
    <link href="/images/ico.png?ver=<?php echo $version;?>" rel="Shortcut Icon" type="image/x-icon">
    <link href="/images/ico.png?ver=<?php echo $version;?>" rel="icon" type="image/x-icon">
    <link href="/statics/style/common.css?ver=<?php echo $version;?>" rel="stylesheet"/>
    <link href="/statics/style/font-awesome/css/font-awesome.css?ver=<?php echo $version;?>" rel="stylesheet">
    <script src="/static/js/jquery.min.js?ver=<?php echo $version;?>"></script>
    <script src="/statics/js/lib/code_beautify.js"></script>
    <script src="/static/js/bootstrap.min.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap-treeview.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/action.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/toastr.js?ver=<?php echo $version;?>"></script>
    <script type="application/javascript" src="/static/js/dms/dmsList.js"/></script>
    <script type="application/javascript" src="/static/js/dms/curl.js"/></script>
    <script src="/static/js/bootstrap-table.min.js"></script>
    <script src="/static/js/bootstrap-table-zh-CN.min.js"></script>
    <link href="/static/layui/css/layui.css"  rel="stylesheet">
    <script src="/static/layui/layui.js"/></script>
    <link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/win10.css?ver=<?php echo $version;?>" id='link-theme-style'/>
<script>
layui.use(['layer', 'laydate'], function() {
            var layer = layui.layer;
            var laydate = layui.laydate;
            laydate.render({
                elem: '#deadline',
                value: new Date(new Date().setMonth(new Date().getMonth()+1)),
                type: 'datetime',
                btns: ['clear', 'confirm'],
                change: function(value, date){
                    $('#qxs').html(value);
               }
            });
        });
</script>
    <style>
    .frame-main{bottom:0}
    .list-type-header tr{font-size:12px;}
    #main-title,#listContent{font-size:12px;}
    #page-explorer{min-width: 1024px;}
    .table-bordered {border: 0 ;}
    .ui-state-default{padding-left:10px!important;}
    .file-continer{padding-top: 36px!important;}
    .list-type-header{display: table-header-group!important;width: 100%!important;position: fixed!important; margin-top: -36px!important;}
    .frame-main .hibtn > .btn, .frame-main .btn-group-de > .btn{padding: 5px 6px;}
    .bs-checkbox.ui-state-default{display: none}
    #home{padding:6px 10px; float: left; cursor:pointer}
    .ztree li span.button.switch:after{line-height: 25px;}
    .hibtn p{float: left;height: 28px; line-height: 28px;}
    .hibtn input.refName{ float: left; width: 200px; height: 28px; line-height: 28px; padding-left: 5px; border: 1px solid #ddd; color: #888; margin-right: 10px}
    </style>
</head>

<body style="overflow:hidden;">
<link href="/static/css/jquery-confirm.min.css"  rel="stylesheet">
<link href="/static/css/toastr.css"  rel="stylesheet">
<div class="full-background"></div>

<div class="frame-main" style="top:0">
<div class='frame-right' style="left:0">
<div class='frame-right-main'>
<div class="tools" style="height: 82px">
    <div class="tools-left tools-left-explorer ">
                    <!-- 文件功能 -->
                    <div class="kod-toolbar kod-toolbar-path fl-left">

                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">
                            <p>分享名称：</p><input class="refName" id="curlName" type="text" name="curlName">
                            <p>文档名称：</p><input class="refName" id="refName" type="text" name="refName" value="">
                        </div>
                        <div class="clear"></div>
                    </div>
    </div>
    <div style="clear:both"></div>    
    <div class="tools-left tools-left-explorer ">
                    <!-- 文件功能 -->
                    <div class="kod-toolbar kod-toolbar-path fl-left">

                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">
                             <button id="createCurl" class="context-menu-item trash btn btn-default">
                                <i class="font-icon icon-plus"></i><?php echo $this->lang->line('createCurl');?></button>
                        </div>
                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">     
                                <button id="cEnable" class="context-menu-item trash btn btn-default">
                                <i class="font-icon icon-archive"></i><?php echo $this->lang->line('cEnable');?></button> 
                        </div>
                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">     
                                <button id="cDisable" class="context-menu-item trash btn btn-default">
                                <i class="font-icon icon-trash"></i><?php echo $this->lang->line('cDisable');?></button> 
                        </div>

                        <div class="group-space-use fl-left hidden"></div>
            
                        <span class='msg fl-left'><?php echo $this->lang->line('loading');?>...</span>
                        <div class="clear"></div>
                    </div>
    </div>
    <div style="clear:both"></div>
</div>
</div>      
<div class='bodymain drag-upload-box menu-body-main' style="top:84px">

    <div id="rightContent" class="file-continer file-list-list">        
    <div id="centerDiv" class="tab-content">
        <!-- 组织文档模块 start-->
        <div role="tabpanel" class="tab-pane active" id="user">
        <div class="frame-right-main">

            <div class="data-div">

                    <div class="device-listStyle table-responsive" >
                        <table contenteditable="false" id="dmsListTable" data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex">
                            <thead id="main-title" class="list-type-header">
                            <tr>
                              <th class="ui-state-default" data-width="10px" data-checkbox="true" data-align="center" data-valign="middle"></th>
                              <th class="filename" data-field="name" data-align="left" data-valign="middle" data-formatter="dmsListObj.curlNameFormat">名称</th>
                              <th class="filesize" data-field="deadline" data-escape="true" data-align="left" data-formatter="dmsListObj.deadLine" data-valign="middle">截至日期</th>
                              <th class="filetype" data-field="status" data-escape="true" data-align="left" data-formatter="dmsListObj.cStatus" data-valign="middle">状态</th>
                              <th class="filetype" data-field="validatePwd" data-escape="true" data-align="left" data-formatter="dmsListObj.curlPwd" data-valign="middle">密码</th>
                              <th class="filetime" data-field="createdByName" data-align="left" data-valign="middle" >创建人</th>
                              <th class="filetime" data-field="createdDt" data-align="left" data-valign="middle" data-formatter="commobj.dateFormat">创建时间</th>
                              <th class="fileoperation" data-field="" data-align="left" data-valign="middle" data-formatter="dmsListObj.CoperAtionFormat"></th>
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
    <!--弹出窗口 分享 start-->
<div class="modal fade" id="shareDialog" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 1px solid #cccccc;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('share')?></h4>
            </div>
            <div id="shareDialogContainer" class="container-fluid" >
                <input type="hidden" id="curlDocId">
                <input type="hidden" id="curlRevId">

                <ul id="shareType" class="nav nav-tabs">
                    <li class="active" share-type="outShare">
                        <a href="#outShare" data-toggle="tab"><?php echo $this->lang->line('outShare')?></a>
                    </li>
                    <!--<li style="margin-left: 10px" share-type="innerShare">
                        <a href="#innerShare" data-toggle="tab"><?php echo $this->lang->line('innerShare')?></a>
                    </li>-->
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="outShare">
                        <table style="margin-top: 10px;">
                            <tbody>
                            <tr style="height: 36px">
                                <td>
                                    <span>    <?php echo $this->lang->line('curlRevName')?></span>
                                </td>
                                <td>
                                    <input name="curlRevName" type="text" id="curlRevName">
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td>
                                    <input type="checkbox" name="deadlineBox" id="deadlineBox" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Validity')?></span>
                                </td>
                                <td>
                                    <input name="deadline" type="text" id="deadline" disabled>
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td>
                                    <input type="checkbox" name="limitDownload" id="limitDownload" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Allow_download')?></span>
                                </td>
                                <td>
                                    <input name="downloadLimit" id="downloadLimit" type="text" value="0" style="width: 60px" disabled oninput="checkedThis()"><span> <?php echo $this->lang->line('DW')?></span>
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td>
                                    <input type="checkbox" name="allowPrint" id="allowPrint" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Allow_printing')?></span>
                                </td>
                                <td>
                                    <input name="printLimit" id="printLimit" type="text" value="0" style="width: 60px" disabled oninput="checkedThis()"><span> <?php echo $this->lang->line('DW')?></span>
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td>
                                    <input type="checkbox" name="allowUpload" id="allowUpload" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Allow_Upload')?></span>
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td>
                                    <input type="checkbox" name="createPwd" id="createPwd" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('G_passwords')?></span>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="innerShare">
                        <table style="margin-top: 10px;">
                            <tr style="height: 36px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('operation')?>:</span>
                                </td>
                                <td style="text-align: left">
                                    <label><input type="radio" value="1" name="operation_innerShare" class="a-radio" checked><span class="b-radio"></span><?php echo $this->lang->line('Just_download')?></label>
                                    <label><input type="radio" value="2" name="operation_innerShare" class="a-radio" style="margin-left: 10px;"><span class="b-radio"></span><?php echo $this->lang->line('online_view')?></label>
                                    <label><input type="radio" value="3" name="operation_innerShare" class="a-radio" style="margin-left: 10px;"><span class="b-radio"></span><?php echo $this->lang->line('online_edit')?></label>
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('impower')?>:</span>
                                </td>
                                <td>
                                    <input type="hidden" id="curlUserIds" name="curlUser" >
                                    <input type="text" id="curlUserNames" name="curlUser" disabled>
                                    <div style="float: right;padding-left: 8px;">
                                        <span onclick="curlObj.showCurlUser()" style="font-size: 22px;cursor: pointer;" class=" btn-right-radius">
                                            <i class="font-icon icon-search"></i>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('download')?>:</span>
                                </td>
                                <td>
                                    <input type="text" value="-1" name="downloadLimit" style="width: 40px">
                                    <span style="margin-left: 10px"><?php echo $this->lang->line('downloadLimit')?></span>
                                </td>
                            </tr>
                            <tr style="height: 36px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('print')?>:</span>
                                </td>
                                <td>
                                    <input type="text" value="-1" name="printLimit" style="width: 40px">
                                    <span style="margin-left: 10px"><?php echo $this->lang->line('printLimit')?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="curlObjListBox" style="overflow: hidden;">
                   <!-- <p class="red">选择文档或者文件夹 <a class="btn btn-default btn-right-radius" id="goto-father" title="上层" style="position: relative; display: none">
                        <i class="font-icon icon-circle-arrow-up"></i>
                    </a></p> -->
                   <div id="yarnball"><a id="home"><i class="font-icon icon-home"></i></a><ul class="yarnball"></ul></div>
                   <table contenteditable="false" id="curlObjList" class="table table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                    <thead id="main-title">
                        <th class="bs-checkboxs ui-state-default" data-checkbox="true" data-align="left" data-valign="middle"></th>
                        <th class="filename" data-field="name" data-escape="true" data-align="left" data-valign="middle" data-formatter="dmsListObj.curlNameFormatlist"><?php echo $this->lang->line('name')?></th>
                    </thead>
                    <tbody id="listContent" class="file-list-list">
                    </tbody>
                </table>
                </div>
                <div id="curlTips">
                   (创建文档链接，有效期限为永久，不允许下载，不需要访问密码。)
                </div>
                <div id="curlResultDiv" style="display: none">
                    <table style="margin-top: 20px">
                        <tr>
                            <td valign="top" style="width: 100px"><span><?php echo $this->lang->line('Share_links')?>:</span></td>
                            <td><textarea id="curlResult"></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="dmsListObj.refresh()" type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('closeMode')?></button>
                <button onclick="curlObj.createCurl()" type="button" class="btn btn-xs btn-xs btn-green" ><?php echo $this->lang->line('The_link')?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 分享 end-->
<!--弹出窗口 <?php echo $this->lang->line('operation')?>日志 start -->
<div class="modal fade" id="showCurlLog" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 10px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('operation_log')?></h4>
            </div>
            <div >
                <div class="container-fluid">
                    <table contenteditable="false" id="curlLogTab" data-select-item-name="btSelectItem"  data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                        <thead>
                        <tr>
                            <th class="ui-state-default" data-field="logType" data-align="center" data-valign="middle" ><?php echo $this->lang->line('operation_type')?></th>
                            <th class="ui-state-default" data-field="createdByName" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('Username')?></th>
                            <th class="ui-state-default" data-field="createdDt" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('operation_time')?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('closeMode')?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 <?php echo $this->lang->line('operation')?>日志 end -->
<div class="zDialog"></div>
<div class="artDialog">
    <div class="proTab bcd dialogShow" id="loadMore">
        <div class="tab-head bcd">
            <i class="font-icon icon-info"></i><span ><?php echo $this->lang->line('curlFList')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="loadMoreContent" class="tab-content">
        </div>
    </div>
    <!--<div class="proTab bc7 dialogShow" id="log">
        <div class="tab-head bc7">
                <i class="font-icon icon-globe"></i><span ><?php echo $this->lang->line('log')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="logContent" class="tab-content"></div>
    </div>-->  
</div>

</div>
</div>
</div>
<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script> 
<script type="text/javascript" src="/admin/g/commonjs"></script>

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
<script type="text/javascript">
    $("#home").click(function() {
            dmsListObj.gotoFather();
    });    
    $("#createCurl").click(function(){
            dmsListObj.createCurl();
        });
    $("#goto-father").click(function(){
            dmsListObj.gotoFather();
        });
    $("#cEnable").click(function(){
            dmsListObj.cEnable();
        });
    $("#cDisable").click(function(){
            dmsListObj.cDisable();
        });
    $(document).ready(function(){
        var params = {};
        var row = dmsListObj.getSNode();
        console.log(row);
        if(row.length > 0){
            var refId = row[0].id;
            var refName = row[0].name;
            params.refId = refId;
            params.refName = refName;
            $("#refName").val(refName);
        }
        commobj.list("dmsListTable",G.paths+"curl/clist", params, true, dmsListObj.NClocked, dmsListObj.openCurl);
    });
    $('.layui-layer-close').on('click', function() {
    $(".zDialog").hide();
    $(".artDialog").hide();
    $(".artDialog .proTab").hide();
        $("#loadMoreContent").empty();
        $("#loading").css("display", "");
});
</script>
<script type="application/javascript" src="/static/js/dms/jquery-confirm.min.js"></script>
<?php echo '<script type="application/javascript" src="'.$docHost.'/pageoffice.js" id="po_js_main"></script>'; ?>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){

    var curlName = $("#curlName");
    var refName = $("#refName");
        if(curlName) {
            curlName.on('input',function(e){
                var cName = curlName.val();
                var rName = refName.val();
                var params = {};
                params.name = cName;
                params.refName = rName;
                commobj.list("dmsListTable",G.paths+"curl/clist", params, true);
            });
            refName.on('input',function(e){
                var cName = curlName.val();
                var rName = refName.val();
                var params = {};
                params.name = cName;
                params.refName = rName;
                commobj.list("dmsListTable",G.paths+"curl/clist", params, true);
            });
        }
    });
    function checkedThis(){
    var qxt,dxt,pwt,aut,dyt;
    if($('#deadlineBox').get(0).checked){
        $('#deadline').get(0).disabled=false;
        var qxs = $('#deadline').val();
        qxt = '有效期至<span id="qxs">' + qxs +'</span>';
        }else{
        $('#deadline').get(0).disabled=true;
        qxt = '有效期限为永久'
        }
    if($('#limitDownload').get(0).checked){
        $('#downloadLimit').get(0).disabled=false;
        var dxs = $('#downloadLimit').val()?$('#downloadLimit').val():0;
        dxt = '下载次数 <span id="dxs">'+ dxs +'</span> 次'
        }else{
        $('#downloadLimit').get(0).disabled=true;
        dxt = '不允许下载'
        }
    if($('#allowPrint').get(0).checked){
        $('#printLimit').get(0).disabled=false;
        var dys = $('#printLimit').val()?$('#printLimit').val():0;
        dyt = '打印次数 <span id="dys">'+ dys +'</span> 次'
        }else{
        $('#printLimit').get(0).disabled=true;
        dyt = '不允许打印'
        }        
    if($('#allowUpload').get(0).checked){
        aut = '允许上传，'
    }else{
        aut = ''
    }
    if($('#createPwd').get(0).checked){
        pwt = '需要访问密码'
    }else{
        pwt = '不需要访问密码'
    }
    $("#curlTips").empty();
    $("#curlTips").append('(创建文档链接，'+ qxt +'，'+ dxt +'，'+ dyt +'，'+ aut + pwt +'。)');
}
</script>>