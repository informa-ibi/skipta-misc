                            <div  class="userLoveView <?php if ($data->PostType != 5 && $data->PostType != 13 && $data->CategoryType != 3) echo "";else echo "noinvite";?>" id="userLoveView_<?php  echo $data->PostId; ?>"  data-postId='<?php echo $data->PostId?>' data-count="<?php echo $data->LoveCount?>" style="display:none">
                         <?php 
                                 foreach ($data->loveUsersArray as $value) {
                                    echo $value."<br/>";
                                       }
                                   
                                      if($data->LoveCount>10){
                                         echo "<div data-actiontype='Love' data-postid='$data->PostId' data-id='$data->_id' data-categoryId='$data->CategoryType' class='moreUsers'>more...</div>" ;
                                      } 
                                 ?>
                         </div>