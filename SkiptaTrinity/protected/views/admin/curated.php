<?php 
if(is_object($stream)){
?>
<ul  class="profilebox" >
<?php foreach($stream as $data){?>
<?php if($data->IsAbused==0){?>
<li class="woomarkLi" id="<?php echo $data->_id?>">
<div class="customwidget_outer">
<div class="customwidget <?php echo $data->Alignment?>">
<div class="pagetitle"><a href="<?php echo $data->PublisherSourceUrl?>" target="_blank"><?php echo $data->Title?></a></div>
<div class="custimage" style="cursor: pointer" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8"><?php echo $data->HtmlFragment?></div>
<div class="customcontentarea"  >
    <div style="cursor: pointer" id="NDescription" class="cust_content HTMLC<?php echo $data->_id?>" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8">
<?php
$editorial=$data->Description;
           if(strlen($data->Description)>260)
           {
             $editorial=substr($editorial, 0,260);
             $editorial=$editorial.'<a  class="showmoreC" data-id="'.$data->_id.'">&nbsp<i class="fa  moreicon moreiconcolor">'.Yii::t('translation','Readmore').'</i></a>';
             echo $editorial;
           }
           else
           {
               echo $editorial;
           }
        ?>
</div>
<div class="customicons">
<?php if($data->Released==1){?>
<div class="cus_strip" style="float:left" id="SGRAPH_<?php  echo $data->_id ?>">
<div class="social_bar" style="border:0px;margin:0px" data-id="<?php  echo $data->_id ?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" >	
<span style="cursor:pointer">
<i><img src="/images/system/spacer.png" class="tooltiplink <?php if($data->IsAbused==0){?>unfollown<?php }else{?>unfollownd<?php }?>" data-placement="bottom" rel="tooltip"  data-original-title="Followers Count" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" ></i>
<b><?php  echo count($data->Followers) ?></b>
</span>
<span style="cursor:pointer">
<i><img  class="tooltiplink <?php if($data->IsAbused==0){?>unlikesn<?php }else{?>unlikesnd<?php }?>"   data-placement="bottom" rel="tooltip"  data-original-title="Love Count" src="/images/system/spacer.png" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" ></i>
<b ><?php  echo count($data->Love)?></b>
</span>
<span style="cursor:pointer">
<i><img class="tooltiplink <?php if($data->IsAbused==0){?>commentsn<?php }else{?>commentsnd<?php }?>" src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Comments Count"  data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" ></i>
<b><?php  echo count($data->Comments)?></b>
</span>              
</div>
</div>
<?php }?>

<div class="cus_strip">
    <a class="cursor" id="E_<?php echo $data->_id?>" data-id="E_<?php echo $data->_id?>"><i  data-placement="bottom" rel="tooltip"  data-original-title="Editorial Coverage" class="fa fa-pencil-square-o"></i></a>
<?php if($data->Released==1){?>
<a <?php if($data->IsNotifiable==0){?>class="cursor"<?php }else{?>style="background:#ccc;margin-left:3px"<?php }?> id="N2S_<?php echo $data->_id?>" data-id="N2S_<?php echo $data->_id?>"><i data-placement="bottom" rel="tooltip"  data-original-title="Notify Users" class="fa fa-bullhorn" ></i></a>
<a <?php if($data->IsFeatured==0){?>class="cursor"<?php }else{?>style="background:#ccc;margin-left:3px"<?php }?> id="MASFI_<?php echo $data->_id?>" data-id="MASFI_<?php echo $data->_id?>"><i  data-placement="bottom" rel="tooltip"  data-original-title="Mark As Featured Item" class="fa fa-star"></i></a>
<a <?php if($data->IsAbused==0){?>class="cursor" <?php }else{?>style="background:#ccc;margin-left:3px"<?php }?> id="PB_<?php echo $data->_id?>" data-id="PB_<?php echo $data->_id?>"><i data-placement="bottom" rel="tooltip"  data-original-title="Pullback News" class="fa fa-mail-reply"></i></a>
<?php }?>
<?php if($data->Released==0){?>

<a class="cursor" id="R_<?php echo $data->_id?>" data-id="R_<?php echo $data->_id?>"><i data-placement="bottom" rel="tooltip"  data-original-title="Release" class="fa fa-paper-plane"></i></a>
<a class="cursor" id="D_<?php echo $data->_id?>" data-id="D_<?php echo $data->_id?>"><i data-placement="bottom" rel="tooltip"  data-original-title="Delete" class="fa fa-trash-o" ></i></a>
<?php }?>

</div>
</div>
</div>
<div style="color: #017BC4;font-family:'exo_2.0bold';padding-top:5px;text-align: right;"><?php echo $data->TopicName?></div>

<div class="row-fluid">

<div  class="decorated span12 EDCRO<?php echo $data->_id?>" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8">
<?php if($data->Editorial!='')
         {
            $tagsFreeDescription = strip_tags(($data->Editorial));
           $tagsFreeDescription = str_replace("&nbsp;", " ", $tagsFreeDescription);
           $descriptionLength = strlen($tagsFreeDescription);                      
           $editorial=$data->Editorial;
           if($descriptionLength>240)
           {
            $editorial=CommonUtility::truncateHtml($data->Editorial, 240);  
             $editorial=$editorial.'<a  class="showmore" data-id="'.$data->_id.'">&nbsp<i class="fa  moreicon moreiconcolor">'.Yii::t('translation','Readmore').'</i></a>';
             echo $editorial;
           }
           else
           {
               echo $editorial;
           }
         }
         else
         {
         echo 'Ediotorial Coverage Here';
         }?>
</div></div>
    
    <div class="row-fluid">
    <div  class="decorated span12 EDCROT<?php echo $data->_id?>" style="display: none" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8">
    
    </div>

</div>
<div class=" EC<?php echo $data->_id?>" style="display:none">
<div class="">
<div class="row-fluid">
<div class="span12">
    <div id="editable<?php echo $data->_id?>" type="text" data-id="<?php echo $data->_id?>" value="" contentEditable="true" class="placeholderNews inputor EDC<?php echo $data->_id?>" style="min-height: 50px"><?php echo $data->Editorial?></div>
<div class="control-group controlerror">
<div id="EDCE<?php echo $data->_id?>" class="errorMessage" style="display: none;">Editorial Coverage cannot be blank.</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span12">
<div class="pull-right paddingT10" >
<input class="btn save"  name="yt0" type="button" value="Save" data-id='<?php echo $data->_id?>'> 
<input class="btn btn_gray cancel" data-id="<?php echo $data->_id?>"  type="reset" name="yt1" value="Cancel"> 
</div>
</div>
</div>
</div>
</div>
<div class="customcontentarea">
<div class="custfrom "><a href="<?php echo $data->PublisherSourceUrl?>" target="_blank"><?php echo $data->PublisherSource?></a> - <a class="ntime" style="cursor:default;text-decoration:none">
    <?php if($data->Released==1){?>
    <?php  echo CommonUtility::styleDateTime($data->CreatedOn->sec);?>
    <?php }else{?>
    <?php  echo CommonUtility::styleDateTime(strtotime($data->PublicationDate));}?>
    </a>
    <div style="text-align:right" class="nright">via <a style="cursor:default;text-decoration:none">Scoop.it!</a></div>
</div>
</div>
</div>
</div>
</li>
<?php }?>
<?php }?>
</ul>
<?php
      }else{
          echo $stream;
      }
?>
<script type="text/javascript">
    //initializationForHashtagsAtMentions('div#editable');
    //for hashtags
    $(".decorated" + " span.hashtag>b").live("click",
            function() {
                var streamId = $(this).closest('div').attr('data-id');
                var hashTagName = $.trim($(this).text());                
                getHashTagProfile(hashTagName,streamId);                 
            }                  
    );
     $('.placeholderNews').live("keyup", function(){
         $(this).trigger('heightChange');       
   });
    
     $('.placeholderNews').on("heightChange", function(){
       applyLayoutContent();
   });
    $('.placeholderNews').bind("cut copy paste", function(e) { 
            var $this = $(this); //save reference to element for use laster
            setTimeout(function() { //break the callstack to let the event finish
               $this.html($this.text());
        }, 10); 
       });
  </script>  