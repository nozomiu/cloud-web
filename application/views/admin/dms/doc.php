<?php
if(!isset($this->session->sessionId)){
        header('Location: /');
        exit();
}
$this->lang->load('main', 'cn');
$this->config->load('api');
$api_host = $this->config->item('api_host');
$api_port = $this->config->item('api_port');
$doc_port = $this->config->item('doc_port');
$apiHost  = $api_host.":".$api_port;
$docHost  = $api_host.":".$doc_port;
?>
<link href="/static/css/jquery-confirm.min.css"  rel="stylesheet">
<link href="/static/css/toastr.css"  rel="stylesheet">
<script src="/static/js/contextMenu/jquery-contextMenu.js"></script>
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
.frame-main .hibtn > .btn, .frame-main .btn-group-de > .btn{padding: 5px 6px;}
</style>
<!-- 个人文档管理模块 start-->
    <div class="frame-right-main">
            <div class="tools">
                <div class="tools-left tools-left-explorer ">

                    <!-- 文件功能 -->
                    <div class="kod-toolbar kod-toolbar-path fl-left">
                        <div class="select-button-default btn-group btn-group-sm zip fl-left mr-8 cabBtn b1">
                            <button data-action='newfolder' class="btn btn-default" type="button" data-toggle="modal" data-target="#createCabinet">
                                <i class="font-icon icon-external-link"></i><?php echo $this->lang->line('Create_cabinet');?></button>
                        </div>

                        <div class="select-button-default btn-group btn-group-sm fl-left mr-8 cabBtn b1">
                            <button data-action='newfolder' class="btn btn-default" type="button" data-toggle="modal" onclick="dmsUpdateObj.showCabinetUpdate();">
                                <i class="font-icon icon-rename"></i><?php echo $this->lang->line('Modify_cabinet');?></button>
                        </div>

                        <div class="select-button-show btn-group btn-group-sm fl-left mr-8 fldBtn b2" style="display: none">
                            <button data-action='newfolder' class="btn btn-default" type="button" data-toggle="modal" data-target="#createFolder" onclick="dmsListObj.showCreateFolder()" >
                                <i class="font-icon icon-folder-close-alt"></i><?php echo $this->lang->line('Create_folder');?></button>
                        </div>
                        <div class="select-button-show btn-group btn-group-sm fl-left mr-8 fldBtn b2" style="display: none">
                            <button data-action='newfolder' class="btn btn-default" type="button" data-toggle="modal" data-target="#updateUser" onclick="dmsUpdateObj.showUpdateFolder()">
                                <i class="font-icon icon-folder-close"></i><?php echo $this->lang->line('Modify_folder');?></button>
                        </div>
                        <div class="select-button-show btn-group btn-group-sm fl-left mr-8 docBtn b3" style="display: none">
                            <button data-action='upload' class="btn btn-default" type="button" data-toggle="modal" data-target="" onclick="docUploadObj.showUpload('upload')" >
                                <i class="font-icon icon-cloud-upload"></i><?php echo $this->lang->line('upload');?></button>
                        </div>
                        <div class="select-button-show btn-group btn-group-sm fl-left mr-8 singleDocBtn b4" style="display: none">
                            <button data-action='upload' class="btn btn-default" type="button" data-toggle="modal" onclick="docUploadObj.showUpload('checkIn')" >
                                <i class="font-icon icon-location-arrow"></i><?php echo $this->lang->line('Signing')?></button>
                                </div>
                        <div class="select-button-show btn-group btn-group-sm fl-left mr-8 singleDocBtn b5" style="display: none">
                            <button data-action='download' class="btn btn-default" type="button" data-toggle="modal" onclick="dmsListObj.download()" >
                                <i class="font-icon icon-download"></i><?php echo $this->lang->line('download_document')?></button>
                                </div>
                        <div class="select-button-default btn-group btn-group-sm fl-left mr-8 b6" style="display: none">
                            <button data-action='paste' class="btn btn-default paste" type="button" data-toggle="modal" onclick="dmsListObj.Dpaste()">
                                <i class="font-icon icon-paste"></i><?php echo $this->lang->line('_paste');?></button>
                                </div>          
                        <div class="select-button-default btn-group btn-group-sm fl-left mr-8 b7" style="display: none">
                            <button data-action='remove' class="btn btn-default remove" type="button" data-toggle="modal" onclick="dmsListObj.deleteDms()">
                                <i class="font-icon icon-remove"></i><?php echo $this->lang->line('delete')?></button>
                                </div>
                        <div class="hibtn select-button-show btn-group btn-group-sm fl-left mr-8">
                             <button  class="context-menu-item globe btn btn-default type1 b8" href="#log" content-id="#logContent" style="display: none">
                                <i class="font-icon icon-globe"></i><?php echo $this->lang->line('log')?></button>
                             <button class="context-menu-item share btn btn-default singleDocBtn b5" href="#curl" content-id="#curlContent" style="display: none">
                                <i class="font-icon icon-share"></i><?php echo $this->lang->line('share')?></button>   
                             <button class="context-menu-item external-link btn btn-default type1 b9" href="#indexCard" content-id="#indexCardContent" style="display: none">
                                <i class="font-icon icon-external-link"></i><?php echo $this->lang->line('indexCard')?></button>
                                <button class="context-menu-item eye-open version btn btn-default" href="#version" content-id="#versionContent" style="display: none">
                                <i class="font-icon icon-eye-open"></i><?php echo $this->lang->line('version')?></button>
                             <button class="context-menu-item info btn btn-default type1 b11" href="#detail" content-id="#detailContent" style="display: none">
                                <i class="font-icon icon-info"></i><?php echo $this->lang->line('detail')?></button>   
                        </div>

                        <div class="group-space-use fl-left hidden"></div>
                        <div class="admin-real-path hidden fl-left">
                            <button type="button" class="btn btn-default btn-sm dialog-goto-path ml-10"  title="进入所在目录">
                                <i class="font-icon icon-folder-open"></i>
                            </button>

                        </div>
                        <span class='msg fl-left'><?php echo $this->lang->line('loading');?>...</span>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="tools-right">
                    <div class="frame-header">
                     <div class="header-content">        
                     <div class='header-right' id='search-form'></div>
                 </div>
                 </div>
                </div>
                <div style="clear:both"></div>
            </div><!-- end tools -->
            
            </div>
