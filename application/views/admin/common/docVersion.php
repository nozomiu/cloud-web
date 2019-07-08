<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
$mType = $this->session->mType;
?>
<div id="docVersionTabDiv" >
    <img id="docVersionImg" style="margin-left: 120px;margin-top: 30px" src="/static/images/warning.png">
</div>
<script type="application/javascript">
    $(document).ready(function(){
        var id = '<?php echo $this->input->get('id');?>';
        console.log("id :"+ id);  

        if(id != '') {
            var objType = id%100;
            if(objType == '33') {
                showDocRevision(id);
            }
        }
    });
    function showDocRevision(id) {
        commobj.doGet(G.paths+'document/revList?docId='+id,false,function(result) {
            if (result.code == 200) {

                $("#versionContent").css('display','');
                var mType = '<?php echo $mType;?>';
                if(mType =='2'){
                mType = 'display:none';
                }
                var revs = result.list;
                if(!revs || revs.length<=0) {
                    return;
                }
                $("#docVersionImg").css('display','none');
                for(var i=0; i<revs.length; i++) {
                    var rev = revs[i];

                    var html = "<div>\n" +
                        "        <table>\n" +
                        "            <tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.filename+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <span >"+rev.fileName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.revNum+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <span >"+rev.revNum+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.updatedDt+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <span >"+rev.updatedDt+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr>\n" +
                        "                <td>\n" +
                        "                    <span class=\"cc\">"+LNG.updatedByname+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr style=\"height: 30px;vertical-align: top;\">\n" +
                        "                <td>\n" +
                        "                    <span >"+rev.updatedByName+"</span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "            <tr>\n" +
                        "                <td style=\"padding-top: 5px\">\n" +
                        "                    <span title=\""+LNG.preview+"\" onclick=\"openDocumentVersion('"+rev.docId+"','"+rev.id+"')\" class=\"open\" style=\"cursor: pointer;padding-left: 5px\"><i class=\"font-icon icon-external-link\"></i></span>\n" +
                        "                    <span title=\""+LNG.download+"\" onclick=\"downloadDocumentVersion('"+rev.docId+"','"+rev.id+"')\" class=\"down\" style=\"cursor: pointer;\"><i class=\"font-icon icon-cloud-download\"></i></span>\n" +
                        "                    <span title=\""+LNG.up_version+"\" onclick=\"promoteVersion('"+rev.docId+"','"+rev.id+"')\" class=\"upload\" style=\"cursor: pointer;\"><i class=\"font-icon icon-cloud-upload\"></i></span>\n" +
                        "                    <span title=\""+LNG.delete+"\" onclick=\"deleteVersion('"+rev.docId+"','"+rev.id+"')\" class=\"remove\" style=\"cursor: pointer;\"><i class=\"font-icon icon-trash\"></i></span>\n" +
                        "                    <span title=\""+LNG.share+"\" onclick=\"showShareDialog('"+rev.docId+"','"+rev.id+"','"+rev.fileName+"')\" class=\"share\" style=\"cursor: pointer;"+mType+"\"><i class=\"font-icon icon-share-sign\"></i></span>\n" +
                        "                </td>\n" +
                        "            </tr>\n" +
                        "        </table>\n" +
                        "    </div>\n" +
                        "    <hr/>";
                    $("#docVersionTabDiv").append(html);
                }
            }else if(result.code == 501){
                commobj.showToast(LNG.D_C_P_D,2);
                    parent.location.reload()
                }
        });
    }
    
    function openDocumentVersion(docId, revId) {
        var viewType = $("#viewType", parent.document).val();
        var windowType = $("#windowType", parent.document).val();
        console.log("openDocumentVersion docId="+docId+" revId="+revId);
        commobj.doGet(G.paths+'permission/check?rights=2&objIds='+docId,false,function (result) {
            if (result.code == 200) {
                        var permissionRet = result.data;
                        var hasRight = permissionRet.hasRights[0];
                        if (hasRight) {
                            var params = {};
                            params.id = docId;
                            params.currentRev = revId;
                            console.log(params);
                            commobj.doPost(G.paths+'document/preView',params,false,function(results){
                            
                            if(results.code == 200) {
                            if(viewType == 1){
                                ViewUrl = results.data.flexUrl;
                            }if(viewType == 2){
                                ViewUrl = results.data.onlyUrl;
                            }}
                        });
                            if(windowType == 2){
                            layer.closeAll();
                            layer.open({
                                type: 2,
                                title: '<i class="font-icon icon-eye-open"></i>' + LNG.online_view,
                                shadeClose: true,
                                shade: 0.2,
                                area: ['96%', '96%'],
                                content: ViewUrl
                            })
                        }else if(windowType == 1){
                            window.open(ViewUrl);
                            }
                        } else {
                            commobj.showToast(LNG.not_read_permission, 2)
                        }
                    } else if (result.code == 1001) {
                        commobj.showToast(LNG.ListNQ, 2)
                    }  else {
                var msg = result.message;
                if(msg) {
                    commobj.showToast(msg,2);
                }else {
                    commobj.showToast(LNG.system_error,3);
                }
            }
        });
    }

    function downloadDocumentVersion(docId, revId) {
        console.log("downloadDocumentVersion docId="+docId+" revId="+revId);
        var params = {};
        params.id = docId;
        params.currentRev = revId;

        commobj.doPost(G.paths+'document/preDownload',params,false,function(result){
            if(result.code == 200) {
                var downloadUrl = result.data;
                window.open(downloadUrl);
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

    function promoteVersion(docId, revId) {
        console.log(G.paths+"promoteVersion docId="+docId+" revId="+revId);
        var params = {};
        params.docId = docId;
        params.id = revId;

        commobj.doPost(G.paths+'revision/promote',params,false,function(result){
            if(result.code == 200) {
                $("#docVersionTabDiv").html("");
                showDocRevision(docId);
                commobj.showToast(LNG.Version_up_success,1);
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

    function deleteVersion(docId, revId) {
        console.log("promoteVersion docId="+docId+" revId="+revId);
        var params = {};
        params.docId = docId;
        params.id = revId;

        commobj.doPost(G.paths+'revision/rdelete',params,false,function(result){
            if(result.code == 200) {
                $("#docVersionTabDiv").html("");
                showDocRevision(docId);
                commobj.showToast(LNG.Version_delete_success,1);
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
    
    function showShareDialog(docId, revId, fileName) {
        commobj.doGet(G.paths+"permission/check?rights=128&objIds="+docId,false,function(result){
            if(result.code == 200){
                var permissionRet = result.data;
                var hasRight = permissionRet.hasRights[0];
                if(hasRight) {
                    $("#curlDocId").val(docId);
                    $("#curlRevId").val(revId);
                    $("#curlRevName").val(fileName);
                    $("#shareDialog").modal("show");
                }else {
                    commobj.showToast(LNG.not_permission_modify,2);
                }
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
</script>