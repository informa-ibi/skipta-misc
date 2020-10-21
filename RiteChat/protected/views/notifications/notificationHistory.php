<?php

/**
 * @author Karteek V
 *  
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($data) && !empty($data)){ ?>

    <div class="notificationresults">
        <div id="notificationSpinLoader"></div>
        <?php foreach($data as $notification){ ?>
<div class="read <?php echo $notification->IsRead?'':'unread';?>" id="read_<?php echo $notification->_id;?>">
   	<div class="padding10">
             <div id="notificationSpinLoader_<?php echo $notification->_id;?>"></div>
             <div id="stream_view_spinner_<?php echo $notification->_id;?>"></div>
                <div class="notificationdata">
                    <?php if(isset($notification->ProfilePic) && !empty($notification->ProfilePic)){ ?>
                <div class="media">
                  <a class="pull-left marginzero smallprofileicon" href="#">
                    <img src="<?php echo $notification->ProfilePic; ?>">                  </a>
                  <div class="media-body ">
                   <div class="media_fontnormal">
                       <?php if($notification->NotificationType == ""){?>
                             <div class="notifications_detailed m_day fontnormal" style="cursor: pointer" data-notificationflag="2"  data-postid="<?php echo $notification->PostId;?>" data-id="<?php echo $notification->_id;?>" data-posttype="<?php echo $notification->PostType;?>" data-categorytype="<?php echo $notification->CategoryType; ?>" data-recentActivity="<?php echo $notification->RecentActivity; ?>"><?php echo $notification->NotificationString;?></div>
                       <?php }else{ ?>
                            <div class="m_day fontnormal" style="cursor: pointer" data-notificationflag="2" ><?php echo $notification->NotificationString;?></div>
                       <?php } ?>

                   </div>
                      <div class="m_day "><?php echo $notification->CreatedOn;?></div>
                   </div>
                </div>
                    <?php }else{ ?>
                    <div class="media-body ">
                   <div class="media_fontnormal">
                  
                    <div class="notifications_detailed m_day fontnormal" style="cursor: pointer" data-notificationflag="2" data-postid="<?php echo $notification->PostId;?>" data-id="<?php echo $notification->_id;?>" data-posttype="<?php echo $notification->PostType;?>" data-categorytype="<?php echo $notification->CategoryType; ?>" data-recentActivity="<?php echo $notification->RecentActivity; ?>"><?php echo $notification->NotificationString;?></div>

                   </div>
                        <div class="m_day "><?php echo $notification->CreatedOn;?></div>
                   </div>
                    <?php } ?>
                </div>
                <div class="notificationdate">                    
                    <a class="markasreadlink" rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Mark as read"><i  class="notification_marked fa fa-check" style="cursor: pointer;" data-notificationflag="2" data-postid="<?php echo $notification->PostId;?>" data-id="<?php echo $notification->_id;?>" data-posttype="<?php echo $notification->PostType;?>" data-categorytype="<?php echo $notification->CategoryType; ?>"></i> </a>
                </div>
                 </div>
                 </div>
        
        <?php  } ?>

    </div>
<script type="text/javascript">
//  $(function(){$('[rel=tooltip').tooltip();});
   $(".userprofilename_notification").live("click",
            function() {
                var notificationId = $(this).attr('data-notid');
                var userId = $(this).attr('data-id');
                getMiniProfile(userId,notificationId);
            }
    );

  $(window).bind("scroll", function()
    {
        if($(window).scrollTop() == $(document).height() - $(window).height())
        {
            if(!notificationAjax){ 
                $("#notificationHistory_loading").show();
                socketNotifications.emit("getAllNotificationByUserId",loginUserId,startLimit);
            }
        }
    });

</script>
<?php }?>
