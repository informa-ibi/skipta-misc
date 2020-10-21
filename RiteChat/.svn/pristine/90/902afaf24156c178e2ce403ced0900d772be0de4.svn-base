<?php 
 if(is_object($stream))
      {
     $style="display:block";
    foreach($stream as $data){
    if($data->CategoryType!=13){
?>
<div class="post item <?php echo (isset($data->IsPromoted) && $data->IsPromoted==1)?'promoted':''; ?>" style="width:100%;display:none" id="postitem_<?php echo $data->_id; ?>" >
    
<div class="stream_widget marginT10" >
    <div class="profile_icon"><img src="<?php echo $data->FirstUserProfilePic ?>" > </div>
    <div class="post_widget" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType;?>">
        <div class="stream_msg_box">
            
            <div class="stream_title paddingt5lr10" style="position: relative"> <a class="userprofilename" data-streamId="<?php echo $data->_id;?>" data-id="<?php echo $data->FirstUserId ?>" style="cursor:pointer"><b><?php echo $data->FirstUserDisplayName?></b></a><?php echo $data->SecondUserData?> <?php echo $data->StreamNote."  ".$data->PostTypeString ?>  <?php if ($data->PostType==5){echo "- ".$data->CurbsideConsultTitle ?> <i><?php echo $data->PostOn; ?></i><?php }else{?><i><?php echo $data->PostOn; ?></i><?php }?>
                <div class="postmg_actions"  >
                    <i class="fa fa-chevron-down" data-toggle="dropdown" data-placement="right"></i>
                    <i class="fa fa-chevron-up" data-toggle="dropdown" data-placement="right"></i>
                    <div class="dropdown-menu ">
                        <ul class="PostManagementActions" data-streamId="<?php echo $data->_id ?>"  data-postId="<?php echo $data->PostId ?>" data-categoryType="<?php echo $data->CategoryType ?>" data-networkId="<?php echo $data->NetworkId ?>">
                            <?php  if($data->CanFeaturePost==1 && $data->IsFeatured==0){?>
                            <li><a id="MarkAsFeatured_<?php  echo $data->_id ?>"  class="featured m_featured"><span class="featuredicon"><img src="/images/system/spacer.png" /></span> Mark As Featured Item</a></li><?php  }?>
                            <li><a class="abuse"><span class="abuseicon"><img src="/images/system/spacer.png" /></span> Flag as abuse</a></li>
                            <?php if ($data->CanPromotePost == 1) { ?><li><a class="promote"><span class="promoteicon"><img src="/images/system/spacer.png" /></span> Promote</a>
                            </li><?php } ?>
                            <?php if ($data->CanDeletePost == 1) { ?><li><a class="delete"><span class="deleteicon"><img src="/images/system/spacer.png" /></span> Delete</a></li><?php } ?>
                         </ul>
                    </div>
                </div>  
            </div>
            <div class=" stream_content positionrelative">
                <ul>
                    <li class="media">
                        
                        
                            <?php if($data->PostType!=3){//not survey post ?>
                               
                       <?php  if($data->ArtifactIcon!=""){
                            $extension = "";
                           $videoclassName="";
                           $extension = strtolower($data->Resource["Extension"]);
                           if($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                $videoclassName = 'videoThumnailDisplay';

                          }else {
                              $videoclassName='videoThumnailNotDisplay';
                          }
                           
                           if($data->IsMultiPleResources==1){?>
                        <?php
                                $className = ""; 
                                $uri = "";
                               
                                $imageVideomp3Id = "";
                                
                                if($extension == "mp4" || $extension == "avi" || $extension == "flv" || $extension == "mov" || $extension == "mp3" ){ 
                                    $className = "videoimage";
                                    $uri = $data->Resource["Uri"];
                                    $imageVideomp3Id = "imageVideomp3_$data->_id";
                                }else{
                                    $className = "postdetail";                                
                                }
                                
                            ?>
                            <?php if(!empty($imageVideomp3Id)){ ?>
                            <div id="playerClose_<?php echo $data->_id; ?>"  style="display: none;">
                                <div class="videoclosediv alignright"><button aria-hidden="true"  data-dismiss="modal" onclick="closeVideo('<?php echo $data->_id; ?>');" class="videoclose" type="button">×</button></div>
                                <div class="clearboth"><div id="streamVideoDiv<?php echo $data->_id; ?>"></div></div></div>
                            <?php } ?>  
                                <a id="imgsingle_<?php echo $data->_id; ?>" class="pull-left img_single <?php echo $className; ?>" data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>" data-videoimage="<?php echo $uri; ?>" data-vimage="<?php  echo $data->ArtifactIcon ?>"><div id='img_streamVideoDiv<?php echo $data->_id; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $data->ArtifactIcon ?>" <?php if(!empty($imageVideomp3Id)){ echo "id=$imageVideomp3Id"; }?>  ></a>
                        <!--<a  class="pull-left img_single postdetail"  data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>"><img src="<?php  echo $data->ArtifactIcon ?>"  ></a>-->
                        <?php  }else{ ?>
                                <div class="pull-left multiple "> 
                                    <div class="img_more1"></div>
                                    <div class="img_more2"></div>
                             <a  class="pull-left  pull-left1 img_more postdetail" data-id="<?php echo $data->_id;?>" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>"><div id='img_streamVideoDiv<?php echo $data->_id; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $data->ArtifactIcon ?>"></a>  
                                
                                </div>
                            
                        <?php  }} ?>
                            
                            <!-- spinner -->
                            <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>"></span>
                                    <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>
                            <!-- end spinner -->
                        <div class="media-body">
                            <div class="isFeatured" id="isFeatutedIcon_<?php  echo $data->_id ?>" <?php if($data->IsFeatured==1){?> style="display:block" <?php }else {?> style="display:none"<?php  }?> > </div>
            
            
              <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>" data-id="<?php echo $data->_id;?>" id="post_content_total_<?php echo $data->_id; ?>" style="display:none">
                                    <?php
                                    echo $data->PostCompleteText;
                                    ?>
                                </div>
           
                            <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>" data-id="<?php echo $data->_id;?>" id="post_content_<?php echo $data->_id; ?>">
                            <?php  
                                  echo $data->PostText;
                             ?>
                                </div>
                             </div>
                            <?php 
                            
                            if(isset($data->WebUrls->Weburl)){
                            
                            if(isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist=='1'){   ?>            
                             <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px; clear:both;">
                                 <div class="Snippet_div" style="position: relative">

                                        <a href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">

                             <?php if($data->WebUrls->WebImage!=""){ ?>
                                    <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $data->WebUrls->WebImage; ?>"></span>
                                            <?php } ?>   </a>            
                                            <div class="media-body">                                   
                                                    

                                                        <label class="websnipheading"><?php echo $data->WebUrls->WebTitle ?></label>
                                                      
                                                            <a  class="websniplink" href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank"> <?php echo $data->WebUrls->WebLink ?></a>
                                                        <p><?php echo $data->WebUrls->Webdescription ?></p>
                                                    
                                                </div>

                                        
                                    </div>
                           </div>
                          
                            <?php } }?>       
                      
                            <!-- Nested media object -->
                                <?php if((int) $data->FirstUserId !=  (int)$data->OriginalUserId ){?>
                            <div class="media">
                                
                                <a  class="pull-left marginzero smallprofileicon postdetail" data-id="<?php echo $data->_id;?>"  data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>"><img src="<?php  echo $data->OriginalUserProfilePic ?>"  ></a>
                               
                                <div class="media-body">                                   
                                    <span class="m_day"><?php echo $data->OriginalPostPostedOn; ?></span>
                                    <div class="m_title"><a class="userprofilename" data-streamId="<?php echo $data->_id;?>" data-id="<?php echo $data->OriginalUserId ?>"  style="cursor:pointer"><?php echo $data->OriginalUserDisplayName; ?></a><?php if ($data->PostType==5){?><div id="curbside_spinner_<?php echo $data->_id; ?>"></div><span class="pull-right" data-id="<?php echo $data->_id; ?>"><?php echo $data->CurbsideConsultCategory?></span><?php }?></div>
                                     
                                </div>
                                </div><?php } else if($data->PostType==5){ ?>
                                 <div class="media-body"> 
                                     <div id="curbside_spinner_<?php echo $data->_id; ?>"></div>
                                    <div class="m_title"><span class="pull-right" data-id="<?php echo $data->_id; ?>"><?php echo $data->CurbsideConsultCategory?></span></div>
                                </div>
                             <?php }?>
                            
                            
                             <?php }?>
                            
                        <div class="social_bar"  data-id="<?php  echo $data->_id ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType;?>" data-categoryType="<?php echo $data->CategoryType;?>"  data-networkId="<?php  echo $data->NetworkId; ?>">	
                            <?php //if($this->tinyObject->UserId != $tinyOriginalUser['UserId']){?>
                            <a class="follow_a"><i><img src="/images/system/spacer.png"  class=" tooltiplink cursor  <?php echo $data->IsFollowingPost?'follow':'unfollow' ?>" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->IsFollowingPost?'Unfollow':'Follow' ?>" ></i><b id="streamFollowUnFollowCount_<?php  echo $data->PostId; ?>"><?php  echo $data->FollowCount ?></b></a>
                            <?php //} ?>
                            <a ><i><img src="/images/system/spacer.png" class="tooltiplink cursor  invite_frds" data-placement="bottom" rel="tooltip"  data-original-title="Invite" ></i></a>
                            <span><i><img  class=" tooltiplink cursor <?php echo $data->IsLoved?'likes':'unlikes' ?>"  data-placement="bottom" rel="tooltip"  data-original-title="Love" src="/images/system/spacer.png"></i><b id="streamLoveCount_<?php echo $data->PostId; ?>"><?php echo $data->LoveCount?></b></span>
                            <?php  if(YII::app()->params['Share']=='ON')
                                  {
                                  if(!$data->TwitterShare || !$data->FbShare){ 
                                $shareCount = (isset($data->ShareCount) && is_int($data->ShareCount))?$data->ShareCount:0;
                                $shareClass = ($data->TwitterShare || $data->FbShare)>0?'sharedisable':'share';
                                ?>
                            <span class="sharesection" ><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="Share" data-placement="bottom"><img src="/images/system/spacer.png"  class="<?php echo $shareClass; ?>"  ></i><b id="streamShareCount_<?php  echo $data->_id; ?>"><?php  echo $shareCount;?></b>
                            <div class="dropdown-menu actionmorediv">
                                 <ul id="share_<?php echo $data->_id; ?>">
                                     <?php if(!$data->FbShare){ ?>
                                     <li class="shareFacebook"><a onclick="prepareWallPostData('<?php  echo $data->PostId ?>','<?php  echo $data->CategoryType;?>','<?php echo $data->PostType;?>','<?php  echo $data->_id;?>')"><i class="fa fa-facebook"></i> Facebook</a></li>
                                     <?php }if(!$data->TwitterShare){ ?>
                                     <li class="shareTwitter"><a onclick="getTweetLink('<?php  echo $data->PostId ?>','<?php  echo $data->CategoryType;?>','<?php echo $data->PostType;?>','<?php  echo $data->_id;?>')"><i class="fa fa-twitter"></i> Twitter</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            
                             </span><?php }else{?>
                                 <span class="sharesection"><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="Share" data-placement="bottom"><img src="/images/system/spacer.png"  class="sharedisable"  ></i><b id="streamShareCount_<?php  echo $data->_id; ?>"><?php  echo (isset($data->ShareCount) && is_int($data->ShareCount))?$data->ShareCount:0?></b></span>
                                  <?php } }?>
                            <span><i><img src="/images/system/spacer.png" class="<?php echo $data->IsCommented?'commented':'comments'?> tooltiplink cursor "  data-placement="bottom" rel="tooltip"  data-original-title="Comment" ></i><b id="commentCount_<?php echo $data->PostId; ?>"><?php echo $data->CommentCount?></b></span>              
                        </div>
                              </li>
                </ul>
            </div>
        </div>
        <?php if($data->RecentActivity=="Invite"){ ?>
        <div style="" id="Invite_<?php  echo $data->_id; ?>" class="commentbox  ">
            <div class="padding10"><?php echo $data->InviteMessage; ?></div>
            <style>#Invite_<?php  echo $data->_id; ?>.commentbox:before{left:4px}</style><style>#Invite_<?php  echo $data->_id; ?>.commentbox:after{left:4px}</style>
        </div>
        <?php } ?>
        <div id="PostdetailSpinLoader_curbsideStreamDetailedDiv"></div>
       <div class="commentbox" id="cId_<?php  echo $data->_id; ?>"  style="display:<?php  echo (count($data->Comments)==0 || $data->RecentActivity=="Invite")?'none':'block';?>">
           <div id="commentSpinLoader_<?php  echo $data->_id; ?>"></div>
           
           <?php  $comments=$data->Comments;
        $commentCount=sizeof($comments);
        ?>
        <div class="myClass" id="CommentBoxScrollPane_<?php echo $data->_id;?>"  >
    <div   id="commentbox_<?php  echo $data->_id ?>" style="display:<?php  echo $data->CommentCount>0?'block':'none';?>">
      <div id="commentsAppend_<?php  echo $data->_id; ?>"></div>
        <?php 
          $style="display:none";
        if(sizeof($data->Comments)>0){
           
             if(sizeof($data->Comments)>2){
                    $style="display:block";
               }
         $maxDisplaySize = sizeof($data->Comments)>2?2:sizeof($data->Comments);
  
            for($j=sizeof($data->Comments);$j>sizeof($data->Comments)-$maxDisplaySize;$j--){ 
             
                
                $comment=$data->Comments[$j-1];
                ?>
          <div class="commentsection">
          <div class="row-fluid commenteddiv">
          <div class="span12">
                 <div class=" stream_content">
                <ul>
                    <li class="media">
              <?php  if($comment["NoOfArtifacts"]>0){
                  
                  $commentID = $comment['CommentId'];
                  $extension = "";
                  $extension = strtolower($comment['Artifacts']["Extension"]);
                  if($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                       $videoclassName = 'videoThumnailDisplay';
                                    
                    }else {
                        $videoclassName='videoThumnailNotDisplay';
                    }
                  ?>
             
                        <?php  if($comment['NoOfArtifacts']==1){$commentID = $comment['CommentId'];
                            foreach($commentID as $id){
                                $commentID = $id;
                            }
                            ?>
                        <?php
                                $className = ""; 
                                $uri = "";
                                
                                $imageVideomp3Id = "";
                                
                                if($extension == "mp4" || $extension == "avi" || $extension == "flv" || $extension == "mov" || $extension == "mp3" ){ 
                                    $className = "videoimage";
                                    $uri = $comment['Artifacts']["Uri"];
                                    $imageVideomp3Id = "imageVideomp3_$commentID";
                                }else{
                                    $className = "postdetail";                                
                                } 
                                
                            ?>
                            <?php if(!empty($imageVideomp3Id)){ ?>
                            <div id="playerClose_<?php echo $commentID; ?>"  style="display: none;">
                                <div class="videoclosediv alignright"><button aria-hidden="true"  data-dismiss="modal" onclick="closeVideo('<?php echo $commentID; ?>');" class="videoclose" type="button">×</button></div>
                                <div class="clearboth"><div id="streamVideoDiv<?php echo $commentID; ?>"></div></div>
                            </div>
                            <?php } ?>  
                                <a id="imgsingle_<?php echo $commentID; ?>" class="postdetail pull-left img_single <?php echo $className; ?>" data-id="<?php echo $data->_id;?>" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>" data-videoimage="<?php echo $uri; ?>" data-vimage="<?php  echo $data->ArtifactIcon ?>"><div id='img_streamVideoDiv<?php echo $commentID; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $comment["ArtifactIcon"] ?>" <?php if(!empty($imageVideomp3Id)){ echo "id=$imageVideomp3Id"; }?>  ></a>
                        
                        <?php  }else{ ?>
                                <div class="pull-left multiple "> 
                                    <div class="img_more1"></div>
                                    <div class="img_more2"></div>
                            
                             <a class="pull-left pull-left1 img_more postdetail" data-id="<?php echo $data->_id;?>" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>"><div id='img_streamVideoDiv<?php echo $commentID; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $comment["ArtifactIcon"] ?>"></a>  
                                
                                </div>
                           
                        <?php  } ?>
                             <?php   } ?> 
                            
                        <div class="media-body" >
                          
                    <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>" data-id="<?php echo $data->_id; ?>" id="post_content_<?php echo $data->PostId; ?>">
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
                                    <div class="m_title"><a class="userprofilename" data-streamId="<?php echo $data->_id;?>" data-id="<?php  echo $comment['UserId'] ?>"  style="cursor:pointer"><?php  echo $comment["DisplayName"] ?></a></div>
                                </div>
                            </div>
                            </div>
                            <?php 
                            
                            if(isset($comment['WebUrls'])){
                            if(isset($comment["IsWebSnippetExist"]) && $comment["IsWebSnippetExist"]=='1'){     ?>           

                <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;clear:both;">
                                 <div class="Snippet_div" style="position: relative">

                                        <a href="<?php echo $comment['WebUrls']['Weburl']; ?>" target="_blank">
                                             <?php if($comment['WebUrls']['WebImage']!=""){ ?>
                                                    <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $comment['WebUrls']['WebImage']; ?>"></span>
                                            <?php } ?></a>
                                            <div class="media-body">                                   
                                                    

                                                        <label class="websnipheading" ><?php echo $comment['WebUrls']['WebTitle']; ?></label>
                                                     <a   class="websniplink" href="<?php echo $comment['WebUrls']['Weburl']; ?>" target="_blank"> <?php echo $comment['WebUrls']['WebLink']; ?> </a>
                                                        <p><?php echo $comment['WebUrls']['Webdescription']; ?></p>
                                                    
                                                </div>
                                      
                                    </div>
                           </div>
                      
                            <?php }} ?>
                        
                            
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
        
        if($data->CommentCount >2 && sizeof($data->Comments)==2){
             $style="display:block";
        }else if($data->CommentCount > sizeof($data->Comments)){
             $style="display:block";
        } 
        
        ?>
   
        </div> 
    </div>
             <div class="viewmorecomments alignright">
                <span  id="viewmorecomments_<?php  echo $data->_id; ?>" style="<?php echo $style; ?>" onclick="viewmoreComments('/post/postComments','<?php  echo $data->PostId ?>','<?php  echo $data->_id ?>','<?php echo $data->CategoryType; ?>');">More Comments</span>
              </div>

             <div id="ArtifactSpinLoader_postupload_<?php  echo $data->_id?>"></div>
           <div id="newComment_<?php echo $data->_id; ?>" style="<?php echo $style;?>" class="paddinglrtp5">
                       <div id="commentTextArea_<?php echo $data->_id; ?>" class="inputor commentplaceholder" contentEditable="true"  onkeyup="getsnipetForComment(event,this,'<?php echo $data->_id; ?>');"  onclick="OpenCommentbuttonArea('<?php echo $data->_id; ?>')"></div>
                       <div id="commentTextAreaError_<?php echo $data->_id; ?>" style="display: none;"></div>
                       <div class="alert alert-error" id="commentTextArea_<?php echo $data->_id; ?>_Artifacts_em_" style="display: none;"></div>
                       <input type="hidden" id="artifacts_<?php echo $data->_id; ?>" value=""/>
                       <div id="preview_commentTextArea_<?php echo $data->_id; ?>" class="preview" style="display:none">
                           <ul id="previewul_commentTextArea_<?php echo $data->_id; ?>" class="imgpreview">

                           </ul>


                       </div>
                       <div  id="snippet_main_<?php echo $data->_id; ?>" class="snippetdiv" style="" ></div> 
                       <div class="postattachmentarea" id="commentartifactsarea_<?php echo $data->_id; ?>" style="display:none;">
                           <div class="pull-left whitespace">
                               <div class="advance_enhancement">
                                   <ul>
                                       <li class="dropdown pull-left ">
                                           <div class="" id="postupload_<?php echo $data->_id ?>" data-placement="bottom" rel="tooltip"  data-original-title="Upload">
                                           </div>

                                       </li>


                                   </ul>
                        
                                   <a ></a> <a ><i><img src="/images/system/spacer.png" class="actionmore" ></i></a></div>
                           </div>
                           <div class="pull-right">

                               <button id="savePostCommentButton_<?php echo $data->_id; ?>" onclick="savePostCommentByUserId('<?php echo $data->PostId; ?>','<?php echo $data->PostType; ?>','<?php echo $data->CategoryType; ?>','<?php echo $data->NetworkId; ?>','<?php echo $data->_id; ?>');" class="btn" data-loading-text="Loading...">Comment</button>
                               <button id="cancelPostCommentButton_<?php echo $data->_id; ?>" onclick="cancelPostCommentByUserId('<?php echo $data->_id; ?>')" class="btn btn_gray"> Cancel</button>

                           </div></div>
                       <div ><ul class="qq-upload-list" id="uploadlist_<?php echo $data->_id ?>"></ul></div>

                   </div>
        </div>
      
    </div>
</div>
   

</div>
 <?php
        } else {

            include Yii::app()->basePath.'/views/post/advertisement_view.php';
        }
        ?>
   
<script type="text/javascript">
    var createdon = '<?php echo $data->CreatedOn->sec; ?>';
    $("#postitem_<?php echo $data->_id; ?>").show();
    if(g_pflag == 0){
        g_pflag = 1;    
            g_postIds = '<?php echo $data->PostId; ?>';
        }else{
               g_postIds = g_postIds+','+'<?php echo $data->PostId; ?>';
                g_pflag = 1;
        }
        <?php if($data->IsPromoted == 0){?>
    if(g_postDT != undefined && g_postDT != null){        
        if(g_postDT < createdon){            
            g_postDT = createdon;
            g_iv = 1;
            status = 0;
        }else if(g_iv == 0){            
            g_postDT = createdon;            
            g_iv = 1;
            status = 0;
        }   
    }
        <?php } ?>
  var postid='<?php echo $data->_id; ?>';
              var divheight=$("#CommentBoxScrollPane_"+ postid).height();

          if(divheight >250){
                 $("#CommentBoxScrollPane_"+ postid).addClass("scroll-pane"); 
                  $("#CommentBoxScrollPane_" + postid).jScrollPane({autoReinitialise: true, stickToBottom: true});
          } 
//          socketCurbside.emit('updateGlobalDateValue', g_postDT,g_postIds);
</script>
<script type="text/javascript">
    $(function(){
        if(detectDevices()){
           $('.postmg_actions').removeClass().addClass("postmg_actions postmg_actions_mobile");
        }       
    });
    
    $('#postitem_'+'<?php echo $data->_id; ?>').mousemove(function( event ) {
          var id = $(this).prop('id');
          use4storiesinsertedid = id;
          
          
        });
    
</script>
<script type="text/javascript">
                        
                            var extensions='"jpg","jpeg","gif","mov","mp4","mp3","txt","doc","docx","pptx","pdf","ppt","xls","xlsx","avi","png","tiff","mov","flv"';
                            if(isMobile|| UploadMedia==1)
                            initializeFileUploader("postupload_<?php echo $data->_id ?>", '/post/upload', '10*1024*1024', extensions, 4,'commentTextArea','<?php echo $data->_id?>',previewImage,appendErrorMessages,"uploadlist_<?php echo $data->_id?>");
                        
                     </script>
 <?php }
      }else{
          echo $stream;
      }
?>
