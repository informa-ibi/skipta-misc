<?php if(is_array($jobs))
{
foreach ($jobs as $job ){?>
<?php $time=strtotime($job['CreatedDate'])?>
<?php if($job['Source'] != "hec"){?>
<li class="jobsList" id="<?php echo $job['id']; ?>" data-jobid="<?php echo $job['id']; ?>" data-IsIframe="<?php echo isset($job['IframeUrl'])?1:0 ?>">

        <div class="post item" >
 <span class="grouppostspinner" id="groupfollowSpinLoader_<?php echo $job['id']; ?>"></span>

 <div class="stream_career_box">


        <div  style="cursor: pointer;position:relative;;padding-right:30px" class="stream_title stream_titlenews paddingt5lr10"> <b id="groupName" data-id="<?php echo $job['id'] ?>"   class="group"><?php echo $job['JobTitle'] ?> - </b><i> <?php echo $job['JobPosition'] ?></i>
        <div style="position: absolute;right:5px;top:4px">
        <div style="margin-right:0;"  class="postmg_actions" data-jobid="<?php echo $job['id']; ?>">
                    <i class="fa fa-chevron-down" data-toggle="dropdown" data-placement="right"></i>
                    <i class="fa fa-chevron-up" data-toggle="dropdown" data-placement="right"></i>
                    <div class="dropdown-menu margindropdown">
                         <ul class="PostManagementActions" data-jobid="<?php echo $job['id']; ?>"  >

                            <?php if (Yii::app()->session['IsAdmin'] == 1) { ?><li class="career_droplist"><a class="copyurl"><span class="copyicon"><img src="/images/system/spacer.png" /></span> Copy URL</a></li><?php } ?>

                         </ul>
                        </div>
        </div>
        </div>
            </div>
     </div>

        <div class="stream_content stream_contentjobs">


            <div class="media" data-id="<?php echo $job['id'] ?>">
            <div class="media-body">
                   <b><?php echo $job['Category']?></b> -      <?php echo $job['Industry']?>
                            </div>
                <div class="media-body">
                    <?php if(isset($job['IframeUrl'])) {?>
                    <?php if(isset($job['SnippetDescription']) && !empty($job['SnippetDescription'])){?>
                        <a href="<?php echo $job['IframeUrl']?>" target="_blank"> <?php echo $job['SnippetDescription']?></a>
                   <?php }else{?>
                        <a href="<?php echo $job['IframeUrl']?>" target="_blank"> <?php echo $job['IframeUrl']?></a>
                   <?php }?>
                        <?php } else{
                            ?>
                        <span style="color: #000;font-family:Arial;font-size: 15px;font-weight:bold;display:block;text-align:center;line-height:20px">
                        <?php
                          echo strip_tags($job['JobDescription']);
                        }?>
                            </span>
                            </div>

             <div class="media-body">
                 <div>
                     <span class="m_day"><?php echo CommonUtility::styleDateTime($time); ?></span>

                 </div>


                            </div>
            </div>
                </div>




        </div>

     </li>
<?php }else { ?>
     <?php $strtime=strtotime($job['PostedDate'])?>
    <li class="jobsList fromHec" id="<?php echo $job['id']; ?>" data-jobid="<?php echo $job['id']; ?>">
<div class="post item" style="">
    <span class="grouppostspinner" id="groupfollowSpinLoader_<?php echo $job['id']; ?>"></span>
<div class="stream_career_box">
<div class="stream_title stream_titlenews paddingt5lr10" style="cursor: pointer;position:relative;padding-right:30px">
    <b data-id="<?php echo $job['id'] ?>" class="group"><?php echo $job['JobTitle'] ?> - <span><?php echo $job['JobId']; ?></span></b>
    <i style="white-space: nowrap;display: block;clear:both;padding-left:0"> <?php echo $job['JobPosition']; ?></i>
<div style="position: absolute;right:5px;top:4px">
<div style="margin-right:0;" class="postmg_actions" data-jobid="<?php echo $job['id']; ?>">
                    <i class="fa fa-chevron-down" data-toggle="dropdown" data-placement="right"></i>
                    <i class="fa fa-chevron-up" data-toggle="dropdown" data-placement="right"></i>
                    <div class="dropdown-menu margindropdown">
                         <ul class="PostManagementActions" data-jobid="<?php echo $job['id']; ?>"  >

                            <?php if (Yii::app()->session['IsAdmin'] == 1) { ?><li class="career_droplist"><a class="copyurl"><span class="copyicon"><img src="/images/system/spacer.png" /></span> Copy URL</a></li><?php } ?>

                         </ul>
                        </div>
        </div>
    </div>
</div>
</div>

<div class="stream_content stream_contentjobs">
<div data-id="<?php echo $job['id'] ?>" class="media">

<div class="media-body ">


    <?php
$location = "";
if(!empty($job['City'])){
    $location = $job['City'];
}
if(!empty($job['State'])){
    if(!empty($location))
        $location = "$location, ".$job['State'];
    else
        $location = $job['State'];
}
if(!empty($job['Zip'])){
    if(!empty($location))
        $location = "$location, ".$job['Zip'];
    else
        $location = $job['Zip'];
}
?>


<div class="row-fluid">
<div class="span12">
     <?php if(!empty($job['EmployerName'])){ ?>
    <div class="span6"><div class="jobsemployer"><?php echo $job['EmployerName']; ?></div> </div>
    <?php } ?>
    <?php if(!empty($location)){ ?>
<div class="span6"><div class="jobslocation"><?php echo $location; ?></div> </div>
    <?php } ?>

</div>
</div>

</div>
<?php if(!empty($job['JobDescription'])) {
    $jDescription = $job['JobDescription'];

    ?>
<div class="media-body">
<div class="lineheight17">
<?php echo $job['JobDescription']; error_log("===job description====".$job['JobDescription']); ?>

</div>
</div>
     <?php } ?>
    <?php //if(!empty($job['EAdditionalInfo'])){ ?>
<!--<div class="media-body"> <?php //echo ($job['EAdditionalInfo']); ?></div>-->
    <?php //} ?>
    <div class="media-body" style="padding-top:0; padding-bottom: 0">
<div class="row-fluid">
    <div class="span12">
        <div class="span5" style="padding-top:8px;" > <span class="m_day"><?php echo CommonUtility::styleDateTime($strtime); ?></span></div>
        <div class="span7 alignright " style="padding-top:5px;">
            <img alt="Powered by HealtheCareers" src="/images/system/poweredbyhec.png" style="width:auto;display: inline-block"/>
            <input data-uri="<?php echo $job['InternalApplyUrl']; ?>" type="button" value="Apply Now" name="commit" class="btn btn-mini jobsapplybutton" >
        </div>
    </div>
</div>
</div>
</div>
</div>




</div>

</li>
<?php } ?>


<?php }  ?>
<script type="text/javascript">
$(".jobsapplybutton").die().live("click",function(){
    var url = $(this).data("uri");
    window.open(url,"_blank");

});
if(detectDevices()){
$('.postmg_actions').removeClass().addClass("postmg_actions postmg_actions_mobile");
        }
</script>

    <?php }else {
     echo $jobs;
 }?>