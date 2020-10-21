<script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script> 
<script type="text/javascript" src="<?php  echo Yii::app()->request->baseUrl; ?>/js/profile.js"></script> 
<?php include 'miniProfileScript.php'; ?>
<?php include 'hashTagProfileScript.php'; ?>
<?php include 'commentscript.php'; ?>
<?php include 'inviteScript.php'; ?>
<?php include 'snippetDetails.php'?>
<?php 



?>
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
                           <button type="button" id="profileBtn" class="btnint profilei" >Profile</button>                            
                            <button type="button" id="profileIntBtn" class="btnint profilei ">Interactions</button>
                        </div>
                </div>  
                <div id="numero1">  <h2 class="pagetitle">Profile </h2> </div><!-- This id numero1 is used for Joyride help -->
               <div class="row-fluid row-fluid_profilesummary">
     <div class="span12">
     	<div class="span4 span4custom">
        <div class="p_summary">
         <div class="padding10">
  <div class="p_card">
                 
  <div class="p_icon">
         <?php  if($IsUser == 1){?> <div class="p_icon_help"><i data-original-title=" please click on profile picture to upload " rel="tooltip" data-placement="bottom" style="z-index:999;  " class="fa fa-question helpicon helpmanagement top10  tooltiplink" ></i> </div>  <?php  } ?>
      <div class="alert alert-error" id="ProfileImageError" style="display: none"></div>
                        <div class="marginzero smallprofileicon noBackGrUp">
                            
                            <div class="positionrelative editicondiv editicondivProfileImage no_border ">
                                
                                <div class="edit_iconbg top75" style="display: none;">
                                    <div id="UserProfileImage"></div>


                                    
                                </div>
<!--                                <img id="profileImagePreviewId" src="<?php  //echo $profileDetails->ProfilePicture ?>" alt="" />-->
                               <img id="profileImagePreviewId" src="<?php  if(isset($profileDetails->profile250x250) && $profileDetails->profile250x250 !='null'){echo $profileDetails->profile250x250;}else{ echo '/upload/profile/user_noimage.png';}  ?>"  alt="" />
                            </div>
                
                            <div ><ul class="qq-upload-list" id="uploadlist_logo"></ul></div>
                        </div>
        </div>
      <div id="previewDiv" class="profilepreviewDiv" style="display: none">
             <img id="profileImagePreviewDisplay" src="<?php  if(isset($profileDetails->profile250x250) && $profileDetails->profile250x250 !='null'){echo $profileDetails->profile250x250;}else{ echo '/upload/profile/user_noimage.png';}  ?>"  alt="" />
             <div class="profilepreviewDivbuttons">                           
             <i id="updateGroupIcon" class="fa fa-floppy-o editable_icons editable_icons_big" onclick="saveUserProfileImage('<?php  echo $profileDetails->UserId?>','ProfilePicture')"></i>
                                        <i class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor" onclick="cancelProfileImageUpload('<?php  echo $profileDetails->ProfilePicture?>','ProfilePicture')"></i>
                                    </div>
      </div>
      
      
       <?php  if($IsUser != 1){?>
  <span class="social_bar noborder"> 
       <div id="miniprofile_spinner_modal" style="position: relative;" class="grouppostspinner"></div>
           <?php if(isset($networkAdmin) && $networkAdmin==$profileDetails->UserId){ ?>
                                 <a class="userId nonNetworkAdmin"><i data-placement="bottom" rel="tooltip" >
                                    <img id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" src="/images/system/spacer.png" 
                                                 class="tooltiplink <?php  if($profileDetails->IsFollowed==0){ echo 'unfollow'; }else{ echo 'follow'; }?>" >
                                </i></a>
                            <?php }else{ ?>
                            <a><i data-placement="bottom" rel="tooltip"   <?php  if(empty($profileDetails->IsFollowed)){ ?> data-original-title="Follow" <?php }else{?>  data-original-title="Unfollow"  <?php }?> >
                                    
                             <img                                           
                                             <?php  if(empty($profileDetails->IsFollowed)){ ?>  onclick="userFollowUnfollowActions('<?php  echo $profileDetails->UserId;?>','follow','profile');" 
                                                 <?php  }else{?>  onclick="userFollowUnfollowActions('<?php  echo $profileDetails->UserId;?>','unfollow','profile');"
                                                 <?php  } ?> id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" src="/images/system/spacer.png" 
                                                 class="tooltiplink cursor <?php  if($profileDetails->IsFollowed==0){ echo 'unfollow'; }else{ echo 'follow'; }?>" >
                                </i></a>
                            <?php  } ?>
                                    </span>
      
       <?php }?> 
      
      
      
      
      
                                      <div class="paddingleft10 paddingtop4">
                                    <div class="pagetitle profiletitle paddingzero lineheight20 positionrelative  editProfileDisplayName" id="profileFirstName"><?php  echo $displayName ?> </div>
