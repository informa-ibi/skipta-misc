<div class="sidebar-nav zindex560" id="menu_bar">
    <ul  id="menu">

        <li <?php if ($this->whichmenuactive == 1) { ?>class="active"<?php } ?> id="homestream"><a href="/stream" class="left_home-icon" > <span><?php echo Yii::t('translation','Home'); ?></span></a></li>
        <li <?php if ($this->whichmenuactive == 2) { ?>class="active"<?php } ?> id="curbsidepost" ><a href="/curbsideConsult" class="left_curbside-icon"><span><?php echo Yii::t('translation','Curbside'); ?></span></a></li>
        <?php $userGroups = Yii::app()->session['UserFollowingGroups']; ?>
        <li class="<?php if (isset($userGroups) && sizeof($userGroups) > 0) { ?> hovermenu <?php } ?> <?php if ($this->whichmenuactive == 3) { ?>active<?php } ?>" id="grouppost"  ><a href="/groups" id="groupmainmenu" class="left_groups-icon" ><span id="numeroUsers"><?php echo Yii::t('translation','GroupsLabel'); ?></span></a>

            <?php
            
            $i = 0;
            if (!empty($userGroups)) {
                ?>


                <ul id="GroupDiv" class="subnavinner  <?php if (sizeof($userGroups) == 1) { ?>subnavinnersingle subnavinnersinglegroup<?php } ?>"  >
                    <li id="mobiles_li" style="display: none;"><a href="/groups"><?php echo Yii::t('translation','GroupsLabel')." ".Yii::t('translation','Home'); ?></a></li>
                    <?php foreach ($userGroups as $group) { ?>
                        <?php if ($i <= 4) { ?>
                    <li ><a href="/<?php echo $group['GroupUniqueName'] ?> "><?php echo html_entity_decode($group['GroupName']) ?></a> </li>
                            <?php $i++;
                        } else { ?>
                            <li class="last grey"><a href="/groups"><?php echo Yii::t('translation','View_More'); ?></a></li>
                            <?php break;
                        } ?>

    <?php } ?>  



                </ul>

<?php } ?>
        </li>
         <?php if (Yii::app()->params['News'] == 'ON') { ?>
        <li   <?php if ($this->whichmenuactive == 5) { ?>class="active"<?php } ?> id="news"><a href="/news/index" class="left_news-icon" ><span><?php echo Yii::t('translation','News'); ?></span></a></li>
        
        <?php }?>
        
         <?php if (Yii::app()->params['QuickLinks'] == 'ON') { ?>
        <li <?php if ($this->whichmenuactive == 9) { ?>class="active"<?php } ?> id="weblinks" ><a href="/quicklinks"   class="left_quicklinks-icon left_quicklinks-iconwidth"><span><?php echo Yii::t('translation','Quick_Links'); ?></span></a></li>
        <?php }?>    
        
        <?php if (Yii::app()->params['Games'] == 'ON') { ?>
        <li <?php if ($this->whichmenuactive == 4) { ?>class="active"<?php } ?> id="games" ><a href="/game/index"  class="left_games-icon" ><span><?php echo Yii::t('translation','Games'); ?></span></a></li>
        <?php }?>
       
        <?php if (Yii::app()->params['Careers'] == 'ON') { ?>
        <li <?php if ($this->whichmenuactive == 6) { ?>class="active"<?php } ?> id="careers" ><a href="/career/index"   class="left_career-icon" ><span><?php echo Yii::t('translation','Careers'); ?></span></a></li>
        <?php }?>
        
        <?php if (Yii::app()->session['IsAdmin'] == 1) { ?>
            <li <?php if ($this->whichmenuactive == 7) { ?>class="active"<?php } ?> id="analytics" ><a href="/analytics"   class="left_analytics-icon" ><span><?php echo Yii::t('translation','Analytics'); ?></span></a></li>

        <?php } ?>   
       

