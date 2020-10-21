 <?php if(is_object($stream))  
 {
     try {$dateFormat =  CommonUtility::getDateFormat();
         foreach($stream as $data){?>

<div  class="post item streamactionsdiv " style="" id="postitem_<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>">  
    <li class="gamelist <?php echo (isset($data->IsPromoted) && $data->IsPromoted==1)?'gamepromoted':''; ?> " id="gameId_<?php echo $data->_id; ?>" >
        
        <div style="position: relative" class="gamewallpop">
        <div id="schedule_<?php echo $data->_id; ?>" class='scheduleGameDiv' style="top:0px;position: relative;right: 0px;left: 0px;bottom:0;background-color: #e6e6e6;z-index: 9;display:none" ></div>
        <div id="game_<?php echo $data->_id; ?>" >
        <div style="position: relative" class="stream_title paddingt5lr10 ">
           
             <?php  $time=$data->CreatedOn?>
                  <a href="/<?php echo $data->GameName ?>/<?php echo $data->CurrentGameScheduleId ?>/detail/game " class="userprofilename">
                    <b id="gameName_<?php echo $data->_id ?>" data-id="<?php echo $data->_id ?>"  data-name="<?php echo   $data->GameName ?>" class="group"><?php echo $data->GameName?></b>
                </a>  <?php if(Yii::app()->session['IsAdmin']==1 || $data->CanDeletePost==1 ){?>
                     <div class="postmg_actions">
                    <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-down"></i>
                    <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-up"></i>
                  
                    <div class="dropdown-menu ">
                        
                        <ul class="PostManagementActions" data-streamId="<?php echo $data->_id ?>"  data-postId="<?php echo $data->PostId ?>" data-categoryType="<?php echo $data->CategoryType ?>" data-networkId="<?php echo $data->NetworkId ?>">
                            
                           <?php if($data->IsDeleted == 0 && Yii::app()->session['IsAdmin']==1 ){?> <li><a href="/game/edit/<?php echo $data->PostId ?>" class="" id=""><span class="featuredicon"><img src="/images/system/spacer.png"></span> Edit</a></li><?php }?>
                           
                                        <?php if (Yii::app()->session['IsAdmin'] == 1) { ?>
                                                        <?php if ($data->IsDeleted == 1) { ?>                    <li><a class="release"><span class="releaseicon"><img src="/images/system/spacer.png" /></span> Release Game</a></li><?php
                                                        } else {
                                                            ?>
                                                <li><a class="suspend"><span class="deleteicon"><img src="/images/system/spacer.png" /></span> Suspend Game</a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                        
                        </ul>
                       
                        </div>
                   
                </div>  <?php }?> 
                              </div>
    
        <div class="mediaartifacts positionrelative"><a href="/<?php echo $data->GameName ?>/<?php echo $data->CurrentGameScheduleId ?>/detail/game " class="group"> <img src="<?php echo $data->GameBannerImage ?>"></a>
        <div class="isFeatured" id="isFeatutedIcon_<?php  echo $data->_id ?>" <?php if($data->IsFeatured==1){?> style="display:block" <?php }else {?> style="display:none"<?php  }?> > </div></div>
        
            <div class="g_descriptiontext" style="word-wrap: break-word" id="gameDescription_<?php echo $data->_id ?>" data-id="<?php echo $data->_id ?>"  data-name="<?php echo $data->GameDescription ?>" class="group"><?php echo $data->GameDescription?>
        </div>
        <?php if (Yii::app()->session['IsAdmin']==1) { ?>
        <div class="row-fluid">
                        <div class="span12">
                            
                            
                          
                                            <?php if ($data->SchedulesArray != 'noschedules') { ?>

                                                <?php foreach ($data->SchedulesArray as $schedule) { ?>

                            <span id="scheduleId_<?php echo $schedule['_id'] ?>" class="g_scheduleDate g_scheduleDateGameWall"><?php echo date($dateFormat,CommonUtility::convert_date_zone($schedule['StartDate']->sec,Yii::app()->session['timezone'],  date_default_timezone_get()));  ?>  to  <?php echo date($dateFormat,CommonUtility::convert_date_zone($schedule['EndDate']->sec,Yii::app()->session['timezone'],  date_default_timezone_get()));  ?> 


                                                        <?php
                                                        if ($schedule['IsCurrentSchedule'] == 1) {

                                                           if ($schedule['EndDate']->sec >= time()) {
                               
                                                               ?>
                                
                                                                <span style="padding-left: 10px" data-streamId="<?php echo $data->_id ?>"  data-postId="<?php echo $data->PostId ?>" data-categoryType="<?php echo $data->CategoryType ?>" data-scheduleId="<?php echo $schedule['_id'] ?>"  class="deleteicon  cancelschedule"><img src="/images/system/spacer.png" /></span>    


                                                                <?php
                                                            }
                                                        } else {
                                                            if ($schedule['EndDate']->sec >= time() && $schedule['IsCancelSchedule'] == 0) {
                                                                ?>
                                                                <span style="padding-left: 10px" data-streamId="<?php echo $data->_id ?>"  data-postId="<?php echo $data->PostId ?>" data-categoryType="<?php echo $data->CategoryType ?>" data-scheduleId="<?php echo $schedule['_id'] ?>"  class="deleteicon  cancelschedule"><img src="/images/system/spacer.png" /></span>     


                                                                <?php
                                                            }
                                                        }
                                                        ?></span>  <?php
                                                }
                                            }
                                            ?>
                            
                      
                    </div>
                   
                </div>
        <?php }?> 
        
        <div class="stream_content" style="padding-bottom:0">
            
                     <div  class="media">
                           
 <div class="media-status">
     <ul>
         <li><div class="statusminibox GW_questions" id="GW_questions_<?php echo $data->PostId; ?>" data-mode="<?php echo $data->GameStatus?>" data-gameName="<?php echo $data->GameName; ?>" data-gameId="<?php echo $data->PostId; ?>" data-gameScheduleId="<?php  echo $data->CurrentGameScheduleId; ?>" data-isAdmin="<?php echo Yii::app()->session['IsAdmin']?>">
                 <div class="statustitle"># Questions</div>
                 <div class="statuscount"><?php  echo $data->QuestionsCount?></div>
             </div></li>
         <li><div class="statusminibox">
                 <div class="statustitle"># Players</div>
                 <div class="statuscount"><?php  echo $data->PlayersCount?></div>
             </div></li>
         <li><div class="statusminibox aligncenter">
                     <div class="padding-top35">
                <div class="gamebutton" id="gameWallButton" data-id="<?php echo $data->_id?>" >
             
            <?php
            
            
            if($data->GameStatus=="play"){
                $class = "btn btnplay";
                $label = "Play Now <i class='fa fa-chevron-circle-right'></i>";
            }
            else if($data->GameStatus=="resume"){
                 $class = "btn btnresume";
                  $label = "Resume <i class='fa fa-chevron-circle-right'></i>";
            }
            else if($data->GameStatus=="view"){
               $class = "btn btnviewanswers";
                $label = "View <i class='fa fa-chevron-circle-right'></i>";
            }
                ?>
                    <?php if($data->GameStatus!="future" && $data->IsNotifiable==1){?>
              <button type="button" class="<?php echo $class?> " id="gameBtnWall_<?php echo $data->_id?>" data-mode="<?php echo $data->GameStatus?>" data-gameName="<?php echo $data->GameName; ?>" data-gameId="<?php echo $data->PostId; ?>" data-gameScheduleId="<?php  echo $data->CurrentGameScheduleId; ?>"><?php echo $label?> </button>
                    <?php }?>
          </div>
                     
                     
                     </div></li>
     </ul></div>
 </div>
                        
                          <div class="social_bar g_social_bar" style="border-bottom:0"  data-id="<?php  echo $data->_id ?>" data-postid="<?php  echo $data->PostId ?>" data-postType="<?php  echo $data->PostType;?>" data-categoryType="<?php  echo $data->CategoryType;?>" data-networkId="<?php  echo $data->NetworkId; ?>">
                 <?php if($data->IsNotifiable==1 && $data->IsDeleted == 0){?>             
              <a class="follow_a"><i><img class="tooltiplink <?php echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $data->PostFollowers)?'follow':'unfollow' ?>" src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="<?php  echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $data->PostFollowers)?'Unfollow':'Follow' ?>"></i><b id="followCount_<?php echo $data->PostId; ?>"><?php echo count($data->PostFollowers) ?></b></a>
              <a><i><img data-original-title="Invite" rel="tooltip" data-placement="bottom" class=" tooltiplink cursor invite_frds" src="/images/system/spacer.png"></i></a>
               <span class="cursor"><i><img  class=" tooltiplink cursor <?php  echo $data->IsLoved?'likes':'unlikes' ?>"   data-placement="bottom" rel="tooltip"  data-original-title="Love" src="/images/system/spacer.png"></i><b id="streamLoveCount_<?php  echo $data->PostId; ?>"><?php  echo $data->LoveCount?></b></span>
             <span><i ><img src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Comment" class=" cursor tooltiplink  <?php  if($data->PostType!=5){?><?php echo $data->IsCommented?'commented':'comments'?><?php }else{?>comments1 postdetail<?php }?>" <?php  if($data->PostType ==5){?> data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->PostId ?>" data-postType="<?php  echo $data->PostType;?>" data-categoryType="<?php  echo $data->CategoryType;?>" <?php } ?> ></i><b id="commentCount_<?php  echo $data->PostId; ?>"><?php  echo $data->CommentCount?></b></span>
               <?php }?> 
             <?php if ($data->IsDeleted == 0 && Yii::app()->session['IsAdmin']==1) { ?>             
             <div class="gamefloatingmenu1 pull-right " >
                   <ul class="PostManagementActionsFooter" data-streamId="<?php echo $data->_id ?>"  data-postId="<?php echo $data->PostId ?>" data-categoryType="<?php echo $data->CategoryType ?>" data-networkId="<?php echo $data->NetworkId ?>">
                      <?php if($data->IsNotifiable==1 &&  $data->IsDeleted == 0   ){?> 
                          
                          <?php  if($data->CanFeaturePost==1 && $data->IsFeatured==0){?>
                       <li><span id="featuredicon_<?php  echo $data->_id ?>" rel="tooltip"  data-placement="bottom" data-original-title="Mark as featured" style="cursor: pointer"  class="featuredicon cursor"><img  class="tooltiplink" src="/images/system/spacer.png" /></span></li> 
                            <?php  }?>
                           <?php if ($data->CanPromotePost == 1) { ?><li><span style="cursor: pointer" class="promoteicon  cursor" ><img class="tooltiplink" rel="tooltip" data-placement="bottom"   data-original-title="Promote" src="/images/system/spacer.png" /></span></li>
                               <?php } ?>
                            <?php } ?>               
                     
                     <li id="openSchedule_<?php  echo $data->PostId ?>" class="openSchedule" data-postid="<?php  echo $data->PostId ?>"  data-streamId="<?php  echo $data->_id ?>" class="gamerightlist active"> 
                                          <a class="scheduleC_icon"  ><img id="schedule" class=" tooltiplink cursor" data-placement="bottom" rel="tooltip"  data-original-title="Schedule a game" src="/images/system/spacer.png" /></a>
                                      </li>    
                                  </ul>   </div>
                       
                        </div>
             <?php }?>     
                        
                      
                          <!--this is for schedule -->
                   
              <!--End of Schedule-->
        </div>
                      <div class="commentbox" id="cId_<?php  echo $data->_id; ?>"  style="display:<?php  echo ($data->CommentCount==0 || $data->RecentActivity=="Invite") ?'none':'block';?>">
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
                            $videoclassName="";
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
                                $extension = "";
                                $imageVideomp3Id = "";
                                $extension = strtolower($comment['Artifacts']["Extension"]);
                                if($extension == "mp4" || $extension == "avi" || $extension == "flv" || $extension == "mov" || $extension == "mp3" ){ 
                                    $className = "videoimage";
                                    $uri = $comment['Artifacts']["Uri"];
                                    $imageVideomp3Id = "imageVideomp3_$commentID";
                                }else{
                                    $className = "postdetail";                                
                                }
                                if($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                      $videoclassName = 'videoThumnailDisplay';
                                    
                                }else {
                                    $videoclassName='videoThumnailNotDisplay';
                                }
                            ?>
                            <?php if(!empty($imageVideomp3Id)){ ?>
                            <div id="playerClose_<?php echo $commentID; ?>"  style="display: none;">
                                <div class="videoclosediv alignright"><button aria-hidden="true"  data-dismiss="modal" onclick="closeVideo('<?php echo $commentID; ?>');" class="videoclose" type="button">×</button></div>
                                <div class="clearboth"><div id="streamVideoDiv<?php echo $commentID; ?>"></div></div>
                            </div>
                            <?php } ?>  
                                <a id="imgsingle_<?php echo $commentID; ?>" class="pull-left img_single <?php echo $className; ?>" data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>" data-videoimage="<?php echo $uri; ?>"><div id='img_streamVideoDiv<?php echo $commentID; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $comment["ArtifactIcon"] ?>" <?php if(!empty($imageVideomp3Id)){ echo "id=$imageVideomp3Id"; }?>  ></a>
                        <?php  }else{ ?>
                                
                                <div class="pull-left multiple "> 
                                    <div class="img_more1"></div>
                                    <div class="img_more2"></div>
                                    <a class="pull-left pull-left1 img_more  postdetail" data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>"><div id='img_streamVideoDiv<?php echo $commentID; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $comment["ArtifactIcon"] ?>"></a>
                                </div>                                                
                          
                        <?php  } ?>
                             <?php   } ?> 
                            
                        <div class="media-body" >

                    <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>" data-id="<?php echo $data->_id;?>" id="post_content_<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType;?>">

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
               <script type="text/javascript">
            $(function(){
                var extensions='"jpg","jpeg","gif","mov","mp4","mp3","txt","doc","docx","pptx","pdf","ppt","xls","xlsx","avi","png","tiff","mov","flv"';
                initializeFileUploader("postupload_<?php  echo $data->_id?>", '/post/upload', '10*1024*1024', extensions,4, 'commentTextArea','<?php  echo $data->_id?>',previewImage,appendErrorMessages,"uploadlist_<?php  echo $data->_id?>");
            });
            
         </script>
    </div>
           <div class="viewmorecomments alignright">
                <span  id="viewmorecomments_<?php  echo $data->_id; ?>" style="<?php echo $style; ?>" onclick="viewmoreComments('/post/postComments','<?php  echo $data->PostId ?>','<?php  echo $data->_id ?>','<?php echo $data->CategoryType; ?>');">More Comments</span>
              </div>

             <div id="ArtifactSpinLoader_postupload_<?php  echo $data->_id?>"></div>
           <div id="newComment_<?php echo $data->_id; ?>" style="display:none" class="paddinglrtp5">
                       <div id="commentTextArea_<?php echo $data->_id; ?>" class="inputor commentplaceholder" contentEditable="true" onclick="OpenCommentbuttonArea('<?php echo $data->_id; ?>','<?php echo $data->CategoryType; ?>')" data-categorytype="<?php echo $data->CategoryType; ?>"></div>
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
                                           <div id="postupload_<?php echo $data->_id ?>" data-placement="bottom" rel="tooltip"  data-original-title="Upload">
                                           </div>

                                       </li>


                                   </ul>
                                   
                                   <a ></a> <a ><i><img src="/images/system/spacer.png" class="actionmore" ></i></a></div>
                           </div>
                          
                           <div class="pull-right">

                               <button id="savePostCommentButton_<?php echo $data->_id; ?>" onclick="savePostCommentByUserId('<?php echo $data->PostId; ?>','<?php echo $data->PostType; ?>','<?php echo $data->CategoryType; ?>','<?php echo $data->NetworkId; ?>','<?php echo $data->_id; ?>');" class="btn" data-loading-text="Loading...">Comment</button>
                               <button id="cancelPostCommentButton_<?php echo $data->_id; ?>" onclick="cancelPostCommentByUserId('<?php echo $data->_id; ?>','<?php echo $data->CategoryType; ?>')" class="btn btn_gray"> Cancel</button>

                           </div>
                           <div id="commenterror_<?php echo $data->PostId; ?>" class="alert alert-error displayn" style="margin-left: 30px;margin-right: 157px;"></div>

                       </div>
                       <div ><ul class="qq-upload-list" id="uploadlist_<?php echo $data->_id ?>"></ul></div>
                   </div>
        </div>     
         </div>   </div>       
    
</li>
  </div>
        <script type="text/javascript">
            
            if(g_postIds == ""){
                g_postIds = '<?php echo $data->PostId; ?>';
            }else{
                g_postIds = g_postIds+","+'<?php echo $data->PostId; ?>';
            }
            function setCommentArrowPoition(){
            if($('#commentCount_<?php  echo $data->PostId; ?>').length>0){
            var commentArrowLeft = $('#commentCount_<?php  echo $data->PostId; ?>').prev().find('img').position().left;
           //alert(commentArrowLeft)
            $('div#cId_<?php  echo $data->_id; ?>.commentbox').append('<style>div#cId_<?php  echo $data->_id; ?>.commentbox:before{left:134px}</style>');
            $('div#cId_<?php  echo $data->_id; ?>.commentbox').append('<style>div#cId_<?php  echo $data->_id; ?>.commentbox:after{left:134px}</style>');
        }
        }
        setTimeout(setCommentArrowPoition,50);
        </script>
<?php  }
     } catch (Exception $exc) {     
         error_log("-------------message--------------------".$exc->getMessage());
     }

     
      }else{          
          echo $stream;
      ?>
          
    <?php  }
      ?>
