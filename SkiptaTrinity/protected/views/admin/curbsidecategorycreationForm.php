
<div class="modal fade" id="addNewCurbsideCategory" tabindex="-1" role="dialog" aria-labelledby="PasswordPoliciesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" id="NewCurbsideCategory_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div id="NewCurbsideCategoryLabel" style="display: none">
                                 <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
                                <h4 class="modal-title" >New <?php echo $name?> Category</h4>
                            </div>
                            <div id="UpdateCurbsideCategoryLabel" style="display: none">
                                <h4 class="modal-title" >Update Curbside Category</h4>
                            </div>
                            
                        </div>
                        <div>
                           
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'curbsidecategorycreation-form',
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
                                    <div class="alert alert-error" id="errmsgForCategory" style='display: none'></div>
                                    <div class="alert alert-success" id="sucmsgForCategory" style='display: none'></div>          
                                    <div class="row-fluid">
                                        <div class="span12">
                                         <?php echo $form->hiddenField($categoryCreation,"id");?>
                                        <?php echo $form->labelEx($categoryCreation, Yii::t('translation', 'Curbside_Category_Creation_label')); ?>
                                            
                                        <?php echo $form->textField($categoryCreation, 'category', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>
                                        <div class="control-group controlerror">
                                            <?php echo $form->error($categoryCreation, 'category'); ?>
                                    </div>
                                            
                                        </div>
                                        
                                    </div>
                                   
                                    <div class="headerbuttonpopup h_center padding8top">
                                        <?php
                                        echo CHtml::ajaxSubmitButton('Create', array('/admin/createcurbsidecategory'), array(
                                            'type' => 'POST',
                                            'dataType' => 'json',
                                            'error' => 'function(error){
                                        }',
                                            'beforeSend' => 'function(){      scrollPleaseWait("categoryCreationSpinLoader","curbsidecategorycreation-form");
                                                }',
                                            'complete' => 'function(){
                                                    }',
                                            'success' => 'function(data,status,xhr) { curbsideCategoryCreationHandler(data,status,xhr);}'), array('type' => 'submit', 'id' => 'newCurbsideCategoryId', 'class' => 'btn btn-2 btn-2a pull-right')
                                        );
                                        ?>
                                    </div>
                                    <?php echo CHtml::resetButton(Yii::t('translation', 'Clear'), array("id" => 'NewCurbsideCategoryReset', "style" => "display:none")); ?>

                                </div>
                                <?php $this->endWidget(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
        $('input[type=text]').keypress(function(){
  $('#'+this.id+'_em_').fadeOut(2000);
});
    $(document).ready(function($) {
        
        if(!detectDevices())
              $("[rel=tooltip]").tooltip();
        $("#NewCurbsideCategoryReset").click();
    });
 
    /*
     * Handler for requesting new category
     */
</script>