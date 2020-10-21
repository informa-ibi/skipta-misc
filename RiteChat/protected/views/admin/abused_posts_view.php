<?php  
 if(is_object($abusedposts))
      {
    foreach($abusedposts as $data){
         $title="";
?>
<div class="post item <?php  echo (isset($data->IsPromoted) && $data->IsPromoted==1)?'promoted':''; ?>" style="width:100%;" id="postitem_<?php  echo $data->_id; ?>" >
<div class="stream_widget marginT10" >
    <div class="profile_icon"><img src="<?php  echo $data->AbusedUserProfilePic ?>" > </div>
    <div class="post_widget" >
        <div class="stream_msg_box">
             <?php if($data->Type==2 || $data->Type==3){
                    if(isset($data->Title) && $data->Title!=""){
                        $title= "<span class='userprofilename'>".$data->Title."</span>"; 

                    }else{
                        $title="";

                    }
                   }
                 ?>
            <div class="stream_title paddingt5lr10" style="position: relative"> <a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php  echo $data->AbusedUserId?>"  style="cursor:pointer"><b><?php  echo $data->AbusedUserDisplayName?></b></a>  <?php  echo ($data->IsBlockedWordExist==0)?"marked"."  ".$data->PostTypeString.$title." as abuse":"created ".$data->PostTypeString.$title.""; ?>  <?php  if ($data->Type==5){echo $data->CurbsideConsultTitle ?> <i><?php  echo $data->AbusedOn; ?></i><?php  }else{?><i><?php  echo $data->AbusedOn; ?></i><?php  }?>
              
                <?php if(!($data->DisplayType == "Block" && isset($data->IsBlockedWordExistInComment) && $data->IsBlockedWordExistInComment==1)){ ?>
                <div class="postmg_actions"  >
                    <i class="fa fa-chevron-down" data-toggle="dropdown" data-placement="right"></i>
                    <i class="fa fa-chevron-up" data-toggle="dropdown" data-placement="right"></i>
                    <div id="PostBlockOrRemove" class="dropdown-menu ">
                           <ul class="PostManagementActions abusedPosts" data-isBlocked="<?php  echo $data->IsBlockedWordExist; ?>" data-postId="<?php  echo $data->_id ?>" data-categoryType="<?php  echo $data->CategoryType ?>" data-networkId="<?php  echo $data->NetworkId ?>">
                            <li><a class="Block" name="Block"><span class="blockicon"><img src="/images/system/spacer.png" /></span> Block</a></li>
                            <li><a class="Release" name="Release"><span class="releaseicon"><img src="/images/system/spacer.png" /></span> Release</a></li>
                           </ul>
                        
                     </div>
                </div>
               <?php } ?>
               </div>
            <div class=" stream_content">
                <ul>
                    <li class="media">
                        <span id="stream_view_spinner_<?php echo $data->_id; ?>"></span>
                        
                            <?php  if($data->Type!=3){//not survey post ?>
                               
                        <?php  if($data->ArtifactIcon!=""){
                            
                            $extension = "";
                           $videoclassName="";
                           $extension = strtolower($data->Extension);
                           if($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                $videoclassName = 'videoThumnailDisplay';

                          }else {
                              $videoclassName='videoThumnailNotDisplay';
                          }
                            
                            if($data->IsMultiPleResources==1){?>
                         <a  class="pull-left img_single"><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $data->ArtifactIcon ?>"  ></a>
                        <?php  }else{ ?>
                           <div class="pull-left multiple "> 
                                    <div class="img_more1"></div>
                                    <div class="img_more2"></div>
                             <a  class="pull-left  pull-left1 img_more " ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $data->ArtifactIcon ?>"></a>  
                                
                                </div>
                        <?php  }} ?>
                        <div class="media-body">
                            
                            <?php  if($data->Type==2){ ?>
                            <p><?php  
                              echo $data->Description;
                             ?></p>
                        <div class="timeshow"  > 
                            
                                  <ul>
                                <li class="clearboth">
                            <ul class="<?php  echo $data->StartDate==$data->EndDate?'':"doubleul" ?>">
                                <li class="doubledate">
                                    <time class="icon" datetime="<?php  echo $data->StartDate; ?>">
                                        <strong><?php  echo $data->EventStartMonth; ?><?php  echo $data->StartDate!=$data->EndDate?"<br/>":"-"; ?><?php  echo $data->EventStartYear;?></strong>
                                        <span><?php  echo $data->EventStartDay;?></span>
                                        <em><?php  echo $data->EventStartDayString;//day name?></em>
                                        
                                    </time>
                                    
                                </li>
                                
                                <?php  if($data->StartDate!=$data->EndDate){ ?>
                                <li style="width:80px;float:left"><time class="icon" datetime="<?php  echo $data->EndDate; ?>">
                                        <strong><?php  echo $data->EventEndMonth;?><br/><?php  echo $data->EventEndYear;?></strong>
                                        <span><?php  echo $data->EventEndDay;?></span>
                                        <em><?php  echo $data->EventEndDayString;?></em>
                                    </time>
                                   
                                </li>
                                <?php  } ?>
                            </ul>
                                      </li>
                                      <?php if (trim($data->StartTime) != "" && trim($data->EndTime) != "") { ?>
                                      <li class="clearboth e_datelist"><div class="e_date"><?php  echo $data->StartTime ?> - <?php  echo $data->EndTime ?></div></li>
                                      <?php } ?>
                            </ul>
                           <div class="et_location clearboth"><span><i class="fa fa-map-marker"></i><?php  echo $data->Location ?></span> </div>

                            
                        </div>
                               <?php  }else{ ?>
                            <div>
                            <?php  
                                  echo $data->Description;
                             ?>
                                </div>
                             <?php  if($data->Type!=4){ 
                                 if($data->IsBlockedWordExist != 0){
                                 ?>
                            <!-- Nested media object -->
                            <div class="media">
                                <a href="#" class="pull-left marginzero smallprofileicon">
                                    <img src="<?php  echo $data->OriginalUserProfilePic ?>">
                                </a>
                               
                                <div class="media-body">                                   
                                    <span class="m_day"><?php  echo $data->OriginalPostPostedOn; ?></span>
                                    <div class="m_title"><a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php  echo $data->OriginalUserId ?>"  style="cursor:pointer"><?php  echo $data->OriginalUserDisplayName; ?></a><?php if($data->Type==2 || $data->Type==3){ if(isset($data->Title) && $data->Title!=""){ echo $data->Title; };} ?><?php if ($data->Type==5){?><span class="pull-right"><?php echo $data->CurbsideConsultCategory?></span><?php }?></div>
                                     
                                </div>

                             </div><?php  }} ?>
            
                            
                               <?php  }?> </div><?php  }else{ ?>
                            <div id="<?php  echo "surveyArea_".$data->_id ?>">
                                <?php  
                                    if($data->ArtifactIcon!=""){
                                        $extension = "";
                                        $videoclassName="";
                                        $extension = strtolower($data->Extension);
                                        if($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                             $videoclassName = 'videoThumnailDisplay';

                                       }else {
                                           $videoclassName='videoThumnailNotDisplay';
                                       }
                                                     if($data->IsMultiPleResources==1){?>
                                           <a  class="pull-left img_single"><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $data->ArtifactIcon ?>"  ></a>
                                           <?php  }else{ ?>
                                           <div class="pull-left multiple "> 
                                                <div class="img_more1"></div>
                                                <div class="img_more2"></div>
                                                <a  class="pull-left  pull-left1 img_more " ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $data->ArtifactIcon ?>"></a>  

                                            </div>
                                           <?php  }}
                                 ?>
                                                     
                            <div class="media-body">
                                <div class="surveyquestion" ><?php  echo $data->Description ?></div>
                                <div class="row-fluid ">
                                    <div class="span12">
                                        <input type="radio" class="styled" name="<?php  echo "survey_".$data->_id ?>" value="OptionOne"> <?php  echo $data->OptionOne ?>
                                    </div>
                                </div>
                                <div class="row-fluid ">
                                    <div class="span12">
                                        <input type="radio" class="styled" name="<?php  echo "survey_".$data->_id ?>" value="OptionTwo">   <?php  echo $data->OptionTwo ?>
                                    </div>
                                </div>
                                <div class="row-fluid ">
                                    <div class="span12">
                                        <input type="radio" class="styled" name="<?php  echo "survey_".$data->_id ?>" value="OptionThree">   <?php  echo $data->OptionThree ?>
                                    </div>
                                </div>
                                <?php if(!empty($data->OptionFour)){ ?>
                                <div class="row-fluid ">
                                    <div class="span12">
                                        <input type="radio" class="styled" name="<?php  echo "survey_".$data->_id ?>" value="OptionFour">   <?php  echo $data->OptionFour ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                                </div>
                                <?php  } ?>
                            <?php  if($data->DisplayType == "Block" && (isset($data->IsBlockedWordExistInComment) && $data->IsBlockedWordExistInComment==1) && !$data->DisableComments && sizeof($data->Comments)>0){?>
                                <div class="social_bar" >	
                                    <span><i class="tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="Comment" ><img src="/images/system/spacer.png" class="comments" ></i><b id="commentCount_<?php  echo $data->_id; ?>"><?php  echo sizeof($data->Comments)?></b></span>              
                                </div>
                            <?php  }?>
                              </li>
                </ul>
                              <?php if($data->CategoryType==3 ){ ?>
                                   <div class="media-body"> 
                                    <div class="m_title">
                                        <span class="pull-right" data-id="<?php echo $data->GroupId; ?>">
                                            <a class="grpIntro grpIntro_b" data-postId="<?php echo $data->GroupId;?>" data-id="<?php echo $data->GroupId; ?>" style="cursor:pointer"><b><?php echo $data->GroupName; ?></b></a>
                                        </span>
                                    </div>
                                </div> 
                                   <?php } ?>
                <?php if($data->CategoryType==7 ){ ?>
                                   <div class="media-body"> 
                                    <div class="m_title">
                                        <span class="pull-right" data-id="<?php echo $data->SubGroupId; ?>">
                                            <a class="subgrpIntro grpIntro_b" data-postId="<?php echo $data->SubGroupId;?>" data-id="<?php echo $data->SubGroupId; ?>" style="cursor:pointer"><b><?php echo $data->SubGroupName; ?></b></a>
                                        </span>
                                    </div>
                                </div> 
                                   <?php } ?>
                   <?php if($data->CategoryType==2 ){ ?>
                                   <div class="media-body"> 
                                    <div class="m_title">
                                        <span class="pull-right" data-id="<?php echo $data->CategoryId; ?>">
                                            <a class="curbsideCategory" id="curbsideCategory" data-postId="<?php echo $data->CategoryId;?>" data-id="<?php echo $data->CategoryId; ?>" style="cursor:pointer"><b><?php echo $data->CurbsideConsultCategory; ?></b></a>
                                        </span>
                                    </div>
                                </div> 
                                   <?php } ?>
                
                
            </div>
        </div>
        <?php if($data->DisplayType == "Block" && (isset($data->IsBlockedWordExistInComment) && $data->IsBlockedWordExistInComment==1) && !$data->DisableComments && sizeof($data->Comments)>0){ ?>
        <div class="commentbox commentbox_blocked" id="cId_<?php  echo $data->_id; ?>"  style="display:<?php  echo count($data->Comments)==0 ?'none':'block';?>">
            <div id="commentSpinLoader_<?php  echo $data->_id; ?>"></div>
           
           <?php  $comments=$data->Comments;
        $commentCount=sizeof($comments);
        $style="display:none";
        ?>
           <div class="myClass" id="CommentBoxScrollPane_<?php echo $data->_id;?>"  >
    <div   id="commentbox_<?php  echo $data->_id ?>" style="display:<?php  echo $commentCount>0?'block':'none';?>">
      <div id="commentsAppend_<?php  echo $data->_id; ?>"></div>
        <?php 
        if(sizeof($data->Comments)>0){
         
            if(sizeof($data->Comments)>2){
                 $style="display:block";
            }
         $maxDisplaySize = sizeof($data->Comments)>2?2:sizeof($data->Comments);
  
            for($j=0;$j<$maxDisplaySize;$j++){ 
             
                
                $comment=$data->Comments[$j];
                ?>
          <div class="commentsection" id="comment_<?php  echo $data->_id ?>_<?php  echo $comment['CommentId'] ?>">
          <div class="row-fluid commenteddiv">
          <div class="span12">
                 <div class=" stream_content">
                <ul>
                    <li class="media" style="overflow: visible">
              <?php  if($comment["NoOfArtifacts"]>0){
                  
                  
                  $commentID = $comment['CommentId'];
                  $extension = "";
                  $extension = strtolower($comment["Extension"]);
                  if($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                       $videoclassName = 'videoThumnailDisplay';
                                    
                    }else {
                        $videoclassName='videoThumnailNotDisplay';
                    }
                  
                  
                  
                  
                  ?>
             
                        <?php  if($comment['NoOfArtifacts']==1){?>
                       <a class="pull-left img_single postdetail" ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $comment["ArtifactIcon"] ?>"  ></a>
                        <?php  }else{ ?>
                           <div class="pull-left multiple "> 
                                    <div class="img_more1"></div>
                                    <div class="img_more2"></div>
                            
                             <a class="pull-left pull-left1 img_more postdetail" ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $comment["ArtifactIcon"] ?>"></a>  
                                
                                </div>
                        <?php  } ?>
                             <?php   } ?> 
                            
                            <div class="media-body " style="overflow: visible" >
                            <div class="positionrelative padding-right30 streampostactions">
                                <?php if($comment["IsBlockedWordExist"]==1){ ?>
                                <div class="postmg_actions">
                                    <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-down"></i>
                                    <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-up"></i>
                                    <div id="CommentBlockOrRemove" class="dropdown-menu ">
                                        <ul class="PostManagementActions abusedPosts" data-postId="<?php echo $data->_id ?>" data-commentId="<?php echo $comment['CommentId'] ?>" data-categoryType="<?php echo $data->CategoryType ?>" data-networkId="<?php echo $data->NetworkId ?>">
                                            <li><a name="Block" class="Block"><span class="blockicon"><img src="/images/system/spacer.png"></span> Block</a></li>
                                            <li><a name="Release" class="Release"><span class="releaseicon"><img src="/images/system/spacer.png"></span> Release</a></li>
                                        </ul>

                                    </div>
                                </div>
                                <?php } ?>
                    <div data-postid="<?php echo $data->_id; ?>" id="post_content_<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType;?>">
                            <?php  
                                  echo $comment["CommentText"];
                             ?>
                                </div>
   
                            
                            
                         
                            <!-- Nested media object -->
                            <div class="media">
                                <a class="pull-left marginzero smallprofileicon">
                                    <img src="<?php  echo $comment['ProfilePicture'] ?>">
                                </a>
                                <div class="media-body">
                                    <span class="m_day"><?php  echo $comment["CreatedOn"]; ?></span>
                                    <div class="m_title"><a class="userprofilename" data-id="<?php  echo $comment['UserId'] ?>"  style="cursor:pointer"><?php  echo $comment["DisplayName"] ?></a></div>
                                </div>
                            </div>
                            </div>
                        </div>
                           </li>
                </ul>
            </div>
          </div>
          </div>
  
                </div>
            <?php  } ?>
     
        <?php  }else{
                 $style="display:none";
        } 
        if($commentCount >2 && sizeof($data->Comments)==2){
             $style="display:block";
        }
        
        ?>
   
        </div> 
    </div>
            <?php if($commentCount >2){ ?>
           <div class="viewmorecomments alignright">
                <span  id="viewmorecomments_<?php  echo $data->_id; ?>" style="<?php echo $style; ?>" onclick="viewmoreComments('/post/postComments','<?php  echo $data->_id ?>','<?php  echo $data->_id ?>','<?php echo $data->CategoryType; ?>',1);">More Comments</span>
              </div>
            <?php } ?>
         </div>
        <?php } ?>
    </div>
</div>
</div>
<?php  }?>
<script type="text/javascript">
    Custom.init();
      $('.grpIntro').live("click",function(){
            var groupId=$(this).attr('data-id');
            getGroupIntroPopUp(groupId);             
                  
              });
                $('.subgrpIntro').live("click",function(){
            var subgroupId=$(this).attr('data-id');
            getSubGroupIntroPopUp(subgroupId);       
                  
              });
              
             $('.curbsideCategory').live("click",
            function() {
                var categoryId = $(this).attr('data-postId');                
            //    var streamId = $(this).parent('span').attr('data-id');
                getMiniCurbsideCategoryProfile(categoryId);
                trackEngagementAction("CurbCategoryMinPopup",'',categoryId);
            }
    );  
</script>
    <?php 
      }else{
          echo $abusedposts;
      }
?>
