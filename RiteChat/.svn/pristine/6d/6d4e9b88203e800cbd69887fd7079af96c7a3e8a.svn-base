<?php
if ($userEventsActivityListCount > 0) {
    ?>

    <div class="rightwidget borderbottom1 padding-bottom10" id="rightSideSectionSeperation3">
    <div class="rightwidgettitle paddingt12">
        <i class="spriteicon"><img class="r_events" src="/images/system/spacer.png"></i><span class="widgettitle">Events </span><i data-id="Events_DivId" class="fa fa-question helpmanagement helpicon helprelative pull-right marginTR6 tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="Events" ></i> 
    </div>
        
    <?php  $timezone =  Yii::app()->session['timezone'];
            foreach ($userEventsActivityList as $data) {
                
              
                     $eventStartDate = CommonUtility::convert_time_zone($data->StartDate->sec,$timezone,'','sec');
                    $eventEndDate = CommonUtility::convert_time_zone($data->EndDate->sec,$timezone,'','sec');
                
               // $eventStartDate=$data->StartDate;
               // $eventEndDate=$data->EndDate;
                ?>
    <div class="r_followersdiv">
        <div class="r_eventcontnent postdetail" style="cursor: pointer" data-postid="<?php echo $data->PostId;?>" data-categoryType="<?php echo $data->CategoryType;?>" data-postType="<?php echo $data->PostType;?>">
            <span>
               <?php 
               echo $normalConvertedText = trim(strip_tags($data->Title));
               ?>
            </span> - <?php
            if($eventStartDate ==  $eventEndDate){?>
               
               <?php  echo date("dS M", $eventStartDate); ?>
           <?php  }else{ ?>
            
           <?php  echo date("dS M", $eventStartDate); ?> - <?php echo date("dS M", $eventEndDate); ?>
            <?php } ?>
            </div>
        </div>
    <?php }      ?>
  </div>  
<?php } ?>