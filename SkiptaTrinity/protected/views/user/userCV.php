<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


?>
<?php include 'profileinteractionbuttongroupwidget.php'; ?>



<?php if($result['education']!='failure' || $result['interests']!='failure'){ ?>
    <?php if($loginUserId==$profileDetails->UserId){ ?>
<div class="row-fluid" style="padding-top: 5px;">
<div class="span9">

<input type="button" class="btn btn-small" style="float:right;" id="addeditprofile" name="yt0" value="Edit my CV">
</div>
</div>
<?php } ?>

<div class="row-fluid" style="padding-top: 10px;">
<div class="span9 customaccordian">

 <div id="CV_View_Subdiv_0"></div>
    <div id="CV_View_Subdiv_1"></div>
    <div id="CV_View_Subdiv_2"></div>
    <div id="CV_View_Subdiv_3"></div>
    <div id="CV_View_Subdiv_4"></div>
    <?php 
    
    $educationDetails=$result['education'];
    if($educationDetails!="failure")
    {
       
    ?> 
    <div id="e_educationdiv"  > 
<div class="cvaccordian">
<div class="cvoutergroup">
<div class="cvaccordian-heading">
<div class="cvaccordion-toggle2 education"><?php echo Yii::t('translation','Education'); ?></div>

</div>
<div class="cvaccordion-body">
<div class="cvaccordion-inner">
<div class="accordion" id="accordion2">
<div class="accordion-group">
    <?php 
    
    $educationDetails=$result['education'];
    foreach($educationDetails as $education)
       
    {?>
        <div class="paddingtop6">
<div class="accordion-headingview"><?php echo $education['Education']?></div>
<div class="cv_viewsection"><b><?php echo $education['CollegeName']?></b> <span><?php echo $education['Specialization']?></span> <span><?php echo $education['YearOfPassing']?></span></div>
</div>
   <?php }
    
    ?>




</div>

</div>
</div></div>
</div>
</div>
    </div>
    <?php }?>
     <?php 
    
      $experienceDetails=$result['experience'];
    if($experienceDetails!="failure")
    {
       
    ?> 
    <div id="e_experiencediv"  >
<div class="cvaccordian">
<div class="cvoutergroup">
<div class="cvaccordian-heading">
<div class="cvaccordion-toggle2 experience"><?php echo Yii::t('translation','Experience'); ?></div>

</div>
<div class="cvaccordion-body">
<div class="cvaccordion-inner">
<div class="accordion">
<div class="accordion-group">
    
    <?php
    
     $experienceDetails=$result['experience'];
    foreach($experienceDetails as $experience)
       
    {
        if($experience['Description'] != ""){
    ?>
    
<div class="paddingtop6">
<div class="accordion-headingview"><?php echo str_replace("Experience"," Experience",$experience['Experience']);?></div>

<div class="cv_viewsection">
<?php echo $experience['Description']?>
</div>
</div>
    <?php } }
    
    ?>


</div>

</div>
</div></div>
</div>
</div>
    </div>
     <?php }?>
     <?php 
    
       $interestDetails=$result['interests'];
    if($interestDetails!="failure")
    {
       
    ?> 
    <div id="e_interestsdiv"  > 
<div class="cvaccordian">
<div class="cvoutergroup">
<div class="cvaccordian-heading">
<div class="cvaccordion-toggle2 intrests"><?php echo Yii::t('translation','Interests'); ?></div>

</div>
<div class="cvaccordion-body">
<div class="cvaccordion-inner">
<div class="accordion" id="accordion2">
<div class="accordion-group">
    
    <?php
    
     $interestDetails=$result['interests'];
    foreach($interestDetails as $interests)
       
    {
    ?> 
<div class="paddingtop6">
<div class="accordion-headingview"><?php echo  str_replace("Interests"," Interests",$interests['Interests']); ?></div>
<div class="cv_viewsection"><span><?php echo str_replace(",", ", ", $interests['Tags'])?></span></div>
</div>
    <?php }?>

</div>

</div>
</div></div>
</div>
</div>
    </div>
     <?php }
    
    ?>
<?php
    
    $publicationDetails=$result['publications'];
    
   if($publicationDetails!="failure")
    {
       
   
    ?> 
    <div id="e_publicationsdiv"  > 
<div class="cvaccordian">
<div class="cvoutergroup">
<div class="cvaccordian-heading">
<div class="cvaccordion-toggle2 publications"><?php echo Yii::t('translation','Publications'); ?></div>

</div>
<div class="cvaccordion-body">
<div class="cvaccordion-inner">
<div class="accordion" >
<div class="accordion-group">
<div class="paddingtop6 ">
     <?php
    
     $publicationDetails=$result['publications'];
    foreach($publicationDetails as $publications)
       
    {
    ?> 
    
<div class="pubdivider">
<div class="row-fluid row-fluidm0">
<div class="span12">
<div class="span9 cvsection1">
<?php echo $publications['Name']?>
</div>
<div class="span3 cvsection1date">
<?php echo $publications['PublicationDate']?>
</div>

</div>
</div>
<div class="pubsection">
<div class="pubsection1"><?php echo $publications['Title']?></div>
<div class="pubsection2"><?php echo $publications['Authors']?></div>
<div class="pubsection3"><?php echo $publications['Location']?></div>
<div class="pubsection4">

    
    <?php if($publications['Link'] != "") { ?> 
       <a style="text-decoration:underline;cursor: pointer;" class="showpdffile1" data-uri="<?php echo $publications['Link']; ?>" > 
           <?php echo $publications['Link']; ?><?php } ?> 
       </a>

    <?php if($publications['Files'] != "") { ?> 
     
        <a style="text-decoration:underline;cursor: pointer;" class="showpdffile" data-uri="<?php echo $publications['Files']; ?>" ><?php
        $urlArr = explode("/",$publications['Files']);
                echo $urlArr[3];
                ?> </a>
<img src="/images/system/pdfdownload.png" style="cursor:pointer;"  >
<?php } ?>
    
    
</div>
</div>
</div>
    <?php }?>

</div>

</div>

</div>
</div></div>
</div>
</div>
    </div>
     <?php }
    
    ?>
    
    <?php
    
    $achivementsDetails=$result['achievements'];
   if($achivementsDetails!="failure")
    {
       
   
    ?> 
     <div id="e_achievementsdiv"  > 
    <div class="cvaccordian">
<div class="cvoutergroup">
<div class="cvaccordian-heading">
<div class="cvaccordion-toggle2 achievements"><?php echo Yii::t('translation','Achievements'); ?></div>

</div>
<div class="cvaccordion-body">
<div class="cvaccordion-inner">
<div class="accordion">
<div class="accordion-group">
    
    <?php
    
     $achivementsDetails=$result['achievements'];
    foreach($achivementsDetails as $achivements)
       
    {
    ?>
<div class="paddingtop6">
<div class="accordion-headingview"><?php echo $achivements['Achievement']?></div>
<div class="cv_viewsection"><span><?php echo $interests['Awards']?></span></div>
<div class="cv_viewsection">
<?php echo $achivements['Description']?>
</div>
</div>
    <?php }
    
    ?>


</div>

</div>
</div></div>
</div>
</div>
     </div>
  <?php }
    
    ?>  
</div>
</div> 
 <?php } else{ ?>   
<div class="row-fluid" style="padding-top: 10px;">

        <div class="p_summary">
  <div class="padding10">
  <div class="cvtitle"><?php echo $profileDetails->DisplayName ?>’s CV</div>
  </div>
  <div class="bordertop">
  <div class="aligncenter">
  <img src="/images/system/cvemptyicon.png">
  <div class="row-fluid">
  <div class="spanfloatnonecenter">
  

  <?php  if($loginUserId==$profileDetails->UserId){?>
      <div class="aligncenter cvemptytext"><?php echo Yii::t('translation','Ask_CV_info'); ?></div>
  <div class="aligncenter padding10"><a id='cvCreateAnchor'><input type="button" value="Get Started" name="yt0"  class="btn"></a></div>

  <?php }else{?>
   <div class="aligncenter cvemptytext"><?php //echo $profileDetails->DisplayName ?> <?php echo Yii::t('translation','CV_notfilled'); ?></div>
  <?php }?>
  </div></div>
  </div>
  </div>
  </div>
        
</div>
 <?php } ?>
