<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
        $this->config->load('api');
        $version  = $this->config->item('version');
        $langs  = $this->config->item('langs');
        $lang = $this->session->lang;
        $this->lang->load('main', $lang);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title><?php echo $this->lang->line('title');?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" />
    <style type="text/css" media="screen">
        html, body	{ height:100%; }
        body { margin:0; padding:0; overflow:auto; }
        #flashContent { display:none; }
    </style>
    <link href="/statics/style/common.css?ver=<?php echo $version;?>" rel="stylesheet"/>
    <link href="/statics/style/font-awesome/css/font-awesome.css?ver=<?php echo $version;?>" rel="stylesheet">
	<link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/win10.css?ver=<?php echo $version;?>" id='link-theme-style'/>
    <link rel="stylesheet" type="text/css" href="/static/css/toastr.css" />
    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/js/dms/action.js"></script>
    <script type="text/javascript" src="/static/js/dms/toastr.js"></script>
	<!--[if IE 7]>
    <link rel="stylesheet" href="/statics/style/font-awesome/css/font-awesome-ie7.css?ver=<?php echo $version;?>">
    <![endif]--> 
</head>
<body style="overflow: hidden">
<div style="margin: 15px;font-size: 20px;font-weight: bold; float:left; width: 150px">
    <span id="curlName"></span>
    <table style="margin-top: 30px">
        <tr class='hi4'>
            <td>
                <span class="cc"><?php echo $this->lang->line('createdDt')?>:</span>
            </td>
        </tr>
        <tr class='hi3'>
            <td valign="top">
                <span id="createTime"></span>
            </td>
        </tr>
        <tr class='hi4'>
            <td>
                <span class="cc"><?php echo $this->lang->line('Validity')?>:</span>
            </td>
        </tr>
        <tr class='hi3'>
            <td valign="top">
                <span id="deadline"></span>
            </td>
        </tr>
        <tr class='hi4'>
            <td>
                <span class="cc"><?php echo $this->lang->line('Allow_download')?>:</span>
            </td>
        </tr>
        <tr class='hi3'>
            <td valign="top">
                <span id="limitDownload"></span>
            </td>
        </tr>
        <tr class='hi4'>
            <td>
                <span class="cc"><?php echo $this->lang->line('downloadTime')?>:</span>
            </td>
        </tr>
        <tr class='hi3'>
            <td valign="top">
                <span id="downloadTime"></span>
            </td>
        </tr>
        <tr class='hi4'>
            <td>
                <button id="curlDownload" class="btn btn-xs btn-xs btn-green" data-loading-text="Loading..." type="button"> <?php echo $this->lang->line('download')?>
                </button>
            </td>
        </tr>
    </table>
</div>
<div id="documentViewer" class="flexpaper_viewer" style="float: right; width: 85%; height:100%; margin-top: 2px; margin-right:10px" >
    <iframe id="viewerIframe" style="width: 100%; height: 100%; border:0"></iframe>
</div>
<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script>
<script type="text/javascript" src="/admin/g/commonjs"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var cid = '<?php echo $this->input->get('cid');?>';
        var refId = '<?php echo $this->input->get('refId');?>';
        var revId = '<?php echo $this->input->get('revId');?>';
        var sessionid = '<?php echo $this->input->get('sessionid');?>';

        commobj.doGet(G.paths+"curl/view?cid="+cid+"&refId="+refId+"&revId="+revId+'&sessionid='+sessionid,false,function(result){
            if(result.code==200) {
                var curlResult = result.data;
                var name = curlResult.name;
                var viewResult = curlResult.viewResult;
                var flexUrl = viewResult.flexUrl;
                $("#viewerIframe").attr("src",flexUrl);
                // curlViewObj.view(viewUrl, pageSize);
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

        commobj.doGet(G.paths+"curl/detail?cid="+cid+"&refId="+refId+'&sessionid='+sessionid, false, function (result) {
            if(result.code==200) {
                var curlDetail = result.data;
				var objList = curlDetail.objList;
                var name = curlDetail.name;
                var createdDt = curlDetail.createdDt?curlDetail.createdDt:objList[0].createdDt;
                console.log(objList[0].createdDt);
                var downloadLimit = curlDetail.downloadLimit;
                var downloadTime = curlDetail.downloadTime;
                var deadline = curlDetail.deadline;
                $("#curlName").html(name);
                $("#createTime").html(createdDt);

                if(deadline){
                    $("#deadline").html(deadline);
                }else {
                    $("#deadline").html(LNG.Permanent);
                }

                if(downloadLimit == 0){
                    $("#limitDownload").html(LNG.D_is_not_allowed);
                    $("#curlDownload").css("display","none");
                }else if(downloadLimit > 0){
                    $("#limitDownload").html(downloadLimit+LNG.DW);
                }else if(downloadLimit < 0){
                    $("#limitDownload").html(LNG.No_Restriction);
                }

                if(downloadTime){
                    $("#downloadTime").html(downloadTime+LNG.DW);
                }else {
                    $("#downloadTime").html("0"+LNG.DW);
                }
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

        $("#curlDownload").click(function(){
            commobj.doGet(G.paths+"curl/preDownload?cid="+cid+"&refId="+refId+'&sessionid='+sessionid, false, function (result) {
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
</body>
</html>