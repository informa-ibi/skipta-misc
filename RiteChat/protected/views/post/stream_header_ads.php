<div class="stream_title paddingt5lr10" style="position: relative"  >
    <?php echo $data->Title ?>
    <div class="postmg_actions">
        <i class="fa fa-chevron-down" data-toggle="dropdown" data-placement="right"></i>
        <i class="fa fa-chevron-up" data-toggle="dropdown" data-placement="right"></i>
        <div class="dropdown-menu ">
            <ul class="PostManagementActions" data-streamId="<?php echo $data->_id ?>"  data-postId="<?php echo $data->PostId ?>" data-categoryType="<?php echo $data->CategoryType ?>" data-networkId="<?php echo $data->NetworkId ?>">
                <?php if ($data->CanPromotePost == 1) { ?>
                    <li><a class="promote"><span class="promoteicon"><img src="/images/system/spacer.png" /></span> Promote</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>