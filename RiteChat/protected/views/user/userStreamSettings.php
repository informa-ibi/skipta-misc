<div class="" id="streamSettingsMessage" style="display: none;"></div>
<?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'usersettings-form',
                            'method'=>'post',
                            'enableClientValidation' => false,
                            'clientOptions' => array(
                                'validateOnSubmit' => false,
                                'validateOnChange' => false,
                            ),    
                            'htmlOptions' => array("style"=>"margin:0"),
                            
                                ));
                        ?>

                <div class="padding10 paddingzero10">
                <div class="notificationdata">
                <div class="media"> 
                  <div class="media-body">                   
                   <div class="m_day fontnormal">When your activity is Loved</div>
                   </div>
                </div>
                </div>
                <div class="notificationdate top5">                
                    <a href="#" class="markasreadlink">
                        <input type="checkbox" id="loved" name="settings" <?php echo $data->Loved?"checked":"";?> value="Loved" class="styled"/></a>
                </div>
                
                 </div>
                   
                   <div class="padding10 paddingzero10">
                <div class="notificationdata">
                <div class="media"> 
                  <div class="media-body">                   
                   <div class="m_day fontnormal">When your activity is Commented on</div>
                   </div>
                </div>
                </div>
                <div class="notificationdate top5">                
                    <a href="#" class="markasreadlink"><input type="checkbox" id="commented" name="settings" <?php echo $data->Commented?"checked":"";?> value="Commented" class="styled"/></a>
                </div>
                
                 </div>
                   
                   <div class="padding10 paddingzero10">
                <div class="notificationdata">
                <div class="media"> 
                  <div class="media-body">                   
                   <div class="m_day fontnormal">When your activity is Followed</div>
                   </div>
                </div>
                </div>
                <div class="notificationdate top5">                
                    <a href="#" class="markasreadlink"><input type="checkbox" id="activityFollowed" name="settings" <?php echo $data->ActivityFollowed?"checked":"";?> value="ActivityFollowed" class="styled"/></a>
                </div>                
                 </div>
                   <div id="streamSettingsLoader"></div>
                   <div class="padding10 paddingzero10">
                <div class="notificationdata">
                <div class="media"> 
                  <div class="media-body">                   
                   <div class="m_day fontnormal">When you've new Followers</div>
                   </div>
                </div>
                </div>
                <div class="notificationdate top5">                
                    <a href="#" class="markasreadlink"><input type="checkbox" id="userFollowers" name="settings" <?php echo $data->UserFollowers?"checked":"";?> value="UserFollowers" class="styled"/></a>
                </div>
                
                 </div>
                   
                   <div class="padding10 paddingzero10">
                <div class="notificationdata">
                <div class="media"> 
                  <div class="media-body">                   
                   <div class="m_day fontnormal">When you're Mentioned in a Conversation</div>
                   </div>
                </div>
                </div>
                <div class="notificationdate top5">                
                    <a href="#" class="markasreadlink"><input type="checkbox" id="mentioned" name="settings" <?php echo $data->Mentioned?"checked":"";?> value="Mentioned" class="styled"/></a>
                </div>
                
                 </div>
                   
                   <div class="padding10 paddingzero10">
                <div class="notificationdata">
                <div class="media"> 
                  <div class="media-body">                   
                   <div class="m_day fontnormal">When you're Invited to a Conversation</div>    
                   </div>
                </div>
                </div>
                <div class="notificationdate top5">                
                    <a href="#" class="markasreadlink"><input type="checkbox" id="invitedConversation" name="settings" <?php echo $data->Invited?"checked":"";?> value="Invited" class="styled"/></a>
                </div>
                
                 </div>
                   
                 
                <div class="padding10 paddingzero10">    
                      <div class="notificationdate top5 leftaligncheckbox">                
                    <a href="#" class="markasreadlink"><input type="checkbox" id="DailyDigest" name="settings" <?php echo $data->DailyDigest?"checked":"";?> value="DailyDigest" class="styled"/></a>
                </div>
                     <div class="notificationdate top5">
                      <?php echo CHtml::Button('Save',array('class' => 'btn pull-right','onclick'=>'saveSettings();')); ?> 
                   </div>
                <div class="notificationdata leftaligncheckboxtext">
                    
                <div class="media"> 
                  <div class="media-body">                   
                   <div class="m_day fontnormal">Also,send me a daily digest</div>    
                   </div>
                </div>
                </div>
               
                
                 </div> 
                  
           
              <?php $this->endWidget(); ?>
<script type="text/javascript">
Custom.init();
</script>