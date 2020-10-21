<?php  
 if(is_object($abusedposts))
      {
    foreach($abusedposts as $data){
?>
<div class="post item" style="width:100%;" id="postitem_<?php  echo $data->_id; ?>" >
    <div class="stream_widget">
        <div class="profile_icon"><img src="<?php  echo $data->UserProfilePic ?>" > </div>
        <div class="post_widget">
            <div class="stream_msg_box">
                <div class="stream_title paddingt5lr10" style="position: relative"> <a class="userprofilename" data-streamId="<?php echo $data->_id; ?>" data-id="<?php  echo $data->UserId?>"  style="cursor:pointer"><b><?php  echo $data->UserDisplayName?></b></a> <?php echo $data->PostTypeString ?> <i><?php  echo $data->CreatedOn; ?></i>
                   </div>
                <div class=" stream_content">
                    <ul>
                        <li class="media">
                            <div class="media-body">
                                <?php  echo $data->GameDescription; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <input id="postdetail_<?php  echo $data->_id; ?>" type="hidden" value="<?php echo $data->GameName ?>/0/detail/game" />
            <?php 
        $categoryType = 9;
        include 'abusedComments.php';?>
        </div>
    </div>
</div>
<?php  }?>
    <?php 
      }else{
          echo $abusedposts;
      }
?>
