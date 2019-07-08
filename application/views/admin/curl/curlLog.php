<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
?>
<div id="curlogDiv">
    <div id="curlLogTabDiv" style="text-align:center">
        <img id="loading" src="/static/images/warning.png">
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        var curlId = '<?php echo $this->input->get('curlId');?>';
        var refId = '<?php echo $this->input->get('refId');?>';
        console.log("curlId :"+ curlId);
        if(curlId != '') {
                showCurlLog(curlId,refId);
        }
    });

    function showCurlLog(curlId,refId) {
        commobj.doGet(G.paths+'curl/log?curlId=' + curlId + "&refId=" + refId, false, function(result) {
            if(result.code == 200) {
                    var logs = result.list;

                    if(!logs || logs.length<=0) {
                        return;
                    }
                    $("#loading").css('display','none');
                    $("#logContent").css('display','');

                    for(var i=0; i<logs.length; i++) {
                        var log = logs[i];
                        console.log(log.logType);
                        var html = "<div>\n" +
                            "        <table class=\"c7\">\n" +
                            "            <tr>\n" +
                            "                <td rowspan=\"2\" valign=\"top\" class=\"w1\">\n" +
                            "                    <span class=\"f18\">"+log.logType+"</span>\n" +
                            "                </td>\n" +
                            "                <td>\n" +
                            "                    <span>"+log.createdByName+"</span>\n" +
                            "                </td>\n" +
                            "            </tr>\n" +
                            "            <tr>\n" +
                            "                <td>\n" +
                            "                    <span>"+log.updatedDt+"</span>\n" +
                            "                </td>\n" +
                            "            </tr>\n" +
                            "        </table>\n" +
                            "    </div>\n" +
                            "     <hr/>\n";
                        $("#curlLogTabDiv").append(html);
                    }
                }else if(result.code == 501){
                    commobj.showToast(LNG.D_C_P_D,2);
                    parent.location.reload()
                }
        });
    }

    function showAddCurl(docId, fileName) {
        $("#curlRevName").val('');
        $("#deadlineBox").attr("disabled",true);
        $("#limitDownload").attr("disabled",true);
        $("#allowPrint").attr("disabled",true);
        $("#allowUpload").attr("disabled",true);
        $("#createPwd").attr("disabled",true);
        $("#downloadLimit").val('');
        $("#printLimit").val('');
        $("#curlResult").val('');
        $("#curlDocId").val(docId);
        //$("#curlRevName").val(fileName);
        $("#shareDialog").modal("show");
}
</script>
