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
                            <div class="positionrelative padding-right30 streampostactions postmg_actions_div">
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