 <?php $userId = Yii::app()->session['TinyUserCollectionObj']['UserId'];
$displayName = Yii::app()->session['TinyUserCollectionObj']['DisplayName'];
$uniqueHandle = Yii::app()->session['TinyUserCollectionObj']['uniqueHandle'];
?>
         <div id="wah-menu" class="wah-menu" >
    <div class="wah-ul">
    <div class="tr_left_pannel " >
    	<div class=" row-fluid">
                <div class="span12">
                    <div class="trinity_logo "><img src="/images/system/spacer.png" class="cursorp" onclick="window.location='/stream';" /></div>
              </div>      
        </div> 
        </div>
        <div class="tr_left_pannel" >
<div class="tr_notification_div">
                    <div class=" row-fluid" style="position:relative">
                    <div class="pull-left" >
                        
                        
                        
                        
                        <div class="tr_top_profile margin10 " style="position:relative" id="drop3" data-toggle="dropdown" class="tooltiplink" data-placement="bottom" rel="tooltip" >
                        <a  class="myprofileicon" href="#">   <img src="<?php echo $this->tinyObject->profile70x70; ?>" /></a>
                      </div>
                      <div class="dropdown-menu leftheadermenuarea profilewidth">

               <form method="post" action="/sessions" accept-charset="UTF-8" style="margin: 0px">
                <div class="headerpoptitle"><?php echo $this->tinyObject->DisplayName; ?></div>
                
                    <ul >
                        <li><?php echo CHtml::link('<i class="fa fa-user"></i>Profile',array("$uniqueHandle/profile")); ?></li>
                        <li class="gt_opts positionrelative ">
                    <a href="#" data-original-title="Guided Tour" rel="tooltip" data-placement="bottom" ><i class="fa fa-lightbulb-o"></i>Tour </a>
                    <div class="gt_switch positionabsolutediv" ><input type="checkbox" id="joyRideSwitch" data-on-label="OFF  " data-off-label="ON "  data-original-title="Guided Tour"/></div>
                    <div class="clear"></div>
                </li>
                  
                        <li> <a href="/user/logout"><i class="fa fa-power-off"></i>Logout</a></li>

                    </ul>
                
               </form>
             </div>
                      
             </div>
                         <div class="pull-right tr_notifications ">
                        <ul>
                     
                           
                        
                        <li><i onclick="divrenderget('chatDiv','/chat/index')" style="cursor:pointer" class="fa fa-comments-o cursorp"></i> <span class="badge badge-info " id="chatOffCount" style="display: none"></span>
                            </li>
                         
                              
                            <li data-toggle="dropdown" id="notificationsLi" class="tooltiplink" data-placement="bottom" rel="tooltip"><i class="fa fa-bell-o cursorp"  ></i> <span  id="notificationCount" class="badge badge-info"></span></li>

                            <div id="notification" class="dropdown-menu leftheadermenuarea profilewidth dropdownopen notificationwidth">
       
            
                      
                      
            <div id="notificationsHeader" class="headerpoptitle"><span id="totalNotifications" class="pull-left margin-right3"></span>&nbsp; 
                    <!--replace class "fa fa-question" with  "fa fa-video-camera videohelpicon" if we have description and video remaining will be same-->
                    <i data-original-title="Notifications" rel="tooltip" data-placement="bottom" data-id="Notifications_DivId" class="fa fa-question helpicon helpmanagement helprelative pull-left notificationpopuphelp tooltiplink"></i> <span class="pull-right"><a class="markallasread_notification markasreadlink" href="#"><i class="fa fa-check-circle-o"></i> Mark all as Read</a></span></div>
                    <div class="padding4">
                      <div id="notification_spinner"></div> 
                   
                    <div id="scrollDiv" class="scroll" style="height: 40px;"><div id="renderNotification"><div class="padding10"><div class="notificationdata "><div class="media-body"><div class="m_title"></div><div class=" m_day fontnormal">You have no notifications</div></div></div></div></div></div>
                <div style="display: none;" id="settings"></div>
                <div class="headerpopfooter headerpopfooterzero"> 
                       <a id="notification_history" class="pull-left cursorp" href="#">History</a>
                       <a id="notification_settings" class="pull-right cursorp">Settings</a>
                </div>
               
        </div>
             </div>      </ul>
                        
                        </div>
                         
                    </div>  
              </div>
</div>
         <div id="sidebar"></div>
