
<?php if($followersCount > 0) {?>
<div class="rightwidget borderbottom1 padding-bottom10 " id="rightSideSectionSeperation2" >
    <div class="rightwidgettitle paddingt12">
        <i class="spriteicon"><img class="r_followers" src="/images/system/spacer.png"></i><span class="widgettitle"><?php echo Yii::t('translation','New_Followers'); ?></span>
    </div>

    <div class="r_followersdiv r_newfollowers">
        <ul >
            <?php
             $i=0;
            foreach ($newFollowersList as $data) {?>

                <li  class="tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->DisplayName ?> ">
                    <a  style="cursor:pointer" class="miniprofileicon miniprofileDetails" data-userid="<?php echo $data->UserId ?>">  
                              <?php
                    if ($data->profile70x70 !='') {
                         ?> 
                        <img src="<?php echo $data->profile70x70 ?>"> 
                        <?php } else{
                         ?>
                        <img src="/upload/profile/user_noimage.png">
                         <?php }?>
                    </a>
                </li>
                <?php }?>
            
        </ul>
    </div>
    <?php if ($followersCount ==5) {?>
                        <div class="more profileDetails alignright" style="cursor:pointer" data-userid="<?php echo $loggedUserId ?>">
                            <a href="/profile/<?php echo $this->tinyObject->DisplayName; ?>">more <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
<?php } ?>
    </div>
<?php }?>


    <script type="text/javascript">        
        $("a.miniprofileDetails").live("click",
            function() {
                var userId = $(this).attr('data-userid');
                getMiniProfile(userId);
            }
    );
    </script>
