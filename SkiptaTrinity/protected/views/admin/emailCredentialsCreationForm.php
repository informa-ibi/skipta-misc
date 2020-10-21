
<div class="modal fade" id="addNewEmailConfiguration" tabindex="-1" role="dialog" aria-labelledby="PasswordPoliciesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" id="NewHelpIcon_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div id="NewEmailConfigurationLabel" style="display: none">
                                <h4 class="modal-title" >Email Configuration</h4>
                            </div>
                            <div id="UpdateEmailConfigurationLabel" style="display: none">
                                <h4 class="modal-title" >Email Configuration</h4>
                            </div>
                            
                        </div>
                        <div>
                           
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'emailConfigurationCreation-form',
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
                                    <div class="alert-error" id="errmsgForEmailConfiguration" style='display: none'></div>
                                    <div class="alert-success" id="sucmsgForEmailConfiguration" style='display: none'></div>          
                                    <div class="row-fluid">
                                        <div class="span12">
                                         <?php echo $form->hiddenField($emailConfigurationCreation,'id');?>
                                            <?php echo $form->hiddenField($emailConfigurationCreation,'encryption');?>
                                            
                                          
                                            <?php echo $form->labelEx($emailConfigurationCreation, Yii::t('translation', 'Configuration_Email')); ?>   
                                            <?php echo $form->textField($emailConfigurationCreation, 'email', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                            <div class="control-group controlerror">
                                                <?php echo $form->error($emailConfigurationCreation, 'email'); ?>
                                            </div>
                                            
                                             <?php echo $form->labelEx($emailConfigurationCreation, Yii::t('translation', 'Configuration_Password')); ?>
                                             <?php echo $form->textField($emailConfigurationCreation, 'password', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                            <div class="control-group controlerror">
                                                <?php echo $form->error($emailConfigurationCreation, 'password'); ?>
                                            </div>
                                            
                                            <?php echo $form->labelEx($emailConfigurationCreation, Yii::t('translation', 'Configuration_SMTPAddress')); ?>
                                            <?php echo $form->textField($emailConfigurationCreation, 'smtpaddress', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                            <div class="control-group controlerror">
                                                <?php echo $form->error($emailConfigurationCreation, 'smtpaddress'); ?>
                                            </div>
                                            
                                            
                                            <?php echo $form->labelEx($emailConfigurationCreation, Yii::t('translation', 'Configuration_Port')); ?>
                                            <?php echo $form->textField($emailConfigurationCreation, 'port', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                            <div class="control-group controlerror">
                                                <?php echo $form->error($emailConfigurationCreation, 'port'); ?>
                                            </div>
                                            
                                            
                                             <?php echo $form->labelEx($emailConfigurationCreation, Yii::t('translation', 'Configuration_Host')); ?>
                                            <?php echo $form->textField($emailConfigurationCreation, 'host', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                            <div class="control-group controlerror">
                                                <?php echo $form->error($emailConfigurationCreation, 'host'); ?>
                                            </div>
                                            
                                             <?php echo $form->labelEx($emailConfigurationCreation, Yii::t('translation', 'Configuration_Encryption')); ?>
                                            
                                            <?php $static = array(
                                            'ssl'     => Yii::t('fim','ssl'), 
                                            'nossl' => Yii::t('fim','no ssl'), 
                                            ); ?>

                                            <?php echo $form->dropDownList($emailConfigurationCreation,'encryption',$static,array('jobs'=>Yii::t('fim','Jobs'))); ?>
                                            <div class="control-group controlerror">
                                                <?php echo $form->error($emailConfigurationCreation, 'encryption'); ?>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="headerbuttonpopup h_center padding8top">
                                        <?php
                                        echo CHtml::ajaxSubmitButton('Create', array('/admin/createNewEmailConfiguration'), array(
                                            'type' => 'POST',
                                            'dataType' => 'json',
                                            'error' => 'function(error){
                                        }',
                                            'beforeSend' => 'function(){      scrollPleaseWait("categoryCreationSpinLoader","emailConfigurationCreation-form");
                                                }',
                                            'complete' => 'function(){
                                                    }',
                                            'success' => 'function(data,status,xhr) { emailConfigurationCreationHandler(data,status,xhr);}'), array('type' => 'submit', 'id' => 'newEmailConfigurationId', 'class' => 'btn pull-right')
                                        );
                                        ?>
                                    </div>
                                    <?php echo CHtml::resetButton(Yii::t('translation', 'Clear'), array("id" => 'NewEmailConfigurationReset', "style" => "display:none")); ?>

                                </div>
                                <?php $this->endWidget(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    
    $(document).ready(function($) {
        $("#NewEmailConfigurationReset").click();
    });

</script>