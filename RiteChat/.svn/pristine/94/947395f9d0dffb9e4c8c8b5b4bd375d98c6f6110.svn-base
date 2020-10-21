<?php 
$count = 0;
if(isset($this->tinyObject->UserId))
    $UserId = $this->tinyObject->UserId;
else
    $UserId = 0;
 if(is_object($data)){
     if($data->IsAbused == 1 || $data->IsDeleted == 1 || $data->IsBlockedWordExist == 1){ ?>
        <div class="row-fluid">
            <div class="span12" style="text-align:center;font-family:'exo_2.0medium'">
                <h3>Sorry, This new item cannot be shown due to some security reasons.</h3>
            </div>
        </div>
   <?php }else{
?>


<div class="row-fluid " id="postDetailedTitle">
     <div class="span10 "><h2 class="pagetitle"><?php echo $data->TopicName?></h2>
    
     </div>
          <div class="span2 pull-right ">
          <div class="grouphomemenuhelp alignright tooltiplink"> <a  class="detailed_close_page" rel="tooltip"  data-original-title="close" data-placement="bottom" data-toggle="tooltip"> <i class="fa fa-times"></i></a> </div>
          </div>
</div>
<div class="woomarkLi" id="newsDetailedwidget">

<div class="customwidget_outer">
<div class="customwidget <?php echo $data->Alignment?> customwidgetdetail">
<div class="pagetitle"><a href="<?php echo $data->PublisherSourceUrl?>" target="_blank"><?php echo $data->Title?></a></div>
<div class="custimage"><?php echo $data->HtmlFragment?></div>
<div class="customcontentarea customwidgetdetailcontent">
<div class="cust_content" data-id="<?php echo $data->_id?>"><?php echo $data->Description?></div>

<?php if($data->Editorial!=''){?>
<div class="row-fluid">
<div class="span12">
<div  class="decorated span12 EDCRO<?php echo $data->_id?>"><?php echo $data->Editorial?></div>
</div>
</div>
<?php }?>
<div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>
<div class="customcontentarea">
<div class="custfrom "><a href="<?php echo $data->PublisherSourceUrl?>" target="_blank"><?php echo $data->PublisherSource?></a> - <a class="ntime" style="cursor:default;text-decoration:none"><?php echo CommonUtility::styleDateTime(strtotime($data->PublicationDate));?></a>
    <div class="nright" style="text-align:right">via <a style="cursor:default;text-decoration:none">Scoop.it!</a></div>
</div>
</div>
<?php  if(sizeof($data->Resource)>0){   ?>    
        <div class="postartifactsdiv padding5">
        
            <div class="chat_subheader ">Artifacts</div>
         
        <div class="row-fluid padding8top detailed_media">
                            <div class="span12">
                               <?php  
                    foreach($data->Resource as $res){
                         if(isset($res['Extension'])){
                        $ext = strtolower($res['Extension']);

                        if(isset($res['ThumbNailImage'])){
                               $image=$res['ThumbNailImage'];
                           }else{
                               $image="";
                           }
    
                    if($ext == "mp3"){?>
                            <div class="span3"> 

                                <div class="d_img_outer_video_play" >

                                <img style="cursor:pointer;" src="/images/system/audio_img.png" data-uri="<?php  echo $res['Uri'];?>" data-format="<?php  echo $ext;?>" id="videodivid"/>
                            </div>
                            </div>
                    
                     <?php  }else if($ext == "mp4" || $ext == 'flv' || $ext == 'mov'){
                          
                           if($categoryType!=3){
                             $videoclassName = 'PostdetailvideoThumnailDisplay';
                         }else{
                              $videoclassName = 'GroupPostdetailvideoThumnailDisplay';
                         }
                          
                          
                          ?>
                            <div class="span3"> 

                                <div class="d_img_outer_video_play" style="cursor:pointer;" ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div>

                                <img style="cursor:pointer;" src='<?php echo $image; ?>' data-uri="<?php  echo $res['Uri'];?>" data-format="<?php  echo $ext;?>" id="videodivid"/>
                            </div>
                            </div>
                        <?php  }else  if($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif"){?>
                            <div class="span3">
                                <div class="d_img_outer_video_play" >
                                <img style="cursor:pointer;" src="<?php  echo $res['Uri'];?>" data-uri="<?php echo str_replace('/upload/public/thumbnails/','/upload/public/images/',$res['Uri']);?>" id="imageimgdivid" data-format="<?php  echo $ext;?>" class="imageimgdivid"/>
                                </div>
                            </div>
                    <?php }else  if($ext == "pdf" || $ext == "txt" || $ext=='doc' || $ext=='xls' || $ext == "ppt" || $ext=='docx' || $ext=='xlsx'){                 
                    ?>
                            <div class="span3"> 
                                <div class="d_img_outer_video_play" >
                                     <img  id="artifactOpen" style="cursor:pointer;" src="<?php echo $image;?>" data-uri="<?php  echo $res['Uri'];?>" data-format="<?php  echo $ext;?>" id="pdfdivid"/>
        
                                </div>  
                            </div>
                    <?php }else{ ?> 
                            <div class="span3"> 
                                <div class="">
                                     <a href="/post/fileopen/?file=<?php  echo $res['Uri'];?>"  id="downloadAE"><img  id="artifactOpen" style="cursor:pointer;" src="<?php echo $image;?>" data-uri="<?php  echo $res['Uri'];?>" data-format="<?php  echo $ext;?>" id="pdfdivid"/> </a>    
        
        </div>
                            </div>
                            
                        <?php  }
                    
                    
                        } }?>
                    
                            </div>
                            </div>
        </div>
                 <?php  } ?>
 </div>
<div class="social_bar social_bar_detailed"  data-id="<?php  echo $data->_id ?>" data-postid="<?php  echo $data->_id ?>" data-categoryType="<?php  echo $categoryType;?>" data-networkId="<?php  echo $data->NetworkId; ?>">	
                 <a class="follow_a"><i><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo in_array($UserId, $data->Followers)>0?'UnFollow':'Follow';?>" class="<?php  echo in_array($UserId, $data->Followers)>0?'follow':'unfollow';?>" id="detailedfolloworunfollow" data-postid="<?php  echo $data->_id ?>" data-catogeryId="<?php  echo $categoryType;?>"></i><b id="streamFollowUnFollowCount_<?php  echo $data->_id; ?>"><?php  echo count($data->Followers) ?></b></a> 
                <a ><i><img  src="/images/system/spacer.png"   data-placement="bottom" rel="tooltip"  data-original-title="Invite" class="tooltiplink cursor invite_frds" id="invitefriendsDetailed" data-postid="<?php  echo $data->_id ?>"></i></a>
                
                <a style="display: none;"><i><img src="/images/system/spacer.png" class="tooltiplink share cursor" data-placement="bottom" rel="tooltip"  data-original-title="Share" ></i></a>
                <span class="cursor"><i><img  class=" <?php  $isLoved = in_array($UserId, $data->Love); if($isLoved){ echo"likes";  }else{ echo"unlikes";};?> " data-placement="bottom" rel="tooltip"  data-original-title="Love"  src="/images/system/spacer.png" id="detailedLove" data-postid="<?php  echo $data->_id ?>" data-catogeryId="<?php  echo $categoryType;?>"></i><b id="detailedLoveCount"><?php  echo count($data->Love); ?></b></span>
  <?php   if(!$data->DisableComments){
                
                if(count($data->Comments)>0){
                    foreach ($data->Comments as $key=>$value) {
                        if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist']==1)) {
                            $count++;
                        }
                    }
                }
      ?>
                <span><i><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Comment" class="detailedComment tooltiplink cursor  <?php   if($data->Type!=5){?><?php echo $IsCommented?'commented':'comments'?><?php  }else{?><?php echo $IsCommented?'commented':'comments1'?><?php  }?>"  id="news_detailedComment"  data-postid="<?php  echo $data->_id ?>"></i><b id="det_commentCount_<?php  echo $data->_id ?>"><?php  echo $count; ?></b></span>
                  <?php  }?>              </div>
<?php?>
 
</div>
<div class="commentbox <?php  if($data->Type==5){?>commentbox2<?php  }?> " id="cId_<?php   echo $data->_id; ?>" style="display:<?php  echo count($data->Comments)>0?'block':'none';?>">
              <div id="commentSpinLoader_<?php  echo $data->_id; ?>"></div>
            <div id="ArtifactSpinLoader_postupload_<?php  echo $data->_id?>"></div>
              <?php ?>
              <div id="newComment"  class="paddinglrtp5">
        <div id="commentTextArea_<?php  echo $data->_id; ?>" class="inputor commentplaceholder" contentEditable="true" onclick="OpenCommentbuttonArea('<?php echo $data->_id; ?>')"></div>
        <?php ?>
            <div id="commentTextAreaError_<?php  echo $data->_id; ?>" style="display: none;"></div>
            <div class="alert alert-error" id="commentTextArea_<?php  echo $data->_id; ?>_Artifacts_em_" style="display: none;"></div>
            <input type="hidden" id="artifacts" value=""/>
            <div id="preview_commentTextArea_<?php  echo $data->_id; ?>" class="preview" >
                     <ul id="previewul_commentTextArea_<?php  echo $data->_id; ?>" class="imgpreview">
                         
                    </ul>

   
                 </div>
                          <div  id="snippet_main_<?php echo $data->_id; ?>" class="snippetdiv" style="" ></div>        
<div class="postattachmentarea" id="commentartifactsarea_<?php  echo $data->_id; ?>" style="display:none">
        <div class="pull-left whitespace">
<div class="advance_enhancement">
<ul>
                <li class="dropdown pull-left ">
                  <div id="postupload_<?php  echo $data->_id; ?>">
                  </div>
                 
                    </li>
                   
                     
                    </ul>
                         
    <a href="#" ></a> <a href="#" ><i><img src="/images/system/spacer.png" class="actionmore" ></i></a></div>
     </div>
    <div class="pull-right">
       
        <button id="savePostCommentButton" onclick="saveDetailedPostCommentByUserId('<?php   echo $data->_id; ?>','<?php   echo $data->Type;?>','<?php  echo $categoryType;?>','<?php   echo $data->NetworkId;?>','<?php   echo $data->_id; ?>','postDetailed');" class="btn" data-loading-text="Loading...">Comment</button>
        <button id="cancelPostCommentButton" data-postid="<?php  echo $data->_id ?>"  class="btn btn_gray"> Cancel</button>

    </div></div>
           <div ><ul class="qq-upload-list" id="uploadlist_<?php echo $data->_id ?>"></ul></div>
            <div style="display:<?php   echo count($data->Comments)>0?'block':'none';?>" class="postattachmentareaWithComments"> <img src="/images/system/spacer.png" />
                </div>
</div>
  
              <div  id="CommentBoxScrollPaneTest" >
              <div id="commentbox_<?php   echo $data->_id; ?>" style="display:<?php   echo count($data->Comments)>0?'block':'none';?>">
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
                          
                          if($categoryType!=3){
                             $videoclassName = 'PostdetailvideoThumnailDisplay';
                         }else{
                              $videoclassName = 'GroupPostdetailvideoThumnailDisplay';
                         }
                          
                          ?>
                               <?php  if($i == 0){ $i++; $class="d_img_outer_video"; }else{$class="";}?>
                            <div class="span3"> 

                                <div class="d_img_outer_video_play" style="cursor:pointer;" ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div>

                                <img style="cursor:pointer;" src='<?php echo $image;?>' data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="videodivid"/>
                            </div>
                            </div>
                        <?php  }else  if($extType == "jpg" || $extType == "png" || $extType == "jpeg" || $extType == "gif"){?>
                            <div class="span3">    
                               <div class="d_img_outer_video_play" id="comment_artifactOpen">
                                    <?php if($categoryType=='3'){ ?>
                                    <img style="cursor:pointer;" src="<?php  echo $art['Uri']?>" data-uri="<?php  echo str_replace('/upload/public/thumbnails/','/upload/group/images/',$art['Uri']);?>" id="commentImageDiv" data-format="<?php  echo $extType;?>" class="imageimgdivid"/>
                                    <?php }else{?>
                                    
                                      <img style="cursor:pointer;" src="<?php  echo $art['Uri'];?>" data-uri="<?php  echo str_replace('/upload/public/thumbnails/','/upload/public/images/',$art['Uri']);?>" id="commentImageDiv" data-format="<?php  echo $extType;?>" class="imageimgdivid"/>
                                    
                                    <?php } ?>
                                
                                </div>
                            </div>
                        <?php }else  if($ext == "pdf" || $ext == "txt" || $ext=='doc' || $ext=='xls' || $ext == "ppt" || $ext=='docx' || $ext=='xlsx'){?>
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
                                <div class="m_title"><a <a class="userprofilename"  data-id="<?php echo $value->UserId; ?>" style="cursor:pointer"><?php echo $value->DisplayName; ?></a></div>
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
                                                
                                               <label class="websnipheading" ><?php echo $value->snippetdata['WebTitle']; ?></label>

                                                <a   class="websniplink" href="<?php echo $value->snippetdata['Weburl']; ?>" target="_blank">     <?php echo $value->snippetdata['WebLink']; ?> </a> 
                                               
                                                            
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
<script type="text/javascript">
$(function(){
      $('body, html').animate({scrollTop : 0}, 800,function(){
        //$("#registrationdropdown").addClass("open");
    });
    if($("#streamMainDiv").length > 0){
            $("#homestream").removeClass("active");
    }
    $("#news").removeClass("active").addClass("active");
    notificationAjax = true;
    var extensions='"jpg","jpeg","gif","mov","mp4","mp3","txt","doc","docx","pptx","pdf","ppt","xls","xlsx","avi","png","tiff","mov","flv"';
        initializeFileUploader("postupload_<?php   echo $data->_id?>", '/post/upload', '10*1024*1024', extensions,'4','commentTextArea','<?php   echo $data->_id?>',previewImage,appendErrorMessages,"uploadlist_<?php echo $data->_id ?>");
    $(".detailed_close_page").bind('click',function(){
        if(typeof io !== "undefined")
            updateSocketConnect();
        $("#news").removeClass("active");
        if($("#streamMainDiv").length > 0){
            $("#homestream").addClass("active");
        }
        if(fromHeaderNotifications == 2){
             $('#notificationHistory').show();
             $('#notificationHomediv').show();
        }else{   
            if($("#ProfileInteractionDivContent").length > 0){
                $("#streamDetailedDiv").hide();
                $("#ProfileInteractionDivContent").show();
            }
            if($("#admin_PostDetails").is(':visible')){
               $("#admin_PostDetails").hide();
               $("#contentDiv").show();                    
            }
            if($("#newdetaildiv").is(':visible')){
               $("#newdetaildiv").hide();
               $("#newscontentdiv").show();  
               applyLayoutContent();
            }
            if($("#curbsideStreamDetailedDiv").is(":visible")){
                $('#curbsideStreamDetailedDiv').hide();
                $("#curbsidePostCreationdiv").show();
           }
           if($("#streamDetailedDiv").is(":visible"))
           {
               $("#poststreamwidgetdiv").show();
               $("#streamDetailedDiv").hide();
           }
        }
           <?php  if(isset($_REQUEST['layout'])){ ?>
                window.location.href = "/";
              <?php } ?>
    });
    g_commentPage = 1;
        $("#postDetailedTitle").trigger('click');
         $('.commentbox').append('<style>.commentbox:before{left:126px}</style>');
         $('.commentbox').append('<style>.commentbox:after{left:126px}</style>');
        $("#notificationsdiv").hide();
        Custom.init();
        <?php if(count($data->Comments) == 0){ ?>
            $("#newComment,#commentDetailedBox").hide();
        <?php } ?>
        $("#detailedLove").unbind('click');
        $("#detailedLove").bind('click',function(){
            var postId = $(this).attr("data-postid");
            var categoryId = $(this).attr("data-catogeryId");
            var className = $("#detailedLove").attr('class');
            var pType = 0;
            if($.trim(className) == "unlikes"){
                $("#detailedLove").attr("style","");                
                $("#detailedLove").removeClass().addClass("likes");
                var loveCount = Number($("#detailedLoveCount").html());
                loveCount++;
                $("#detailedLoveCount").html(loveCount);
                if(categoryId == 1){
                    pType = 'Normal';
                }
                if(categoryId == 2){
                    pType = 'Curbside';
                }
                if(categoryId == 3){
                    pType = 'Group';
                }
                loveToPost(pType, postId, categoryId,postId);
//                loveToNewsPost(pType, postId, categoryId,postId);
            }
        });
     $("#news_detailedComment").unbind('click');
        $("#news_detailedComment").bind('click',function(){
            var postId = $(this).attr('data-postid');
            $('.commentbox').append('<style>.commentbox:before{left:126px}</style>');
            $('.commentbox').append('<style>.commentbox:after{left:126px}</style>');
            $("#commentTextArea").html("");
            $("#cId_"+postId).show();
            $("#newComment,#commentbox").show();
            $("#commentartifactsarea_" + postId).hide();
            $("#inviteBox").hide();
            initializationForHashtagsAtMentions('#commentTextArea_'+postId);
        });
    $("#cancelPostCommentButton").unbind('click');
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
            $("#commentTextArea_"+postId).html("");
             $("#commentTextArea_"+postId).addClass('commentplaceholder');
             $("#commentTextArea_"+postId).removeAttr("style");
             $("#commentartifactsarea_" + postId).css("min-height","");
        });
        
        $("#invitefriendsDetailed").unbind('click');
        $("#invitefriendsDetailed").bind('click',function(){
            var PostId = $(this).closest('div.social_bar_detailed').attr('data-postid');
            var StreamId = PostId;
            var NetworkId = $(this).closest('div.social_bar_detailed').attr('data-networkId');
            var CategoryType = $(this).closest('div.social_bar_detailed').attr('data-categoryType');
            var item = {
                'id': StreamId,
                'PostId': PostId,
                'NetworkId': NetworkId,
                'CategoryType': CategoryType
            };
            if($('#Invite_' + StreamId).length>0){
                $('#cId_' + StreamId).hide();
                $('#Invite_' + StreamId).show();
                $('#Invite_' + StreamId).find('style').remove();
                $('#Invite_' + StreamId).append('<style>#Invite_'+StreamId+'.commentbox:before{left:43px}</style>');
                $('#Invite_' + StreamId).append('<style>#Invite_'+StreamId+'.commentbox:after{left:43px}</style>');
            }
            $("#myModal_body").html($("#inviteTemplate_render").render(item));
            $("#myModalLabel").addClass("stream_title paddingt5lr10");
            $("#myModalLabel").html("Invite Others");
            $("#myModal_footer").hide();
            $("#myModal").modal('show');
            initializeAtMentions('#inviteTextBox_' + StreamId, PostId, Number(CategoryType));
            // this code is commented by  Haribabu for don't show the already invited members in invite other popup
           // getInvitedUsersForPost(PostId, CategoryType);
        });
        $("#newsDetailedwidget .userprofilename_detailed,#newsDetailedwidget .userprofilename").die("click");
        $("#newsDetailedwidget .userprofilename_detailed,#newsDetailedwidget .userprofilename").live("click",function(){
           var userId = $(this).attr('data-id'); 
           var postId = $(this).attr('data-postId');
           getMiniProfile(userId,postId);
        });
        $("#detailedfolloworunfollow").unbind("click");
        $("#detailedfolloworunfollow").bind("click",function(){
            var postId = $(this).attr("data-postid");
            var categoryId = $(this).attr("data-catogeryId");
            var actionType = "";
            var pType ="";
            var className = $("#detailedfolloworunfollow").attr('class');
            var followCnt = Number($(this).parent('i').parent('a').find('b').text());
                
            if($.trim(className) == "unfollow"){
                actionType = "Follow";
                followCnt = Number(followCnt)+1;
                $(this).parent('i').parent('a').find('b').text(followCnt);
                $("#detailedfolloworunfollow").removeClass().addClass("follow");
                $("#detailedfolloworunfollow").attr("data-original-title","Unfollow"); 
            }else if($.trim(className) == "follow"){
                followCnt = Number(followCnt)-1;
                $(this).parent('i').parent('a').find('b').text(followCnt);
                actionType = "UnFollow";
                $("#detailedfolloworunfollow").removeClass().addClass("unfollow");
                   $("#detailedfolloworunfollow").attr("data-original-title","Follow"); 
            }
            if(categoryId == 1){
                    pType = 'Normal';
            }
            if(categoryId == 2){
                pType = 'Curbside';
            }
            if(categoryId == 3){
                pType = 'Group';
            }
            followOrUnfollowPost(pType, postId,actionType, categoryId)
        });
        $("#newsDetailedwidget span.at_mention").die("click");
        $("#newsDetailedwidget span.at_mention").live( "click", 
           function(){
               var streamId = $(this).closest('div').attr('data-id');
               var userId = $(this).attr('data-user-id');
               getMiniProfile(userId,streamId);
           }
       );
   //for hashtags
      $("#newsDetailedwidget span.hashtag>b").die( "click");
       $("#newsDetailedwidget span.hashtag>b").live( "click", 
           function(){
               var postId = $(this).closest('div').attr('data-id');

               var hashTagName = $(this).text(); 
               getHashTagProfile(hashTagName,postId);
           }
       );
   
   //for CurbsidecateogryProfile
        $("#newsDetailedwidget a.curbsideCategory").unbind( "click");
     $("#newsDetailedwidget a.curbsideCategory").bind( "click", 
        function(){
            var categoryId = $(this).attr('data-id');
            var postId = $(this).attr('data-postId');
            getMiniCurbsideCategoryProfile(categoryId,postId);
        }
    );
    $("#eventAttendDetailed").unbind("click");
    $("#eventAttendDetailed").bind("click",function(){
        var postId = $(this).closest('div.post_widget').attr('data-postid');        
        var categoryType = $(this).attr('data-categoryType');
        var actionType = $(this).attr('name');
        var streamId;
        if(typeof streamId=='undefined' || streamId==""){
            streamId = postId;
        }
        attendEvent(postId,actionType,categoryType, streamId);
    });
    $("#artifactOpen").unbind("click");
      $("#artifactOpen").bind("click",function(){
       
            var postId = $(this).attr("data-uri");
            artifactDownload(postId);
        });
        if(!detectDevices()){
        $("[rel=tooltip]").tooltip();
    }
    $("#myModal_old").on("hidden",function(){
          if($('.jPlayer-container').length>0){
            $('.jPlayer-container').jPlayer("destroy");
        }
        $('#player').empty();
          $('#player').hide();
    });
   
});
</script>

 <?php } } ?>