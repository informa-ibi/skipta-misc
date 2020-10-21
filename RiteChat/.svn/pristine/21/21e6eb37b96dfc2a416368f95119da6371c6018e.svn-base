<?php  
 if(is_object($featuredItems))
      { 
     try {
         
      

    foreach($featuredItems as $data){
      $title="";
?>
<div class="post item" style="width:100%;" id="postitem_<?php  echo $data->PostId; ?>" >
<div class="stream_widget marginT10" >
    <div class="profile_icon"><img src="<?php  echo $data->OriginalUserProfilePic ?>" > </div>
    <div class="post_widget" >
        <div class="stream_msg_box">
             <?php  $name=Yii::t('translation', 'CurbsideConsult');
             $name=strtolower($name);
             ?>
            <?php if($data->Type==2 || $data->Type==3){
                    if(isset($data->Title) && $data->Title!=""){
                        $title= "<span class='userprofilename'>".$data->Title."</span>"; 

                    }else{
                        $title="";

                    }
                   }
                 ?>
            <div class="stream_title paddingt5lr10" style="position: relative"> <a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php  echo $data->UserId?>"  style="cursor:pointer"><b><?php  echo $data->OriginalUserDisplayName?></b></a> 
                
                <?php if($data->CategoryType==1 || $data->CategoryType==8  ){
                echo ($data->CategoryType==1)?" created "."  ".$data->PostTypeString.$title." ":" created News";
                } 
                else if($data->CategoryType==9){
                 echo ($data->CategoryType==1)?" created "."  ".$data->PostTypeString.$title." ":" created Game"; 
                }
                
               else{
                 echo ($data->CategoryType==1)?" created "."  ".$data->PostTypeString.$title." ":" created $name"; 
                 }?>
                
                
                
                <i><?php  echo $data->OriginalPostPostedOn; ?></i>
               <div class="postmg_actions"  >
                    <i class="fa fa-chevron-down" data-toggle="dropdown" data-placement="right"></i>
                    <i class="fa fa-chevron-up" data-toggle="dropdown" data-placement="right"></i>
                    <div id="PostBlockOrRemove" class="dropdown-menu ">
                           <ul class="PostManagementActions featured"  data-postId="<?php  echo $data->PostId ?>" data-categoryType="<?php  echo $data->CategoryType ?>" data-networkId="<?php  echo $data->NetworkId ?>">
                            <li><a id="MarkAsFeatured_<?php  echo $data->PostId ?>"  class="featured m_featured" name="Featured"><span class="featuredicon"><img src="/images/system/spacer.png" /></span> Remove as Featured</a></li>
                           
                           </ul>
                        
                     </div>
                </div>
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
                        <a  class="pull-left img_single"><img src="<?php  echo $data->ArtifactIcon ?>"  ></a>
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
                                      <li class="clearboth e_datelist"><div class="e_date"><?php  echo $data->StartTime ?> - <?php  echo $data->EndTime ?></div></li>
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
                                 
                                 ?>
                            <!-- Nested media object -->
                           <?php  } ?>
                            
                            
                               <?php  }?> </div><?php  }else{ ?>
                            <div id="<?php  echo "surveyArea_".$data->PostId ?>">
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
                             <a  class="pull-left  pull-left1 img_more " ><div  class='<?php echo $videoclassName; ?>'><img src="/images/icons/video_icon.png"></div><img src="<?php  echo $data->ArtifactIcon ?>"></a>  
                                
                                </div>
                                           <?php  }}
                                 ?>
                                                     
                            <div class="media-body">
                                <div class="surveyquestion" ><?php  echo $data->Description ?></div>
                                <div class="row-fluid ">
                                    <div class="span12">
                                        1)  <?php  echo $data->OptionOne ?>
                                    </div>
                                </div>
                                <div class="row-fluid " >
                                    <div class="span12">
                                        2)  <?php  echo $data->OptionTwo ?>
                                    </div>
                                </div>
                                <div class="row-fluid ">
                                    <div class="span12">
                                        3)  <?php  echo $data->OptionThree ?>
                                    </div>
                                </div>
                                <?php if(!empty($data->OptionFour)){ ?>
                                <div class="row-fluid ">
                                    <div class="span12">
                                        4)  <?php  echo $data->OptionFour ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                                </div>
                                <?php  } ?>
                              </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
    <?php } }catch (Exception $exc) {
         
     }?>
<script type="text/javascript">
   
</script>
    <?php 
      }else{
          echo $featuredItems;
      }
?>
