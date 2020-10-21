<!-- Pop up  Content -->

<?php
try {
    ?>
   

           
          <div class=" stream_content positionrelative">
                <ul>
                    <li class="media">
                                <div  class="pull-left postdetail" >
                                    <?php if($badgingInfo->isCustom==1){ 
                                        $image= $badgingInfo->image_path;
                                        $i=explode('.', strrev($image));
                                        $ext=strrev($i[0]);
                                        $name=strrev($i[1])."_128x152.".$ext;                                        
                                        ?>
                                    
                                    <img src="<?php echo $name?>" />
                                    <?php }else{?>
				  <img src="<?php echo Yii::app()->params['ServerURL']; ?>/images/badges/<?php echo $badgingInfo->badgeName."_128x152.png ";?>" />				
                                    <?php }?>
				</div>
                                                <div class="media-body">
                                                    <!-- if($badgingInfo->has_level) echo "Level ". $badgeCollectionInfo->BadgeLevelValue -->
                                                     <div class="badgingheader <?php echo $badgingInfo->context?>Badgeheader"><?php echo " You just unlocked the $badgingInfo->badgeName "; echo " Badge!" ?></div>
                                                    
                                		 <p><?php echo $badgingInfo->description ?></p>
                       				 </div>
                              </li>
                </ul>
              <input type='hidden' value='<?php echo $badgeCollectionInfo->_id?>' id='BadgeShownToUser' />
            </div>
        

    <?php
} catch (Exception $exc) {
    
}
?>