<?php if (Yii::app()->session['IsAdmin'] == 1) { ?>
            <li class="hovermenu <?php if ($this->whichmenuactive == 8) { ?> active<?php } ?>" id="admin"  ><a class="left_admin-icon" ><span><?php echo Yii::t('translation','Admin'); ?></span></a>
                <ul class="subnavinner subnavinneradmin" id="adminsubmenu">

                    <li ><a href="/users"><?php echo Yii::t('translation','User_Management'); ?></a></li>
                    <li><a href="/admin/newCurbsideCategory"><?php echo Yii::t('translation','Curbside_Categories'); ?></a></li>
                    <li><a href="/postManagement"><?php echo Yii::t('translation','Post_Management'); ?></a></li>
                    <li><a href="/helpManagement"><?php echo Yii::t('translation','Help_Management'); ?></a></li>
                    <li><a href="/admin/networkConfig"><?php echo Yii::t('translation','Network_Configuration'); ?></a></li>
                    <!-- <li><a href="#">Account Management</a></li>-->
                    <?php if (Yii::app()->params['News'] == 'ON'){?>
                    <li><a href="/admin/content"><?php echo Yii::t('translation','Content_Management'); ?></a></li>
                    <?php }?>
                    <li><a href="/communications"><?php echo Yii::t('translation','Communications'); ?></a></li>
                    <li><a href="/advertisements/"><?php echo Yii::t('translation','Advertisements'); ?></a></li>
                   <?php if (Yii::app()->params['ESurvey'] == 'ON') { ?>
                    <li><a href="/marketresearchwall">Market dashboard</a></li>                    
                   <?php } ?>
                    <li><a href="/admin/getGroupsInactiveActive">Groups Management</a></li>   
                     <li><a href="/admin/broadcastnotifications"><?php echo Yii::t('translation','Broadcast_Notifications'); ?></a></li>   
                </ul>

            </li>    
        <?php
        } else
        if (isset(Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost)) {

            if (Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost == '1') {
                ?>

                <li class="hovermenu" id="admin"  ><a class="left_admin-icon" ><span><?php echo Yii::t('translation','Admin'); ?></span></a>
                    <ul class="subnavinner subnavinnersingle subnavinnersingleadmin" >

                        <li><a href="/postManagement"><?php echo Yii::t('translation','Post_Management'); ?></a></li>                              
                    
                    </ul>

                </li>
    <?php }
} ?>


    </ul>
</div>
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
                $('#GroupDiv').css("width", groupNameLength * 11 + "px")
    <?php }
} ?>
$("#grouppost,#admin").mouseover(function(){
  //  $("#menu_bar").attr("style","z-index:223");
       $("#menu_bar").css("z-index","1000");
    $("#footer").attr("style","z-index:561");
    if($("#contentDiv").is(":visible") == false){
        $("#contentDiv").attr("style","z-index:9").hide();
    }
    
}).mouseout(function(){
  //  $("#menu_bar,#footer").removeAttr("style");
     //$("#footer").removeAttr("style");
    if($("#contentDiv").is(":visible") == false){
        $("#contentDiv").removeAttr("style").hide();
    }    
});
$("#admin>a").mouseover(function(e){ 
    if (($("#adminsubmenu").offset().top + $("#adminsubmenu").height()) > $(window.top).height()+$(window).scrollTop()) { // if submenu touches the browser scroller then...
        var top = 0;
        top = Number($("#adminsubmenu").offset().top) + Number($("#adminsubmenu").height()) - Number($(window.top).height()) -Number($(window).scrollTop())+10;
         //$("#adminsubmenu").attr("style","top:-"+top+"px");
         //$("#adminsubmenu").removeClass().addClass("subnavinner1");
          $("#adminsubmenu").css("bottom","0");
        $("#adminsubmenu").css("top","auto");
        
    }

});
 if(detectDevices()){
     $("#headernavigation_normal,#headernavigation_drop1").removeClass("navigation").addClass("mobileheadernavigation");
     $(".submenu").attr("data-toggle","dropdown");
     $("#groupmainmenu").removeAttr("href");
     $("#mobiles_li").show();
 }
 else{ $("#mobiles_li").hide();}

    });
</script>