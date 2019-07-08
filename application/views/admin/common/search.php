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
	<script src="/static/js/bootstrap-treeview.js?ver=<?php echo $version;?>"></script>
	<script src="/static/js/dms/action.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/dms/toastr.js?ver=<?php echo $version;?>"></script>
    <script src="/static/js/bootstrap-table.min.js"></script>
    <script src="/static/js/bootstrap-table-zh-CN.min.js"></script>
    <link href="/static/layui/css/layui.css"  rel="stylesheet">
    <script src="/static/layui/layui.js"/></script>
	<script src="/static/js/autocomplete.js"></script>
    <script src="/static/js/dms/search.js"></script>
    <script src="/static/js/dms/dmsList.js"></script>
    
	<link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
	<link rel="stylesheet" href="/statics/style/skin/win10.css?ver=<?php echo $version;?>" id='link-theme-style'/>
    <link href="/static/css/highs.css"  rel="stylesheet">
    <style id="header-resize-width" type="text/css"></style>
	<style>
	.frame-main .frame-right{left:0}
	.list-type-header tr{font-size:12px;}
	#main-title,#listContent{font-size:12px;}
    .frame-main{top:0}
    .table-bordered {border: 0 ;}
    #main-title .fileoperation,#listContent .fileoperation{width:180px;padding-right:0px}
    .header-left{float: right; padding:14px 20px 14px 0; cursor:pointer;}
    .icon-arrow-down,.icon-arrow-up{font-size: 22px!important; color: #3a96ff;}
    .w-component{left:504px;}
    .pagination{margin:5px;}
	</style>
</head>

<body style="overflow:hidden;">
<link href="/static/css/jquery-confirm.min.css"  rel="stylesheet">
<link href="/static/css/toastr.css"  rel="stylesheet">
<div class="full-background"></div>
<div class="frame-main">
<div class='frame-right'>
<div class='frame-right-main'>
<div class="tools">
<div class="tools-left tools-left-explorer ">
    <div class="kod-toolbar kod-toolbar-path fl-left hidden">
        <div class="hibtn select-button-show btn-group btn-group-sm fl-left mr-8">
                             <button  class="context-menu-item globe btn btn-default type1 b8" href="#log" content-id="#logContent" style="display: none">
                                <i class="font-icon icon-globe"></i><?php echo $this->lang->line('log')?></button>
                             <button class="context-menu-item external-link btn btn-default type1 b9" href="#indexCard" content-id="#indexCardContent" style="display: none">
                                <i class="font-icon icon-external-link"></i><?php echo $this->lang->line('indexCard')?></button>
                                <button class="context-menu-item star btn btn-default type1 b10" href="#permission" content-id="#permissionContent" style="display: none">
                                <i class="font-icon icon-star"></i><?php echo $this->lang->line('permission')?></button>
                             <button class="context-menu-item share btn btn-default " href="#curl" content-id="#curlContent" style="display: none">
                                <i class="font-icon icon-share"></i><?php echo $this->lang->line('share')?></button>
                                <button class="context-menu-item eye-open version btn btn-default" href="#version" content-id="#versionContent" style="display: none">
                                <i class="font-icon icon-eye-open"></i><?php echo $this->lang->line('version')?></button>
                             <button class="context-menu-item info btn btn-default type1 b11" href="#detail" content-id="#detailContent" style="display: none">
                                <i class="font-icon icon-info"></i><?php echo $this->lang->line('detail')?></button>   
                        </div>
    </div>
</div>
<div class="tools-right" style="width:300px; left:0; ">
<div class="frame-header">
	<div class="header-content">
		<div class='header-right' id='search-form'>
		</div>
	</div>
</div>
</div>
<div class="header-left"><i id="highs" class="font-icon icon-arrow-down"></i><i id="hiens" class="font-icon icon-arrow-up" style="display:none"></i></div>
<div class="header-middle" id="search_condition_info" style="display: none">
    <div class="gs_col">
        <div class="bh_qgjc">
                <div class="bh_g">
                    <p class="qb_gjc" name="search-type-desc-prev">标题：</p>
                    <div class="zx_x">
                        <input id="title" class="zb_sousuo" type="text" placeholder="请输入标题" name="title">
                    </div>
                </div>
                <div class="bh_l">
                    <p class="qb_gjc" name="search-type-desc-prev">创建时间：</p>
                    <div class="zx_x">
                        <input id="befCreatedTime" class="time_sousuo" type="text" placeholder="请选择起始时间" name="befCreatedTime"> ~
                        <input id="aftCreatedTime" class="time_sousuo" type="text" placeholder="请选择结束时间" name="aftCreatedTime">
                    </div>
                </div>
                <div class="blank"></div>
        </div>
        <div class="bh_qgjc">
                <div class="bh_g">
                    <p class="qb_gjc" name="search-type-desc-prev">内容：</p>
                    <div class="zx_x">
                        <input id="content" class="zb_sousuo" type="text" placeholder="请输入内容" name="content">
                    </div>
                </div>
                <div class="bh_l">
                    <p class="qb_gjc" name="search-type-desc-prev">修改时间：</p>
                    <div class="zx_x">
                        <input id="befUpdatedTime" class="time_sousuo" type="text" placeholder="请选择起始时间" name="befUpdatedTime"> ~
                        <input id="aftUpdatedTime" class="time_sousuo" type="text" placeholder="请选择结束时间" name="aftUpdatedTime">
                    </div>
                </div>
                <div class="blank"></div>
        </div>
        <div class="bh_qgjc">
                <div class="bh_g">
                    <p class="qb_gjc" name="search-type-desc-prev">描述：</p>
                    <div class="zx_x">
                        <input id="desc" class="zb_sousuo" type="text" placeholder="请输入描述" name="desc">
                    </div>
                </div>
                <div class="bh_l" style="float: left;">
                    
                    <div class="zx_x">
                        <p class="xb_xbh">
                                    <label class="sdq_qb">
                                        <input type="checkbox" name="includeSubFolder" value="true" checked>
                                        <span>包含子文件夹</span>
                                    </label> 
                                </p>
                        <p class="xb_xbh">
                                    <label class="sdq_qb">
                                        <input type="checkbox" name="ignoreCase" value="true" checked>
                                        <span>标题忽略大小写</span>
                                    </label> 
                                </p>        
                    </div>
                </div>
                <div class="blank"></div>
        </div>
        <div class="bh_qgjc">
                <div class="bh_g">
                    <p class="qb_gjc" name="search-type-desc-prev">创建人：</p>
                    <div class="zx_x">
                        <input id="createdBy" class="zb_sousuo" type="hidden" name="createdBy">
                        <input id="createdByname" class="zb_sousuo" type="text" placeholder="请选择创建人" name="createdByname" disabled><span onclick="searchObj.showAddAssignee(1);" style="font-size: 14px;cursor: pointer;" class="btn-right-radius">
                                            <i class="font-icon icon-search"></i>
                                        </span>
                    </div>
                </div>
                <div class="blank"></div>
        </div>
        <div class="bh_qgjc">
                <div class="bh_g">
                    <p class="qb_gjc" name="search-type-desc-prev">修改人：</p>
                    <div class="zx_x">
                        <input id="updatedBy" class="zb_sousuo" type="hidden" name="updatedBy">
                        <input id="updatedByname" class="zb_sousuo" type="text" placeholder="请选择修改人" name="updatedByname" disabled><span onclick="searchObj.showAddAssignee(2);" style="font-size: 14px;cursor: pointer;" class="btn-right-radius">
                                            <i class="font-icon icon-search"></i>
                                        </span>
                    </div>
                </div>
                <div class="blank"></div>
        </div>
        <div class="bh_qgjc">
                <div class="bh_g">
                    <p class="qb_gjc" name="search-type-desc-prev">文档类型：</p>
                    <div class="zx_x">
                        <label class="sfs_qbf">
                          <input type="radio" value="0" name="objType" checked>
                          <span>全部</span>
                        </label>
                        <label class="sfs_qbf">
                          <input type="radio" value="31" name="objType">
                          <span>文档柜</span>
                        </label>
                        <label class="sfs_qbf">
                          <input type="radio" value="32" name="objType">
                          <span>文件夹</span>
                        </label>
                        <label class="sfs_qbf">
                          <input type="radio" value="34" name="objType">
                          <span>文档</span>
                        </label>
                    </div>
                </div>
                <div class="blank"></div>
        </div>
        <div class="ljss">
                <a class="btn btn-xs btn-xs btn-green" href="javascript:void(0)" id="search-button-search-on" name="search-button-search-on"><?php echo $this->lang->line('Search')?></a>
                <div class="blank"></div>
            </div>
    </div>
</div>
<div style="clear:both"></div>
</div>
<div class="device-listStyle table-responsive" >   

</div> 
</div>      
<div class='bodymain drag-upload-box menu-body-main' style="top:80px" id="search">

	<div id="rightContent" class="file-continer file-list-list">		
    <div id="centerDiv" class="tab-content">
        <!-- 组织文档模块 start-->
        <div role="tabpanel" class="tab-pane active" id="user">
		<div class="frame-right-main">

            <div class="data-div">

                    <div class="device-listStyle table-responsive" >
                        <table contenteditable="false" id="dmsListTable" data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex">
                            <thead id="main-title" class="list-type-header">
                            </thead>
                            <tbody id="listContent">
                                
                            </tbody>
                        </table>

                        <div class="pull-right pagination">
                            <ul class="pagination">
                                <li class="page-pre">
                                    <a id="searchPageUp" onclick="searchObj.pageUp();" href="javascript:void(0)" disabled="true" style="pointer-events: none;color: gray;"><?php echo $this->lang->line('pageUp')?></a>
                                </li>
                                <li class="page-next">
                                    <a id="searchPageDown" onclick="searchObj.pageDown();" href="javascript:void(0)"><?php echo $this->lang->line('pageDown')?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
			</div>		
            </div>
        </div>
    </div>
    </div>
    <div id="x-auto" class=" x-component"></div>
    <div id="w-auto" class=" w-component"></div>
</div>       
        <!-- 组织文档模块 end-->
<!--弹出窗口 修改文件夹 start-->
<div class="modal fade" id="updateFolder" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document" style="border: 1px solid #cccccc;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('Modify_folder')?></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal">
                        <input type="hidden" id="fldId">
                        <input type="hidden" id="fldPrtId">
                        <div class="form-group ">
                            <label for="name" class="col-xs-2 control-label"><?php echo $this->lang->line('name')?>：</label>
                            <div class="col-xs-8 ">
                                <input type="text" class="form-control input-sm duiqi" name="name" id="nameFolderUpdate" maxlength="20" placeholder="">
                                <p class="fldNameHip" style="color: red; display: none;margin-left: -20px;" id="noUpdateFolder" ><?php echo $this->lang->line('FldName')?></p>
                                <p class="fldNameHip" style="color: red; display: none;margin-left: -20px;" id="existUpdateSameFldName"><?php echo $this->lang->line('SameFldName')?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-xs-2 control-label"><?php echo $this->lang->line('description')?>：</label>
                            <div class="col-xs-8 ">
                                <textarea class="form-control input-sm duiqi" id="descriptionFldUpdate" maxlength="100" placeholder=""></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('cancel')?></button>
                <button type="button" class="btn btn-xs btn-xs btn-green" onclick="searchObj.updateFolder()"><?php echo $this->lang->line('save')?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addAssignee" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 60px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Add_user')?></h4>
            </div>
            <div >
                <div class="container-fluid">
                    <div id="permissionOrgTreeDiv" style='margin-left: 10px; overflow: hidden;'>
                        <ul id="assigneeOrgTree" init="0" class="nav navbar-nav tableUl menuNav" style="width: 200px;"></ul>
                    
                    <div style="float: left;width: 326px; margin-left: 20px;">
                        <input type="text" class="form-control input-sm duiqi" name="userName" id="searchAssignee" maxlength="20" placeholder="过滤用户组或用户的登录名或姓名" style="margin-left: 1px !important;margin-bottom: 10px;width: 300px !important;">
                        <table contenteditable="false" id="assigneeTable" data-select-item-name="btSelectItem"  data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                            <thead>
                            <tr>
                                <th class="ui-state-default"  data-checkbox="true" data-align="center" data-valign="middle"><label><input class="a-radio" ><span class="b-radio"></span></label></th>
                                <th class="ui-state-default" data-field="fullName" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('name')?></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" id="addAssigneeCloseModel" data-dismiss="modal"><?php echo $this->lang->line('cancel')?></button>
                <button type="button" id="assigneeSubmitBtn1" onclick="searchObj.chooseUser(1);" class="btn btn-xs btn-xs btn-green"><?php echo $this->lang->line('Add')?></button>
                <button type="button" id="assigneeSubmitBtn2" onclick="searchObj.chooseUser(2);" class="btn btn-xs btn-xs btn-green"><?php echo $this->lang->line('Add')?></button>
            </div>
            </div>
            
        </div>
    </div>
</div>
<!--弹出窗口 设置权限 start -->
<div class="modal fade" id="setPermission" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 60px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('set_permission')?></h4>
            </div>
            <div>
                <div class="container-fluid">

                    <div id="setPermissionTabDiv" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 设置权限 end -->


<!--弹出窗口 <?php echo $this->lang->line('operation')?>日志 start -->
<div class="modal fade" id="showAccessLog" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 10px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('operation_log')?></h4>
            </div>
            <div >
                <div class="container-fluid">
                    <table contenteditable="false" id="accessLogTab" data-select-item-name="btSelectItem"  data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                        <thead>
                        <tr>
                            <th class="ui-state-default" data-field="accessText" data-align="center" data-valign="middle" ><?php echo $this->lang->line('operation_type')?></th>
                            <th class="ui-state-default" data-field="updatedByName" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('Username')?></th>
                            <th class="ui-state-default" data-field="updatedDt" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('operation_time')?></th>
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

<!--弹出窗口 添加索引卡 start -->
<div class="modal fade" id="addIndexCard" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document" style="width:420px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Add_indexCard')?></h4>
            </div>
            <div >
                <div class="container-fluid" >
                    <div>
                        <input type="text" class="form-control input-sm duiqi" name="userName" id="searchIndexCard" maxlength="20" placeholder="<?php echo $this->lang->line('Filter_indexCard')?>" style="margin-left: 1px !important;margin-top: 10px;margin-bottom: 10px;width: 300px !important;">
                        <table contenteditable="false" id="indexCardTable" data-select-item-name="btSelectItem"  data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                            <thead>
                            <tr>
                                <th class="ui-state-default indexCard" data-radio="true" data-align="center" data-valign="middle"><label><span class="b-"></span></label></th>
                                <th class="ui-state-default" data-field="name" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('name')?></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel IndexCard"  data-dismiss="modal"><?php echo $this->lang->line('cancel')?></button>
                <button type="button" class="btn btn-xs btn-xs btn-green" onclick="appendIndexCardHtml()"><?php echo $this->lang->line('Add')?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 添加索引卡 end -->


<!--弹出窗口 分享 start-->
<div class="modal fade" id="shareDialog" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('share')?></h4>
            </div>
            <div id="shareDialogContainer" class="container-fluid" >
                <input type="hidden" id="curlDocId">
                <input type="hidden" id="curlRevId">
                <input type="hidden" id="curlRevName">

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
                            <tr style="height: 50px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('operation')?>:</span>
                                </td>
                                <td style="text-align: left">
                                    <label><input id="r1" type="radio" value="1" name="operation_outShare" class="a-radio" checked><span class="b-radio"></span><?php echo $this->lang->line('Just_download')?></label>
                                    <label><input id="r2" type="radio" value="2" name="operation_outShare" class="a-radio" style="margin-left: 10px;"><span class="b-radio"></span><?php echo $this->lang->line('online_view')?></label>
                                    <!--<label><input id="r3" type="radio" value="3" name="operation_outShare"  class="a-radio" style="margin-left: 10px;"><span class="b-radio"></span><?php echo $this->lang->line('online_edit')?></label>-->
                                </td>
                            </tr>
                            <tr style="height: 50px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('permission')?>:</span>
                                </td>
                                <td style="text-align: left">
                                    <label><input id="p1" type="radio" value="1" name="validateType" class="c-radio" checked><span class="b-radio"></span><?php echo $this->lang->line('encryption')?></label>
                                    <label><input id="p2" type="radio" value="2" name="validateType" class="c-radio" style="margin-left: 40px;"><span class="b-radio"></span><?php echo $this->lang->line('open')?></label>
                                </td>
                            </tr>
                            <tr style="height: 50px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('download')?>:</span>
                                </td>
                                <td>
                                    <input type="text" value="-1" name="downloadLimit" style="width: 40px">
                                    <span style="margin-left: 10px"><?php echo $this->lang->line('downloadLimit')?></span>
                                </td>
                            </tr>
                            <!--<tr style="height: 50px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('print')?>:</span>
                                </td>
                                <td>
                                    <input type="text" value="-1" name="printLimit" style="width: 40px">
                                    <span style="margin-left: 10px"><?php echo $this->lang->line('printLimit')?></span>
                                </td>
                            </tr>-->
                        </table>
                    </div>
                    <div class="tab-pane fade" id="innerShare">
                        <table style="margin-top: 10px;">
                            <tr style="height: 50px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('operation')?>:</span>
                                </td>
                                <td style="text-align: left">
                                    <label><input type="radio" value="1" name="operation_innerShare" class="a-radio" checked><span class="b-radio"></span><?php echo $this->lang->line('Just_download')?></label>
                                    <label><input type="radio" value="2" name="operation_innerShare" class="a-radio" style="margin-left: 10px;"><span class="b-radio"></span><?php echo $this->lang->line('online_view')?></label>
                                    <label><input type="radio" value="3" name="operation_innerShare" class="a-radio" style="margin-left: 10px;"><span class="b-radio"></span><?php echo $this->lang->line('online_edit')?></label>
                                </td>
                            </tr>
                            <tr style="height: 50px">
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
                            <tr style="height: 50px">
                                <td style="width: 60px">
                                    <span><?php echo $this->lang->line('download')?>:</span>
                                </td>
                                <td>
                                    <input type="text" value="-1" name="downloadLimit" style="width: 40px">
                                    <span style="margin-left: 10px"><?php echo $this->lang->line('downloadLimit')?></span>
                                </td>
                            </tr>
                            <tr style="height: 50px">
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

                <div id="curlResultDiv" style="display: none">
                    <table style="margin-top: 20px">
                        <tr>
                            <td valign="top"><span><?php echo $this->lang->line('Share_links')?>:</span></td>
                            <td><textarea id="curlResult" style="width: 300px;height: 90px"></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="dmsListObj.refreshRightList()" type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('closeMode')?></button>
                <button onclick="curlObj.createCurl()" type="button" class="btn btn-xs btn-xs btn-green" ><?php echo $this->lang->line('The_link')?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 分享 end-->

<div class="modal fade" id="shareSubmit" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="submit">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('Approval')?></h4>
            </div>
            <div id="shareSubmitContainer" class="container-fluid" >
                <input type="hidden" id="curlDocId">
                <input type="hidden" id="type" value="1">
                <input type="hidden" id="cacheId">
                <ul id="shareType" class="nav nav-tabs">
                    <li >
                        <span><?php echo $this->lang->line('Sharing_Link_S')?></span>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active">
                        <table style="margin-top: 10px;">
                            <tr style="height: 40px">
                                <td style="width: 100px">
                                    <span><?php echo $this->lang->line('Sharing_Type')?>:</span>
                                </td>
                                <td style="text-align: left">
                                    <span id="Sharing_Type"></span>
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td style="width: 100px">
                                    <span><?php echo $this->lang->line('Number_D_Allowed')?>:</span>
                                </td>
                                <td style="text-align: left">
                                    <span id="Number_D_Allowed"></span>
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td style="width: 100px">
                                    <span><?php echo $this->lang->line('Number_P_Allowed')?>:</span>
                                </td>
                                <td>
                                    <span id="Number_P_Allowed"></span>
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td style="width: 100px">
                                    <span><?php echo $this->lang->line('S_approver')?>:</span>
                                </td>
                                <td>
                                    <span id="approvedByIds"></span>
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td style="width: 100px">
                                    <span><?php echo $this->lang->line('Share_documents')?>:</span>
                                </td>
                                <td>
                                    <p id="Share_documents"></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal" aria-label="Close"><?php echo $this->lang->line('closeMode')?></button>
                <button onclick="curlObj.flowSubmit()" type="button" id="flowSubmit" class="btn btn-xs btn-xs btn-green"><?php echo $this->lang->line('Submission')?></button>
            </div>
        </div>
    </div>
</div>

<!--弹出窗口 添加权限用户或用户组 start -->
<div class="modal fade" id="addAssignee" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 60px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('Add_user')?></h4>
            </div>
            <div >
                <div class="container-fluid">
                    <div id="permissionOrgTreeDiv" style='margin-left: 10px; overflow: hidden;'>
                        <ul id="assigneeOrgTree" init="0" class="nav navbar-nav tableUl menuNav" style="width: 200px;"></ul>
                    
                    <div style="float: left;width: 326px; margin-left: 20px;">
                        <input type="text" class="form-control input-sm duiqi" name="userName" id="searchAssignee" maxlength="20" placeholder="过滤用户组或用户的登录名或姓名" style="margin-left: 1px !important;margin-bottom: 10px;width: 300px !important;">
                        <table contenteditable="false" id="assigneeTable" data-select-item-name="btSelectItem"  data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                            <thead>
                            <tr>
                                <th class="ui-state-default"  data-checkbox="true" data-align="center" data-valign="middle"><label><input class="a-radio" ><span class="b-radio"></span></label></th>
                                <th class="ui-state-default" data-field="fullName" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('name')?></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" id="addAssigneeCloseModel" data-dismiss="modal"><?php echo $this->lang->line('cancel')?></button>
                <button type="button" id="assigneeSubmitBtn" class="btn btn-xs btn-xs btn-green" onclick="permissionObj.addPermission()"><?php echo $this->lang->line('Add')?></button>
            </div>
            </div>
            
        </div>
    </div>
</div>
<!--弹出窗口 添加权限用户或用户组 end -->
<!--弹出窗口 修改文件夹 end-->
<div class="zDialog"></div>
<div class="artDialog">
    <div class="proTab bc7 dialogShow" id="log">
        <div class="tab-head bc7">
                <i class="font-icon icon-globe"></i><span ><?php echo $this->lang->line('log')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="logContent" class="tab-content"></div>
    </div>
    <div class="proTab bcd dialogShow" id="indexCard">
        <div class="tab-head bcd">
                <i class="font-icon icon-external-link"></i><span ><?php echo $this->lang->line('indexCard')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="dmsindexCardImg" ><img src="/statics/images/common/loading.gif"></div>
        <div id="indexCardContent" class="tab-content" style="display: none"></div>
    </div>
    <div class="proTab bc7 dialogShow" id="permission">

        <div class="tab-head bc7">
                <i class="font-icon"><img draggable="false" class="x-item-file" ondragstart="return false;" src="/statics/images/file_icon/icon_others/setting.png"></i><span ><?php echo $this->lang->line('permission')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="dmspermissionImg"><img src="/statics/images/common/loading.gif"></div>
        <div id="permissionContent" class="tab-content" style="display: none">
            
        </div>
    </div>
    <div class="proTab bc7 dialogShow" id="curl">
        <div class="tab-head bc7">
                <i class="font-icon icon-share"></i><span ><?php echo $this->lang->line('share')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span> 
        </div>
        <div id="curlContent" class="tab-content"></div>
    </div>
    <div class="proTab bc7 dialogShow" id="version">
        <div class="tab-head bc7">
                <i class="font-icon"><img draggable="false" class="x-item-file" ondragstart="return false;" src="/statics/images/file_icon/icon_others/version.png"></i><span ><?php echo $this->lang->line('version')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="versionContent" class="tab-content" style="display: none"></div>
    </div>
    <div class="proTab bcd dialogShow" id="detail">
        <div class="tab-head bcd">
            <i class="font-icon icon-info"></i><span ><?php echo $this->lang->line('detail')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="dmsDetailEmptyImg"><img src="/statics/images/common/loading.gif"></div>
        <div id="detailContent" class="tab-content" style="display: none">
            
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script> 
<script type="text/javascript" src="/admin/g/commonjs"></script>
<script type="application/javascript" src="/static/js/dms/dmsList.js"/></script>
<script type="application/javascript" src="/static/js/dms/assigneeUser.js"/></script>
<script src="/static/js/contextMenu/jquery-contextMenu.js"></script>
<script type="application/javascript" src="/static/js/dms/rightTab.js"/></script>
<script type="application/javascript" src="/static/js/dms/drag.js"/></script>
<script type="application/javascript" src="/static/js/dms/curl.js"/></script>
<script src="/static/js/dms/Favorite.js?ver=<?php echo $version;?>"></script>
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
        searchObj.OcontextMenu();
        var keyWord = '<?php echo $this->input->get('keyWord');?>';
        var prtId = '<?php echo $this->input->get('prtId');?>';
        var proposals = ['百度1', '百度2', '百度3', '百度4', '百度5', '百度6', '百度7','呵呵呵呵呵呵呵','百度','新浪','a1','a2','a3','a4','b1','b2','b3','b4'];
        var searchType = $('#searchType', parent.document).val() ? $('#searchType', parent.document).val() : 1 ;
        if(searchType == 2){
            $(".main-title").css('display','none');
            $(".bodymain").css('top','48px');
        }
        $('#search-form').autocomplete({
            defVal:keyWord,
            hints: proposals,
            width: 200,
            height: 28,
            showButton: true,
            onSubmit: function(text){
                searchObj.search(prtId, text, searchType);
            }
        });
        $('#search-button-search-on').click(function(){
            var title = $('#title').val();
            var content = $('#content').val();
            var desc = $('#desc').val();
            var objType = $("input[name='objType']:checked").val();
            var includeSubFolder = $("input[name='includeSubFolder']:checked").val() ? $("input[name='includeSubFolder']:checked").val() : false;
            var ignoreCase = $("input[name='ignoreCase']:checked").val() ? $("input[name='ignoreCase']:checked").val() : false;
            var createdBy = $('#createdBy').val();
            var updatedBy = $('#updatedBy').val();
            var befCreatedTime = $('#befCreatedTime').val();
            var aftCreatedTime = $('#aftCreatedTime').val();
            var befUpdatedTime = $('#befUpdatedTime').val();
            var aftUpdatedTime = $('#aftUpdatedTime').val();
            searchObj.search(prtId, keyWord, searchType, title, content, desc, objType, includeSubFolder, ignoreCase, createdBy, updatedBy, befCreatedTime, aftCreatedTime, befUpdatedTime, aftUpdatedTime);
        });
        searchObj.search(prtId, keyWord, searchType);
        rightTabObj.initRightTab();

        layui.config({
            dir: '/static/layui/',
            version: false,
            debug: false,
            base: ''
        });
        layui.use(['layer', 'laydate'], function() {
            var layer = layui.layer;
            var laydate = layui.laydate;
            laydate.render({
                elem: '#befCreatedTime',
                type: 'datetime'
            });
            laydate.render({
                elem: '#befCreatedTime',
                type: 'datetime'
            });
            laydate.render({
                elem: '#aftCreatedTime',
                type: 'datetime'
            });
            laydate.render({
                elem: '#befUpdatedTime',
                type: 'datetime'
            });
            laydate.render({
                elem: '#aftUpdatedTime',
                type: 'datetime'
            });
        });
        $("#highs").click(function () {
            $(".tools-right").hide();
               $("#search_condition_info").show();
               $("#hiens").css('display','inline-block');
               $("#highs").css('display','none');
               $(".tools").css('height','240px');
               $(".bodymain").css('top','276px');
               if(searchType == 2){
                  $(".bodymain").css('top','246px');
               }
        });
        $("#hiens").click(function () {
            $(".tools-right").show();
               $("#search_condition_info").hide();
               $("#highs").css('display','inline-block');
               $("#hiens").css('display','none');
               $(".tools").css('height','44px');
               $(".bodymain").css('top','80px');
               if(searchType == 2){
                  $(".bodymain").css('top','48px');
               }
        });
        $("#createdByname").on("input",function(e){
            if(!e.delegateTarget.value){
               $("#createdBy").val(e.delegateTarget.value); 
            }
        });
        $("#updatedByname").on("input",function(e){
            if(!e.delegateTarget.value){
               $("#updatedBy").val(e.delegateTarget.value);
            }
        });
    });

</script>
<script type="application/javascript" src="/static/js/dms/jquery-confirm.min.js"></script>
<script type="application/javascript" src="/static/js/dms/dmsUpdate.js"/></script>
<?php echo '<script type="application/javascript" src="'.$docHost.'/pageoffice.js" id="po_js_main"></script>';?>
</body>
</body>
</html>