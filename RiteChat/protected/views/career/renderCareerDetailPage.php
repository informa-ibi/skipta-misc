

<div class="row-fluid " id="postDetailedTitle">
     <div class="span6 "><h2 class="pagetitle"><?php echo Yii::t('translation','JobDetail');?></h2>
    
     </div>
          <div class="span6 ">
          <div class="grouphomemenuhelp alignright tooltiplink"> <a class="detailed_close_page" rel="tooltip"  data-original-title="close" data-placement="bottom" data-toggle="tooltip"> <i class="fa fa-times"></i></a> </div>
          </div>
     </div>
<?php
foreach($jobDetails as $jobDetail){
    if($jobDetail['Source'] != "hec"){
    ?>

<div class="woomarkLi" id="newsDetailedwidget">

<div class="customwidget_outer profilebox">
<div class="customwidget customwidgetdetail stream_contentjobs">
<div class="stream_title stream_titlenews paddingt5lr10"><b><?php echo $jobDetail['JobTitle']?> - </b><i> <?php echo $jobDetail['JobPosition'] ?></i> </div>


<div class="customcontentarea customwidgetdetailcontent media " style="margin:0;padding:0;">
    <div class="cust_content media-body" style="padding-right:10px;padding-left:10px" ><?php echo $jobDetail['Industry']?></div>
 
    <div class="stream_content stream_contentjobs">
            
                   
            <div class="media" data-id="<?php echo $jobDetail['id'] ?>">
            <div class="media-body">
                   <b><?php echo $jobDetail['Category']?></b> -      <?php echo $jobDetail['Industry']?>
                            </div>
                <div class="media-body">
                    <?php if(isset($jobDetail['IframeUrl'])) {?>
                    <?php if(isset($jobDetail['SnippetDescription']) && !empty($jobDetail['SnippetDescription'])){?>
                        <a href="<?php echo $jobDetail['IframeUrl']?>" target="_blank"> <?php echo $jobDetail['SnippetDescription']?></a>
                   <?php }else{?>
                        <a href="<?php echo $jobDetail['IframeUrl']?>" target="_blank"> <?php echo $jobDetail['IframeUrl']?></a>
                   <?php }?>
                        <?php } else{
                          echo $jobDetail['JobDescription']; 
                        }?>
                            </div>
            
             <div class="media-body">
                  <div>
                      <span class="m_day"><?php echo CommonUtility::styleDateTime(strtotime($jobDetail['CreatedDate'])); ?></span>
                     
                 </div>
                           
                           
                            </div>
            </div> 
                </div>
       
        
 </div>

<?php?>
 
</div>

                        
          </div>
</div>
    <?php }else{ ?>
 <?php $strtime=strtotime($jobDetail['PostedDate'])?>
        <div class="jobsList fromHec" id="<?php echo $jobDetail['id']; ?>" data-jobid="<?php echo $jobDetail['id']; ?>">
<div class="post item" style="">
    <span class="grouppostspinner" id="groupfollowSpinLoader_<?php echo $jobDetail['id']; ?>"></span>
<div class="profilebox stream_career_box stream_lineheight">
<div class="stream_title stream_titlenews paddingt5lr10" style="cursor: pointer;position:relative;padding-right:30px">
<b data-id="<?php echo $jobDetail['id'] ?>"   class="group"><?php echo $jobDetail['JobTitle'] ?> - </b><i> <?php echo $jobDetail['JobPosition']; ?></i>

</div>
</div>

<div class="stream_content stream_contentjobs">
<div data-id="<?php echo $jobDetail['id'] ?>" class="media">
<div class="media-body">
<div class="row-fluid">
<div class="span6" style="min-height:1px"><b><?php echo $jobDetail['JobId']; ?></b> </div>
<div class="span6" style="min-height:1px"><span class="m_day pull-right"><?php echo CommonUtility::styleDateTime($strtime); ?></span></div>
</div>
</div>
<div class="media-body ">
   

    <?php 
$location = "";
if(!empty($jobDetail['City'])){
    $location = $jobDetail['City'];
}
if(!empty($jobDetail['State'])){
    if(!empty($location))
        $location = "$location, ".$jobDetail['State'];
    else
        $location = $jobDetail['State'];
}
if(!empty($jobDetail['Zip'])){
    if(!empty($location))
        $location = "$location, ".$jobDetail['Zip'];
    else
        $location = $jobDetail['Zip'];
}
?>
     <?php if(!empty($jobDetail['EmployerName'])){ ?>
<div class="jobsemployer"><?php echo $jobDetail['EmployerName']; ?></div> 
<?php } ?>
<div class="row-fluid">
<div class="span12">
    <?php if(!empty($location)){ ?>
<div class="span6"><div class="jobslocation"><?php echo $location; ?></div> </div> 
    <?php } ?>
<?php if(!empty($jobDetail['Industry'])){ ?>
    <div class="span6"><div class="industry pull-right"><a style="text-decoration:none;"><?php echo $jobDetail['Industry']; ?></a></div></div>
    <?php } ?>
</div>
</div>
    
</div>
<?php if(!empty($jobDetail['JobDescription'])) { 
    $jDescription = $jobDetail['JobDescription'];    
    ?>
<div class="media-body">    
<div class="lineheight17">    
<?php echo ($jobDetail['JobDescription']); ?>

</div>
</div>
     <?php } ?>

<div class="row-fluid">
    <div class="span12">
        <div class="span6"> <div class="poweredby"><img alt="Powered by HealtheCareers" src="/images/system/poweredbyhec.png" style="width:auto"/></div></div>
        <div class="span6 alignright padding5">
            <input data-uri="<?php echo $jobDetail['InternalApplyUrl']; ?>" type="button" value="Apply Now" name="commit" class="btn btn-mini jobsapplybutton" >
        </div>
    </div>
</div>

</div>
</div>




</div>

</div>
        

    <?php } ?>
<?php }?>
 <script type="text/javascript">
 $( ".detailed_close_page" ).unbind( "click" );
        $(".detailed_close_page").bind('click',function(){ 

              <?php  if(isset($_REQUEST['layout'])){ ?>
                window.location.href = "/";
              <?php } ?>
                });
    $(".jobsapplybutton").die().live("click",function(){
    var url = $(this).data("uri");
    window.open(url,"_blank");

    });
                
</script>