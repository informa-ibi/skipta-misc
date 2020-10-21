<?php  if(is_object($data)){
    $data->Description = CommonUtility::findUrlInStringAndMakeLink($data->Description); 
    $text = "has been deleted";
    if($data->IsAbused == 1) $text = "has been marked as abused";    
    if($data->IsAbused == 1 || $data->IsDeleted == 1 || $data->IsBlockedWordExist == 1){ 
        ?>
        <div class="row-fluid">
            <div class="span10" style="text-align:center;font-family:'exo_2.0medium'">
                <h3>Sorry, This post <?php echo $text; ?>.
              
          <div class="grouphomemenuhelp alignright tooltiplink"> <a onclick="window.location.reload(true);" data-postType="<?php  echo $data->Type;?>" data-categoryId="<?php  echo $categoryType; ?>" class="detailed_close_page" rel="tooltip"  data-original-title="close" data-placement="bottom" data-toggle="tooltip"> <i class="fa fa-times"></i></a> </div>
           </h3>
          </div>
           
        </div>

   <?php }else{
    $count = 0;
    $createdOn = $data->CreatedOn; 
    $PostOn=$createdOn;
//      if(is_int($createdOn))
//                {              
//                    $PostOn = CommonUtility::styleDateTime($createdOn);
//                }
//                else if(is_numeric($createdOn))
//                {  
//                    $PostOn = CommonUtility::styleDateTime($createdOn);
//                }
//                else
//                {    
//                $PostOn= CommonUtility::styleDateTime($createdOn->sec);
//                }
//    
    
    
   // $PostOn = CommonUtility::styleDateTime($createdOn->sec);
    $UserId = isset($UserId)?$UserId:$this->tinyObject->UserId;
    $PostTypeString = CommonUtility::postTypebyIndex($data->Type);     
    $actionText = CommonUtility::actionTextbyActionType($data->Type);
    if($categoryType == 3){
        $PostTypeString = "Group $PostTypeString";
    }
     if($categoryType == 10){
        $actionText = "unlocked";
    }
    $ShareCount = 0;
    $FbShareCount = isset($data->FbShare) && is_array($data->FbShare)?sizeof($data->FbShare):0;
    $TwitterShareCount = isset($data->TwitterShare) && is_array($data->TwitterShare)?sizeof($data->TwitterShare):0;
    $ShareCount = $FbShareCount+$TwitterShareCount;
?>
    


<div class="row-fluid " id="postDetailedTitle">
     <div class="span6 "><h2 class="pagetitle"><?php if($data->Type==5){ echo $data->Subject;} else{  echo Yii::t('translation','Normal_Post_Detail');}?></h2>
    
     </div>
          <div class="span6 ">
          <div class="grouphomemenuhelp alignright tooltiplink"> <a data-postType="<?php  echo $data->Type;?>" data-categoryId="<?php  echo $categoryType; ?>" class="detailed_close_page" rel="tooltip"  data-original-title="close" data-placement="bottom" data-toggle="tooltip"> <i class="fa fa-times"></i></a> </div>
          </div>
     </div>
    
    <div class="stream_widget marginT10" id="postDetailedwidget">
   	 <div class="profile_icon"><img src="<?php if($isGroupPostAdmin == 'true') {
                           echo $mainGroupCollection->GroupProfileImage; 
                        }else{
                          if($data->Type != 4) {  echo $tinyObject->profile250x250;} else{ echo "/images/icons/user_noimage.png";} } ?>" ></div>
    	<div class="post_widget" data-postid="<?php  echo $data->_id ?>" data-postType="<?php  echo $data->Type;?>">
        <div class="stream_msg_box">
            
            
            
            
            <div class="stream_title paddingt5lr10" style="position: relative">                
                <?php if($IsCustomBadge==0 ||($IsCustomBadge==1  && $pageType!='stream') ){?>   
                <a class="<?php if($isGroupPostAdmin == 'true') { echo 'grpIntro'; } else if($categoryType==10 && $data->Store!=0 && $pageType=='stream'){ echo '';} else { echo 'userprofilename_detailed';}; ?> " data-postId="<?php echo $data->_id;?>" data-id="<?php if($isGroupPostAdmin == 'true') { echo $mainGroupCollection->_id; } else { echo $data->UserId; } ?>" style="cursor:pointer"> 
                <?php }?><b>
                        <?php if($isGroupPostAdmin == 'true') {
                           echo $mainGroupCollection->GroupName; 
                        }else{
                            if($data->Type != 4){
                                if($categoryType==10 && $data->Store!=0 && $pageType=='stream'){
                                   echo $displayName1='#'.$data->Store;
                                }else{
                                   echo $displayName1=$data->UserId==$this->tinyObject['UserId']?'You':$tinyObject->DisplayName;      
                                }
                               
                            }
                            // if($data->Type != 4) echo $tinyObject->DisplayName;
                        } ?>
                    </b>
                  <?php if($IsCustomBadge==0 ||($IsCustomBadge==1  && $pageType!='stream') ){?>   
                </a>  
                    <?php }?>
                    <?php if($data->Type != 4 &&  $categoryType!=10 ){ echo "<span>  $actionText</span> $PostTypeString ";}else if($categoryType == 10){echo "<span>$actionText </span> ";  echo "- ".$badgeInfo->badgeName ;if($IsCustomBadge==0){ echo " badge";}"  badge";}else{ echo "A new post has been created"; }?>
                <span class='userprofilename'> <?php if($data->Type==2 || $data->Type==3){ if(isset($data->Title) && $data->Title!=""){ echo "- ".$data->Title; };} ?>
                </span> <i><?php  echo $PostOn; ?> </i>
            </div>
             <div class=" stream_content">
                
            <ul>
            <li class="media">
            <?php  if($data->Type!=3){  ?>
                <?php  if($data->Type==2 && isset($data->StartDate) && $data->EndDate){ 

                $timezone =  Yii::app()->session['timezone'];
              
                     $eventStartDate = CommonUtility::convert_time_zone($data->StartDate->sec,$timezone,'','sec');
                    $eventEndDate = CommonUtility::convert_time_zone($data->EndDate->sec,$timezone,'','sec');
                   
                    //$eventStartDate=$data->StartDate;
                   // $eventEndDate=$data->EndDate;
                    $data->StartDate = date("Y-m-d", $eventStartDate);
                    $data->EndDate = date("Y-m-d", $eventEndDate);
                    $EventStartDay = date("d", $eventStartDate);
                    $EventStartDayString = date("l", $eventStartDate);
                    $EventStartMonth = date("M", $eventEndDate);
                    $EventStartYear = date("Y", $eventEndDate);
                    $EventEndDay = date("d", $eventEndDate);
                    $EventEndDayString = date("l", $eventEndDate);
                    $EventEndMonth = date("M", $eventEndDate);
                    $EventEndYear = date("Y", $eventEndDate);

                    $IsEventAttend = in_array($UserId,$data->EventAttendes);
                    
                    ?>
                 <!-- spinner -->
                      <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>    
                      <span id="detailed_followUnfollowSpinLoader_<?php echo $data->_id; ?>"></span>
                 <!-- end spinner -->
                <div class="media-body postDetail bulletsShow" id="postDetailPage">

                <p><?php  
                              echo ($data->Description);
                             ?></p>
                <div class="timeshow"> 
                            
                    <ul class="bulletnotShow">
                                <li class="clearboth">
                            <ul class="<?php  echo $data->StartDate==$data->EndDate?'bulletnotShow':"doubleul bulletnotShow" ?>">
                                <li class="doubledate">
                                    <time class="icon" datetime="<?php   echo $data->StartDate; ?>">
                                        <strong><?php   echo $EventStartMonth; ?><?php   echo $data->StartDate!=$data->EndDate?"<br/>":"-"; ?><?php   echo $EventStartYear;?></strong>
                                        <span><?php   echo $EventStartDay;?></span>
                                        <em><?php   echo $EventStartDayString;//day name?></em>
                                        
                                    </time>
                                    
                                </li>
                                
                                <?php   if($data->StartDate!=$data->EndDate){ ?>
                                <li style="width:80px;float:left"><time class="icon" datetime="<?php   echo $data->EndDate; ?>">
                                        <strong><?php   echo $EventEndMonth;?><br/><?php   echo $EventEndYear;?></strong>
                                        <span><?php   echo $EventEndDay;?></span>
                                        <em><?php   echo $EventEndDayString;?></em>
                                    </time>
                                   
                                </li>
                                <?php   } ?>
                            </ul>
                                      </li>
                                       <?php if(trim($data->StartTime)!="" && trim($data->EndTime)!="" ){ ?>
                                      <li class="clearboth e_datelist"><div class="e_date"><?php   echo $data->StartTime ?> - <?php   echo $data->EndTime ?></div></li>
                                       <?php } ?>
                                  </ul>
                            <div class="et_location clearboth"><span><i class="fa fa-map-marker"></i><?php   echo $data->Location ?></span> </div>

                            
                        </div>
                            <div class="alignright paddingtb clearboth">
                                <?php   if(!$IsEventAttend){ ?>
                                    <button class="eventAttend_detailed btn btn-small editable_buttons" id="eventAttendDetailed" name="Attend" data-postid="<?php   echo $data->_id ?>" data-postType="<?php   echo $data->Type;?>" data-categoryType="<?php   echo $categoryType;?>"><i class="fa fa-check-square-o  "></i> Attend</button> 
                                <?php   } ?>
                            </div>
                </div>
                
                <?php  }else{ ?>

                     <!-- spinner -->
                      <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>   
                      <span id="detailed_followUnfollowSpinLoader_<?php echo $data->_id; ?>"></span>
                 <!-- end spinner -->
                    <div class="media-body postDetail bulletsShow" id="postDetailPage" data-id="<?php echo $data->_id; ?>">
                        <?php if($categoryType==10) { ?>
                        <div class="pull-left multiple "> 
                                  
                            <a  class="pull-left pull-left1 img_more postdetail"   ><img src="<?php  echo $badgeInfo->image_path ?>"></a>
                                </div>       
                        <p> <?php echo $badgeInfo->description; ?></p>
                        <?php } else{ ?>
                            
                            <p>  <?php
                            if(isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist=='1'){
                                $data->Description = CommonUtility::findUrlInStringAndMakeLink($data->Description); 
                            }
                            echo $data->Description; 
                         
                            ?></p>
                     
                                
                                
                        <?php } if($data->Type!=4){?>
                            <!-- Nested media object -->
                            <?php if($data->Store==0 && $pageType=='profile'){?>
                                <div class="media">
                                    <a href="#" class="pull-left marginzero smallprofileicon">
                                        <img src="<?php if($isGroupPostAdmin == 'true') {
                           echo $mainGroupCollection->GroupProfileImage; 
                        }else{
                            echo $tinyObject->profile70x70; } ?>">
                                    </a>

                                    <div class="media-body">                                   
                                        <span class="m_day"><?php  echo $PostOn; ?></span>
                                        <div class="m_title">
                                            <a class="<?php if($isGroupPostAdmin == 'true') { echo 'grpIntro'; } else { echo userprofilename_detailed; } ?>" data-postId="<?php echo $data->_id;?>" data-id="<?php if($isGroupPostAdmin == 'true') { echo $mainGroupCollection->_id; } else { echo $data->UserId; } ?>"  style="cursor:pointer">
                                                <?php if($isGroupPostAdmin == 'true') { echo $mainGroupCollection->GroupName; } else { echo $tinyObject->DisplayName;} ?>
                                            </a>
                                                <?php  if ($data->Type==5){ $CurbsideConsultCategory =""; ?> 
                                            <div id="curbside_spinner_<?php echo $data->_id; ?>">
                                                </div>
                                            <span class="pull-right" >
                                                <a style='cursor:pointer'data-postId="<?php echo $data->_id; ?>" data-id='<?php  echo $data->CategoryId;?>' class='curbsideCategory'>
                                                    <b><?php  echo isset($curbsideCategory->CategoryName)?$curbsideCategory->CategoryName:''?>
                                                    </b>
                                                </a>
                                            </span><?php  }?>
                                        </div>

                                    </div>
                                    <?php if($categoryType==3 && $mainGroupCollection->IsIFrameMode==1){ ?>
                                   <div class="media-body"> 
                                    <div class="m_title">
                                        <span class="pull-right" data-id="<?php echo $data->_id; ?>">
                                            <a class="grpIntro grpIntro_b" data-postId="<?php echo $data->_id;?>" data-id="<?php echo $mainGroupCollection->_id; ?>" style="cursor:pointer"><b><?php echo $mainGroupCollection->GroupName; ?></b></a>
                                        </span>
                                    </div>
                                </div> 
                                   <?php } ?>
                                </div>
                       <?php }?>
                                 </div><?php }?>
                            
                            
                               <?php  }?>
                 
                 <?php if(isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist=='1'){   ?>            
                             <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;">
                                 <div class="Snippet_div" style="position: relative">
                            <?php if(isset($data->WebUrls) && isset($data->WebUrls->WebLink)){ ?>
                                     
                                <a href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">
                                            <?php if($data->WebUrls->WebImage!=""){ ?>
                                    <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $data->WebUrls->WebImage; ?>"></span>
                                            <?php } ?></a>
                                            <div class="media-body">                                   
                                                    

                                                       <label class="websnipheading" ><?php echo $data->WebUrls->WebTitle ?></label>
                                                      <a   class="websniplink" href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">     <?php echo $data->WebUrls->WebLink ?> </a> 
                                               
                                                        <p><?php echo $data->WebUrls->Webdescription ?></p>
                                                    
                                                </div>

                                     
                                      <?php } ?>   
                                    </div>
                           </div>
                          
                               <?php } ?>    
                 
                 
            <?php  }else{?>
                <?php  
                
                $IsSurveyTaken = 0; 
                if(isset($data->SurveyTaken)){
                    foreach($data->SurveyTaken as $surveyTaken){
                        if($surveyTaken['UserId']==$UserId){
                            $IsSurveyTaken = 1;
                        }
                    }
                }                
                    
                    $TotalSurveyCount = $data->OptionOneCount+$data->OptionTwoCount+$data->OptionThreeCount+$data->OptionFourCount;
                   
                ?>
                  <!-- spinner -->
                      <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>  
                      <span id="detailed_followUnfollowSpinLoader_<?php echo $data->_id; ?>"></span>
                 <!-- end spinner -->
                <div class="alert alert-error" id="<?php   echo "surveyError_".$data->_id ?>" style='padding-top: 5px;display: none'> Please select an option </div>
                            <div class="alert alert-success" id="<?php   echo "surveyConfirmation_".$data->_id ?>" style='padding-top: 5px;display: none'><?php   echo Yii::t('translation', 'Survey_Completed'); ?></div>
                            <div id="<?php   echo "surveyArea_".$data->_id ?>">
                                <?php   
                                if(!$IsSurveyTaken){ ?>
                                                     
                            <div class="media-body postDetail bulletsShow">
                                <div class="surveyquestion" ><?php  echo ($data->Description); ?></div>
                                <div class="row-fluid ">
                                    <div class="span12 customradioanswers">
                                        <div class="customradioanswersdiv">
                                            <div class="c_prefix">A)</div>
                                            <div class="c_suffix">
                                                <input type="radio" class="styled" name="<?php   echo "survey_".$data->_id ?>" value="OptionOne"> <?php   echo $data->OptionOne ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid ">
                                    <div class="span12 customradioanswers">
                                        <div class="customradioanswersdiv">
                                            <div class="c_prefix">B)</div>
                                            <div class="c_suffix">
                                                <input type="radio" class="styled" name="<?php   echo "survey_".$data->_id ?>" value="OptionTwo">   <?php   echo $data->OptionTwo ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid ">
                                    <div class="span12 customradioanswers">
                                        <div class="customradioanswersdiv">
                                            <div class="c_prefix">C)</div>
                                            <div class="c_suffix">
                                                <input type="radio" class="styled" name="<?php   echo "survey_".$data->_id ?>" value="OptionThree">   <?php   echo $data->OptionThree ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row-fluid " style="display: <?php echo (isset($data->OptionFour) && !empty($data->OptionFour))?'block':'none' ?>">
                                    <div class="span12 customradioanswers">
                                        <div class="customradioanswersdiv">
                                            <div class="c_prefix">D)</div>
                                            <div class="c_suffix">
                                                <input type="radio" class="styled" name="<?php   echo "survey_".$data->_id ?>" value="OptionFour">   <?php   echo $data->OptionFour ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php $isOptionDExist = -1;
                                if(isset($data->OptionFour) && !empty($data->OptionFour)){ 
                                        $isOptionDExist = 0;
                                 } ?>
                                <div class="alignright paddingtb">
                                    <input class="btn " name="commit" type="button" value="Submit" onclick="submitSurvey('<?php   echo $data->_id ?>','<?php   echo $data->NetworkId;?>','<?php   echo $categoryType;?>',<?php   echo $data->OptionOneCount;?>,<?php   echo $data->OptionTwoCount;?>,<?php   echo $data->OptionThreeCount ?>,<?php   echo $data->OptionFourCount;?>,'<?php echo $data->_id; ?>',<?php echo $isOptionDExist; ?>)" />
                                </div>
                                
                            </div>
                                 
                                    
                            <?php   } ?>
                                </div>
                                <div class="media-body postDetail bulletsShow" id="<?php   echo "surveyTakenArea_".$data->_id ?>" style="display:<?php   echo $IsSurveyTaken?'block':'none' ?>">
                                    <div class="surveyquestion" ><?php   echo ($data->Description); ?></div>
                                    <div class="media-body custommedia-body">
                                         <div class="row-fluid " >
                                             <div class="span12">
                                                 <div class="span7" id="<?php   echo "surveyGraphArea_".$data->_id ?>" ></div>
                                                 <div class="span5 surveyresults" >
                                                     <div class="row-fluid ">
                                                        <div class="span12">
                                                            <?php   echo "A) ".$data->OptionOne ?>
                                                        </div>
                                                        </div>
                                                        <div class="row-fluid ">
                                                            <div class="span12">
                                                                <?php   echo "B) ".$data->OptionTwo ?>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid ">
                                                            <div class="span12">
                                                                <?php   echo "C) ".$data->OptionThree ?>
                                                            </div>
                                                        </div>
                                                     <?php if(isset($data->OptionFour) && !empty($data->OptionFour)){ ?>
                                                        <div class="row-fluid ">
                                                            <div class="span12">
                                                                <?php   echo "D) ".$data->OptionFour ?>
                                                            </div>
                                                        </div>
                                                     <?php } ?>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                    
                            <?php    
                                if($IsSurveyTaken){
                                    $totalSurveyCount = $data->OptionOneCount+$data->OptionTwoCount+$data->OptionThreeCount+$data->OptionFourCount;
                                    if($totalSurveyCount>0){
                                    ?>
                                <script type="text/javascript">
                                  $(function(){      
                                      var isOptionDExist = -1;
                                      <?php if(isset($data->OptionFour) && !empty($data->OptionFour)){ ?>
                                              isOptionDExist = 0;
                                      <?php } ?>
                                      drawSurveyChart('<?php   echo "surveyGraphArea_$data->_id"; ?>', <?php   echo $data->OptionOneCount ?>, <?php   echo $data->OptionTwoCount ?>,<?php   echo $data->OptionThreeCount ?>,<?php   echo $data->OptionFourCount ?>,250,300, isOptionDExist);
                                  });
                                </script>
                            <?php   } } ?>
                                
                            </div>
                             <?php if(isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist=='1'){   ?>            
                             <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;">
                                 <div class="Snippet_div" style="position: relative">
                                     <?php if(isset($data->WebUrls) && isset($data->WebUrls->WebLink)){ ?>
                                      <a href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">
                                            <?php if($data->WebUrls->WebImage!=""){ ?>
                                    <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $data->WebUrls->WebImage; ?>"></span>
                                            <?php } ?></a>
                                            <div class="media-body">                                   
                                                    

                                                     <label class="websnipheading" ><?php echo $data->WebUrls->WebTitle ?></label>
                                                      <a   class="websniplink" href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">     <?php echo $data->WebUrls->WebLink ?> </a> 
                                               
                                                        <p><?php echo $data->WebUrls->Webdescription ?></p>
                                                    
                                                </div>

                                        </a>
                                     <?php } ?>
                                    </div>
                           </div>
                          
                               <?php } ?>
                                    
                <?php  }?>
              
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

                                <img style="cursor:pointer;" src="/images/system/audio_img.png" data-uri="<?php  echo $res['Uri'];?>" data-format="<?php  echo $ext;?>" id="videodivid" />
                            </div>
                            </div>
                    
                      <?php  }else if($ext == "mp4" || $ext == 'flv' || $ext == 'mov'){
                         if($categoryType!=3){
                             $videoclassName = 'PostdetailvideoThumnailDisplay artifactdetailPV';
                         }else{
                              $videoclassName = 'GroupPostdetailvideoThumnailDisplay artifactdetailGPV';
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
                    <?php  }else  if($ext == "pdf" || $ext == "txt" || $ext=='doc' || $ext=='xls' || $ext == "ppt" || $ext=='docx' || $ext=='xlsx'){                   
                    ?>
                            <div class="span3"> 
                                <div class="d_img_outer_video_play" >
                                     <img  style="cursor:pointer;" src="<?php echo $image;?>" data-uri="<?php  echo $res['Uri'];?>" data-format="<?php  echo $ext;?>" id="pdfdivid"/>
        
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
                             <div id="UPFS"></div>
              <?php   if(!isset($mainGroupCollection->AddSocialActions) || $mainGroupCollection->AddSocialActions==1) {?>                  
              <div class="social_bar social_bar_detailed" data-id="<?php  echo $data->_id ?>" data-postid="<?php  echo $data->_id ?>" data-categoryType="<?php  echo $categoryType;?>" data-networkId="<?php  echo $data->NetworkId; ?>">	
                <a class="follow_a"><i><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="<?php  echo in_array($UserId, $data->Followers)>0?'UnFollow':'Follow';?>" class="<?php  echo in_array($UserId, $data->Followers)>0?'follow':'unfollow';?>" id="detailedfolloworunfollow" data-postid="<?php  echo $data->_id ?>" data-catogeryId="<?php  echo $categoryType;?>"></i><b id="streamFollowUnFollowCount_<?php  echo $data->_id; ?>"><?php  echo count($data->Followers) ?></b></a>
                 <?php if($categoryType!=10){?> 
                <a ><i><img  src="/images/system/spacer.png"   data-placement="bottom" rel="tooltip"  data-original-title="Invite" class="tooltiplink cursor invite_frds" id="invitefriendsDetailed" data-postid="<?php  echo $data->_id ?>"></i></a>
                 <?php }?>
                <span class="cursor"><i><img  class=" <?php  $isLoved = in_array($UserId, $data->Love); if($isLoved){ echo"likes";  }else{ echo"unlikes";};?> " data-placement="bottom" rel="tooltip"  data-original-title="Love"  src="/images/system/spacer.png" id="detailedLove" data-postid="<?php  echo $data->_id ?>" data-catogeryId="<?php  echo $categoryType;?>"></i><b id="detailedLoveCount"><?php  echo count($data->Love); ?></b></span>
                <?php if($categoryType<3 && YII::app()->params['Share']=='ON'){
                    $IsFbShare = isset($data->FbShare) && is_array($data->FbShare)?in_array($UserId, $data->FbShare):0;
                    $IsTwitterShare = isset($data->TwitterShare) && is_array($data->TwitterShare)?in_array($UserId, $data->TwitterShare):0;

                    if(!$IsTwitterShare || !$IsFbShare){
                        $shareClass = ($IsTwitterShare || $IsFbShare)>0?'sharedisable':'share';
                        ?>
                <span  class="sharesection"><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="Share" data-placement="bottom"><img src="/images/system/spacer.png"  class="<?php echo $shareClass; ?>"  ></i><b id="streamShareCount_<?php  echo $data->_id; ?>"><?php  echo $ShareCount;?></b>
                    <div class="dropdown-menu actionmorediv">
                         <ul id="share_<?php echo $data->_id; ?>">
                             <?php if(!$IsFbShare){ ?>
                             <li class="shareFacebook"><a onclick="prepareWallPostData('<?php  echo $data->_id ?>','<?php  echo $categoryType;?>','<?php  echo $data->Type;?>','<?php  echo $data->_id;?>','postDetail')"><i class="fa fa-facebook"></i> Facebook</a></li>
                             <?php }if(!$IsTwitterShare){ ?>
                             <li class="shareTwitter"><a onclick="getTweetLink('<?php  echo $data->_id ?>','<?php  echo $categoryType;?>','<?php  echo $data->Type;?>','<?php  echo $data->_id;?>','postDetail')"><i class="fa fa-twitter"></i> Twitter</a></li>
                             <?php } ?>
                        </ul>
                    </div>
                 </span>
                <?php }else{?>
                    <span class="sharesection"><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="Share" data-placement="bottom"><img src="/images/system/spacer.png"  class="sharedisable"  ></i><b id="streamShareCount_<?php  echo $data->_id; ?>"><?php  echo $ShareCount;?></b></span>
                <?php }} ?>
                    
  <?php   $count=0 ;if(!$data->DisableComments){
                
                if(count($data->Comments)>0){
                    foreach ($data->Comments as $key=>$value) {
                        if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist']==1)) {
                            $count++;
                        }
                    }
                }
      ?>
                <span><i><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Comment" class="detailedComment tooltiplink cursor  <?php   if($data->Type!=5){?><?php echo $IsCommented?'commented':'comments'?><?php  }else{?><?php echo $IsCommented?'commented':'comments1'?><?php  }?>"  id="detailedComment"  data-postid="<?php  echo $data->_id ?>"></i><b id="det_commentCount_<?php  echo $data->_id ?>"><?php  echo $count; ?></b></span>
                  <?php  }?>              </div> <?php  }?> 
              </li>
              </ul>
            
          </div>
          
        </div> 
             <?php error_log($recentActivity."*********8");if($recentActivity=="invite"){ ?>
        <div style="" id="Invite_<?php  echo $data->_id; ?>" class="invitebox">
            <div class="padding10"><?php echo $inviteMessage ?></div>
            <style>#Invite_<?php  echo $data->_id; ?>.commentbox:before{left:48px}</style><style>#Invite_<?php  echo $data->_id; ?>.commentbox:after{left:48px}</style>
        </div>
        <?php } ?>
         <?php   if(!isset($mainGroupCollection->AddSocialActions) || $mainGroupCollection->AddSocialActions==1) {?>
            <?php  if(!$data->DisableComments){?>
          <div style="display:<?php echo $recentActivity=="invite"?'none':'block' ?>" class="commentbox <?php  if($data->Type==5){?>commentbox2<?php  }?> " id="cId_<?php   echo $data->_id; ?>" >
            <?php }?>
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

                              <button id="savePostCommentButton" onclick="saveDetailedPostCommentByUserId('<?php echo $data->_id; ?>','<?php echo $data->Type; ?>','<?php echo $categoryType; ?>','<?php echo $data->NetworkId; ?>','<?php echo $data->_id; ?>','postDetailed');" class="btn" data-loading-text="Loading...">Comment</button>
                              <button id="cancelPostCommentButton" data-postid="<?php echo $data->_id ?>"  class="btn btn_gray"> Cancel</button>

                          </div></div>
                       <div ><ul class="qq-upload-list" id="uploadlist_<?php echo $data->_id ?>"></ul></div>
                      <div style="display:<?php echo count($data->Comments) > 0 ? 'block' : 'none'; ?>" class="postattachmentareaWithComments"> <img src="/images/system/spacer.png" />
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
                             $videoclassName = 'PostdetailvideoThumnailDisplay PD artifactdetailCV';
                         }else{
                              $videoclassName = 'GroupPostdetailvideoThumnailDisplay PD artifactdetailCV';
                         }
                          
                          
                          ?>
                               <?php if($i == 0){ $i++; $class="d_img_outer_video"; }else{$class="";}?>
                            <div class="span3"> 

                                <div class="d_img_outer_video_play" style="cursor:pointer;" ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div>

                                <img style="cursor:pointer;" src='<?php echo $image;?>' data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="videodivid"/>
                            </div>
                            </div>
                        <?php  }else  if($extType == "jpg" || $extType == "png" || $extType == "jpeg" || $extType == "gif"){?>
                            <div class="span3">    
                               <div class="d_img_outer_video_play" id="comment_artifactOpen">
                                    <?php if($categoryType=='3' || $categoryType=='7'){ ?>
                                    <img style="cursor:pointer;" src="<?php  echo str_replace('/upload/public/thumbnails/','/upload/group/images/',$art['Uri']);?>" data-uri="<?php  echo str_replace('/upload/public/thumbnails/','/upload/group/images/',$art['Uri']);?>" id="commentImageDiv" data-format="<?php  echo $extType;?>" class="imageimgdivid"/>
                                    <?php }else{?>
                                    
                                      <img style="cursor:pointer;" src="<?php  echo str_replace('/upload/public/thumbnails/','/upload/public/images/',$art['Uri']);?>" data-uri="<?php  echo str_replace('/upload/public/thumbnails/','/upload/public/images/',$art['Uri']);?>" id="commentImageDiv" data-format="<?php  echo $extType;?>" class="imageimgdivid"/>
                                    
                                    <?php } ?>
                                
                                </div>
                            </div>
                        <?php  }else if($extType == "pdf" || $extType == "txt" || $extType=='doc' || $extType=='xls' || $extType == "ppt" || $extType=='docx' || $extType=='xlsx'){ ?>
                                <div class="span3"> 
                                <div class="d_img_outer_video_play" >
                                     <img  style="cursor:pointer;" src="<?php echo $image;?>" data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="pdfdivid"/>
                                </div>  
                            </div>
                        <?php  }else{ ?>
                            
                            <div class="span3">     
                                <div class="">
                               <a href="/post/fileopen/?file=<?php  echo $art['Uri'];?>"  id="downloadAE"><img   style="cursor:pointer;" src="<?php echo $image;?>" data-uri="<?php  echo $art['Uri'];?>" data-format="<?php  echo $extType;?>" id="pdfdivid"/> </a>          
                               
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
                        <div id="comment_text" data-id="<?php  echo $data->_id; ?>">
                            <?php 
                            if(isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist=='1'){
                                $value->CommentText = CommonUtility::findUrlInStringAndMakeLink($value->CommentText); 
                            }
                            echo $value->CommentText; ?>
                        </div>

                        <div class="media">
                            <a href="#" class="pull-left marginzero smallprofileicon">
                                <img   src="<?php echo $value->ProfilePic; ?> ">                  </a>
                            <div class="media-body">
                                <span class="m_day"><?php echo $value->PostOn; ?></span>
                                <div class="m_title"><a <a class="userprofilename"  data-id="<?php echo $value->UserId; ?>" style="cursor:pointer"><?php echo $value->DisplayName; ?></a></div>
                            </div>
                        </div>
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
                                            <?php } ?>  </a>   
                                            <div class="media-body">  
                                                <label class="websnipheading" ><?php echo $value->snippetdata['WebTitle']; ?></label>
                                                      <a   class="websniplink" href="<?php echo $value->snippetdata['Weburl']; ?>" target="_blank">     <?php echo $value->snippetdata['WebLink']; ?> </a> 
                                               
                                                            <p><?php echo $value->snippetdata['Webdescription']; ?></p>
                                                    
                                                </div>
                                         
                            <?php } ?>
                                   
                                    </div>
                           </div>
                      
              <?php } ?>
                   
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
                  
          </div> <?php  }?>
        </div>
    
    </div>