<div class='bodymain drag-upload-box menu-body-main' id="myDrag">            
<div role="tabpanel" class="tab-pane active" id="user">

    <div class="data-div" id="R">

            <div class="device-listStyle table-responsive" >
                <table contenteditable="false" id="dmsListTable" data-click-to-select="true" class="table table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                    <thead id="main-title" class="list-type-header">

                    </thead>
                    <tbody id="listContent" class="file-list-list">
                    </tbody>
                </table>
            </div>

    </div>
</div>
<div id="x-auto" class=" x-component"></div>
<div id="windowMaskView" style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; background: rgb(66, 133, 244); opacity: 0.7; z-index: 9998; display: none"></div>
<div id="maskViewContent" style="position: absolute; z-index: 9999; width: auto; height: auto; top: 50%; left: 50%; margin-top:-160px; margin-left:-160px; display: none"><div style="font-size:50px;color:#fff;"><div class="upload-tips">                       <div>                           <i class="icon-cloud cloud1 moveLeftLoop"></i>                          <i class="icon-cloud cloud2"></i>                           <i class="icon-cloud cloud3 moveLeftLoop"></i>                      </div>                      <div class="cloud-moveup"><i class="moveTopLoop icon-circle-arrow-up"></i></div>                        <div class="msg">松开即可上传!</div>                  </div></div></div>
</div>
<!-- 用户管理模块 end-->

