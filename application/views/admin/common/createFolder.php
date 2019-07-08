<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
$prtId = $this->input->get('prtId');
?>
<div id="createFolder">
    <ul id="ul_<?php echo $prtId;?>" prtId="<?php echo $prtId;?>">
        <li style="margin:0 0 10px 0">
            <span title='<?php echo $this->lang->line('Add_subfolders');?>' style="cursor: pointer; " class="btn btn-xs btn-green" onclick="addSubFolderInput('<?php echo $prtId;?>')"><i class="font-icon icon-plus"></i></span>
        </li>

    </ul>
</div>

<script type="application/javascript">

    function addSubFolderInput(prtId) {
        console.log("addSubFolder prtId:"+prtId);
        $("#ul_"+prtId).append("<li style='margin-top: 10px;'>" +
            "<input type='text' class='FolderN' placeholder='"+LNG.folder_name+"'>" +
            "<span  title='"+LNG.save+"' onclick=\"addFolder(this,'"+prtId+"')\" class=\"pl1 btn btn-xs btn-green\">"+LNG.save+"</span>\n" +
            "</li>");
    }
    
    function addFolder(spanOk, prtId) {
        console.log("addFolder prtId:"+prtId);
        var prtLi = $(spanOk).parent();
        var input = prtLi.children("input:first-child");
        var fldName = input.val();
        var fldId = input.attr("fldId");
        //检查文件名称
        var validFldName = checkFolderName(fldId, fldName, prtId);
        if(!validFldName) {
            return;
        }

        var folderRet = createFolder(fldId, fldName, prtId);
        //console.log("folderRet  :"+JSON.stringify(folderRet));
        if(!folderRet) {
            input.attr("disabled",false);
            return;
        }
        fldId = folderRet.id;
        //console.log("addFolder fldName:"+fldName+" fldId:"+fldId);

        input.attr("fldId",fldId);
        prtLi.append(" <span title='"+LNG.Modify_folder+"' onclick=\"showUpdateFolderInput(this,'"+fldId+"')\" style=\"display: none\" class=\"pl1 btn-xs btn-pencil\"><i class=\"font-icon icon-folder-close\"></i></span>\n");
        prtLi.append(" <span  title='"+LNG.save+"' onclick=\"UpFolder(this,'"+prtId+"')\" class=\"pl1 btn btn-xs btn-green Up\">"+LNG.save+"</span>\n");
        prtLi.append(" <span title='"+LNG.Add_subfolders+"' onclick=\"addSubFolderInput('"+fldId+"')\" style=\"display: none\" class=\"pl1 btn-xs\"><i class=\"font-icon icon-plus\"></i></span>\n");
        prtLi.append("<li>\n" +
            "                <ul id='ul_"+fldId+"'>\n" +
            "                </ul>\n" +
            "            </li>");
        prtLi.children(".btn-xs").css("display","");
        prtLi.children(".btn-green").css("display","none");
    }
function UpFolder(spanOk, prtId) {
        console.log("addFolder prtId:"+prtId);
        var prtLi = $(spanOk).parent();
        var input = prtLi.children("input:first-child");
        var fldName = input.val();
        var fldId = input.attr("fldId");
        //检查文件名称
        var validFldName = checkFolderName(fldId, fldName, prtId);
        if(!validFldName) {
            return;
        }
        input.attr("disabled",true);
        //console.log("addFolder fldName:"+fldName+" prtId:"+prtId);

        var folderRet = createFolder(fldId, fldName, prtId);
        //console.log("folderRet  :"+folderRet);
        if(!folderRet) {
            input.attr("disabled",false);
            return;
        }
        fldId = folderRet.id;
        //console.log("addFolder fldName:"+fldName+" fldId:"+fldId);

        input.attr("fldId",fldId);
        prtLi.children(".btn-xs").css("display","");
        prtLi.children(".btn-green").css("display","none");
    }
    function checkFolderName(fldId, fldName,prtId) {
        var isPass = true;
        if(fldName == null || $.trim(fldName) == '') {
            commobj.showToast(LNG.enter_a_folder_name,2);
            return false;
        }
        var url = G.paths+'folder/checkName?name='+encodeURIComponent(fldName)+'&prtId='+prtId;
        if(fldId) {
            url = url+'&id='+fldId;
        }
        console.log("url:"+url);
        commobj.doGet(url,false,function(result){
            if(result.code!=200) {
                commobj.showToast(LNG.already_exists,2);
                isPass = false;
            }
        });
        return isPass;
    }
    
    function createFolder(fldId, fldName, prtId) {
        var params = {};
        params.prtId = prtId;
        params.name = fldName;
        var folder = null;
        var moduleType = dmsListObj.getSelectModuleType();
        if(fldId) {
            params.id = fldId;
            commobj.doPost(G.paths+'folder/update',params,false,function(result){
                if(result.code == 200) {
                    if(moduleType == 2){
                        myDocumentTreeObj.selectTreeNode("#myDocumentTree", fldName, dmsListObj.prtDmsId, dmsListObj.prtDmsName);
                    }else if(moduleType == 3){
                        orgDocumentTreeObj.selectTreeNode("#orgDocumentTree", fldName, dmsListObj.prtDmsId, dmsListObj.prtDmsName);
                    }
                    
                    commobj.showToast(LNG.modified_successfully,1);
                    folder = {};
                    folder.id = fldId;
                }else {
                    var msg = result.message;
                    if(msg) {
                        commobj.showToast(msg,2);
                    }else {
                        commobj.showToast(LNG.system_error,3);
                    }
                }
            });
        }else {
            commobj.doPost(G.paths+'folder/create',params,false,function(result){
                if(result.code == 200) {
                    if(moduleType == 2){
                        myDocumentTreeObj.selectTreeNode("#myDocumentTree", fldName, dmsListObj.prtDmsId, dmsListObj.prtDmsName);
                    }else if(moduleType == 3){
                        orgDocumentTreeObj.selectTreeNode("#orgDocumentTree", fldName, dmsListObj.prtDmsId, dmsListObj.prtDmsName);
                    }
                    commobj.showToast(LNG.created_successfully,1);
                    folder = result.data;
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
        return folder;
    }
    
    function showUpdateFolderInput(spanUpdate, fldId) {
        var prtLi = $(spanUpdate).parent();
        var input = prtLi.children("input:first-child");
        input.attr("disabled",false);
        prtLi.children(".btn-pencil").css("display","none");
        prtLi.children(".Up").css("display","");
    }
</script>