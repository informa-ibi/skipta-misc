<?php $date = date('Y-m-d');
$sdate = new DateTime($data->StartDate);
$exdate = new DateTime($data->ExpiryDate);
$sdate=$sdate->format('Y-m-d');
$exdate =$exdate->format('Y-m-d');
$redirectUrl=$data->RedirectUrl;
if($data->AdType==3){
    
    $requestedFieldsArray=  explode(",", $data->RequestedFields);
    $QueryParms;
    $md5=md5($this->tinyObject->UserId."_".$data->AdvertisementId);
    foreach($requestedFieldsArray as  $value){
        $customUserId=null;
         $customdisplayName=null;
         if ($data->RequestedParams != "" && $data->RequestedParams != null) {
            $reqParms = explode(',', $data->RequestedParams);
            
            foreach ($reqParms as $param) {
                $paramList = explode(':', $param);
                if (trim($paramList[0]) == "UserId") {
                   $customUserId=$paramList[1];
                }
                if (trim($paramList[0]) == "Display Name") {
                   $customdisplayName=$paramList[1];
                }
            }
        }

        $QueryParms=($QueryParms==""?$QueryParms:$QueryParms."&");
       if($value=="UserId"){
           if($customUserId==null){
              $QueryParms.=trim($value)."=".$md5;   
           }
           else{
               $QueryParms.=trim($customUserId)."=".$md5;
           }
          
       }
       if(trim($value)=="Display Name"){
           if($customdisplayName==null){
             $QueryParms.=trim($value)."=".$this->tinyObject->DisplayName;   
           }
           else{
              $QueryParms.=trim($customdisplayName)."=".$this->tinyObject->DisplayName;     
           }
            
       }
       if(trim($value)=="Email"){
           $QueryParms.=trim($value)."=".Yii::app()->session['Email'];  
       }
    }
     $QueryParms=str_replace(' ', '', $QueryParms);
    
   if(stristr($redirectUrl,"?")==""){
      $redirectUrl.="?".$QueryParms."&NeoId=".$md5; 
   } else{
      $redirectUrl.="&".$QueryParms."&NeoId=".$md5;  
   } 
  
}
$bannerTemplateId=null;
if($data->BannerTemplate!=null && $data->BannerTemplate!=""){
    $bannerTemplateId=$data->BannerTemplate;
}
$canDisplayAdd = ($adDisplay=$data->IsNotifiable==1 && $sdate<=$date && $date<=$exdate)?true:false;
if($canDisplayAdd){
?>
    <div class="post item <?php echo (isset($data->IsPromoted) && $data->IsPromoted == 1) ? 'promoted' : ''; ?>" style="width:100%;display:none" id="postitem_<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>">
        <div class="stream_widget marginT10 positionrelative" >
            <?php include 'stream_profile_image.php'; ?>
            <div class="post_widget" data-postid="<?php echo $data->PostId ?>" data-postType="<?php echo $data->PostType; ?>">
                <div class="stream_msg_box">
                    <?php include 'stream_header_ads.php'; ?>
                    <div class="padding10"> 
                           <?php if(!(isset($data->BannerOptions)) || $data->BannerOptions =="OnlyImage"){ ?>
                              <?php if($data->Resource['ImpressionTag']!=null && $data->Resource['ImpressionTag']!=""){?> <img src="<?php echo $data->Resource['ImpressionTag'].replace("<%RandomNumber%>", num) ?>" id="InpressionImage" border="0" height="1" width="1" alt="Advertisement" /><?php }?>
                             <a id="aId" <?php if(stristr($data->RedirectUrl,YII::app()->params['ServerURL'])==""){echo 'target="_blank"'; }  ?> data-adid="" onclick="treackAdUser('<?php echo $data->PostId ?>')" data-type="img" href="<?php echo $redirectUrl ?>" style="text-decoration:none">
                             <img src="<?php echo $data->Resource['Uri'] ?>" <?php if($data->Resource['ClickTag']!=null && $data->Resource['ClickTag']!=""){?>onclick="GenzymeSquareClickTag('<?php echo $data->Resource['ClickTag'] ?>');" ><?php }?> /></a>
                           
                           <?php } else if($data->BannerOptions =="ImageWithText"){ ?> 
                             <a id="aId" <?php if(stristr($data->RedirectUrl,YII::app()->params['ServerURL'])==""){echo 'target="_blank"'; }  ?> data-adid="" onclick="treackAdUser('<?php echo $data->PostId ?>')" data-type="img" href="<?php echo $redirectUrl ?>"> 
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
                                             <?php if($data->Resource['ImpressionTag']!=null && $data->Resource['ImpressionTag']!=""){?> <img src="<?php echo $data->Resource['ImpressionTag'].replace("<%RandomNumber%>", num); ?>" id="InpressionImage" border="0" height="1" width="1" alt="Advertisement" /><?php }?>
                                           
                                             <img src="<?php echo $data->Resource['Uri'] ?>" <?php if($data->Resource['ClickTag']!=null && $data->Resource['ClickTag']!=""){?>onclick="GenzymeSquareClickTag('<?php echo $data->Resource['ClickTag'] ?>');" ><?php }?> />
                                     </div>
                                 
                    </div> </a><?php } else if($data->BannerOptions =="OnlyText"){ ?> 
                        <a id="aId" <?php if(stristr($data->RedirectUrl,YII::app()->params['ServerURL'])==""){echo 'target="_blank"'; }  ?> data-adid="" onclick="treackAdUser('<?php echo $data->PostId ?>')" data-type="img" href="<?php echo $redirectUrl ?>" style="text-decoration:none"> 
                        <div class="addbanner addbannersection">
                                         <div class="">
                                             <div class="addbannertable">
                                                 <div <?php if($data->Resource['ClickTag']!=null && $data->Resource['ClickTag']!=""){?>onclick="GenzymeSquareClickTag('<?php echo $data->Resource['ClickTag'] ?>');"<?php }?> class="addbannercell addbannerbottom">
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
                                             <?php if($data->Resource['ImpressionTag']!=null && $data->Resource['ImpressionTag']!=""){?> <img src="<?php echo $data->Resource['ImpressionTag'].replace("<%RandomNumber%>", num); ?>" id="InpressionImage" border="0" height="1" width="1" alt="Advertisement" /><?php }?>
                                     </div>
                                 
                    </div></a>
                        <?php } ?> 
                </div>
            </div>
        </div>
    </div>
<?php } ?>