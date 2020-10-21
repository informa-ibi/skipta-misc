<?php
try {

    if (is_object($stream)) {

        $style = "display:block";

        foreach ($stream as $data) {
	if(!empty($data)){
            if ($data->CategoryType != 13) {
                ?>
         

                <div class="post item <?php echo (isset($data->IsPromoted) && $data->IsPromoted == 1) ? 'promoted' : ''; ?>" style="width:100%;display:none" id="postitem_<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>">


                    <div class="stream_widget marginT10 positionrelative" >
                <?php include 'stream_profile_image.php'; ?>
                        <div class="post_widget" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>">
                            <div class="stream_msg_box">
                        <?php include 'stream_header.php'; ?>

                                <?php if (($data->CategoryType != 3 || $data->IsIFrameMode == 1) && ($data->PostType < 6 || $data->PostType == 13 || $data->PostType == 14 || $data->PostType == 15)) { ?>
                                    <div class=" stream_content positionrelative">
                                        <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>"></span>
                                        <ul>
                                            <li class="media">
                                                <div class="isFeatured" id="isFeatutedIcon_<?php echo $data->_id ?>" <?php if ($data->IsFeatured == 1) { ?> style="display:block" <?php } else { ?> style="display:none"<?php } ?> > </div>

                    <?php if ($data->PostType != 3) {//not survey post  ?>


                                                    <?php
                                                    if ($data->ArtifactIcon != "") {
                                                        if ($data->PostType)
                                                            $extension = "";
                                                        $videoclassName = "";
                                                        $extension = strtolower($data->Resource["Extension"]);
                                                        if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                                            $videoclassName = 'videoThumnailDisplay';
                                                        } else {
                                                            $videoclassName = 'videoThumnailNotDisplay';
                                                        }

                                                        if ($data->IsMultiPleResources == 1) {
                                                            ?>

                                                            <?php
                                                            $className = "";
                                                            $uri = "";

                                                            $imageVideomp3Id = "";
                                                            $extension = strtolower($data->Resource["Extension"]);
                                                            if ($extension == "mp4" || $extension == "avi" || $extension == "flv" || $extension == "mov" || $extension == "mp3") {
                                                                $className = "videoimage";
                                                                $uri = $data->Resource["Uri"];
                                                                $imageVideomp3Id = "imageVideomp3_$data->_id";
                                                            } else {
                                                                $className = "postdetail";
                                                                if ($data->IsNativeGroup == 1) {
                                                                    $className = "";
                                                                }
                                                            }
                                                            ?>
                                                            <?php if (!empty($imageVideomp3Id)) { ?>
                                                                <div id="playerClose_<?php echo $data->_id; ?>"  style="display: none;">
                                                                    <div class="videoclosediv alignright"><button aria-hidden="true"  data-dismiss="modal" onclick="closeVideo('<?php echo $data->_id; ?>');" class="videoclose" type="button">×</button></div>
                                                                    <div class="clearboth"><div id="streamVideoDiv<?php echo $data->_id; ?>"></div></div>
                                                                </div>
                                <?php } ?>  
                                                            <a id="imgsingle_<?php echo $data->_id; ?>" class="pull-left img_single <?php echo $className; ?>" <?php if ($data->PostType == 15) { ?>data-profile="<?php echo $data->PostCompleteText; ?>" <?php } ?> data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" data-videoimage="<?php echo $uri; ?>" data-vimage="<?php echo $data->ArtifactIcon ?>"><div id='img_streamVideoDiv<?php echo $data->_id; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $data->ArtifactIcon ?>" <?php if (!empty($imageVideomp3Id)) {
                                    echo "id=$imageVideomp3Id";
                                } ?>  ></a>
                                                        <?php } else { ?>
                                                            <div class="pull-left multiple "> 
                                                                <div class="img_more1"></div>
                                                                <div class="img_more2"></div>
                                                                <a  class="pull-left pull-left1 img_more  <?php if ($data->IsNativeGroup != 1) { ?> postdetail <?php } ?>"  <?php if ($data->PostType == 15) { ?>data-profile="<?php echo $data->PostCompleteText; ?>" <?php } ?> data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>"><div id='img_streamVideoDiv<?php echo $data->_id; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $data->ArtifactIcon ?>"></a>
                                                            </div>
                            <?php }
                        } ?>
                                                    <div class="media-body" id="media_main_<?php echo $data->_id; ?>">
                                                        <?php if ($data->PostType == 2) { ?>   

                                                            <div id="EventpostDescription" style="<?php if ($data->ArtifactIcon != "") {
                                                                echo 'display:block';
                                                            } else {
                                                                echo 'display:none';
                                                            } ?>" >
                                                                <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_total_<?php echo $data->_id; ?>" style="display:none" >

                            <?php
                            echo $data->PostCompleteText;
                            ?>
                                                                </div>
                                                                <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_<?php echo $data->_id; ?>" <?php if ($data->PostType == 5) { ?> class="postdetail" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" <?php } ?> >

                            <?php
                            echo $data->PostText;
                            ?>
                                                                </div>

                                                            </div>
                                                            <!----------------------------------------Event calender Start----------------------------------------------------------------------->               

                                                            <div class="pull-left" >

                                                                <div class="timeshow pull-lefts"  > 
                                                                    <!-- spinner -->
                                                                    <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>

                                                                    <div id="stream_view_detailed_spinner_<?php echo $data->PostId; ?>"></div>
                                                                    <!-- end spinner -->
                                                                    <ul>
                                                                        <li class="clearboth">
                                                                            <ul class="<?php echo $data->StartDate == $data->EndDate ? '' : "doubleul" ?>">
                                                                                <li class="doubledate">
                                                                                    <time class="icon" datetime="<?php echo $data->StartDate; ?>">
                                                                                        <strong><?php echo $data->EventStartMonth; ?><?php echo $data->StartDate != $data->EndDate ? "<br/>" : "-"; ?><?php echo $data->EventStartYear; ?></strong>
                                                                                        <span><?php echo $data->EventStartDay; ?></span>
                                                                                        <em><?php echo $data->EventStartDayString; //day name  ?></em>

                                                                                    </time>

                                                                                </li>

                            <?php if ($data->StartDate != $data->EndDate) { ?>
                                                                                    <li style="width:80px;float:left"><time class="icon" datetime="<?php echo $data->EndDate; ?>">
                                                                                            <strong><?php echo $data->EventEndMonth; ?><br/><?php echo $data->EventEndYear; ?></strong>
                                                                                            <span><?php echo $data->EventEndDay; ?></span>
                                                                                            <em><?php echo $data->EventEndDayString; ?></em>
                                                                                        </time>

                                                                                    </li>
                                                                        <?php } ?>
                                                                            </ul>
                                                                        </li>

                            <?php if (trim($data->StartTime) != "" && trim($data->EndTime) != "" && $data->StartTime != $data->EndTime) { ?>
                                                                            <li class="clearboth e_datelist"><div class="e_date"><?php echo $data->StartTime ?> - <?php echo $data->EndTime ?></div></li>
                            <?php } ?>
                                                                    </ul>
                                                                    <div class="et_location clearboth"><span><i class="fa fa-map-marker"></i><?php echo $data->Location ?></span> </div>


                                                                </div>
                                                            </div>
                                                            <!------------------------------------- EVENT CALENDER END -------------------------------------------------------------------------->
                                                            <div id="EventpostDescriptionArtifact" style="<?php if ($data->ArtifactIcon != "") {
                                echo 'display:none';
                            } else {
                                echo 'display:block';
                            } ?>" >
                                                                <div class="media-body">
                                                                    <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_total_<?php echo $data->_id; ?>" style="display:none" >

                                                                        <?php
                                                                        echo $data->PostCompleteText;
                                                                        ?>
                                                                    </div>
                                                                    <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_<?php echo $data->_id; ?>" <?php if ($data->PostType == 5) { ?> class="postdetail" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" <?php } ?> >

                            <?php
                            echo $data->PostText;
                            ?>
                                                                    </div>

                                                                </div>
                                                            </div>



                            <?php if ((int) $data->FirstUserId != (int) $data->OriginalUserId) { ?>
                                                                <div class="media-body"> <div class="media">
                                                                        <a class="pull-left marginzero smallprofileicon">
                                                                            <img src="<?php echo $data->OriginalUserProfilePic ?>">
                                                                        </a>

                                                                        <div class="media-body">                                   
                                                                            <span class="m_day"><?php echo $data->OriginalPostPostedOn; ?></span>
                                                                            <div class="m_title"><a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php echo $data->OriginalUserId ?>"  style="cursor:pointer"><?php echo $data->OriginalUserDisplayName; ?></a><?php if ($data->PostType == 5) { ?><div id="curbside_spinner_<?php echo $data->_id; ?>"></div><span class="pull-right" data-id="<?php echo $data->_id; ?>"><?php echo $data->CurbsideConsultCategory ?></span><?php } ?></div>

                                                                        </div>
                                                                    </div></div><?php } ?>


                                                            <div class="alignright clearboth " >
                            <?php if (!$data->IsEventAttend) { ?>
                                                                    <button class="eventAttend btn btn-small editable_buttons " name="Attend" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>"><i class="fa fa-check-square-o  "></i> Attend</button> 
                            <?php } ?>
                                                            </div>

                        <?php } else { ?>

                                                            <!-- spinner -->
                                                            <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>
                                                            <div id="stream_view_detailed_spinner_<?php echo $data->PostId; ?>"></div>
                                                            <!-- end spinner -->


                                                            <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_total_<?php echo $data->_id; ?>" style="display:none" >

                                                            <?php
                                                            echo $data->PostCompleteText;
                                                            ?>
                                                            </div>

                                                            <?php
//            
//                   $stringArray = str_split($data->PostText, 240);                                 
//                   $text = $stringArray[0] . $appendData;
//                   $data->PostText = $text;
//            
//            
//                    }
                                                            ?>

                                                            <div class="bulletsShow <?php if ($data->PostType == 15) { ?> postdetail <?php } ?>" data-postid="<?php echo $data->PostId; ?>" <?php if ($data->PostType == 15) { ?>data-profile="<?php echo $data->PostCompleteText;
                                    } ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_<?php echo $data->_id; ?>" <?php if ($data->PostType == 5) { ?> class="postdetail" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" <?php } ?> >

                            <?php
                            if ($data->CategoryType == 11) {
                                $networkName = str_replace(' ', '', Yii::app()->params['NetworkName']);
                                ?> 
                                                                    <div class="networkbanner">
                                <?php if ($data->GroupImage != "") { ?>                        
                                                                            <img  src="<?php echo $data->GroupImage ?>">
                                <?php } ?>
                                                                        <div  class="<?php if ($data->GroupImage != "") { ?>networkbottombanner<?php } ?>">
                                                                            <div class="<?php if ($data->GroupImage != "") { ?>networkinvitediscription<?php } ?>">
                                                                    <?php echo $data->PostCompleteText; ?>
                                                                            </div>
                                                                            <div class="networkbutton alignright clearboth">

                                                                                <button class="btn btn-2 btn-2a " onclick="loginOauthOnProvider('<?php echo $networkName ?>', '<?php echo Yii::app()->params['ServerURL'] ?>', '<?php echo $data->NetworkRedirectUrl ?>', '<?php echo $data->_id ?>')" name="Join Now" ></i> Join Now</button> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                <?php
                            } else {
                                echo $data->PostText;
                            }
                            ?>
                                                               
                                                            </div>
                                                              <?php if ($data->CategoryType == 10 && $data->Store!=0){?>
                                                                  <!-- this is to display the users from store -->                                                       
                                                        
                   <div class="r_followersdiv r_newfollowers borderzero">
                       
                                                           <ul class="borderzero pull-right">
                                                               <?php foreach($data->StoreUsers as $storeUser){?>
                                                               <li data-original-title=" <?php echo  $storeUser['DisplayName']?>" rel="tooltip">
                                                                  <a data-id="<?php echo  $storeUser['UserId']?>" data-streamId="<?php echo $data->_id; ?>" style="cursor:pointer" class="smallprofileicon  floatL userprofilename">  

                                                                      <img src="<?php echo  $storeUser['ProfilePicture']?>"> 
                                                                   </a>
                                                                 
                                                               </li>
                                                               <?php }?>
                                                                <?php if($data->PlayersCount>0){ ?>
                                                               <li class="storelist">
                                                                   <div class="storeuserCount">
                                                                       <div class="storecount"><?php echo $data->PlayersCount;?></div>
                                                                       <div data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" class="storemore postdetail"><a href="#">more</a></div>
                                                                   </div>
                                                               </li>
                                                                <?php }?>
                                                           </ul>
                                                            
                                                            
                                                        </div>
                                                                  
                                                                  <?php }?>
                                                                  <!-- this is to display the users from store -->


                            <?php if ($data->PostType != 4) { ?>
                                                                <!-- Nested media object -->

                                <?php if ((int) $data->FirstUserId != (int) $data->OriginalUserId) { ?>
                                                                    <div class="media">
                                                                        <a class="pull-left marginzero smallprofileicon">
                                                                            <img src="<?php echo $data->OriginalUserProfilePic ?>">
                                                                        </a>

                                                                        <div class="media-body">                                   
                                                                            <span class="m_day"><?php echo $data->OriginalPostPostedOn; ?></span>
                                                                            <div class="m_title"><a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php echo $data->OriginalUserId ?>"  style="cursor:pointer"><?php echo $data->OriginalUserDisplayName; ?></a><?php if ($data->PostType == 5) { ?><div id="curbside_spinner_<?php echo $data->_id; ?>"></div><span class="pull-right" data-id="<?php echo $data->_id; ?>"><?php echo $data->CurbsideConsultCategory ?></span><?php } ?></div>

                                                                        </div>
                                                                    </div><?php } else if ($data->PostType == 5) { ?>
                                                                    <div class="media-body"> 
                                                                        <div id="curbside_spinner_<?php echo $data->_id; ?>"></div>
                                                                        <div class="m_title"><span class="pull-right" data-id="<?php echo $data->_id; ?>"><?php echo $data->CurbsideConsultCategory ?></span></div>
                                                                    </div>
                                <?php }
                            } ?>

                                                    <?php } ?> 

                                                    </div>
                                                    <?php if ($data->CategoryType == 3 && $data->IsIFrameMode == 1) { ?>
                                                        <div class="media-body"> 
                                                            <div class="m_title">
                                                                <span class="pull-right" data-id="<?php echo $data->_id; ?>">
                                                                    <a class="grpIntro grpIntro_b" data-streamId="<?php echo $data->_id; ?>" data-id="<?php echo $data->MainGroupId; ?>" style="cursor:pointer"><b><?php echo $data->GroupName; ?></b></a>
                                                                </span>
                                                            </div>
                                                        </div> 
                                                                <?php } ?>
                                                                <?php if (isset($data->WebUrls->Weburl)) {
                                                                    ?>
                            <?php if (isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist == '1') { ?>            
                                                            <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;clear:both;">
                                                                <div class="Snippet_div" style="position: relative">

                                                                    <a href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">


                                <?php if ($data->WebUrls->WebImage != "") { ?>
                                                                            <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $data->WebUrls->WebImage; ?>"></span>
                                <?php } ?>  </a>   
                                                                    <div class="media-body">                                   

                                                                        <label class="websnipheading"><?php echo $data->WebUrls->WebTitle ?></label>

                                                                        <a class="websniplink" href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank"> <?php echo $data->WebUrls->WebLink ?></a>
                                                                        <p><?php echo $data->WebUrls->Webdescription ?></p>

                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <?php }
                                                        } ?>      

                                                    <?php } else { ?>
                                                    <!------------------------------------------------------SURVEY POST START--------------------------------------------------------------------------------------------------------------->                           
                                                    <!-- spinner -->
                                                    <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>
                                                    <div id="stream_view_detailed_spinner_<?php echo $data->PostId; ?>"></div>
                                                    <!-- end spinner -->
                                                    <div class="alert alert-error" id="<?php echo "surveyError_" . $data->_id ?>" style='padding-top: 5px;display: none'> Please select an option </div>
                                                    <div class="alert alert-success" id="<?php echo "surveyConfirmation_" . $data->_id ?>" style='padding-top: 5px;display: none'><?php echo Yii::t('translation', 'Survey_Completed'); ?></div>
                                                    <div id="<?php echo "surveyArea_" . $data->_id ?>">
                                                        <?php
                                                        if (!$data->IsSurveyTaken) {
                                                            if ($data->ArtifactIcon != "") {
                                                                $extension = "";
                                                                $videoclassName = "";
                                                                $extension = strtolower($data->Resource["Extension"]);
                                                                if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                                                    $videoclassName = 'videoThumnailDisplay';
                                                                } else {
                                                                    $videoclassName = 'videoThumnailNotDisplay';
                                                                }
                                                                if ($data->IsMultiPleResources == 1) {
                                                                    ?>
                                                                    <?php
                                                                    $className = "";
                                                                    $uri = "";

                                                                    $imageVideomp3Id = "";

                                                                    if ($extension == "mp4" || $extension == "avi" || $extension == "flv" || $extension == "mov" || $extension == "mp3") {
                                                                        $className = "videoimage";
                                                                        $uri = $data->Resource["Uri"];
                                                                        $imageVideomp3Id = "imageVideomp3_$data->_id";
                                                                    } else {
                                                                        $className = "postdetail";
                                                                        if ($data->IsNativeGroup == 1) {
                                                                            $className = "";
                                                                        }
                                                                    }
                                                                    ?>
                                    <?php if (!empty($imageVideomp3Id)) { ?>
                                                                        <div id="playerClose_<?php echo $data->_id; ?>"  style="display: none;">
                                                                            <div class="videoclosediv alignright"><button aria-hidden="true"  data-dismiss="modal" onclick="closeVideo('<?php echo $data->_id; ?>');" class="videoclose" type="button">×</button></div>
                                                                            <div class="clearboth"><div id="streamVideoDiv<?php echo $data->_id; ?>"></div></div>
                                                                        </div>
                                                                    <?php } ?>  
                                                                    <a id="imgsingle_<?php echo $data->_id; ?>" class="pull-left img_single surveyimg <?php echo $className; ?>" data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" data-vimage="<?php echo $data->ArtifactIcon ?>" data-videoimage="<?php echo $uri; ?>"><div id='img_streamVideoDiv<?php echo $data->_id; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $data->ArtifactIcon ?>" <?php if (!empty($imageVideomp3Id)) {
                                        echo "id=$imageVideomp3Id";
                                    } ?>  ></a>
                                <?php } else { ?>

                                                                    <div class="pull-left multiple "> 
                                                                        <div class="img_more1"></div>
                                                                        <div class="img_more2"></div>
                                                                        <a class="pull-left pull-left1 img_more surveyimg postdetail" data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>"><div id='img_streamVideoDiv<?php echo $data->_id; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $data->ArtifactIcon ?>" ></a>         
                                                                    </div>
                                                                            <?php }
                                                                        }
                                                                        ?>

                                                            <div class="media-body">
                                                                <div class="surveyquestion" data-postid="<?php echo $data->PostId; ?>">
                                                                    <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_total_<?php echo $data->_id; ?>" style="display:none" >

                            <?php
                            echo $data->PostCompleteText;
                            ?>
                                                                    </div>
                                                                    <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_<?php echo $data->_id; ?>" <?php if ($data->PostType == 5) { ?> class="postdetail" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" <?php } ?> >

                            <?php
                            echo $data->PostText;
                            ?>
                                                                    </div>

                                                                </div>
                                                                <div class="row-fluid "> 
                                                                    <div class="span12 customradioanswers">
                                                                        <div class="customradioanswersdiv">
                                                                            <div class="c_prefix">A)</div>
                                                                            <div class="c_suffix"><input type="radio" class="styled" name="<?php echo "survey_" . $data->PostId ?>" value="OptionOne"></div> 
                                                                        </div>
                                                                        <div class="c_options"><?php echo $data->OptionOne ?></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid "> 
                                                                    <div class="span12 customradioanswers">
                                                                        <div class="customradioanswersdiv">
                                                                            <div class="c_prefix">B)</div>
                                                                            <div class="c_suffix"><input type="radio" class="styled" name="<?php echo "survey_" . $data->PostId ?>" value="OptionTwo"></div> 
                                                                        </div>
                                                                        <div class="c_options"><?php echo $data->OptionTwo ?></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid "> 
                                                                    <div class="span12 customradioanswers">
                                                                        <div class="customradioanswersdiv">
                                                                            <div class="c_prefix">C)</div>
                                                                            <div class="c_suffix"><input type="radio" class="styled" name="<?php echo "survey_" . $data->PostId ?>" value="OptionThree"></div> 
                                                                        </div>
                                                                        <div class="c_options"><?php echo $data->OptionThree ?></div>
                                                                    </div>
                                                                </div>     
                            <?php if (isset($data->OptionFour) && !empty($data->OptionFour)) { ?>
                                                                    <div class="row-fluid "> 
                                                                        <div class="span12 customradioanswers">
                                                                            <div class="customradioanswersdiv">
                                                                                <div class="c_prefix">D)</div>
                                                                                <div class="c_suffix"><input type="radio" class="styled" name="<?php echo "survey_" . $data->PostId ?>" value="OptionFour"></div> 
                                                                            </div>
                                                                            <div class="c_options"><?php echo $data->OptionFour ?></div>
                                                                        </div>
                                                                    </div>
                            <?php } ?>
                                                                <div class="alignright paddingtb">

                                                                    <input class="btn " name="commit" type="button" value="Submit" onclick="submitSurvey('<?php echo $data->PostId ?>', '<?php echo $data->NetworkId; ?>', '<?php echo $data->CategoryType; ?>',<?php echo $data->OptionOneCount; ?>,<?php echo $data->OptionTwoCount; ?>,<?php echo $data->OptionThreeCount ?>,<?php echo $data->OptionFourCount; ?>, '<?php echo $data->_id ?>',<?php echo $data->IsOptionDExist; ?>)" />
                                                                </div>

                                                            </div>
                                                            <?php if ((int) $data->FirstUserId != (int) $data->OriginalUserId) { ?>
                                                                <div class="media-body"> <div class="media">
                                                                        <a class="pull-left marginzero smallprofileicon">
                                                                            <img src="<?php echo $data->OriginalUserProfilePic ?>">
                                                                        </a>

                                                                        <div class="media-body">                                   
                                                                            <span class="m_day"><?php echo $data->OriginalPostPostedOn; ?></span>
                                                                            <div class="m_title"><a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php echo $data->OriginalUserId ?>"  style="cursor:pointer"><?php echo $data->OriginalUserDisplayName; ?></a><?php if ($data->PostType == 5) { ?><div id="curbside_spinner_<?php echo $data->_id; ?>"></div><span class="pull-right" data-id="<?php echo $data->_id; ?>"><?php echo $data->CurbsideConsultCategory ?></span><?php } ?></div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                            <?php } ?>
                            <?php if ($data->CategoryType == 3 && $data->IsIFrameMode == 1) { ?>
                                                                <div class="media-body"> 
                                                                    <div class="m_title">
                                                                        <span class="pull-right" data-id="<?php echo $data->_id; ?>">
                                                                            <a class="grpIntro grpIntro_b" data-streamId="<?php echo $data->_id; ?>" data-id="<?php echo $data->MainGroupId; ?>" style="cursor:pointer"><b><?php echo $data->GroupName; ?></b></a>
                                                                        </span>
                                                                    </div>
                                                                </div> 
                            <?php } ?>
                            <?php if (isset($data->WebUrls->Weburl)) { ?>
                                <?php if (isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist == '1') { ?>            
                                                                    <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;">
                                                                        <div class="Snippet_div" style="position: relative">

                                                                            <a href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">
                                    <?php if ($data->WebUrls->WebImage != "") { ?>
                                                                                    <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $data->WebUrls->WebImage; ?>"></span>
                                    <?php } ?></a>
                                                                            <div class="media-body">                                   


                                                                                <label class="websnipheading" ><?php echo $data->WebUrls->WebTitle ?></label>

                                                                                <a   class="websniplink" href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank"> <?php echo $data->WebUrls->WebLink ?></a>
                                                                                <p><?php echo $data->WebUrls->Webdescription ?></p>

                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                        <?php }
                                                                    } ?>

                                                                <?php } ?>
                                                    </div>
                                                    <div class="media-body" id="<?php echo "surveyTakenArea_" . $data->_id ?>" style="display:<?php echo $data->IsSurveyTaken ? 'block' : 'none' ?>">
                                                        <div class="surveyquestion" data-postid="<?php echo $data->PostId; ?>"> 
                                                            <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_total_<?php echo $data->_id; ?>" style="display:none" >

                        <?php
                        echo $data->PostCompleteText;
                        ?>
                                                            </div>
                                                            <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>"  data-id="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" id="post_content_<?php echo $data->_id; ?>" <?php if ($data->PostType == 5) { ?> class="postdetail" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" <?php } ?> >

                        <?php
                        echo $data->PostText;
                        ?>
                                                            </div>
                                                        </div>
                                                        <div class="media-body custommedia-body">
                                                            <div class="row-fluid">
                                                                <div class="span12">
                                                                    <div class="span7" id="<?php echo "surveyGraphArea_" . $data->_id ?>" ></div>
                                                                    <div class="span5 surveyresults" >
                                                                        <div class="row-fluid ">
                                                                            <div class="span12">
                        <?php echo "A) " . $data->OptionOne ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row-fluid ">
                                                                            <div class="span12">
                                                                        <?php echo "B) " . $data->OptionTwo ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row-fluid ">
                                                                            <div class="span12">
                                                        <?php echo "C) " . $data->OptionThree ?>
                                                                            </div>
                                                                        </div>
                        <?php if (isset($data->OptionFour) && !empty($data->OptionFour)) { ?>
                                                                            <div class="row-fluid ">
                                                                                <div class="span12">
                                                                        <?php echo "D) " . $data->OptionFour; ?>
                                                                                </div>
                                                                            </div>
                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                        <?php if (isset($data->WebUrls->Weburl)) { ?>
                            <?php if (isset($data->IsWebSnippetExist) && $data->IsWebSnippetExist == '1') { ?>            
                                                                <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;">
                                                                    <div class="Snippet_div" style="position: relative">

                                                                        <a href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">
                                <?php if ($data->WebUrls->WebImage != "") { ?>
                                                                                <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $data->WebUrls->WebImage; ?>"></span>
                                                                <?php } ?>    </a>
                                                                        <div class="media-body">                                   


                                                                            <label class="websnipheading" ><?php echo $data->WebUrls->WebTitle ?></label>
                                                                            <a  class="websniplink" href="<?php echo $data->WebUrls->Weburl; ?>" target="_blank">
                                <?php echo $data->WebUrls->WebLink ?></a>
                                                                            <p><?php echo $data->WebUrls->Webdescription ?></p>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            <?php }
                                                        } ?>

                                                    <?php
                                                    if ($data->IsSurveyTaken) {
                                                        ?>
                                                            <script type="text/javascript">
                                                                $(function() {
                                                                    var height = 250;
                                                                    var width = 300;
                                                                    if (detectDevices()) {
                                                                        width = 230;
                                                                    }
                                                                    drawSurveyChart('<?php echo "surveyGraphArea_" . $data->_id ?>', <?php echo $data->OptionOneCount ?>, <?php echo $data->OptionTwoCount ?>,<?php echo $data->OptionThreeCount ?>,<?php echo $data->OptionFourCount ?>, height, width,<?php echo $data->IsOptionDExist; ?>);
                                                                });
                                                            </script>
                                                        <?php } ?>
                                                    </div>
                    <?php } ?>
                                                <!------------------------------------------------------SURVEY POST END--------------------------------------------------------------------------------------------------------------->                           

                                                    <?php $joyride = 0; ?> <!-- This id numero3 is used for Joyride help -->
                                                    <?php if (!isset($data->AddSocialActions) || $data->AddSocialActions == 1) { ?>          
                                                    <div  <?php if ($data->CategoryType == 11) echo "style= 'display:none;'" ?> <?php echo $joyride == 0 ? "id='numero3'" : ""; ?> class="social_bar" data-id="<?php echo $data->_id ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-networkId="<?php echo $data->NetworkId; ?>" data-iframemode="<?php echo $data->IsIFrameMode; ?>">	


                        <?php $joyride = $joyride + 1; //if($this->tinyObject->UserId != $tinyOriginalUser['UserId']){ ?>
                                                        <a class="follow_a"><i ><img src="/images/system/spacer.png" class=" tooltiplink <?php echo $data->IsFollowingPost ? 'follow' : 'unfollow' ?>" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->IsFollowingPost ? 'Unfollow' : 'Follow' ?>" ></i> <b id="streamFollowUnFollowCount_<?php echo $data->PostId; ?>"><?php echo $data->FollowCount ?></b></a>
                        <?php //}  ?>  
                                                                    <?php if ($data->PostType != 5 && $data->PostType != 13 && $data->CategoryType != 3) { ?>
                                                            <a ><i><img src="/images/system/spacer.png" class=" tooltiplink cursor invite_frds" data-placement="bottom" rel="tooltip"  data-original-title="Invite" ></i></a>
                                                                    <?php } ?>  
                                                                    <?php if ($data->PostType != 5 && $data->CategoryType != 3) { ?>
                                                            <span class="cursor"><i><img  class=" tooltiplink cursor <?php echo $data->IsLoved ? 'likes' : 'unlikes' ?>"   data-placement="bottom" rel="tooltip"  data-original-title="Love" src="/images/system/spacer.png"></i><b id="streamLoveCount_<?php echo $data->PostId; ?>"><?php echo $data->LoveCount ?></b></span>

                        <?php } ?> 
                        <?php
                        if ($data->CategoryType == 1 && YII::app()->params['Share'] == 'ON') {
                            if (!$data->TwitterShare || !$data->FbShare) {
                                $shareCount = (isset($data->ShareCount) && is_int($data->ShareCount)) ? $data->ShareCount : 0;
                                $shareClass = ($data->TwitterShare || $data->FbShare) ? 'sharedisable' : 'share';
                                ?>
                                                                <span class="sharesection" ><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="Share" data-placement="bottom"><img src="/images/system/spacer.png"  class="<?php echo $shareClass; ?>"  ></i><b id="streamShareCount_<?php echo $data->_id; ?>"><?php echo $shareCount; ?></b>
                                                                    <div class="dropdown-menu actionmorediv">

                                                                        <ul id="share_<?php echo $data->_id; ?>">
                                <?php if (!$data->FbShare) { ?>
                                                                                <li class="shareFacebook"><a onclick="prepareWallPostData('<?php echo $data->PostId ?>', '<?php echo $data->CategoryType; ?>', '<?php echo $data->PostType; ?>', '<?php echo $data->_id; ?>')"><i class="fa fa-facebook"></i> Facebook</a></li>
                                                            <?php }if (!$data->TwitterShare) { ?>
                                                                                <li class="shareTwitter"><a onclick="getTweetLink('<?php echo $data->PostId ?>', '<?php echo $data->CategoryType; ?>', '<?php echo $data->PostType; ?>', '<?php echo $data->_id; ?>')"><i class="fa fa-twitter"></i> Twitter</a></li>
                                <?php } ?>
                                                                        </ul>

                                                                    </div>

                                                                </span><?php } else { ?>
                                                                <span class="sharesection"><i class="tooltiplink" data-toggle="dropdown" rel="tooltip" data-original-title="Share" data-placement="bottom"><img src="/images/system/spacer.png"  class="sharedisable"  ></i><b id="streamShareCount_<?php echo $data->_id; ?>"><?php echo (isset($data->ShareCount) && is_int($data->ShareCount)) ? $data->ShareCount : 0 ?></b></span>
                            <?php }
                        } ?>                          

                        <?php if (!$data->DisableComments && $data->CategoryType != 3) { ?>
                                                            <span><i ><img src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Comment" class=" cursor tooltiplink  <?php if ($data->PostType != 5) { ?><?php echo $data->IsCommented ? 'commented' : 'comments' ?><?php } else { ?>comments1 postdetail<?php } ?>" <?php if ($data->PostType == 5) { ?> data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" <?php } ?> ></i><b id="commentCount_<?php echo $data->PostId; ?>" data-postId="commentCount_<?php echo $data->PostId; ?>"><?php echo $data->CommentCount ?></b></span>              
                        <?php } ?>
                                                        <div id="socialactionsError_<?php echo $data->PostId ?>" class="alert alert-error displayn"></div>
                                                    </div>
                    <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                <?php
                }
                /**
                 * group  snippet loading
                 */ else if ($data->PostType == 9 || ($data->CategoryType == 3 && $data->IsIFrameMode != 1)) {
                    ?>
                                    <div class=" stream_content positionrelative">
                                        <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>"></span>
                                        <ul>
                                            <li class="media">
                                                <a onclick="trackEngagementAction('GroupDetail', '<?php echo $data->GroupId ?>')" class="pull-left img_single" href="/<?php echo $data->GroupName ?>"><img src="<?php echo $data->GroupImage ?>"  ></a>
                                                <div class="media-body" >
                                                    <p  data-postid="<?php echo $data->PostId; ?>">
                                                        <a href="/<?php echo $data->GroupName ?>" ><b><?php echo $data->GroupName; ?></b></a>
                                                    </p>
                                                    <p id='groupShortDescription' style="cursor: pointer" data-GroupId="<?php echo $data->GroupId ?>"  data-groupName="<?php echo $data->GroupName ?>" data-postid="<?php echo $data->PostId; ?>"><?php
                                                echo $data->GroupDescription;
                                                ?></p>
                                                </div>
                                                <div class="social_bar" data-id="<?php echo $data->_id ?>" data-groupid="<?php echo $data->GroupId ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>">	
                                                    <a class="follow_a"><i><img src="/images/system/spacer.png"  class=" tooltiplink <?php echo $data->IsFollowingPost ? 'follow' : 'unfollow' ?>"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->IsFollowingPost ? 'Unfollow' : 'Follow' ?>"></i></a><b id="group_followers_count_<?php echo $data->_id ?>"><?php echo $data->GroupFollowersCount ?></b>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                    <?php
                    /**
                     * hashtag snippet loading derivative actions 
                     */
                } else if ($data->PostType == 8) {
                    ?>
                                    <div class=" stream_content positionrelative">
                                        <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>"></span>
                                        <ul>
                                            <li class="media">
                                    <?php if ($data->GroupImage != '') { ?>
                                                    <a  class="pull-left img_single" ><img src="<?php echo $data->GroupImage ?>"  ></a>
                    <?php } ?>
                                                <div class="media-body" >
                                                    <p  data-postid="<?php echo $data->PostId; ?>">
                                                        <a><b><?php echo $data->CurbsideConsultCategory; ?></b></a>
                                                    </p>
                                                    <p></p>
                                                </div>
                                                <div class="social_bar" data-id="<?php echo $data->_id ?>" data-curbsidecategoryid="<?php echo $data->CurbsideCategoryId ?>" data-postid="<?php echo $data->CurbsideCategoryId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>">	
                                                    <a style="cursor:pointer"><i><img src="/images/system/spacer.png"  class=" tooltiplink <?php echo $data->IsFollowingEntity ? 'follow' : 'unfollow' ?>" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->IsFollowingPost ? 'Unfollow' : 'Follow' ?>" ></i></a>
                                                    <span><i><img class=" tooltiplink g_followers cursor" src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Followers" ></i> <b id="curbside_followers_count_<?php echo $data->_id ?>"><?php echo $data->CurbsidePostCount ?></b></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                                    <?php } /**
                                                     * @author suresh reddy
                                                     * hashtag category snippet loading derivative actions
                                                     */ else if ($data->PostType == 7) {
                                                        ?>

                                    <div class=" stream_content positionrelative">
                                        <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>"></span>
                                        <ul>
                                            <li class="media">
                    <?php if ($data->GroupImage != '') { ?>
                                                    <a  class="pull-left img_single" ><img src="<?php echo $data->GroupImage ?>"  ></a>
                    <?php } ?>
                                                <div class="media-body" >
                                                    <p  data-postid="<?php echo $data->PostId; ?>">
                                                        <a><b><?php echo $data->HashTagName; ?></b></a>
                                                    </p>
                                                    <p><?php
                                                echo $data->GroupDescription;
                                                ?></p>
                                                </div>
                                                <div class="social_bar" data-id="<?php echo $data->_id ?>" data-curbsidecategoryid="<?php echo $data->PostId ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>">	
                                                    <a style="cursor:pointer"><i><img src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->IsFollowingEntity ? 'Unfollow' : 'Follow' ?>" class=" tooltiplink <?php echo $data->IsFollowingEntity ? 'follow' : 'unfollow' ?>" ></i></a>
                                                    <span><i ><img class="tooltiplink g_followers cursor" src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Followers" ></i> <b id="hashtag_followers_count_<?php echo $data->_id ?>"><?php echo $data->HashTagPostCount ?></b></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                                <?php } else if ($data->PostType == 11) { ?>
                                    <!-- spinner -->
                                    <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>
                                    <div id="stream_view_detailed_spinner_<?php echo $data->PostId; ?>"></div>
                                    <!-- end spinner -->
                                    <div class=" stream_content positionrelative">
                                        <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>"></span>
                                        <ul>
                                            <li class="media">
                                                        <?php if ($data->HtmlFragment != '') { ?>
                                                    <a  class="pull-left img_single NOBJ postdetail" id='<?php echo $data->_id; ?>' data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>">
                        <?php $object = stristr($data->HtmlFragment, '<object');
                        if ($object != '') {
                            ?>
                                                            <div class="galleria-info" style="bottom:0px"><div class="galleria-info-text" style="border-radius:0px"><div class="galleria-info-description" style="height:132px"></div></div></div>
                                                        <?php } ?>
                                                        <?php
                                                        $pattern = '/(width)="[0-9]*"/';
                                                        $string = $data->HtmlFragment;
                                                        $string = preg_replace($pattern, "width='180'", $string);
                                                        $pattern = '/(height)="[0-9]*"/';
                                                        $string = preg_replace($pattern, "height='150'", $string);

                                                        echo $string;
                                                        ?>
                                                    </a>
                    <?php } ?>
                                                <div class="media-body" >
                                                    <p class="cursor postdetail" id='<?php echo $data->_id; ?>' data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" data-news='yes'>
                    <?php echo $data->PostText; ?>
                                                    </p>
                                                    <p></p>
                                                </div>
                                                <div class="social_bar" data-id="<?php echo $data->_id ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-networkId="<?php echo $data->NetworkId; ?>" data-iframemode="<?php echo $data->IsIFrameMode; ?>">	
                                                    <a class="follow_a"><i ><img src="/images/system/spacer.png" class=" tooltiplink <?php echo $data->IsFollowingPost ? 'follow' : 'unfollow' ?>" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->IsFollowingPost ? 'Unfollow' : 'Follow' ?>" ></i> <b id="streamFollowUnFollowCount_<?php echo $data->PostId; ?>"><?php echo $data->FollowCount ?></b></a>
                    <?php if (!$data->DisableComments) { ?>
                                                        <span><i ><img src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Comment" class=" cursor tooltiplink comments1 postdetail" <?php if ($data->PostType == 11) { ?> data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" <?php } ?> ></i><b id="commentCount_<?php echo $data->_id; ?>"><?php echo $data->CommentCount ?></b></span>              
                                                        <?php } ?>
                                                    <div id="socialactionsError_<?php echo $data->PostId ?>" class="alert alert-error displayn"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                                <?php } else if ($data->PostType == 12) { ?>
                                    <!-- spinner -->
                                    <div id="stream_view_spinner_<?php echo $data->_id; ?>"></div>
                                    <div id="stream_view_detailed_spinner_<?php echo $data->PostId; ?>"></div>
                                    <!-- end spinner -->
                                    <div class=" stream_content positionrelative">
                                        <span id="followUnfollowSpinLoader_<?php echo $data->PostId; ?>"></span>
                                        <ul>
                                            <li class="media">
                                                <a  href="/<?php echo $data->GameName ?>/<?php echo $data->CurrentGameScheduleId ?>/detail/game " class="pull-left img_single" ><img src="<?php if (isset($data->Resource)) {
                                    echo $data->Resource;
                                } else {
                                    echo $data->GameBannerImage;
                                } ?>"  ></a>

                                                <div class="media-body gameDesc"  >

                                                    <p class="cursor">
                    <?php echo $data->GameName ?>
                                                    </p >
                                                    <p class="cursor"><?php echo $data->PostText; ?></p>
                                                </div>
                                                <div class="alignright clearboth eventButtonPosition"  > 
                                                    <?php
                                                    if ($data->GameStatus == "play") {
                                                        $class = "btn btnplay btnplaymini";
                                                        $label = "Play Now <i class='fa fa-chevron-circle-right'></i>";
                                                    } else if ($data->GameStatus == "resume") {
                                                        $class = "btn btnresume btnplaymini";
                                                        $label = "Resume <i class='fa fa-chevron-circle-right'></i>";
                                                    } else if ($data->GameStatus == "view") {
                                                        $class = "btn btnviewanswers btnplaymini";
                                                        $label = "View <i class='fa fa-chevron-circle-right'></i>";
                                                    }
                                                    ?> <?php if ($data->GameStatus != "future") { ?>
                                                        <a href="/<?php echo $data->GameName ?>/<?php echo $data->CurrentGameScheduleId ?>/<?php echo $data->GameStatus ?>/game " class="group">
                                                            <button class="<?php echo $class ?> " type="button"><?php echo $label ?> </button></a>
                    <?php } ?>    
                                                </div>
                                                <div class="social_bar" data-id="<?php echo $data->_id ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-networkId="<?php echo $data->NetworkId; ?>" data-iframemode="<?php echo $data->IsIFrameMode; ?>">	
                                                    <a class="follow_a"><i ><img src="/images/system/spacer.png" class=" tooltiplink <?php echo $data->IsFollowingPost ? 'follow' : 'unfollow' ?>" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->IsFollowingPost ? 'Unfollow' : 'Follow' ?>" ></i> <b id="streamFollowUnFollowCount_<?php echo $data->PostId; ?>"><?php echo count($data->PostFollowers) ?></b></a>
                    <?php if (!$data->DisableComments) { ?>

                                                        <span><i ><a href="/<?php echo $data->GameName ?>/<?php echo $data->CurrentGameScheduleId ?>/detail/game "><img src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Comment" class=" cursor tooltiplink  <?php if ($data->PostType != 5) { ?><?php echo $data->IsCommented ? 'commented' : 'comments' ?><?php } else { ?>comments1 postdetail<?php } ?>" <?php if ($data->PostType == 5) { ?> data-id="<?php echo $data->PostId; ?>" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" <?php } ?> ></a></i><b id="commentCount_<?php echo $data->PostId; ?>"><?php echo count($data->Comments) ?></b></span>
                                    <?php } ?>
                                                    <div id="socialactionsError_<?php echo $data->PostId ?>" class="alert alert-error displayn"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                        <?php } ?>            
                            </div>


                                        <?php if ($data->CategoryType == 1 || $data->CategoryType == 10 || $data->CategoryType == 12) { ?>
                                            <?php if ($data->RecentActivity == "Invite") { ?>
                                    <div style="" id="Invite_<?php echo $data->_id; ?>" class="invitebox">
                                        <div class="padding10"><?php echo $data->InviteMessage; ?></div>
                                    </div>
                                            <?php } ?>
                                <div id="PostdetailSpinLoader_streamDetailedDiv"></div>
                                <div class="commentbox <?php if ($data->PostType == 5) { ?>commentbox2<?php } ?> " id="cId_<?php echo $data->_id; ?>"  style="display:<?php echo (count($data->Comments) == 0 || $data->RecentActivity == "Invite") ? 'none' : 'block'; ?>">
                                    <div id="commentSpinLoader_<?php echo $data->_id; ?>"></div>

                    <?php
                    $comments = $data->Comments;
                    $commentCount = sizeof($comments);
                    ?>
                                    <div class="myClass" id="CommentBoxScrollPane_<?php echo $data->_id; ?>"  >
                                        <div   id="commentbox_<?php echo $data->_id ?>" style="display:<?php echo $data->CommentCount > 0 ? 'block' : 'none'; ?>">
                                            <div id="commentsAppend_<?php echo $data->_id; ?>"></div>
                                                                    <?php
                                                                    $style = "display:none";
                                                                    if (sizeof($data->Comments) > 0) {

                                                                        if (sizeof($data->Comments) > 2) {
                                                                            $style = "display:block";
                                                                        }
                                                                        $maxDisplaySize = sizeof($data->Comments) > 2 ? 2 : sizeof($data->Comments);

                                                                        for ($j = sizeof($data->Comments); $j > sizeof($data->Comments) - $maxDisplaySize; $j--) {


                                                                            $comment = $data->Comments[$j - 1];
                                                                            ?>
                                                    <div class="commentsection">
                                                        <div class="row-fluid commenteddiv">
                                                            <div class="span12">
                                                                <div class=" stream_content">
                                                                    <ul>
                                                                        <li class="media">
                                                                            <?php
                                                                            if ($comment["NoOfArtifacts"] > 0) {
                                                                                $commentID = $comment['CommentId'];
                                                                                $extension = "";
                                                                                $extension = strtolower($comment['Artifacts']["Extension"]);
                                                                                $videoclassName = "";
                                                                                if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                                                                    $videoclassName = 'videoThumnailDisplay';
                                                                                } else {
                                                                                    $videoclassName = 'videoThumnailNotDisplay';
                                                                                }
                                                                                ?>

                                                                                <?php
                                                                                if ($comment['NoOfArtifacts'] == 1) {
                                                                                    $commentID = $comment['CommentId'];
                                                                                    foreach ($commentID as $id) {
                                                                                        $commentID = $id;
                                                                                    }
                                                                                    ?>
                                                                                    <?php
                                                                                    $className = "";
                                                                                    $uri = "";
                                                                                    $extension = "";
                                                                                    $imageVideomp3Id = "";
                                                                                    $extension = strtolower($comment['Artifacts']["Extension"]);
                                                                                    if ($extension == "mp4" || $extension == "avi" || $extension == "flv" || $extension == "mov" || $extension == "mp3") {
                                                                                        $className = "videoimage";
                                                                                        $uri = $comment['Artifacts']["Uri"];
                                                                                        $imageVideomp3Id = "imageVideomp3_$commentID";
                                                                                    } else {
                                                                                        $className = "postdetail";
                                                                                    }
                                                                                    if ($extension == 'mp4' || $extension == 'flv' || $extension == 'mov') {
                                                                                        $videoclassName = 'videoThumnailDisplay';
                                                                                    } else {
                                                                                        $videoclassName = 'videoThumnailNotDisplay';
                                                                                    }
                                                                                    ?>
                                    <?php if (!empty($imageVideomp3Id)) { ?>
                                                                                        <div id="playerClose_<?php echo $commentID; ?>"  style="display: none;">
                                                                                            <div class="videoclosediv alignright"><button aria-hidden="true"  data-dismiss="modal" onclick="closeVideo('<?php echo $commentID; ?>');" class="videoclose" type="button">×</button></div>
                                                                                            <div class="clearboth"><div id="streamVideoDiv<?php echo $commentID; ?>"></div></div>
                                                                                        </div>
                                                                                            <?php } ?>  
                                                                                    <a id="imgsingle_<?php echo $commentID; ?>" class="postdetail pull-left img_single" <?php if ($data->PostType == 15) { ?>data-profile="<?php echo $data->PostCompleteText; ?>" <?php } ?> data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>" data-videoimage="<?php echo $uri; ?>"><div id='img_streamVideoDiv<?php echo $commentID; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $comment["ArtifactIcon"] ?>" <?php if (!empty($imageVideomp3Id)) {
                                                            echo "id=$imageVideomp3Id";
                                                        } ?>  ></a>
                                <?php } else { ?>

                                                                                    <div class="pull-left multiple "> 
                                                                                        <div class="img_more1"></div>
                                                                                        <div class="img_more2"></div>
                                                                                        <a class="pull-left pull-left1 img_more  postdetail" <?php if ($data->PostType == 15) { ?>data-profile="<?php echo $data->PostCompleteText; ?>" <?php } ?> data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->PostType; ?>"><div id='img_streamVideoDiv<?php echo $commentID; ?>' class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php echo $comment["ArtifactIcon"] ?>"></a>
                                                                                    </div>                                                

                                <?php } ?>
                                                                            <?php } ?> 

                                                                            <div class="media-body" >

                                                                                <div class="bulletsShow" data-postid="<?php echo $data->PostId; ?>" data-id="<?php echo $data->_id; ?>" id="post_content_<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>">

                            <?php
                            echo $comment["CommentText"];
                            ?>
                                                                                </div>
                                                                                <!-- Nested media object -->
                                                                                <div class="media">
                                                                                    <a class="pull-left marginzero smallprofileicon">
                                                                                        <img src="<?php echo $comment['ProfilePicture'] ?>">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <span class="m_day"><?php echo $comment["CreatedOn"]; ?></span>
                                                                                        <div class="m_title"><a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php echo $comment['UserId'] ?>"  style="cursor:pointer"><?php echo $comment["DisplayName"] ?></a></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <?php if (isset($comment['WebUrls']['Weburl'])) { ?>
                                                                                <?php if (isset($comment["IsWebSnippetExist"]) && $comment["IsWebSnippetExist"] == '1') { ?>           

                                                                                    <div id="snippet_main" style="padding-top: 10px; padding-bottom: 10px;clear:both;">
                                                                                        <div class="Snippet_div" style="position: relative">

                                                                                            <a href="<?php echo $comment['WebUrls']['Weburl']; ?>" target="_blank">
                                    <?php if ($comment['WebUrls']['WebImage'] != "") { ?>
                                                                                                    <span  class=" pull-left img_single e_img" style="width:100px;" ><img src="<?php echo $comment['WebUrls']['WebImage']; ?>"></span>
                                    <?php } ?>
                                                                                                <div class="media-body">  </a>                                 


                                                                                            <label class="websnipheading" ><?php echo $comment['WebUrls']['WebTitle']; ?></label>
                                                                                            <a   class="websniplink" href="<?php echo $comment['WebUrls']['Weburl']; ?>" target="_blank"> <?php echo $comment['WebUrls']['WebLink']; ?></a>
                                                                                            <p><?php echo $comment['WebUrls']['Webdescription']; ?></p>

                                                                                        </div>

                                                                                    </div>
                                                                                    </div>

                                                        <?php }
                                                    } ?>


                                                                        </li>
                                                                    </ul>
                                                                </div>



                                                            </div>
                                                        </div>

                                                    </div>
                        <?php } ?>

                    <?php
                    } else {
                        $style = "display:none";
                    }
                    if ($data->CommentCount > 2 && sizeof($data->Comments) == 2) {
                        $style = "display:block";
                    } else if ($data->CommentCount > sizeof($data->Comments)) {
                        $style = "display:block";
                    }
                    ?>

                                        </div> 
                                    </div>
                                    <div class="viewmorecomments alignright">
                                        <span  id="viewmorecomments_<?php echo $data->_id; ?>" style="<?php echo $style; ?>" onclick="viewmoreComments('/post/postComments', '<?php echo $data->PostId ?>', '<?php echo $data->_id ?>', '<?php echo $data->CategoryType; ?>');">More Comments</span>
                                    </div>

                                    <div id="ArtifactSpinLoader_postupload_<?php echo $data->_id ?>"></div>
                                    <div id="newComment_<?php echo $data->_id; ?>" style="display:none" class="paddinglrtp5">
                                        <div id="commentTextArea_<?php echo $data->_id; ?>" class="inputor commentplaceholder" contentEditable="true" onkeyup="getsnipetForComment(event, this, '<?php echo $data->_id; ?>');" onclick="OpenCommentbuttonArea('<?php echo $data->_id; ?>')" onfocus="OpenCommentbuttonArea('<?php echo $data->_id; ?>')" ontouchstart="OpenCommentbuttonArea('<?php echo $data->_id; ?>')"></div>
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

                                                <button id="savePostCommentButton_<?php echo $data->_id; ?>" onclick="savePostCommentByUserId('<?php echo $data->PostId; ?>', '<?php echo $data->PostType; ?>', '<?php echo $data->CategoryType; ?>', '<?php echo $data->NetworkId; ?>', '<?php echo $data->_id; ?>');" class="btn" data-loading-text="Loading...">Comment</button>
                                                <button id="cancelPostCommentButton_<?php echo $data->_id; ?>" onclick="cancelPostCommentByUserId('<?php echo $data->_id; ?>')" class="btn btn_gray"> Cancel</button>

                                            </div>
                                            <div id="commenterror_<?php echo $data->PostId; ?>" class="alert alert-error displayn" style="margin-left: 30px;margin-right: 157px;"></div>

                                        </div>
                                        <div>
                                            <ul class="qq-upload-list" id="uploadlist_<?php echo $data->_id ?>"></ul>
                                        </div>

                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(function() {
                                        var extensions = '"zip","jpg","jpeg","gif","mov","mp4","mp3","txt","doc","docx","pptx","pdf","ppt","xls","xlsx","avi","png","tiff","mov","flv"';
                                        if(isMobile|| UploadMedia==1)
                                        initializeFileUploader("postupload_<?php echo $data->_id ?>", '/post/upload', '10*1024*1024', extensions, 4, 'commentTextArea', '<?php echo $data->_id ?>', previewImage, appendErrorMessages, "uploadlist_<?php echo $data->_id ?>");
                                    });

                                </script>
                <?php } ?>
                        </div>
                    </div>
                </div>
            <?php
            } else {

                include 'advertisement_view.php';
            }}
            ?>
            <script type="text/javascript">
                var createdon = '<?php echo $data->CreatedOn->sec; ?>';

                $("#postitem_<?php echo $data->_id; ?>").show();
                if (g_pflag == 0) {
                    g_pflag = 1;
                    g_postIds = '<?php echo $data->PostId . "_" . $data->CategoryType; ?>';
                } else {
                    g_postIds = g_postIds + ',' + '<?php echo $data->PostId . "_" . $data->CategoryType; ?>';
                    g_pflag = 1;
                }
            <?php if ($data->IsPromoted == 0) { ?>
                    if (g_postDT != undefined && g_postDT != null) {
                        if (g_postDT < createdon) {
                            g_postDT = createdon;
                            g_iv = 1;
                            status = 0;
                        } else if (g_iv == 0) {
                            g_postDT = createdon;
                            g_iv = 1;
                            status = 0;
                        }
                    }
            <?php } ?>
                var postid = '<?php echo $data->_id; ?>';
                var divheight = $("#CommentBoxScrollPane_" + postid).height();

            </script>

            <script type="text/javascript">
                $(function() {
                    Custom.init();
                    if ($('#commentCount_<?php echo $data->PostId; ?>').length > 0) {
                        var commentArrowLeft = $('#commentCount_<?php echo $data->PostId; ?>').prev().find('img').position().left;
                        $('div#cId_<?php echo $data->_id; ?>.commentbox').append('<style>div#cId_<?php echo $data->_id; ?>.commentbox:before{left:' + commentArrowLeft + 'px}</style>');
                        $('div#cId_<?php echo $data->_id; ?>.commentbox').append('<style>div#cId_<?php echo $data->_id; ?>.commentbox:after{left:' + commentArrowLeft + 'px}</style>');
                    }
                    $('#post_content_<?php echo $data->_id; ?>').find('>p').each(function(key, ele) {
                        if ($(ele).prop("tagName") == 'p' || $(ele).prop("tagName") == 'P') {
                            if ($(ele).text().length == 0) {
                                $(ele).remove();
                            }
                        }
                    });
                    if (detectDevices()) {
                        $('.postmg_actions').removeClass().addClass("postmg_actions postmg_actions_mobile");
                    }
                });
                $('.grpIntro').live("click", function() {
                    var groupId = $(this).attr('data-id');
                    getGroupIntroPopUp(groupId);

                });

            <?php if (isset($data->WebUrls->Weburl)) { ?>
                    if (detectDevices()) {
                        $("#media_main_" + '<?php echo $data->_id; ?>').attr("style", "overflow:visible;");
                        $("#post_content_" + '<?php echo $data->_id; ?>').attr("style", "padding-right:40px;");
                        $("#imgsingle_" + '<?php echo $data->_id; ?>').attr("style", "margin-right:10px;");
                    }
            <?php } ?>

                $('#postitem_' + '<?php echo $data->_id; ?>').mousemove(function(event) {
                    var id = $(this).prop('id');
                    use4storiesinsertedid = id;


                });
            </script>

        <?php } ?>


        <?php
    } else {
        echo $stream;
    }
} catch (Exception $exc) {
    
}
?>