<!--                        <div class="edit_iconbg edit_padding-top-3">-->

                            <div id="editProfileDisplayName" style="display:none" class="positionrelative minheight21">
                            <div class="editable editProfileFirstName_edit">
                                <input id="editProfileDisplayNameText" class="profiletitleedit"   value="<?php  echo $displayName ?>" contentEditable="true" onblur="checkKeyPress(event,'DisplayName')"  onkeypress="checkKeyPress(event,'DisplayName')"/>

                            </div>
                            <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
                                
                            </div>
                            <!--</div>-->
                        </div>


                                   
                                        <div class="p_summarytitle " ><div> 
                                                <?php $displayPosition = (strlen($profileDetails->Speciality) != 0)?"show":"hide"; ?>
                                                <span style="display:block" class="editProfileSpeciality <?php echo ($profileDetails->Speciality=="" && $IsUser==1) ?'Specialityplaceholder':''?>" placeholder="Specialty" id="p_position"><?php echo $profileDetails->Speciality ?></span> 
                                                                         <div id="editProfileSpeciality" style="display:none" class="positionrelative minheight21">
                            <div class="editable editProfileSpeciality_edit">
                                <input id="editProfileSpecialityText" class="profiletitleedit" value="<?php  echo $profileDetails->Speciality ?>" onblur="checkKeyPress(event,'Speciality')" onkeypress="checkKeyPress(event,'Speciality')"  contentEditable="true"/>

                            </div>
                            <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
<!--                                <i onClick="saveEditPersonalInformation('Speciality');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                <i onClick="closeEditPersonalInformation('Speciality');" id="closeEditPersonalInformation"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>-->
                            </div>
                            <!--</div>-->
                        </div>
                                                 
                                             </div> </div>
                                    </div>
  </div>
  </div>
  <div class="bordertop">
  <div class="padding10">
      
      <div class="p_summarytitle " style="text-align: center" ><div> 
                                                <?php $displayPosition = (strlen($profileDetails->Position) != 0)?"show":"hide"; ?>
                                                    <span style="display:<?php echo $displayPosition; ?>" class="editProfilePosition <?php echo ($profileDetails->Position=="" && $IsUser==1)?'Positionplaceholder':''?>" id="p_position"><?php echo $profileDetails->Position ?></span> 
                                                                         <div id="editProfilePosition" style="display:none" class="positionrelative minheight21">
                            <div class="editable editProfilePosition_edit">
                                <input id="editProfilePositionText" class="profiletitleedit"  value="<?php  echo $profileDetails->Position ?>" onblur="checkKeyPress(event,'Position')" onkeypress="checkKeyPress(event,'Position')"   contentEditable="true" />

                            </div>
                            <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
<!--                                <i onClick="saveEditPersonalInformation('Position');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                <i onClick="closeEditPersonalInformation('Position');" id="closeEditPersonalInformation"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>-->
                            </div>
                            <!--</div>-->
                        </div>
                                                 
                                             </div> </div>
          
            <div class="p_summarytitle " style="text-align: center" ><div> 
                                                <?php $displayPosition = (strlen($profileDetails->Company) != 0)?"show":"hide"; ?>
                                                    <span style="display:<?php echo $displayPosition; ?>" class="editProfileCompany <?php echo ($profileDetails->Company=="" && $IsUser==1)?'Companyplaceholder':''?>" id="p_position"><?php echo $profileDetails->Company ?></span> 
                                                                         <div id="editProfileCompany" style="display:none" class="positionrelative minheight21">
                            <div class="editable editProfileCompany_edit">
                                <input id="editProfileCompanyText" class="profiletitleedit"  value="<?php  echo $profileDetails->Company ?>" onblur="checkKeyPress(event,'Company')" onkeypress="checkKeyPress(event,'Company')"  contentEditable="true"/> 

                            </div>
                            <div  id="updateAndCancelFirstNameIconUploadButtons" class="edit_iconbar">
