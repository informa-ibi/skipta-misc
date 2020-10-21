<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script>
<div id="usergroupsfollowingdiv">

    <div id="numero2"><h2 class="pagetitle">Toolboxes </h2></div><!-- This id numero2 is used for Joyride help -->
    <div style="display: none;width: 50%;text-align: center;margin: auto;" id="success_msg" class="alert alert-success" role="alert">
  Toolbox has been successfully deleted..! 
</div>


<div id="main" role="main">

      <ul id="MoreGroupsDiv" class="profilebox">
       
        <!-- End of grid blocks -->
      </ul>

    </div>
</div>
<div id="groupPostDetailedDiv" style="display: none;"></div>

<script type="text/javascript" >
     gPage = "Group";
Custom.init();
     $(document).ready(function(){   checkPrivateAndAutoFollow();   
        $("b[class=group]").live( "click", function(){ 
            var groupName=$(this).attr('data-name');
            window.location="/"+groupName;            
          // loadGroupDetailPage($(this).attr('data-id'));
        } );
        $("#streamMainDiv div[name=groupimage]").live( "click", function(){
           // var groupId=$(this).attr('data-id');
            //window.location='/group/groupdetail?data-id='+groupId
              var groupName=$(this).attr('data-name');
            window.location="/"+groupName;
          // loadGroupDetailPage($(this).attr('data-id'));          
         } );
        $("li[name=GroupDetail]").live( "click", function(){ 
            var groupName=$(this).attr('data-name');
            var customGroup = $(this).data("customgroup");   
            
                window.location="/"+groupName;            
            
          // loadGroupDetailPage($(this).attr('data-id'));
        } );
        getCollectionData('/group/GetAllGroupsToManage', 'GroupCollection', 'MoreGroupsDiv', 'No toolboxes found','No more toolboxes');
   
        trackEngagementAction("Loaded");  
    });
$("#grouppost").addClass('active');
    var startLimit=0;
    var pageLength=8;
    var userFollowingGroupsCount=0;
      bindGroupsForStreamFromIndex();
 
    
     $("#NewGroupReset").bind( "click touchend", 
        function(e){
           $('#addNewGroup').hide();           
           e.stopPropogation();
        }
    );
    $("#addGroup").bind( "click touchstart", 
        function(){
           $('#addNewGroup').show();
           $('#IFrameURLDiv').hide();
           $("#selectmode").html("Select mode type");
           $("#selectmenutype").html("Select menu type");
           $("#mode").val("");
           $("#custommenu").hide();
           $("#menutype").val("");
           $("#GroupCreationForm_GroupName,#GroupCreationForm_Description,GroupCreationForm_IFrameMode,GroupCreationForm_GroupMenu").val("")
           Custom.init();
        }
    );
    
    function showmoreGroups(){
       
	 scrollPleaseWait('groupsSpinLoader','groupslogoarea');         
        var query="startLimit=" +startLimit+ "&pageLength=" +pageLength;
        ajaxRequest('/group/getMoreFollowingGroups', query, moreGroupsFollowingHandler);
	}
        
        
        
      function moreGroupsFollowingHandler(data){
         scrollPleaseWaitClose('groupsSpinLoader');
        
        var item = {
            'data':data.data
        };
         if (data.data != "") 
         {
         
             $("#groupsFollowingId").append(
             $("#groupFollowingTmpl_render").render(item)      
                );
              
         }
         startLimit = Number(data.data.length) + Number(startLimit);
        if (data.length == 0) {
        $("#noRecordsTR").show();
        }
        if(data.data.length < userFollowingGroupsCount)
        {
            $("#moreFollowingGroupsId").show();
            var moreCount = Number(userFollowingGroupsCount)- Number(startLimit);
             $("#totalcount").html(moreCount)      
             
        }
        if(!detectDevices())
            $("[rel=tooltip]").tooltip();
    }

</script>
  

<script type="text/javascript">
  var handler = null;
    // Prepare layout options.
        var options = {
          itemWidth: '48%', // Optional min width of a grid item
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#MoreGroupsDiv'), // Optional, used for some extra CSS styling
          offset: 8, // Optional, the distance between grid items
          outerOffset: 10, // Optional the distance from grid to parent
          flexibleWidth: '50%', // Optional, the maximum width of a grid item
          align: 'left'
        };


      /**
       * Refreshes the layout.
       */
       var $window = $(window);
      function applyLayout() {
         
            
        options.container.imagesLoaded(function() {
            // Create a new layout handler when images have loaded.
            handler = $('#MoreGroupsDiv li');
            
        if ($window.width() < 753) {
         
            options.itemWidth = '100%';
            options.flexibleWidth='100%';

        }
           else if ($window.width() > 753 && $window.width() < 1000) {
            
            options.itemWidth = '48%';
           //   options = { flexibleWidth: '100%' };
             
            
        }else{
           
            options.itemWidth = '32.5%'; 
        }
       
            handler.wookmark(options);
            
        });
    };


    $("#mode").on('change',function(){
        var val = $(this).val();
        $("#GroupCreationForm_IFrameMode").val(val);  
        if(val == 2){
            $("#custommenu").show(); 
            $('#IFrameURLDiv,#groupVisibility').hide();
        }else{
            if(val == 1){
                $('#IFrameURLDiv').show();
                $("#groupVisibility").hide();
            }else{
                $('#IFrameURLDiv').hide();
                $("#groupVisibility").show();
            }
            $("#custommenu").hide();
        }
    });   
    
    $("#menutype").on('change',function(){
        var val = $(this).val();
        $("#GroupCreationForm_GroupMenu").val(val);
        
        
    });
        
 $window.resize(function() {
     
  applyLayout();
   
        });
//    $("[rel=tooltip]").tooltip();

  $(".stream_content a.deleteGroup").live( "click",   
        function(){
            var deleteConfirm = confirm("Do you really want to delete Toolbox?");
            if(deleteConfirm == true)
            {    
                var groupId = $(this).closest('div.social_bar').attr('data-groupid');
                //alert(groupId);
                deleteGroup(groupId);
                //$("#groupId_"+groupId).delay(3000).fadeOut();
                $("#groupId_"+groupId).hide('slow');
                $("#success_msg").css("display", "block");
                setTimeout(function(){ window.location.reload(); }, 3000);
                $("#success_msg").delay(5000).fadeOut();
                //window.location.reload();
                //applyLayout();
            }
            
            
        }
    );
  </script>
  <script type="text/javascript">
$(document).ready(function(){
                if(!detectDevices()){                   
                    $("[rel=tooltip]").tooltip();
                }
              });
        </script>