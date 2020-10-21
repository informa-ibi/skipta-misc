<div class="sidebar-nav zindex560" id="menu_bar">
    <ul  id="menu">

        <li <?php if ($this->whichmenuactive == 1) { ?>class="active"<?php } ?> id="homestream"><a href="/stream" class="left_home-icon" > <span>Home</span></a></li>
        <li <?php if ($this->whichmenuactive == 2) { ?>class="active"<?php } ?> id="curbsidepost" ><a href="/curbsideConsult" class="left_curbside-icon"><span>Curbside</span></a></li>
        <li <?php if ($this->whichmenuactive == 3) { ?>class="active"<?php } ?> id="grouppost"  ><a href="/groups" id="groupmainmenu" class="left_groups-icon" ><span>Groups</span></a>

            <?php
            $userGroups = Yii::app()->session['UserFollowingGroups'];
            $i = 0;

            if (!empty($userGroups)) {
                ?>


                <ul id="GroupDiv" class="subnavinner  <?php if (sizeof($userGroups) == 1) { ?>subnavinnersingle<?php } ?>"  >
                    <li id="mobiles_li" style="display: none;"><a href="/groups">Groups Home</a></li>
                    <?php foreach ($userGroups as $group) { ?>
                        <?php if ($i <= 4) { ?>
                            <li ><a href="/<?php echo $group['GroupName'] ?> "><?php echo $group['GroupName'] ?></a> </li>
                            <?php $i++;
                        } else { ?>
                            <li class="last grey"><a href="/groups">View More</a></li>
                            <?php break;
                        } ?>

    <?php } ?>  



                </ul>

<?php } ?>
        </li>
         <?php if (Yii::app()->params['News'] == 'ON') { ?>
        <li   <?php if ($this->whichmenuactive == 5) { ?>class="active"<?php } ?> id="news"><a href="/news/index" class="left_news-icon" ><span>News</span></a></li>
        <?php }?>
        
         <?php if (Yii::app()->params['QuickLinks'] == 'ON') { ?>
        <li <?php if ($this->whichmenuactive == 9) { ?>class="active"<?php } ?> id="weblinks" ><a href="/quicklinks"   class="left_quicklinks-icon left_quicklinks-iconwidth"><span>Quick Links</span></a></li>
        <?php }?>    
        
        <?php if (Yii::app()->params['Games'] == 'ON') { ?>
        <li <?php if ($this->whichmenuactive == 4) { ?>class="active"<?php } ?> id="games" ><a href="/game/index"  class="left_games-icon" ><span>Games</span></a></li>
        <?php }?>
       
        <?php if (Yii::app()->params['Careers'] == 'ON') { ?>
        <li <?php if ($this->whichmenuactive == 6) { ?>class="active"<?php } ?> id="careers" ><a href="/career/index"   class="left_career-icon" ><span>Careers</span></a></li>
        <?php }?>
        
        <?php if (Yii::app()->session['IsAdmin'] == 1 && $this->userPrivilegeObject->canViewAnalytics==1) { ?>
            <li <?php if ($this->whichmenuactive == 7) { ?>class="active"<?php } ?> id="analytics" ><a href="/analytics"   class="left_analytics-icon" ><span>Analytics</span></a></li>

        <?php } ?>   
       

<?php if (Yii::app()->session['IsAdmin'] == 1) { ?>
            <li <?php if ($this->whichmenuactive == 8) { ?>class="active"<?php } ?> id="admin"  ><a class="left_admin-icon" ><span>Admin</span></a>
                <ul class="subnavinner" id="adminsubmenu">
                    <li ><a href="/users">User Management</a></li>
                    <li><a href="/admin/newCurbsideCategory">Curbside Categories</a></li>
                    <li><a href="/postManagement">Post Management</a></li>
                    <li><a href="/helpManagement">Help Management</a></li>
                    <li><a href="/admin/networkConfig">Network Configuration</a></li>
                    <!-- <li><a href="#">Account Management</a></li>-->
                    <?php if (Yii::app()->params['News'] == 'ON'){?>
                    <li><a href="/admin/content">Content Management</a></li>
                    <?php }?>
                    <li><a href="/communications">Communications</a></li>
                    <li><a href="/advertisements/">Advertisements</a></li>
                   
                </ul>

            </li>    
        <?php
        } else
        if (isset(Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost)) {

            if (Yii::app()->session['UserPrivilegeObject']->canManageFlaggedPost == '1') {
                ?>

                <li class="" id="admin"  ><a class="left_admin-icon" ><span>Admin</span></a>
                    <ul class="subnavinner subnavinnersingle" >
                        <li><a href="/postManagement">Post Management</a></li>                              

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
$("#grouppost").mouseover(function(){
    $("#menu_bar").attr("style","z-index:223");
    $("#footer").attr("style","z-index:9");
    if($("#contentDiv").is(":visible") == false){
        $("#contentDiv").attr("style","z-index:9").hide();
    }
    
}).mouseout(function(){
    $("#menu_bar").removeAttr("style");
    if($("#contentDiv").is(":visible") == false){
        $("#contentDiv").removeAttr("style").hide();
    }
    $("#footer").removeAttr("style");
});
$("#admin").mouseover(function(e){ 
    if (($("#adminsubmenu").offset().top + $("#adminsubmenu").height()) >= $(window).height()) { // if submenu touches the browser scroller then...
        var top = 0;
        if(Number($("#adminsubmenu").height()) > 150)
            top = $("#adminsubmenu").height()-150;
        else{
             top = $("#adminsubmenu").height();
        }
         $("#adminsubmenu").attr("style","top:-"+top+"px");
         $("#adminsubmenu").removeClass().addClass("subnavinner1");
        
    }else{
        $("#adminsubmenu").attr("style","top:0px");
        $("#adminsubmenu").removeClass().addClass("subnavinner");
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