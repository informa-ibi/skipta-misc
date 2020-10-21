<div class="row-fluid">
        <div class="span12">
             <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'custom-badge-form',
                'enableClientValidation' => true,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),                
                'htmlOptions' => array(
                    'style' => 'margin: 0px; accept-charset=UTF-8',
                ),
                
            ));
            ?>
            
              <div id="WebLinkSpinner"></div>
                <div class="alert alert-error" id="errmsgForWL" style='display: none'></div>
                <div class="alert alert-success" id="sucmsgForWL" style='display: none'></div> 
                <div class="row-fluid  ">
                <div class="span12">

                    <label><?php echo Yii::t('translation', 'BadgeName');?></label>
                    <div class="chat_profileareasearch" ><?php echo $form->textField($customBadgeForm, 'BadgeName', array('maxlength' => 100, 'class' => 'span12 textfield' )); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($customBadgeForm, 'BadgeName'); ?>
                    </div>                    
                </div>
                </div>
                 
                
                  <div class="row-fluid  ">
                      <div class="span12">
                          <?php echo $form->labelEx($customBadgeForm, Yii::t('translation', 'BadgeDescription')); ?>
                          <div class="chat_profileareasearch" ><?php echo $form->textArea($customBadgeForm, 'BadgeDescription', array( 'maxlength' => 400,'rows'=>"5",'class' => 'span12 textfield')); ?> 
                    </div>
                    <div class="control-group controlerror">
                        <?php echo $form->error($customBadgeForm, 'BadgeDescription'); ?>
                    </div>
                      </div>
                      </div>
                 <div class="row-fluid" style="padding-top:10px">
                               <div class="span1">
                               <div id="ExternalPartyLogo" class="uploadicon"><img src="/images/system/spacer.png">
                            </div>
                          </div>
                               <div class="span5">
                              <img id="ExternalPartyLogoPreview" name="CustomBadgeForm[BadgeIcon]"  src="<?php echo $customBadgeForm->BadgeIcon ?>" alt="" style="border:0;height:100px" />
                          </div>
                          </div>
                     <div class="control-group controlerror">
                        <?php echo $form->error($customBadgeForm, 'BadgeIcon'); ?>
                </div>
                 
               
                <ul class="qq-upload-list" id="uploadlistSchedule"></ul>
                <?php echo $form->hiddenField($customBadgeForm, 'id',array('value'=>$customBadgeForm->id)); ?>
                <?php echo $form->hiddenField($customBadgeForm, 'BadgeIcon',array('value'=>$customBadgeForm->BadgeIcon)); ?>
                 <div class="groupcreationbuttonstyle alignright">
      
                <?php
                echo CHtml::Button('Update',array('onclick'=>'editAndSaveCustomBadge()','class' => 'btn'));
//                echo CHtml::ajaxSubmitButton('Update', array('/admin/editAndSaveCustomBadge'), array(
//                    'type' => 'POST',
//                    'dataType' => 'json',
//                    'error' => 'function(error){alert(error)
//                                        }',
//                    'beforeSend' => 'function(){  alert("hi");
//                                //scrollPleaseWait("WebLinkSpinner","custom-badge-form"); 
//                                }',
//                    'complete' => 'function(){
//                                                    }',
//                    'success' => 'function(data,status,xhr) { editAndSaveCustomBadge();}'), array('type' => '', 'id' => 'newsssGroupId', 'class' => 'btn')
//                );
                ?>
            <?php echo CHtml::resetButton('Cancel', array("id" => 'editCustomBadge', 'class' => 'btn btn_gray', 'onclick' => 'cancelEdit()')); ?>

            </div>
<?php $this->endWidget(); ?>
</div>    
</div>

<script type="text/javascript">
    function editAndSaveCustomBadge(){
        
        var data = $("#custom-badge-form").serialize();
        $.ajax({
           dataType:'json',
           type:'POST',
           url:'/admin/editAndSaveCustomBadge?id=11',
           data:data,
           success: function (data) {
                        editAndSaveCustomBadgeHandler(data);
                    }
        });
    }
    var extensions ='"jpg","jpeg","gif","png","tiff"';
    initializeFileUploader('ExternalPartyLogo', '/admin/UploadCustomBadge', '10*1024*1024', extensions,4, 'ExternalPartyLogo' ,'',ExternalPartyDLPreviewImage,displayErrorForBannerAndLogo,'uploadlistSchedule');
    
    
    function ExternalPartyDLPreviewImage(id, fileName, responseJSON, type)
{    
    var data = eval(responseJSON);       
    if(data.tooLarge=="false"){
        var  g_adImage = '/images/badges/' + data.savedfilename;
    $('#ExternalPartyLogoPreview').attr('src', g_adImage);    
    $("#CustomBadgeForm_BadgeIcon").val(g_adImage);
    $('#AdvertisementForm_ExternalPartyUrl').val('/images/badges/' + data.savedfilename);
    }else{
        $('#CustomBadgeForm_BadgeIcon_em_').html(data.message);
        $('#CustomBadgeForm_BadgeIcon_em_').show();
        $('#CustomBadgeForm_BadgeIcon_em_').fadeOut(6000)
    }
    
}
function displayErrorForBannerAndLogo(data){    
     $('#CustomBadgeForm_BadgeIcon_em_').html(data);
        $('#CustomBadgeForm_BadgeIcon_em_').show();
        $('#CustomBadgeForm_BadgeIcon_em_').fadeOut(6000)
}
function cancelEdit(){
    $("#custom-badge-form")[0].reset();
    $("#myModal_body").html('');
    $("#myModal").modal('hide');
}
function editAndSaveCustomBadgeHandler(data){
    var data=eval(data); 
    
         if(data.status =='success'){   
              var msg=data.data;
            $("#sucmsgForWL").html(msg);
            $("#sucmsgForWL").css("display", "block");
            $("#errmsgForWL").css("display", "none");
            $("#src_"+data.badgeId).attr('src',data.badgeIcon);
            $("#title_"+data.badgeId).attr('data-original-title',data.badgeName);
            $("#custom-badge-form")[0].reset();
            $("#sucmsgForWL").fadeOut(3000).promise().done(function(){
            $("#myModal_body").html('');
            $("#myModal").modal('hide');
             });
           
         }else{              
               if(typeof(data.error)=='string'){
                
                var error=eval("("+data.error.toString()+")");
                
            }else{
                
                var error=eval(data.error);
            }
            
            if(typeof(data.oerror)=='string'){
                var errorStr=eval("("+data.oerror.toString()+")");
            }else{
                var errorStr=eval(data.oerror);
            }
            $.each(error, function(key, val) {
                if($("#"+key+"_em_")){  
                    $("#"+key+"_em_").text(val);                                                    
                    $("#"+key+"_em_").show();   
                    $("#"+key+"_em_").fadeOut(5000);
                   // $("#"+key).parent().addClass('error');
                }
                
            });            
            $.each(errorStr, function(key, val) {
                
                if($("#"+key+"_em_") && val != ""){  
                    $("#"+key+"_em_").text(val);                                                    
                    $("#"+key+"_em_").show();   
                    $("#"+key+"_em_").fadeOut(5000);
                   // $("#"+key).parent().addClass('error');
                }
                
            }); 
            
         }
    
}

 </script>   
