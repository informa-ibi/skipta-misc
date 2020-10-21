<div class="paddingt12" style="" id ="sidebarnavrightId">
        <div class="paddingl3r3">
           
            <div id="userNewFollowers" style="display: none"></div>
            <div id="userRecommendations" style="display: none"></div>
            <div id="userRecentGroupActivity" style=""></div>
           
            <div id="userEventsActivity" style="display: none"></div>           
             <?php if (Yii::app()->params['Games'] == 'ON') { ?>
            <!--game widget -->
            <div style="" id="userCurrentGameScheduleActivity"></div>
            <!-- gamewidget end -->
             <?php }?>
           
             <div id="FeaturedItemsDisplay"></div>
           
           
</div>
    </div>
 
 <script type="text/javascript">
           bindEventsForStream('rightSideSectionSeperation3');
           getNewFollowers('userNewFollowers');
           getUserRecommendations('userRecommendations');
           getRecentGroupActivities('userRecentGroupActivity');
           getEventSignedUpActivities('userEventsActivity');  
           <?php if (Yii::app()->params['Games'] == 'ON') { ?>
           getCurrentScheduleGame('userCurrentGameScheduleActivity');
           <?php }?>
           
             getFeaturedItems();
           
           
       function getNewFollowers(div)
       {
           
         var data ="";  
         var URL ="/user/getNewFollowersList";
         ajaxRequest(URL,data,function(data){getNewFollowersHandler(data,div)},"html");

        }
        function getNewFollowersHandler(html,div){ 
                 if(html !='failure' || html !='')
                       {
                           $("#sidebarnavrightId").show();
                           $("#rightSideSectionSeperation1").show();
                           $("#" + div).html(html).show();
                       }
                       else
                       {
                           $("#sidebarnavrightId").hide();
                           $("#rightSideSectionSeperation1").hide();
                           $("#" + div).hide();
                       }
           }
           
    /************************************/
    function getUserRecommendations(div)
    {
        var data ="";  
        var URL ="/user/getUserRecommendationsList";
        ajaxRequest(URL,data,function(data){getUserRecommendationsHandler(data,div)},"html");
    }
    
    function getUserRecommendationsHandler(html,div){         
        if(html !='failure' || html !='')
        {
            $("#sidebarnavrightId").show();
            $("#rightSideSectionSeperation1").show();
            $("#" + div).html(html).show();
        }
        else
        {
            $("#sidebarnavrightId").hide();
            $("#rightSideSectionSeperation1").hide();
            $("#" + div).hide();
        }
    }
    /************************************/
           
           
       function getRecentGroupActivities(div)
       {
           
            var URL ="/user/getRecentGroupActivities";
            var data ="";  
         ajaxRequest(URL,data,function(data){getRecentGroupActivitiesHandler(data,div)},"html");

           }
           function getRecentGroupActivitiesHandler(html,div){
               if(html != 'failure' || html != '')
                       {
                           $("#sidebarnavrightId").show();
                           $("#rightSideSectionSeperation1").show();
                           $("#" + div).html(html).show();
                       }
                       else
                       {
                           $("#sidebarnavrightId").hide();
                           $("#rightSideSectionSeperation1").hide();
                           $("#" + div).hide();
                       }
           }
     function getEventSignedUpActivities(div)
       {
            var URL ="/user/getUserSignedUpEvents";
            var data ="";  
          ajaxRequest(URL,data,function(data){getEventSignedUpActivitiesHandler(data,div)},"html");
 
           }
         function getEventSignedUpActivitiesHandler(html,div){
             if(html !='failure' || html !='')
                       {
                           $("#sidebarnavrightId").show();
                           $("#rightSideSectionSeperation3").show();
                           $("#" + div).html(html).show();
                       }
                       else
                       {
                           $("#sidebarnavrightId").hide();
                           $("#rightSideSectionSeperation3").hide();
                           $("#" + div).hide();
                       }
         } 
         
         
         function getCurrentScheduleGame(div)
       {
           
         var data ="";  
         var URL ="/user/getCurrentScheduleGameForRightsideWidget";
         ajaxRequest(URL,data,function(data){getCurrentScheduleGameHandler(data,div)},"html");

        }
        function getCurrentScheduleGameHandler(html,div){
                 if(html !='failure' || html !='')
                       {
                           $("#sidebarnavrightId").show();
                           $("#rightSideSectionSeperation1").show();
                           $("#" + div).html(html).show();
                       }
                       else
                       {
                           $("#sidebarnavrightId").hide();
                           $("#rightSideSectionSeperation1").hide();
                           $("#" + div).hide();
                       }
           }
           
 </script>
