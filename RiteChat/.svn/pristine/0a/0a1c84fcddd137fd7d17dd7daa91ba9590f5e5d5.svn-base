

<div class="row-fluid " id="postDetailedTitle">
     <div class="span6 "><h2 class="pagetitle"><?php echo Yii::t('translation','JobDetail');?></h2>
    
     </div>
     </div>
<?php

foreach($jobDetails as $jobDetail){
    
    ?>

<div class="woomarkLi" id="newsDetailedwidget">

<div class="customwidget_outer profilebox">
<div class="customwidget customwidgetdetail stream_contentjobs">
<div class="stream_title stream_titlenews paddingt5lr10"><b><?php echo $jobDetail['JobTitle']?> - </b><i> <?php echo $jobDetail['JobPosition'] ?></i> </div>


<div class="customcontentarea customwidgetdetailcontent media " style="margin:0;padding:0;">
    <div class="cust_content media-body" style="padding-right:10px;padding-left:10px" ><?php echo $jobDetail['Industry']?></div>
 
    <div class="media-body " style="padding-right:10px;padding-left:10px">  <span class="m_day"><?php echo CommonUtility::styleDateTime(strtotime($jobDetail['CreatedDate']));?></span>
    <div> <b><?php echo $jobDetail['Category']?></b></div>
</div>

<div class="cust_content media-body" ><?php echo $jobDetail['JobDescription']?></div>



<div id="stream_view_spinner_<?php echo $jobDetail['id']; ?>"></div>


 </div>

<?php?>
 
</div>

                        
          </div>
</div>

<?php }?>
