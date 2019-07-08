<?php
$lang = $this->session->lang;
$this->lang->load('main', $lang);
?>

<div id="docPermissionTabDiv">

    <input id="permissionObjId" value="<?php echo $this->input->get('id');?>" type="hidden">
    <div id="permission_M">
        <table>
            <tr style="height: 40px;">
                <td valign="top" id="CDD" style="width: 80px;font-size: 16px;">
                    <?php echo $this->lang->line('My_permission');?>:
                </td>
                <td valign="top" style="font-size: 16px;">
                    <span id="myPermissionSpan"></span>
                </td>
            </tr>
        </table>
    </div>

    <div id="permission_S" style="display: none">
        <table>
            <tr>
                <td style="width: 80px; line-height: 30px; float: left">
                    <span id="permissionTypeSpan"></span>
                </td>
                <td style="width: 80px; line-height: 30px; float: left">
                    <span id="setPermissionBtn" title="<?php echo $this->lang->line('set_permission');?>" onclick="permissionObj.showSetPermission();" class="btn btn-xs btn-xs btn-green" style="cursor: pointer; display: none"><?php echo $this->lang->line('set_permission');?></span>
                </td>
                <td id="inheritTD" style="line-height: 30px; display: none; float: left">
                    <span style="margin-right: 3px"><?php echo $this->lang->line('Inherited_down');?></span>
                    <input type="hidden" id="inheritTypeInput">
                    <input id="inheritCheckBox" type="checkbox" onclick="changeInherit()" style="margin-top: -3px" >
                </td>
            </tr>
        </table>
    </div>
    <hr/>

    <div id="permissionTabDiv">
      
    </div>

</div>
<link href="/static/bootstrap-3.3.5/css/bootstrap-select.min.css" rel="stylesheet">
<link href="/static/css/blue.css" rel="stylesheet">
<link href="/static/css/jquery-confirm.min.css" rel="stylesheet">
<script type="application/javascript" src="/static/js/jquery-confirm.min.js"></script>
<script type="application/javascript" src="/static/js/dms/permission.js?t=<?php echo time();?>"/></script>
<script type="application/javascript" src="/static/js/bootstrap-select.min.js"/></script>
<script type="application/javascript" src="/static/js/icheck.min.js"/></script>

<script type="application/javascript">
    
    $(document).ready(function(){
        
        var id = '<?php echo $this->input->get('id');?>';
        console.log("id :"+ id);
        if(id != '') {
            permissionObj.showPermission(id);

        }

        $('#inheritCheckBox')
            .iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            })
            .on('ifClicked', function () {
                var inheritType = $("#inheritTypeInput").val();
                //console.log("ifClicked inheritType:"+inheritType);
                if(inheritType == 0) {
                    //原对象 未继承
                    permissionObj.inheritPermission(id);
                }else if(inheritType == 1) {
                    //原对象 已继承
                    permissionObj.unInheritPermission(id);
                }
            });
    });

</script>
<script>
