
<?php $count = 0;


if(!empty($gameDetails->_id)){
    

?>

<h2 class="pagetitle" ><?php echo Yii::t('translation','Games'); ?></h2>
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
                $label = Yii::t('translation','Play_Now')." <i class='fa fa-chevron-circle-right'></i>";
            }
            else if($gameBean->gameStatus=="resume"){
                 $class = "btn btnresume";
                  $label = Yii::t('translation','Resume')." <i class='fa fa-chevron-circle-right'></i>";
            }
           else if($gameBean->gameStatus=="view") {
               $class = "btn btnviewanswers"; 
                $label = Yii::t('translation','View')." <i class='fa fa-chevron-circle-right'></i>";
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
          <div class="alignright clearboth" id="game_descriptionMore" style="display:<?php echo strlen($gameDetails->GameDescription)>240?'block':'none'; ?>"> <a id="more" class="more"><?php echo Yii::t('translation','more'); ?> <i class="fa fa-chevron-circle-right"></i></a></div>
     <div class="alignright clearboth" > <a style="display:none"  class="moreup" id="moreup"><?php echo Yii::t('translation','close'); ?> <i class="fa fa-chevron-circle-up"></i></a></div>
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
             <div class="menuboxpopupHeader"><?php echo Yii::t('translation','Leading_Individuals'); ?></div>
     
     <div class="media">
                                <a class="pull-left marginzero smallprofileicon" id="gameprofileimage" data-name="<?php echo $gameBean->uniqueHandle; ?>">
                                    <img  src="<?php if(isset($gameBean->highestScoreUserPicture)) echo $gameBean->highestScoreUserPicture; else{echo '/upload/profile/user_noimage.png';}?>">
                                </a>
                               
                                <div class="media-body">                                   
                                    
                                    <div class="m_title"><a style="cursor:pointer" data-id="<?php echo $gameBean->highestGameUserId; ?>" class="userprofilename" data-streamId="<?php  echo $data->_id; ?>" data-name="<?php echo $gameBean->uniqueHandle; ?>"><?php echo $gameBean->highestScoreUserName; ?></a></div>
                                    <div class="m_day"><?php echo $gameDetails->GameHighestScore; ?> <span><?php echo Yii::t('translation','Points'); ?></span></div>
                                </div>
                             </div>
     
     </div>
     
     </li>
         
       
     
     <li class="normal"  onclick="<?php if (Yii::app()->session['IsAdmin'] == 1) echo 'showQuestion()'?>">
     <div class="menubox">
         <div class="menuboxpopup"><span>#<?php echo Yii::t('translation','Questions'); ?></span></div>
     <div id="GroupPostCount" class="groupmenucount"><?php echo $gameDetails->QuestionsCount; ?></div>
     <div class="conversationmenu questionsmenu"><img src="/images/system/spacer.png"></div>

     </div>

     </li>
       <li class="normal" >
     <div class="menubox">
         <div class="menuboxpopup"><span>#<?php echo Yii::t('translation','Players'); ?></span></div>
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
      <a class="follow_a"><i><img class="tooltiplink <?php echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $gameDetails->Followers)?'follow':'unfollow' ?>" src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="<?php  echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $gameDetails->Followers)?Yii::t('translation','UnFollow'):Yii::t('translation','Follow') ?>"></i><b><?php echo count($gameDetails->Followers) ?></b></a>
 <a><i><img data-original-title="<?php echo Yii::t('translation','Invite'); ?>" rel="tooltip" data-placement="bottom" class=" tooltiplink cursor invite_frds" src="/images/system/spacer.png"></i></a>
 <span class="cursor"><i><img  class=" tooltiplink cursor <?php echo in_array(Yii::app()->session['TinyUserCollectionObj']['UserId'], $gameDetails->Love)?'likes':'unlikes' ?>"   data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Love'); ?>" src="/images/system/spacer.png"></i><b id="streamLoveCount_<?php  echo $gameDetails->_id; ?>"><?php  echo count($gameDetails->Love)?></b></span>
 <?php   if(!$gameDetails->DisableComments){
                
                if(count($gameDetails->Comments)>0){
                    foreach ($gameDetails->Comments as $key=>$value) {
                        
                        if (!(isset($value ['IsBlockedWordExist']) && $value ['IsBlockedWordExist']==1)) {
                            $count++;
                        }
                    }
                }
      ?>
         <span><i ><img id="detailedComment" src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Comment'); ?>" class=" cursor tooltiplink  <?php  if($gameDetails->Type!=5){?><?php echo $gameBean->isCommented?'commented':'comments'?><?php }else{?>comments1 postdetail<?php }?>" <?php  if($gameDetails->Type ==5){?> data-id="<?php echo $gameDetails->_id;?>" data-postid="<?php  echo $gameDetails->_id ?>" data-postType="<?php  echo $gameDetails->Type;?>" data-categoryType="<?php $gameBean->CategoryType?>" <?php } ?> ></i><b id="det_commentCount_<?php  echo $gameDetails->_id; ?>"><?php  echo $count; ?></b></span>
                
                  <?php  }?>

           
             
        </div>
   

</div>
</div>

    
       
<div id="questions" game-id="<?php echo $gameDetails->_id; ?>" schedule-id="<?php echo $gameBean->gameScheduleId; ?>">
  
   <?php 
  $question = $gameDetails->Questions[0];
 // echo print_r($question,1);
  $resource = $question['Resources'];
   if(count($resource)==0){
   
   ?>
    
    <div id="gameAns_1" class="paddingtop6">
  <div class="row-fluid">
  <div class="span12">
  <div class="questiondiv positionrelative">
  <div class="qusetionNumber">1.</div>
  <div class="questiontext"><?php echo $question["Question"]; ?></div>
    </div>
  </div>
  </div>
      <div class="row-fluid padding8top">
<div class="span12">
     <?php if(isset($question["OptionB"]) || $question["OptionB"]!="" ){?>
<div class="span6 "> <div class="answerdiv positionrelative"><div class="answertext">
 <div class="normalanswer positionrelative">
     <div class="answerradio">
         <span class="answerdummyclass">
         <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" value="A" class="styled" name="question_1">
  
         </span>
 </div>
<div class="inneranswer"> <?php echo $question["OptionA"]; ?></div>
 </div>
 </div>

  </div></div>
     <?php }?>
     <?php if(isset($question["OptionB"]) || $question["OptionB"]!="" ){?>
    <div class="span6 "> <div class="answerdiv answerdivright positionrelative"><div class="answertextright">
 <div class="normalanswer positionrelative">
 <div class="answerradio">
              <span class="answerdummyclass">

     <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" class="styled" value="B" name="question_1">
              </span>
 </div>
<div class="inneranswer"><?php echo $question["OptionB"]; ?></div>
 </div>
 </div>

  </div>
</div>
     <?php } ?>
</div>

</div>
         <?php if($question["OptionC"]!="" || $question["OptionD"]!="" ){?>
    <div class="row-fluid padding8top">
<div class="span12">
      <?php if(isset($question["OptionC"]) || $question["OptionC"]!="" ){?>
     <div class="span6 "> <div class="answerdiv positionrelative"><div class="answertext">
 <div class="normalanswer positionrelative">
 <div class="answerradio">
              <span  class="answerdummyclass">

     <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" class="styled " value="C" name="question_1">
              </span>
 </div>

<div class="inneranswer"><?php echo $question["OptionC"]; ?></div>
 </div>
 </div>

  </div>
</div>
      <?php } ?>
      <?php if(isset($question["OptionD"]) || $question["OptionD"]!="" ){?>
     <div class="span6 "> <div class="answerdiv answerdivright positionrelative"><div class="answertextright">
 <div class="positionrelative">
 <div class="answerradio">
              <span  class="answerdummyclass">

     <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" class="styled " value="D" name="question_1">
              </span>
 </div>

<div class="inneranswer"><?php echo $question["OptionD"]; ?></div>
 </div>
 </div>

  </div>
</div>
      <?php }?>
 </div>

</div> 
         <?php }?>
         </div>
    <?php }else{
         $extension =  $resource['Extension'];
        ?>
    <div  class="padding8top clearcontent" style="padding-bottom:10px">
    <div class="row-fluid">
  <div class="padding-bottom5">
  <div class="questiondiv positionrelative">
  <div class="qusetionNumber">1.</div>
  <div class="questiontext"> <?php echo $question["Question"]; ?></div>
     </div>
  </div>
  </div>
          <div class="clearboth">
              <div style="position: relative;width:280px;float:left;" class="marginautotop">
                  <div class="positionrelative migrationimagestyle" style="display: table;margin:auto;">
             
                      <?php
     if($extension == "mp4" || $extension == "avi" || $extension == "flv" || $extension == "mov" || $extension == "mp3"){
         
         ?>
      
        <div id="questionVideo_<?php echo $sno;?>" video-id="<?php echo  $resource['Uri']?>" class="gameVideo" ><img src="/images/icons/video_icon.png" style="position: absolute;left:40%;top:40%"><img src="<?php echo  $resource['ThumbNailImage']?>"/></div>
    <?php     
     }else{
         ?>
           <img src="<?php echo $resource['ThumbNailImage']?>">
        <?php
     }
     ?>   
                      
                      
                      
                      
                    
                          </div>
      </div>
              <div style="overflow:hidden">
                  <div class="row-fluid">
<div class="span12">
     <?php if($question['OptionA']!="") {?>
    <div class="row-fluid">
<div class="span12 "> <div class="answerdiv answerdivright positionrelative"><div class="answertextright">
 <div class="normalanswer positionrelative">
     <div class="answerradio">
                  <span data-option="A" data-id="551a9c069f8ccb65588b4568" class="answerdummyclass">

         <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" class="styled" name="question_1">
                  </span>
     </div>
 
<div class="inneranswer"><?php echo $question["OptionA"]; ?></div>
 </div>
 </div>

  </div>
</div></div>
     <?php } ?>
      <?php if($question['OptionB']!="") {?>
     <div class="row-fluid ">
    <div class="span12 "> <div class="answerdiv answerdivright positionrelative"><div class="answertextright">
 <div class="normalanswer positionrelative">
 <div class="answerradio">
              <span data-option="B" data-id="551a9c069f8ccb65588b4568" class="answerdummyclass">

     <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" class="styled " name="question_1">
              </span>
 </div>
 
<div class="inneranswer"> <?php echo $question["OptionB"]; ?></div>
 </div>
 </div>

  </div>
</div></div>
      <?php } ?>
  <?php if($question['OptionC']!="") {?>
          <div class="row-fluid ">
    <div class="span12 "> <div class="answerdiv answerdivright positionrelative"><div class="answertextright">
 <div class="normalanswer positionrelative">
 <div class="answerradio">
              <span data-option="C" data-id="551a9c069f8ccb65588b4568" class="answerdummyclass">

     <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" class="styled " name="question_1">
              </span>
 </div>
 
<div class="inneranswer"><?php echo $question["OptionC"]; ?></div>
 </div>
 </div>

  </div>
</div></div>
  <?php } ?>
      <?php if($question['OptionD']!="") {?>
          <div class="row-fluid ">
    <div class="span12 "> <div class="answerdiv answerdivright positionrelative"><div class="answertextright">
 <div class="normalanswer positionrelative">
 <div class="answerradio">
              <span data-option="D" data-id="551a9c069f8ccb65588b4568" class="answerdummyclass">

     <span class="radio" style="background-position: 0px 0px;"></span><input type="radio" class="styled " name="question_1">
              </span>
 </div>
 
<div class="inneranswer"><?php echo $question["OptionD"]; ?></div>
 </div>
 </div>

  </div>
</div></div>
      <?php } ?>
      
</div>
</div></div>
</div>       
   </div> 
       

    <?php } ?>

              

</div>
<script type="text/javascript">
   
   $(function(){
    Custom.init();
    $("#detailedLove,#detailedfolloworunfollow,#invitefriendsDetailed,#detailedComment,#sharesec,#news_detailedComment").on("click",function(){
        showLoginPopup();
    });
});

    </script>
<?php }else{
    
      $errMessage = Yii::t("translation","Ex_Msg_NoGame");
    
    ?>
<div  id="streamsectionarea_error" class="" style="padding-bottom: 40px">
            <div class="ext_surveybox NPF_outside lineheightsurvey">
                <center class="ndm" id="errorTitle" ><?php echo $errMessage; ?></center>
            </div>
        </div>
    <?php
}
?>