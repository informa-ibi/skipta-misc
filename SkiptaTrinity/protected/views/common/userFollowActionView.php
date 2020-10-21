 
                            <div  class="userView" id="userFollowView_<?php  echo $data->PostId; ?>"  data-postId='<?php echo $data->PostId?>' data-count="<?php echo $data->FollowCount?>" style="display:none">
                         <?php 
                                 foreach ($data->followUsersArray as $value) {
                                    echo $value."<br/>";
                                       }
                                   
                                      if($data->FollowCount>10){
                                         echo "<div data-actiontype='Followers' data-postid='$data->PostId' data-id='$data->_id' data-categoryId='$data->CategoryType' class='moreUsers'>more...</div>" ;
                                      } 
                                 ?>
                         </div>
