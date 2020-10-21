<?php if($currentScheduleGameCount>0){?>
<div id="rightSideSectionSeperation3" class="rightwidget borderbottom1 padding-bottom10">
    <div class="rightwidgettitle paddingt12">
        <i class="spriteicon"><img src="/images/system/spacer.png" class="r_games"></i><span class="widgettitle">Game </span><i data-original-title="Game" rel="tooltip" data-placement="bottom" class="fa fa-question helpmanagement helpicon helprelative pull-right marginTR6 tooltiplink" data-id="CurrentGame_DivId"></i> 
    </div>
            <div class="border3">
            <div class=" positionrelative gameDetailView right_widget_game10" data-gamescheduleid="<?php echo $currentScheduleGame->ScheduleId  ?>" data-gamename="<?php echo $currentScheduleGame->GameName ?>">
                <div class="right_widget_gameTitle"><?php echo $currentScheduleGame->GameName ?></div>
                <div class="positionrelative gameboxresults">
                    <div class="pull-left gamewidgetimg">
                        <div>
                            <img src="<?php echo YII::app()->params['ServerURL'].$currentScheduleGame->GameBannerImage ?>">
                        </div>
                        <div class="gamebutton">
                            <?php if($currentScheduleGame->GameStatus == 'play'){?>
                               <button id="gameBtn" type="button" class="btn btnplay btnplaymini gameStatusView" data-gamescheduleid="<?php echo $currentScheduleGame->ScheduleId  ?>" data-gameid="<?php echo $currentScheduleGame->GameId  ?>"  data-gamename="<?php echo $currentScheduleGame->GameName ?>" data-mode="play" >Play Now <i class="fa fa-chevron-circle-right"></i></button>
                        <?php }elseif ($currentScheduleGame->GameStatus == 'resume') { ?>
                              <button id="gameBtn" type="button" class="btn btnresume btnplaymini gameStatusView " data-gamescheduleid="<?php echo $currentScheduleGame->ScheduleId  ?>" data-gameid="<?php echo $currentScheduleGame->GameId  ?>"  data-gamename="<?php echo $currentScheduleGame->GameName ?>" data-mode="resume" >Resume <i class="fa fa-chevron-circle-right"></i></button>  
                        <?php } elseif ($currentScheduleGame->GameStatus == 'view') {?>
                              <button id="gameBtn" class="btn btnviewanswers gameStatusView" type="button" data-gamescheduleid="<?php echo $currentScheduleGame->ScheduleId  ?>" data-gameid="<?php echo $currentScheduleGame->GameId  ?>"  data-gamename="<?php echo $currentScheduleGame->GameName ?>" data-mode="view">View <i class="fa fa-chevron-circle-right"></i> </button>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="right_widget_gameDesc">
                        <?php echo strlen ($currentScheduleGame->GameDescription) > 140 ? substr($currentScheduleGame->GameDescription, 0, 140) : $currentScheduleGame->GameDescription; ?>
                    <?php if (strlen($currentScheduleGame->GameDescription) > 140) { ?> <i id="moreicon" data-original-title="See More" rel="tooltip" data-gamescheduleid="<?php echo $currentScheduleGame->ScheduleId  ?>" data-gameid="<?php echo $currentScheduleGame->GameId  ?>"  data-gamename="<?php echo $currentScheduleGame->GameName ?>" data-mode="view" class="fa fa-ellipsis-h moreicon moreiconcolor"></i><?php } ?>
                    <div class="media-status gamewidgetmedia-status">
                        <ul>
                            <li><div class="statusminibox">
                                    <div class="statustitle"># Questions</div>
                                    <div class="statuscount"><?php echo $currentScheduleGame->QuestionsCount ?></div>
                                </div></li>
                            <li><div class="statusminibox">
                                    <div class="statustitle"># Players</div>
                                    <div class="statuscount"><?php echo $currentScheduleGame->PlayersCount ?></div>
                                </div></li>

                        </ul>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div> 
</div> 
<?php } ?>
<script type="text/javascript">
     $('.gameDetailView').live("click",
        function(){
             //var gameId = $(this).attr('data-gameid');
//             var gameName = $(this).attr('data-gamename');
//             var scheduleGameId = $(this).attr('data-gamescheduleid');
//             window.location="/"+gameName+"/"+scheduleGameId+"/details/game";
        }
    );

    $("#gameBtn").mouseover(function(){
        $('.gameDetailView').die();
    }).mouseout(function(){
        $('.gameDetailView').live("click",
        function(){
             //var gameId = $(this).attr('data-gameid');
//             var gameName = $(this).attr('data-gamename');
//             var scheduleGameId = $(this).attr('data-gamescheduleid');
//             window.location="/"+gameName+"/"+scheduleGameId+"/details/game";
        }
    );
    });
    
    $("#gameBtn").bind('click',function(){
        var gameName = $(this).attr('data-gamename');
        var gameMode = $(this).attr('data-mode');
        var scheduleGameId = $(this).attr('data-gamescheduleid');
        window.location="/"+gameName+"/"+scheduleGameId+"/"+gameMode+"/"+"game";
    });
    
   $("#moreicon").bind('click',function(){
        var gameName = $(this).attr('data-gamename');
        var gameMode = $(this).attr('data-mode');
        var scheduleGameId = $(this).attr('data-gamescheduleid');
        window.location="/"+gameName+"/"+scheduleGameId+"/"+gameMode+"/"+"game";
    });

</script>