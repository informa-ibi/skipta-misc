<?php include 'snippetDetails.php'?>
<div class="group_admin_floatingMenu marginbottom10">
    <div class="row-fluid">
            <div class="span12">
            <div id="numero1" class="pull-left ">  <!-- This id numero1 is used for Joyride help --> 
                <div id="groupfollowSpinLoader" style="position:relative;"></div>
                <?php if(Yii::app()->session['PostAsNetwork']==1){?>
                <div  class="grouplogoheading padding8top" ><a href="/<?php   echo $groupStatistics->GroupName?>"><?php   echo $groupStatistics->GroupName?></a></div>    
                <?php }else{?>
                <div  class="grouplogoheading padding8top" ><a href="/<?php   echo $groupStatistics->GroupName?>"><?php   echo $groupStatistics->GroupName?></a></div>
                <?php }?>
            </div>
            <?php  $floatingMenuStyle='display:none';
            $displayPreferences='display:none';
            $displayAnaltics='display:none';
            if($groupStatistics->IsGroupAdmin==1 && in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $groupStatistics->GroupMembers)){
                        $floatingMenuStyle='display:block';
                        $displayPreferences='display:block';
                        $displayDiv='yes';
                    } 
                
                  if (Yii::app()->session['IsAdmin'] == 1 && $this->userPrivilegeObject->canViewAnalytics==1 || $groupStatistics->IsGroupAdmin==1) { 
                 $floatingMenuStyle='display:block';
                      $displayAnaltics='display:block';
                }?>
                <?php 
                    if(Yii::app()->session['PostAsNetwork']==1){
                        $floatingMenuStyle='display:block';
                        $displayPreferences='display:block';
                        $displayAnaltics='display:block';
                    }
                ?>
                <?php //if($customGroup == 0){?>
                <div class="floatingMenu pull-right padding8top" id='GroupAdminMenu' style='<?php echo $floatingMenuStyle ?>'>
                    
                    <ul>
                        <li style="<?php echo $displayPreferences?>" class="radioalign active"> <a href="#" class="preferences" data-toggle="dropdown" ><img id="preferences" class=" tooltiplink cursor" rel="tooltip"  data-original-title="Preferences" src="/images/system/spacer.png" /></a>
                             <div id="updatePreferences" class="dropdown dropdown-menu actionmorediv actionmoredivtop newgrouppopup newgrouppopupdivtop preferences_popup" >
            
			<div class="headerpoptitle_white"><?php echo "Preferences";?></div>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'groupcreation-form',
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
                        <div id="groupCreationSpinner"></div>
                <div class="alert alert-error" id="errmsgForGroupCreation" style='display: none'></div>
                <div class="alert alert-success" id="sucmsgForGroupCreation" style='display: none'></div> 
                
                <div class="row-fluid  ">
                    <div class="span12">

                       <?php echo $form->labelEx($preferencesModel, Yii::t('translation', 'GroupName')); ?>
                        <div class="e_descriptiontext" style="min-height: 20px;"><?php  echo $preferencesModel->GroupName?></div>
                        <div class="control-group controlerror">
                            <?php echo $form->error($preferencesModel, 'GroupName'); ?>
                        </div>
                    </div>
                </div>
                <div class="row-fluid  ">
                    <div class="span12">
                        
                    <?php echo $form->labelEx($preferencesModel, Yii::t('translation', 'GroupDescription')); ?>
                    <div class="collapse in" id="profileInPreferences">
                        <?php  $stringArray = str_split($groupStatistics->GroupDescription, 240);?>
                        <div id="groupDescriptionInPreferences" onclick="editGroupDescriptionInPreferences()" class="groupabout"><div class="e_descriptiontext" id="descriptioToshowInPreferences"><?php  echo $stringArray[0]?></div>
                        </div>
                            <div id="groupDescriptionTotalInPreferences" style="display:none;padding: 5px"     <?php   if($groupStatistics->IsGroupAdmin==1){?> onclick="editGroupDescriptionInPreferences()" <?php   }?> class="groupabout"><div class="e_descriptiontext" id="descriptioToshowInPreferences"><?php   echo $groupStatistics->GroupDescription?></div>

                        </div>


                        <div id="editGroupDescriptionInPreferences" style="display:none;">
                             <div class="editable groupAboutEdit" style="padding: 8px;">
                                  <div id="editGroupDescriptionTextInPreferences" class="e_descriptiontext"  contentEditable="true" ><?php   echo $groupStatistics->GroupDescription?></div>

                                       </div>
                            <div  class="alignright padding5"> 
                                <i id="updateGroupDescriptionInPreferences" class="fa fa-floppy-o editable_icons editable_icons_big" onclick='saveEditGroupDescriptionInPreferences("<?php   echo $groupStatistics->GroupId?>","GroupDescription","Group")'></i>
                           <i id="closeEditGroupDescriptionInPreferences" class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor" onclick='closeEditGroupDescriptionInPreferences()'></i></div>

                         </div>
                        </div>
                     </div>
                </div>
                <div class="row-fluid  ">
                    <div class="span12">
                        <?php echo $form->labelEx($preferencesModel, Yii::t('translation', 'GroupLogo')); ?>
                        <div class="alert alert-error" id="GroupLogoErrorInPreferences" style="display: none"></div>
                        <div class="grouplogo positionrelative editicondiv">

                            <div class="edit_iconbg tooltiplink cursor" data-original-title="Upload  40 x 90 dimensions" rel="tooltip" data-placement="bottom">
                                <div id='GroupLogoInPreferences'></div>


                                <div id="updateAndCancelGroupIconUploadButtonsInPreferences" style="display: none">
                             <i id="updateGroupIconInPreferences" class="fa fa-floppy-o editable_icons editable_icons_big" onclick='globalspace.preferences="InPreferences";saveGroupBannerAndIcon("<?php   echo $groupStatistics->GroupId?>","GroupProfileImage","Group")'></i>
                       <i id="cancelGroupIconInPreferences" class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor" onclick="cancelBannerOrIconUpload('<?php   echo $groupStatistics->GroupIcon?>','GroupProfileImage')"></i>
                            </div>
                                </div>
                            <img id="groupIconPreviewIdInPreferences" src="<?php   echo $groupStatistics->GroupIcon?>" alt="<?php   echo $groupStatistics->GroupName?>" />


                        </div>
                        <div ><ul class="qq-upload-list" id="uploadlist_logoPreferences"></ul></div>
                    </div>
                </div>
                <?php if($customGroup == 0){?>
                <div class="row-fluid padding8top" id="groupModeChangeButtons">
                   <?php if(Yii::app()->params['IFrameGroup']=='ON' && Yii::app()->params['CustomGroup']=='ON'){?>
                   <?php echo $form->labelEx($preferencesModel, 'Group Mode'); ?>
                   
                       <div class="span12">
                        <div class="span6" id="GroupCreationForm_NormalMode_radio">
                        <?php echo $form->radioButton($preferencesModel,'IFrameMode',array("value"=>0,"id"=>"GroupCreationForm_NormalMode",'uncheckValue'=>null,'class'=>'styled', 'onclick'=>'changeGroupMode("Native")')); ?>
                        Native Mode
                        </div>
                   
                        <div class="span6" id="GroupCreationForm_IFrameMode_radio">
                        <?php echo $form->radioButton($preferencesModel,'IFrameMode',array("value"=>1,"id"=>"GroupCreationForm_IFrameMode",'uncheckValue'=>null,'class'=>'styled', 'onclick'=>'changeGroupMode("IFrame")'));?>
                        IFrame Mode
                        </div>
                      
                      </div>
                     <?php }?>
                  </div>
                <?php } ?>
                <div class="row-fluid  " id="IFrameURLDiv" style="display: <?php echo (isset($preferencesModel->IFrameMode) && $preferencesModel->IFrameMode==1)?'block':'none'; ?>">
                    <div class="span12">

                       <?php echo $form->labelEx($preferencesModel, Yii::t('translation', 'IFrameURL')); ?>
                        <div class="alert alert-error" id="IFrameUrlErrorInPreferences" style="display: none"></div>
                        <div class="collapse in" id="profileIFrameUrlInPreferences">
                            <div id="IFrameUrlInPreferences" onclick="editIFrameUrlInPreferences()" class="groupabout"><div class="e_descriptiontext " id="IFrameUrlToshowInPreferences"><?php echo isset($preferencesModel->IFrameURL)?$preferencesModel->IFrameURL:"" ?></div>
                            </div>
                            <div id="editIFrameUrlInPreferences" style="display:none;">
                                <div class="editable groupAboutEdit" style="padding: 8px;">
                                    <div id="editIFrameUrlTextInPreferences" class="e_descriptiontext"  contentEditable="true" onkeyup="getsnipetIframe(this.id)"><?php echo isset($preferencesModel->IFrameURL)?$preferencesModel->IFrameURL:"" ?></div>

                                </div>
                                <div  class="alignright padding5"> 
                                    <i id="IFrameUrlInPreferences" class="fa fa-floppy-o editable_icons editable_icons_big" onclick='saveEditIFrameUrlInPreferences("<?php echo $groupStatistics->GroupId ?>","IFrameURL","Group")'></i>
                                    <i id="IFrameUrlInPreferences" class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor" onclick='closeEditIFrameUrlInPreferences()'></i></div>

                            </div>

                        </div>
                        <div class="control-group controlerror">
                            <?php echo $form->error($preferencesModel, 'IFrameURL'); ?>
                        </div>
                    </div>
                </div>
                <div  id="snippet_main" style="display:none; padding-top: 10px;padding-bottom:10px;" ></div>
                <?php if($preferencesModel->IsPrivate==0){?>
                <div class="row-fluid " id='AutoModeDiv'>
                 <div class="span12">                  
               
                    
                   <?php echo $form->checkBox($preferencesModel,'AutoFollow',array('class' => 'styled','onclick'=>'changeGroupAsAutoFollow("IFrame")'))?>
                         Auto follow this Toolbox
                    <div class="control-group controlerror">
                            <?php echo $form->error($preferencesModel, 'AutoFollow'); ?>
                        </div>
                
                 
                 </div>
                </div>

                <div class="row-fluid "  id='AddSocialActions'>
                            <div class="span12">                  


                                <?php echo $form->checkBox($preferencesModel, 'AddSocialActions', array('class' => 'styled')) ?>
                                <?php  echo  Yii::t('translation','Show_SocialAction_Label');?>
                                <div class="control-group controlerror">
                                    <?php echo $form->error($preferencesModel, 'AddSocialActions'); ?>
                                </div>


                           </div>
                 </div>
     <div class="row-fluid "  id='DisableWebPreview'>
                            <div class="span12">                  


                                <?php echo $form->checkBox($preferencesModel, 'DisableWebPreview', array('class' => 'styled')) ?>
                                  Disable Web Preview for URLs?  
                                <div class="control-group controlerror">
                                    <?php echo $form->error($preferencesModel, 'DisableWebPreview'); ?>
                                </div>


                           </div>
                 </div>

                <?php if($IsIFrameMode == 0){ ?>
                
                <div class="row-fluid "  id='groupConversations'>
                 <div class="span12">                  
               
                    
                   <?php echo $form->checkBox($preferencesModel,'ConversationVisibility',array('class' => 'styled'))?>
                         Show Conversations outside Toolbox
                    <div class="control-group controlerror">
                            <?php echo $form->error($preferencesModel, 'ConversationVisibility'); ?>
                        </div>
                
                 
                 </div>
                </div>
                
                <?php } }?>    
                <div class="groupcreationbuttonstyle alignright">
                    
                       
                </div>
            <?php $this->endWidget(); ?>
            </div>
                        </li>
                        <li style="<?php echo $displayAnaltics?>" class=""><a href="/<?php   echo $groupStatistics->GroupName?>/analytics" class="analytics" ><img class=" tooltiplink cursor" rel="tooltip"  data-original-title="Analytics" src="/images/system/spacer.png" /></a></li>
                        <?php if((($groupStatistics->IsGroupAdmin==1 || Yii::app()->session['PostAsNetwork'] == 1) && $IsIFrameMode!=0) || (($groupStatistics->IsGroupAdmin==1 || Yii::app()->session['PostAsNetwork'] == 1) && $hybrid == 0 && $customGroup == 1) ){ ?><li><a  id='IFramePost' class="post"><img class=" tooltiplink cursor" rel="tooltip"  data-original-title="Post" src="/images/system/spacer.png" /></a></li><?php } ?>
                    </ul>
                </div>
                     <div class="pull-right" style="padding-top:8px">
                   <?php if(Yii::app()->session['PostAsNetwork']==1){?>
                <span id="followGroupInDetail" style="padding: 0px" class="social_bar noborder profile_bar groupdetailfollow" data-groupid="<?php   echo $groupStatistics->GroupId ?>"  data-category="Group"> <a><i  ><img class=" tooltiplink  <?php   echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $groupStatistics->GroupMembers)?'Networkfollowbig':'Networkunfollowbig' ?>"  src="/images/system/spacer.png" data-placement="top" rel="tooltip"  data-original-title="<?php   echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $groupStatistics->GroupMembers)?'Unfollow':'Follow' ?>"></i></a> </span>
                <?php }else{?>
               <span id="followGroupInDetail" style="padding: 0px" class="social_bar noborder profile_bar groupdetailfollow" data-groupid="<?php   echo $groupStatistics->GroupId ?>"  data-category="Group"> <a><i  ><img class=" tooltiplink cursor <?php   echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $groupStatistics->GroupMembers)?'followbig':'unfollowbig' ?>"  src="/images/system/spacer.png" data-placement="top" rel="tooltip"  data-original-title="<?php   echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $groupStatistics->GroupMembers)?'Unfollow':'Follow' ?>"></i></a> </span>
                <?php }?>
                </div>
                <?php //}else{ ?>
<!--                <div ><a href="#" onclick="setMenuStyles('H');"> switch Horizontal</a></div>
                <div><a href="#" onclick="setMenuStyles('V');"> switch vertical</a></div>-->
                <?php //} ?>
            </div>
     </div>
</div>
    
    <script type="text/javascript">
        
        globalspace.groupMode = <?php echo (isset($preferencesModel->IFrameMode) && $preferencesModel->IFrameMode==1)?1:0; ?>;
      if(!detectDevices()){
            $("[rel=tooltip]").tooltip();
        }       
        <?php if($conversationVisibilitySettings == 1){ ?> 
            $("#GroupCreationForm_ConversationVisibility").attr("checked","checked");
        <?php }?>
      groupPreferencesInitializations('<?php echo $groupPostModel->GroupId ?>');
        sessionStorage.pageName = "group/groupdetail";//<!-- This is used to load joyride help for the selected group-->
        $(document).ready(function(){
           $("#updatePreferences").on("click touchstart",function(e){
               e.stopPropagation();
           })
        });
        
    </script>
