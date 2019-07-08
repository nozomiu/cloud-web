<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
?>
<div id="accessLogTabDiv">
    <img id="accessLogEmptyImg" style="margin-left: 120px;margin-top: 30px" src="/static/images/warning.png">
</div>
<script type="application/javascript">
    var id = '<?php echo $this->input->get('id');?>';
    $(document).ready(function(){
        console.log("id :"+ id);
        if(id != '') {
            commobj.doGet(G.paths+'dms/dlog?refId='+id+'&pageSize=5',false,function(result){
                if(result.code == 200) {
                    var logs = result.list;
                    if(!logs || logs.length<=0) {
                        return;
                    }
                    $("#accessLogEmptyImg").css('display','none');
                    $("#logContent").css('display','');
                    for(var i=0; i<logs.length; i++) {
                        var log = logs[i];
                        var html = "<div>\n" +
                            "        <table class=\"c7\">\n" +
                            "            <tr>\n" +
                            "                <td rowspan=\"2\" valign=\"top\" class=\"w1\">\n" +
                            "                    <span class=\"f18\">"+log.accessText+"</span>\n" +
                            "                </td>\n" +
                            "                <td>\n" +
                            "                    <span>"+log.updatedByName+"</span>\n" +
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
                        $("#accessLogTabDiv").append(html);
                    }
                    if(logs.length >= 5) {
                        var moreHtml = "<div class='pr10'><span class='btn btn-xs btn-xs btn-green' onclick='showMoreLogs()'>"+LNG.showMore+"</span></div>";
                        $("#accessLogTabDiv").append(moreHtml);
                    }
                }else if(result.code == 501){
                    commobj.showToast(LNG.D_C_P_D,2);
                    parent.location.reload()
                }
            });
        }
    });

    function showMoreLogs() {
        $("#showAccessLog").modal("show");
        var params = {};
        params.refId = id;
        commobj.list("accessLogTab",G.paths+"dms/dlog",params,true);
    }

</script>
