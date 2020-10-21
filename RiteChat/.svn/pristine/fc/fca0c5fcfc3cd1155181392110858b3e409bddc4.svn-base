<?php 
if(is_object($stream)){
?>
<ul  class="profilebox" >
<?php foreach($stream as $data){?>
<li class="woomarkLi" id="<?php echo $data->_id?>">
<div class="customwidget_outer">
<div class="customwidget <?php echo $data->Alignment?>">
<div class="pagetitle"><a href="<?php echo $data->PublisherSourceUrl?>" target="_blank"><?php echo $data->Title?></a></div>
<div class="custimage"><?php echo $data->HtmlFragment?></div>
<div class="customcontentarea">
<div class="cust_content HTMLC<?php echo $data->_id?>">
<?php
$editorial=$data->Description;
           if(strlen($data->Description)>260)
           {
             $editorial=substr($editorial, 0,260);
             $editorial=$editorial.'<a data-placement="bottom" rel="tooltip"  data-original-title="show more" class="showmoreC" data-id="'.$data->_id.'">...</a>';
             echo $editorial;
           }
           else
           {
               echo $editorial;
           }
        ?>
</div>
<div class="customicons">
<div class="cus_strip" style="float:left" id="SGRAPH_<?php  echo $data->_id ?>">
<div class="social_bar" style="border:0px;margin:0px" data-id="<?php  echo $data->_id ?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" >	
<span style="cursor:pointer">
<i><img src="/images/system/spacer.png" class="tooltiplink unfollownd" data-placement="bottom" rel="tooltip"  data-original-title="Followers Count" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" ></i>
<b><?php  echo count($data->Followers) ?></b>
</span>
<span style="cursor:pointer">
<i><img  class="tooltiplink unlikesnd"   data-placement="bottom" rel="tooltip"  data-original-title="Love Count" src="/images/system/spacer.png" data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" ></i>
<b ><?php  echo count($data->Love)?></b>
</span>
<span style="cursor:pointer">
<i><img class="tooltiplink commentsnd" src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Comments Count"  data-id="<?php echo $data->_id;?>" data-postid="<?php  echo $data->_id ?>" data-postType="11" data-categoryType="8" ></i>
<b><?php  echo count($data->Comments)?></b>
</span>              
</div>
</div>
</div>
</div>
<div style="color: #017BC4;font-family:'exo_2.0bold';padding-top:5px;text-align: right;"><?php echo $data->TopicName?></div>

<div class="customcontentarea">
<div class="custfrom "><a href="<?php echo $data->PublisherSourceUrl?>" target="_blank"><?php echo $data->PublisherSource?></a> - <a class="ntime" style="cursor:default;text-decoration:none"><?php echo CommonUtility::styleDateTime(strtotime($data->PublicationDate));?></a>
    <div style="text-align:right" class="nright">via <a style="cursor:default;text-decoration:none">Scoop.it!</a></div>
</div>
</div>
</div>
</div>
</li>
<?php }?>
</ul>
<?php
      }else{
          echo $stream;
      }
?>