<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
?>
<div id="curlogDiv">
    <div id="curlLogTabDiv" style="text-align:center">
        <ul class="curlTitle">
           <li class="refName"><span><?php echo $this->lang->line('refName')?></span></li>
           <li class="downloadTime"><span><?php echo $this->lang->line('downloadTime')?></span></li>
           <li class="printTime"><span><?php echo $this->lang->line('printTime')?></span></li>
           <li class="operAtion"><span><?php echo $this->lang->line('operAtion')?></span></li>
        </ul>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        var curlId = '<?php echo $this->input->get('curlId');?>';
        if(curlId != '') {
            showCurlList(curlId);
        }
    });

    function showCurlList(curlId) {
        commobj.doGet(G.paths+'curl/cobjList?curlId='+curlId, false, function(result) {
            if (result.code == 200) {
                var curlList = result.list;
                if(!curlList || curlList.length<=0) {
                    return;
                }
                for(var i=0; i<curlList.length; i++) {
                    
                    var curl = curlList[i];
                    var refName="";
                    var downloadTime = "0";
                    var printTime = "0";
					var curlId = curl.curlId;
					var refId = curl.refId;
					
					if(curl.refName) {
                        refName = curl.refName;
                    }
                    if(curl.downloadTime) {
                        downloadTime = curl.downloadTime;
                    }
                    if(curl.printTime) {
                        printTime = curl.printTime;
                    }

                    var html = "<div class='cloginfo' id='"+ refId +"'>\n" +
                        "        <ul>\n" +
                        "            <li>\n" +
                        "                    <span style=\"width:260px\">"+refName+"</span>\n" +
                        "                    <span style=\"width:60px\">"+downloadTime+""+LNG.DW+"</span>\n" +
                        "                    <span style=\"width:60px\">"+printTime+""+LNG.DW+"</span>\n" +
                        "                    <span id=\"clog\" onclick=\"dmsListObj.curlLog(" + curlId + "," + refId + ")\" class=\"btn btn-xs btn-xs btn-green\">"+LNG.log+"</span>\n" +
                        "                    <span id=\"cDelObj\" onclick=\"dmsListObj.cDelObj(" + curlId + "," + refId + ")\" class=\"btn btn-xs btn-xs btn-green\">"+LNG.cDelObj+"</span>\n" +      
                        "            </li>\n" +                        						
                        "        </ul>\n" +
                        "    </div>";
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