<!--                                <i onClick="saveEditPersonalInformation('Company');" class="fa fa-floppy-o editable_icons editable_icons_big" id=""></i>
                                <i onClick="closeEditPersonalInformation('Company');" id="closeEditPersonalInformation"  class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor"></i>-->
                            </div>
                            <!--</div>-->
                        </div>
                                                 
                                             </div> </div>
            </div>
  </div>
  <div class="bordertop">
  <div class="padding10 p_description positionrelative">
              <div class="p_content positionrelative  editAboutMe clearboth">
                  <div id="profile_AboutMe" style="display:block" class="editicondiv minheightDiv <?php echo (strlen($profileDetails->AboutMe)==0 && $IsUser==1)?'Descriptionplaceholder':''?>"><?php  echo substr($profileDetails->AboutMe, 0,200); ?>
                  <?php if(strlen($profileDetails->AboutMe)>200){?>
                      <a id='displayTotalAboutMe' style="font-size:20px;cursor: pointer;text-decoration: none;">... </a>
                  <?php }?>
                       </div>     <div id="editProfileAboutMe" style="display:none">
                                <div class="editable groupAboutEdit" id="">
                                    <textarea id="editProfileAboutMeDescriptionText" rows="8" style="margin: 0;padding: 0;width: 99%;" class="e_descriptiontext"  onblur="checkKeyPress(event,'AboutMe')"  onkeypress="checkKeyPress(event,'AboutMe')"   contentEditable="true" ><?php  echo $profileDetails->AboutMe ?></textarea>

                                </div>
                                
                            </div>
                 
                                
                            </div>
       <div id="displayTotalAboutMeDiv" style="display:none" class="displayTotalAboutMeDiv">
                                <div class="editable " id="">
                                    <div id="" class="e_descriptiontext"  ><?php  echo $profileDetails->AboutMe ?></div>

                                </div>
                    </div>
            </div>
  </div>
   <div class="bordertop">
  <div class="padding5 grouphomemenu followssection ">
  <ul>
      <li class="half">
    <div class="p_custleft22">
        <div class="pro_box p_followers">
        <div class="pro_boxicon">
        <img data-original-title="Followers" rel="tooltip" data-placement="bottom" class="tooltiplink p_followers" src="/images/system/p_followersicon.png">
        </div>
        <div class="menubox">
     <div class="groupmenucount "><i id='p_followersCount'><?php echo $profileDetails->UserFollowersCount ?></i ></div>
    <ul>
       <?php  if($profileDetails->UserFollowersCount >0){?>
         <?php $i=0;?>
         <?php foreach($userFollowers as $followersPic){?>     
      <?php   if($i<=9){?>
                   <li>
               <div class="menusubbox"><img src="<?php echo $followersPic?>"/></div>      
             </li>
            <?php   }else{
                break;}?>
               <?php   $i++ ?>
         <?php }} ?>
              <?php   for($j=1;$j<=9-$i;$j++){?>
              <li>
     <div class="menusubbox"></div>
     
     </li>
             <?php   }?>
     
     </ul>
     
     </div>
        </div>
     	</div>
     	</li>
     	<li class="half">
        <div class="p_custleft22">
        <div class="pro_box p_following">
        <div class="pro_boxicon">
        <img data-original-title="Following" rel="tooltip" data-placement="bottom" class="tooltiplink "src="/images/system/p_followingicon.png">
        </div>
        <div class="menubox">
     <div class="groupmenucount"><i id='p_followingCount'><?php echo $profileDetails->UserFollowingCount ?></i ></div>
     <ul>
        <?php  if($profileDetails->UserFollowingCount >0){?>
         <?php $i=0;?>
         <?php foreach($userFollowing as $followingPic){?>     
      <?php   if($i<=9){?>
                   <li>
               <div class="menusubbox"><img src="<?php echo $followingPic?>"/></div>      
             </li>
            <?php   }else{
                break;}?>
               <?php   $i++ ?>
         <?php }} ?>
              <?php   for($j=1;$j<=9-$i;$j++){?>
              <li>
     <div class="menusubbox"></div>
     
     </li>
             <?php   }?>
     
     </ul>
     
     </div>
        </div>
     	</div>
     	</li>
     	
        </ul>
  </div>
  </div>
        </div>
        
        </div>
