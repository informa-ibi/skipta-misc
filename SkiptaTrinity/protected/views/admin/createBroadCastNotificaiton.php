
<div>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'bcastNotificationCreation-form',
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
     <div id="advertisementSpinner"></div>
    <div class="signdiv">
        <div class="alert alert-error" id="errmsgForBD" style='display: none'></div>
        <div class="alert alert-success" id="sucmsgForBD" style='display: none'></div>  
        <div class="row-fluid"  >
            <div class="span12  positionrelative" id="streamBundleAds" >

                 <label><?php echo Yii::t('translation', 'Message'); ?></label>
                <div class="chat_profileareasearch" ><?php echo $form->textArea($BroadCastNotificationsForm, 'Message', array('maxlength' => 250,'class' => 'span12')); ?> 
                </div>
                <div class="control-group controlerror">
                    <?php echo $form->error($BroadCastNotificationsForm, 'Message'); ?>
                </div>
                
            </div>          
        </div>
        <div class="row-fluid">
        <div id="redirectUrl" class="span12" >

                    <?php echo $form->labelEx($BroadCastNotificationsForm, Yii::t('translation', 'Redirect_Url'),array('class' => '')); ?>
                    <div class="chat_profileareasearch" ><?php echo $form->textField($BroadCastNotificationsForm, 'RedirectUrl', array('maxlength' => 150, 'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                     <?php echo $form->error($BroadCastNotificationsForm, 'RedirectUrl'); ?>
                    </div>
         </div>
         </div>
         <div class="row-fluid">
         <div class="span8">
                <div id="dpd1Edit" class="input-append date" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" data-date="">

                    <label><?php echo Yii::t('translation', 'Expiry_Date'); ?></label>
                    <?php echo $form->textField($BroadCastNotificationsForm, 'ExpiryDate', array('maxlength' => '20', 'class' => 'textfield span8 ', 'readonly' => "true")); ?>    
                    <span class="add-on">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <div class="control-group controlerror"> 
                        <?php echo $form->error($BroadCastNotificationsForm, 'ExpiryDate'); ?>
                    </div>

                </div>

         </div>
        </div>

        <div class="headerbuttonpopup h_center padding8top">
            <?php echo CHtml::Button(Yii::t('translation', 'Create'), array('id' => 'brodcastId', 'class' => 'btn pull-right', 'onclick' => 'createBroadCastNotification();')); ?> 
        </div>

    </div>
    <?php $this->endWidget(); ?>

</div>
<script type="text/javascript">
  loadEvents();
   function loadEvents() {
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1Edit').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        })
        }
        
 </script> 