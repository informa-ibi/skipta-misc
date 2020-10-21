<?php 
if(isset($data)){ ?>    
    <?php foreach($data as $notification){ ?>
    <div class="padding10" >
        <div id="notificationSpinLoader_<?php echo $notification->_id;?>"></div>
                <div  class="notificationdata notificationdata_cl" >
                    <?php if(isset($notification->ProfilePic) && !empty($notification->ProfilePic)){ ?>
                <div class="media" >
                     
                  <a href="#" class="pull-left smallprofileicon">
                     
                    <img   src="<?php echo $notification->ProfilePic; ?>">   
                         </a> 
                  <div class="media-body">                   
                   
                      <div class="notifications_detailed m_day fontnormal" style="cursor: pointer" data-notificationflag="1" data-postid="<?php echo $notification->PostId;?>" data-id="<?php echo $notification->_id;?>" data-posttype="<?php echo $notification->PostType;?>" data-categorytype="<?php echo $notification->CategoryType; ?>" data-recentActivity="<?php echo $notification->RecentActivity; ?>"><?php echo $notification->NotificationString;?></div>
                   </div>
                </div>
                    <?php  }else{  ?>
                        <div class="media-body" style="cursor: pointer"> 
                            <div class="m_title"></div>
                             <div class="notifications_detailed m_day fontnormal" data-notificationflag="1"  data-postid="<?php echo $notification->PostId;?>" data-id="<?php echo $notification->_id;?>" data-posttype="<?php echo $notification->PostType;?>" data-categorytype="<?php echo $notification->CategoryType; ?>" data-recentActivity="<?php echo $notification->RecentActivity; ?>"><?php echo $notification->NotificationString;?></div>
                   </div>
                        
                    <?php }?>
                </div>
                <div class="notificationdate">
                <span class="m_day"><?php echo $notification->CreatedOn;?> </span>
                <a  class="markasreadlink" ><i data-placement="bottom" rel="tooltip"  data-original-title="Mark as read" data-notificationflag="1"  class="notification_marked fa fa-check-circle-o" style="cursor: pointer;" data-notificationflag="2" data-postid="<?php echo $notification->PostId;?>" data-id="<?php echo $notification->_id;?>" data-posttype="<?php echo $notification->PostType;?>" data-categorytype="<?php echo $notification->CategoryType; ?>"></i> </a>
                </div>
                
                 </div>

    <?php
    
    } ?>
<script type="text/javascript">
    $(document).ready(function()
        {
            if(!detectDevices()){                   
                        $("[rel=tooltip]").tooltip();
                    }
            jScrollPaneInitialize();
        });
</script>

<?php }
?>
