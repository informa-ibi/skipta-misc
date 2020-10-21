<script id="miniProfileTmpl_render" type="text/x-jsrender">
    {{for data.data}}            
        {{for tinyUserCollection}}
    <div class="profilesummary" >
        <div class="media ">
            <a class="pull-left marginzero smallprofileicon profileDetails" style="cursor:pointer" data-name="{{>uniqueHandle}}" data-userid="{{>UserId}}">
                <img   src="{{>profile70x70}}">                  </a>
            <div class="media-body">
                <div class="m_title profileDetails" style="cursor:pointer" data-userid="{{>UserId}}" data-name="{{>uniqueHandle}}">{{>DisplayName}}</div>
                <span class="m_day italicnormal" id="profile_aboutme">{{>AboutMe}}</span>
            </div>
        </div>
        {{/for}}
        <div id="miniprofile_spinner_modal"></div>
        <div class="pop_socialworks">
            <div class="social_bar">
            {{for userProfileCollection}}
               {{if userId != loggedUserId &&  #parent.parent.data.data.networkmode =='0'}}
                    {{if #parent.parent.parent.data.data.networkAdmin == userId }}
                        <a ><i  ><img data-placement="bottom" rel="tooltip"  id="userFollowunfollowa_{{>userId}}"  {{if Status == 0}}  data-original-title="<?php echo Yii::t('translation','Follow'); ?>"  {{/if}} id="userFollowunfollowimg_{{>userId}}" src="/images/system/spacer.png" class={{if Status == 0}} "unfollowbig" {{else}} "followbig" {{/if}}></i></a>
                    {{else}}
                        <a style="cursor:pointer" ><i  ><img data-placement="bottom" rel="tooltip"  id="userFollowunfollowa_{{>userId}}"  {{if Status == 0}}  data-original-title="<?php echo Yii::t('translation','Follow'); ?>"  onclick="userFollowUnfollowActions('{{>userId}}','follow')" {{else}}   data-original-title="<?php echo Yii::t('translation','UnFollow'); ?>"  onclick="userFollowUnfollowActions('{{>userId}}','unfollow')"{{/if}} id="userFollowunfollowimg_{{>userId}}" src="/images/system/spacer.png" class={{if Status == 0}} "unfollowbig" {{else}} "followbig" {{/if}}></i></a>
                    {{/if}}
                {{/if}} 
                        {{if userId != #parent.parent.data.data.networkAdmin &&  #parent.parent.data.data.networkmode !='0'}}
                  
                        <a style="cursor:pointer" ><i  ><img data-placement="bottom" rel="tooltip"  id="userFollowunfollowa_{{>userId}}"  {{if Status == 0}}  data-original-title="<?php echo Yii::t('translation','Follow'); ?>"  onclick="userFollowUnfollowActions('{{>userId}}','follow')" {{else}}   data-original-title="<?php echo Yii::t('translation','UnFollow'); ?>"  onclick="userFollowUnfollowActions('{{>userId}}','unfollow')"{{/if}} id="userFollowunfollowimg_{{>userId}}" src="/images/system/spacer.png" class={{if Status == 0}} "unfollowbig" {{else}} "followbig" {{/if}}></i></a>
                  
                {{/if}} 
            {{/for}} 
            <span><i class="tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Conversations'); ?>"><img src="/images/system/spacer.png" class=" converstionbig" ></i><b>{{>postCollectionCount}}</b></span>
            {{for userProfileCollection}}
                <span><i class="tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Following'); ?>"><img src="/images/system/spacer.png" class=" followingbig" ></i><b id="followingcntb_{{>userId}}">{{>following}}</b></span>
                <span><i class="tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Followers'); ?>"><img src="/images/system/spacer.png" class=" followerbig" ></i><b id="followerscntb_{{>userId}}">{{>followers}}</b></span>
            {{/for}}             
            </div>

        </div>
         <div>
         {{if userBadgeCollection.length>1}}
            
               <div class="media-body" style="font-family: 'exo_2.0bold';"> Badges </div>
          
           <div class="padding4 clearfix badgeimages">
           {{for userBadgeCollection}}
                 {{if badgeName != "null" && badgeName != "" && badgeName != null}}
                        <span ><i class="tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="{{>hoverText}}"><img src="/images/badges/{{>badgeName}}_38x44.png" alt="{{>badgeName}}"  ></i></span>
                                            {{/if}}                          
                  
               {{/for}} 
           </div>
        {{/if}}
       </div>
       
    </div>

    {{/for}}

</script>
<?php //mini profile tmpl render script ?>

<script id="miniCurbsideCategoryProfileTmpl_render" type="text/x-jsrender">
     {{for data.data}}            
    <div class="profilesummary" >
    <div class="media ">
    <?php 
       if(Yii::app()->params['IsDSN']=='ON')
       { ?>
    <a class="pull-left marginzero smallprofileicon profileDetails" style="cursor:pointer" data-name="{{>uniqueHandle}}" data-userid="{{>UserId}}">
                <img   src="{{>ProfileImage}}">                  </a>
                    
       <?php } ?>
        
          <div class="media-body">
                <div class="m_title CurbsideCategorySearch" data-name="{{>CategoryName}}">{{>CategoryName}}</div>
            </div>
        </div>
        <div id="miniCurbsideCategory_spinner_modal"></div>
        <div class="pop_socialworks">
            <div class="social_bar">
                <a   class="tooltiplink cursor "><i><img id="curbsideCategoryIdFollowUnFollowImg" src="/images/system/spacer.png"  rel="tooltip" data-placement="bottom" data-original-title={{if IsUserFollowing}} "<?php echo Yii::t('translation','UnFollow'); ?>" {{else}} "<?php echo Yii::t('translation','Follow'); ?>" {{/if}}  class={{if IsUserFollowing}} "followbig" {{else}} "unfollowbig" {{/if}} {{if IsUserFollowing}} data-action="unfollow" {{else}} data-action="follow"{{/if}} onclick="followUnfollowCategory('{{>CategoryId}}')" ></i></a>
                <span><i><img src="/images/system/spacer.png" class=" converstionbig tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Conversations'); ?>" ></i><b>{{>NumberOfPosts}}</b></span>
<span><i><img src="/images/system/spacer.png" class="followingbig tooltiplink" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Following'); ?>" ></i><b id="curbsidecategoryFollowresCount">{{>FollowersCount}}</b></span>               
             </div>

        </div>
    </div>

    {{/for}}

</script>
