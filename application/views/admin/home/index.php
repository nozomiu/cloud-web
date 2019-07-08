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
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="description" itemprop="description" content="">
    <meta name="keywords" content="" />
    <meta itemprop="image" content="/images/ico.png?ver=<?php echo $version;?>" />
    <link href="/images/ico.png?ver=<?php echo $version;?>" rel="Shortcut Icon" type="image/x-icon">
    <link href="/images/ico.png?ver=<?php echo $version;?>" rel="icon" type="image/x-icon">
    <link href="/statics/style/common.css?ver=<?php echo $version;?>" rel="stylesheet"/>
    <link href="/statics/style/font-awesome/css/font-awesome.css?ver=<?php echo $version;?>" rel="stylesheet">
    <script src="/static/js/jquery.min.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap.min.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap-treeview.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/action.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/toastr.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/myTree.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/orgTree.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/sysTree.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/Favorite.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/orgSpace.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap-table.min.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap-table-zh-CN.min.js?ver=<?php echo $version;?>"></script>
    <link href="/static/layui/css/layui.css?ver=<?php echo $version;?>" rel="stylesheet">
    <script src="/static/layui/layui.js?ver=<?php echo $version;?>"/></script>
    <script src="/static/js/layout.js?ver=<?php echo $version;?>"/></script>
    <!--[if IE 7]>
    <link rel="stylesheet" href="/statics/style/font-awesome/css/font-awesome-ie7.css?ver=<?php echo $version;?>">
    <![endif]--> 
    <title><?php echo $this->lang->line('title');?></title>
    <link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/win10.css?ver=<?php echo $version;?>" id='link-theme-style'/>
    <style id="header-resize-width" type="text/css"></style>
</head>
<body style="overflow:hidden;" id="page-explorer">
<input type="hidden" id="openType" value="">
<input type="hidden" id="searchType" value="">
<input type="hidden" id="moduleType" value="">
<input type="hidden" id="doubleClick" value="">
<input type="hidden" id="viewType" value="">
<input type="hidden" id="editType" value="">
<input type="hidden" id="windowType" value="">
<div class="full-background"></div>
<div class="topbar aero">
    <div class="content">
        <button class="btn btn-wap-menu hidden"
            data-toggle="collapse" data-target="#top-menu-left" 
        ><i class="font-icon icon-reorder"></i></button>

        <div class="top-left collapse" id="top-menu-left">
            <a href="#" class="topbar-menu title"><img src="/images/logo.png"></a>
            <a class="topbar-menu this" href="/admin/home" target="_self" draggable="false"><i class="x-item-file x-group-self-owner small"></i><span><?php echo $this->lang->line('title');?></span></a>
                    </div>
        <div class="top-right">
            <?php 
if ($langs) {
    ?>
            <!--<div class="menu-group">
                <a id='topbar-language' data-toggle="dropdown" href="#" class="topbar-menu">
                <i class='font-icon icon-flag'></i>&nbsp;<b class="caret"></b>
                </a>
                <ul class="dropdown-menu topbar-language pull-right animated menuShow" role="menu" aria-labelledby="topbar-language">
                    <?php 
    $tpl = "";
    foreach ($langs as $key => $value) {
        $name = $value[0];
        //$select = I18n::getType() == $key ? "this":"";
        $tpl .= "<li><a href='javascript.language(\"{$key}\");' title=\"{$key}/{$value[1]}/{$value[2]}\" class=''><i class='lang-flag flag-{$key}'></i>{$name}</a></li>";
    }
    echo $tpl;
    ?>
                </ul>
            </div>-->
            <?php 
}
?>
            
            <div class="menu-group">
                <a href="#" id='topbar-user' data-toggle="dropdown" class="topbar-menu">
                    <i class="font-icon icon-user"></i>
                    <span id="fullName"></span>&nbsp;<span id="currentOrgSpan"></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu menu-topbar-user pull-right animated menuShow" role="menu" aria-labelledby="topbar-user">
                    <li class="menu-system-user"><a href="#" onclick="orgSpaceObj.changePwd()"><i class="font-icon icon-user"></i><?php echo $this->lang->line('changePwd');?></a></li>
                    <li class="menu-system-user"><a id="info" style="cursor:pointer"><i class="font-icon icon-cog"></i><?php echo $this->lang->line('Configure');?></a></li>
                    <li class="menu-system-theme"><a href="#" onclick="orgSpaceObj.showOrgSpaceList();"><i class="font-icon icon-dashboard"></i><?php echo $this->lang->line('Switch_group');?></a></li>
                    <li role="presentation" class="divider"></li>
                    <li class="menu-system-logout"><a id="signout" style="cursor:pointer"><i class="font-icon icon-signout"></i><?php echo $this->lang->line('signout');?></a></li>
                </ul>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
