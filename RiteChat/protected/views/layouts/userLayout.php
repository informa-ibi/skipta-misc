<?php include 'header.php';
$user_present = Yii::app()->session->get('TinyUserCollectionObj');
if(isset($user_present) || Yii::app()->params['Project']!='SkiptaNeo') {?>
<section id="streamsection" class="streamsection" >
    <div class="container">
        <?php if(Yii::app()->params['Project']=='Trinity'){ include 'leftsideWidgets.php'; }?>
        <?php if(Yii::app()->params['Project']=='SkiptaNeo'){ include 'leftmenu.php'; }?>
        <?php if ($this->sidelayout == 'yes') { ?>
            <div class="sidebar-nav_right" id="rightpanel">
                <?php include 'rightsideWidgets.php'; ?>
            </div>
        <?php } ?>
        <div class="streamsectionarea padding10" id="notificationHomediv" style="display:none;">
            <div class="padding10ltb">
                <h2 class="pagetitle">History 
                    <a id="history_close" href="#" class="notification_history_close pull-right" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="close"> <i class="fa fa-times"></i></a>         
                </h2> 
                <div style="text-align: right" id="markallasreaddiv">
                    <div class="markread" style="padding-bottom:4px;">
                        <a class="markallasread_notification markasreadlink" data-notificationflag="1" href="#" data-type="history" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Mark All as Read"><i  class="fa fa-check"></i> Mark all as Read </a>
                    </div>
                </div>
                <div id="notificationHistory" style="display: none" ></div>
                <div id="history_spinner" style="position:relative;" ></div>

            </div>
        </div>
        <div id="nomorenotifications" style="display:none;">                
            <div class="notificationresults" style="text-align: center;font-size: 16px;" id="notificationText"></div>
        </div>
                <div id="admin_PostDetails" class="streamsectionarea padding10 displayn"></div>
 <div id="chatSpinLoader"></div>
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
<?php if (Yii::app()->params['Project'] != 'RiteChat') { ?>
<script type="text/javascript">
    var LeftMenuHeight = $("#menu_bar").outerHeight(); 
     var ContentHeight = $("#contentDiv").outerHeight(); 
    if(LeftMenuHeight>ContentHeight){
       var FianlHeight=LeftMenuHeight+100;
        $("#contentDiv").css("height",FianlHeight);
   }
 </script>
<?php }?>