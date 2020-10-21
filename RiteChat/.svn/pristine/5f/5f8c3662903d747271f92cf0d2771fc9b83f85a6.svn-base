
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
   

</div>
</div>

    
       
<div id="questions" game-id="<?php echo $gameDetails->_id; ?>" schedule-id="<?php echo $gameBean->gameScheduleId; ?>">
  
</div>
<script type="text/javascript">
   $(function(){
    Custom.init();
    $("#detailedLove,#detailedfolloworunfollow,#invitefriendsDetailed,#detailedComment,#sharesec,#news_detailedComment").on("click",function(){
        showLoginPopup();
    });
});

    </script>