<ul id="menu" class="sidebar-menunav">

 <!--one-->
 
 <li class="tr_Stream"><a href="/stream" class="<?php  if($this->whichmenuactive==1){?>tr_active<?php }?>"><i class="fa fa-stack-exchange"></i> Stream</a></li>
  <li class="tr_Curbside"><a href="/curbsideConsult" class=" <?php  if($this->whichmenuactive==2){?>tr_active<?php }?>"><i class="fa fa-quote-left"></i> Curbside</a></li>
                        <li class="tr_Groups"><a href="/groups" class="<?php  if($this->whichmenuactive==3){?>tr_active<?php }?>"><i class="fa fa-users"></i>  Groups</a>
                         <?php
                            $userGroups = Yii::app()->session['UserFollowingGroups'];
                            $i = 0;

                            if (!empty($userGroups)) {
                                ?>
                             
         <ul class="sub" >
           <li class="menusubheader">Groups</li>
            <?php foreach ($userGroups as $group) { ?>
                                            <?php if ($i <= 4) { ?>
                                                <li><a href="/<?php echo $group['GroupName'] ?>"><?php echo $group['GroupName'] ?></a> </li>
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
                          <a onclick="divrenderget('chatDiv','/chat/index')"  class="cursorp <?php  if($this->whichmenuactive==10){?>tr_active<?php }?>" id="Private_Messaging"><i class="fa fa-clipboard"></i>Private Messaging</a></li>
                         <?php }?>
                      <?php if (Yii::app()->params['News'] == 'ON') { ?>
        <li  class="tr_PrivateMessaging tr_singlemenu" id="news">
            
            
        <a href="/news/index"  class="cursorp <?php  if($this->whichmenuactive==5){?>tr_active<?php }?>" id="Private_Messaging"><i class="fa fa-list-alt"></i> News</a>
        
        </li>
        <?php }?>
        
         <?php if (Yii::app()->params['QuickLinks'] == 'ON') { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="weblinks" >
            <a href="/quicklinks"   class="<?php  if($this->whichmenuactive==9){?>tr_active<?php }?>"  cursorp "><i class="fa fa-link"></i>Quick Links</a> </li>
        <?php }?>    
        
        <?php if (Yii::app()->params['Games'] == 'ON') { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="games" >
            <a href="/game/index"  class="<?php  if($this->whichmenuactive==4){?>tr_active<?php }?>" cursorp left_games-icon" ><i class="fa fa-puzzle-piece"></i>Games</a>
        </li>
        <?php }?>
       
        <?php if (Yii::app()->params['Careers'] == 'ON') { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="careers" >
            <a href="/career/index"   class="cursorp " ><i class="fa fa-graduation-cap"></i>Careers</a></li>
        <?php }?>
                       
        
         <?php if (Yii::app()->session['IsAdmin'] == 1 && $this->userPrivilegeObject->canViewAnalytics==1) { ?>
        <li class="tr_PrivateMessaging tr_singlemenu" id="analytics" >
            <a href="/analytics"  class="<?php  if($this->whichmenuactive==7){?>tr_active<?php }?>" cursorp left_games-icon" ><i class="fa fa-bar-chart-o""></i>Analytics</a>
        </li>
        <?php }?>
                   
                       <?php if(Yii::app()->session['IsAdmin']=='1'){?>
                        <li class="tr_Admin wah-item"><a class="<?php  if($this->whichmenuactive==8){?>tr_active<?php }?>"><i class="fa fa-gears"></i>  Admin</a>
                         
     <ul class="sub" >
                              <li class="menusubheader">Admin</li>
                               <li><a href="/users">User Management</a></li>
                                    <li><a href="/curbsideCategories">Curbside Post Categories</a></li>
                                    <li><a href="/roleManagement">Roles Management</a></li>
                                    <li><a href="/postManagement">Post Management</a></li>
                                    <li><a href="/abuseScan">Abuse Scan</a></li>
                                    <li><a href="/helpManagement">Help Management</a></li>
                                     <li><a href="/admin/networkConfig">Network Configuration</a></li>
                                     <li><a href="/admin/customBadges">Custom Badges</a></li>
                                    <?php if (Yii::app()->params['News'] == 'ON'){?>
                    <li><a href="/admin/content">Content Management</a></li>
                    <?php }?>
                    <li><a href="/communications">Communications</a></li>
                    
                    <?php if (Yii::app()->params['Advertisements'] == 'ON') { ?>
                    <li><a href="/advertisements/">Advertisements</a></li>
                    <?php }?>
                          </ul>
        

                        </li>
                         <?php } ?>
                
        </ul>
        </div>
        </div>