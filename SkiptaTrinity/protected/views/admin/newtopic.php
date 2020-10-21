      <?php
      
      error_log("------------6--------------------------");//print_r($topicdetails);
      $CategoryName="";
      $CategoryImage="";
      $style="";
     
      if(isset($topicdetails) && $topicdetails->CurbsideCategory!=""){
          
         $CategoryName=$topicdetails->CurbsideCategory; 
          
      }
       if(isset($topicdetails) && $topicdetails->ProfileImage!=""){
          
         $CategoryImage=$topicdetails->ProfileImage; 
          $style="display:block";
          
      }else{
            $style="display:none";
      }
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
                                             <?php echo $form->hiddenField($categoryCreation,"TopicprofileImage");?>
                                        <?php echo $form->labelEx($categoryCreation, Yii::t('translation', 'Topic_label')); ?>
                                            
                                        <?php echo $form->textField($categoryCreation, 'category', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield' ,'value'=>"$CategoryName")); ?>
                                        <div class="control-group controlerror">
                                            <?php echo $form->error($categoryCreation, 'category'); ?>
                                    </div>
                                            
                                        </div>
                                        
                                        
                                        <div class="span12" style="padding-top: 20px;">

                                      
                                            <div class="span3">
                                                 
                                            <label>Upload Image</label>
                                            <div id='TopicProfileImage' ></div>
                                             <div ><ul class="qq-upload-list" id="uploadlist"></ul></div>
                                              <div class="control-group controlerror " id="GameQuestion_optionD_0">
                                            <div id="TopicProfileImage_error"  class="errorMessage marginbottom10 error"  style="display:none"></div>
                                            <?php echo $form->error($categoryCreation, 'TopicprofileImage'); ?>
                                        </div>
                                            </div>
                                           
                                            <div class="span2">
                                            <div id="TopicPreviewdiv" class="preview" style="<?php echo $style; ?>" >

                                                <img  class="qpreview" id="TopicPreviewImage"  name="" src='<?php echo $CategoryImage; ?>' />
                                            </div>
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


<script type="text/javascript">
<?php   if(isset($topicdetails) ){ ?>
     $('#CurbsidecategorycreationForm_id').val('<?php echo $topicdetails->Id; ?>');  
    $('#CurbsidecategorycreationForm_TopicprofileImage').val('<?php echo $topicdetails->ProfileImage; ?>');  
    
<?php  } ?>
    
  
    
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
    
    
  var extensions ='"jpg","jpeg","gif","png","tiff"';
     
  initializeFileUploader('TopicProfileImage', '/curbsidePost/upload', '10*1024*1024', extensions, 1,'TopicProfileImage' ,'',TopicPreviewImage,displayErrorForDiseaseTopicProfileImage,"uploadlist",'false');
  
function TopicPreviewImage(id, fileName, responseJSON, type)
{
    var data = eval(responseJSON);
     $('#TopicPreviewdiv').show();
    $('#CurbsidecategorycreationForm_TopicprofileImage').val(data.filename);
    $('#TopicPreviewImage').attr('src', data.filepath);
  
}
function displayErrorForDiseaseTopicProfileImage(message, formId ,id){

     if ($('#CurbsidecategorycreationForm_TopicprofileImage_em_')) {
         
         $('#CurbsidecategorycreationForm_TopicprofileImage_em_').show();
         $('#CurbsidecategorycreationForm_TopicprofileImage_em_').text(message);
         $('#CurbsidecategorycreationForm_TopicprofileImage_em_').fadeOut(7000);
         $('#TopicPreviewImage').attr('src', "");
         $('#TopicPreviewdiv').hide();
         $('#CurbsidecategorycreationForm_TopicprofileImage').val("");
     }
}
    
</script>