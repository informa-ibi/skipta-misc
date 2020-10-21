<script id="groupFollowingTmpl_render" type="text/x-jsrender">
    
    
    <div class="leftboxarea minheightbox" id="leftboxarea">
    <div id="noRecordsTRgroupFollowing" style="display: none;text-align: center"">
   <span class="nopost" > <?php echo Yii::t('translation','not_following_any_groups'); ?></span>
   </div> <ul>
    {{for data}}
            <span id="temp_{{>_id.$id}}" style="display:none;"></span>
           <li class="userfollowinggroups" name="GroupDetail" data-id="{{>_id.$id}}" id="{{>_id.$id}}" data-categorytype="3" data-postid="{{>_id.$id}}" data-name="{{>GroupUniqueName}}" data-placement="bottom" rel="tooltip"  data-original-title="{{>GroupName}}">
                <a class="cursor impressionDiv" ><img src="{{if (GroupProfileImage == " " || GroupProfileImage == null || GroupProfileImage =='null')}} ../upload/group/profile/groupsnoimage.jpg {{else}} {{>GroupProfileImage}}{{/if}} "></a>
            </li>

       
        
    {{/for}} </ul>
     <div id="moreFollowingGroupsId" class="countarea" style="display:none">
        <a  class="cursor" onClick="showmoreGroups();">
            <span id="totalcount"></span>
            <i class="fa fa-caret-down"></i>
        </a>
    </div>
    </div>
    
    
</script>