<?php if(isset($actionUsersList) && sizeof($actionUsersList)>0){
    ?>
       
                <div class="row-fluid " id="userFollowUnfollowid">

                    <?php $i=0; foreach ($actionUsersList as $user){
                        ?> 
                    <?php if($i == 0){ ?>
                        <div class="span12" style='margin-left: 0;'>
                    <?php } ?>
                    <div class="span4">
                    <div class="media">
                  <a class="pull-left marginzero smallprofileicon profileDetails"  data-name='<?php echo $user->uniqueHandle ?>' data-toggle="modal">
                      <img src=<?php echo $user->ProfilePicture ?> > </a>
                        <div id="popup_userFollow_spinner"></div>
                  <div class="media-body">
                   
                      <div class="m_title profileDetails" style="cursor: pointer" id='<?php echo $user->UserId ?>' data-name='<?php echo $user->uniqueHandle ?>'><?php if($user->UserId !=$loginUserId) echo $user->DisplayName;else echo Yii::t('translation','You'); ?></div>
                   <span class="social_bar noborder"> 
                       
                        <?php if($user->UserId !=$loginUserId) { 
                        if(isset($networkAdmin) && $networkAdmin==(int)$user->UserId){ ?>
                            <a class="userId" data-id="<?php echo $user->UserId ?>" >
                                <i><img src="/images/system/spacer.png" id="userFollowunfollowa_<?php echo $user->UserId ?>" ></i>
                            </a>
                       <?php }else{ ?>
                       <a style="cursor:pointer" class="userId nonNetworkAdmin" data-id="<?php echo $user->UserId ?>" ><i >
                               <img src="/images/system/spacer.png"   id="userFollowunfollowa_<?php echo $user->UserId ?>"
                                    class=" tooltiplink <?php  echo $user->IsFollowed?'follow':'unfollow' ?>"  data-placement="bottom" rel="tooltip"  data-original-title="<?php  echo $user->IsFollowed? Yii::t('translation','UnFollow') : Yii::t('translation','Follow') ?>"
                                  ></i>
                       </a>
                       <?php } } ?>
                   </span> </div>
                </div>
                    </div>
                    <?php $i++; 
                        if($i>2){$i = 0;?>
                        </div>                        
                        <?php }                     
                      } ?>
                       
                    </div>


<script type="text/javascript">
       if(!detectDevices())
            $("[rel=tooltip]").tooltip();
     $('a.nonNetworkAdmin .follow').live("click",function(){        
           var userId=$(this).closest('a.userId').attr('data-id');           
             userFollowUnfollowActionsFromProfile(userId,'unfollow');
             $("#userFollowunfollowa_" + userId).attr({"class": "unfollow"}); 
              $("#userFollowunfollowa_" + userId).attr({"data-original-title": "Follow"});
              })
               $('a.nonNetworkAdmin .unfollow').live("click",function(){ 
                   
            var userId=$(this).closest('a.userId').attr('data-id');                     
                  userFollowUnfollowActionsFromProfile(userId,'follow');
            $("#userFollowunfollowa_" + userId).attr({"class": "follow"});
             $("#userFollowunfollowa_" + userId).attr({"data-original-title": "Unfollow"});
            
              })
              $(".profileDetails").live( "click", 
        function(){            
            var uniqueHandler =$(this).closest('.profileDetails').attr('data-name');                
             window.location.href = "/profile/"+uniqueHandler;
        }
 );

</script>
<?php } else{ echo 0;}?>