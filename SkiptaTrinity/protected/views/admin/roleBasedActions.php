<?php if(is_array($roleBasedActions)){ ?>

<div style="position: relative">
        <div  class="block">
            <div class="block-heading" data-toggle="collapse">Role Actions</div>
            <div id="tablewidget" class="block-body collapse in " style="margin: auto;">
                <div id="spinner_admin"></div>
                <table class="table table-hover">                    
                    <tbody>                        
                        <?php foreach($roleBasedActions as $roleAction){?>
                            <tr class="odd">
                    <input type="hidden" value="<?php echo $roleAction['Id']?>" id="roleId"/>
                                <td>
                                    <?php echo $roleAction['DisplayLabel']?>
                                </td>
                                <td>                          
                                    <input type="checkbox" name="actionItem" class="styled" value="<?php echo $roleAction['Id']?>" <?php if($roleAction['Status']==1){?> checked<?php }?> />
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
              </div>
            <div class="modal-footer" id="myModal_footer">
                <button type="button" class="btn" onclick="updateRoleActions()" id="myModal_saveButton">Update</button>
                        </div>
</div>
 
</div>
<?php }else{
    echo "No Data Found"?>

<?php }?>
<script type="text/javascript">
 $(function(){
   Custom.init(); 
});
</script>