<!--弹出窗口 <?php echo $this->lang->line('Create_cabinet');?> start-->
<div class="modal fade" id="createCabinet" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 1px solid #cccccc;">
            <div class="modal-header">
                <button type="button" class="close cClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('Create_cabinet');?></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal">
                        <div class="form-group ">
                            <label for="name" class="col-xs-2 control-label"><?php echo $this->lang->line('name');?>：</label>
                            <div class="col-xs-8 ">
                                <input type="text" class="form-control input-sm duiqi" name="name" id="name" maxlength="20" placeholder="">
                                <p class="cabNameHip" style="color: red; display: none;margin-left: -20px;" id="noCabName" ><?php echo $this->lang->line('CabName');?></p>
                                <p class="cabNameHip" style="color: red; display: none;margin-left: -20px;" id="existSameCabName"><?php echo $this->lang->line('SameCabName');?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-xs-2 control-label"><?php echo $this->lang->line('description');?>：</label>
                            <div class="col-xs-8 ">
                                <textarea class="form-control input-sm duiqi" id="description" maxlength="100" placeholder=""></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
                <button type="button" class="btn btn-xs btn-xs btn-green" onclick="dmsListObj.createCabinet('myDoc')"><?php echo $this->lang->line('save');?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 <?php echo $this->lang->line('Create_cabinet');?> end-->

<!--弹出窗口 <?php echo $this->lang->line('Modify_cabinet');?> start-->
<div class="modal fade" id="updateCabinet" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 1px solid #cccccc;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('Modify_cabinet');?></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal">
                        <input type="hidden" id="cabId">
                        <div class="form-group ">
                            <label for="name" class="col-xs-2 control-label"><?php echo $this->lang->line('name');?>：</label>
                            <div class="col-xs-8 ">
                                <input type="text" class="form-control input-sm duiqi" name="name" id="nameUpdate" maxlength="20" placeholder="">
                                <p class="cabNameHip" style="color: red; display: none;margin-left: -20px;" id="noUpdateCabName" ><?php echo $this->lang->line('CabName');?></p>
                                <p class="cabNameHip" style="color: red; display: none;margin-left: -20px;" id="existUpdateSameCabName"><?php echo $this->lang->line('SameCabName');?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-xs-2 control-label"><?php echo $this->lang->line('description');?>：</label>
                            <div class="col-xs-8 ">
                                <textarea class="form-control input-sm duiqi" id="descriptionUpdate" maxlength="100" placeholder=""></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
                <button type="button" class="btn btn-xs btn-xs btn-green" onclick="dmsUpdateObj.updateCabinet('myDoc')"><?php echo $this->lang->line('save');?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 <?php echo $this->lang->line('Modify_cabinet');?> end-->

<!--弹出窗口 <?php echo $this->lang->line('Create_folder');?> start-->
<div class="modal fade" id="createFolder" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 1px solid #cccccc;">
            <div class="modal-header">
                <button type="button" class="close cClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $this->lang->line('Create_folder');?></h4>
            </div>
            <div >
                <div id="createFolderContainer" class="container-fluid">
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="dmsListObj.refreshRightList()" type="button" class="btn btn-xs btn-xs btn-white closeMode" data-dismiss="modal"><?php echo $this->lang->line('closeMode');?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 创建用户 end-->

