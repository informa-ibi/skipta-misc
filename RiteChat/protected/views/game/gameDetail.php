<?php include 'miniProfileScript.php'; ?>
<?php include 'hashTagProfileScript.php'; ?>
<?php include 'commentscript.php'; ?>
<?php include 'detailedcommentscript.php'; ?>
<?php include 'commentscript_instant.php'; ?>
<?php include 'inviteScript.php'; ?>
<?php $count = 0;?>
<h2 class="pagetitle" >Games</h2>
 <div id="gameDetailSpinLoader"></div>
<div  class="paddingtop6" >
<div id="GameBanner" class="collapse in">
  <div  class="groupbanner positionrelative " > 
      <div class="gamebannerTitle">
          <div class="padding20">
          
          
          <div class="gamebutton">
              
            <?php 
            
            if($mode == "play" && $gameBean->gameStatus=="play"){
               $class = "btn btnplay btndisable";
              // $label = "Playing";  
            }
             if($mode == "resume" && $gameBean->gameStatus=="resume"){
               $class = "btn btnresume btndisable";
              // $label = "Playing";  
            }
            else
            if($gameBean->gameStatus=="play"){
                $class = "btn btnplay";
                $label = "Play Now <i class='fa fa-chevron-circle-right'></i>";
            }
            else if($gameBean->gameStatus=="resume"){
                 $class = "btn btnresume";
                  $label = "Resume <i class='fa fa-chevron-circle-right'></i>";
            }
           else if($gameBean->gameStatus=="view") {
               $class = "btn btnviewanswers"; 
                $label = "View <i class='fa fa-chevron-circle-right'></i>";
            }
            if($gameBean->gameStatus=="play" || $gameBean->gameStatus=="resume" || $gameBean->gameStatus=="view"){
               ?>
         <button type="button" class="<?php echo $class?> " id="gameBtn" data-gameId="<?php echo $gameDetails->_id; ?>" data-gameScheduleId="<?php echo $gameBean->gameScheduleId; ?>"><?php echo $label?> </button>
 
           <?php }?>
         <div style="display: none" id="gameDummyBtn" data-gameId="<?php echo $gameDetails->_id; ?>" data-gameScheduleId="<?php echo $gameBean->gameScheduleId; ?>"></div>
         
             
          </div>
          </div>
      </div>
