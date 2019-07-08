<?php
if (!isset($this->session->sessionId)) {
    header('Location: /');
    exit;
} else {
    $this->config->load('api');
    $version = $this->config->item('version');
    $langs = $this->config->item('langs');
    $lang = $this->session->lang;
    $this->lang->load('main', $lang);
    $lang = $this->session->lang;
    $this->lang->load('main', $lang);
    $this->config->load('api');
    $api_host = $this->config->item('api_host');
    $api_port = $this->config->item('api_port');
    $doc_port = $this->config->item('doc_port');
    $apiHost = $api_host . ":" . $api_port;
    $docHost = $api_host . ":" . $doc_port;
}
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
    <script src="/static/js/bootstrap.min.js"></script>
    <script src="/static/js/contextMenu/jquery-contextMenu.js"></script>
    <script src="/static/js/dms/action.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/toastr.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap-table.min.js"></script>
    <script src="/static/js/bootstrap-table-zh-CN.min.js"></script>
    <link href="/static/layui/css/layui.css"  rel="stylesheet">
    <script src="/static/layui/layui.js"/></script>
    <script type="application/javascript" src="/static/js/dms/dmsList.js"/></script>
    <script src="/static/js/dms/Recycle.js?ver=<?php echo $version;?>"></script>
    <link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/win10.css?ver=<?php echo $version;?>" id='link-theme-style'/>
    <script src="/static/js/autocomplete.js"></script>
    <style id="header-resize-width" type="text/css"></style>
    <style>
    .frame-main .frame-right{left:0}
    .list-type-header tr{font-size:12px;}
    #main-title,#listContent{font-size:12px;}
    #page-explorer{min-width: 1024px;}
    .table-bordered {border: 0 ;}
    .ui-state-default{padding-left:10px!important;}
    .file-continer{padding-top: 36px!important;}
    .frame-main .hibtn > .btn, .frame-main .btn-group-de > .btn{padding: 5px 6px;}
    </style>
</head>

<body style="overflow:hidden;">
<link href="/static/css/jquery-confirm.min.css"  rel="stylesheet">
<link href="/static/css/toastr.css"  rel="stylesheet">
<div class="full-background"></div>

<div class="frame-main" style="top:0">
<div class='frame-right'>
<div class='frame-right-main'>
<div class="tools">

                <div class="tools-left tools-left-explorer ">
                    <!-- 文件功能 -->
                    <div class="kod-toolbar kod-toolbar-path fl-left">

                        <div class="hibtn select-button-show btn-group fl-left mr-10 ">
                             <button  class="context-menu-item trash btn btn-default" onclick="RecycleObj.Rclean()">
                                <i class="font-icon icon-trash"></i><?php echo $this->lang->line('Empty_Trash');?></button>
                             <button class="context-menu-item retweet btn btn-default"  onclick="RecycleObj.Deletion()">
                                <i class="font-icon icon-retweet"></i><?php echo $this->lang->line('Batch_deletion');?></button>
                             <button class="context-menu-item reply btn btn-default"  onclick="RecycleObj.reDuction()">
                                <i class="font-icon icon-reply"></i><?php echo $this->lang->line('Batch_reduction');?></button>   
                        </div>

                        <div class="group-space-use fl-left hidden"></div>
            
                        <span class='msg fl-left'><?php echo $this->lang->line('loading');?>...</span>
                        <div class="clear"></div>
                    </div>
                </div>
    <div class="tools-right">
<div class="frame-header">
            <div class="header-content">    
                <div class='header-right' id='search-form'>
                </div>
            </div>
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
                        <table contenteditable="false" id="dmsListTable" data-click-to-select="true" class="resizable-table table table-striped table-bordered table-hover table-condensed footable tablex">
                            <thead id="main-title" class="list-type-header">
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
    <div id="x-auto" class=" x-component"></div>
    <div id="w-auto" class=" w-component"></div>
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
<script>
    $(document).ready(function() {
        //window.onerror=function(){return true;}
        var keyWord = '<?php echo $this->input->get('keyWord');?>';
        var proposals = ['百度1', '百度2', '百度3', '百度4', '百度5', '百度6', '百度7','呵呵呵呵呵呵呵','百度','新浪','a1','a2','a3','a4','b1','b2','b3','b4'];
        $('#search-form').autocomplete({
            defVal:keyWord,
            hints: proposals,
            width: 200,
            height: 28,
            showButton: true,
            onSubmit: function(text){
                RecycleObj.showRecycle(text);
            }
        });
        RecycleObj.showRecycle(keyWord);
    });
</script>

<script type="application/javascript" src="/static/js/dms/jquery-confirm.min.js"></script>
</body>
</body>
</html>