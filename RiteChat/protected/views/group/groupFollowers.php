
<?php if($offset==0 && is_object($groupFollowers)){?>
<div class="row-fluid groupseperator">
     <div class="span3 paddingtop18"><h2 class="pagetitle">Followers </h2></div>
          <div class="span9 ">
          <div class="grouphomemenuhelp alignright"></div>
          
          
          </div>
     
     </div>
<?php } ?>
<?php 
 if(is_object($groupFollowers)){?>

    <div class="row-fluid">
    <div class="span12">
                 <?php foreach($groupFollowers as $follower ){?>
        <!--<div id="stream_view_spinner_<?php // echo $follower->UserId?>" style="position:relative;"></div>-->
    <div class="span2">
       
    <div class="followersprofile" data-userId="<?php echo $follower->UserId?>" data-id="<?php echo $follower->UserId?>">
  
        
    <div class="f_p_picture"><img src=<?php echo $follower->profile250x250?> ></div>
    <div class="f_p_name"><?php echo $follower->DisplayName?></div>
    
    </div>
        
    </div>
        <?php }?>
        </div>
        </div>
<?php }
      else{
          echo $groupFollowers;
      }
?>