<img style="max-width:100%" src="<?php echo $gameDetails->GameBannerImage?>">
</div>
</div>
    <div id="gameDetailDiv" class="row-fluid">
     <div class="span6">
           <div class="gameNameBold"><?php echo $gameDetails->GameName?></div>
     <div class="padding8top">
         
          
     <div id="profile" class="collapse in">
             <div class="" id="gameShortDescription"><div id="descriptioToshow" class="e_descriptiontext">
                <?php echo $gameBean->shortDescription; ?>
                 </div>
     </div>
                 <div  style="display:none;padding: 5px" id="gameDetailDescription"><div id="descriptioToshow" class="e_descriptiontext">
              <?php echo $gameDetails->GameDescription; ?>
             </div>
     
     </div>
          <div class="alignright clearboth" id="game_descriptionMore" style="display:<?php echo strlen($gameDetails->GameDescription)>240?'block':'none'; ?>"> <a id="more" class="more">more <i class="fa fa-chevron-circle-right"></i></a></div>
     <div class="alignright clearboth" > <a style="display:none"  class="moreup" id="moreup">close <i class="fa fa-chevron-circle-up"></i></a></div>
     </div>
        
         <!-- comment -->
         <?php $data = $gameDetails; $categoryType=9;?>
         
     </div>
     </div>
          <div class="span6 ">
          <div id="gamemenu" class="collapse in">
              <div class="grouphomemenuhelp alignright"></div>
         <div class="grouphomemenu">
             
     <ul>
     <li class="normal">
         <div class="menubox leadingindividuals">
             <div class="menuboxpopupHeader">Leading Individuals</div>
     
     <div class="media">
                                <a class="pull-left marginzero smallprofileicon" id="gameprofileimage" data-name="<?php echo $gameBean->uniqueHandle; ?>">
                                    <img  src="<?php if(isset($gameBean->highestScoreUserPicture)) echo $gameBean->highestScoreUserPicture; else{echo '/upload/profile/user_noimage.png';}?>">
                                </a>
                               
                                <div class="media-body">                                   
                                    
                                    <div class="m_title"><a style="cursor:pointer" data-id="<?php echo $gameBean->highestGameUserId; ?>" class="userprofilename" data-streamId="<?php  echo $data->_id; ?>" data-name="<?php echo $gameBean->uniqueHandle; ?>"><?php echo $gameBean->highestScoreUserName; ?></a></div>
                                    <div class="m_day"><?php echo $gameDetails->GameHighestScore; ?> <span>points</span></div>
                                </div>
                             </div>
     
     </div>
     
     </li>
         
       
     
     <li class="normal"  onclick="<?php if (Yii::app()->session['IsAdmin'] == 1) echo 'showQuestion()'?>">
     <div class="menubox">
         <div class="menuboxpopup"><span>#Questions</span></div>
     <div id="GroupPostCount" class="groupmenucount"><?php echo $gameDetails->QuestionsCount; ?></div>
     <div class="conversationmenu questionsmenu"><img src="/images/system/spacer.png"></div>

     </div>

     </li>
       <li class="normal" >
     <div class="menubox">
         <div class="menuboxpopup"><span>#Players</span></div>
     <div id="gamePlayersCount" class="groupmenucount"><?php if($gameDetails->PlayersCount!=null) echo $gameDetails->PlayersCount;else echo 0; ?></div>
     <div class="conversationmenu playersmenu"><img src="/images/system/spacer.png"></div>

     </div>

     </li>
     </ul>
     </div>
          </div>
              
<!--          <div class="alignright padding8top ">
          <button type="button" class="btn btn_gray btn_toggle" data-toggle="collapse" data-target="#profile, #gamemenu, #Hide, #Show, #GameBanner">
              <span id="Hide" class="collapse in"> Hide <i class="fa fa-caret-up"></i></span>
   <span id="Show" class="collapse ">Show <i class="fa fa-caret-down"></i></span>
