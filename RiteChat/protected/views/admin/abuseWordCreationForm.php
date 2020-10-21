<div class="modal fade" id="addNewAbuseWord" tabindex="-1" role="dialog" aria-labelledby="PasswordPoliciesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" id="NewAbuseWord_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div id="NewAbuseWordLabel" style="display: none">
                                <h4 class="modal-title" ><?php echo Yii::t('translation', 'Create_Block_Word') ?></h4>
                            </div>
                            <div id="UpdateAbuseWordLabel" style="display: none">
                                <h4 class="modal-title" ><?php echo Yii::t('translation', 'Update_Block_Word') ?></h4>
                            </div>
                            
                        </div>
                        <div>
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'abuseWordCreation-form',
                                //'enableClientValidation' => true,
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
                            <div id="abuseWordCreationSpinLoader"></div>
                                <div class="signdiv">
                                    <div class="alert alert-error" id="errmsgForCreateAbuseWord" style='display: none'></div>
                                    <div class="alert alert-success" id="sucmsgForCreateAbuseWord" style='display: none'></div>          
                                    <div class="row-fluid">
                                        <div class="span12">
                                         <?php echo $form->hiddenField($abuseWordCreation,"id");?>
                                        
                                                     <?php echo $form->label($abuseWordCreation, Yii::t('translation', 'AbuseWord')); ?>   
                                                        <?php echo $form->textField($abuseWordCreation, 'AbuseWord', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                                        <?php echo $form->textArea($abuseWordCreation, 'AbuseWord', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                                        <div class="control-group controlerror">
                                                    <?php echo $form->error($abuseWordCreation, 'AbuseWord'); ?>
                                                </div>
                                                  
                                        </div>
                                        
                                    </div>
                                   <?php echo $form->hiddenField($abuseWordCreation,'artifacts',array('value'=>'')); ?>
                                    <div class="headerbuttonpopup h_center padding8top">
                                        <?php
                                        echo CHtml::ajaxSubmitButton('Create', array('/admin/createnewabuseword'), array(
                                            'type' => 'POST',
                                            'dataType' => 'json',
                                            'error' => 'function(error){
                                        }',
                                            'beforeSend' => 'function(){  
                                                
                                                //scrollPleaseWait("abuseWordCreationSpinLoader","abuseWordCreation-form");
                                                }',
                                            'complete' => 'function(){
                                                
                                                    }',
                                            'success' => 'function(data,status,xhr) {abuseWordCreationHandler(data,status,xhr);}'), array('type' => 'submit', 'id' => 'newAbuseWordId', 'class' => 'btn btn-2 btn-2a pull-right')
                                        );
                                        ?>
                                    </div>
                                    <?php echo CHtml::resetButton('Clear', array("id" => 'NewAbuseWordReset', "style" => "display:none")); ?>

                                </div>
                                <?php $this->endWidget(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
<script>
    
        $('input[type=text]').keypress(function(){
  $('#'+this.id+'_em_').fadeOut(2000);
});
    $(document).ready(function($) {
        $("#NewAbuseWordnReset").click();
    });
 
    
     

</script>