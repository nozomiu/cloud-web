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
    <!--[if IE 7]>
    <link rel="stylesheet" href="/statics/style/font-awesome/css/font-awesome-ie7.css?ver=<?php echo $version;?>">
    <![endif]--> 
    <title><?php echo $this->lang->line('title');?></title>
    <link rel="stylesheet" href="/statics/style/skin/base/app_explorer.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/diy.css?ver=<?php echo $version;?>"/>
    <link rel="stylesheet" href="/statics/style/skin/base/app_setting.css?ver=<?php echo $version;?>"/>
    <link href="/static/css/jquery-confirm.min.css"  rel="stylesheet">
    <link href="/static/css/toastr.css"  rel="stylesheet">

</head>
<body class="setting-page">
<div id="body">
        <div class="main">
        <section>    
        <div class="nav">
    <a href="javascript:;" class="this" data-page="setting-user-basic" draggable="false">基础设置</a>
    <div style="clear:both;"></div>
</div>

<div class="setting-tab setting-user-basic form-box">
    <div class="panel-body">
        <div class="form-row">
            <div class="setting-title">搜索展示类型:</div>
            <div class="setting-content">
                <label>
                    <input type="radio" class="kui-radio" id="sv1" name="searchType" value="1">
                    <span>表格</span>
                </label>
                <label>
                    <input type="radio" class="kui-radio" id="sv2" name="searchType" value="2">
                    <span>快照</span>
                </label>
            </div>
            <div class="clear"></div>
        </div>
        <div class="line"></div>
        <div class="form-row">
            <div class="setting-title">操作类型:</div>
            <div class="setting-content">
                <label>
                    <input type="radio" class="kui-radio" id="sv2" name="doubleClick" value="1">
                    <span>下载</span>
                </label>
                <label>
                    <input type="radio" class="kui-radio" name="doubleClick" value="2">
                    <span>预览</span>
                </label>
                <label>
                    <input type="radio" class="kui-radio" name="doubleClick" value="3">
                    <span>编辑</span>
                </label>
            </div>
            <div class="clear"></div>
        </div>
        <div class="line"></div>
        <div class="form-row">
            <div class="setting-title">预览展示类型:</div>
            <div class="setting-content">
                <label>
                    <input type="radio" class="kui-radio" name="viewType" value="1">
                    <span>flexpager</span>
                </label>
                <label>
                    <input type="radio" class="kui-radio" name="viewType" value="2">
                    <span>onlyOffice</span>
                </label>
            </div>
            <div class="clear"></div>
        </div>
        <div class="line"></div>

        <div class="form-row">
            <div class="setting-title">编辑展示类型:</div>
            <div class="setting-content">
                <label>
                    <input type="radio" class="kui-radio" name="editType" value="1">
                    <span>pageOffice</span>
                </label>
                <label>
                    <input type="radio" class="kui-radio" name="editType" value="2">
                    <span>onlyOffice</span>
                </label>
                <div style="clear:both"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="line"></div>
        <div class="form-row">
            <div class="setting-title">新窗口展示类型:</div>
            <div class="setting-content">
                <label>
                    <input type="radio" class="kui-radio" name="window" value="1">
                    <span>新标签页</span>
                </label>
                <label>
                    <input type="radio" class="kui-radio" name="window" value="2">
                    <span>窗口展示</span>
                </label>
            </div>
            <div class="clear"></div>
        </div>

    </div>
</div>

</section>
</div>
</div>

<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script>
<script type="text/javascript" src="/admin/g/commonjs"></script>
<script>
    $(document).ready(function() {
    window.onerror=function(){return true;}
    commobj.doGet(G.paths+'setting/info', false, function(result) {
        if (result.code == 200) {
            var info = result.data;
            var lang = info.lang;
            var searchType = info.searchType;
            var doubleClick = info.doubleClick;
            var viewType = info.viewType;
            var editType = info.editType;
            var windowType = info.windowType;
            $(":radio[name='searchType'][value='" + searchType + "']").prop("checked", "checked");
            $(":radio[name='doubleClick'][value='" + doubleClick + "']").prop("checked", "checked");
            $(":radio[name='viewType'][value='" + viewType + "']").prop("checked", "checked");
            $(":radio[name='editType'][value='" + editType + "']").prop("checked", "checked");
            $(":radio[name='window'][value='" + windowType + "']").prop("checked", "checked");
        } else {
            window.location.href = G.paths+"home/logout";
        }
    });

$('input:radio[name="searchType"]').click(function(){
    var scheckValue = $('input:radio[name="searchType"]:checked').val();
    var params = {};
    params.value = scheckValue;
    commobj.doPost(G.paths + 'setting/searchType', params, false, function(result) {
            if (result.code == 200) {
                $('#searchType', parent.document).val(scheckValue);
                commobj.showToast(LNG.Set_success, 1);
            } else {
                var msg = result.message;
                if (msg) {
                    commobj.showToast(msg, 2)
                } else {
                    commobj.showToast(LNG.system_error, 3)
                }
            }
        })
});
$('input:radio[name="doubleClick"]').click(function(){
    var dcheckValue = $('input:radio[name="doubleClick"]:checked').val();
    var params = {};
    params.value = dcheckValue;
    commobj.doPost(G.paths + 'setting/doubleClick', params, false, function(result) {
            if (result.code == 200) {
                $('#doubleClick', parent.document).val(dcheckValue);
                commobj.showToast(LNG.Set_success, 1);
            } else {
                var msg = result.message;
                if (msg) {
                    commobj.showToast(msg, 2)
                } else {
                    commobj.showToast(LNG.system_error, 3)
                }
            }
        })
});
$('input:radio[name="viewType"]').click(function(){
    var vcheckValue = $('input:radio[name="viewType"]:checked').val();
    var params = {};
    params.value = vcheckValue;
    commobj.doPost(G.paths + 'setting/viewType', params, false, function(result) {
            if (result.code == 200) {
                $('#viewType', parent.document).val(vcheckValue);
                commobj.showToast(LNG.Set_success, 1);
            } else {
                var msg = result.message;
                if (msg) {
                    commobj.showToast(msg, 2)
                } else {
                    commobj.showToast(LNG.system_error, 3)
                }
            }
        })
});
$('input:radio[name="editType"]').click(function(){
    var echeckValue = $('input:radio[name="editType"]:checked').val();
    var params = {};
    params.value = echeckValue;
    commobj.doPost(G.paths + 'setting/editType', params, false, function(result) {
            if (result.code == 200) {
                $('#editType', parent.document).val(echeckValue);
                commobj.showToast(LNG.Set_success, 1);
            } else {
                var msg = result.message;
                if (msg) {
                    commobj.showToast(msg, 2)
                } else {
                    commobj.showToast(LNG.system_error, 3)
                }
            }
        })
});
$('input:radio[name="window"]').click(function(){
    var wcheckValue = $('input:radio[name="window"]:checked').val();
    var params = {};
    params.value = wcheckValue;
    commobj.doPost(G.paths + 'setting/window', params, false, function(result) {
            if (result.code == 200) {
                $('#windowType', parent.document).val(wcheckValue);
                commobj.showToast(LNG.Set_success, 1);
            } else {
                var msg = result.message;
                if (msg) {
                    commobj.showToast(msg, 2)
                } else {
                    commobj.showToast(LNG.system_error, 3)
                }
            }
        })
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
