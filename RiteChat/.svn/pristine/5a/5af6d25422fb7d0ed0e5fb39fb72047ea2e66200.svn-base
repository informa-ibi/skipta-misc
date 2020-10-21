
<h2 class="pagetitle">Roles Management</h2>
<div class="row-fluid">
    
    <div  class="block span12">
        <div class="block-heading">Roles
        <div title="Create Role"  onclick="openAddRoleModelBox()" style="margin-left: 47px;margin-top: -39px;font-size:20px;cursor: pointer;">
                        <i class="fa fa-plus-circle"></i>
                        </div>
        </div>
      
        <div  class="padding10">
            
        <select id="roles"  class="textfield"  onchange="getRoleBasedAction();" name="role"> 

            <?php foreach ($userTypes as $value) { ?>                                                         
                <option   value=<?php echo $value['Id'] ?> > <?php echo $value['Name'] ?> </option>    
            <?php } ?>

        </select>
                      
                  
        </div>

    </div>

</div>
<div id="successMessage" class="alert alert-success" style="display: none"> </div>
<div id="errorMessage" class="alert alert-error" style="display: none"> </div>
<div id='spinner_admin_' style="position:relative;"></div>
<div id='roleActionsList'></div>
<script type="text/javascript">
    getRoleBasedAction();
</script>    
