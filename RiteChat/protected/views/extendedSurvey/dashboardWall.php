<?php if(is_array($surveyObject)){    
    $dateFormat =  CommonUtility::getDateFormat();
    ?>   
      <?php foreach($surveyObject as $data){?>

   <li class="surveylist  " style="width: 494px; display: list-item; " id="survey_<?php echo $data->_id;?>">
     <div class="stream_title paddingt5lr10 " style="position: relative">
        
        <b><?php echo $data->SurveyTitle; ?></b>
                               
      </div>  
      <div class="mediaartifacts positionrelative ">
      <div class="media">
        <a class="pull-left marginzero extsurveyprofileicon">
            <img src="<?php echo $data->SurveyLogo; ?>">
        </a>
        <div class="media-body">
        <div class="padding10ltb">
        <?php echo $data->SurveyDescription; ?>
        </div>
        </div>
	</div>
    </div> 
    <div class="padding10 ">
    <div class="row-fluid">
<div class="span12" id="scheduleDates_<?php echo $data->_id;?>">
    <?php if(($data->SchedulesArray) != "noschedules"){ ?>
        
        <?php foreach ($data->SchedulesArray as $schedule) { error_log("==schedulearray==".print_r($schedule,1));?>

                <span id="scheduleId_<?php echo $schedule['_id'] ?>" class="g_scheduleDate g_scheduleDateGameWall"><?php echo date($dateFormat,CommonUtility::convert_date_zone($schedule['StartDate']->sec,Yii::app()->session['timezone'],  date_default_timezone_get()));  ?>  to  <?php echo date($dateFormat,CommonUtility::convert_date_zone($schedule['EndDate']->sec,Yii::app()->session['timezone'],  date_default_timezone_get()));  ?> 


                            <?php
                            if ($schedule['IsCurrentSchedule'] == 1) {

                               if ($schedule['EndDate']->sec >= time()) {

                                   ?>

                                    <span style="padding-left: 10px" data-surveyId="<?php echo $data->_id ?>" data-scheduleId="<?php echo $schedule['_id'] ?>"  class="deleteicon  cancelschedule"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Cancel Schedule"/></span>    


                                    <?php
                                }
                            } else {
                                if ($schedule['EndDate']->sec >= time() && $schedule['IsCancelSchedule'] == 0) {
                                    ?>
                                    <span style="padding-left: 10px" data-surveyId="<?php echo $data->_id ?>"  data-scheduleId="<?php echo $schedule['_id'] ?>"  class="deleteicon  cancelschedule"><img src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Cancel Schedule"/></span>     


                                    <?php
                                }
                            }
                            ?>
                </span>  <?php $data->SurveyedUsersCount += sizeof($schedule['SurveyTakenUsers']);
                    }
    }?>

</div>
</div>
        <div id="spinner_survey_<?php echo $data->_id;?>" style="position:relative;"></div>
<div class="padding8top">
<div class="media">
                           
 <div class="media-status_survey">
     <ul>
         <li><div class="statusminibox extquestionscount">
                 <span><?php echo $data->QuestionsCount; ?></span>
             </div>
             </li>
         <li><div class="statusminibox extuserscount">
                <span><?php echo $data->SurveyedUsersCount; ?></span>
             </div></li>
         
     </ul></div>
 </div>
</div>
 </div>
    <div style="border-bottom:0" class="extsurveyactions" >
        <?php if($data->SurveyRelatedGroupName != "Public"){ ?>
        <div class="surveymenuicons stream_title pull-left" style=" border-bottom:0"data-id="<?php echo $data->_id;?>" style="vertical-align: middle;">
            <b><?php echo $data->SurveyRelatedGroupName; ?></b>
        </div>      
        <?php } ?>
                          
            <div class="surveymenuicons pull-right " data-id="<?php echo $data->_id;?>" data-networkId="<?php echo $data->NetworkId; ?>">
            <ul >
            <li> 
            <a class="edit_icon" data-name="edit_survey"><img src="/images/system/spacer.png" class=" cursor" id="edit" data-placement="bottom" rel="tooltip"  data-original-title="Edit Survey"></a>
            </li>
            <li> 
            <a class="suspend_icon" data-name="suspend_survey"><img src="/images/system/spacer.png" class=" cursor" id="suspend" data-placement="bottom" rel="tooltip"  data-original-title="Suspend Survey"></a>
            </li>
            <li id="schedule_<?php echo $data->_id;?>"> 
            <a class="schedule_icon" data-name="schedule_survey"><img src="/images/system/spacer.png"  class=" cursor" id="schedule" data-placement="bottom" rel="tooltip"  data-original-title="Schedule Survey"></a>
            </li>    
            </ul>   </div>
                       
                        </div>
</li>
<script type="text/javascript">
$("[rel=tooltip]").tooltip();
</script>
 <?php }?>
<?php } else {
echo $surveyObject ;
        
}?>


    
