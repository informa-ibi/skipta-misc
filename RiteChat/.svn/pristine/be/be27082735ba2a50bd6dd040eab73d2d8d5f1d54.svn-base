<header id="header">
    <div class="topheaderarea">
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <div class="span4">

                        <div class="noHeight">
                            <div class="row-fluid">
                                <div class="span12 min-height0">
                                    <div class="network_positionabsolutediv"  id="firstStop">
                                        <?php if (Yii::app()->session['IsAdmin'] == 1 && Yii::app()->session['UserStaticData']['Email'] != Yii::app()->params['NetworkAdminEmail'] && Yii::app()->params['PostAsNetwork'] == 'ON') { ?>
                                            <div class="aligncenter " id="networkmode" style='display:none' >
                                                <div class="networkmode">  
                                                    You’re conversing currently as &nbsp; <input type="checkbox" id="PostAsNetwork" data-on-label="<?php echo 'Admin' ?>" data-off-label="<?php echo substr(Yii::app()->session['UserStaticData']['FirstName'], 0, 12) ?>" />
                                                </div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </div></div>
                        </div>

                    </div>
                    <div class="span8">
                        <div class="top-search-area"> 
                            <div class="r_profilediv">

                                <a href="#" class="r_smallprofileicon" data-toggle="dropdown">
                                    <i><img id="profileImage_header" src='<?php echo $this->tinyObject->profile70x70; ?>'></i><span><img src="/images/system/spacer.png"> </span></a>
                                <div class="dropdown-menu r_profilewidth">
                                    <div class="padding4">
                                        <div class="r_headerpoptitle"><?php echo $this->tinyObject->DisplayName; ?></div>

                                        <ul>
                                            <li><?php echo CHtml::link('<i class="fa fa-user"></i>Profile', array("/profile/$uniqueHandle")); ?></li>
                                            <li class="gt_opts positionrelative ">
                                                <a href="#" data-original-title="Guided Tour" rel="tooltip" data-placement="bottom" ><i class="fa fa-lightbulb-o"></i>Tour </a>
                                                <div class="gt_switch positionabsolutediv" ><input type="checkbox" id="joyRideSwitch" data-on-label="OFF  " data-off-label="ON "  data-original-title="Guided Tour"/></div>
                                                <div class="clear"></div>
                                            </li>
                                            <li> <a href="/user/logout" onclick="logout()" ontouch="logout()"><i class="fa fa-power-off"></i>Logout</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="numero4" style="float:right;width:225px"> 
                                <div id="searchbox">

                                    <div id="searchtextbox" ><input type="text" autocomplete="off" id="SearchTextboxBt" name="SearchTextbox" placeholder="Search" class="ui-autocomplete-input" role="textbox" aria-autocomplete="list" aria-haspopup="true"> </div> <div id="searchtextboxbutton"> </div> 
                                    <div class="dropdown-menu searchwidth dropdown" id="search" >
                                        <div id="search_spinner"></div>
                                        <div class="padding4">
                                            <div class="r_headerpoptitle">Search<span id="searchContextId" class="searchcontext displayn"></span><span id="searchBackId"  onclick="searchBack()" class="pull-right displayn circleback"><i class="fa fa-arrow-left"></i></span></div>
                                            <div class="padding10">
                                                <div id="projectSearchDiv" style="min-height: 300px;overflow: auto">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div> 
                            </div> 
                            <div class="notification" >
                                <div class="not_header" id="notificationsLi">
                                    <a class="notificationlink"  data-toggle="dropdown" id="drop2" href="#">Notifications <span class="badge" id="notificationCount">0</span></a>
                                    <div class="dropdown-menu dropdownopen notificationwidth" id="notification">
                                        <div class="padding4">

                                            <div class="headerpoptitle" id="notificationsHeader"><span class="pull-left margin-right3" id="totalNotifications"></span>&nbsp; 
                                                <i class="fa fa-question helpicon helpmanagement helprelative pull-left notificationpopuphelp tooltiplink" data-id="Notifications_DivId" data-placement="bottom" rel="tooltip"  data-original-title="Notifications" ></i> <span class="pull-right"><a href="#" class="markallasread_notification markasreadlink"><i class="fa fa-check-circle-o"></i> Mark all as Read</a></span></div>
                                            <div id="notification_spinner"></div> 

                                            <div class="scroll" id="scrollDiv"><div id="renderNotification" ></div></div>
                                            <div id="settings" style="display: none;"></div>
                                            <div class="headerpopfooter headerpopfooterzero"> 
                                                <a href="#" class="pull-left cursorp"  id="notification_history">History</a>
                                                <a class="pull-right cursorp"   id="notification_settings">Settings</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> 

                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
    <div class="bottomheaderarea">
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <div class="span5">
                        <div class="navigation" id="headernavigation_normal">
                            <ul>

                                <li><a href="/stream" ><span <?php if ($this->whichmenuactive == 1) { ?>class="active"<?php } ?>>Stream</span></a></li>
                                <?php $name = Yii::t('translation', 'CurbsideConsult'); ?>
                                <li><a href="/curbsideConsult" ><span  <?php if ($this->whichmenuactive == 2) { ?> class="active"<?php } ?>><?php echo $name ?></span></a></li>


                                <li ><a href="/groups" id="groupmainmenu" class="submenu" ><span <?php if ($this->whichmenuactive == 3) { ?>class="active"<?php } ?>>Groups</span></a>

                                    <?php
                                    $userGroups = Yii::app()->session['UserFollowingGroups'];
                                    $i = 0;

                                    if (!empty($userGroups)) {
                                        ?>
                                        <div class="dropdown-menu dropdownmenudiv" id="GroupDiv">


                                           <ul id="GroupDiv" class="subnavinner  <?php if (sizeof($userGroups) == 1) { ?>subnavinnersingle<?php } ?>"  >
                                           


                                                <li id="mobiles_li" style="display: none;"><a href="/groups">Groups Home</a></li>
                                                <?php foreach ($userGroups as $group) { ?>
                                                    <?php if ($i <= 4) { ?>
                                                        <li><a href="/<?php echo $group['GroupName'] ?>"><?php echo $group['GroupName'] ?></a> </li>
                                                        <?php
                                                        $i++;
                                                    } else {
                                                        ?>
                                                        <li class="n_viewmore"><a href="/groups">View More</a></li>
                                                        <?php
                                                        break;
                                                    }
                                                    ?>
    <?php } ?>  




                                            </ul>
                                        </div>
<?php } ?>


                                </li>
                                <?php if (Yii::app()->params['News'] == 'ON') { ?>       
                                    <li><a href="/news/index" ><span  <?php if ($this->whichmenuactive == 5) { ?> class="active"<?php } ?>>News</span></a></li>          
<?php } ?>   
                            </ul>
                        </div>
                    </div>
                    <div class="span1"><div class="logo"><a><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/system/ritechat-logo.png"></a></div></div>
                    <div class="<?php echo Yii::app()->params['Chat'] == 'ON' ? 'span6' : 'span6 pull-right'; ?> ">
                        <div id="headernavigation_drop1" class="navigation">
                            <ul>

                                <?php if (Yii::app()->params['Chat'] == 'ON' && Yii::app()->session['UserPrivilegeObject']->canMessage == 1) { ?>
                                    <li><a onclick="divrenderget('chatDiv', '/chat/index')" style="cursor:pointer"><span <?php if ($this->whichmenuactive == 4) { ?>class="active"<?php } ?>>Messaging&nbsp;</span></a><span class="not_count " id="chatOffCount" style="display: none"></span></li>
                                <?php } ?>


                                <?php if (Yii::app()->params['QuickLinks'] == 'ON') { ?>       
                                    <li><a href="/quicklinks" ><span  <?php if ($this->whichmenuactive == 9) { ?> class="active"<?php } ?>>Quick Links</span></a></li>          
                                <?php } ?>   

                                <?php if (Yii::app()->params['Games'] == 'ON') { ?>       
                                    <li><a href="/game/index" ><span  <?php if ($this->whichmenuactive == 4) { ?> class="active"<?php } ?>>Games</span></a></li>          
                                <?php } ?>   

                                <?php if (Yii::app()->params['Careers'] == 'ON') { ?>       
                                    <li><a href="/career/index" ><span  <?php if ($this->whichmenuactive == 6) { ?> class="active"<?php } ?>>Careers</span></a></li>          
                                <?php } ?>  


                                <?php if (Yii::app()->session['IsAdmin'] == 1 && $this->userPrivilegeObject->canViewAnalytics == 1) { ?>

                                    <li ><a  href="/analytics" id="analytics"><span <?php if ($this->whichmenuactive == 7) { ?>class="active"<?php } ?>> Analytics</span></a></li>
                                <?php } ?>  

<?php if (Yii::app()->session['IsAdmin'] == '1') { ?>
                                    <li><a id="" class="submenu cursorp" ><span <?php if ($this->whichmenuactive == 8) { ?>class="active"<?php } ?>>Admin</span></a>
                                        <div class="dropdown-menu dropdownmenudiv">
                                            <ul class="sub" >                        
                                                <li><a href="/users">User Management</a></li>
                                                <li><a href="/curbsideCategories">Threaded Post Categories</a></li>
                                                <li><a href="/roleManagement">Roles Management</a></li>
                                                <li><a href="/postManagement">Post Management</a></li>
                                                <li><a href="/abuseScan">Abuse Scan</a></li>
                                                <li><a href="/helpManagement">Help Management</a></li>
                                                <?php if (Yii::app()->session['Email'] == 'ehauser@riteaid.com') { ?>
                                                    <li><a href="/admin/networkConfig">Network Configuration</a></li>
                                                <?php } ?>
                                                <?php if (Yii::app()->params['News'] == 'ON') { ?>
                                                    <li><a href="/admin/content">Content Management</a></li>
    <?php } ?>
                                                <?php if (Yii::app()->params['COMMUNICATIONS'] == 'ON') { ?>
                                                    <li ><a href="/communications">Communications</a></li>

                                                <?php } ?>


                                                <?php if (Yii::app()->params['Advertisements'] == 'ON') { ?>
                                                    <li><a href="/advertisements/">Advertisements</a></li>
    <?php } ?>
                                                    <li><a href="/admin/customBadges">Custom Badges</a></li>
                                            </ul>
                                        </div>
                                    </li>
<?php } else if (Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost == '1' || Yii::app()->session['UserPrivilegeObject']->canManageAbuseScan == '1') { ?>

                                    <li ><a class="submenu cursorp" ><span <?php if ($this->whichmenuactive == 8) { ?>class="active"<?php } ?>>Admin</span></a>
                                        <div class="dropdownmenudiv">
                                            <ul>    <?php if (Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost == '1') {?>
                                                    <li><a href="/postManagement">Post Management</a></li>
                                                    <?php }?>
                                                <ul> <?php if (Yii::app()->session['UserPrivilegeObject']->canManageAbuseScan == '1') {?>
                                                        <li><a href="/abuseScan">Abuse Scan</a></li>
                                                    <?php }?>


                                                </ul>
                                        </div>
                                    </li>
                                    
<?php } ?>
                            </ul>
                        </div></div>
                </div>
            </div>

        </div>

    </div>

</div>

</header>

<script type="text/javascript">      
 $(document).ready(function() {
 var groupNameLength = 0;
<?php if (!empty($userGroups)) {
    foreach ($userGroups as $group) {
        ?>
                var groupName = ("<?php echo $group['GroupName'] ?>").length;
                if (groupNameLength < groupName) {
                    groupNameLength = groupName;
                }
                $('#GroupDiv').css("width", groupNameLength * 8 + "px")
    <?php }
} ?>
    /* RiteChat Specific */
            });
        </script>
