      <?php 
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'UserProfileDetails-form',
                        'method' => 'post',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                            'validatOnChange' => true,
                        //      'afterValidate'=>'js:clearMessage',
                        ),
                        'htmlOptions' => array(
                            'style' => 'margin: 0px; accept-charset=UTF-8', 'enctype' => 'multipart/form-data', 'class' => 'marginzero'
                        )
                    ));
                    ?>
          
                   <?php echo $form->hiddenField($UserProfileModel, 'profilepic',array('value'=>'gggg')); ?>
                    <?php echo $form->hiddenField($UserProfileModel, 'UserInterests',array('value'=>'')); ?>
      
      
                                <div class="alert-error" id="errmsgForProfile" style='display: none'></div>
                                <div class="alert-success" id="sucmsgForProfile" style='display: none'></div>  
<!--                                <div id="editableProfileDiv" style="display: none">
                                     <h4 class="profilesubtitle">Personal Information</h4>-->
                                <div class="row-fluid labelmarginzero  mobilepaddingtop">
                                    <div class="span12 profilepaddingbottom10">
                                        <div class="span3 mobdivzero"></div>
                                        <div class="span9 tabblock">
                                           <label><?php echo Yii::t('translation', 'User_Profile_DisplayName'); ?></label> 
                                            <div class="control-group controlerror "> 
                                           <?php  echo $form->textField($UserProfileModel,'DisplayName',array("value"=> isset($profileDetails->DisplayName)?$profileDetails->DisplayName:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        <?php echo $form->error($UserProfileModel, 'DisplayName'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                 <div class="row-fluid labelmarginzero ">
                                    <div class="span12 profilepaddingbottom10">
                                          <div class="span6 tabblock">
                                            <label><?php// echo Yii::t('translation', 'User_Profile_Credentials'); ?></label>
                                            <?php  //echo $form->textField($UserProfileModel,'Credentials',array("value"=> isset($profileDetails->Credentials)?$profileDetails->Credentials:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                        <div class="span6 tabblock ">
                                            <label> <?php //echo Yii::t('translation', 'User_Profile_LicenceNumber'); ?></label>
                                            <?php // echo $form->textField($UserProfileModel,'StateLicenceNumber',array("value"=> isset($profileDetails->LicenceNumber)?$profileDetails->LicenceNumber:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                        
                                    </div>
                                </div>               -->
                <?php if(sizeof($CustomFields) > 0 && Yii::app()->params['Project']=='SkiptaNeo'){ ?>
                                <div class="row-fluid labelmarginzero ">
                                    <div class="span12 profilepaddingbottom10">
                                            <label><?php echo Yii::t('translation', 'User_Profile_Specialty'); ?></label> 
                                     <select id="UserProfileDetailsForm_Speciality" name="UserProfileDetailsForm[Speciality]" onchange="displayOtherSpecialty(this);" class="span12 textfield styled">
                                                <?php if(sizeof($CustomFields) > 0){
                                                    foreach($CustomFields as  $key =>$customfield){?>
                                                <option value="<?php echo $key;?>"  <?php  if($profileDetails->UserSpeciality==$key){ echo "Selected='Selected'";} ?> ><?php echo $customfield; ?></option>                                      
                                                    <?php } }?>
                                                
                                            </select>
                                            
                                            
                                            
                                    </div>
                                </div>

                                <div class="row-fluid labelmarginzero " id="otheraffiliation" style="display:<?php echo $profileDetails->UserSpeciality == "Other" ? "block" : "none" ?>">
                                    <div class="span12 profilepaddingbottom10">
                                                <label><?php echo Yii::t('translation', 'User_Register_Profile_Other_Affiliation'); ?></label>
                                                 <div class="control-group controlerror ">
                                                    <?php echo $form->textField($UserProfileModel, 'OtherAffiliation', array("id" => "UserProfileDetailsForm_OtherAffiliation", 'maxlength' => '40', 'value'=>$profileDetails->OtherSpeciality, 'class' => 'span12 textfield')); ?>
                                                    <?php echo $form->error($UserProfileModel, 'OtherAffiliation'); ?>
                                                 </div>
                                    </div>
                                </div>
                                         
                 <?php }?>
                                 <div class="row-fluid labelmarginzero ">
                                    <div class="span12 profilepaddingbottom10">
                                            <label><?php echo Yii::t('translation', 'User_Profile_Title'); ?></label> 
                                            <?php  echo $form->textField($UserProfileModel,'Title',array("value"=> isset($profileDetails->Title)?$profileDetails->Title:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile notallowedwords')); ?>  
                                            </div>
                                    </div>
                               <div class="row-fluid labelmarginzero ">
                                    <div class="span12 profilepaddingbottom10">
                                            <label><?php echo Yii::t('translation', 'User_Profile_PracticeName'); ?></label> 
                                            <?php  echo $form->textField($UserProfileModel,'PracticeName',array("value"=> isset($profileDetails->PracticeName)?$profileDetails->PracticeName:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile notallowedwords')); ?>  
                                    </div>
                                </div>
                                <div class="row-fluid labelmarginzero ">
                                    <div class="span12 profilepaddingbottom10">
                                         <div class="span6 tabblock">
                                             <label><?php echo Yii::t('translation', 'User_Profile_City'); ?></label>
                                             <div class="control-group controlerror "> 
                                                 <?php  echo $form->textField($UserProfileModel,'City',array("value"=> isset($UserData['City'])?$UserData['City']:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile notallowedwords')); ?>  
                                                 <?php echo $form->error($UserProfileModel, 'City'); ?>
                                            </div>
                                        </div>
                                          <div class="span6 tabblock">
                                            <label><?php echo Yii::t('translation', 'User_Profile_State'); ?></label>
                                             <div class="control-group controlerror " id="Pstate"> 
                                            <?php if($States!='failure'){ ?>
                                           
                                             <select name="UserProfileDetailsForm[State]" id="UserProfileDetailsForm_State" class="span12 textfield styled " >
                                                <option value=""><?php echo Yii::t('translation', 'User_Profile_dropdown_Select'); ?> </option>
                                                <?php if(sizeof($States) > 0){
                                                    foreach($States as $state){?>
                                                   <option value="<?php echo $state['StateCode'];?>"  <?php  if($UserData['State']==$state['StateCode']){ echo "Selected='Selected'";} ?> ><?php   echo ($state['StateCode']!="")?$state['StateCode']:"";  if($state['StateCode']!=""){ echo  " (" ; }  echo $state['State']; if($state['StateCode']!=""){ echo ")" ; }?></option>                                      
                                                    <?php } }?>
                                                <option value="other"><?php echo Yii::t('translation', 'User_Profile_dropdown_Other'); ?></option>
                                            </select>
                                            <?php }else{ ?>
                                                 <?php  echo $form->textField($UserProfileModel,'State',array("value"=> isset($UserData['State'])?$UserData['State']:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile notallowedwords')); ?>  
                                            <?php } ?>
                                                <?php echo $form->error($UserProfileModel, 'State'); ?>
                                            </div>
                                        </div>
                                        
                                        
                                       
                                        
                                    </div>
                                </div>
                                <div class="row-fluid labelmarginzero ">
                                         <div class="span12 profilepaddingbottom10">
                                             <label><?php echo Yii::t('translation', 'User_Profile_About'); ?></label> 
                                             
                                               <textarea id="UserProfileDetailsForm_AboutMe"   name="UserProfileDetailsForm[AboutMe]" rows="8" style="width: 292px" > <?php   if(isset($profileDetails->AboutMe)){ echo  trim($profileDetails->AboutMe);} ?></textarea>
                                         </div>
                                </div>
                                <div class="row-fluid labelmarginzero ">
                                    <div class="span12 profilepaddingbottom10">
                                             <label class="positionrelative"><?php echo Yii::t('translation', 'User_Profile_Interests'); ?> <i data-original-title="<?php echo Yii::t('translation','Type_And_Press_Enter_Button'); ?>" rel="tooltip" data-placement="bottom" data-id="id" style="font-weight: normal;top:3px;right:auto;float:left;margin-left:5px;" class="fa fa-question helpmanagement helpicon top10  tooltiplink Inhelpmanagement"></i> </label>
                                            <div id="UserProfileDetailsForm_Interests_currentMentions" ></div>
                                           <div class="control-group controlerror "> 
                                            <input type="text" id="UserProfileDetailsForm_Interests" name="UserProfileDetailsForm[Interests]" class="textfield span12 hiddenprofile" onkeyup="PublicationAuthors(event,this,'Interests')" maxlength="40" value="">
                                           <div id="UserProfileDetailsForm_Interests_error" class="errorMessage" style="display:none;" ></div>
                                           </div>
                                    </div>
                                </div>
                                  <div id="profileUpdateSpinLoader" class="grouppostspinner"></div>
                               
                                <div class="alignright padding8top">
                                   
                                      <?php echo CHtml::Button(Yii::t('translation', 'Save'),array('class' => 'btn btn-small','onclick'=>'saveUserProfileDetails();')); ?> 
                                    <?php  echo CHtml::Button('Cancel', array('id' => 'CancelEdit', 'class' => 'btn btn-small','onclick'=>'CancelUserEditProfile();')); ?>
                                </div>
                        
                                 
            <?php  $this->endWidget(); ?>

                                  
<script type="text/javascript">

     Custom.init();
        $("[rel=tooltip]").tooltip();
  globalspace["cv_custom_mention_UserProfileDetailsForm_Interests"]=new Array();
initializeInterestsForCV("#UserProfileDetailsForm_Interests");
  var Profile_Interests=new Array();
  var Interests='<?php echo $profileDetails->Userinterests; ?>';
  if(Interests.length>0){
    
      var globalInterestsArray=Interests.split(',');
        
  Profile_Interests=globalInterestsArray;
    for (var j = 0; j < globalInterestsArray.length; j++) {
        globalspace['cv_custom_mention_UserProfileDetailsForm_Interests'].push(globalInterestsArray[j]);
        var stringdata = "<span class='dd-tags hashtag' style='display:inline-block;margin-bottom:3px'><b>"+globalInterestsArray[j]+"</b><i id='cv_custom_mention_UserProfileDetailsForm_Interests' data-name='"+globalInterestsArray[j]+"'  class='cv_custom_mention_UserProfileDetailsForm_Interests' >X</i></span></span>";
         $('#UserProfileDetailsForm_Interests_currentMentions').append(stringdata);
        $("#UserProfileDetailsForm_Interests_currentMentions").die("click");
        $("#cv_custom_mention_UserProfileDetailsForm_Interests").live("click", function(){
               deleteUserInterestsInProfile(this,$(this).attr('data-name'),'cv_custom_mention_UserProfileDetailsForm_Interests');
           });
    }
  }else{
     $('#userProfile_Interests').html("Interests");
  }  
     
     
     if(Profile_Interests!='undefined' && Profile_Interests.length>0){
     //globalspace['cv_custom_mention_UserProfileDetailsForm_Interests']=Profile_Interests;
     
   $('#UserProfileDetailsForm_Interests_currentMentions').html('');
   for (var j = 0; j < Profile_Interests.length; j++) {
        var stringdata = "<span class='dd-tags hashtag' style='display:inline-block;margin-bottom:3px'><b>"+Profile_Interests[j]+"</b><i id='cv_custom_mention_UserProfileDetailsForm_Interests' data-name='"+Profile_Interests[j]+"'  class='cv_custom_mention_UserProfileDetailsForm_Interests' >X</i></span></span>";
        var sprofielData = "<span class='dd-tags hashtag' style='display:inline-block;margin-bottom:3px'><b>"+Profile_Interests[j]+"</b></span></span>";
         $('#UserProfileDetailsForm_Interests_currentMentions').append(stringdata);
        $("#UserProfileDetailsForm_Interests_currentMentions").die("click");
        $("#cv_custom_mention_UserProfileDetailsForm_Interests").live("click", function(){
               deleteUserInterestsInProfile(this,$(this).attr('data-name'),'cv_custom_mention_UserProfileDetailsForm_Interests');
           });
    }
  }
     
      $('#UserProfileDetailsForm_Speciality').bind('change', function() { 
    if($('#UserProfileDetailsForm_Speciality').val() =="Other"){
       $('#otheraffiliation').show();
    }else{
         $('#otheraffiliation').hide();
    }
      
    });
</script>