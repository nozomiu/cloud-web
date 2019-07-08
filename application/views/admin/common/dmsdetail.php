<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
?>
<div id="dmsDetailTabDiv">
    
    <div id="detailContentDiv">
        
        <ul>
            <li>
                    <span class="cd"><?php echo $this->lang->line('name');?></span>
            </li>
            <li>
                    <span class="showSpan" id="nameSpan"></span>
                    <input class="showUpdate" id="nameInput" name="name" value="" style="display: none">
            </li>

            <li>
                    <span class="cd"><?php echo $this->lang->line('description');?></span>
            </li>
            <li>
                    <span class="showSpan" id="descSpan" style='cursor: pointer;width: 200px; display: inline-block;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;'>
                    </span>
                    <textarea class="showUpdate" id="descInput" name="description" value="" style="display: none">
                    </textarea>
            </li>
            <hr class="line wend">
            <li class="documentDetail">
                    <span class="cd"><?php echo $this->lang->line('Now_version');?>：</span><span id="versionSpan"></span>
            </li>
            <li class="isword">
                    <span class="cd"><?php echo $this->lang->line('fSize');?>：</span><span id="sizeStr"></span>
            </li>
            <li class="isword">
                    <span class="cd"><?php echo $this->lang->line('lockState');?>：</span><span id="lockState"></span>
            </li>
            <div class="locked">
                <li>
                    <span class="cd"><?php echo $this->lang->line('lockName');?>：</span><span id="lockName"></span>
                </li>
                <li>
                    <span class="cd"><?php echo $this->lang->line('lockTime');?>：</span><span id="lockTime"></span>
                </li>
            </div>
            <hr class="line">
            <li>
                    <span class="cd"><?php echo $this->lang->line('createdByName');?>：</span><span id="createdBySpan"></span>
            </li>

            <li>
                    <span class="cd"><?php echo $this->lang->line('createdDt');?>：</span><span id="createdDtSpan"></span>
            </li>

            <li>
                    <span class="cd"><?php echo $this->lang->line('updatedByname');?>：</span><span id="updatedBySpan"></span>
            </li>

            <li>
                    <span class="cd"><?php echo $this->lang->line('updatedDt');?>：</span><span id="updatedDtSpan"></span>
            </li>
            <hr class="line">
            <span id="showUpdateBtn" title="<?php echo $this->lang->line('Modify');?>" onclick="changeToUpdate()" class='btn btn-xs btn-xs btn-green' style="display: ;"><?php echo $this->lang->line('Modify');?></span>
            <span id="saveUpdateDmsBtn" title="<?php echo $this->lang->line('save');?>" onclick="updateDms()" class='btn btn-xs btn-xs btn-green' style="display: none;"><?php echo $this->lang->line('save');?></span>
        </ul>
    </div>
</div>
<script type="application/javascript">
    var objId = '<?php echo $this->input->get('id');?>';
    var revId = '';

    $(document).ready(function(){
        console.log("objId :"+ objId);
        if(objId != '') {
            var objType = objId % 100;
            var detailUrl = '';
            if(objType == 31) {
                detailUrl = G.paths+'cabinet/detail?id='+objId;
                $(".locked").css("display","none");
                $(".wend").css("display","none");
            }else if(objType == 32) {
                detailUrl = G.paths+'folder/detail?id='+objId;
                $(".locked").css("display","none");
                $(".wend").css("display","none");
            }else if(objType == 33 || objType == 34){
                detailUrl = G.paths+'document/detail?id='+objId+"&revId="+revId;
                $(".locked").css("display","");
                $(".wend").css("display","");
            }
            commobj.doGet(detailUrl,false,function(result){
                if(result.code == 200) {
                    var folder = result.data;
                    var lockState;
                    if(!folder) {
                        return;
                    }
                    if(folder.lockState == 0){
                        lockState=LNG.Nolocked;
                        $(".locked").css("display","none");
                    }
                    if(folder.lockState == 1){
                        lockState=LNG.locked;
                        $(".locked").css("display","");
                    }

                    $("#dmsDetailEmptyImg").css("display","none");
                    $("#detailContent").css("display","");
                    var name = folder.name;
                    rname = commobj.dereplace(name);
                    $("#nameSpan").html(rname);
                    $("#nameInput").val(rname);
                    $("#descSpan").html(folder.description);
                    $("#descInput").val(folder.description);
                    $("#descSpan").attr('title',folder.description);

                    $("#createdBySpan").html(folder.createdByName);
                    $("#createdDtSpan").html(folder.createdDt);
                    $("#sizeStr").html(folder.sizeStr);
                    $("#lockState").html(lockState);
                    $("#lockName").html(folder.lockUserName);
                    $("#lockTime").html(folder.lockTime);

                    $("#updatedBySpan").html(folder.updatedByName);
                    $("#updatedDtSpan").html(folder.updatedDt);
                    var objType = folder.objType;
                    if(objType == 33) {
                        $(".documentDetail").css("display","");
                        $(".isword").css("display","");
                        $("#versionSpan").html(folder.revNum);
                    }else {
                        $(".documentDetail").css("display","none");
                        $(".isword").css("display","none");
                    }
                }else if(result.code == 501){
                    commobj.showToast(LNG.D_C_P_D,2);
                    parent.location.reload()
                }
            });
        }
    });
    
    function changeToUpdate() {
        commobj.doGet(G.paths+"permission/check?rights=64&objIds="+objId,false,function(result){
            if(result.code == 200){
                var permissionRet = result.data;
                var hasRight = permissionRet.hasRights[0];
                console.log('hasRight'+hasRight);
                if(hasRight) {
                    $(".showSpan").css('display','none');
                    $(".showUpdate").css('display','');
                    $("#showUpdateBtn").css('display','none');
                    $("#saveUpdateDmsBtn").css('display','');
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
    
    function updateDms() {
        var objId = '<?php echo $this->input->get('id');?>';
        var objType = objId % 100;
        var moduleType = dmsListObj.getSelectModuleType();
        var name = $("#nameInput").val();
        var description = $("#descInput").val();
        if(!name || name == '') {
            commobj.showToast(LNG.NO_K,2);
            return;
        }

        var params = {};
        params.id = objId;
        params.name = name;
        params.description = description;
        commobj.doPost(G.paths+'dms/update',params,false,function(result){
            if(result.code == 200) {
                delCookie('currentNodeid');
                delCookie('currentNodetext');
                commobj.showToast(LNG.modify_successfully,1);
                if(objType == 31){
                    if(moduleType == '2') {
                        myDocumentTreeObj.initMyDocTree(2);
                    }else if(moduleType == '3'){
                        orgDocumentTreeObj.initOrgDocTree(2);
                    }
                }else if(objType == 32){
                if(moduleType == '2') {
                    myDocumentTreeObj.selectTreeNode("#myDocumentTree", name, dmsListObj.prtDmsId, dmsListObj.prtDmsName);
                }else if(moduleType == '3') {
                    orgDocumentTreeObj.selectTreeNode("#orgDocumentTree", name, dmsListObj.prtDmsId, dmsListObj.prtDmsName);
                }
                }
                dmsListObj.refresh();
                $(".showSpan").css('display','');
                $(".showUpdate").css('display','none');
                $("#showUpdateBtn").css('display','');
                $("#saveUpdateDmsBtn").css('display','none');

                $("#nameSpan").html(name);
                $("#descSpan").html(description);
                $("#descSpan").attr('title',description);
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