<div class="profile_icon"><img src="<?php
    if ($data->isGroupAdminPost == 'true' && $data->ActionType == 'Post') {
        echo $data->GroupImage;
    } else {
        echo $data->FirstUserProfilePic;
    }
    ?>" > 
</div>
