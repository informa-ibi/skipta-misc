<?php include 'miniProfileScript.php'; ?>
<?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>

<div >             
        <div class="padding10 ">
<?php }?>
        <h2 class="pagetitle">Post Management</h2>

        <div id="abusedposts_div">
            <div id="spinner_admin"></div>
            <ul class="nav nav-tabs" id="AbusePostTabs">
                <li class="active" style="cursor: pointer"><a id="posts" >Posts</a></li>
                <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
                <li  style="cursor: pointer"><a id="curbsidePosts" ><?php echo $name?></a></li>
                <li  style="cursor: pointer"><a id="groupPosts" >Group Posts</a></li>
                <li  style="cursor: pointer"><a id="news" >News</a></li>
                <li  style="cursor: pointer"><a id="games" >Games</a></li>
                <li  style="cursor: pointer"><a id="featuredPosts" >Featured Items</a></li>
            </ul>
            <div id="postsDisplayDiv" style="padding-bottom:10px"></div>
            <div id="postDetailDiv" style="padding-bottom:10px;display:none"></div>
        </div>
         
 <?php if(Yii::app()->params['Project']!='SkiptaNeo'){?>
        </div>
    </div>
<?php }?>
<script type="text/javascript">
    $(function(){
        getCollectionData('/admin/getnormalabusedposts', 'AbusedPostDisplayBean', 'postsDisplayDiv', 'No Posts found.','That\'s all folks!');
        abusedOnReadyEvents();
        $("span.dd-tags").live( "hover", 
        function(){
           $(this).css('cursor','default');
        }
    );
    });
        breadCumSource = "Post Management";
sessionStorage.breadCumSource = "Post Management";
</script>