</button>
</div>-->
          </div>
     
     </div>
    <div id="gameSocailActions" style="<?php if(!isset($gameBean->gameStatus)) echo "display:none"?>">
     <div class="social_bar g_social_bar" data-id="<?php echo $gameDetails->_id; ?>" data-postid="<?php echo $gameDetails->_id; ?>" data-postType="<?php  echo $gameDetails->Type;?>" data-categoryType="<?php  echo $gameBean->CategoryType;?>" data-networkId="<?php  echo $gameDetails->NetworkId;?>">
      <a class="follow_a"><i><img class="tooltiplink <?php echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $gameDetails->Followers)?'follow':'unfollow' ?>" src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="<?php  echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $gameDetails->Followers)?'Unfollow':'Follow' ?>"></i><b><?php echo count($gameDetails->Followers) ?></b></a>
 <a><i><img data-original-title="Invite" rel="tooltip" data-placement="bottom" class=" tooltiplink cursor invite_frds" src="/images/system/spacer.png"></i></a>
 <span class="cursor"><i><img  class=" tooltiplink cursor <?php echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $gameDetails->Love)?'likes':'unlikes' ?>"   data-placement="bottom" rel="tooltip"  data-original-title="Love" src="/images/system/spacer.png"></i><b id="streamLoveCount_<?php  echo $gameDetails->_id; ?>"><?php  echo count($gameDetails->Love)?></b></span>
 <?php   if(!$gameDetails->DisableComments){
                
                if(count($gameDetails->Comments)>0){
                    foreach ($gameDetails->Comments as $key=>$value) {
                        
                        if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist']==1)) {
                            $count++;
                        }
                    }
                }
      ?>
         <span><i ><img id="detailedComment" src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Comment" class=" cursor tooltiplink  <?php  if($gameDetails->Type!=5){?><?php echo $gameBean->isCommented?'commented':'comments'?><?php }else{?>comments1 postdetail<?php }?>" <?php  if($gameDetails->Type ==5){?> data-id="<?php echo $gameDetails->_id;?>" data-postid="<?php  echo $gameDetails->_id ?>" data-postType="<?php  echo $gameDetails->Type;?>" data-categoryType="<?php $gameBean->CategoryType?>" <?php } ?> ></i><b id="det_commentCount_<?php  echo $gameDetails->_id; ?>"><?php  echo $count; ?></b></span>
                
                  <?php  }?>

           
             
        </div>
    <div class="commentbox <?php  if($data->Type==5){?>commentbox2<?php  }?> " id="cId_<?php   echo $data->_id; ?>" >
              <div id="commentSpinLoader_<?php  echo $data->_id; ?>"></div>
            
              <div id="ArtifactSpinLoader_postupload_<?php echo $data->_id ?>"></div>
                  <div id="newComment"  class="paddinglrtp5">
                      <div id="commentTextArea_<?php echo $data->_id; ?>" class="inputor commentplaceholder" contentEditable="true" onkeyup="getsnipetForComment(event,this,'<?php echo $data->_id; ?>');"  onclick="OpenCommentbuttonArea('<?php echo $data->_id; ?>')"></div>
                      <div id="commentTextAreaError_<?php echo $data->_id; ?>" style="display: none;"></div>
                      <div class="alert alert-error" id="commentTextArea_<?php echo $data->_id; ?>_Artifacts_em_" style="display: none;"></div>
                      <input type="hidden" id="artifacts" value=""/>
                      <div id="preview_commentTextArea_<?php echo $data->_id; ?>" class="preview" style="display:none">
                          <ul id="previewul_commentTextArea_<?php echo $data->_id; ?>" class="imgpreview">

                          </ul>


                      </div>
                      <div  id="snippet_main_<?php echo $data->_id; ?>" class="snippetdiv" style="" ></div>        
                      <div class="postattachmentarea" id="commentartifactsarea_<?php echo $data->_id; ?>" style="display:none">
                          <div class="pull-left whitespace">
                              <div class="advance_enhancement">
                                  <ul>
                                      <li class="dropdown pull-left ">
                                          <div id="postupload_<?php echo $data->_id; ?>">
                                          </div>

                                      </li>


                                  </ul>

                                  <a href="#" ></a> <a href="#" ><i><img src="/images/system/spacer.png" class="actionmore" ></i></a></div>
                          </div>
                          <div class="pull-right">

                              <button id="savePostCommentButton" onclick="saveDetailedPostCommentByUserId('<?php echo $data->_id; ?>','<?php echo $data->Type; ?>','<?php echo $categoryType; ?>','1','<?php echo $data->_id; ?>','postDetailed');" class="btn" data-loading-text="Loading...">Comment</button>
                              <button id="cancelPostCommentButton" data-postid="<?php echo $data->_id ?>"  class="btn btn_gray"> Cancel</button>

                          </div></div>
                      <div ><ul class="qq-upload-list" id="uploadlist_<?php echo $data->_id ?>"></ul></div>
                      <div style="display:<?php echo count($data->Comments) > 0 ? 'block' : 'none'; ?>" class="postattachmentareaWithComments"> <img src="/images/system/spacer.png" />
                      </div>
                  </div>

              <div  id="CommentBoxScrollPaneTest" >
              <div id="commentbox_<?php echo $data->_id; ?>" style="display:<?php   echo count($data->Comments)>0?'block':'none';?>">
      <div id="commentsAppend_<?php   echo $data->_id; ?>"></div>
              <?php  if(count($data->Comments)>0){ $commentsCnt = 0;?>
              
 <?php  foreach ($commentsdata as $key => $value) {
    ?>

    <div class="commentsection" id="comment_<?php  echo $value->PostId ?>_<?php  echo $value->CommentId ?>">
          <div class="row-fluid commenteddiv">
          <div class="span12">
                 <div class=" stream_content">
                <ul>
                    <li class="media overfolw-inherit">

                       <?php   if(count($value->Resource) >0){?>
                        <div class="padding5">
        
        <div class="chat_subheader ">Artifacts</div>

                    
          
        
         
        <div class="row-fluid padding8top detailed_media">
                            <div class="span12">
                               <?php  
                               $i = 0;
                    foreach($value->Resource as $art){
                        
                           $extType = strtolower($art['Extension']);
//                            if($extType=='ppt'||$extType=='pptx'){
//                             $image="/images/system/PPT-File-icon.png";
//                        }else if($extType=='pdf'){
//                         $image="/images/system/pdf.png";
//                    }else if($extType=='doc' || $extType=='docx'){
//                         $image="/images/system/MS-Word-2-icon.png";
//                    }else if($extType=='exe' || $extType=='xls'|| $extType=='xlsx'|| $extType=='ini'){
//                         $image="/images/system/Excel-icon.png";
//                    } else if ($extType == 'txt') {
//                            $image = "/images/system/notepad-icon.png";
//                    }
                            if(isset($art['ThumbNailImage'])){
                               $image=$art['ThumbNailImage'];
                           }else{
                               $image="";
                           }
                        if($extType == "mp3"){?>
                                <?php  if($i == 0){ $i++; $class="d_img_outer_video"; }else{$class="";}?>
                            <div class="span3"> 

                                <div class="d_img_outer_video_play" >

                                <img style="cursor:pointer;" src="/images/system/audio_img.png" data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="videodivid"/>
                            </div>
                            </div>
                    
                      <?php  }else if($extType == "mp4" || $extType == 'flv' || $extType == 'mov'){
                          
                          $videoclassName = 'PostdetailvideoThumnailDisplay';
                          
                          ?>
                               <?php  if($i == 0){ $i++; $class="d_img_outer_video"; }else{$class="";}?>
                            <div class="span3"> 

                                <div class="d_img_outer_video_play" style="cursor:pointer;" ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div>

                                <img style="cursor:pointer;" src='<?php echo $image;?>' data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="videodivid"/>
                            </div>
                            </div>
                        <?php  }else  if($extType == "jpg" || $extType == "png" || $extType == "jpeg" || $extType == "giff"){?>
                            <div class="span3">    
                               <div class="d_img_outer_video_play" id="comment_artifactOpen">
                                    <?php if($categoryType=='3'){ ?>
                                    <img style="cursor:pointer;" src="<?php  echo str_replace('/upload/public/thumbnails/','/upload/group/images/',$art['Uri']);?>" data-uri="<?php  echo str_replace('/upload/public/thumbnails/','/upload/group/images/',$art['Uri']);?>" id="commentImageDiv" data-format="<?php  echo $extType;?>" class="imageimgdivid"/>
                                    <?php }else{?>
                                    
                                      <img style="cursor:pointer;" src="<?php  echo str_replace('/upload/public/thumbnails/','/upload/public/images/',$art['Uri']);?>" data-uri="<?php  echo str_replace('/upload/public/thumbnails/','/upload/public/images/',$art['Uri']);?>" id="commentImageDiv" data-format="<?php  echo $extType;?>" class="imageimgdivid"/>
                                    
                                    <?php } ?>
                                
                                </div>
                            </div>
                        <?php  }else if($extType == "pdf" || $extType == "txt" || $ext=='doc' || $ext=='xls' || $extType == "ppt" || $ext=='docx' || $ext=='xlsx'){ ?>
                                <div class="span3"> 
                                <div class="d_img_outer_video_play" >
                                     <img  id="artifactOpen" style="cursor:pointer;" src="<?php echo $image;?>" data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="pdfdivid"/>
                                </div>  
                            </div>
                        <?php  }else{ ?>
                            
                            <div class="span3">     
                                <div class="">
                               <a href="/post/fileopen/?file=<?php  echo $art['Uri'];?>"  id="downloadAE"><img  id="artifactOpen" style="cursor:pointer;" src="<?php echo $image;?>" data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="pdfdivid"/> </a>          
                               
                            </div>
                            </div>
                            
                     <?php  } }?>
                    
                
                            
                            </div>
                            </div>
                        </div>
                        
                        
                             <?php    } ?> 
                            
                            
                            
                <div class="media-body overfolw-inherit" >
                    <div class="positionrelative padding-right30 streampostactions">
                        <?php if($value->IsBlockedWordExist==1){ ?>
                        <div class="postmg_actions">
                            <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-down"></i>
                            <i data-placement="right" data-toggle="dropdown" class="fa fa-chevron-up"></i>
                            <div id="CommentBlockOrRemove" class="dropdown-menu ">
                                <ul class="PostManagementActions abusedPosts" data-postId="<?php echo $value->PostId ?>" data-commentId="<?php echo $value->CommentId ?>" data-categoryType="<?php echo $value->CateogryType ?>" data-networkId="<?php echo $NetworkId ?>">
                                    <li><a name="Block" class="Block"><span class="blockicon"><img src="/images/system/spacer.png"></span> Block</a></li>
                                    <li><a name="Release" class="Release"><span class="releaseicon"><img src="/images/system/spacer.png"></span> Release</a></li>
                                </ul>

                            </div>
                        </div>
                        <?php } ?>
                        <div id="comment_text" data-id="<?php  echo $data->_id; ?>"><?php echo $value->CommentText; ?></div>

                        <div class="media">
                            <a href="#" class="pull-left marginzero smallprofileicon">
                                <img   src="<?php echo $value->ProfilePic; ?> ">                  </a>
                            <div class="media-body">
                                <span class="m_day"><?php echo $value->PostOn; ?></span>
                                <div class="m_title"> <a class="userprofilename"  data-id="<?php echo $value->UserId; ?>" data-streamId="<?php  echo $data->_id; ?>" data-name="<?php echo $value->DisplayName; ?>" style="cursor:pointer"><?php echo $value->DisplayName; ?></a></div>
                            </div>
                        </div>
                        <?php if(isset($value->IsWebSnippetExist)&& $value->IsWebSnippetExist=='1'){     ?>           

                <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;">
                                 <div class="Snippet_div" style="position: relative">
                            <?php if(isset($value->snippetdata['Weburl'])&& ($value->snippetdata['Weburl']!="")){ ?>      
                                    <a href="<?php 
                                         echo $value->snippetdata['Weburl']; ?>" target="_blank">
                                            
                                        <?php if($value->snippetdata['WebImage']!=""){ ?>
                                             <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $value->snippetdata['WebImage']; ?>"></span>
                                            <?php } ?>     
                                            <div class="media-body">                                   
                                                           <label class="websnipheading"> <?php echo $value->snippetdata['WebTitle'] ?> </label>
                                                     <a class="websniplink" href="<?php echo $value->snippetdata['Weburl']; ?>" target="_blank"> <?php echo $value->snippetdata['WebLink']; ?></a>
                                                            <p><?php echo $value->snippetdata['Webdescription']; ?></p>
                                                    
                                                </div>
                                        </a>  
                            <?php } ?>
                                   
                                    </div>
                           </div>
                      
              <?php } ?>
                    </div>
                </div>
              </li>
                </ul>
            </div>
              
              
              
                      
               
              
               
              
          
          </div>
          </div>
  
                </div>
<?php } ?>
       
          
          </div>
         
        <?php  } ?>
              </div>
               <?php  if($count >5){ ?>
           <div class="viewmorecomments alignright">
                <span  id="viewmorecommentsDetailed" onclick="viewmoreCommentsIndetailedPage('/post/postComments','<?php   echo $data->_id ?>','<?php   echo $data->_id ?>','Streampost','<?php  echo $categoryType; ?>');">More Comments</span>
              </div>
      <?php   } ?>
                  
          </div>

