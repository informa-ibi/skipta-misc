<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script>
<div class="row-fluid " id="postDetailedTitle">
     <div class="span6 "><h2 class="pagetitle"><?php echo Yii::t('translation','CareerDetail');?></h2>
    
     </div>
   </div>
<div role="main" id="main" >
    
    <ul id="jobsListIndex" class="profilebox" >
      
    </ul>
</div>

<div id="careerDetail" style="display:none">
    </div>
<script type="text/javascript" >
    
getCollectionData('/career/loadJobs', 'StreamPostDisplayBean', 'jobsListIndex', 'No jobs found','That\'s all folks!');    
    
$("#careers").addClass('active');
$("li.jobsList").live("click", function() {
    
    var id=$(this).attr('id');
    var isIframe=$(this).attr('data-IsIframe');
    if(isIframe==0){
        Global_ScrollHeight = $(document).scrollTop();
     renderPostDetailForCareer(id)    
    }
    
    
});

$(".detailed_close_page").live("click", function() {        
    $('#postDetailedTitle').show();
    $('#main').show();    
    
    applyLayout();
     $("html,body").scrollTop(Global_ScrollHeight);
    $('#careerDetail').html('').hide();
   // applyLayout();
    
});
$(" .PostManagementActions a.copyurl").live("click",function(){
//    alert($(this).html())
    var jobId = $(this).closest('ul.PostManagementActions').attr('data-jobid');
    loadPostSnippetWidget(jobId,'career');
});
 

var handler = null;
//    pF1 = 1;
//    pF2 = 1;
//    socket4Game.emit('clearInterval',sessionStorage.old_key);    
    gPage = "Career";
   //trackEngagementAction("Loaded"); 
   
     var optionsC = {
          itemWidth: '100%', // Optional min width of a grid item
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#jobsListIndex'), // Optional, used for some extra CSS styling
          offset: 20, // Optional, the distance between grid items
          outerOffset: 20, // Optional the distance from grid to parent
          flexibleWidth: '50%', // Optional, the maximum width of a grid item
          align: 'left'
        };
    var $window = $(window);
function applyLayout() {
        optionsC.container.imagesLoaded(function() {
            optionsC.container.imagesLoaded(function() {
            // Create a new layout handler when images have loaded.
            handler = $('#jobsListIndex li.jobsList');              
            
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
     $("#jobsListIndex").hide()
     setTimeout(function(){
         applyLayout();    
         $("#jobsListIndex").show()
     },200);
  
   
        });
</script>