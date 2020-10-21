<?php 
$bannerTemplateId=null;
if($data->BannerTemplate!=null && $data->BannerTemplate!=""){
    $bannerTemplateId=$data->BannerTemplate;
}
if($data->IsNotifiable){
    $num = rand(0,100000000000000) + "";
?>
    <div class="stream_widget marginT10 positionrelative <?php if(!empty($displayStream)){ echo "news_advt";} ?>" >
            <?php
            if(empty($displayStream)){
               include 'stream_profile_image.php'; 
            }
             ?>
        <div class="post_widget impressionDiv" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>"> 
                <div class="stream_msg_box">
                    <?php if(empty($displayStream)){
                    include 'stream_header_ads.php'; } ?>
                    <div class="padding10"> 
                           <?php if($data->BannerOptions =="OnlyImage"){ ?>
                              <?php if($data->ImpressionTag!=null && $data->ImpressionTag=""){?> <img src="<?php echo str_replace("<%RandomNumber%>", $num, $data->ImpressionTag) ?>" id="InpressionImage" border="0" height="1" width="1" alt="Advertisement" /><?php }?>
                             <a id="aId" <?php if(stristr($data->RedirectUrl,YII::app()->params['ServerURL'])==""){echo 'target="_blank"'; }  ?> data-adid="" onclick="treackAdUser('<?php echo $data->PostId ?>')" data-type="img" href="<?php echo $data->RedirectUrl ?>" style="text-decoration:none">
                             <?php 
                                $BannerImage = "";
                                $Banner_En = "";
                                $Banner_First = "";
                                foreach ($data->Uploads as $key=>$upload) {
                                    if($key==0 || $Banner_First!=""){
                                        $Banner_First = $upload['Url'];
                                    }
                                    if($upload['Language']==$userLanguage){
                                        $BannerImage = $upload['Url'];
                                        break;;
                                    }else if($upload['Language']=="en"){
                                        $Banner_En = $upload['Url'];
                                    }
                                }
                                if($BannerImage == "" && $Banner_En!=""){
                                    $BannerImage = $Banner_En;
                                }else if($BannerImage == "" && $Banner_En==""){
                                    $BannerImage = $Banner_First;
                                }
                             ?>
                                 <img src="<?php echo $BannerImage ?>" <?php if($data->ClickTag!=null && $data->ClickTag!=""){?>onclick="GenzymeSquareClickTag('<?php echo $data->ClickTag ?>');" ><?php }?> /></a>
                           
                           <?php } else if($data->BannerOptions =="ImageWithText"){ ?> 
                             <a id="aId" <?php if(stristr($data->RedirectUrl,YII::app()->params['ServerURL'])==""){echo 'target="_blank"'; }  ?> data-adid="" onclick="treackAdUser('<?php echo $data->PostId ?>')" data-type="img" href="<?php echo $data->RedirectUrl ?>"> 
                             <div class="addbanner addbannersection<?php echo $bannerTemplateId; ?>">
                                         <div class="addbannercontentarea">
                                             <div class="addbannertable">
                                                 <div class="addbannercell addbannerbottom">
                                                     <div class="addbannerpadding">
                                                         
                                                         <?php echo $data->BannerTitle; ?>
                                                     </div>
                                                     <div class="addbannerpadding">
                                                         
                                                         <?php echo $data->BannerContent; ?>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         
                                         <div class="boxborder boxborder_active">
                                             <?php if($data->ImpressionTag!=null && $data->ImpressionTag!=""){?> <img src="<?php echo str_replace("<%RandomNumber%>", $num, $data->ImpressionTag); ?>" id="InpressionImage" border="0" height="1" width="1" alt="Advertisement" /><?php }?>
                                           <?php 
                                                $BannerImage = "";
                                                $Banner_En = "";
                                                $Banner_First = "";
                                                foreach ($data->Banners as $key=>$upload) {
                                                    if($key==0 || $Banner_First!=""){
                                                        $Banner_First = $upload['Url'];
                                                    }
                                                    if($upload['Language']==$userLanguage){
                                                        $BannerImage = $upload['Url'];
                                                        break;;
                                                    }else if($upload['Language']=="en"){
                                                        $Banner_En = $upload['Url'];
                                                    }
                                                }
                                                if($BannerImage == "" && $Banner_En!=""){
                                                    $BannerImage = $Banner_En;
                                                }else if($BannerImage == "" && $Banner_En==""){
                                                    $BannerImage = $Banner_First;
                                                }
                                             ?>
                                             <img src="<?php echo $BannerImage ?>" <?php if($data->ClickTag!=null && $data->ClickTag!=""){?>onclick="GenzymeSquareClickTag('<?php echo $data->ClickTag ?>');" <?php }?> />
                                     </div>
                                 
                    </div> </a><?php } else if($data->BannerOptions =="OnlyText"){ ?> 
                        <a id="aId" <?php if(stristr($data->RedirectUrl,YII::app()->params['ServerURL'])==""){echo 'target="_blank"'; }  ?> data-adid="" onclick="treackAdUser('<?php echo $data->PostId ?>')" data-type="img" href="<?php echo $data->RedirectUrl ?>" style="text-decoration:none"> 
                        <div class="addbanner addbannersection">
                                         <div class="">
                                             <div class="addbannertable">
                                                 <div <?php if($data->ClickTag!=null && $data->ClickTag!=""){?>onclick="GenzymeSquareClickTag('<?php echo $data->ClickTag ?>');"<?php }?> class="addbannercell addbannerbottom">
                                                     <div class="addbannerpadding">
                                                         
                                                         <?php echo $data->BannerTitle; ?>
                                                     </div>
                                                     <div class="addbannerpadding">
                                                         
                                                         <?php echo $data->BannerContent; ?>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         
                                         <div class="boxborder boxborder_active">
                                             <?php if($data->ImpressionTag!=null && $data->ImpressionTag!=""){?> <img src="<?php echo str_replace("<%RandomNumber%>", $num, $data->ImpressionTag); ?>" id="InpressionImage" border="0" height="1" width="1" alt="Advertisement" /><?php }?>
                                     </div>
                                 
                    </div></a>
                        <?php }else{
                             
                              $streamBund = $data->StreamBundle;
                              $replaceStr = str_replace("<%RandomNumber%>", $num, $streamBund);
                            ?> 
                             
                             <div  id="StreamBundleAds" onclick="trackAd(this)"> 
                                 <?php if(stristr($data->StreamBundle,"<iframe")==""){  ?> 
                                 <center>
                                 <iframe width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0"
frameborder="0" scrolling="no" bordercolor='#000000' src="/advertisements/renderscriptad?id=<?php echo $data->_id?>"></iframe>
                                 </center>
                                 <?php }else{
                                   echo $replaceStr;  
                                 }?>
                              </div>
                             
                          <?php }?>  
                </div>
            </div>
      </div>
      </div>

<?php } ?>
