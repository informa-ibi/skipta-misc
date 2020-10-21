<?php include 'header.php';
$user_present = Yii::app()->session->get('TinyUserCollectionObj');
if(isset($user_present) || Yii::app()->params['Project']!='SkiptaNeo') {?>
<section id="streamsection" class="streamsection" >
    <div class="container">


        <div id='chatDiv' class="streamsectionarea  padding10 displayn"></div>
        <div id="norecordsFound" class="displayn streamsectionarea padding10"></div>
        <div id="tosAndPrivacyPolicy"></div>
        <div class="streamsectionarea <?php if ($this->sidelayout == 'yes') { ?>streamsectionarearightpanel<?php } ?>" id="contentDiv">
        <div class="padding10">
        <?php echo $content; ?>
        </div>
        </div>
   </div>
</section>
<?php }else{ ?>
    
   <?php echo $content; ?>
  
 <?php }?>
<?php include 'footer.php' ?>