</div>
</div>

    
       
<div id="questions" game-id="<?php echo $gameDetails->_id; ?>" schedule-id="<?php echo $gameBean->gameScheduleId; ?>">
  
</div>
<script type="text/javascript">
    var extensions='"jpg","jpeg","gif","mov","mp4","mp3","txt","doc","docx","pptx","pdf","ppt","xls","xlsx","avi","png","tiff","mov","flv"';
//        initializeFileUploader("postupload_<?php   echo $data->_id?>", '/post/upload', '10*1024*1024', extensions,'4','commentTextArea','<?php   echo $data->_id?>',previewImage,appendErrorMessages,4);
        initializeFileUploader("postupload_<?php   echo $data->_id?>", '/post/upload', '10*1024*1024', extensions,'4','commentTextArea','<?php   echo $data->_id?>',previewImage,appendErrorMessages,"uploadlist_<?php   echo $data->_id?>");
     bindEventsForStream('gameSocailActions');
     bindgameEvents();
     function bindgameEvents(){
          $(".btnplay").unbind().bind("click",function(obj){
        // $(this).hide();
        showGame('play',$(this).attr("data-gameid"),$(this).attr("data-gamescheduleid"));
         $("#gameBtn").html("Play Now <i class='fa fa-chevron-circle-right'></i>");
       $("#gameBtn").attr("class","btn btnplay btndisable");
        $(".btnplay").unbind();
    });
   
     $(".btnresume").unbind().bind("click",function(){
        showGame('resume',$(this).attr("data-gameid"),$(this).attr("data-gamescheduleid"));
       // $(this).hide();
        $("#gameBtn").html("Resume <i class='fa fa-chevron-circle-right'></i>");
        $("#gameBtn").attr("class","btn btnresume btndisable");
        $(".btnresume").unbind();
       
    });
    $(".btnviewanswers").unbind().bind("click",function(){
          $("#gameBtn").html("View <i class='fa fa-chevron-circle-right'></i>");
        $("#gameBtn").attr("class","btn btnviewanswers btndisable");
        $(".btnviewanswers").unbind();
        showGame('view',$(this).attr("data-gameid"),$(this).attr("data-gamescheduleid"));
    });
     }
   
    function showGame(type,gameId,gameScheduleId){
         scrollPleaseWait("gameDetailSpinLoader","contentDiv");
        var queryString = {type:type,gameId:gameId,gameScheduleId:gameScheduleId};
        ajaxRequest("/game/showGame",queryString,function(data){showGameHandler(data,type)},"html");
    }
    function showGameHandler(data,type){
         scrollPleaseWaitClose("gameDetailSpinLoader");
       $("#questions").html(data);
       $(".commentbox  ").hide();
      
       if(type == "play"){
                $("#gamePlayersCount").html(parseInt($("#gamePlayersCount").html())+1);
  
       }
    }
  
    if("<?php echo $mode?>"=="play" && "<?php echo $gameBean->gameStatus?>"=="play"){ 
      // $(".btnplay").trigger("click"); 
       $("#gameBtn").html("Play Now <i class='fa fa-chevron-circle-right'></i>");
       $("#gameBtn").attr("class","btn btnplay btndisable");
        $(".btnplaying").unbind();
        showGame('play',$("#gameBtn").attr("data-gameid"),$("#gameBtn").attr("data-gamescheduleid"));

    }
    else if("<?php echo $mode?>"=="resume" && "<?php echo $gameBean->gameStatus?>"=="resume"){ 
      // $(".btnresume").trigger("click"); 
      //Custom=null;
       $("#gameBtn").html("Resume <i class='fa fa-chevron-circle-right'></i>");
       $("#gameBtn").attr("class","btn btnplay btndisable");
        $(".btnplaying").unbind();
        showGame('resume',$("#gameBtn").attr("data-gameid"),$("#gameBtn").attr("data-gamescheduleid"));
    }
    else if("<?php echo $mode?>"=="view" && "<?php echo $gameBean->gameStatus?>"=="view"){
         $("#gameBtn").html("View <i class='fa fa-chevron-circle-right'></i>");
       $("#gameBtn").attr("class","btn btnviewanswers btndisable");
        $(".btnviewanswers").unbind();
       showGame('view',$("#gameBtn").attr("data-gameid"),$("#gameBtn").attr("data-gamescheduleid"));

    }else{
       //showGame('resume',$("#gameBtn").attr("data-gameid"),$("#gameBtn").attr("data-gamescheduleid"));
  
    }
    
     $(".btnplaying").unbind();
     function showQuestion(){
        
        if(<?php echo Yii::app()->session['IsAdmin']?>==1){
            $("#gameBtn").removeClass("btndisable");
             bindgameEvents();
              showGame('viewAdmin',$("#gameDummyBtn").attr("data-gameid"),$("#gameDummyBtn").attr("data-gamescheduleid"));

        }
  
     }
     $("#cancelPostCommentButton").bind('click',function(){
            $("#commentTextArea").html("");
             var postId = $(this).attr('data-postid');
            if($('#commentbox_' + postId).height() >0){
            $('#cId_' + postId).show();
            }else{
            $('#cId_' + postId).hide();
            }
            //$("#newComment,#commentDetailedBox").hide();
            $("#commentartifactsarea_"+postId).hide();
             $("#commentTextArea_"+postId).addClass('commentplaceholder');
             $("#commentartifactsarea_" + postId).css("min-height","20px");
             $("#commentTextArea_" + postId).css("min-height", "");
            
        });
        g_commentPage = 1;
        
        function setCommentArrowPoition(){
        var commentLeft = $('#detailedComment').position().left;
       
         $('.commentbox').append('<style>#postDetailedwidget .commentbox:before{left:'+commentLeft+'px}</style>');
         $('.commentbox').append('<style>#postDetailedwidget .commentbox:after{left:'+commentLeft+'px}</style>');
     }
      if($('#det_commentCount_<?php  echo $data->_id; ?>').length>0){
            var commentArrowLeft = $('#det_commentCount_<?php  echo $data->_id; ?>').prev().find('img').position().left;
            $('div#cId_<?php  echo $data->_id; ?>.commentbox').append('<style>div#cId_<?php  echo $data->_id; ?>.commentbox:before{left:'+commentArrowLeft+'px}</style>');
            $('div#cId_<?php  echo $data->_id; ?>.commentbox').append('<style>div#cId_<?php  echo $data->_id; ?>.commentbox:after{left:'+commentArrowLeft+'px}</style>');
        }
      
     if("<?php echo $mode?>"=="questions" && <?php echo Yii::app()->session['IsAdmin']?>=="1"){ 
        
             showQuestion();
           
        
     }
     $("#gameprofileimage").unbind().bind("click",function(){
           var displayName = $(this).attr('data-name');
           if(displayName!=null && displayName!="undefined" && displayName!=""){
             window.location = "/profile/"+displayName;

           }
     });
       $(".userprofilename").unbind().bind("click",function(){
           
           var postId = $(this).attr('data-streamId');
                var userId = $(this).attr('data-id');               
                getMiniProfile(userId,postId);
                trackEngagementAction("ProfileMinPopup",userId);

           
     });
     
//      $("#" + divId + " a.userprofilename").live("click",
//            function() {
//                var postId = $(this).attr('data-streamId');
//                var userId = $(this).attr('data-id');
//                getMiniProfile(userId,postId);
//                trackEngagementAction("ProfileMinPopup",userId);
//            }
//    );
      $(document).ready(function(){            
            $("#more").click(function(){             
                 $('#gameShortDescription').hide();
                 $('#gameDetailDescription').show();
                 $("#more").hide();
                 $("#moreup").show();
                
            });
            $("#moreup").click(function(){ 
                 $('#gameShortDescription').show();
                 $('#gameDetailDescription').hide();
                 $("#more").show();
                 $("#moreup").hide();
                
            });
        });
    
    </script>