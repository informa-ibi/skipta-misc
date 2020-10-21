<script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script> 
<script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/js/profile.js"></script> 
<?php include 'miniProfileScript.php'; ?>
<?php include 'hashTagProfileScript.php'; ?>
<?php include 'commentscript.php'; ?>
<?php include 'inviteScript.php'; ?>
<?php include 'snippetDetails.php'?>
<script type="text/javascript">  
      sessionStorage.pageName = "userProfile";
 </script>
<?php if(Yii::app()->params['Project']=='RiteAid'){?>
<div class="streamsectionarea  streamsectionarearightpanelno">
        <div class="padding10 ">
<?php }?>
            <div id="profileDetailsDiv">
                <div id="area1" class="right">
                        <div class="btn-groupint" data-toggle="buttons-radio">
                            <button type="button" class="btnint profilei active" data-name="Profile"><?php echo Yii::t('translation','Profile'); ?></button>
                            <button type="button" class="btnint profilei " data-name="Interactions"><?php echo Yii::t('translation','Interactions'); ?></button>
                            <button type="button" class="btnint profilei" data-name="CV"><?php echo Yii::t('translation','CV'); ?></button>
                        </div>
                </div>                
                
                <div id="numero1">  <h2 class="pagetitle"><?php echo Yii::t('translation','Profile'); ?> </h2> </div><!-- This id numero1 is used for Joyride help -->
             <div class="row-fluid">
                <div class="span12">
                    <div class="span3 positionrelative">
                       <?php  if($IsUser == 1){?> <div><i data-original-title="<?php echo Yii::t('translation','Profile_image_size_tooltip'); ?>  " rel="tooltip" data-placement="bottom" style="z-index:999;  " class="fa fa-question helpicon helpmanagement top10  tooltiplink" ></i> </div>  <?php  } ?>
                      <div class="alert alert-error" id="ProfileImageError" style="display: none"></div>
                        <div class="marginzero smallprofileicon largeprofileicon">
                            
                            <div class="positionrelative editicondiv editicondivProfileImage no_border">
                                
                                <div class="edit_iconbg top75" style="display: none;">
                                    <div id="UserProfileImage"></div>


                                    <div id="updateAndCancelProfileImageUploadButtons" style="display: none">
                                        <i id="updateGroupIcon" class="fa fa-floppy-o editable_icons editable_icons_big" onclick="saveUserProfileImage('<?php  echo $profileDetails->UserId?>','ProfilePicture')"></i>
                                        <i class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor" onclick="cancelProfileImageUpload('<?php  echo $profileDetails->ProfilePicture?>','ProfilePicture')"></i>
                                    </div>
                                </div>
<!--                                <img id="profileImagePreviewId" src="<?php  //echo $profileDetails->ProfilePicture ?>" alt="" />-->
                               <img id="profileImagePreviewId" src="<?php  if(isset($profileDetails->profile250x250) && $profileDetails->profile250x250 !='null'){echo $profileDetails->profile250x250;}else{ echo '/upload/profile/user_noimage.png';}  ?>"  alt="" />              
                            </div>
                            <div ><ul class="qq-upload-list" id="uploadlist_logo"></ul></div>
                        </div>
                         <?php  if($IsUser != 1){?>
                         <div id="miniprofile_spinner_modal" style="position: relative;" class="grouppostspinner"></div>
                        <div class=" alignright profile_bar ">
                            <?php if(isset($networkAdmin) && $networkAdmin==$profileDetails->UserId){ ?>
                                 <a><i data-placement="bottom" rel="tooltip" >
                                    <img id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" src="/images/system/spacer.png" 
                                                 class="tooltiplink <?php  if($profileDetails->IsFollowed==0){ echo 'unfollowbig'; }else{ echo 'followbig'; }?>" >
                                </i></a>
                            <?php }else{ ?>
                            <a><i data-placement="bottom" rel="tooltip"   <?php  if(empty($profileDetails->IsFollowed)){ ?> data-original-title="<?php echo Yii::t('translation','Follow'); ?>" <?php }else{?>  data-original-title="Unfollow"  <?php }?> >
                                    
                             <img                                           
                                             <?php  if(empty($profileDetails->IsFollowed)){ ?>  onclick="userFollowUnfollowActions('<?php  echo $profileDetails->UserId;?>','follow');" 
                                                 <?php  }else{?>  onclick="userFollowUnfollowActions('<?php  echo $profileDetails->UserId;?>','unfollow');"
                                                 <?php  } ?> id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" src="/images/system/spacer.png" 
                                                 class="tooltiplink cursor <?php  if($profileDetails->IsFollowed==0){ echo 'unfollowbig'; }else{ echo 'followbig'; }?>" >
                                </i></a>
                            <?php  } ?>
                        </div>
                            <?php  } ?>
                       <div class="profileBar">
                           <ul class="profilesocial"><li> <span class="tooltiplink p_followers"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Followers'); ?>" style='cursor: pointer' ><img src="/images/system/spacer.png"><i id='p_followersCount'><?php echo $profileDetails->UserFollowersCount ?></i ></span></li>
                            <li> <span class="tooltiplink p_following"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Following'); ?>" style='cursor: pointer' ><img src="/images/system/spacer.png"/><i id='p_followingCount'><?php echo $profileDetails->UserFollowingCount ?></i></span></li></ul>
                    </div>
                    </div>
                <div class="span9">
                    <div id="userFollow_spinner" style="position:relative;"></div>
                    <div class="alert alert-error" id="ProfileUpdateError" style="display: none "></div>
                    <div class="pull-left">
                                 
                                    <div class="pagetitle profiletitle paddingzero lineheight20 positionrelative  editProfileFirstName" id="profileFirstName"><?php  echo $profileDetails->FirstName ?> </div>
