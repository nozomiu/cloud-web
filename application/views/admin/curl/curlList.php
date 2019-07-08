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
    <script type="application/javascript" src="/static/js/dms/curlList.js"/></script>
    <script src="/static/js/bootstrap-table.min.js"></script>
    <script src="/static/js/bootstrap-table-zh-CN.min.js"></script>
    <link href="/static/layui/css/layui.css"  rel="stylesheet">
    <script src="/static/layui/layui.js"/></script>
    <link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/win10.css?ver=<?php echo $version;?>" id='link-theme-style'/>
    <style id="header-resize-width" type="text/css"></style>
<script>
layui.use(['layer'], function(){
  var layer = layui.layer;
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
    .ztree li span.button.switch:after{line-height: 25px;}
    .font-icon.icon-home, .x-tree-self{    display: inline-block;
    background-image: url(/statics/images/common/menu_icon.png);
    width: 9px !important;
    background-position: -15px -703px;
    background-size: auto !important;
    background-repeat: no-repeat;
    height: 16px;
    margin-right: 5px !important;}
    #main-title .filename, #listContent .filename{width:600px;}
    </style>
</head>

<body style="overflow:hidden;">
<link href="/static/css/jquery-confirm.min.css"  rel="stylesheet">
<link href="/static/css/toastr.css"  rel="stylesheet">
<div class="full-background"></div>

<div class="frame-main" style="top:0">
    <div class='frame-left' id="frame-left">
        <ul id="accordion" class="ztree" role="tablist" aria-multiselectable="true" >
           <li class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h3 class="panel-title"> <a id="curlListT" class="leftAccordion collapsed"><span id="folder-list-tree_2_switch" title="" class="button level0 switch " treenode_switch=""></span>
    <span id="folder-list-tree_2_my_ico" class="tree_icon button">
      <i class="x-item-file x-tree-self small"></i>
    </span><span id="folder-list-tree_2_span"><?php echo $this->lang->line('curlList');?></span></a></h3>
                </div>
                <div id="collapseOne" class="panel-collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul id="curlList" init="1" class="tableUl menuNav level0"></ul>
                    </div>
                </div>
            </li>
        </ul>
    </div><!-- / frame-left end-->
<div class='frame-right'>
<div class='frame-right-main'>
<div class="tools">
    <div class="tools-left tools-left-explorer ">
                    <!-- 文件功能 -->
                    <div class="kod-toolbar kod-toolbar-path fl-left">
                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">
                             <button id="curlUpload" class="context-menu-item trash btn btn-default">
                                <i class="font-icon icon-cloud-uploads"></i><?php echo $this->lang->line('Upload_document');?></button>
                                </div>
                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">
                             <button id="curlDownload" class="context-menu-item trash btn btn-default">
                                <i class="font-icon icon-download-alt"></i><?php echo $this->lang->line('download');?></button>
                                </div>
                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">     
                                <button id="curlView" class="context-menu-item trash btn btn-default">
                                <i class="font-icon icon-eye-open"></i><?php echo $this->lang->line('preview');?></button> 
                        </div>

                        <div class="group-space-use fl-left hidden"></div>
            
                        <span class='msg fl-left'><?php echo $this->lang->line('loading');?>...</span>
                        <div class="clear"></div>
                    </div>
                </div>
    <div style="clear:both"></div>
</div>
</div>      
<div class='bodymain drag-upload-box menu-body-main' style="top:45px">

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
                              <th class="ui-state-default" data-width="10px" data-radio="true" data-align="center" data-valign="middle"></th>
                              <th class="filename" data-field="refName" data-align="left" data-valign="middle" data-formatter="dmsNameFormat">名称</th>
                              <!--<th class="filesize" data-field="updatedByName" data-escape="true" data-align="left" data-valign="middle">修改人</th>
                              <th class="filetime" data-field="updatedDt"  data-align="left" data-valign="middle" data-formatter="commobj.dateFormat">修改时间</th>-->
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
    <div id="uploadFileFormDiv">
    <form id="uploadFileForm" method="post" enctype="multipart/form-data">
        <input type="hidden" id="upLimitSize">
        <input type="hidden" id="uploadUrl">
        <input type="hidden" id="uploadFldId">
        <input type="file" id="uploadFile" name="files" style="display: none" multiple="multiple"
               onchange="docUploadObj.onFileChange(this,'upload')" />
    </form>
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
    var cacheId = '<?php echo $this->input->get('cid');?>';
    var sessionid = '<?php echo $this->input->get('sessionid');?>';
    $(document).ready(function(){
        var params={};
        params.cid=cacheId;
        params.sessionid=sessionid;
        curlTreeObj.curlTree(cacheId,sessionid);
        $("#curlUpload").click(function(){
            docUploadObj.showCUpload(curlTreeObj.refId)
        });
        $("#curlDownload").click(function(){
            var rows = $("#dmsListTable").bootstrapTable("getSelections");
            if(rows.length <= 0) {
                commobj.showToast("请先选择文档",2);
                return;
            }
            var objId = rows[0].refId;

            commobj.doGet(G.paths+"curl/preDownload?cid="+cacheId+"&refId="+objId+'&sessionid='+sessionid, false, function (result) {
                if(result.code==200) {
                    var curlDetail = result.data;
                    var downloadUrl = curlDetail.downloadUrl;
                    window.open(downloadUrl);
                }else if(result.code==501) {
                    commobj.showToast(LNG.Not_logged_in,2);
                }else {
                    var msg = result.message;
                    if(msg) {
                        commobj.showToast(msg,2);
                    }else {
                        commobj.showToast(LNG.system_error,3);
                    }
                    return;
                }
            });
        });

        $("#curlView").click(function(){
            viewDoc();
        });
    });

    function viewDoc() {
        var rows = $("#dmsListTable").bootstrapTable("getSelections");
        if(rows.length <= 0) {
            commobj.showToast("请先选择文档",2);
            return;
        }
        var objId = rows[0].refId;
        window.open(G.paths+"curl/curlView?cid="+cacheId+"&refId="+objId+'&sessionid='+sessionid);
    }
    function dmsNameFormat(value,row,index)  {
        var objType = row.refType;
        var objId = row.id;
        var refName = row.refName;
        var canDownload = row.canDownload;
        var canEdit = row.canEdit;
        var canView = row.canView;
        var name = "";
        if (objType == 31) {
            name = '<span class="ico ico-bookfolder" filetype="bookfolder"></span>';
        } else if (objType == 32) {
            name = '<span class="ico ico-folder" filetype="folder"></span>';
        } else if (objType == 33) {
            name = '<span class="ico ico-' + (GetExtName(value)) + '" filetype="txt"></span>';
        }
        return name + value;
    }
    
    function GetExtName(fileName) {
    var extArr = fileName.split(".");
    var exts = ['folder', 'folder-unempty', 'sql', 'c', 'cpp', 'cs', 'flv', 'css', 'js', 'htm', 'html', 'java', 'log', 'mht', 'php', 'url', 'xml', 'ai', 'bmp', 'cdr', 'gif', 'ico', 'jpeg', 'jpg', 'JPG', 'png', 'psd', 'webp', 'ape', 'avi', 'flv', 'mkv', 'mov', 'mp3', 'mp4', 'mpeg', 'mpg', 'rm', 'rmvb', 'swf', 'wav', 'webm', 'wma', 'wmv', 'rtf', 'docx', 'fdf', 'potm', 'pptx', 'txt', 'xlsb', 'xlsx', '7z', 'cab', 'iso', 'rar', 'zip', 'gz', 'bt', 'file', 'apk', 'bookfolder', 'folder', 'folder-empty', 'folder-unempty', 'fromchromefolder', 'documentfolder', 'fromphonefolder', 'mix', 'musicfolder', 'picturefolder', 'videofolder', 'sefolder', 'access', 'mdb', 'accdb', 'sql', 'c', 'cpp', 'cs', 'js', 'fla', 'flv', 'htm', 'html', 'java', 'log', 'mht', 'php', 'url', 'xml', 'ai', 'bmp', 'cdr', 'gif', 'ico', 'jpeg', 'jpg', 'JPG', 'png', 'psd', 'webp', 'ape', 'avi', 'flv', 'mkv', 'mov', 'mp3', 'mp4', 'mpeg', 'mpg', 'rm', 'rmvb', 'swf', 'wav', 'webm', 'wma', 'wmv', 'doc', 'docm', 'dotx', 'dotm', 'dot', 'rtf', 'docx', 'pdf', 'fdf', 'ppt', 'pptm', 'pot', 'potm', 'pptx', 'txt', 'xls', 'csv', 'xlsm', 'xlsb', 'xlsx', '7z', 'gz', 'cab', 'iso', 'rar', 'zip', 'bt', 'file', 'apk', 'css'];
    var extLastName = extArr[extArr.length - 1];
    for (var i = 0; i < exts.length; i++) {
        if (exts[i] == extLastName) {
            return exts[i]
        }
    }
    return 'file'
}

    function onSelectDms(row) {

    }

    function onDblClickDms(row) {
        var objType = row.refType;
        if(objType == 32) {
            var params = {};
            params.refId = row.refId;
            params.cid = cacheId;
            params.sessionid=sessionid;
            commobj.list("dmsListTable",G.paths+"curl/openFolder", params, true, onSelectDms, onDblClickDms);
        }else if(objType == 33) {
            viewDoc();
        }
    }

    function openFolder(objId) {

    }
</script>
<script type="application/javascript" src="/static/js/dms/jquery-confirm.min.js"></script>
<script type="application/javascript" src="/static/js/dms/docUpload.js"/></script>
<?php echo '<script type="application/javascript" src="'.$docHost.'/pageoffice.js" id="po_js_main"></script>';?>
</body>
</html>