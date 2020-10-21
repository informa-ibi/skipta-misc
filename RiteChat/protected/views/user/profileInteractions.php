
<div id="profileDetailsDiv">
     
    <?php include 'profileinteractionbuttongroupwidget.php'; ?>
    <div id="miniprofile_spinner_modal" style="position: relative;" class="grouppostspinner"></div>
<div class="row-fluid">
                <div class="span12 padding8top">
    
            
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
                                <span><a class="subgroupId" data-showSubIntroPopUp="<?php echo $value['showSubIntroPopup']?>" data-value="<?php echo $value['_id'] ?>" ><img src="<?php echo $value['SubGroupProfileImage'] ?>" alt="<?php echo $value['SubGroupName'] ?>" /></a></span>
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
<script type="text/javascript">
    $("#profileBtn,#profileCVBtn").removeClass("active");
    $("#profileIntBtn").addClass("active");
     $(document).ready(function() {
        
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
//initializeFileUploader('UserProfileImage', '/user/UploadProfileImage', '10*1024*1024', extensions,1, 'UserProfileImage' ,'',ProfilePreviewImage,displayErrorForBannerAndLogo12,"uploadlist_logo");

<?php  }?>
    var handler = null;
    var options = {
      itemWidth: '26%', // Optional min width of a grid item
      autoResize: true, // This will auto-update the layout when the browser window is resized.
      container: $('#ProfileInteractionDiv'), // Optional, used for some extra CSS styling
      offset: 8, // Optional, the distance between grid items
      outerOffset: 10, // Optional the distance from grid to parent
       flexibleWidth: '26%', // Optional, the maximum width of a grid item
      align: 'left'
    };
    var $window = $(window);
    profileInitializationEvents();
    getCollectionData('/user/getprofileintractions', 'UserId='+<?php  echo $profileDetails->UserId; ?>+'&ProfileIntractionDisplayBean', 'ProfileInteractionDiv', 'No data found','That\'s all folks!');
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

</script>