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
<div id="area1" class="right">
                        <div class="btn-groupint" data-toggle="buttons-radio">
                            <button type="button" id="profileBtn" class="btnint profilei" >Profile</button>                            
                            <button type="button" id="profileIntBtn" class="btnint profilei ">Interactions</button>
                        </div>
                </div>
<div id="numero1">  <h2 class="pagetitle" style="padding-left: 9px;" id="tiltefor"><?php  echo $profileDetails->DisplayName."'s " ?><?php if($displayName!="") echo $displayName; else echo "Interactions"?></h2> </div>
    <div class="row-fluid">
                <div class="span12">
                    <div class="positionrelative" style="padding-left: 9px;"> 
                        
    <div class="profileBar">
        <a class="pull-left marginzero smallprofileicon" href="#">
                    <img id="profileImagePreviewId" src="<?php  if(isset($profileDetails->profile250x250) && $profileDetails->profile250x250 !='null'){echo $profileDetails->profile250x250;}else{ echo '/upload/profile/user_noimage.png';}  ?>"  alt="" />                                </a>
     <ul class="profilesocial  pull-left">
         <li> <span style="cursor: pointer;padding-left:7px;" data-original-title="Followers" rel="tooltip" data-placement="bottom" class="tooltiplink p_followers"><img src="/images/system/spacer.png"><i id="p_followersCount"><?php echo $profileDetails->UserFollowersCount ?></i></span></li>
     <li> <span style="cursor: pointer;" data-original-title="Following" rel="tooltip" data-placement="bottom" class="tooltiplink p_following"><img src="/images/system/spacer.png"><i id="p_followingCount"><?php echo $profileDetails->UserFollowingCount ?></i></span></li>
     <?php  if($IsUser != 1){?>
     <li> 
         <?php if(isset($networkAdmin) && $networkAdmin==$profileDetails->UserId){ ?>
         <span data-placement="bottom" id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" style="cursor: pointer"  rel="tooltip" data-placement="bottom" class="tooltiplink <?php  if($profileDetails->IsFollowed==0){ echo 'p_unfollowbig'; }else{ echo 'p_followbig'; }?>"><img  src="/images/system/spacer.png"></span>
         <?php }else{ ?>
        <span data-placement="bottom" id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" rel="tooltip" style="cursor: pointer" <?php  if(empty($profileDetails->IsFollowed)){ ?> data-original-title="Follow" <?php }else{?>  data-original-title="Unfollow"  <?php }?> class="tooltiplink <?php  if($profileDetails->IsFollowed==0){ echo 'p_unfollowbig'; }else{ echo 'p_followbig'; }?>">
            <img  <?php  if(empty($profileDetails->IsFollowed)){ ?>  onclick="userFollowUnfollowActions('<?php  echo $profileDetails->UserId;?>','follow');" 
                                                 <?php  }else{?>  onclick="userFollowUnfollowActions('<?php  echo $profileDetails->UserId;?>','unfollow');"
                                                 <?php  } ?> id="userFollowunfollowa_<?php  echo $profileDetails->UserId;?>" src="/images/system/spacer.png" 
                                                  >
        </span>
     <?php } ?>
     </li>
     <?php }?>
         </ul>
     
    </div>
                        </div>
                    </div>
         </div>
<script type="text/javascript">
    
     $(".profilei").live("click",function(){
            var url = window.location.pathname.substr(1);
            var urlArr = url.split("/");
            $(".profilei").removeClass("active");
           var tabName = $.trim($(this).html());
           if(tabName == "Profile"){
             
               window.location.href = "/profile/"+urlArr[1];
           }else if(tabName == "Interactions"){
               
               window.location.href = "/interaction/"+urlArr[1];
           }else if(tabName == "CV"){
                  sessionStorage.clickedButton="profileCVBtn";
                 $("#profileIntBtn").addClass("active");
                  window.location.href = "/userCVView/"+urlArr[1];
              }   
           
        }); 
        bindActionsForUserProfilePage()
    
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
    </script>
