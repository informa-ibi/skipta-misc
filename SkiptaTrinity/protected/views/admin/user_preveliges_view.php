<?php if(is_array($userActions)){ ?>
 <div class="h_center fontbold"><?php echo $UserName ?></div>
<div style="position: relative">
    <div  class="block">
        <div class="block-heading" data-toggle="collapse">User Privileges</div>
        <div id="tablewidget" class="block-body collapse in " style="margin: auto;">
            <table class="table table-hover">                    
                <tbody>                        
                    <?php foreach ($userActions["data"] as $value) {?>   
                    <tr class="odd <?php if($value["defaultRole"]==1){echo "defaultRole";}?>">
                <td>
                    <?php echo $value["DisplayLabel"]?>
                </td>
                <td>                          
                    <input class="styled" type="checkbox" name="actionItem" value="<?php echo $value["Id"]; ?>" <?php echo $value["Status"]==1?"checked":""; ?> id="<?php echo $value["Id"]; ?>" />
                </td>
                </tr>
                <?php } ?>
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
