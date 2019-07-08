<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
?>
<script src="/static/layui/layui.js"/></script>
<div id="indexCardTabDiv">
    <span id="showUpdateBtn" title="<?php echo $this->lang->line('Add_indexCard');?>" onclick="showAddIndexCard()" class='btn btn-xs btn-xs btn-green' ><?php echo $this->lang->line('Add');?></span>
    <div>
        <img id="indexCardImg" style="margin-left: 120px;margin-top: 60px" src="/static/images/warning.png">
    </div>
</div>
<link href="/static/bootstrap-3.3.5/css/bootstrap-select.min.css" rel="stylesheet">
<script type="application/javascript" src="/static/js/bootstrap-select.min.js"/>
<div id="jsHtml"></div>
<script type="application/javascript">
function loadjs(filename, filetype){
    if (filetype=="js"){
        var fileref=document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src",filename);
    }
    if (typeof fileref!="undefined")
        $('#jsHtml')[0].appendChild(fileref);

    }
    var d = new Date();
    var n = d.getTime();
    var id = '<?php echo $this->input->get('id');?>';
    var indexCardId;
    var jsHtml = "<script type='application/javascript'>layui.config({" +
                          "dir: '/static/layui/' " +
                          ",version: false " +
                          ",debug: false " +
                          ",base: '' " +
                          "});" +
                          "layui.use('laydate', function(){ " +
                          "var laydate = layui.laydate; " +
                          "laydate.render({ " +
                          "elem: '#timdate' " +
                          ",type: 'datetime' " +
                          "}); " +
                        "});<\/script>";

    $(document).ready(function(){

        console.log("id :"+ id);
        if(id != '') {
            showDocIndexCard(id);
        }

        var that = $("#searchIndexCard");
        if(that) {
            that.on('input',function(e){
                var name = that.val();
                var params = {};
                params.name = name;
                commobj.list("indexCardTable",G.paths+"indexCard/clist",params,true);
            });
        }
    });

    function showDocIndexCard(id) {
        commobj.doGet(G.paths+'indexCard/detail?id='+id,false,function(result) {
            $("#dmsindexCardImg").css("display","none");
            $("#indexCardContent").css("display","");
            if (result.code == 200) {
                var attrList = result.list;
                if(!attrList || attrList.length<=0) {
                    return;
                }
                var indexCard = result.data;

                var html =" <span id=\"showUpdateBtn\" title=\""+LNG.Modify+"\" onclick=\"changeToUpdate()\" class='btn btn-xs btn-xs btn-green closeModel'>"+LNG.Modify+"</span>\n" +
                    " <span id=\"saveUpdateDmsBtn\" title=\""+LNG.save+"\" onclick=\"saveIndexCard()\" class='btn btn-xs btn-xs btn-green' style=\"display: none;\">"+LNG.save+"</span>\n";
                html += "<hr style=\"border-top:1px;\"><span style='font-size: 14px'>"+LNG.indexCard+":</span><span style='font-size: 14px'>"+indexCard.name+"</span>";
                html += "<table style='margin-top: 10px'>";
                for(var i=0; i<attrList.length; i++) {
                    var attrObj = attrList[i];
                    var attrId = attrObj.attrId;
                    var attrName = attrObj.attrName;
                    var attrType = attrObj.attrType;
                    var refId = attrObj.refId;
                    var value = attrObj.value;
                    html += "<tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+attrName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <span class=\"showSpan\" id=\"nameSpan\">"+value+"</span>\n"+
                        "                </td>\n" +
                        "            </tr>";
                }
                $("#indexCardTabDiv").empty();
                $("#indexCardTabDiv").append(html);
            }else if(result.code == 501){
                commobj.showToast(LNG.D_C_P_D,2);
                    parent.location.reload()
                }
        });
    }
    
    function showAddIndexCard() {

        var params = {};
        commobj.list("indexCardTable",G.paths+"indexCard/Clist",params,true);
        $("#addIndexCard").modal("show");
    }
    
    function appendIndexCardHtml() {
        
        var rows = $("#indexCardTable").bootstrapTable("getSelections");
        if(rows.length <= 0) {
            commobj.showToast(LNG.select_indexCard,2);
            return;
        }
        var indexCard = rows[0];
        var html =" <span id=\"showUpdateBtn\" title=\""+LNG.Modify+"\" onclick=\"()\" class='btn btn-xs btn-xs btn-white closeModel' style=\"display: none;\">"+LNG.Modify+"</span>\n" +
                  " <span id=\"saveUpdateDmsBtn\" title=\""+LNG.save+"\" onclick=\"saveIndexCard()\" class='btn btn-xs btn-xs btn-green' >"+LNG.save+"</span>\n";
        indexCardId = indexCard.id;
        commobj.doGet(G.paths + 'indexCard/attrList?indexCardId='+indexCardId,false,function(result) {
            if (result.code == 200) {
                var attrList = result.list;
                if(attrList.length == 0) {
                    commobj.showToast(LNG.indexCard_no_attributes,2);
                    return;
                }
                html += "<hr style=\"border-top:1px;\"><table>";
                for(var i=0; i<attrList.length; i++) {
                    var attrObj = attrList[i];
                    var attrId = attrObj.id;
                    var attrName = attrObj.name;
                    var attrType = attrObj.attrType;
                    var refId = attrObj.refId;
                    var defValue = '';
                    var defId = '';
                    var htmValue = '';
                    var itype = '';

                    if(attrType == '2') {
                        itype = "onkeyup=\"value=value.replace(/[^\\"+"d]/g,\'\')\"";
                    }
                    if(attrType == '3') {
                        itype = 'id="timdate" lay-key="'+ n +'"';
                    }
                    if(attrType == '4') {
                        commobj.doGet(G.paths+'indexCard/attrValueList?attrId='+refId,false,function(result3) {
                           if (result3.code == 200) {
                            var vList = result3.list;
                            for(var i=0; i<vList.length; i++) {
                               var vObj = vList[i];
                               var defValue = vObj.value;
                               var defId = vObj.id;
                               htmValue += "<option value=\""+defId+"\">"+defValue+"</option>";
                           } }

                              html += "<tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+attrName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <select id='valid' style='margin-top: 5px' class=\"indexCardAttr\" attrId=\""+attrId+"\" attrName=\""+attrName+"\" refId=\""+refId+"\" attrType=\""+attrType+"\" >" + htmValue +
                        "                </select></td>\n" +
                        "            </tr>";
                        });
                    }
                    else{
                        html += "<tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+attrName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <input style='margin-top: 5px' " + itype +
                        "                   class=\"indexCardAttr\" " +
                        "                   attrId=\""+attrId+"\"" +
                        "                   attrName=\""+attrName+"\" " +
                        "                   attrType=\""+attrType+"\" " +
                        "                   value=\""+defValue+"\"\n" +
                        "                ></td>\n" +
                        "            </tr>";
                }}
                $(".IndexCard.closeModel").click();
                $("#indexCardTabDiv").empty();
                $("#indexCardTabDiv").append(html);
                loadjs("/static/js/dms/layerdate.js","js")
            }else {
                var msg = result.message;
                if(msg) {
                    commobj.showToast(msg,2);
                }else {
                    commobj.showToast(LNG.system_error,3);
                }
            }
        });

    }
    
    function saveIndexCard() {
        
        var params = {};
        params.objId=id;
        params.indexCardId=indexCardId;
        params.valueList=[];
        $(".indexCardAttr").each(function (i, val) {
            var attrId = $(val).attr("attrId");
            var attrName = $(val).attr("attrName");
            var attrType = $(val).attr("attrType");
            var attrValue = $(val).val();
            var options=$("#valid option:selected"); 
            if(attrType==4){
            var attrValue = options.text();
            var refid = $(val).attr("refid");
            var valid = options.val();
            }
            var attrObj = {};
            attrObj.indexCardId = indexCardId;
            attrObj.attrId = attrId;
            attrObj.attrName = attrName;
            attrObj.attrType = attrType;
            attrObj.value = attrValue;
            attrObj.refId = refid;
            attrObj.valId = valid;
            params.valueList.push(attrObj);
        });
        //console.log("saveIndexCard params:"+JSON.stringify(params));
        commobj.doPostJson(G.paths+'indexCard/save',JSON.stringify(params),false,function(result){
            if(result.code == 200) {
                showDocIndexCard(id);
                commobj.showToast(LNG.indexCard_save_secc,1);
            }else {
                var msg = result.message;
                if(msg) {
                    commobj.showToast(msg,2);
                }else {
                    commobj.showToast(LNG.system_error,3);
                }
            }
        });
    }
    
    function changeToUpdate() {
        var d = new Date();
        var n = d.getTime();
        commobj.doGet(G.paths+'indexCard/detail?id='+id,false,function(result) {
            if (result.code == 200) {
                var attrList = result.list;
                if(!attrList || attrList.length<=0) {
                    return;
                }
                var indexCard = result.data;
                indexCardId = indexCard.id;
                commobj.doGet(G.paths+'indexCard/clist?page='+false,false,function(result2) {
                    if (result2.code == 200) {
                        var html =" <span id=\"saveUpdateDmsBtn\" title=\""+LNG.save+"\" onclick=\"saveIndexCard()\" class='btn btn-xs btn-xs btn-green' >"+LNG.save+"</span>\n";
                        html += "<hr style=\"border-top:1px;\"><span style='font-size: 14px'>"+LNG.indexCard+": </span>";
                        var indexList = result2.list;
                        html += "<select id='indexCardSelect' class=\"selectpicker\" >";
                        for(var i=0; i<indexList.length; i++) {
                            var indexCardObj = indexList[i];
                            if(indexCardObj.id == indexCard.id) {
                                html += "<option selected value='"+indexCardObj.id+"' >"+indexCardObj.name+"</option>";
                            }else {
                                html += "<option value='"+indexCardObj.id+"' >"+indexCardObj.name+"</option>";
                            }
                        }
                        html += "</select>";
                        html += "<table style='margin-top: 10px' id='indexValTab'>";
                        for(var i=0; i<attrList.length; i++) {
                            var attrObj = attrList[i];
                            var attrId = attrObj.attrId;
                            var attrName = attrObj.attrName;
                            var attrType = attrObj.attrType;
                            var value = attrObj.value;
                            var refId = attrObj.refId;
                            var valId = attrObj.valId;

                    var defValue = '';
                    var defId = '';
                    var htmValue = '';
                    var itype = '';

                    if(attrType == '2') {
                        itype = "onkeyup=\"value=value.replace(/[^\\"+"d]/g,\'\')\"";
                    }
                    if(attrType == '3') {
                        itype = 'id="timdate" lay-key="'+ n +'"';
                    }
                    if(attrType == '4') {
                        commobj.doGet(G.paths+'indexCard/attrValueList?attrId='+refId,false,function(result3) {
                           if (result3.code == 200) {
                            var vList = result3.list;
                            for(var i=0; i<vList.length; i++) {
                               var vObj = vList[i];
                               var defValue = vObj.value;
                               var defId = vObj.id;
                               if(valId == defId){
                               htmValue += "<option selected value=\""+defId+"\">"+defValue+"</option>";
                           }else{
                               htmValue += "<option value=\""+defId+"\">"+defValue+"</option>";
                           }
                           } }

                              html += "<tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+attrName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <select id='valid' style='margin-top: 5px' class=\"indexCardAttr\" attrId=\""+attrId+"\" attrName=\""+attrName+"\" refId=\""+refId+"\" attrType=\""+attrType+"\" >" + htmValue +
                        "                </select></td>\n" +
                        "            </tr>";
                        });
                    }else{
                            html += "<tr>\n" +
                                "                <td>\n" +
                                "                    <span id=\"CDD\">"+attrName+"</span>\n" +
                                "                </td>\n" +
                                "            </tr>\n" +
                                "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                                "                <td>\n" +
                                "                    <input style='margin-top: 5px' " + itype +
                                "                   class=\"indexCardAttr\" " +
                                "                   attrId=\""+attrId+"\"" +
                                "                   attrName=\""+attrName+"\" " +
                                "                   attrType=\""+attrType+"\" " +
                                "                   value=\""+value+"\"\n" +
                                "                ></td>\n" +
                                "            </tr>";
                        }}
                        $("#indexCardTabDiv").empty();
                        $("#indexCardTabDiv").append(html);
                        loadjs("/static/js/dms/layerdate.js","js")
                        $('.selectpicker').selectpicker({
                            style: 'btn-info',
                            size: 4
                        });
                        $('.selectpicker').change(function () {
                            var indexId = $("#indexCardSelect option:selected").val();
                            console.log("indexCardSelect option:selected id:"+indexId);
                            indexCardId = indexId;
                            changeIndexCard(indexId);
                        });
                    }
                });
            }
        });
    }

    function changeIndexCard(indexCardId) {
        
        commobj.doGet(G.paths+'indexCard/attrList?indexCardId='+indexCardId,false,function(result) {
            if (result.code == 200) {
                var attrList = result.list;
                if(attrList.length == 0) {
                    commobj.showToast(LNG.indexCard_no_attributes,2);
                    result;
                }
                var html = "";
                for(var i=0; i<attrList.length; i++) {
                    var attrObj = attrList[i];
                    var attrId = attrObj.id;
                    var attrName = attrObj.name;
                    var attrType = attrObj.attrType;
                    var refId = attrObj.refId;
                    var defValue = '';
                    var defId = '';
                    var htmValue = '';
                    var itype = '';

                    if(attrType == '2') {
                        itype = "onkeyup=\"value=value.replace(/[^\\"+"d]/g,\'\')\"";
                    }
                    if(attrType == '3') {
                        itype = 'id="timdate" lay-key="'+ n +'"';
                    }
                    if(attrType == '4') {
                        commobj.doGet(G.paths+'indexCard/attrValueList?attrId='+refId,false,function(result3) {
                           if (result3.code == 200) {
                            var vList = result3.list;
                            for(var i=0; i<vList.length; i++) {
                               var vObj = vList[i];
                               var defValue = vObj.value;
                               var defId = vObj.id;
                               htmValue += "<option value=\""+defValue+"\">"+defValue+"</option>";
                           } }

                              html += "<tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+attrName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <select style='margin-top: 5px' class=\"indexCardAttr\" attrId=\""+attrId+"\" attrName=\""+attrName+"\" attrType=\""+attrType+"\" >" + htmValue +
                        "                </select></td>\n" +
                        "            </tr>";
                        });
                    }else{
                    html += "<tr>\n" +
                        "                <td>\n" +
                        "                    <span id=\"CDD\">"+attrName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <input style='margin-top: 5px' " + itype +
                        "                   class=\"indexCardAttr\" " +
                        "                   attrId=\""+attrId+"\"" +
                        "                   attrName=\""+attrName+"\" " +
                        "                   attrType=\""+attrType+"\" " +
                        "                   value=\""+defValue+"\"\n" +
                        "                </td>\n" +
                        "            </tr>";
                }}
                $("#indexValTab").empty();
                $("#indexValTab").append(html);
                loadjs("/static/js/dms/layerdate.js","js")
            }
        });
    }
</script>
