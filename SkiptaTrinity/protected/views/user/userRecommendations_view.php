
<?php if($userRecommendationsCount > 0) {?>
<div class="rightwidget borderbottom1 padding-bottom10 " id="rightSideSectionSeperation2" >
    <div class="rightwidgettitle paddingt12">
        <i class="spriteicon"><img class="recommended_followers" src="/images/system/spacer.png"></i><span id="numeroUsers" class="widgettitle"><?php echo Yii::t('translation','Recommended_Users'); ?></span>
    </div>

    <div class="r_followersdiv r_newfollowers">
        <ul>
            <?php
            foreach ($userRecommendationsList as $data) {?>

                <li  class="tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo $data->DisplayName ?> ">
                    <a  style="cursor:pointer" class="miniprofileicon miniprofileDetails" data-userid="<?php echo $data->UserId ?>">  
                    <?php
                    //echo $data->UserId;
                    if ($data->profile70x70 !='') {
                         ?> 
                        <img src="<?php echo $data->profile70x70 ?>"> 
                        <?php } else{
                         ?>
                        <img src="/upload/profile/user_noimage.png">
                         <?php }?>
                    </a>
                </li>
                <?php } ?>
            
        </ul>
    </div>   
    </div>
<?php }?>


<script type="text/javascript">
$( document ).ready(function() {
    $("[rel=tooltip]").tooltip();
});

$("a.miniprofileDetails").live("click",
    function() {
        var userId = $(this).attr('data-userid');
        getMiniProfile(userId);
    }
);
</script>
