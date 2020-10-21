<?php if($profileDetails->Status==1){?>
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
                           <button type="button" id="profileBtn" class="btnint profilei"  data-name="Profile"><?php echo Yii::t('translation','Profile'); ?></button>   
                           <?php if(Yii::app()->params['CVProfile']=='ON'){?>
                            <button type="button" id="profileCVBtn" class="btnint profilei" data-name="CV"><?php echo Yii::t('translation','CV'); ?></button>
                           <?php }?> 
                            <button type="button" id="profileIntBtn" class="btnint profilei " data-name="Interactions"><?php echo Yii::t('translation','Interactions'); ?></button>
                        </div>
                </div>  
                <div id="numero1">  <h2  class="pagetitle"><?php echo Yii::t('translation','Profile'); ?> </h2> </div><!-- This id numero1 is used for Joyride help -->
               <div class="row-fluid row-fluid_profilesummary ">
     <div class="span12">
     	<div class="span4">
        <div class="p_summary businesscardedit positionrelative">
            <?php  if($IsUser == 1){?> 
            <div class="businesscardediticon" id="EditprofileiconDiv">
                       <img src="/images/system/profile_edit_icon.png" class="editprofileicon" onclick="openUserEditProfile()"/>
                   </div>
            <?php } ?>
         <div class="padding10" id="numeroProfile">
  <div class="p_card profile_editcard padding-bottom5"  >
        
      <div id="profileEditDiv" style="display:none;">
                 <?php  if($IsUser == 1){  ?>
          <div id="UserprofileEditDiv" >
              
          </div>              
                          <?php  } ?>              
  </div>   
     
  <div class="p_icon profile_iconedit">
         <?php  if($IsUser == 1){?> <div  style="display:none;" class="p_icon_help" id="UserProfilePicHelpIcon"><i data-original-title="<?php echo Yii::t('translation','click_on_profile_picture_to_upload'); ?> " rel="tooltip" data-placement="bottom" style="z-index:999;  " class="fa fa-question helpicon helpmanagement top10  tooltiplink" ></i> </div>  <?php  } ?>
      <div class="alert alert-error" id="ProfileImageError" style="display: none"></div>
                        <div class="marginzero smallprofileicon noBackGrUp">
                            
                            <div class="positionrelative editicondiv editicondivProfileImage no_border ">
                                
                                <div class="edit_iconbg top75" style="display: none;">
                                    <div id="UserProfileImage"></div>


                                    
                                </div>

                                <img id="profileImagePreviewId" src="<?php  if(isset($profileDetails->profile250x250) && $profileDetails->profile250x250 !='null'){echo $profileDetails->profile250x250;}else{ echo '/upload/profile/user_noimage.png';}  ?>"  alt="" />
                            </div>
                
                            <div  style="display:none;"><ul class="qq-upload-list" id="uploadlist_logo"></ul></div>
                        </div>
</div>
      <div id="previewDiv" class="profilepreviewDiv" style="display: none">
             <img id="profileImagePreviewDisplay" src="<?php  if(isset($profileDetails->profile250x250) && $profileDetails->profile250x250 !='null'){echo $profileDetails->profile250x250;}else{ echo '/upload/profile/user_noimage.png';}  ?>"  alt="" />
             <div class="profilepreviewDivbuttons">                           
             <i id="updateGroupIcon" class="fa fa-floppy-o editable_icons editable_icons_big" onclick="saveUserProfileImage('<?php  echo $profileDetails->UserId?>','ProfilePicture')"></i>
                                        <i class="fa fa-times-circle editable_icons editable_icons_big darkgreycolor" onclick="cancelProfileImageUpload('<?php  echo $profileDetails->ProfilePicture?>','ProfilePicture')"></i>
                                    </div>
      </div>
      
      
       <?php  if($IsUser != 1){  ?>
  <span class="social_bar noborder" style="right:0;top:3px;z-index: 10"> 
       <div id="miniprofile_spinner_modal" style="position: relative;" class="grouppostspinner"></div>
           <?php if(isset($networkAdmin) && $networkAdmin==$profileDetails->UserId){ ?>
                                 <a class="userId nonNetworkAdmin"><i data-placement="bottom" rel="tooltip" >
                                    <img id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" src="/images/system/spacer.png" 
                                                 class="tooltiplink <?php  if($profileDetails->IsFollowed==0){ echo 'unfollow'; }else{ echo 'follow'; }?>" >
                                </i></a>
                            <?php }else{ ?>
                            <a><i data-placement="bottom" rel="tooltip"   <?php  if(empty($profileDetails->IsFollowed)){ ?> data-original-title="<?php echo Yii::t('translation','Follow'); ?>" <?php }else{?>  data-original-title="<?php echo Yii::t('translation','UnFollow'); ?>"  <?php }?> >
                                    
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
          <div style="display:block;word-wrap: break-word;" class="pagetitle profiletitle paddingzero lineheight20 positionrelative tabblock padding4812" id="p_DisplayName"><?php echo $displayName ?> </div>
      </div>
      </div>
  </div>
  <div id="userProfileView" style="display:block;">
    <?php 
    
    $credentialsDisplay= ((strlen($profileDetails->Credentials) != 0) || (strlen($profileDetails->LicenceNumber) != 0)) ? 'block' : 'none';
    ?>  
  <div class="bordertop" id="P_CredentialsDiv" style="display:<?php echo $credentialsDisplay;?> ">
  <div class="padding10 " >
      
      <div class="p_summarytitle " style="text-align: center" >
             <?php $cdisplay=(strlen($profileDetails->Credentials) != 0)?'':'none';  ?>
          <?php $ldisplay=(strlen($profileDetails->LicenceNumber) != 0)?'':'none';  ?>
          <?php $separatorDisplay=(strlen($profileDetails->LicenceNumber) != 0 &&  strlen($profileDetails->Credentials) != 0)?"":"none";?>
          <div>
              <span style="display:<?php echo $cdisplay;?>" id="p_Credentials"><?php echo $profileDetails->Credentials ?></span>
              <span id="CLseparator" style="display:<?php echo $separatorDisplay;?>">,</span>
              <span  style="display:<?php echo $ldisplay;?>" id="p_StateLicenceNumber"><?php echo $profileDetails->LicenceNumber ?></span> 
          </div>
      </div>
  </div>
  </div>
       
     <?php 
    $SpecialityDisplay= ((strlen($profileDetails->UserSubSpeciality) != 0) || (strlen($profileDetails->UserSpeciality) != 0) || (strlen($profileDetails->Title) != 0)|| (strlen($profileDetails->PracticeName) != 0) || ($profileDetails->UserSpeciality=="" && $profileDetails->OtherSpeciality!="")) ? 'block' : 'none';
    
    ?>
     
  <div class="bordertop" id="P_stp" style="display:<?php  echo $SpecialityDisplay;?>">
  <div class="padding10">
      
      <div class="p_summarytitle " style="text-align: center;word-wrap: break-word;" id="p_specialitydiv">
              <?php if(strlen($profileDetails->UserSubSpeciality) != 0 || strlen($profileDetails->UserSpeciality) != 0){ $Utsdisplay=""; }else{ $Utsdisplay="none" ; } ?>
              <span style="<?php echo $Utsdisplay; ?>" id="p_Speciality"><?php echo (strlen($profileDetails->UserSubSpeciality) != 0 && $profileDetails->UserSubSpeciality!="Other")? $profileDetails->UserSubSpeciality : $profileDetails->OtherSpeciality ?></span> 
              
      </div>
       <div class="p_summarytitle " style="text-align: center;word-wrap: break-word" id="p_titlediv">
            <?php $Utdisplay=(strlen($profileDetails->Title) != 0)?'':'none';  ?>
              <span  style="<?php echo $Utdisplay;?>"  id="p_Title"><?php echo $profileDetails->Title ?></span> 
      </div>
      <div class="p_summarytitle " style="text-align: center;word-wrap: break-word;" id="p_practicenamediv">
           <?php $updisplay=(strlen($profileDetails->PracticeName) != 0)?'':'none';  ?>
              <span   style="<?php echo $updisplay;?>" id="p_PracticeName"><?php echo $profileDetails->PracticeName ?></span> 
            
      </div>
  </div>
  </div>
       
 <div class="bordertop">
  <div class="padding10">
      
      <div class="p_summarytitle " style="text-align: center" >
          <div> 
                <?php if(strlen($profileDetails->City) != 0){ ?>
              <span   id="p_City"><?php echo $profileDetails->City ?></span> ,
                  <?php } ?>
              <?php if((strlen($profileDetails->UserState) != 0)){?>
              <span  id="p_State"><?php echo $profileDetails->UserState ?></span> 
              <?php } ?>

          </div>
      </div>
  </div>
  </div>
      <?php $abtdisplay=(strlen(trim($profileDetails->AboutMe)) != 0)?'block':'none';  ?>
      
  <div class="bordertop" id="p_AbtDisplay" style="display:<?php echo $abtdisplay; ?>">
  <div class="padding10 p_description positionrelative">
      <div class="p_content positionrelative   clearboth" style="padding-top:0">
        <div id="p_AboutMe" style="display:block;word-wrap:break-word " class=" minheightDiv"><?php  echo substr($profileDetails->AboutMe, 0,200); ?>
        <?php if(strlen($profileDetails->AboutMe)>200){?>
            <a id='displayTotalAboutMe' class="fa moreicon moreiconcolor" style="cursor: pointer;text-decoration: none;"><?php echo Yii::t('translation','Readmore')?> </a>
        <?php }?>
         </div>    
       </div>
       <div id="displayTotalAboutMeDiv" style="display:none" class="displayTotalAboutMeDiv">
            <div class="editable " id="">
                <div id="p_TotalAboutMe" class="e_descriptiontext"  ><?php  echo $profileDetails->AboutMe ?></div>

            </div>
        </div>
  </div>
  </div>

       <?php $undisplay=(strlen($profileDetails->Userinterests) != 0)?'block':'none';  ?>
 <div class="bordertop" style="display:<?php echo $undisplay;?>" id="p_UserInterests">
  <div class="padding10">
      
      <div class="p_summarytitle "  id="userProfile_Interests"  >
        
      </div>
  </div>
  </div>     
      

 
        </div>
            
    
<!---------------------------------------- END PROFILE DETAILSSSSSSSSSSSSSSSSSSSSSSSSSSSSS------------------------------------------->          
            
            
            
   <div class="bordertop">
  <div class="padding5 grouphomemenu followssection ">
  <ul>
      <li class="half">
    <div class="p_custleft22">
        <div class="pro_box p_followers">
        <div class="pro_boxicon">
        <img data-original-title="<?php echo Yii::t('translation','Followers'); ?>" rel="tooltip" data-placement="bottom" class="tooltiplink p_followers" src="/images/system/p_followersicon.png">
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
        <img data-original-title="<?php echo Yii::t('translation','Following'); ?>" rel="tooltip" data-placement="bottom" class="tooltiplink "src="/images/system/p_followingicon.png">
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
           <?php if(Yii::app()->params['CVProfile']=='ON'){?>
            <?php 
              if(($userCVDetails!='failure' && count($userCVDetails)>0 )&&((isset($userCVDetails['education'])&& count($userCVDetails['education'])>0) || (isset($userCVDetails['interests'])&& $userCVDetails['interests'][0]['Tags'] != "") )){ ?>
          
         <div class="span8 span8custom">
<div class="p_summary">
<div class="padding10">
<div class="cvtitle"><?php echo $profileDetails->DisplayName ?>’s  CV</div>
</div>
    
 
<div class="bordertop">

    <?php $cv=0;?>
    
    <div id="CV_Profile_Subdiv_0"></div>
    <div id="CV_Profile_Subdiv_1"></div>
     <div id="CV_Profile_Subdiv_2"></div>
      <div id="CV_Profile_Subdiv_3"></div>
       <div id="CV_Profile_Subdiv_4"></div>
    
    <!--- publications -->
   <div id="profile_publicationsdiv">   
<?php if( isset($userCVDetails['publications'])&& count($userCVDetails['publications'])>0 && $userCVDetails['publications'] != "failure"){  ?>
<div class="paddingt5lr10">
<div class="cvsectiontitle cvaccordion-toggle2 publications"><?php echo Yii::t('translation','Publications'); ?></div>
<div class="pubdivider">
<div class="row-fluid row-fluidm0">
<div class="span12">
<div class="span9 cvsection1">
<?php echo $userCVDetails['publications']['Name'] ?>
</div>
<div class="span3 cvsection1date">
<?php echo $userCVDetails['publications']['PublicationDate'] ?>
</div>

</div>
</div>
<div class="pubsection">
<div class="pubsection1"><?php echo $userCVDetails['publications']['Title'] ?></div>
<?php if(isset($userCVDetails['publications']['Authors']) && !empty($userCVDetails['publications']['Authors'])){ ?><div class="pubsection2"><?php  echo $userCVDetails['publications']['Authors'] ?></div><?php } ?>
<div class="pubsection3"><?php echo $userCVDetails['publications']['Location'] ?></div>
<div class="pubsection4">
    
<?php if($userCVDetails['publications']['Link'] != "") { ?> 
       <a style="text-decoration:underline;cursor: pointer;" id="showpdffile1" data-uri="<?php echo $userCVDetails['publications']['Link']; ?>" > 
           <?php echo $userCVDetails['publications']['Link']; ?><?php } ?> 

    <?php if($userCVDetails['publications']['Files'] != "") { ?> 
     
        <a style="text-decoration:underline;cursor: pointer;" id="showpdffile" data-uri="<?php echo $userCVDetails['publications']['Files']; ?>" ><?php
        $urlArr = explode("/",$userCVDetails['publications']['Files']);
                echo $urlArr[3];
                ?> 
<img src="/images/system/pdfdownload.png" style="cursor:pointer;"  >
<?php } ?>
        
</a>
</div>
</div>
</div>
</div>
    
<?php } ?>
  </div> 
<!--End publications --> 
 
<!--- Experience -->
<div id="profile_experiencediv">   
<?php if(count($userCVDetails['experience'])>0 && $userCVDetails['experience'] != "failure"){  ?>
    <div class="paddingt5lr10">
<div class="cvsectiontitle cvaccordion-toggle2 experience"><?php echo Yii::t('translation','Experience'); ?></div>
<div class="pubsection">

<div class="pubsection1">
<?php echo $userCVDetails['experience']['Experience'] ?><br>

</div>

    <?php if($userCVDetails['experience']['Description'] != ""){ ?>
<div class="pubsection2">
<ul>
        <?php     $tagsFreeDescription = strip_tags(($userCVDetails['experience']['Description']));
                  $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
                  $descriptionLength = strlen($tagsFreeDescription); 
                  $ExpDescription= CommonUtility::truncateHtml($userCVDetails['experience']['Description'], 200);?>
<li><?php echo $ExpDescription ?>
    <?php if($descriptionLength>200){echo Yii::t('translation','Readmore');}?>
</li>
</ul>
</div>
    <?php } ?>

</div>
</div>
    
<?php } ?> 
</div>
    <!--- Experience -->
    
     <!-- Interests -->
     <div id="profile_interestsdiv"> 
    <?php if(isset($userCVDetails['interests'])&& count($userCVDetails['interests'])>0 && $userCVDetails['interests'] != "failure"){  ?>
    <div class="paddingt5lr10">
<div class="cvsectiontitle cvaccordion-toggle2 intrests"><?php echo Yii::t('translation','Interests'); ?></div>
<div class="pubsection">

<div class="pubsection1">
<?php echo str_replace(",", ", ", $userCVDetails['interests'][0]['Interests']) ?><br>

</div>

    <?php if($userCVDetails['interests'][0]['Tags'] != ""){ ?>
<div class="pubsection2">
<ul>
<li><?php echo str_replace(",", ", ", $userCVDetails['interests'][0]['Tags']); ?> </li>
</ul>
</div>
    <?php } ?>

</div>
<?php if(isset($userCVDetails['interests'][1]['Interests'])){?>
<div class="pubsection">

<div class="pubsection1">
<?php echo  str_replace(",", ", ", $userCVDetails['interests'][1]['Interests']); ?><br>

</div>

    <?php if($userCVDetails['interests'][1]['Tags'] != ""){ ?>
<div class="pubsection2">
<ul>
<li><?php echo str_replace(",", ", ", $userCVDetails['interests'][1]['Tags']); ?> </li>
</ul>
</div>
    <?php } ?>

</div>
<?php }?>

</div>

<?php } ?> 
     </div>
   <!-- Interests End-->
     
<!--Education -->
<div id="profile_educationdiv"> 
  <?php if(count($userCVDetails['education'])>0 && $userCVDetails['education'] != "failure"){  ?>
 <div class="paddingt5lr10">
<div class="cvsectiontitle cvaccordion-toggle2 education"><?php echo Yii::t('translation','Education'); ?></div>
<div class="pubsection">
<div class="pubsection1"><b><?php echo $userCVDetails['education']['Education']?> </b></div>
<div class="pubsection2"><?php echo $userCVDetails['education']['CollegeName']?>, <?php echo $userCVDetails['education']['YearOfPassing'] ?>, <?php echo $userCVDetails['education']['Specialization']?> </div>
       
        
</div>
    
</div>

  <?php }?>
</div>
<!--Education End -->

<!--Education -->
<div id="profile_achievementsdiv"> 
  <?php if(isset($userCVDetails['achievements']) && count($userCVDetails['achievements'])>0 && $userCVDetails['achievements'] != "failure"){  ?>
 <div class="paddingt5lr10">
<div class="cvsectiontitle cvaccordion-toggle2 achievements"><?php echo Yii::t('translation','Achievements'); ?></div>
<div class="pubsection">
<div class="pubsection1"><b><?php echo $userCVDetails['achievements'][0]['Achievement']?> </b></div>
<div class="pubsection2"><?php echo $userCVDetails['achievements'][0]['Description']?></div>
</div>
<?php if(isset($userCVDetails['achievements'][1]['Description']))?>
<div class="pubsection">
<div class="pubsection1"><b><?php echo $userCVDetails['achievements'][1]['Achievement']?> </b></div>
<div class="pubsection2"><?php echo $userCVDetails['achievements'][1]['Description']?></div>
</div>
</div>
  <?php }?>
</div>
<!--Education End -->

     
    
</div>
    <div class="pubsection2 alignright paddingt5lr10">
<input type="button" class="btn btn-small" id="viewfullprofile" name="yt0" value="View full CV"> 
<?php if($IsUser == 1){ ?>
<input type="button" class="btn btn-small" id="addeditprofile" name="yt0" value="Edit CV">
<?php } ?>

</div> 
</div>
</div> 
         
         
         
            <?php }else{ ?>
                   <div class="span8 span8custom">
        <div class="p_summary">
  <div class="padding10">
  <div class="cvtitle"><?php echo $profileDetails->DisplayName ?>’s CV</div>
  </div>
  <div class="bordertop">
  <div class="aligncenter">
  <img src="/images/system/cvemptyicon.png">
  <div class="row-fluid">
  <div class="span8 spanfloatnonecenter">
  

  <?php  if($loginUserId==$profileDetails->UserId){?>
      <div class="aligncenter cvemptytext"><?php echo Yii::t('translation','Ask_CV_info'); ?></div>
  <div class="aligncenter padding10"><a id='cvCreateAnchor'><input type="button" value="Get Started" name="yt0"  class="btn"></a></div>

  <?php }else{?>
   <div class="aligncenter cvemptytext"><?php echo Yii::t('translation','Ask_CV_info'); ?></div>
  <?php }?>
  </div></div>
  </div>
  </div>
  </div>
        </div>
           <?php }?>
           <?php }?>
     
           <div id="S8C" class="">
            <div id="S8SUM" class="" >
                <div class="row-fluid" >
                    <div class="span12" id='fixedWidgets'> 
                        <?php  if($loginUserId==$profileDetails->UserId){
                        $userDisplayName = "You ";
                        $pre = " are ";
                        $Badgepre = " ";
                    }else{
                        $userDisplayName = $profileDetails->DisplayName;
                        $pre = " is ";
                        $Badgepre = " has ";
                    }?>
                          <?php if(count($userBadges)>0){?>
                        <div id="PSECB" class="span3" >
                            <ul  class="profileboxsection">
                                <li id="badgesInt" class="" style="min-height: 10px">
                                    <div class="groupmenucount"><i><?php echo count($userBadges)?></i></div>
                        <div class="post item" style="">
                            <div  style="cursor: pointer" class="stream_title paddingt5lr10"> <b class="group"><a class="userprofilename" data-id="<?php  echo $profileDetails->UserId;?>" style="cursor:pointer"><b><?php echo $userDisplayName; ?></b></a></b> <?php echo$Badgepre; ?> unlocked these badges</div>
                            <div class="padding4 clearfix badgeimages">
                                <?php if(count($userBadges)>0){?>
                                <?php foreach ($userBadges as $value) { ?>
                                <span><a data-original-title="<?php echo $value['hovertxt']; ?>" rel="tooltip" data-placement="bottom" class="badgesId" data-showIntroPopUp="<?php echo $value['hovertxt']?>" data-value="<?php echo $value['id'] ?>" ><img src="<?php echo "/images/badges/".$value['badgeName']."_38x44.png" ?>" alt="<?php echo $value['hovertxt'] ?>" /></a></span>
                                <?php } } else {?>
                                <?php echo $userDisplayName.' have not unlocked any of the badges';}?>
                               
                        </div>
                        </div>
                    </li>
                               </ul> 
                        
                    </div>
                          <?php } ?>
                        <?php if($userFollowingGroups['totalGroupsCount']>0){?>
                        <div id="PSECG" class="span3">
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
                        
                    </div> 
                        <?php } ?>
                        
                        
                        
                      <?php if($userFollowingHashtags['totalHashTagCount']>0){?>   
                        <div id="PSECH" class="span3">
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
                        
                    </div> 
                      <?php } ?>
                  <?php if($userFollowingCategories['totalCategoriesCount']>0){?>

                        <div id="PSECC" class="span3" >
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
                        
                    </div> 
                           <?php } ?>
                        
                        
                    </div>
                    </div>
    </div>
    </div>
         </div>
     </div>
                
                   <div > 
           

           
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
             <div id="promoteCalcDiv" style="display: none">    
        <div class="promoteCalc input-append date" data-date-format="<?php echo Yii::app()->params['DateFormat']; ?>" data-date="">
            <label><?php echo Yii::t('translation','Promote_till_this_date'); ?></label>
            <input type="text" class="promoteInput" readonly />
            <span class="add-on">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>
            <?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
</div>
    </div>
            <?php }?>
<script type="text/javascript">
    var  g_CVOrderArray = <?php echo json_encode($OrderArray); ?>;
    for (var r = 0; r < g_CVOrderArray.length; r++) {
         $("#CV_Profile_Subdiv_"+r).html($("#profile_"+g_CVOrderArray[r]+'div').html());
         $("#profile_"+g_CVOrderArray[r]+'div').html("");
         
    }
     $("#profileCVBtn,#profileIntBtn").removeClass("active");
     $("#profileBtn").addClass("active");
     
      $(".notallowedwords").live('keypress',function(e){           
            var keyCode =e.which;            
            if(keyCode == 94 || keyCode == 96 || keyCode == 35 ||  keyCode == 95 || keyCode == 126 || e.which == 60 || e.which == 62){
                return false;
            }
        }).blur(function(){
            var $this = $(this);
            var value = $this.val();            
            var inputString = "~#^`{}|\"<>"+value,
            outputString = inputString.replace(/([~#^`{}\|\\"<>])+/g, '').replace(/^()+|()+$/g,'');                 
            $this.val(outputString);
            //alert(outputString)
        });
     Custom.init();
     
     
</script>
<script type="text/javascript">
    
  var Interests='<?php echo $profileDetails->Userinterests; ?>';
  if(Interests.length>0){
    
      var globalInterestsArray=Interests.split(',');
         var Profile_Interests=new Array();
  Profile_Interests=globalInterestsArray;
    for (var j = 0; j < globalInterestsArray.length; j++) {

        var sprofielData = "<span class='dd-tags hashtag' style='display:inline-block;margin-bottom:3px'><b>"+globalInterestsArray[j]+"</b></span></span>";
        $('#userProfile_Interests').append(sprofielData);
    }
  }else{
     $('#userProfile_Interests').html("Interests");
  } 
    
 
    
    
    
 function deleteUserInterestsInProfile(obj, textVal, arrayId){
        $(obj).parent('span.dd-tags').remove(); 
             globalspace[obj.id] = $.grep(globalspace[obj.id], function(value) {
         return value != $(obj).attr('data-name');
       });

 }
    
    
 function openUserEditProfile(currentIndex,position,fromClick){
    var queryString = "UserId="+<?php echo $loginUserId; ?>;
    ajaxRequest('/user/getUserProfileDetailsForProfileEdit',queryString,function(data){userProfileDetailsForProfileEditHandler(data)},"html");
    //ajaxRequest("/user/getUserProfileDetailsForProfileEdit", queryString,function(data){userProfileDetailsForProfileEditHandler(data)} );
     if(currentIndex!="undefined" && currentIndex!=undefined)
     {
         adjustJoyRidePosition( $("div[data-index='" + currentIndex + "' ]"),position, $("#numeroProfile "));;   
         if(fromClick=="click")
         {
            if( !$("#numeroProfile").hasClass("joyrideHighlight"))
           {
               $('#profileEditDiv').show();
               $('#userProfileView').hide();
               $("#UserProfileDetailsForm_DisplayName").focus();
                $('#p_DisplayName').hide();

               //adjustDivPosition( $("#numeroProfile"),currentIndex)
              $("#numeroProfile , #userProfileView").addClass("joyrideHighlight");
         // adjustJoyRidePosition();
           } 
             $( "#EditprofileiconDiv" ).removeClass("businesscardediticon").addClass( "businesscardeditdisable" );
        }
        else
        {
             $('#profileEditDiv').hide();
              $('#userProfileView').show();
              $('#UserProfilePicHelpIcon').hide();
                $('#p_DisplayName').show();
              
        }
     }
     else
     {
         $("#numeroProfile ,#userProfileView").removeClass("joyrideHighlight");
          $('#profileEditDiv').show();
          $('#userProfileView').hide();
           $( "#EditprofileiconDiv" ).removeClass("businesscardediticon").addClass( "businesscardeditdisable" );
            $('#UserProfilePicHelpIcon').show();
                $('#p_DisplayName').hide();
     }
     
 
  //$( "#EditprofileiconDiv" ).removeClass("businesscardediticon").addClass( "businesscardeditdisable" );
 // $('#EditprofileiconDiv').hide();
 
 
// if(Profile_Interests!='undefined' && Profile_Interests.length>0){
//     //globalspace['cv_custom_mention_UserProfileDetailsForm_Interests']=Profile_Interests;
//     
//   $('#UserProfileDetailsForm_Interests_currentMentions').html('');
//   for (var j = 0; j < Profile_Interests.length; j++) {
//        var stringdata = "<span class='dd-tags hashtag' style='display:inline-block;margin-bottom:3px'><b>"+Profile_Interests[j]+"</b><i id='cv_custom_mention_UserProfileDetailsForm_Interests' data-name='"+Profile_Interests[j]+"'  class='cv_custom_mention_UserProfileDetailsForm_Interests' >X</i></span></span>";
//        var sprofielData = "<span class='dd-tags hashtag' style='display:inline-block;margin-bottom:3px'><b>"+Profile_Interests[j]+"</b></span></span>";
//         $('#UserProfileDetailsForm_Interests_currentMentions').append(stringdata);
//        $("#UserProfileDetailsForm_Interests_currentMentions").die("click");
//        $("#cv_custom_mention_UserProfileDetailsForm_Interests").live("click", function(){
//               deleteUserInterestsInProfile(this,$(this).attr('data-name'),'cv_custom_mention_UserProfileDetailsForm_Interests');
//           });
//    }
//  }
    $('.qq-uploader ').css('display','block');
    initializeInterestsForCV("#UserProfileDetailsForm_Interests");
 }
 
function userProfileDetailsForProfileEditHandler(html){

$("#UserprofileEditDiv" ).html(html);


}
 
  var extensions ='"jpg","jpeg","gif","png","tiff"';
    initializeFileUploader('UserProfileImage', '/user/UploadProfileImage', '10*1024*1024', extensions,1, 'UserProfileImage' ,'',ProfilePreviewImage,displayErrorForBannerAndLogo12,"uploadlist_logo");  
     $('.qq-uploader ').css('display','none');
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
   <?php if(Yii::app()->params['CVProfile']=='OFF'){?>
       $('#PSECB ,#PSECG ,#PSECH ,#PSECC').removeClass('span3');
       $('#PSECB ,#PSECG ,#PSECH ,#PSECC').addClass('span6');
//       $('#PSECH').addClass('clearboth');
       $('#S8C').addClass('span8 span8custom');
       $('#S8SUM').addClass('p_summary padding10');
       
       <?php }?>
   <?php if(Yii::app()->params['CVProfile']=='ON'){?>
       $('#S8C').addClass('marginT');
       var minHeight=$("#fixedWidgets").height();              
            $("#curbsideInt").css('min-height', minHeight);  
            $("#groupsInt").css('min-height', minHeight);  
            $("#badgesInt").css('min-height', minHeight);  
            $("#hashtagInt").css('min-height', minHeight);  
       <?php }?>
   
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
              
         
          
    });
 
    <?php  if($IsUser==1) {?>
    bindEditForProfile();
//var extensions ='"jpg","jpeg","gif","png","tiff"';
//initializeFileUploader('UserProfileImage', '/user/UploadProfileImage', '10*1024*1024', extensions,1, 'UserProfileImage' ,'',ProfilePreviewImage,displayErrorForBannerAndLogo12,"uploadlist_logo");

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
    getCollectionData('/user/getprofileintractions', 'UserId='+<?php  echo $profileDetails->UserId; ?>+'&ProfileIntractionDisplayBean', 'ProfileInteractionDiv', '<?php echo Yii::t('translation','No_Data_Found'); ?>',"<?php echo Yii::t('translation','Thas_all_folks'); ?>");   
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
                  getUserProfileFollowers('<?php  echo $profileDetails->UserId ?>',"<?php echo $profileDetails->DisplayName ?>");
                  
              });    
         }           
          
          if("<?php echo $profileDetails->UserFollowingCount ?>" > 0){

              $('.p_following').live("click",function(){
                  tpage=0;
                  tFPopupAjax = false; 
                  $("#userFollowersFollowings_body").empty();
                  getUserProfileFollowing('<?php  echo $profileDetails->UserId ?>',"<?php echo $profileDetails->DisplayName ?>");
                  
              });
              
          }  
            $('.groupId').live("click",function(){
            var groupId=$(this).attr('data-value');
            var showIntroPopup=$(this).attr('data-showIntroPopUp');
            if(showIntroPopup==1){
              getGroupIntroPopUp(groupId);        
            }else{
                
               var param='';
               var content='<?php echo Yii::t('translation','not_authorized_to_access_group'); ?>';
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
               var content='<?php echo Yii::t('translation','not_authorized_to_access_group'); ?>';
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
function saveUserProfileDetails() {
    if(globalspace['cv_custom_mention_UserProfileDetailsForm_Interests']=="" && Profile_Interests!='Undefined' && $.trim($('#UserProfileDetailsForm_Interests_currentMentions').text()).length > 0){
            $('#UserProfileDetailsForm_UserInterests').val(Profile_Interests);
    }else{
      $('#UserProfileDetailsForm_UserInterests').val(globalspace['cv_custom_mention_UserProfileDetailsForm_Interests']);   
    }
   if($('#UserProfileDetailsForm_Speciality').val()==""){
       $('#UserProfileDetailsForm_OtherAffiliation').val("");
    }
  var data = $('#UserProfileDetails-form').serialize();
  
  scrollPleaseWait("profileUpdateSpinLoader");
    var queryString = "data="+data;
    ajaxRequest("/user/saveUserProfileDetails", queryString, saveUserProfileDetailsHandler);
}
function saveUserProfileDetailsHandler(data) {
    scrollPleaseWaitClose("profileUpdateSpinLoader");
    
    if (data.status == "success") {
      
         $("#numeroProfile ,#userProfileView").removeClass("joyrideHighlight");
        $('#UserProfilePicHelpIcon').hide();
         $('#p_DisplayName').show();
    var UserprofileData=data.data;
     //$('#UserProfileImage').html('');
     $('.qq-uploader ').css('display','none');
    $('.cvtitle').html(UserprofileData['DisplayName']+"'s CV");
    $('#ProfileInteractionsDisplayName').html(UserprofileData['DisplayName']+"'s "+Translate_Recent_Interactions);
    $('#p_DisplayName').html(UserprofileData['DisplayName']);
    if(UserprofileData['Credentials']!=""){
         $('#p_Credentials').html(UserprofileData['Credentials']);
          $('#P_CredentialsDiv').show();
           $('#p_Credentials').show();
     }else{
         $('#p_Credentials').html("");
           $('#P_CredentialsDiv').hide();
      }

     (UserprofileData['Credentials']!="" || UserprofileData['StateLicenceNumber']!="") ? $('#P_CredentialsDiv').show() : "";
     if(UserprofileData['Credentials']!="" && UserprofileData['StateLicenceNumber']!=""){
        $('#CLseparator').show();
       }else{
          $('#CLseparator').hide();  
       }
    if(UserprofileData['StateLicenceNumber']!=""){
        $('#p_StateLicenceNumber').html(UserprofileData['StateLicenceNumber']);
        $('#p_StateLicenceNumber').show();
     }else{
          $('#p_StateLicenceNumber').html("");
        $('#p_StateLicenceNumber').hide();
     
      }

    (UserprofileData['PracticeName']!="" || UserprofileData['Title']!="" || (data.userSpecility!="" && data.userSpecility!=null) || UserprofileData['OtherAffiliation']!="" ) ? $('#P_stp').show() :  $('#P_stp').hide();
    (UserprofileData['PracticeName']!="") ? $('#p_practicenamediv').show() :  $('#p_practicenamediv').hide();
    (UserprofileData['Title']!="") ? $('#p_titlediv').show() :  $('#p_titlediv').hide();
    (data.userSpecility!="" && data.userSpecility!=null) ? $('#p_specialitydiv').show() :  $('#p_specialitydiv').hide();

    $('#p_PracticeName').html(UserprofileData['PracticeName']);
    if($.trim(UserprofileData['AboutMe'])!=""){
         $('#p_AbtDisplay').show();
    $('#p_AboutMe').html(UserprofileData['AboutMe']);
    if($.trim(UserprofileData['AboutMe']).length>200){
         $('#p_TotalAboutMe').html(UserprofileData['AboutMe']);
         var subdata=UserprofileData['AboutMe'].substr(1, 200);
         $('#p_AboutMe').html(subdata);
         $('#p_AboutMe').append('  <a id="displayTotalAboutMe" class="fa moreicon moreiconcolor" style="cursor: pointer;text-decoration: none;"><?php echo Yii::t('translation','Readmore')?> </a>');
         //$('#displayTotalAboutMeDiv').show();
         initializeAboutMeHover();
     }
     }else{
        $('#p_AboutMe').html("");
         $('#p_AbtDisplay').hide();
     }
    $('#p_Title').html(UserprofileData['Title']);
    $('#p_City').html($.trim(UserprofileData['City']));
    $('#p_State').html($.trim(data.userstate));
     (UserprofileData['City']!="") ? $('#p_City').show() :  $('#p_City').hide();
      (data.userstate!="" && data.userstate!=null) ? $('#p_State').show() :  $('#p_State').hide();
    if(UserprofileData['City']!="" || (data.userstate!="" && data.userstate!=null)){
    $('#cityStateDisplay').show();
    }else{
    $('#cityStateDisplay').hide();
    }
    if(UserprofileData['OtherAffiliation']!="" && data.userSpecility==null){
    $('#p_specialitydiv').show();
    $('#p_Speciality').html(UserprofileData['OtherAffiliation']);
    
    }

    if(data.userSpecility!=null){
      $('#UserProfileDetailsForm_OtherAffiliation').val("");
      $('#p_Speciality').html(data.userSpecility);
    }

    var UserInterests=UserprofileData['UserInterests'];

  if(UserInterests.length>0){
    $('#p_UserInterests').show();
      var globalInterestsArray=UserInterests.split(',');
      $('#userProfile_Interests').html("");
        Profile_Interests=globalInterestsArray;
    for (var j = 0; j < globalInterestsArray.length; j++) {
        var sprofielData = "<span class='dd-tags hashtag' style='display:inline-block;margin-bottom:3px'><b>"+globalInterestsArray[j]+"</b></span></span>";
        $('#userProfile_Interests').append(sprofielData);
    }
    }else{
    Profile_Interests=new Array();
     $('#p_UserInterests').hide();
         $('#userProfile_Interests').html("");
    }

$('#profileEditDiv').hide();
  $('#userProfileView').show();
  $( "#EditprofileiconDiv" ).removeClass("businesscardeditdisable").addClass( "businesscardediticon" );
  }else{
     $(".errorMessage").css('margin-top','-5px');
     if (typeof (data.error) == 'string') {
       var error = eval("(" + data.error.toString() + ")");
    } else {
        var error = eval(data.error);
    }


    $.each(error, function(key, val) {

        if ($("#" + key + "_em_")) {
            $("#" + key + "_em_").text(val);
            $("#" + key + "_em_").show();
            $("#" + key + "_em_").fadeOut(5000);
            $("#" + key).parent().addClass('error');
        }

    });
    //$("#streamSettingsMessage").show();
//        $("#streamSettingsMessage").html("Settings not saved").removeClass().addClass("alert alert-error").fadeOut(4000, "");
  }
} 
function openEditProfile(divId,action){
   if(action=='close'){
       $('#'+divId).hide();
   }
   if(action=='open'){
       $('#'+divId).show();
   } 
    
}

function CancelUserEditProfile(){
  $("#numeroProfile ,#userProfileView").removeClass("joyrideHighlight");
  $('#p_DisplayName').show();
  $('#profileEditDiv').hide();
  $('#userProfileView').show();
  $('.qq-uploader ').css('display','none');
  $('#previewDiv').css('display','none');
  $( "#EditprofileiconDiv" ).removeClass("businesscardeditdisable").addClass( "businesscardediticon" );
  $('#UserProfilePicHelpIcon').hide();
 var queryString = "";
 var queryString = "UserId="+<?php echo $loginUserId; ?>;
   ajaxRequest('/user/getUserProfileDetailsForProfileEdit',queryString,function(data){userProfileDetailsForProfileEditHandler(data)},"html");
}
function initializeAboutMeHover(){
    
       $("#displayTotalAboutMe").mouseover(function(){
                       //   $('#displayTotalAboutMe').hide();  
                           $('#displayTotalAboutMeDiv').show(); 
                    }).mouseout(function(){
                       //$('#displayTotalAboutMe').show();  
                           $('#displayTotalAboutMeDiv').hide(); 
                    });
}

  function displayOtherSpecialty(obj) {
        if (obj.value == "Other") {
             $('#otheraffiliation').show();
           
        } else {
             
             $('#otheraffiliation').hide();
        }
    }
breadCumSource = "Profile";
sessionStorage.breadCumSource = "Profile";
</script>
<?php } else{?>
 <div class="row-fluid">
    <div class="span12" style="text-align:center;">
        <img src="/images/system/thisuseris_inactive.png" />        
    </div>
</div>
<?php }?>