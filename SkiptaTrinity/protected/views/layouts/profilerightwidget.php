 <div class="tr_left_pannel" >
<div class="tr_notification_div">
                    <div class=" row-fluid" style="position:relative">
                    <div class="pull-left" >
                        
                        
                        
                        
                        <div class="tr_top_profile margin10 " style="position:relative" id="drop3" data-toggle="dropdown" class="tooltiplink" data-placement="bottom" rel="tooltip" >
                        <a  class="myprofileicon" href="#">   <img src="<?php echo $this->tinyObject->profile70x70; ?>" /></a>
                      </div>
                      <div class="dropdown-menu leftheadermenuarea profilewidth">

               <form method="post" action="/sessions" accept-charset="UTF-8" style="margin: 0px">
                <div id="UserDisplayName"  class="headerpoptitle"><?php echo $this->tinyObject->DisplayName; ?></div>
                
                    <ul >
                        <li ><?php echo CHtml::link('<i class="fa fa-user"></i>Profile',array("profile/$uniqueHandle"),array("id"=>"userProfileLink")); ?></li>
                        <li ><a  href="/user/settings" style="cursor: pointer;"> <i class="fa fa-gear"></i> <?php echo Yii::t('translation','Settings'); ?> </a></li>
                        <li class="gt_opts positionrelative ">
                    <a href="#" data-original-title="Guided Tour" rel="tooltip" data-placement="bottom" ><i class="fa fa-lightbulb-o"></i>Tour </a>
                     
                    <div class="gt_switch positionabsolutediv" ><input type="checkbox" id="joyRideSwitch" data-on-label="OFF  " data-off-label="ON "  data-original-title="Guided Tour"/></div>
                    <div class="clear"></div>
                </li>
                  
                        <li> <a id="logoutId" onclick="logout()" ><i class="fa fa-power-off"></i>Logout</a></li>

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