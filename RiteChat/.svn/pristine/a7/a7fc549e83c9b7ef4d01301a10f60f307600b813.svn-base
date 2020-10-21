<?php if(isset($featuredItems) && $featuredItems!='failure'){?>
    <div id="GalleryDiv" style="display: none">
        <div class="galleria">
         <?php foreach($featuredItems as $featured){
                             if($featured['ArtifactIcon']!='') {?>
            <a style="display: none;cursor: pointer" href="<?php echo str_replace('/thumbnails','/images',$featured['ArtifactIcon'])?>" data-original="<?php echo Yii::app()->request->baseUrl; ?>/post/renderPostDetailed?load=<?php echo $featured['CategoryType']."_".$featured['PostId']."_".$featured['PostType']?>" data-thumb="<?php echo $featured['ArtifactIcon']?>" data-categoryType="<?php echo $featured['CategoryType']?>" data-postId="<?php echo $featured['PostId'] ?>" data-postType="<?php echo $featured['PostType']?>"><?php  echo strip_tags($featured['PostText'])>100 ? strip_tags(substr($featured['PostText'],0,90)):strip_tags($featured['PostText']);?></a>
                           <?php }} ?>
        </div>
    </div>
 <?php }?>
<div class="rightwidget  paddingt12 ">

        <div class="rightwidgettitle ">
            <i class="spriteicon"><img src="/images/system/spacer.png" class="r_featurednews"></i><span class="widgettitle">Featured Items </span><i data-id="FeaturedItems_DivId" class="fa fa-question helpmanagement helpicon helprelative pull-right marginTR6 tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="Featured Items" ></i> 
        </div>
        <div class="border3">
          <div id="featureitemspinner" style="position: relative;"></div>
            <div id="FeaturedItemsGallery">
                
            </div>
        </div> 
        </div>
<style>
    .galleria{height:400px}
    
</style>
<script >
 Galleria.loadTheme('<?php echo Yii::app()->request->baseUrl; ?>/js/galleria.classic.min.js');  
            globalspace.featuredItems=1;
            loadGalleria();
        
    </script>