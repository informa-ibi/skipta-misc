<?php if(is_array($data)){ 
    

    
    ?>
 <div class="h_center fontbold"><?php echo $UserName ?></div>
<div style="position: relative">
    <div  class="block">
        <div class="block-heading" data-toggle="collapse">User IdentityType</div>
        <div id="tablewidget" class="block-body collapse in " style="margin: auto;">
            <table class="table table-hover">                    
                <tbody>                        
                  
                    <tr class="odd <?php if($data["defaultRole"]==1){echo "defaultRole";}?>">
                <td>
                     <label><?php echo Yii::t('translation','User_IdentityType_Change'); ?> </label>
                </td>
                <td>  
                    <div class="row-fluid">
                            <div class="span12">
                                <div class=" span8 tabletopcorner" >
                                    
                                    <select name="UserIdentityType" id="UserIdentityType"  onChange="saveUserType(this,<?php echo $data['UserId']; ?>);" class="styled textfield " >
                                        <option value="0" <?php if ($data['UserIdentityType'] == 0) {
        echo "selected";
    } ?> ><?php echo Yii::t('translation', 'User_Type_Normal'); ?></option>
                                        <option value="1" <?php if ($data['UserIdentityType'] == 1) {
        echo "selected";
    } ?> ><?php echo Yii::t('translation', 'User_Type_Tech'); ?></option>
                                        <option value="2" <?php if ($data['UserIdentityType'] == 2) {
        echo "selected";
    } ?> ><?php echo Yii::t('translation', 'User_Type_Business'); ?></option>
                                    </select>

                                </div>
                            </div>
                        </div>
                </td>
                </tr>
                
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php } ?>
<script type="text/javascript">
$(function(){
   Custom.init(); 
});
</script>