<div class="span8 span8custom">
    <div class="p_summary padding10" >
            <?php  if($loginUserId==$profileDetails->UserId){
                        $userDisplayName = "You ";
                        $pre = " are ";
                    }else{
                        $userDisplayName = $profileDetails->DisplayName;
                        $pre = " is ";
                    }?>
        <div class="row-fluid">
            <div class="span6">
            
                        <?php if(count($userBadges)>0){?>
                            <ul  class="profileboxsection">
                                <li id="badgesInt" class="" style="min-height: 10px">
                                    <div class="groupmenucount"><i><?php echo count($userBadges)?></i></div>
                        <div class="post item" style="">
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b> have unlocked these badges</div>
                            <div class="padding4 clearfix badgeimages">
                                <?php if(count($userBadges)>0){?>
                               <?php foreach ($userBadges as $value) { ?>
                                <span><a data-original-title="<?php echo $value['hovertxt']; ?>" rel="tooltip" data-placement="bottom" class="badgesId" data-showIntroPopUp="<?php echo $value['hovertxt']?>" data-value="<?php echo $value['id'] ?>" >
                                        
                                    <?php if($value['isCustom']==1){ 
                                        $image= $value['imgpath'];                                        
                                        $i=explode('.', strrev($image));
                                        $ext=strrev($i[0]);
                                        $name=strrev($i[1])."_38x44.".$ext;                                      
                                       ?>                                         
                                        <img src="<?php echo  $name ?>" alt="<?php echo $value['hovertxt'] ?>" />
                                  <?php  }  else{?>
                                        <img src="<?php echo "/images/badges/".$value['badgeName']."_38x44.png" ?>" alt="<?php echo $value['hovertxt'] ?>" />
                                    <?php } ?>  
                                        
                                    
                                    </a></span>
                                <?php } } else {?>
                                <?php echo $userDisplayName.' have not unlocked any of the badges';}?>
                               
                        </div>
                        </div>
                    </li>
                               </ul> 
                        
                          <?php } ?>
            </div>
            <div class="span6">
                <?php if($userFollowingGroups['totalGroupsCount']>0){?>
                            <ul  class="profileboxsection">
                                 
                                <li id="groupsInt" class="">
                 <div class="groupmenucount"><i><?php echo $userFollowingGroups['totalGroupsCount']?></i></div>
                      
                    
                        <div class="post item" style="">
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?>following these groups</div>
                            <div class="padding4 clearfix groupimages">
                                <?php if($userFollowingGroups['totalGroupsCount']>0){?>
                                <?php foreach ($userFollowingGroups['groupsList'] as $value) { ?>
                                <span><a class="groupId" data-showIntroPopUp="<?php echo $value['showIntroPopup']?>" data-value="<?php echo $value['id'] ?>" ><img src="<?php echo $value['groupProfileImage'] ?>" alt="<?php echo $value['name'] ?>" /></a></span>
                            <?php } } else {?>
                                <?php echo $userDisplayName. ' '.$pre.'  not following any of the groups';}?>
                               
                        </div>
                        </div>
                    
                    
                    </li>
                               </ul> 
                        
                        <?php } ?>
            </div>
            
        </div>
        <div class="row-fluid">
            <div class="span6">
                  <?php if($userFollowingHashtags['totalHashTagCount']>0){?>   
                            <ul class="profileboxsection">
                                <li  id="hashtagInt" class="">
                                    <div class="groupmenucount"><i><?php echo $userFollowingHashtags['totalHashTagCount']?></i></div>
                        <div class="post item" style="">
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?>following these hashtags</div>
                            <div class="padding4">
                                <?php if($userFollowingHashtags['totalHashTagCount']>0){?>
                                <?php foreach ($userFollowingHashtags['hashtags'] as $value) { ?>
                                <span id="stream_view_spinner_<?php echo $value['id']; ?>" class="grouppostspinner"></span>
                                <span class="atwho-view-flag atwho-view-flag-#">
                                    <span class="dd-tags hashtag" data-id="<?php echo $value['id']; ?>"><b>#<?php echo $value['name'] ?></b></span>
                                </span>
                            <?php } } else {?>
                                <?php echo $userDisplayName. ' '.$pre.'  not following any of the hashtags';}?>
                        </div>
                            </div>
                    </li>
                               </ul> 
                        
                      <?php } ?>
            </div>
            <div class="span6">
                <?php if($userFollowingCategories['totalCategoriesCount']>0){?>

                            <ul  class="profileboxsection" >
                                <li class="" id="curbsideInt">
                                    <div class="groupmenucount"><i><?php echo $userFollowingCategories['totalCategoriesCount']?></i></div>
                         <div class="post item" style="">
                            <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b><?php echo $pre; ?>following these  <?php echo strtolower($name);?> categories</div>
                            <div class="padding4">
                                 <?php if($userFollowingCategories['totalCategoriesCount']>0){?>
                                <?php foreach ($userFollowingCategories['categories'] as $value) { ?>
                                <span class="fontbold comma"><a class="curbsideCategory" data-id="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></a></span>
                            <?php } } else {?>
                                <?php echo $userDisplayName. ' '.$pre.' not following any '.$name.' categories';}?>
                        </div>
                       </div>
                    </li>
                               </ul> 
                        
                           <?php } ?>
            </div>
            
        </div>
    </div>
