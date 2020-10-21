<div class="accordion-group customaccordion-group">
<div class="accordion-heading customaccordion-heading">
<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
<?php echo Yii::t('translation','User_CustomSettings'); ?>
</a>
</div>
<div id="collapseThree" class="accordion-body collapse">
<div class="accordion-inner customaccordion-inner">
    <div class="custaccrodianouterdiv">
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'customsettings-form',
    'method' => 'post',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ),
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'marginzero'),
        ));
?>
                  
         <div id="customSpinLoader"></div>
                      <div class="alert-error" id="customerrmsg" style='padding-top: 5px;text-align:center;display:none;'> 
                        
                      </div>
                       <div class="alert-success" id="customsucmsg" style='padding-top: 5px;text-align:center;display:none;'></div>
<div class="regdiv"> 
    
    <!-- add custom fields start   -->

     <div class="row-fluid">
            <div class="span12">
                <div class="span6">

                    <label><?php echo Yii::t('subspecialty', 'User_Register_PharmacistSociety_Are_You_Pharmacist'); ?></label>

                    <div class="lineheight25 pull-left radiobutton ">
                        <div class="control-group controlerror marginbottom20 " >
                            <?php echo $form->radioButtonList($CustomForm, 'isPharmacist', array('1' => 'Yes', '0' => 'No'), array('uncheckValue' => null, 'separator' => '&nbsp; &nbsp; &nbsp;', 'class' => 'styled'), array('uncheckValue' => null, 'onchange' => 'displayPharmacist(this)'), array("id" => "CustomForm_isPharmacist"));
                            ?>
                            <div class="control-group controlerror marginbottom20 " >
                                <?php echo $form->error($CustomForm, 'isPharmacist'); ?>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="span6 divrelative" id="registration_primary">

                    <label><?php echo Yii::t('subspecialty', 'User_Register_PharmacistSociety_What_Is_Your_Primary_Affiliation'); ?></label>
                    <div class="control-group controlerror marginbottom10"> 
                       <?php
                        echo $form->dropDownlist($CustomForm, 'PrimaryAffiliation',$subSpe , array(
                             'onchange'=>'displayPrimary(this);'
                        ));
                        ?>
                        
                        <?php echo $form->error($CustomForm, 'PrimaryAffiliation'); ?>
                    </div>


                </div>
            </div>

        </div>

        <div class="row-fluid" >
            <div class="span12">


                <div class="span6">
                    <div id="customfields" >
                        <div id="statelicensenumber" style="display:<?php echo $CustomObject->IsPharmacist ==1?"block":"none"?>">

                            <label><?php echo Yii::t('subspecialty', 'User_Register_SurgeonNation_State_License_Number'); ?></label>
                            <div class="control-group controlerror marginbottom10"> 
                                <?php echo $form->textField($CustomForm, 'StateLicenseNumber', array("id" => "CustomForm_StateLicenseNumber", 'class' => 'span12 textfield')); ?>

                                <?php echo $form->error($CustomForm, 'StateLicenseNumber'); ?>
                            </div>
                        </div>
                      </div>

                </div>
                <div class="span6">

                    <div id="otheraffiliation" style="display:<?php echo $CustomObject->PrimaryAffiliation =="Other"?"block":"none"?>">

                        <label><?php echo Yii::t('subspecialty', 'User_Register_PharmacistSociety_Other_Affiliation'); ?></label>
                        <div class="control-group controlerror marginbottom10"> 
                            <?php echo $form->textField($CustomForm, 'OtherAffiliation', array("id" => "CustomForm_OtherAffiliation", 'maxlength' => '50', 'class' => 'span12 textfield')); ?>

                            <?php echo $form->error($CustomForm, 'OtherAffiliation'); ?>
                        </div>
                    </div>
                </div>
            </div></div>

    
   <!-- add custom fields end   -->
   
   
    <div class="headerbuttonpopup" style="padding-top: 10px">
        <?php
        echo CHtml::ajaxSubmitButton('Update Settings', array('user/updatecustomsettings'), array(
            'type' => 'POST',
            'dataType' => 'json',
            'error' => 'function(error){
                                                   
                                                   }',
            'beforeSend' => 'function(){
                                                   scrollPleaseWait("customSpinLoader","customsettings-form");
                                                 
                                                }',
            'complete' => 'function(){
                                                     
                                                    }',
            'success' => 'function(data,status,xhr) {  updatesettingscallback(data);}'), array('type' => 'submit', 'id' => 'qqq', 'class' => 'btn btn-2 btn-2a pull-right')
        );
        ?>
    </div>
</div>         
 <?php $this->endWidget(); ?>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#CustomForm_isPharmacist').live('click', function() {
            $('#customfields').closest('.row-fluid').show();
            var radios = document.getElementsByTagName('input');

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].type === 'radio' && radios[i].checked) {
                    // get value, set checked flag or do whatever you need to
                    current_value = radios[i].value;
                    if (current_value == "1") {
                        $('#customfields').show();
                        $('#statelicensenumber').show();
                    } else {
                        $('#customfields').show();
                        $('#statelicensenumber').hide();
                    }
                }
            }
        });
    })

    function displayPrimary(obj) {

$('#customfields').closest('.row-fluid').show();
        if (obj.value == "Other") {
            $('#customfields').show();
            document.getElementById('otheraffiliation').style.display = 'block';
        } else {

            document.getElementById('otheraffiliation').style.display = 'none';
        }
    }
  
  </script>