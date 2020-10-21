<?php
//print_r($surveyUsersData);
//echo count($surveyUsersData);
if(count($surveyUsersData)> 0){ ?>
    
    <div class="row-fluid " id="userFollowUnfollowid">
  <?php  $i=0; foreach($surveyUsersData as $data){ ?>
<?php if($i == 0){ ?>
                        <div class="span12" style='margin-left: 0;margin-bottom:10px'>
                    <?php } ?>
                    <div class="span4">
<div class="media ">
         <a data-userid="<?php echo $data->UserId; ?>" data-name="<?php echo $data->UniqueHandle; ?>" style="cursor:pointer" class="pull-left marginzero smallprofileicon">
             <img src="<?php echo $data->ProfilePicture; ?>"></a>
    <div class="media-body" style="padding-top: 10px">
             <div data-name="<?php echo $data->UniqueHandle; ?>" data-userid="<?php echo $data->UserId; ?>" style="cursor:pointer" class="m_title justificationUser"><?php echo $data->DisplayName; ?></div>
<?php /*             <!--<span id="profile_aboutme" class="m_day italicnormal justifications">-->

                <?php if($QuestionType ==6){ ?>                 
                       <p><b>"<?php echo $data->SeeAnswersArray;?>"</b></p>
                  <?php
                   }else if($QuestionType == 7){ ?>
                       <p class="selected_opt">User generated Ranking Options: <b>
                       <?php foreach($data->UsergeneratedRankingOptions as $Rankdata){
                           if($Rankdata!=""){
                            echo '<p><b>"'.$Rankdata.'"</b></p>';
                           }
                       } ?>
                           </b></p>
                           <?php 
                   }
                ?>
                   
             </span> */ ?>
         </div>
    </div>
        
  </div>
                    <?php $i++; 
                        if($i>2){$i = 0;?>
                        </div>                        
                        <?php }                     
                      } ?>        
        
        </div>
<?php

 }else {
    echo 0;
 }
 
 ?>