</div> 

     </div>
     </div>
                 
                
        <div> 
           <div class="row-fluid">
             <div class="span12 padding8top">
                    
            <h2 id="ProfileInteractionsDisplayName" class="pagetitle"><?php  echo $profileDetails->DisplayName."'s " ?> Recent Interactions</h2>
              <div id="main" role="main">
              <?php  if($loginUserId==$profileDetails->UserId){
                        $userDisplayName = "You";
                        $pre = " are ";
                    }else{
                        $userDisplayName = $profileDetails->DisplayName;
                        $pre = " is ";
                    }?>
                    <ul id="ProfileInteractionDiv" class="profilebox"></ul>
                 </div>
            <?php $moreToDisplay=$userInteractionsCount -10?>
             <?php if($moreToDisplay >0){ ?>
                  <div class="alignright" id='goToInteractions'><input type="button" value="<?php echo $moreToDisplay ." more ..."?>" name="yt0"  class="btn"></div>
           <?php }?>
        </div>
        </div>
       </div>
                </div>
            <div id="postDetailsDivInProfile"></div>
              </div>
            
            <?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
</div>
    </div>
            <?php }?>
<script type="text/javascript">
     $("#profileCVBtn,#profileIntBtn").removeClass("active");
     $("#profileBtn").addClass("active");
