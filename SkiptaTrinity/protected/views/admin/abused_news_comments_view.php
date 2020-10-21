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
                            <?php if ($data->HtmlFragment != '') { ?>
                <a  class="pull-left img_single  postdetail" id='<?php echo $data->_id; ?>' data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->_id; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->Type; ?>">
                    <?php $object = stristr($data->HtmlFragment, '<object');
                    if ($object != '') {
                        ?>
                        <div class="galleria-info" style="bottom:0px"><div class="galleria-info-text" style="border-radius:0px"><div class="galleria-info-description" style="height:132px"></div></div></div>
                    <?php } ?>
                    <?php
                    $pattern = '/(width)="[0-9]*"/';
                    $string = $data->HtmlFragment;
                    $string = preg_replace($pattern, "width='180'", $string);
                    $pattern = '/(height)="[0-9]*"/';
                    $string = preg_replace($pattern, "height='150'", $string);

                    echo $string;
                    ?>
                </a>
<?php } ?>
              <div class="media-body" >
                            <?php if(strlen($data->Editorial)>0){?>
                        <div class="clearboth ">                          
                        <div class="decorated " style="margin-top: 0px"><?php echo $data->Editorial?></div></div>      
                        <?php }?>
                            <p class="cursor postdetail" id='<?php echo $data->_id; ?>' data-id="<?php echo $data->_id; ?>" data-postid="<?php echo $data->PostId; ?>" data-categoryType="<?php echo $data->CategoryType; ?>" data-postType="<?php echo $data->Type; ?>" data-news='yes'>
                               <?php echo $data->Description;?>
                            </p>
                            <p></p>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php 
                $categoryType = 8;
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