<!--                        <div class="edit_iconbg edit_padding-top-3">-->

                            <div id="editProfileFirstName" style="display:none" class="positionrelative minheight21">
                            <div class="editable editProfileFirstName_edit">
                                <div id="editProfileFirstNameDescriptionText" class="profiletitleedit"    contentEditable="true"><?php  echo $profileDetails->FirstName ?></div>

                            </div>
                            <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
                                <i onClick="saveEditProfileFirstName('<?php  echo $profileDetails->UserId?>','FirstName','<?php echo Yii::t('translation','Invalid_characters_in_First_Name'); ?>','<?php echo Yii::t('translation','First_name_cannot_blank'); ?>');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                <i onClick="closeEditProfileFirstNameDescription();" id="closeEditProfileFirstNameDescription"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>
                            </div>
                            <!--</div>-->
                        </div>
                                  
                    </div>
                    <div class="pull-left paddinglr ">
                                        
                                     <div class="pagetitle profiletitle paddingzero lineheight20 positionrelative editProfileLastName " id="profileLastName"><?php  echo $profileDetails->LastName ?> </div>
                                     <!--                        <div class="edit_iconbg edit_padding-top-3">-->

                                     <div id="editProfileLastName" style="display:none" class="positionrelative minheight21">
                                         <div class="editable editProfileFirstName_edit">
                                             <div id="editProfileLastNameDescriptionText"  class="profiletitleedit "  contentEditable="true" co><?php  echo $profileDetails->LastName ?></div>

                                         </div>
                                         <div  id="updateAndCancelLastNameIconUploadButtons" class="edit_iconbar">
                                             <i onClick="saveEditProfileLastName('<?php  echo $profileDetails->UserId ?>','LastName','<?php echo Yii::t('translation','Invalid_characters_in_Last_Name'); ?>','<?php echo Yii::t('translation','Last_name_cannot_blank'); ?>');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                             <i onClick="closeEditProfileLastNameDescription();" id="closeEditProfileLastNameDescription"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>
                                         </div>
                                         <!--</div>-->
                                     </div>
                                     
                    </div>
                        
                    
