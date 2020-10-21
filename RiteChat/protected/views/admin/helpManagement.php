<?php
include 'helpManagementScript.php';
include 'helpIconCreationForm.php';
?>
<?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
<?php $mainClass=(Yii::app()->params['Project']!='Trinity')?"streamsectionarea  streamsectionarearightpanelno":"";?>
<div class="<?php echo $mainClass ?>">             
        <div class="padding10 ">
<?php }?>
            <h2 class="pagetitle">Help Management</h2>
             <div class="alert-error" id="errmsgForHelpId" style='display: none'></div>
             <div class="alert-success" id="sucmsgForHelpId" style='display: none'></div>          
                                   
            <div id="helpCreationManagement_div"></div>
<?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
        </div>
    </div>
<?php }?>
<script type="text/javascript">
    getHelpIconListHandler(<?php echo $data; ?>);
</script>
