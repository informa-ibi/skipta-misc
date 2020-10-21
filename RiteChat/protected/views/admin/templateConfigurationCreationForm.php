
<div class="modal fade" id="addNewTemplateConfiguration" tabindex="-1" role="dialog" aria-labelledby="PasswordPoliciesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" id="NewHelpIcon_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div id="NewTemplateConfigurationLabel" style="display: none">
                                <h4 class="modal-title" >Template Configuration</h4>
                            </div>
                            <div id="UpdateTemplateConfigurationLabel" style="display: none">
                                <h4 class="modal-title" >Template Configuration</h4>
                            </div>
                            
                        </div>
                        <div>
                           
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'templateConfigurationCreation-form',
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
                            <div id="categoryCreationSpinLoader"></div>
                                <div class="signdiv">
                                    <div class="alert-error" id="errmsgForTemplateConfiguration" style='display: none'></div>
                                    <div class="alert-success" id="sucmsgForTemplateConfiguration" style='display: none'></div>          
                                    <div class="row-fluid">
                                        <div class="span12">
                                         <?php echo $form->hiddenField($templateConfigurationCreationForm,'id');?>
                                          
                                            
                                            
                                            <?php echo $form->labelEx($templateConfigurationCreationForm, Yii::t('translation', 'Title')); ?>
                                            <?php echo $form->textField($templateConfigurationCreationForm, 'title', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>
                                            <div class="control-group controlerror">
                                            <?php echo $form->error($templateConfigurationCreationForm, 'title'); ?>
                                            </div>
                                            
                                             <?php echo $form->labelEx($templateConfigurationCreationForm, Yii::t('translation', 'File Name')); ?>
                                             <?php echo $form->textField($templateConfigurationCreationForm, 'filename', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                             <?php //echo $form->hiddenField($emailConfigurationCreation, 'password', array('class' => 'span12')); ?>
                                            <div class="control-group controlerror">
                                                <?php echo $form->error($templateConfigurationCreationForm, 'filename'); ?>
                                            </div>
                                           
                                            
                                        </div>
                                    </div>
                                   
                                    <div class="headerbuttonpopup h_center padding8top">
                                        <?php
                                        echo CHtml::ajaxSubmitButton('Create', array('/admin/createNewTemplateConfiguration'), array(
                                            'type' => 'POST',
                                            'dataType' => 'json',
                                            'error' => 'function(error){
                                        }',
                                            'beforeSend' => 'function(){      scrollPleaseWait("categoryCreationSpinLoader","templateConfigurationCreation-form");
                                                }',
                                            'complete' => 'function(){
                                                    }',
                                            'success' => 'function(data,status,xhr) { templateConfigurationCreationHandler(data,status,xhr);}'), array('type' => 'submit', 'id' => 'newTemplateConfigurationId', 'class' => 'btn pull-right')
                                        );
                                        ?>
                                    </div>
                                    <?php echo CHtml::resetButton('Clear', array("id" => 'NewTemplateConfigurationReset', "style" => "display:none")); ?>

                                </div>
                                <?php $this->endWidget(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    
    $(document).ready(function($) {
        $("#NewTemplateConfigurationReset").click();
        
        getEmailConfiguredList();
   });
    
    function getEmailConfiguredList(){
        ajaxRequest("/admin/getEmailConfigurationDetails", '', getEmailListHandler);
        }
    function getEmailListHandler(data){
        $('#Email_RelatedTo option').remove();
        var dataArr=data.data;
        $.each(dataArr, function(i){
            if(dataArr[i].id != "")
                $('#Email_RelatedTo').append($("<option></option>")
            .attr("value",dataArr[i].Email)
            .text(dataArr[i].Email));
        });
    }

</script>