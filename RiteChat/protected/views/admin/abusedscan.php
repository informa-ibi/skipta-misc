<?php
include 'abuseWordCreationForm.php';
include 'miniProfileScript.php';
?>
         <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/YiiTagCloud.css" rel="stylesheet" type="text/css" media="screen" />  
            <h2 class="pagetitle positionrelative">Abuse Scan <i data-original-title="Abuse Scan" rel="tooltip" data-placement="bottom" class="fa fa-question helpicon top10 tooltiplink" id="AbuseScanHelpIcon" ></i></h2>
             <div class="alert alert-error" id="errmsgForAbuseScan" style='display: none'></div>
             <div class="alert alert-success" id="sucmsgForAbuseScan" style='display: none'></div>          
                            
             <div id="abusedWords_div" class="abusedWords_div editicondiv">
                
                    
             </div>
             <div id="abusedWords_Edit_div"  class="editabusetext" style="display: none">
                 <div class="row-fluid">
                     <div class="span12">
                         <textarea class="span12" id="editBlockWord"></textarea>
                        
                     </div>
                     
                 </div>
                 <div class="row-fluid">
                     <div class="span12">
                        <div class="alignright">
                            <input type="submit" value="Save"  class="btn" onclick="saveBlockWords()"> 
                            <input type="reset" value="Cancel" name="yt1" onclick="cancelEditBlockwordDiv();" class="btn btn_gray" >
                        </div>
                        
                     </div>
                     
                 </div>
                 
             </div>  
<?php $mainClass=(Yii::app()->params['Project']!='Trinity')?"streamsectionarea  streamsectionarearightpanelno":"";?>
<div class="<?php echo $mainClass ?>">             
    <div class="padding10 ">
        <h2 class="pagetitle">Blocked Posts</h2>
        <div id="abusedposts_div">
            <ul class="nav nav-tabs" id="AbusePostTabsB">
                <li class="active" style="cursor: pointer"><a id="posts" >Posts</a></li>
                 <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
                <li  style="cursor: pointer"><a id="curbsidePosts" ><?php echo $name;?></a></li>
                <li  style="cursor: pointer"><a id="groupPosts" >Group Posts</a></li>
            </ul>
            <div id="postsDisplayDiv" style="padding-bottom:10px;"></div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function(){
        //getCollectionDataWithPagination('/admin/getAbusedWords','AbuseKeywords', 'abusedWords_tbody',1,10, '');
        abusedTagCloud();
        getCollectionData('/admin/getnormalblockedposts', 'AbusedPostDisplayBean', 'postsDisplayDiv', 'No Posts found.','That\'s all folks!');
        abusedOnReadyEvents();
    });
</script>