<!--弹出窗口 <?php echo $this->lang->line('Modify_folder');?> start-->
<div class="modal fade" id="updateFolder" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 1px solid #cccccc;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ><?php echo $this->lang->line('Modify_folder');?></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal">
                        <input type="hidden" id="fldId">
                        <input type="hidden" id="fldPrtId">
                        <div class="form-group ">
                            <label for="name" class="col-xs-2 control-label"><?php echo $this->lang->line('name');?>：</label>
                            <div class="col-xs-8 ">
                                <input type="text" class="form-control input-sm duiqi" name="name" id="nameFolderUpdate" maxlength="20" placeholder="">
                                <p class="fldNameHip" style="color: red; display: none;margin-left: -20px;" id="noUpdateFolder" ><?php echo $this->lang->line('FldName');?></p>
                                <p class="fldNameHip" style="color: red; display: none;margin-left: -20px;" id="existUpdateSameFldName"><?php echo $this->lang->line('SameFldName');?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-xs-2 control-label"><?php echo $this->lang->line('description');?>：</label>
                            <div class="col-xs-8 ">
                                <textarea class="form-control input-sm duiqi" id="descriptionFldUpdate" maxlength="100" placeholder=""></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
                <button type="button" class="btn btn-xs btn-xs btn-green" onclick="dmsUpdateObj.updateFolder()"><?php echo $this->lang->line('save');?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 <?php echo $this->lang->line('Modify_folder');?> end-->

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
                            <tbody>
                            <tr style="height: 40px">
                                <td>
                                    <span><?php echo $this->lang->line('curlRevName')?></span>
                                </td>
                                <td>
                                    <input name="curlRevName" type="text" id="curlRevName">
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td>
                                    <input type="checkbox" name="deadlineBox" id="deadlineBox" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Validity')?></span>
                                </td>
                                <td>
                                    <input name="deadline" type="text" id="deadline" disabled>
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td>
                                    <input type="checkbox" name="limitDownload" id="limitDownload" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Allow_download')?></span>
                                </td>
                                <td>
                                    <input name="downloadLimit" id="downloadLimit" type="text" value="-1" style="width: 60px" disabled oninput="checkedThis()"><span> <?php echo $this->lang->line('DW')?></span>
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td>
                                    <input type="checkbox" name="allowPrint" id="allowPrint" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Allow_printing')?></span>
                                </td>
                                <td>
                                    <input name="printLimit" id="printLimit" type="text" value="0" style="width: 60px" disabled oninput="checkedThis()"><span> <?php echo $this->lang->line('DW')?></span>
                                </td>
                            </tr>
                            <tr style="height: 40px">
                                <td>
                                    <input type="checkbox" name="allowUpload" id="allowUpload" class="kui-checkbox size-small" onclick="checkedThis()">
                                    <span><?php echo $this->lang->line('Allow_Upload')?></span>
                                </td>
                            </tr>
                            <tr style="height: 40px">
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
                </div>
                <div id="curlTips">
                   (创建文档链接，有效期限为永久，不允许下载，不需要访问密码。)
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

<!--弹出窗口 上传文件 start-->
<div id="uploadFileFormDiv">
    <form id="uploadFileForm" method="post" enctype="multipart/form-data">
        <input type="hidden" id="upLimitSize">
        <input type="hidden" id="uploadUrl">
        <input type="hidden" id="uploadFldId">
        <input type="file" id="uploadFile" name="files" style="display: none" multiple="multiple"
            onchange="docUploadObj.onFileChange(this,'upload')" />
    </form>
</div>
<!--弹出窗口 上传文件 start-->

<!--弹出窗口 签入文件 start-->
<div id="checkInFileFormDiv">
    <form id="checkInFileForm" method="post" enctype="multipart/form-data">
        <input type="hidden" id="inLimitSize">
        <input type="hidden" id="checkInUrl">
        <input type="file" id="checkInFile" name="files" style="display: none"
               onchange="docUploadObj.onFileChange(this,'checkIn')" />
    </form>
</div>
<!--弹出窗口 签入文件 start-->


<!--弹出窗口 操作日志 start -->
<div class="modal fade" id="showAccessLog" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 10px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $this->lang->line('operation_log');?></h4>
            </div>
            <div >
                <div class="container-fluid" style="margin-left: 12px;">
                    <table contenteditable="false" id="accessLogTab" data-select-item-name="btSelectItem"  data-click-to-select="true" class="table table-striped table-bordered table-hover table-condensed footable tablex"  style="border: 0px solid transparent !important;">
                        <thead>
                        <tr>
                            <th class="ui-state-default" data-field="accessText" data-align="center" data-valign="middle" ><?php echo $this->lang->line('operation_type');?></th>
                            <th class="ui-state-default" data-field="updatedByName" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('Username');?></th>
                            <th class="ui-state-default" data-field="updatedDt" data-escape="true" data-align="center" data-valign="middle"><?php echo $this->lang->line('operation_time');?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-xs btn-white closeModel" data-dismiss="modal"><?php echo $this->lang->line('closeMode');?></button>
            </div>
        </div>
    </div>