</script>
<script type="text/javascript">
   
     $(document).ready(function($) {
           bindActionsForUserProfilePage()
        $("#editProfileSave").hide();          
            
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
                     $("#displayTotalAboutMe").mouseover(function(){
                       //   $('#displayTotalAboutMe').hide();  
                           $('#displayTotalAboutMeDiv').show(); 
                    }).mouseout(function(){
                       //$('#displayTotalAboutMe').show();  
                           $('#displayTotalAboutMeDiv').hide(); 
                    });
                }else{
                    $(".edit_iconbg,#editButtonId").show();
                }
                <?php  if($IsUser != 1){?>
        $('#profileViewDiv').removeClass("editicondiv");
        $('#profile_AboutMe').removeClass("editicondiv");
          <?php }?>
              var minHeight=$("#fixedWidgets").height();
            $("#curbsideInt").css('min-height', minHeight);  
            $("#groupsInt").css('min-height', minHeight);  
            $("#badgesInt").css('min-height', minHeight);  
            $("#hashtagInt").css('min-height', minHeight);  
         
          
    });
 
    <?php  if($IsUser==1) {?>
    bindEditForProfile();
var extensions ='"jpg","jpeg","gif","png","tiff"';
initializeFileUploader('UserProfileImage', '/user/UploadProfileImage', '10*1024*1024', extensions,1, 'UserProfileImage' ,'',ProfilePreviewImage,displayErrorForBannerAndLogo12,"uploadlist_logo");
<?php  }?>
    var handler = null;
    var options = {
      itemWidth: '103%', // Optional min width of a grid item
      autoResize: true, // This will auto-update the layout when the browser window is resized.
      container: $('#ProfileInteractionDiv1'), // Optional, used for some extra CSS styling
      offset: 8, // Optional, the distance between grid items
      outerOffset: 10, // Optional the distance from grid to parent
       flexibleWidth: '10%', // Optional, the maximum width of a grid item
      align: 'left'
    };
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
    getCollectionData('/user/getprofileintractions', 'UserId='+<?php  echo $profileDetails->UserId; ?>+'&ProfileIntractionDisplayBean', 'ProfileInteractionDiv', 'No data found','That\'s all folks!');   
    isDuringAjax=true;
    //initializeScrolling(URL, CollectionName, MainDiv, NoDataMessage, NoMoreDataMessage,id);
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
    
     if("<?php echo $profileDetails->UserFollowersCount ?>" > 0){
    
      $('.p_followers').live("click",function(){
                 tpage=0;                
                 tFPopupAjax = false; 
                 $("#userFollowersFollowings_body").empty();
                  getUserProfileFollowers('<?php  echo $profileDetails->UserId ?>','<?php echo $profileDetails->DisplayName ?>');
                  
              });    
         }           
          
          if("<?php echo $profileDetails->UserFollowingCount ?>" > 0){

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
$("#cvCreateAnchor").bind("click",function(){
     var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
    sessionStorage.userProfile = urlArr[1];
    window.location.href = "/profileCV/"+urlArr[1];
})
$(".profilei").live("click",function(){
    var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
    sessionStorage.userProfile = urlArr[1];
   var tabName = $.trim($(this).html());
   if(tabName == "Profile"){
       window.location.href = "/profile/"+urlArr[1];
   }else if(tabName == "Interactions"){
       window.location.href = "/interaction/"+urlArr[1];
   }else if(tabName == "CV"){
       var displayCV='<?php echo $displayCV;?>';
                  window.location.href = "/userCVView/"+urlArr[1];
   }
   
});
$('#displayTotalAboutMe').on('click',function(){
   // $('#profile_AboutMe').hide();
  //  $('#displayTotalAboutMe').hide();  
    //$('#displayTotalAboutMeDiv').show();    
});
if(typeof socketNotifications !== "undefined")
//        socketNotifications.emit('clearInterval',sessionStorage.old_key); 
           $('#goToInteractions').live('click',function(){
                   var url = window.location.pathname.substr(1);
                   var urlArr = url.split("/");
            window.location.href = "/interaction/"+urlArr[1];
        });

$("#showpdffile").live('click',function(){
  var uri = $(this).data('uri');
  var id = 'player';
  loadDocumentViewer(id, uri, "","",400,500);
  $("#showoriginalpicture").hide()
  $("#myModal_old").modal('show');
}); 

$("#showpdffile1").live('click',function(){
  var uri = $(this).data('uri');
  var id = 'player';
  loadExternalDocumentViewer(id, uri, "","",400,500);
  $("#showoriginalpicture").hide()
  $("#myModal_old").modal('show');
}); 
$("#viewfullprofile").bind("click",function(){
    var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
    window.location.href = "/userCVView/"+urlArr[1];
});
$("#addeditprofile").click(function(){
    var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
    window.location.href = "/profileCV/"+urlArr[1];
});

        
      function checkKeyPress(e,type){          
          if(e.keyCode==13 || e.type=='blur'){                
            if(type=='AboutMe'){                
              saveEditProfileAboutMe('<?php  echo $profileDetails->UserId ?>','AboutMe');            
            }else{
                if(type=='DisplayName'){
                    
                    if($.trim($("#editProfile"+type+"Text").val())!=''){
                     saveEditPersonalInformation(type);      
                    }else{
                    //   $('#ProfileImageError').html('display name cannot be empty');
                     //  $('#ProfileImageError').show();
                    }
                }else{
                    saveEditPersonalInformation(type);  
                }
               
            }          
              
          }
      }  
   function savePersonalInformation(){
   
   }   
</script>
    