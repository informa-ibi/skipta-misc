<div class="profile_icon  <?php if($data->CategoryType==11)echo "networkStreamLogoColor"; ?>"><img src="<?php if($data->GameAdminUser==1){
                            echo $data->FirstUserProfilePic;
                        }
                       
                        else if($data->CategoryType==11 || $data->CategoryType==14)
                            echo $data->NetworkLogo;
                        elseif($data->isGroupAdminPost == 'true' && $data->ActionType=='Post') {
                           echo $data->GroupImage; 
                        }else{
                            echo $data->FirstUserProfilePic; } ?>" > </div>