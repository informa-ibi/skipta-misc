<?php 
$count = 0;
if(isset($this->tinyObject->UserId)){
    $UserId = $this->tinyObject->UserId;
}else{
    $UserId = 0;
}
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
                    <?php  }else  if($ext == "pdf" || $ext == "txt"){                   
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
                 <a class="follow_a"><i><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="<?php  echo in_array($UserId, $data->Followers)>0?'UnFollow':'Follow';?>" class="<?php  echo in_array($UserId, $data->Followers)>0?'follow':'unfollow';?>" id="detailedfolloworunfollow" data-postid="<?php  echo $data->_id ?>" data-catogeryId="<?php  echo $categoryType;?>"></i><b id="streamFollowUnFollowCount_<?php  echo $data->_id; ?>"><?php  echo count($data->Followers) ?></b></a> 
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

</div>

</div>
<script type="text/javascript">
$(function(){
    Custom.init();
    $("#detailedLove,#detailedfolloworunfollow,#invitefriendsDetailed,#detailedComment,#sharesec,#news_detailedComment").on("click",function(){
        showLoginPopup();
    });
});

</script>

 <?php } } ?>