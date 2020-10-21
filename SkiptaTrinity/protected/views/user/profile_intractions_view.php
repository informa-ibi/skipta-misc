<?php 

 if(is_object($stream))
      { 
    foreach($stream as $data){
   
   
?>
<li class="woomarkLi">    
    <div class="post item ImpressionLIDiv" id="<?php  echo $data->_id ?>" data-id="<?php  echo $data->_id ?>" data-postid="<?php  echo $data->PostId ?>" data-postType="<?php  echo $data->PostType;?>" data-categoryType="<?php  echo $data->CategoryType;?>" data-networkId="<?php  echo $data->NetworkId; ?>" data-scheduleId="<?php  echo $data->CurrentGameScheduleId; ?>" data-gameName="<?php  echo $data->GameName; ?>">  
        <?php $time = $data->CreatedOn ?>
        <div  style="cursor: pointer" class="stream_title paddingt5lr10 postdetail impressionDiv" data-id="<?php  echo $data->_id ?>"> 
            <b data-id="<?php echo $data->_id ?>" class="group">
                <a class="<?php if($data->isGroupAdminMember == 'true' && $data->ActionType=='Post' && $data->SubGroupId==0) { echo 'groupIntroDetails'; } else { echo 'userprofilename';} ?> " data-id="<?php if($data->isGroupAdminMember == 'true' && $data->ActionType=='Post' && $data->SubGroupId==0) { echo $data->MainGroupId; } else { echo $data->UserId; } ?>" style="cursor:pointer">
                    <b>
                        <?php if($data->isGroupAdminMember == 'true' && $data->ActionType=='Post' && $data->SubGroupId==0) {
                           echo html_entity_decode($data->MainGroupName); 
                        }else{
                            echo $data->UserDisplayName;
                        } ?>
                    </b>
                </a>
            </b><?php  echo $data->StreamNote ?><span class="userprofilename"><?php if($data->PostType==2 || $data->PostType==3){ if(isset($data->Title) && $data->Title!=""){ echo "- ".$data->Title; };} ?></span><i> <?php  echo $data->PostOn; ?></i>
        </div>
        <?php  if($data->ArtifactIcon!=""){
            
            if($data['Extension'] == 'mp4' || $data['Extension'] == 'flv' || $data['Extension'] == 'mov') {
                $videoclassName = 'videoThumnailDisplay';

            }else {
                $videoclassName='videoThumnailNotDisplay';
            }
                                
            
            ?>
        <?php if($data->CategoryType!=3 || ($data->CategoryType ==3 && $data->ConversationVisibility == 1)){?>
            <div class="mediaartifacts">
            <?php if($data->IsMultiPleResources==1){?>
        <a  class="pull-left img_single postdetail img_single_interactions" data-id="<?php  echo $data->_id ?>" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>"><div class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img  class="postdetail" src="<?php  echo $data->ArtifactIcon ?>"  ></a>
        <?php  }else{ ?>
        
        <div style="padding-right:10px">
        <div class="pull-left multiple " style="max-width:100%;margin:0"> 
            <div class="img_more1"></div>
            <div class="img_more2"></div>
              <a  class="pull-left pull-left1 img_more   postdetail img_single_interactions" data-id="<?php  echo $data->_id ?>" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>"><div class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $data->ArtifactIcon ?>"></a>
        </div>
        </div>
        <?php  }?>
            </div>
            <?php } ?>
            <?php } ?>
        <div class="stream_content">
            <div class="media" data-id="<?php echo $data->_id ?>">
                <div class="media-body postdetail bulletsShow" data-id="<?php  echo $data->_id ?>">
                    <?php if($data->CategoryType == 3 && $data->ConversationVisibility == 0){ ?>
                    <div><img src="<?php echo $data->GroupProfileImage; ?>" /> </div>
                    <div><?php  echo html_entity_decode($data->MainGroupName);  ?></div>
                    <div><?php  echo $data->GroupDescription;  ?> </div>
                    <?php } else { echo $data->PostText; } ?>
                    <!-- spinner -->
                    <div class="grouppostspinner" id="stream_view_spinner_<?php echo $data->_id; ?>"></div>
                        <div class="grouppostspinner" id="stream_view_detailed_spinner_<?php echo $data->PostId; ?>"></div>
                    <!-- end spinner -->
                    <?php  if($data->PostType==3 && ($data->CategoryType == 3 && $data->ConversationVisibility == 1)){ ?>
                     
                    <?php if(!$data->IsSurveyTaken){ ?>
                    <div class="row-fluid "> 
                        <div class="span12 customradioanswers">
                            <div class="customradioanswersdiv">
                            <div class="c_prefix">A)</div>
<!--                            <div class="c_suffix"><input type="radio" class="styled" name="<?php  //echo "survey_".$data->PostId ?>" value="OptionOne"></div> -->
                            </div>
                            <div class="c_options" style="margin-left: 20px;"><?php  echo $data->OptionOne ?></div>
                        </div>
                    </div>
                    <div class="row-fluid "> 
                        <div class="span12 customradioanswers">
                            <div class="customradioanswersdiv">
                            <div class="c_prefix">B)</div>
<!--                            <div class="c_suffix"><input type="radio" class="styled" name="<?php  //echo "survey_".$data->PostId ?>" value="OptionTwo"></div> -->
                            </div>
                            <div class="c_options" style="margin-left: 20px;"><?php  echo $data->OptionTwo ?></div>
                        </div>
                    </div>
                    <div class="row-fluid "> 
                        <div class="span12 customradioanswers">
                            <div class="customradioanswersdiv">
                            <div class="c_prefix">C)</div>
<!--                            <div class="c_suffix"><input type="radio" class="styled" name="<?php  //echo "survey_".$data->PostId ?>" value="OptionThree"></div> -->
                            </div>
                            <div class="c_options" style="margin-left: 20px;"><?php  echo $data->OptionThree ?></div>
                        </div>
                    </div>
                      <?php if(isset($data->OptionFour) && !empty($data->OptionFour)){ ?>
                    <div class="row-fluid "> 
                        <div class="span12 customradioanswers">
                            <div class="customradioanswersdiv">
                            <div class="c_prefix">D)</div>
<!--                            <div class="c_suffix"><input type="radio" class="styled" name="<?php  //echo "survey_".$data->PostId ?>" value="OptionFour"></div> -->
                            </div>
                            <div class="c_options" style="margin-left: 20px;"><?php  echo $data->OptionFour ?></div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php }else{ ?>
                        <div class="media-body custommedia-body">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="span7" id="<?php  echo "surveyGraphArea_".$data->_id ?>" ></div>
                                </div>
                                <div class="span12">
                                    <div class="span5 " >
                                        <div class="row-fluid ">
                                           <div class="span12">
                                               <?php  echo "A) ".$data->OptionOne ?>
                                           </div>
                                           </div>
                                           <div class="row-fluid ">
                                               <div class="span12">
                                                   <?php  echo "B) ".$data->OptionTwo ?>
                                               </div>
                                           </div>
                                           <div class="row-fluid ">
                                               <div class="span12">
                                                   <?php  echo "C) ".$data->OptionThree ?>
                                               </div>
                                           </div>
                                           <?php if(isset($data->OptionFour) && !empty($data->OptionFour)){ ?>
                                           <div class="row-fluid ">
                                               <div class="span12">
                                                   <?php  echo "D) ".$data->OptionFour ?>
                                               </div>
                                           </div>
                                         <?php } ?>
                                    </div>
                                </div>
                           </div>
                       </div>
                                    
                        <?php   
                            if($data->IsSurveyTaken){
                                $totalSurveyCount = $data->OptionOneCount+$data->OptionTwoCount+$data->OptionThreeCount+$data->OptionFourCount;
                                if($totalSurveyCount>0){
                                ?>
                            <script type="text/javascript">
                              $(function(){ 
                                    var height = 150;
                                    var width = 200;
                                    if(detectDevices()){
                                        width = 100;
                                    }
                                    
                                    <?php 
                                    $IsOptionDExist=-1;
                                       if(isset($data->OptionFour) && !empty($data->OptionFour)){ 
                                        $IsOptionDExist=1;
                                           
                                       }
                                    ?>
                                    
                                  drawSurveyChart('<?php  echo "surveyGraphArea_" . $data->_id ?>', <?php  echo $data->OptionOneCount ?>, <?php  echo $data->OptionTwoCount ?>,<?php  echo $data->OptionThreeCount ?>,<?php  echo $data->OptionFourCount ?>,height,width,<?php echo $IsOptionDExist;?>);
                              });
                            </script>
                        <?php  } } ?>
                    <?php } ?>
                    <?php } ?>
                </div>
                <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>" class="grouppostspinner"></span>
                <?php if($data->RecentActivity=="Invite"){ ?>
                <div style="" id="Invite_<?php  echo $data->_id; ?>" class="commentbox  ">
                    <div class="padding10"><?php echo $data->InviteMessage; ?></div>
                    <style>#Invite_<?php  echo $data->_id; ?>.commentbox:before{left:48px}</style><style>#Invite_<?php  echo $data->_id; ?>.commentbox:after{left:48px}</style>
                </div>
                <?php } ?>
                <?php if($data->ActionType=='Comment' && isset($data->CommentMessage)){ ?>
                 <div class="padding4 ">
                     <?php if($data->CategoryType != 3 || ($data->CategoryType ==3 && $data->ConversationVisibility == 1)){ ?>
                <div class="commentbox padding4 postdetail" data-id="<?php  echo $data->_id ?>">
                    <?php echo $data->CommentMessage; ?>
                </div>
                     <?php } ?>
                     </div>
                <?php } ?>
            <?php if(!isset($data->AddSocialActions) || $data->AddSocialActions==1) {?>     
                <div class="social_bar positionrelative top30" data-id="<?php  echo $data->_id ?>" data-postid="<?php  echo $data->PostId ?>" data-postType="<?php  echo $data->PostType;?>" data-categoryType="<?php  echo $data->CategoryType;?>" data-networkId="<?php  echo $data->NetworkId; ?>">	
                    <a class="follow_a"><i ><img src="/images/system/spacer.png" class=" tooltiplink <?php echo $data->IsFollowingPost?'follow':'unfollow' ?>" data-placement="bottom" rel="tooltip"  data-original-title="<?php  echo $data->IsFollowingPost?Yii::t('translation','UnFollow'):Yii::t('translation','Follow') ?>" ></i> <b class="streamFollowUnFollowCount"  data-actiontype='Followers' data-id='<?php echo $data->_id?>' data-postId='<?php echo $data->PostId?>' data-count="<?php echo $data->FollowCount?>" data-categoryId="<?php  echo $data->CategoryType;?>"><span id="streamFollowUnFollowCount_<?php  echo $data->_id; ?>"><?php  echo $data->FollowCount ?></span>
                        <?php include Yii::app()->basePath.'/views/common/userFollowActionView.php'; ?>
                      
                        </b>
 
                    </a>
                    
                    <?php if($data->CategoryType !=3 || ($data->CategoryType ==3 && $data->ConversationVisibility == 1)){ ?> <span><i><img  class=" tooltiplink <?php  echo $data->IsLoved?'likes':'unlikes' ?>"  data-placement="bottom" rel="tooltip"  data-original-title="Love" src="/images/system/spacer.png"></i><b class="streamLoveCount"  data-actiontype='Love' data-id='<?php echo $data->_id?>' data-postId='<?php echo $data->PostId?>' data-count="<?php echo $data->LoveCount?>" data-categoryId="<?php  echo $data->CategoryType;?>"><span id="streamLoveCount_<?php  echo $data->PostId; ?>"><?php  echo $data->LoveCount?></span>
                          <?php include Yii::app()->basePath.'/views/common/userLoveActionView.php'; ?>
                        </b>
                    
                    </span>
                        
 <?php  }?>
                        <?php if($data->CategoryType<3){ 
                        if(!$data->TwitterShare || !$data->FbShare){ ?>
                        <span class="sharesection" ><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="<?php echo Yii::t('translation','Share'); ?>" data-placement="bottom"><img src="/images/system/spacer.png"  class="share postdetail"  ></i><b id="streamShareCount_<?php  echo $data->_id; ?>"><?php  echo (isset($data->ShareCount) && is_int($data->ShareCount))?$data->ShareCount:0?></b>
                        
                         </span><?php }else{?>
                             <span class="sharesection"><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="<?php echo Yii::t('translation','Share'); ?>" data-placement="bottom"><img src="/images/system/spacer.png"  class="sharedisable postdetail"  ></i><b id="streamShareCount_<?php  echo $data->_id; ?>"><?php  echo (isset($data->ShareCount) && is_int($data->ShareCount))?$data->ShareCount:0?></b></span>
                             <?php }} ?>
                    <?php  if(isset($data->DisableComments) && !$data->DisableComments && $data->CategoryType !=3 || ($data->CategoryType ==3 && $data->ConversationVisibility == 1)){?>
                    <span><i><img src="/images/system/spacer.png" class="tooltiplink <?php echo $data->IsCommented?'commented':'comments'?> postdetail" data-id="<?php  echo $data->_id ?>"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Comment'); ?>"></i><b id="commentCount_<?php  echo $data->PostId; ?>"><?php  echo $data->CommentCount?></b></span>              
                    <?php  }?>
                </div> 
                     <?php } ?>
            </div>
            <?php if($data->OriginalUserId!=$data->UserId && $data->PostType!=4){ ?>
            <div class="padding4 ">
            <div class="media bordertop1 paddingtop4" data-userId="<?php echo $data->OriginalUserId ?>">
                <a class="pull-left marginzero smallprofileicon profileImage" data-id=<?php echo $data->OriginalUserId ?> >
                    <img src="<?php echo $data->OriginalUserProfilePic; ?>" />
                </a>

                <div class="media-body">                                   
                    <span class="m_day"><?php echo $data->OriginalPostPostedOn; ?></span>
                    <div class="m_title"><a style="cursor:pointer" data-id="<?php echo $data->OriginalUserId ?>" class="userprofilename"><?php echo $data->OriginalUserDisplayName; ?></a></div>

                </div>
            </div>
                </div>
            <?php } ?>
       
        </div>
    </div>
</li>

<?php  }?>
                
<script>
    
    Custom.init();
    
    
        $('.groupIntroDetails').live("click",function(){
            var groupId=$(this).attr('data-id');
            $("#postDetailsDivInProfile").hide();
            getGroupIntroPopUp(groupId);             
                  
              });
           
</script>

    <?php
      }else{
          echo -1;
      }
?>
