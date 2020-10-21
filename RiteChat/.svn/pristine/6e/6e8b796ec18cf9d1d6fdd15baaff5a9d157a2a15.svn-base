<?php
include 'configurationScript.php';
include 'AddNewNetworkParameter.php';
?>
<?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
<?php $mainClass=(Yii::app()->params['Project']!='Trinity')?"streamsectionarea  streamsectionarearightpanelno":"";?>
<div class="<?php echo $mainClass ?>">
        <div class="padding10 ">
<?php }?>
            <h2 class="pagetitle">Network Configuration</h2>
            
            <div id="configuration_div"></div>
<?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
        </div>
    </div>
<?php }?>
<div id='configlist'></div>
<script type="text/javascript">
//    alert('<?php echo $data; ?>');
    getConfigurationHandler(<?php echo $data; ?>);
    function createNewConfig(){
        $("#networkParameterReset").trigger('click');
        $("#NetworkConfigForm_Key_em_").hide();
        $("#NetworkConfigForm_Key").removeAttr("readonly");
        $("#NetworkConfigForm_Value_em_").hide();
        $("#NetworkConfigForm_Id").val("");
        $("#newnetworkparameter-form")[0].reset();
        $("#newNetworkParameter").val("Create");
        $(".checkbox").attr("style","background-position: 0px 0px;");
        $("#addNewNetworkParameterLabel").html("New Configuration Paramter");
        $("#addNewNetworkParameter").modal('show');        
    }
    
    $(".editparameter").live("click",function(){
       var paramterId = $(this).data("id");
       var queryString = "id="+paramterId;
       ajaxRequest("/admin/editNetworkParamter",queryString,editParameterHandler);
    });
    
    function editParameterHandler(data){
        data = data.data;
        
        $("#newNetworkParameter").val("Update");
        $("#networkParameterReset").click();
        $("#NetworkConfigForm_Id").val(data.Id);
        if(data.Enable == 0){
            $(".checkbox").attr("style","background-position: 0px -50px;");
            $('#editable').prop('checked', true);
            $("#NetworkConfigForm_Enable").val(1);
        }
        $("#NetworkConfigForm_Key").val(data.Key).attr("readonly","true");
        $("#NetworkConfigForm_Value").val(data.Value);
        $("#addNewNetworkParameterLabel").html("Edit Network Paramter");
        $("#addNewNetworkParameter").modal('show');        
        
    }
</script>    
