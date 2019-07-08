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
<html lang="ch">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>文档云平台</title>
    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/dms/action.js"></script>
	<script type="text/javascript" src="/statics/js/lib/seajs/sea.js"></script>
    <script type="text/javascript" src="/admin/g/commonjs"></script>
</head>
<body style="background: #f1f1f1">
<script>
    $(document).ready(function() {
        var cid = '<?php echo $this->input->get('cid');?>';
        var sessionid = '<?php echo $this->input->get('sessionid');?>';
        commobj.doGet(G.paths+'curl/openCurl?cid='+cid+'&sessionid='+sessionid,false,function(result){
            if(result.code == 200) {
                var curl = result.data;
                var showType = curl.showType;
                if(showType == 1) {
                    var obj = curl.objList[0];
                    commobj.doGet(G.paths+"curl/preDownload?cid="+cid+"&refId="+obj.refId+"&revId="+obj.revId+'&sessionid='+sessionid, false, function (result) {
                        if(result.code==200) {
                            var curlDetail = result.data;
                            var downloadUrl = curlDetail.downloadUrl;
                            window.location.href = downloadUrl;
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
                }else if(showType == 2){
                    var obj = curl.objList[0];
                    window.location.href=G.paths+"curl/curlView?cid="+cid+"&refId="+obj.refId+"&revId="+obj.revId+'&sessionid='+sessionid;
                }else if(showType == 3) {
                    window.location.href=G.paths+"curl/curlList?cid=" + cid+'&sessionid='+sessionid;
                }
                else if(showType == 4) {
                    window.location.href=G.paths+"curl/curlList?cid=" + cid+'&sessionid='+sessionid;
                }
            }else if(result.code == 501){
                var validType = result.data;
                if(validType == 1) {
                    window.location.href=G.paths+"curl/pwdLogin?cid="+cid;
                }else if(validType == 3){
                    window.location.href=G.paths+"curl/innerLogin?cid="+cid;
                }
            }
        });
    });
</script>
</body>
</html>