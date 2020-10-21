<script id="subGroupFollowingTmpl_render" type="text/x-jsrender">
    
    
    <div class="leftboxarea minheightbox" id="leftboxarea">
    <div id="noRecordsTRgroupFollowing" style="display: none;text-align: center"">
   <span class="nopost" > <?php echo Yii::t('translation','You_Not_Following'); ?></span>
   </div> <ul>

   {{if data!='failure'}}
    {{for data}}
        <span id="temp_{{>_id.$id}}" style="display:none;"></span>
            <li  class="userfollowinggroups" name="GroupDetail" data-id={{>_id.$id}} data-name="{{>SubGroupUniqueName}}" data-placement="bottom" rel="tooltip"  data-original-title="{{>SubGroupName}}">
                <a  class="cursor"><img src="{{if (SubGroupProfileImage == " " || SubGroupProfileImage == null || SubGroupProfileImage =='null')}} ../upload/group/profile/groupsnoimage.jpg {{else}} {{>SubGroupProfileImage}}{{/if}} "></a>
            </li>

       
        
    {{/for}} 
            {{/if}}
                    </ul>
     <div id="moreFollowingGroupsId" class="countarea" style="display:none">
        <a  class="cursor" onClick="showmoreSubGroups({{>GroupId}});">
            <span id="totalcount"></span>
            <i class="fa fa-caret-down"></i>
        </a>
    </div>
    </div>
    
    
</script>