<!--                    <h2 class="pagetitle profilesubtitle paddingzero lineheight20 positionrelative editicondiv"><?php  //echo $profileDetails->Designation ?><div class="edit_iconbg edit_padding-top-3">
                            <div id="GroupLogo"></div>


                            <div  id="updateAndCancelGroupIconUploadButtons">
                                <i onClick="saveGroupBannerAndIcon( & quot; 5301cf841d8dcbdd0c8b4574 & quot; , & quot; GroupProfileImage & quot; )" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                <i onClick="cancelBannerOrIconUpload('/upload/group/profile/3d nature wallpapers for desktop-1_1392901052.jpg', 'GroupProfileImage')" class="fa fa-times-circle editable_icons editable_icons_big redcolor"></i>
                            </div>
                        </div>
                    </h2>  -->
                    <div class="p_content positionrelative  editAboutMe clearboth">
                        <div id="profile_AboutMe" style="display:block" class="editicondiv minheightDiv"><?php  echo $profileDetails->AboutMe ?></div>

                            <div id="editProfileAboutMe" style="display:none">
                                <div class="editable groupAboutEdit" id="">
                                    <div id="editProfileAboutMeDescriptionText" class="e_descriptiontext"  contentEditable="true" ><?php  echo $profileDetails->AboutMe ?></div>

                                </div>
                                <div  id="updateAndCancelAboutMeUploadButtons1" class="alignright" style="display: none">
                                    <i onClick="saveEditProfileAboutMe('<?php  echo $profileDetails->UserId ?>','AboutMe');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                    <i onClick="CancelAboutMe();" id="closeEditProfileAboutMeDescription"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>
                                </div>
                            </div>
                    </div>
                    <div class="g_mediapopup clearboth positionrelative" id="viewPersonalInfoId">
                        <div id="profileUpdateSpinLoader" class="grouppostspinner"></div>
                        
                            <div class="">
                               
                                   
                                <?php 
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'profile-form',
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
                               <?php  if($IsUser == 1){?>
                                
                                <div class="alert-error" id="errmsgForProfile" style='display: none'></div>
                                <div class="alert-success" id="sucmsgForProfile" style='display: none'></div>  
                                <div id="editableProfileDiv" style="display: none">
                                     <h4 class="profilesubtitle">Personal Information</h4>
                                <div class="row-fluid editabledivs">
                                    <div class="span12">
                                        
                                        <div class="span6">
                                           <label> <?php  echo Yii::t('translation', 'Profile_Name'); ?></label> 
                                           <div id="DisplayName" class="profilefield editicondiv" onclick="displayTextBox(this);" ><?php echo isset($profileDetails->DisplayName)?$profileDetails->DisplayName:"" ?></div>
                                           <?php  echo $form->textField($profileModel,'DisplayName',array("value"=> isset($profileDetails->DisplayName)?$profileDetails->DisplayName:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                    </div>
                                </div>
                                <h4 class="profilesubtitle">Professional Information</h4>
                                <div class="row-fluid editabledivs">
                                    <div class="span12">
                                            <label> <?php  echo Yii::t('translation', 'Profile_Speciality');?></label>
                                            <div style="" id="Speciality" class="profilefield editicondiv" onclick="displayTextBox(this);" ><?php echo isset($profileDetails->Speciality)?$profileDetails->Speciality:"" ?></div>
                                            <?php  echo $form->textField($profileModel,'Speciality',array("value"=> isset($profileDetails->Speciality)?$profileDetails->Speciality:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                    </div>
                                </div>
                                <div class="row-fluid editabledivs">
                                    <div class="span12">
                                          <div class="span6 editabledivs">
                                            <label> <?php  echo Yii::t('translation', 'Profile_Company');?></label>
                                            <div id="Company" class="profilefield editicondiv" onclick="displayTextBox(this);" ><?php echo isset($profileDetails->Company)?$profileDetails->Company:"" ?></div>
                                            <?php  echo $form->textField($profileModel,'Company',array("value"=> isset($profileDetails->Company)?$profileDetails->Company:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                        <div class="span6 editabledivs">
                                            <label> <?php  echo Yii::t('translation', 'Profile_Position'); ?></label>
                                            <div id="Position" class="profilefield editicondiv" onclick="displayTextBox(this);"  ><?php echo isset($profileDetails->Position)?$profileDetails->Position:"" ?></div>
                                            <?php  echo $form->textField($profileModel,'Position',array("value"=> isset($profileDetails->Position)?$profileDetails->Position:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12 editabledivs">
                                        
                                        <div class="span6">
                                            <label class="padding8top"> <?php  echo Yii::t('translation', 'Profile_YearsOfExperiance');?></label>
                                            <div id="Years_Experience" class="profilefield editicondiv" onclick="displayTextBox(this);"  ><?php echo isset($profileDetails->Years_Experience)?$profileDetails->Years_Experience:"" ?></div>
                                            <?php  echo $form->textField($profileModel,'Years_Experience',array("value"=> isset($profileDetails->Years_Experience)?$profileDetails->Years_Experience:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                        <div class="span6">
                                            <label class="padding8top"> <?php  echo Yii::t('translation', 'Profile_HigherEducationLevel');?></label>
                                            <div id="Highest_Education" class="profilefield editicondiv" onclick="displayTextBox(this);" ><?php echo isset($profileDetails->Highest_Education)?$profileDetails->Highest_Education:"" ?></div>
                                            <?php  echo $form->textField($profileModel,'Highest_Education',array("value"=> isset($profileDetails->Highest_Education)?$profileDetails->Highest_Education:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12 editabledivs">
                                        <div class="span6">
                                            <label class="padding8top"> <?php  echo Yii::t('translation', 'Profile_Degree');?></label>
                                            <div id="Degree" class="profilefield editicondiv" onclick="displayTextBox(this);"  ><?php echo isset($profileDetails->Degree)?$profileDetails->Degree:"" ?></div>
                                            <?php  echo $form->textField($profileModel,'Degree',array("value"=> isset($profileDetails->Degree)?$profileDetails->Degree:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                        <div class="span6 editabledivs">
                                            <label class="padding8top"> <?php  echo Yii::t('translation', 'Profile_School');?></label>
                                            <div id="School" class="profilefield editicondiv" onclick="displayTextBox(this);"  ><?php echo isset($profileDetails->School)?$profileDetails->School:"" ?></div>
                                            <?php  echo $form->textField($profileModel,'School',array("value"=> isset($profileDetails->School)?$profileDetails->School:"", 'maxlength' => 40, 'class' => 'textfield span12 hiddenprofile')); ?>  
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="alignright padding8top">
                                    <?php 
                                    echo CHtml::ajaxSubmitButton('Save', array('user/saveprofileinfo'), array(
                                        'type' => 'POST',
                                        'dataType' => 'json',
                                        'error' => 'function(error){
                                        }',
                                        'beforeSend' => 'function(event, settings){
                                            var data = $("#profile-form").serialize();
                                            if($.trim($("#ProfileDetailsForm_DisplayName").val())!=""){
                                               $("#p_name").html($("#ProfileDetailsForm_DisplayName").val());
                                            }
                                            $("#p_speciality").html($("#ProfileDetailsForm_Speciality").val());
                                            $("#p_company").html($("#ProfileDetailsForm_Company").val());
                                                
                                            if($("#ProfileDetailsForm_Position").val() != "" && $("#ProfileDetailsForm_Company").val() !=""){
                                                $("#p_position").html($("#ProfileDetailsForm_Position").val()+",");
                                            }else                                            
                                                $("#p_position").html($("#ProfileDetailsForm_Position").val());
                                            
                                           
                                            if($("#ProfileDetailsForm_Degree").val() != "" && $("#ProfileDetailsForm_School").val() !=""){
                                             
                                                $("#p_degree").html($("#ProfileDetailsForm_Degree").val()+",");
                                            }else
                                              $("#p_degree").html($("#ProfileDetailsForm_Degree").val());
                                            
                                            $("#p_school").html($("#ProfileDetailsForm_School").val());
                                            
                                             $("#p_yoe").html($("#ProfileDetailsForm_Years_Experience").val());

                                              if($("#ProfileDetailsForm_Highest_Education").val() == ""){
                                                $("#p_hedu").html($("#ProfileDetailsForm_Highest_Education").val());
                                              }else
                                                 $("#p_hedu").html($("#ProfileDetailsForm_Highest_Education").val());
                                                 
                                                
                                            scrollPleaseWait("profileUpdateSpinLoader","profile-form");                         
                                        }',
                                        'complete' => 'function(){
                                                    }',
                                        'success' => 'function(data,status,xhr) { if(globalspace.inlineEdit == undefined){ editProfileHandler(data,status,xhr); }else{ inlineEditProfileHandler(data,status,xhr);}}'), array('type' => 'submit', 'id' => 'editProfileSave', 'class' => 'btn')
                                    );
                                    ?>
                                    <?php  echo CHtml::resetButton(Yii::t('translation', 'Close'), array('type' => 'submit', 'id' => 'CancelEdit', 'class' => 'btn')); ?>
                                </div>
                            </div>
                               <?php  } ?>
                                <!-- =========== for displaying profile starts=================-->
                                
                                <div id="profileViewDiv" class="editicondiv margintop5 paddingtb businesscard positionrelative" style="text-align: center">
                                    
                                    <?php if ($IsUser == 1) { ?>
                                        <div class="alignright" id="editButtonId" style="position:absolute;right:10px;bottom:5px;z-index: 5; display: none;">
                                            <i class="fa fa-pencil-square-o editable_icons_big" onclick="editInformation()"></i>

                                        </div>
                                    <?php } ?>
                                    <div id="numero2" class="businessouterdiv positionrelative"> <!-- This id numero2 is used for Joyride help -->
                                        <div class="businessprofilepicdiv">
                                            <a  class=" marginzero smallprofileicon profileImage businessouterdivanchor">
                                                <img id="businessProfileImage" src="<?php if (isset($profileDetails->profile70x70) && $profileDetails->profile70x70 != 'null') {
                                        echo $profileDetails->profile70x70;
                                    } else {
                                        echo '/upload/profile/user_noimage.png';
                                    } ?>">
                                            </a>
                                        </div>
                                        
                                        <div id="numero3" class="businessouterdivcontent">  <!-- This id numero3 is used for Joyride help --> 
                                            
                                            <span class="normalview p_normalviewtitle " id="p_name"><?php echo strlen($profileDetails->DisplayName) ? $profileDetails->DisplayName : "" ?></span>
                                            
                                                <?php $displaySpeciality = (strlen($profileDetails->Speciality) != 0)?"show":"hide"; ?>
                                                <div>
                                                    <span class="normalview p_normalviewsubtitle" id="p_speciality" style="display:<?php echo $displaySpeciality; ?>"><?php echo $profileDetails->Speciality ?></span>

                                                </div>
                                                
                                            <div> 
                                                <?php $displayPosition = (strlen($profileDetails->Position) != 0)?"show":"hide"; ?>
                                                    <span style="display:<?php echo $displayPosition; ?>" class="normalview p_normalviewcontent" id="p_position"><?php echo strlen($profileDetails->Position) != 0 && strlen($profileDetails->Company) != 0 ? $profileDetails->Position . "," : $profileDetails->Position ?></span> 
                                                 <?php $displayCompany = (strlen($profileDetails->Company) != 0)?"show":"hide"; ?>
                                                <span style="display:<?php echo $displayCompany; ?>" class="normalview p_normalviewcontent" id="p_company"><?php echo $profileDetails->Company ?></span>
                                             </div> 
                                            <div>
                                                 <?php $displayYears_Experience=(strlen($profileDetails->Years_Experience) != 0 )?"show":"hide"; ?>
                                                    <span style="display:<?php echo $displayYears_Experience; ?>"  class="normalview p_normalviewcontent" id="p_yoe"><?php echo $profileDetails->Years_Experience ?></span>
                                                 <?php $displayHighest_Education=(strlen($profileDetails->Highest_Education) != 0 )?"show":"hide"; ?>
                                                    <span style="display: none" class="normalview p_normalviewcontent" id="p_hedu"><?php echo strlen($profileDetails->Highest_Education) != 0 ? $profileDetails->Highest_Education . "," : "" ?></span>
                                            </div>
                                            <div>
                                                 <?php $displayDegree=(strlen($profileDetails->Degree) != 0 )?"show":"hide"; ?>
                                                    <span style="display:<?php echo $displayDegree; ?>" class="normalview p_normalviewcontent" id="p_degree"><?php echo strlen($profileDetails->Degree) != 0 && strlen($profileDetails->School) != 0 ? $profileDetails->Degree . "," : $profileDetails->Degree ?></span> 
                                                 <?php $displaySchool=(strlen($profileDetails->School) != 0 )?"show":"hide"; ?>
                                                    <span  style="display:<?php echo $displaySchool; ?>" class="normalview p_normalviewcontent" id="p_school"><?php echo isset($profileDetails->School) ? $profileDetails->School . "" : "" ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- =========== for displaying profile ends=================-->
                        <?php  $this->endWidget(); ?>
                   
                        </div>
                     
                    
                   
                </div>
            </div>
                </div>
             </div>
           <div class="row-fluid">
                <div class="span12 padding8top">
    
            <h2 class="pagetitle"><?php  echo $profileDetails->DisplayName."'s " ?>Interactions</h2>
            <div id="main" role="main">
                <ul id="ProfileInteractionDiv" class="profilebox">
                    <?php  if($loginUserId==$profileDetails->UserId){
                        $userDisplayName = "You";
                        $pre = " are ";
                    }else{
                        $userDisplayName = $profileDetails->DisplayName;
                        $pre = " is ";
                    }?>
                    <?php if(sizeof($userFollowingGroups)>0){ ?>
                    <li class="woomarkLi">
                        <div class="post item" style="">
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?>following these groups</div>
                            <div class="padding4 clearfix groupimages">
                                <?php foreach ($userFollowingGroups as $value) { ?>
                                <span><a class="groupId" data-showIntroPopUp="<?php echo $value['showIntroPopup']?>" data-value="<?php echo $value['id'] ?>" ><img src="<?php echo $value['groupProfileImage'] ?>" alt="<?php echo $value['name'] ?>" /></a></span>
                            <?php } ?>
                               
                        </div>
                        </div>
                    </li>
                    <?php } ?>
                     <?php if(sizeof($userFollowingSubGroups)>0){ ?>
                    <li class="woomarkLi">
                        <div class="post item" style="">
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?>following these subgroups</div>
                            <div class="padding4 clearfix groupimages">
                                <?php foreach ($userFollowingSubGroups as $value) { ?>
                                <span><a class="subgroupId" data-showSubIntroPopUp="<?php echo $value['showSubIntroPopup']?>" data-value="<?php echo $value['_id'] ?>" ><img src="<?php echo $value['SubGroupProfileImage'] ?>" alt="<?php echo html_entity_decode($value['SubGroupName']); ?>" /></a></span>
                            <?php } ?>
                               
                        </div>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if(sizeof($userFollowingHashtags)>0){ ?>
                    <li class="woomarkLi">
                        <div class="post item" style="">
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?>following these hashtags</div>
                            <div class="padding4">
                                <?php foreach ($userFollowingHashtags as $value) { ?>
                                <span id="stream_view_spinner_<?php echo $value['id']; ?>" class="grouppostspinner"></span>
                                <span class="atwho-view-flag atwho-view-flag-#">
                                    <span class="dd-tags hashtag" data-id="<?php echo $value['id']; ?>"><b>#<?php echo $value['name'] ?></b></span>
                                </span>
                            <?php } ?>
                        </div>
                            </div>
                    </li>
                    <?php } ?>
                    <?php if(sizeof($userFollowingCategories)>0){ ?>
                    <li class="woomarkLi">
                        <div class="post item" style="">
                            <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?>following these  <?php echo strtolower($name);?> categories</div>
                            <div class="padding4">
                                <?php foreach ($userFollowingCategories as $value) { ?>
                                <span class="fontbold comma"><a class="curbsideCategory" data-id="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></a></span>
                            <?php } ?>
                        </div>
                       </div>
                    </li>
                    <?php } ?>
                </ul>

            </div>
        </div>
        </div>
                
       </div>
            <div id="postDetailsDivInProfile"></div>
            <?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
</div>
    </div>
            <?php }?>
<script type="text/javascript">
   
     $(document).ready(function($) {
         
        $("#editProfileSave").hide();
          <?php  if($IsUser != 1){?>
        $('#profileViewDiv').removeClass("editicondiv");
        $('#profile_AboutMe').removeClass("editicondiv");
          <?php }?>
              bindActionsForUserProfilePage()
              bingGroupsIntroPopUp();
              bingSubGroupsIntroPopUp();                
                if(!detectDevices()){
                    $("[rel=tooltip]").tooltip();
                    $(".editicondivProfileImage").mouseover(function(){
                        $(".edit_iconbg").show();
                    }).mouseout(function(){
                        $(".edit_iconbg").hide();
                    });
                    $("#profileViewDiv").mouseover(function(){
                        $("#editButtonId").show(); 
                    }).mouseout(function(){
                        $("#editButtonId").hide();
                    });
                }else{
                    $(".edit_iconbg,#editButtonId").show();
                }
                        
    });
 
    <?php  if($IsUser==1) {?>
    bindEditForProfile();
var extensions ='"jpg","jpeg","gif","png","tiff"';
initializeFileUploader('UserProfileImage', '/user/UploadProfileImage', '10*1024*1024', extensions,1, 'UserProfileImage' ,'',ProfilePreviewImage,displayErrorForBannerAndLogo12,"uploadlist_logo");
<?php  }?>
    var handler = null;
    var options = {
      itemWidth: '23%', // Optional min width of a grid item
      autoResize: true, // This will auto-update the layout when the browser window is resized.
      container: $('#ProfileInteractionDiv'), // Optional, used for some extra CSS styling
      offset: 8, // Optional, the distance between grid items
      outerOffset: 10, // Optional the distance from grid to parent
       flexibleWidth: '23%', // Optional, the maximum width of a grid item
      align: 'left'
    };
    var $window = $(window);
    profileInitializationEvents();
    getCollectionData('/user/getprofileintractions', 'UserId='+<?php  echo $profileDetails->UserId; ?>+'&ProfileIntractionDisplayBean', 'ProfileInteractionDiv', '<?php echo Yii::t('translation','No_Data_Found'); ?>',"<?php echo Yii::t('translation','Thas_all_folks'); ?>");
     gPage = "ProfileStream";
      trackEngagementAction("Loaded",'<?php  echo $profileDetails->UserId ?>');  
    if(!detectDevices())
       $("[rel=tooltip]").tooltip();
    function CancelAboutMe(){        
     $("#profile_AboutMe").show();
     $("#profile_AboutMe").html($("#editProfileAboutMeDescriptionText").html()); 
     $("#editProfileAboutMe").hide();
     $("#closeEditGroupDescription").hide();
     $("#editProfileAboutMeDescriptionText").hide();
     $("#updateAndCancelAboutMeUploadButtons1").hide();         
}
function bindActionsForUserProfilePage(){
     if(<?php echo $profileDetails->UserFollowersCount ?> > 0){
      $('.p_followers').live("click",function(){
                 tpage=0;                
                 tFPopupAjax = false; 
                 $("#userFollowersFollowings_body").empty();
                  getUserProfileFollowers('<?php  echo $profileDetails->UserId ?>','<?php echo $profileDetails->DisplayName ?>');
                  
              });    
         }           
          
          if(<?php echo $profileDetails->UserFollowingCount ?> > 0){
              $('.p_following').live("click",function(){
                  tpage=0;
                  tFPopupAjax = false; 
                  $("#userFollowersFollowings_body").empty();
                  getUserProfileFollowing('<?php  echo $profileDetails->UserId ?>','<?php echo $profileDetails->DisplayName ?>');
                  
              });
              
          }  
            $('.groupId').live("click",function(){
            var groupId=$(this).attr('data-value');
            var showIntroPopup=$(this).attr('data-showIntroPopUp');
            if(showIntroPopup==1){
              getGroupIntroPopUp(groupId);        
            }else{
                
               var param='';
               var content='you are not authorized to access this group';
                openModelBox("alert_modal", "Group", content, "Ok", 'Nodisplay', '', param);
            }
            
           
       
         trackEngagementAction("GroupMinPopup",groupId);
              });
              $('.subgroupId').live("click",function(){
            var subgroupId=$(this).attr('data-value');
            
           var showSubIntroPopup=$(this).attr('data-showSubIntroPopUp');
            if(showSubIntroPopup==1){
               getSubGroupIntroPopUp(subgroupId);     
            }else{
                
               var param='';
               var content='you are not authorized to access this group';
                openModelBox("alert_modal", "SubGroup", content, "Ok", 'Nodisplay', '', param);
            }
                      
         
          trackEngagementAction("SubGroupMinPopup",subgroupId);
              });
           $('#ProfilePopupFollowersAndFollowing').live("click",function(){ 
             //      $(".scroll").bind('jsp-scroll-y');
                 isDuringAjax=false;
                 
               
                });
              
                
}
function bindMouseEvents(){
    $(".editicondivProfileImage").mouseover(function(){
                $(".edit_iconbg").show();
        }).mouseout(function(){
            $(".edit_iconbg").hide();
    });
}
$("#UserProfileImage").on('click',function(){
    $(".editicondivProfileImage").unbind('mouseover').unbind("mouseout");
});
$(".profilei").live("click",function(){
    var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
   var tabName = $.trim($(this).attr('data-name'));
   if(tabName == "Profile"){
       window.location.href = "/profile/"+urlArr[0];
   }else if(tabName == "Interactions"){
       window.location.href = "/"+urlArr[0]+"/interaction";
   }else if(tabName == "CV"){
       
   }
   trackEngagementAction(tabName+"Click", '<?php  echo $profileDetails->UserId ?>');
});
</script>