<script type="text/javascript">
   if(!detectDevices())
            $("[rel=tooltip]").tooltip();
    $(function(){
        isDuringAjax = true;
        notificationAjax = true;
        var extensions='"jpg","jpeg","gif","mov","mp4","mp3","txt","doc","docx","pptx","pdf","ppt","xls","xlsx","avi","png","tiff","mov","flv"';
    <?php   if(!isset($mainGroupCollection->AddSocialActions) || $mainGroupCollection->AddSocialActions==1) {?>   
    if(isMobile|| UploadMedia==1)
    initializeFileUploader("postupload_<?php   echo $data->_id?>", '/post/upload', '10*1024*1024', extensions,'4','commentTextArea','<?php   echo $data->_id?>',previewImage,appendErrorMessages,"uploadlist_<?php echo $data->_id ?>");    
    <?php   } ?>

    });
    var storeId="<?php echo  $data->Store?>";
    var cType="<?php echo $categoryType?>";
    var pageType="<?php echo $pageType?>";
    if(storeId!=0 && cType==10 && pageType=='stream'){
        $('#UPFS').html("").show();
     //   isDuringAjax=false;
   // $(window).unbind("scroll");
        s_page=0;
        
        //page=0;
            getCollectionData('/user/getStoreUsers', 's_page='+s_page+'&storeId='+storeId+'&UserCollection', 'UPFS', 'No data found','No More Store Members');
    }
    
    <?php if ($this->whichmenuactive == 1) {?>
                    $("#homestream").removeClass("active");
            <?php }else if ($this->whichmenuactive == 2) { ?>
                $("#curbsidepost").removeClass("active");
            <?php }else if ($this->whichmenuactive == 3) { ?>
                 $("#groupmainmenu").removeClass("active");
            <?php } ?>
    $("#"+setActiveClassPage).removeClass("active").addClass("active");
 </script>
 <script type="text/javascript">
     gPage = "PostDetail";
     $('body, html').animate({scrollTop : 0}, 800,function(){});
      <?php   if(!isset($mainGroupCollection->AddSocialActions) || $mainGroupCollection->AddSocialActions==1) {?>
       setCommentArrowPoition();<?php } ?>
         <?php  if($data->DisableComments){?>
             $('#newComment').hide();
         <?php }?>
     function setCommentArrowPoition(){
         <?php  if(!$data->DisableComments){?>
        var commentLeft = $('#detailedComment').position().left;
        
        if(commentLeft == 0)
            commentLeft = 167;
         $('#postDetailedwidget .commentbox').append('<style>#postDetailedwidget .commentbox:before{left:'+commentLeft+'px}</style>');
         $('#postDetailedwidget .commentbox').append('<style>#postDetailedwidget .commentbox:after{left:'+commentLeft+'px}</style>');
          <?php }?>
     }
    $(function(){ // by default commentbox setted  
        
        g_commentPage = 1;
        $("#postDetailedTitle").trigger('click');
        $("#notificationsdiv").hide();
        Custom.init();
         <?php   if(!isset($mainGroupCollection->AddSocialActions) || $mainGroupCollection->AddSocialActions==1) {?>
        setTimeout(setCommentArrowPoition,100);<?php } ?>
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
                trackEngagementAction("Love",postId,categoryId);
            }
        });
        <?php  if(!$data->DisableComments){?>
        $("#detailedComment").unbind('click');
        $(".detailedComment").bind('click',function(){
            var postId = $(this).attr('data-postid');
            var commentLeft = $(this).position().left;
            $('#postDetailedwidget .commentbox').append('<style>#postDetailedwidget .commentbox:before{left:'+commentLeft+'px}</style>');
            $('#postDetailedwidget .commentbox').append('<style>#postDetailedwidget .commentbox:after{left:'+commentLeft+'px}</style>');
            $("#commentTextArea").html("");
            $("#cId_"+postId).show();
            $("#newComment,#commentbox").show();
            $("#commentartifactsarea_" + postId).hide();
            $("#inviteBox,.invitebox").hide();
            initializationForHashtagsAtMentions('#commentTextArea_'+postId);
        });
        
        $("#cancelPostCommentButton").unbind('click');
        $("#cancelPostCommentButton").bind('click',function(){
            
             var postId = $(this).attr('data-postid');
             $("#commentTextArea_"+ postId).html("");
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
           
        });<?php }?>
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
        $("#postDetailedwidget .userprofilename_detailed,#postDetailedwidget .userprofilename").die("click");
        $("#postDetailedwidget .userprofilename_detailed,#postDetailedwidget .userprofilename").live("click",function(){
           var userId = $(this).attr('data-id'); 
           var postId = $(this).attr('data-postId');
           getMiniProfile(userId,postId);
        });
        $( ".detailed_close_page" ).unbind( "click" );
        $(".detailed_close_page").bind('click',function(){ 
            $("#"+setActiveClassPage).removeClass("active");
            if(detectDevices()){
                $("#rightpanel").show();
            }
            <?php if ($this->whichmenuactive == 1) {?>
                    
                if($("#streamMainDiv").length>0){
                    $("#homestream").removeClass("active").addClass("active");                    
                    if(storeId!=0 && categoryId==10 && pageType=='stream'){
                       isDuringAjax=false;
                         $(window).bind("scroll");
                    }
                }else if($("#curbsidePostsDiv").length>0){
                    $("#curbsidepost").removeClass("active").addClass("active");
                }else if($("#GroupTotalPage").length > 0){
                    $("#grouppost").removeClass("active").addClass("active");
                }
                    
            <?php }else if ($this->whichmenuactive == 2) { ?>
                $("#curbsidepost").removeClass("active").addClass("active");
            <?php }else if ($this->whichmenuactive == 3) { ?>
                 $("#groupmainmenu").removeClass("active").addClass("active");
            <?php } ?>
//            if($("#streamMainDiv").length > 0){
//                
//            }else if($("#curbsidePostsDiv").length > 0){
//                
//            }else if($("#curbsidePostsDiv").length > 0){
//                $("#curbsidepost").removeClass("active").addClass("active");
//            }else if($("#g_mediapopup").length > 0 || $("#groupstreamMainDiv").length > 0){
//               
//            }
            if(typeof io !== "undefined")
                updateSocketConnect();
              <?php  if(isset($_REQUEST['layout'])){ ?>
                window.location.href = "/";
                
            <?php unset($_REQUEST['layout']); }else{?> 
                
                if($.trim($("#notificationHistory").text()) != ""){
                                $("#notificationHomediv,#notificationHistory").show();
                                notificationAjax = false;
                    }else if($("#messagetextareadiv").length > 0){
                        if($("#minChatWidgetDiv").is(":visible") == false){
                            $("#chatDiv").show();
                        }else{
                            $("#contentDiv").show(); 
                        }
                    }else{
                        isDuringAjax = false;
                        $("#contentDiv").show(); 
                         $("#rightpanel").show();
                         $("#chatDiv").hide();
                    }
                if(globalspace.notification=="detailedpage"){
                            $('#admin_PostDetails').hide().html("");                    
                            if(fromHeaderNotifications == 2){
                                $('#notificationHistory').show();
                                $('#notificationHomediv').show();
                            }else{
                                if(($("#poststreamwidgetdiv").length>0) || $("#curbsidePostCreationdiv").length>0){
                                    //$("#rightpanel").show();
                                }
                                $("#contentDiv").show();
                            }
                            globalspace.notification="";
                            notificationAjax = false;
                            checkNotificationStatus = false;
                            return;
                        }
                        if($.trim(globalspace.groupsPage) == "detailed_page" ){ 
                            $("#admin_PostDetails").hide().html("");
                            $("#GroupTotalPage").show();   
                           // $("#rightpanel").show();
                            $("#contentDiv").show();
                            $(".group_admin_floatingMenu").show();
                            globalspace.groupsPage ="";
                            return;
                        }
                         
                        $("#streamDetailedDiv").html("");
                    
                    if($('#postDetailsDivInProfile').length>0){ 
                        $('#postDetailsDivInProfile').hide();
                        $('#profileDetailsDiv').show();
                         if($("#admin_PostDetails").is(':visible')){
                            $("#admin_PostDetails").hide().html("");
                            
                            
                        }
                        return;
                    }
                    if($("#curbsideStreamDetailedDiv").is(':visible')){
                            $("#curbsideStreamDetailedDiv").hide();
                            $("#curbsidePostCreationdiv").show();
                            
                            return;
                        }
                    var categoryId = $(this).attr("data-categoryId");
                    var postType = $(this).attr("data-postType");  
                   
                    if (checkNotificationStatus == true){
                        notificationAjax = false;
                        $("#notificationHomediv,#notificationHistory").show();
                        $("#contentDiv").hide();
                        if($("#notificationText").text() != ""){
                            $("#nomorenotifications").show();
                        }
                        checkNotificationStatus = false;
                    }else{
//                        $("#poststreamwidgetdiv,#rightpanel").show();
                        $("#poststreamwidgetdiv").show();
                        $("#streamDetailedDiv,#groupPostDetailedDiv").hide();
                       // $("#groupFormDiv,#groupstreamMainDiv,#groupProfileDiv,#GroupBanner,#usergroupsfollowingdiv").show();
                    }
                 
                    if(categoryId == 1 && (postType != 5)){
                        
                        $("#streamDetailedDiv").hide();
                        $("#poststreamwidgetdiv").show(); 
                        
                        if($("#curbsideStreamDetailedDiv").is(':visible')){
                            $("#curbsideStreamDetailedDiv").hide();
                            $("#curbsidePostCreationdiv").show();
                        }
                        if($("#admin_PostDetails").is(':visible')){
                            $("#admin_PostDetails").hide().html("");
//                            $("#contentDiv").show();
                        }
                        $("#groupFormDiv,#groupProfileDiv,#GroupBanner").show();
                        if(globalspace.featuredItems!=undefined){
                            if(globalspace.featuredItems==1){
                                loadGalleria();
                            }
                        }
        //                intervalIdNewpost = setInterval(function() {
        //                    status = 0;
        //                    socketPost.emit('getNewPostsRequest', g_postDT,loginUserId, userTypeId);
        //                }, 15000);
                    }
                    if(categoryId == 2){ 
                        var showdivId="";
                        var hidedivId="";
                        /**
                         * this is used to manage in both curbside and Normal..
                         */ 
                        if($("#curbsidePostCreationdiv").length > 0){  
                            showdivId = "curbsidePostCreationdiv";
                            hidedivId = "curbsideStreamDetailedDiv";
                        } if($("#admin_PostDetails").is(':visible')){ 
                            $("#admin_PostDetails").hide().html("");
                            $("#contentDiv").show();
                             //hidedivId = "admin_PostDetails";
                            //showdivId = "contentDiv";
                        }
                        else{  
                            showdivId = "poststreamwidgetdiv";
                            hidedivId = "streamDetailedDiv";
                        }                
                        $("#"+hidedivId).hide();
                        $("#"+showdivId).show();
        //                intervalIdCurbpost = setInterval(function() {
        //                    status = 0;
        //                    socketCurbside.emit('getNewCurbsidePostsRequest', g_postDT,loginUserId, userTypeId);
        //                }, 15000);
                    }
                    if(categoryId == 3 || categoryId == 7){ 
                        var showdivId="";
                        var hidedivId="";
                        /**
                         * this is used to manage in both group and Normal..
                         */ 
                        if($("#groupstreamMainDiv").length > 0){ 
                           // showdivId = "groupstreamMainDiv";
                            hidedivId = "groupPostDetailedDiv";
                             $("#GroupTotalPage").show();
                           // $("#groupFormDiv,#groupProfileDiv,#GroupBanner,#GroupTotalPage").show();
                        }else{
                            showdivId = "poststreamwidgetdiv";
                            hidedivId = "streamDetailedDiv";
                        }
        //                groupPostInterval = setInterval(function() {
        //                    status = 0;
        //                    socketGroup.emit('GetNewGroupPostsRequest', g_postDT, loginUserId, userTypeId);
        //                }, 15000);
                        $("#"+hidedivId).hide();
                        $("#"+showdivId).show();
                    }
            $('.jspContainer').css('height','250px');
            <?php }?>
            $("html,body").scrollTop(Global_ScrollHeight);
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
             trackEngagementAction(actionType,postId,categoryId);
            
        });
        //for mentions
        $("#postDetailedwidget span.at_mention").die("click");
        $("#postDetailedwidget span.at_mention").live( "click", 
           function(){
               var streamId = $(this).closest('div').attr('data-id');
               var userId = $(this).attr('data-user-id');
               getMiniProfile(userId,streamId);
           }
       );

       //for hashtags
      $("#postDetailedwidget span.hashtag>b").die( "click");
       $("#postDetailedwidget span.hashtag>b").live( "click", 
           function(){
               var postId = $(this).closest('div').attr('data-id');

               var hashTagName = $(this).text(); 
               getHashTagProfile(hashTagName,postId);
           }
       );
        //for CurbsidecateogryProfile
        $("#postDetailedwidget a.curbsideCategory").unbind( "click");
     $("#postDetailedwidget a.curbsideCategory").bind( "click", 
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
    $("img.share, img.sharedisable").unbind("click");
    $("img.share, img.sharedisable").bind("click",
            function() {
                var postId = $(this).closest('div.social_bar').attr('data-postid');
                var shareLeft = $(this).position().left;
                var sharesectionWidth = $(this).closest('span.sharesection').find('div.actionmorediv').width()/2;
                $(this).closest('span.sharesection').find('div.actionmorediv').css('left',shareLeft-sharesectionWidth+14);
            }
    );


   $('.grpIntro').live("click",function(){
            var groupId=$(this).attr('data-id');
            getGroupIntroPopUp(groupId);             
                  
              });
</script>
 
    <?php   }       
        }else{
?>
<div class="row-fluid">
    <div class="span12" style="text-align:center;">
        <h3>Page not found</h3>
    </div>
</div>
        <?php } ?>


 

 
