<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
?>
<div id="curlogDiv">
    <div id="showAddCurlBtn" style="display: none;">
        <span id="showUpdateBtn" title="<?php echo $this->lang->line('share');?>" onclick="showAddCurl('<?php echo $this->input->get('id');?>','<?php echo $this->input->get('name');?>')" style="cursor: pointer;"><i class="font-icon icon-plus"></i></span>
    </div>
    <div id="curlLogTabDiv">
        <img id="curlLogImg" src="/static/images/warning.png">
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        var id = '<?php echo $this->input->get('id');?>';
        console.log("id :"+ id);

        if(id != '') {
            var objType = id % 100;
            if(objType != 31) {
                $("#showAddCurlBtn").css("display","");
                showCurlList(id);
            }
        }
    });

    function showCurlList(id) {
        console.log("showCurlList :"+ id);
        commobj.doGet(G.paths+'curl/clist?refId='+id, false, function(result) {
            if (result.code == 200) {
                var curlList = result.list;
                if(!curlList || curlList.length<=0) {
                    return;
                }
                $("#curlLogImg").css('display','none');
                for(var i=0; i<curlList.length; i++) {
                    
                    var curl = curlList[i];

                    var validatePwd="";
                    var validateType="";
                    var downloadLimit = "";
                    var downloadTime = "0";
                    var deadline = "永久有效";

                    if(curl.validateType == 1){
                        validateType = "加密";
                        validatePwd = curl.validatePwd;
                    }else if(curl.validateType == 2){
                        validateType="公开"
                    }else if(curl.validateType == 3){
                        validateType="内部分享"
                    }
                    if(curl.downloadLimit == -1) {
                        downloadLimit="不限制";
                    }else{
                        downloadLimit = curl.downloadLimit;
                    }

                    if(curl.downloadTime) {
                        downloadTime = curl.downloadTime;
                    }
                    if(curl.deadline) {
                        deadline = curl.deadline;
                    }
                    var url = window.location.protocol+"//"+window.location.host+'/c?cid='+curl.cacheId;
                    var revNum = curl.revNum ? curl.revNum : 0;

                    var html = "<div>\n" +
                        "<div>" +
                        "<table>" +
                        "            <tr style='height: 30px'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.link+":</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top; \">\n" +
                        "                <td>\n" +
                        "                    <input type=\"text\" class=\"download-url\" value=\""+url+"\"><a href=\""+url+"\" target=\"_blank\" class=\"btn btn-default open-window\">打开</a>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "</table><hr />" +
                        "</div>" +
                        "        <table>\n" +
                        "            <tr class='hi4'>\n" +
                        "                <td style='width: 80px'>\n" +
                        "                    <span class=\"cc\">"+LNG.name+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span>"+curl.name+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +                       
                        "            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.validateType+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+validateType+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +                          
                        "            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.validatePwd+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <input type=\"text\" class=\"validatePwd\" value=\""+validatePwd+"\">\n" +
                        "                </td>\n" +
                        "            </tr>\n" +                            
                        "            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.downloadLimit+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+downloadLimit+""+LNG.DW+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.downloadTime+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+downloadTime+""+LNG.DW+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +                            
                        /*"            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.printLimit+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+printLimit+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +*/
                        "            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.revNum+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+revNum+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr  class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.deadline+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+deadline+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.createdDt+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+curl.createdDt+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr class='hi4'>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.createdByName+":</span>\n" +
                        "                </td>\n" +
                        "                <td>\n" +
                        "                    <span >"+curl.createdByName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "        </table>\n" +
                        "    </div>\n" +
                        "    <hr />";
                    $("#curlLogTabDiv").append(html);
                }
            }else if(result.code == 501){
                    parent.location.reload()
                }
        });
    }

    function showAddCurl(docId, fileName) {
                    $("#curlDocId").val(docId);
                    //$("#curlRevName").val(fileName);
                    $("#shareDialog").modal("show");
   
    }
</script>