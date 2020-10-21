

        
<?php if($offset==1 && is_object($groupArtifacts)){?>

     <div class="row-fluid groupseperator">
<div class="span3 paddingtop18"><h2 class="pagetitle"><?php echo $page=="Image" ? "Media":"Resources" ?></h2></div>
          <div class="span9 ">
          <div class="grouphomemenuhelp alignright"></div>          
          
          </div>
     
     </div>
<?php }?>

 <?php if(is_object($groupArtifacts)){?>
<div class="artifactsshow<?php echo $offset?>">    
<div class="row-fluid">
    <div class="span12">
         
             <?php foreach($groupArtifacts as $artifact ){?>
        <!--<div id="stream_view_spinner_<?php // echo $artifact->PostId?>" style="position:relative;"></div>-->
    <div class="span2">
        <div class="followersprofile"  >
    <?php
           if(strtolower($artifact->Extension) == 'mov' || strtolower($artifact->Extension) == 'mp4'|| strtolower($artifact->Extension) == 'flv'){
                $videoclassName = 'GroupvideoThumnailDisplay ';
                                    
            }else {
                $videoclassName='GroupvideoThumnailNotDisplay';
            }
          
            ?>
    <div class="f_media_picture artifacts" data-offset="<?php echo $offset?>" data-id="<?php echo $artifact->PostId?>" data-resource="<?php echo $artifact->Uri?>" data-format="<?php echo strtolower($artifact->Extension); ?>">
        <div id='img_GroupVideoDiv_<?php echo $artifact->PostId?>' class='<?php echo $videoclassName;?>' ><img src="/images/icons/video_icon.png"></div>
        <img data-uri="<?php   echo $artifact->Uri;?>"  src="<?php if(isset($artifact->ThumbNailImage)){ echo $artifact->ThumbNailImage; }?> ">
    </div>
   
            <div class="f_p_name"><?php echo $artifact->ResourceName?></div>
    </div>
     
    </div>
       
   <?php }?>

    </div>
        
    </div>
</div>
   <?php }
   else{
          echo $groupArtifacts;
      }?>