</div>
<!--弹出窗口 操作日志 end -->

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
<!--左侧tab start -->
<div class="zDialog"></div>
<div class="artDialog">

    <div class="proTab bcd dialogShow" id="detail">
        <div class="tab-head bcd">
            <i class="font-icon icon-info"></i><span ><?php echo $this->lang->line('detail');?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="dmsDetailEmptyImg"><img src="/statics/images/common/loading.gif"></div>
        <div id="detailContent" class="tab-content" style="display: none">
        </div>
    </div>
    <div class="proTab bcd dialogShow" id="indexCard">
        <div class="tab-head bcd">
                <i class="font-icon icon-external-link"></i><span ><?php echo $this->lang->line('indexCard')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="dmsindexCardImg" ><img src="/statics/images/common/loading.gif"></div>
        <div id="indexCardContent" class="tab-content" style="display: none"></div>
    </div>
    <div class="proTab bc7 dialogShow" id="log">
        <div class="tab-head bc7">
            <i class="font-icon icon-globe"></i><span ><?php echo $this->lang->line('log');?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="logContent" class="tab-content" style="display: none">
        </div>
    </div>
    <div class="proTab bc7 dialogShow" id="curl">
        <div class="tab-head bc7">
                <i class="font-icon icon-share"></i><span ><?php echo $this->lang->line('share')?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span> 
        </div>
        <div id="curlContent" class="tab-content" ></div>
    </div>
    <div class="proTab bc7 dialogShow" id="version">
        <div class="tab-head bc7">
            <i class="font-icon"><img draggable="false" class="x-item-file" ondragstart="return false;" src="/statics/images/file_icon/icon_others/version.png"></i><span ><?php echo $this->lang->line('version');?></span><span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span>
        </div>
        <div id="versionContent" class="tab-content" style="display: none">
        </div>
    </div>


</div>
<!--左侧tab end-->
<script type="application/javascript" src="/static/js/dms/jquery-confirm.min.js"></script>
<script type="application/javascript" src="/static/js/dms/dmsList.js"/></script>
<script type="application/javascript" src="/static/js/dms/dmsUpdate.js"/></script>
<script type="application/javascript" src="/static/js/dms/rightTab.js"/></script>
<script type="application/javascript" src="/static/js/dms/docUpload.js"/></script>
<script type="application/javascript" src="/static/js/dms/drag.js"/></script>
<script type="application/javascript" src="/static/js/dms/curl.js"/></script>
<script type="application/javascript" src="/static/js/autocomplete.js"></script>
<script type="application/javascript" src="/static/js/dms/assigneeUser.js"/></script>
<?php echo '<script type="application/javascript" src="'.$docHost.'/pageoffice.js" id="po_js_main"></script>';?>

<script type="text/javascript">

        var dashboard = document.getElementById("myDrag")
        dashboard.addEventListener("dragover", function (e) {
            e.preventDefault();
            e.stopPropagation();
        })
        dashboard.addEventListener("dragenter", function (e) {
            e.preventDefault();
            e.stopPropagation();
            //$("#windowMaskView").css("display", "");
            //$("#maskViewContent").css("display", "");
        })
        dashboard.addEventListener("drop", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var files = this.files || e.dataTransfer.files;
            docDrag.showUpload(files,'upload');
            //$("#windowMaskView").css("display", "none");
            //$("#maskViewContent").css("display", "none");
            return false;
        })
    </script>
<script type="application/javascript">
    $(document).ready(function(){
        commobj.MycontextMenu();
        dmsListObj.refreshCabList();
        rightTabObj.initRightTab();
        dmsListObj.initSearch();
    });
    $("button.cClose").click(function() {
        dmsListObj.refresh();
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

</script>
