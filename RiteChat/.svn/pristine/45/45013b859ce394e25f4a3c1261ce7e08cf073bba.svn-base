<?php include 'miniProfileScript.php'; ?>
<?php include 'hashTagProfileScript.php'; ?>
<?php include 'commentscript.php'; ?>
<?php include 'detailedcommentscript.php'; ?>
<?php include 'commentscript_instant.php'; ?>
<?php include 'inviteScript.php'; ?>
<?php include 'newNode.php'; ?>
<div id="numero1"><h2 class="pagetitle">News</h2></div><!-- This id numero1 is used for Joyride help -->
<div id="newsfunnyspinner" style="position: relative;"></div>
<div id='ProfileInteractionDivContent' style="padding-bottom:40px;"></div>
<!-- news detailed page-->
    <div id="streamDetailedDiv" style="display: none"></div>
    <!-- end news detailed -->
<script type="text/javascript">
pF1 = 1;
pF2 = 1;

 gPage = "News";
$(document).ready(function(){
  getCollectionData('/news/index', 'StreamPostDisplayBean', 'ProfileInteractionDivContent', 'No News available at this point.', 'No more News available.');
  });
    var handler = null;
     var optionsC = {
          itemWidth: '100%', // Optional min width of a grid item
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#ProfileInteractionDivContent'), // Optional, used for some extra CSS styling
          offset: 20, // Optional, the distance between grid items
          outerOffset: 20, // Optional the distance from grid to parent
          flexibleWidth: '50%', // Optional, the maximum width of a grid item
          align: 'left'
        };
    var $window = $(window);
  
    function applyLayoutContent() {
        optionsC.container.imagesLoaded(function() {
            optionsC.container.imagesLoaded(function() {
            // Create a new layout handler when images have loaded.
            handler = $('#ProfileInteractionDivContent li.woomarkLi');
            
        if ($window.width() < 753) {
            optionsC.itemWidth = '100%';
            optionsC.flexibleWidth='100%';

        }
           else if ($window.width() > 753 && $window.width() < 1000) {
            optionsC.itemWidth = '100%';
        }else{
           
            optionsC.itemWidth = '40%'; 
        }
       
            handler.wookmark(optionsC);
            
        });
        });
        
    }
    $window.resize(function() {
    
     setTimeout(function(){
         applyLayout();    
     },200);
  
   
        });
    $('.showmore').live('click', function() {
        showMoreEditorial($(this).data('id'));
    });
    $('.minimize').live('click', function() {
        minimizeEditorial($(this).data('id'), $('.EDCRO' + $(this).data('id')).html());
    });
     $('.showmoreC').live('click', function() {
        showMoreEditorialC($(this).data('id'));
    });
    $('.minimizeC').live('click', function() {
        minimizeEditorialC($(this).data('id'), $('.HTMLC' + $(this).data('id')).html());
    });
   initializationForHashtagsAtMentions('div#editable');
   initializationForArtifacts();
   bindEventsForStream('ProfileInteractionDivContent');
   initializationEvents();
   
   
        
</script>