</div>
    <div class="frame-main" id="frame-main">
    <div class='frame-left' id="frame-left">
        <ul id="accordion" class="ztree" role="tablist" aria-multiselectable="true" >
           <li class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h3 class="panel-title"> <a id="myDocAccordion" class="leftAccordion collapsed" module-type="2" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" right-href="doc/index" aria-expanded="true" aria-controls="collapseOne"><span id="folder-list-tree_2_switch" title="" class="button level0 switch " treenode_switch=""></span>
    <span id="folder-list-tree_2_my_ico" class="tree_icon button">
      <i class="x-item-file x-tree-self small"></i>
    </span><span id="folder-list-tree_2_span"><?php echo $this->lang->line('My_document');?></span></a></h3>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul id="myDocumentTree" init="0" class="tableUl menuNav level0"></ul>
                    </div>
                </div>
            </li>
            <li class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h3 class="panel-title"> <a id="orgDocAccordion" class="leftAccordion collapsed" module-type="3" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" right-href="orgdoc/index" aria-expanded="false" aria-controls="collapseTwo"><span id="folder-list-tree_3_switch" title="" class="button level0 switch " treenode_switch=""></span>
    <span id="folder-list-tree_3_my_ico" class="tree_icon button">
      <i class="x-item-file x-group-public small"></i>
    </span><span id="folder-list-tree_3_span"><?php echo $this->lang->line('Organize_documents');?></span></a></h3>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <ul id="orgDocumentTree" init="0" class="tableUl menuNav level0"></ul>
                    </div>
                </div>
            </li>
            <li class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h3 class="panel-title"> <a id="sysDocAccordion" class="leftAccordion collapsed" module-type="4" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" right-href="sysdoc/index" aria-expanded="false" aria-controls="collapseThree"><span id="folder-list-tree_4_switch" title="" class="button level0 switch " treenode_switch=""></span>
    <span id="folder-list-tree_4_my_ico" class="tree_icon button">
      <i class="x-item-file x-group-self-root small"></i>
    </span><span id="folder-list-tree_4_span"><?php echo $this->lang->line('System_documents');?></span></a></h3>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <ul id="sysDocumentTree" init="0" class="tableUl menuNav level0"></ul>
                    </div>
                </div>
            </li>            
        </ul>
    <div class="bottom-box">
            <div class="box-content">
                <div class="cell menu-recycle-button" style="position: relative;"><a id="Recycle" class="Recycle" title="<?php echo $this->lang->line('Recycle');?>" style="cursor:pointer"><i class="font-icon icon-trash"></i><!--<span><?php echo $this->lang->line('Recycle');?></span>--></a></div>
                <div class="cell menu-recycle-button" style="position: relative;"><a id="Favorite" class="Favorite" title="<?php echo $this->lang->line('Favorite');?>" style="cursor:pointer"><i class="font-icon icon-star"></i><!--<span><?php echo $this->lang->line('Favorite');?></span>--></a></div>
                <div class="cell menu-recycle-button" style="position: relative;"><a id="curlManage" class="curlManage" title="<?php echo $this->lang->line('Favorite');?>" style="cursor:pointer"><i class="font-icon icon-share"></i><!--<span><?php echo $this->lang->line('Favorite');?></span>--></a></div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div><!-- / frame-left end-->
    
    <div class='frame-resize' id="frame-resize"></div>
    <div class='frame-right' id="frame-right">
                <div id="rightContent" class="file-continer file-list-list">
                    <div id="centerDiv" class="tab-content" >
                      
                    </div>

                </div>  
                <div class="file-continer-more"></div>

        </div>
    </div><!-- / frame-right end-->
</div><!-- / frame-main end-->
<div class="modal fade" id="orgList" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document" style="width: 420px;">
        <div class="modal-content" style="border: 1px solid #cccccc;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Organize_space_list');?></h4>
            </div>
            <div >
                <div class="container-fluid" style="margin:0 12px;">
                    <table contenteditable="false" id="orgListTable" data-select-item-name="btSelectItem"  data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                        <thead>
                        <tr>
                            <th class="ui-state-default" data-radio="true" data-align="center" data-valign="middle"></th>
                            <th class="ui-state-default" data-field="name" data-align="center" data-valign="middle" ><?php echo $this->lang->line('Organization_name');?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeMode" data-dismiss="modal"><?php echo $this->lang->line('closeMode');?></button>
                <button type="button" class="btn btn-xs btn-xs btn-green" onclick="orgSpaceObj.changeCurrentSpace()"><?php echo $this->lang->line('changeCurrentSpace');?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 修改密码 start-->
<div class="modal fade" id="changePwd" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 1px solid #cccccc;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('changePwd');?></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal">
                        <input type="hidden" id="fldId">
                        <input type="hidden" id="fldPrtId">
                        <div class="form-group ">
                            <label for="oldPwd" class="col-xs-2 control-label"><?php echo $this->lang->line('oldPwd');?>：</label>
                            <div class="col-xs-8 ">
                                <input type="text" class="form-control input-sm duiqi" name="oldPwd" id="oldPwd" maxlength="20" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newPwd" class="col-xs-2 control-label"><?php echo $this->lang->line('newPwd');?>：</label>
                            <div class="col-xs-8 ">
                                <input type="password" class="form-control input-sm duiqi" name="newPwd" id="newPwd" maxlength="20" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="RnewPwd" class="col-xs-2 control-label"><?php echo $this->lang->line('RnewPwd');?>：</label>
                            <div class="col-xs-8 ">
                                <input type="password" class="form-control input-sm duiqi" name="RnewPwd" id="RnewPwd" maxlength="20" placeholder="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
                <button type="button" class="btn btn-xs btn-xs btn-green" onclick="orgSpaceObj.changePwdbutton()"><?php echo $this->lang->line('save');?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 修改密码 end-->
