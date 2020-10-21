<script id="hashTagProfileTmpl_render" type="text/x-jsrender">
    {{for data.data}}            
    <div class="profilesummary" >
        <div class="media ">
            <div class="media-body">
                <div class="m_title hashtagSearchText" data-name="{{>HashTagName}}">#{{>HashTagName}}</div>
            </div>
        </div>
        <div id="hashtag_spinner"></div>
        <div class="pop_socialworks">
            <div class="social_bar">
                <a style="cursor:pointer" ><i   ><img id="hashTagFollowUnFollowImg" src="/images/system/spacer.png"  rel="tooltip" data-placement="bottom"  data-original-title={{if IsUserFollowing}} "Unfollow" {{else}} "Follow" {{/if}} class={{if IsUserFollowing}} "followbig" {{else}} "unfollowbig" {{/if}} {{if IsUserFollowing}} data-action="unfollow" {{else}} data-action="follow"{{/if}} onclick="followUnfollowHashTag('{{>HashTagId.$id}}')" ></i></a>
                <span><i class="tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="Conversations"><img src="/images/system/spacer.png" class=" converstionbig" ></i><b>{{>NumberOfPosts}}</b></span>
                <span><i class="tooltiplink"  data-placement="bottom" rel="tooltip"  data-original-title="Following"><img src="/images/system/spacer.png" class=" followingbig" ></i><b id="hashtagfollowersCount">{{>FollowersCount}}</b></span>
            </div>

        </div>
    </div>

    {{/for}}

</script>


