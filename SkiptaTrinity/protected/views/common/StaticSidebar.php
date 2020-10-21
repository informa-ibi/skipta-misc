

<?php if (Yii::app()->params['Project']=='ValueDrug') { ?>
    <!--topmenustyleiconswithsquarelabel-->
    
    <div class="topheaderarea topheaderareamenu topmenustyleicons  topmenustyleiconswithlabel  " >
   	<div class="container ">
            <div class="triheaderarea">
    <div class=" row-fluid customtrinityrow-fluid">
        <div class="span12">
           <div class="topmenustyle" >
        <ul id="menu" class="sidebar-menunav">

 <!--one-->
 
        <li class="tr_Stream"><a ><i class="fa fa-stack-exchange"></i> <span><?php echo Yii::t('translation','Home'); ?></span></a></li>
        <li class="tr_Groups"><a ><i class="fa fa-users"></i> <span><?php echo Yii::t('translation','GroupsLabel'); ?></span></a>
        </li>

        <li class="tr_PrivateMessaging">
            <a ><i class="fa fa-clipboard"></i> <span><?php echo Yii::t('translation','Chat'); ?></span></a></li>
        <li  class="tr_PrivateMessaging tr_singlemenu" >
           <a><i class="fa fa-list-alt"></i> <span><?php echo Yii::t('translation','News'); ?></span></a>
        </li>
        <li class="tr_PrivateMessaging tr_singlemenu"  >
            <a ><i class="fa fa-link"></i> <span><?php echo Yii::t('translation','Quick_Links'); ?></span></a> </li>
        <li class="tr_PrivateMessaging tr_singlemenu" id="games" >
            <a ><i class="fa fa-puzzle-piece"></i> <span><?php echo Yii::t('translation','Games'); ?></span></a>
        </li>
        <li class="tr_PrivateMessaging tr_singlemenu"  >
            <a><i class="fa fa-bar-chart-o"></i> <span><?php echo Yii::t('translation','Analytics'); ?></span></a>
        </li>
         </ul>
            </div>
       </div>
    </div>
    </div>
    </div>
   </div>
  <?php } ?>
  