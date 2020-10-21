
<div class="modal fade" id="addNewNetworkParameter" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" id="addNewNetworkParametery_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div  >
                                
                                <h4 class="modal-title" id="addNewNetworkParameterLabel">New Configuration Paramter</h4>
                            </div>
<!--                            <div id="updateNetworkParameterLabel" style="display: none">
                                <h4 class="modal-title" >Update Curbside Category</h4>
                            </div>-->
                            
                        </div>
                        <div>
                           
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'newnetworkparameter-form',
                                        'enableClientValidation' => true,
                                        'enableAjaxValidation' => false,
                                        'clientOptions' => array(
                                            'validateOnSubmit' => true,
                                        ),
                                        //'action'=>Yii::app()->createUrl('//user/forgot'),
                                        'htmlOptions' => array(
                                            'style' => 'margin: 0px; accept-charset=UTF-8',
                                        ),
                                    ));
                                    ?>
                            <?php echo $form->hiddenField($model,"Id");?>
                            <?php echo $form->hiddenField($model,"Enable");?>
                            <div id="addNewNetworkParameterSpinLoader"></div>
                                <div class="signdiv">
                                    <div class="alert alert-error" id="errmsgForNewNetworkParameter" style='display: none'></div>
                                    <div class="alert alert-success" id="sucmsgForNewNetworkParameter" style='display: none'></div>          
                                    <div class="row-fluid">
                                        <div class="span12">
                                        <label for="NetworkConfigForm_Key">Key</label>
                                        <?php echo $form->textField($model, 'Key', array( 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>
                                        <div class="control-group controlerror">
                                            <?php echo $form->error($model, 'Key'); ?>
                                    </div>
                                            
                                            </div>
                                        
                                        <div class="span12" style="margin-left: 0px;padding-top: 10px;">
                                            <label for="NetworkConfigForm_Value">Value</label>
                                        <?php echo $form->textArea($model, 'Value', array( 'class' => 'styled span12 textfield')); ?>
                                        <div class="control-group controlerror">
                                            <?php echo $form->error($model, 'Value'); ?>
                                    </div>
                                            
                                        </div>
                                        
                                        <div class="span12" style="margin-left: 0px;padding-top: 10px;">                                            
                                            <input type="checkbox" class="styled checkbox"style="margin-top:4px" id="editable" value="" >Is this editable?
                                        </div>
                                    </div>
                                   
                                    <div class="headerbuttonpopup h_center padding8top">
                                        <?php echo CHtml::Button(Yii::t('translation', 'Save'), array('onclick' => 'saveParameterForm()', 'class' => 'btn btn-2 btn-2a pull-right', 'id' => 'newNetworkParameter')); ?> 
                                        
                                    </div>
                                    <?php echo CHtml::resetButton(Yii::t('translation', 'Clear'), array("id" => 'networkParameterReset', "style" => "display:none")); ?>

                                </div>
                                <?php $this->endWidget(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    Custom.init();
        $('input[type=text]').keypress(function(){
  $('#'+this.id+'_em_').fadeOut(2000);
});
    $(document).ready(function() {
        
        if(!detectDevices())
              $("[rel=tooltip]").tooltip();
        $("#NewCurbsideCategoryReset").click();
    });
 
 function saveParameterForm(){
     scrollPleaseWait("addNewNetworkParameterSpinLoader");
//        $("#newNetworkParameter").val("Please wait...");
        var enable = 1; // 1:disabled...
                if($('#editable').is(":checked")){
                    enable = 0;
                }
               $("#NetworkConfigForm_Enable").val(enable);
        var data=$("#newnetworkparameter-form").serialize();
        //        return;
        $.ajax({
            type: 'POST',
            dataType:'json',
            url: '<?php echo Yii::app()->createAbsoluteUrl("/admin/createNewParameter"); ?>',
            data:data,
            success:newNetworkConfigHandler,
            error: function(data) { // if error occured
                console.log("Error occured.please try again");
                
            }
        });
 }
    /*
     * Handler for requesting new category
     */
</script>