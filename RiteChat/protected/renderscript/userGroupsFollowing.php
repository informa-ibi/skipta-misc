<script id="groupFollowingTmpl_render" type="text/x-jsrender">
    
    
    <div class="leftboxarea minheightbox" id="leftboxarea">
    <div id="noRecordsTRgroupFollowing" style="display: none;text-align: center"">
   <span class="nopost" > You are not following any toolboxes </span>
   </div> <ul>
    {{for data}}
    
           <li name="GroupDetail" data-id={{>_id.$id}} data-name="{{>GroupName}}" data-placement="bottom" rel="tooltip"  data-original-title="{{>GroupName}}">
                <a  class="cursor" ><img src="{{if (GroupProfileImage == " " || GroupProfileImage == null || GroupProfileImage =='null')}} ../upload/group/profile/groupsnoimage.jpg {{else}} {{>GroupProfileImage}}{{/if}} "></a>
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