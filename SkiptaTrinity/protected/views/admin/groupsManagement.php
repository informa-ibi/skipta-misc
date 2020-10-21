<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script>
<?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>

<div>             
        <div class="padding10 ">
<?php }?>
        <h2 class="pagetitle">Group Management</h2>

        <div id="abusedposts_div">
            <div id="spinner_admin"></div>
            <ul class="nav nav-tabs" id="AbusePostTabs">
                <li class="active" style="cursor: pointer"><a id="groups" >Groups</a></li>
                 
                <li  style="cursor: pointer"><a id="subGroups" >Sub Groups</a></li>
                
            </ul>
            <div id="main" role="main">

      <ul id="MoreGroupsDiv" class="profilebox">
       
        <!-- End of grid blocks -->
      </ul>

    </div>
            <div id="postDetailDiv" style="padding-bottom:10px;display:none"></div>
        </div>
         
 <?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
        </div>
    </div>
<?php }?>
<script type="text/javascript">
    $(function(){
        getCollectionData('/admin/getGroupsInactive', 'GroupCollection', 'MoreGroupsDiv', 'No Groups found.','That\'s all folks!');
        //abusedOnReadyEvents();
        $("span.dd-tags").live( "hover", 
        function(){
           $(this).css('cursor','default');
        }
    );
    });
    $('#subGroups').live("click",function(){
         page = 1;
        isDuringAjax=false;
        $('#MoreGroupsDiv').empty();
         $(this).tab('show');
        getCollectionData('/admin/getSubGroupsInactive', 'SubGroupCollection', 'MoreGroupsDiv', 'No Sub Groups found.','That\'s all folks!');
    });
    $('#groups').live("click",function(){
         page = 1;
        isDuringAjax=false;
        $('#MoreGroupsDiv').empty();
         $(this).tab('show');
        getCollectionData('/admin/getGroupsInactive', 'GroupCollection', 'MoreGroupsDiv', 'No Groups found.','That\'s all folks!');
    });
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



        
 $window.resize(function() {
     
  applyLayout();
   
        });
//    $("[rel=tooltip]").tooltip();

  
  </script>
  <script type="text/javascript">
$(document).ready(function(){
                if(!detectDevices()){                   
                    $("[rel=tooltip]").tooltip();
                }
              });
        </script>