<script type="text/javascript">
    
 var  g_CVOrderArray = <?php echo json_encode($OrderArray); ?>;
    for (var r = 0; r < g_CVOrderArray.length; r++) {
         $("#CV_View_Subdiv_"+r).html($("#"+g_CVOrderArray[r]).html());
         $("#"+g_CVOrderArray[r]).html("");
         
    }
    $("[rel=tooltip]").tooltip();
     $("#profileBtn,#profileIntBtn").removeClass("active");
     $("#profileCVBtn").addClass("active");
     
     $(".showpdffile").live('click',function(){
  var uri = $(this).data('uri');
  var id = 'player';
  loadDocumentViewer(id, uri, "","",400,500);
  $("#showoriginalpicture").hide()
  $("#myModal_old").modal('show');
});
$("#cvCreateAnchor").bind("click",function(){
     var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
    sessionStorage.userProfile = urlArr[0];
   // window.location.href = "/"+urlArr[0]+"/profileCV";
    window.location.href = "/profileCV/"+urlArr[1];
}
);
    $(".showpdffile1").live('click',function(){
  var uri = $(this).data('uri');
  var id = 'player';
  loadExternalDocumentViewer(id, uri, "","",400,500);
  $("#showoriginalpicture").hide()
  $("#myModal_old").modal('show');
});
$("#addeditprofile").click(function(){
    var url = window.location.pathname.substr(1);
    var urlArr = url.split("/");
    window.location.href = "/profileCV/"+urlArr[1];
});
 breadCumSource = "CV";
sessionStorage.breadCumSource = "CV";
</script>