<!--<div class="common-footer aero">
<span class="copyright-content">Powered by <?php echo $this->lang->line('MName');?> <?php echo $version;?> | Copyright © <a href="" target="_blank"><?php echo $_SERVER['SERVER_NAME'];?></a>.<a href="javascript:copyright();" class="icon-info-sign copyright-bottom pl-5"></a>&nbsp;&nbsp;  </span></div>-->

<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script>
<script type="text/javascript" src="/admin/g/commonjs"></script>

<script>
    $(document).ready(function() {
    window.onerror=function(){return true;}
    var curModuleType = '';
    commobj.doGet(G.paths+'cession/scurrent', false, function(result) {
        if (result.code == 200) {
            var session = result.data;
            curModuleType = session.moduleType;
            var fullName = session.fullName;
            var orgName = session.orgName;
            var searchType = session.searchType;
            var doubleClick = session.doubleClick;
            var viewType = session.viewType;
            var editType = session.editType;
            var windowType = session.windowType;
            $("#searchType").val(searchType);
            $("#doubleClick").val(doubleClick);
            $("#viewType").val(viewType);
            $("#editType").val(editType);
            $("#windowType").val(windowType);

            if (orgName) {
                //$(".orgSpace").css("display","block");
                $("#currentOrgSpan").html(orgName);
            }
        } else {
            window.location.href = G.paths+"home/logout";
        }
    });
    //console.log('curModuleType :' + curModuleType);
    $(".leftAccordion").click(function() {
        $(".context-menu-list").css("display","none");
        var item = $(this);
        if (item.hasClass('collapsed')) {
            var moduleType = item.attr("module-type");
            var params = {}
            params.moduleType = moduleType;
            $("#moduleType").val(moduleType);
            commobj.doPost(G.paths+'cession/changeModule', params, false, function(result) {
                if (result.code != 200) {
                    if(result.code == 501) {
                        window.location.href = G.paths+"home/logout";
                    }else{
                    var msg = result.message;
                    if (msg) {
                        commobj.showToast(msg, 2);
                    } else {
                        commobj.showToast(LNG.system_error, 3);
                    }
                }
                }
            });

            var href = item.attr("right-href");
            commobj.getAjaxHtml(href, "#centerDiv", function() {});
            if (moduleType == 2) {
                //个人空间
                myDocumentTreeObj.initMyDocTree();
                var tree = $('#myDocumentTree');
            } else if (moduleType == 3) {
                //组织空间
                orgDocumentTreeObj.initOrgDocTree();
                var tree = $('#orgDocumentTree');
            }else if (moduleType == 4) {
                //组织空间
                sysTreeObj.initOrgDocTree();
                var tree = $('#sysDocumentTree');
            }
        }
    });
    $("#signout").click(function() {
            var params = {}
            commobj.doPost(G.paths+'home/jsonLogout', params, false, function(result) {
                if (result.code == 200) {
                    window.location.href = G.paths+"home/logout";
                }
            });
    });
    $("#info").click(function() {
        layer.closeAll();
        layer.open({
            type: 2,
            title: '<i class="font-icon icon-cog"></i>'+LNG.Configure,
            shadeClose: true,
            shade: 0.2,
            area: ['760px', '400px'],
            content: '/admin/Setting/'
        });
    });
    $(".Recycle").click(function() {
        layer.closeAll();
        layer.open({
            type: 2,
            title: '<i class="font-icon icon-trash"></i>'+LNG.Recycle,
            shadeClose: true,
            shade: 0.2,
            area: ['92%', '92%'],
            content: '/admin/Recycle/'
        });
    });
    $(".Favorite").click(function() {
        layer.closeAll();
        layer.open({
            type: 2,
            title: '<i class="font-icon icon-star"></i>'+LNG.Favorite,
            shadeClose: true,
            shade: 0.2,
            area: ['92%', '92%'],
            content: '/admin/Favorite/'
        });
    });
    $(".curlManage").click(function() {
        layer.closeAll();
        layer.open({
            type: 2,
            title: '<i class="font-icon icon-share"></i>'+LNG.curlManage,
            shadeClose: true,
            shade: 0.2,
            area: ['92%', '92%'],
            content: '/admin/curl/'
        });
    });
    if (curModuleType == 2) {
        $("#myDocAccordion").click();  
    } else if (curModuleType == 3) {
        $("#orgDocAccordion").click();
    } else if (curModuleType == 4) {
        $("#sysDocAccordion").click();
    }
});
    function PathH(objId, objName, prtId, prtName){
    setCookie("prtName", prtName, 0.05);
    dmsListObj.oPenList(objId, objName, prtId, prtName)
}
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
</body>
</html>
