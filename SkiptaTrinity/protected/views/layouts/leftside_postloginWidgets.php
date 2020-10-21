 <?php $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
$displayName = Yii::app()->session['TinyUserCollectionObj']['DisplayName'];
$uniqueHandle = Yii::app()->session['TinyUserCollectionObj']['uniqueHandle'];
?>
         <div id="wah-menu" class="wah-menu" >
    <div class="wah-ul">
        <?php if(Yii::app()->params['Project']=='Trinity'){ ?>
    <div class="tr_left_pannel " >
    	<div class=" row-fluid">
                <div class="span12">
                    <div class="trinity_logo "><img src="/images/system/trinity_logo.png" class="cursorp" onclick="window.location='/stream';" /></div>
              </div>      
        </div> 
        </div>
        <?php 
         include 'profilerightwidget.php';
        
        }?> 

         <div id="sidebar"></div>
<ul id="menu" class="sidebar-menunav">

 <!--one-->
 
 <li class="tr_Stream"><a href="/stream" class="<?php  if($this->whichmenuactive==1){?>tr_active<?php }?>"><i class="fa fa-stack-exchange"></i> <span><?php echo Yii::t('translation','Home'); ?></span></a></li>
 <li style="display: none" class="tr_Curbside"><a href="/curbsideConsult" class=" <?php  if($this->whichmenuactive==2){?>tr_active<?php }?>"><i class="fa fa-quote-left"></i> <span><?php echo Yii::t('translation','Curbside'); ?></span></a></li>
 <li class="tr_Groups"><a href="/groups" class="<?php  if($this->whichmenuactive==3){?>tr_active<?php }?>"><i class="fa fa-users"></i> <span><?php echo Yii::t('translation','GroupsLabel'); ?></span></a>
                         <?php
                            $userGroups = Yii::app()->session['UserFollowingGroups'];
                            $i = 0;

                            if (!empty($userGroups)) {
                                ?>
                             
         <ul class="sub" >
           <li class="menusubheader">Groups</li>
            <?php foreach ($userGroups as $group) { ?>
                                            <?php if ($i <= 4) { ?>
           <li ><a href="/<?php echo $group['GroupUniqueName'] ?> "> <?php echo html_entity_decode($group['GroupName']) ?></a> </li>
                                                <?php $i++;
                                            } else { ?>
                                                <li class="n_viewmore"><a href="/groups">View More</a></li>
                                                <?php break;
                                            } ?>
                                        <?php } ?>  
                            </ul>
        
 <?php } ?>
                        </li>
                         <?php if(Yii::app()->params['Chat']=='ON' &&  Yii::app()->session['UserPrivilegeObject']->canMessage==1){?>
                      <li class="tr_PrivateMessaging">
                          <a onclick="divrenderget('chatDiv','/chat/index')"  class="cursorp <?php  if($this->whichmenuactive==10){?>tr_active<?php }?>" id="Private_Messaging"><i class="fa fa-clipboard"></i> <span><?php echo Yii::t('translation','Chat'); ?></span></a></li>
                         <?php }?>
                      <?php if (Yii::app()->params['News'] == 'ON') { ?>
        <li  class="tr_PrivateMessaging tr_singlemenu" id="news">
            
            
            <a href="/news/index"  class="cursorp <?php  if($this->whichmenuactive==5){?>tr_active<?php }?>" id="Private_Messaging"><i class="fa fa-list-alt"></i> <span><?php echo Yii::t('translation','News'); ?></span></a>
        
        </li>
        <?php }?>
        
         <?php if (Yii::app()->params['QuickLinks'] == 'ON') { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="weblinks" >
            <a href="/quicklinks"   class="<?php  if($this->whichmenuactive==9){?>tr_active<?php }?>  cursorp "><i class="fa fa-link"></i> <span><?php echo Yii::t('translation','Quick_Links'); ?></span></a> </li>
        <?php }?>    
        
        <?php if (Yii::app()->params['Games'] == 'ON') { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="games" >
            <a href="/game/index"  class="<?php  if($this->whichmenuactive==4){?>tr_active<?php }?> cursorp left_games-icon" ><i class="fa fa-puzzle-piece"></i> <span><?php echo Yii::t('translation','Games'); ?></span></a>
        </li>
        <?php }?>
       
        <?php if (Yii::app()->params['Careers'] == 'ON') { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="careers" >
            <a href="/career/index"   class="cursorp " ><i class="fa fa-graduation-cap"></i> <span><?php echo Yii::t('translation','Careers'); ?></span></a></li>
        <?php }?>
                       
        
         <?php if (Yii::app()->session['IsAdmin'] == 1 && $this->userPrivilegeObject->canViewAnalytics==1) { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="analytics" >
            <a href="/analytics"  class="<?php  if($this->whichmenuactive==7){?>tr_active<?php }?> cursorp left_games-icon" ><i class="fa fa-bar-chart-o"></i> <span><?php echo Yii::t('translation','Analytics'); ?></span></a>
        </li>
        <?php }?>
                   
                       <?php if(Yii::app()->session['IsAdmin']=='1'){?>
        <li class="tr_Admin wah-item"><a class="<?php  if($this->whichmenuactive==8){?>tr_active<?php }?>" ><i class="fa fa-gears"></i>  <span><?php echo Yii::t('translation','Admin'); ?></span></a>
                         
     <ul class="sub" >
                              <li class="menusubheader">Admin</li>
                               <li><a href="/users"><?php echo Yii::t('translation','User_Management'); ?></a></li>
                                    <li><a href="/curbsideCategories"><?php echo Yii::t('translation','Curbside_Categories'); ?></a></li>
                                    <li><a href="/roleManagement"><?php echo Yii::t('translation','Roles_Management'); ?></a></li>
                                    <li><a href="/postManagement"><?php echo Yii::t('translation','Post_Management'); ?></a></li>
                                    <li><a href="/abuseScan"><?php echo Yii::t('translation','Abuse_Scan'); ?></a></li>
                                    <li><a href="/helpManagement"><?php echo Yii::t('translation','Help_Management'); ?></a></li>
                                     <li><a href="/admin/networkConfig"><?php echo Yii::t('translation','Network_Configuration'); ?></a></li>
                                    <?php if (Yii::app()->params['News'] == 'ON'){?>
                    <li><a href="/admin/content"><?php echo Yii::t('translation','Content_Management'); ?></a></li>
                    <?php }?>
                    <li><a href="/communications"><?php echo Yii::t('translation','Communications'); ?></a></li>
                    
                    
                     <li><a href="/admin/getGroupsInactiveActive">Groups Management</a></li>   
                     <li><a href="/admin/broadcastnotifications"><?php echo Yii::t('translation','Broadcast_Notifications'); ?></a></li> 
                          </ul>
        

                        </li>
                         <?php } ?>
                
        </ul>
        </div>
        </div>
