
<?php if($offset==0 && is_object($groupFollowers)){?>

<div class="r_followersdiv r_newfollowers borderzero storeborder-top">
                       
                                                           <ul class="borderzero pull-right">
                                                               <li><div class="storemembers">Store Members</div></li>
                                                               <li class="storelist storelistpaddingzero">
                                                                   <div class="storeuserCount storeusermembersCount">
                                                                       <div class="storecount"><?php echo $totalStoreUsers?></div>
                                                                       
                                                                   </div>
                                                               </li>
                                                               
                                                           </ul>
                                                            
                                                            
                                                        </div>
<?php } ?>
<?php 
 if(is_object($groupFollowers)){?>

    <div class="row-fluid">
    <div class="span12">
                 <?php foreach($groupFollowers as $follower ){?>
        <!--<div id="stream_view_spinner_<?php // echo $follower->UserId?>" style="position:relative;"></div>-->
    <div class="span3">
       
    <div class="followersprofile userprofilename" data-userId="<?php echo $follower->UserId?>" data-id="<?php echo $follower->UserId?>">
  
        
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