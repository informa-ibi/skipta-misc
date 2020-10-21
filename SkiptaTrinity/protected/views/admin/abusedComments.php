<?php if(sizeof($data->Comments)>0){ ?>
        <div class="commentbox commentbox_blocked" id="cId_<?php  echo $data->_id; ?>" >
           <?php  $comments=$data->Comments;
        $commentCount=sizeof($comments);
        $style="display:none";
        ?>
           <div class="myClass" id="CommentBoxScrollPane_<?php echo $data->_id;?>"  >
    <div   id="commentbox_<?php  echo $data->_id ?>" >
        <?php foreach($data->Comments as $comment){ 
            ?>
          <div class="commentsection" id="comment_<?php  echo $data->_id ?>_<?php  echo $comment['CommentId'] ?>">
          <div class="row-fluid commenteddiv">
          <div class="span12">
                <div class="positionrelative padding-right30 streampostactions postmg_actions_div">
                    <?php if($comment["IsAbused"]==1){ ?>
                        <div class="postmg_actions">
                            <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-down"></i>
                            <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-up"></i>
                            <div id="AbusedCommentBlockOrRemove" class="dropdown-menu ">
                                <ul class="CommentManagementActions abusedPosts" data-postId="<?php echo $data->_id ?>" data-commentId="<?php echo $comment['CommentId'] ?>" data-categoryType="<?php echo $categoryType ?>" data-networkId="<?php echo $data->NetworkId ?>" data-CommentCreatedUserId="<?php echo $comment['UserId'] ?>">
                                    <li><a name="BlockAbusedComment" class="BlockAbusedComment"><span class="blockicon"><img src="/images/system/spacer.png"></span> Block</a></li>
                                    <li><a name="ReleaseAbusedComment" class="ReleaseAbusedComment"><span class="releaseicon"><img src="/images/system/spacer.png"></span> Release</a></li>
                                </ul>

                            </div>
                        </div>
                        <?php } ?>
                </div>
                 <div class=" stream_content">
                <ul>
                    <li class="media" style="overflow: visible">
              <?php  if($comment["NoOfArtifacts"]>0){
                  
                  
                  $commentID = $comment['CommentId'];
                  $categoryType = isset($data->CategoryType)?$data->CategoryType:$categoryType;
                  $extension = "";
                  $extension = strtolower($comment["Extension"]);
                  if($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                       $videoclassName = 'videoThumnailDisplay';
                                    
                    }else {
                        $videoclassName='videoThumnailNotDisplay';
                    }
                  
                  
                  
                  
                  ?>
             
                        <?php  if($comment['NoOfArtifacts']==1){?>
                       <a class="pull-left img_single postdetail" data-posttype="<?php echo $data->Type ?>" data-categorytype="<?php echo $categoryType ?>" data-postid="<?php echo $data->_id ?>" data-id="<?php echo $data->_id ?>"><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $comment["ArtifactIcon"] ?>"  ></a>
                        <?php  }else{ ?>
                           <div class="pull-left multiple "> 
                                    <div class="img_more1"></div>
                                    <div class="img_more2"></div>
                            
                             <a class="pull-left pull-left1 img_more postdetail" data-posttype="<?php echo $data->Type ?>" data-categorytype="<?php echo $categoryType ?>" data-postid="<?php echo $data->_id ?>" data-id="<?php echo $data->_id ?>"><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $comment["ArtifactIcon"] ?>"></a>  
                                
                                </div>
                        <?php  } ?>
                             <?php   } ?> 
                            
                            <div class="media-body " style="overflow: visible" >
                            <div class="positionrelative padding-right30 streampostactions">
                                
                    <div data-postid="<?php echo $data->_id; ?>" id="post_content_<?php echo $data->_id; ?>" data-categoryType="<?php echo $categoryType;?>">
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
     
     
   
        </div> 
    </div>
           
         </div>
        <?php } ?>