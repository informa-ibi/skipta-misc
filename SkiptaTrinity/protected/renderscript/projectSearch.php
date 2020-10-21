<script id="userSearchTmpl" type="text/x-jsrender"> 
    {{for users}}
   
  <div class="padding4 bordertop bghover ">
        <div class="positionrelative ">
          <a class="smallprofileicon s_p_icon" href="#">
              <img src="{{>profilePicture}}">     
           </a>
     <div class="search_p_data paddingtop12 minheight30 "> 
     <span class="searchUserProfile" data-id="{{>userId}}"  data-name="{{>uniqueHandle}}"> {{>displayName}} </span>
                 <div class="social_bar search_bar search_bar_noclear">
                 <a id="a_followUnfollow_{{>userId}}" onclick="userFollowUnfollowActionsForSearch('{{>userId}}',{{if isUserFollowed}} 'unfollow' {{else}} 'follow' {{/if}},'search');" class="follow_a"><i><img id="img_profile_followunfollow_{{>userId}}" data-placement="bottom" rel="tooltip"  data-original-title="{{if isUserFollowed}} <?php echo Yii::t('translation','Unfollow'); ?> {{else}} <?php echo Yii::t('translation','Follow'); ?> {{/if}}" class="{{if isUserFollowed }} follow {{else}} unfollow {{/if}}" src="/images/system/spacer.png"></i></a>
                     <span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"   data-original-title="<?php echo Yii::t('translation','Conversations'); ?>"    class="s_conversations" src="/images/system/spacer.png"></i><b > {{>postCount}}</b></span>
                     <span><i><img data-placement="bottom" rel="tooltip" data-original-title="<?php echo Yii::t('translation','Followers'); ?>"   class="s_followers" src="/images/system/spacer.png"></i><b id="followerscntb_{{>userId}}">{{>followersCount}}</b></span> 
                     
                 </div>         
       </div>  
       </div>
                                    
 </div>       
   {{/for}}
    </script>
    <script id="groupSearchTmpl" type="text/x-jsrender">
        {{for groups}}
               
                  
        <div class="padding4 bordertop bghover">
               <div class="s_g_div" name="searchGroupDetail" data-id="{{>GroupId.$id}}" data-type="group" data-name="{{>GroupUniqueName}}">
              <a class="pull-left marginzero s_g_icon" href="#">
                 <img src="{{>GroupImagesAndVideos}}">  
              </a>
         <div class="search_p_data ma ">         
           <span id="search_group_{{>GroupId.$id}}">{{>GroupName}}</span>
         <div class="social_bar search_bar search_bar_noclear"><span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Conversations'); ?>"  class="s_conversations" src="/images/system/spacer.png"></i><b >{{>GroupPostsCount}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Followers'); ?>"  class="s_followers" src="/images/system/spacer.png"></i><b >{{>GroupMembersCount}}</b></span> </div>
            </div>
        </div>
      </div>      
  
   
     {{/for}}
              </script>
             <script id="subGroupSearchTmpl" type="text/x-jsrender">
              {{for subGroups}}
               
                  
        <div class="padding4 bordertop bghover">
               <div class="s_g_div" name="searchGroupDetail" data-id="{{>_id.$id}}" data-type="subgroup" data-name="{{>GroupId}}/sg/{{>SubGroupName}}">
              <a class="pull-left marginzero s_g_icon" href="#">
                 <img src="{{>SubGroupProfileImage}}">  
              </a>
         <div class="search_p_data ma ">         
           <span id="search_subgroup_{{>_id.$id}}">{{>SubGroupName}}</span>
         <div class="social_bar search_bar search_bar_noclear"><span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Conversations'); ?>"  class="s_conversations" src="/images/system/spacer.png"></i><b >{{>PostIds.length}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Followers'); ?>"  class="s_followers" src="/images/system/spacer.png"></i><b >{{>SubGroupMembers.length}}</b></span> </div>
            </div>
        </div>
      </div>      
  
   
     {{/for}}
    </script>
    <script id="hashtagSearchTmpl" type="text/x-jsrender"> 
        {{for hashtagArray}}
         
      <div class="padding4 bordertop bghover" >
            <div class="searchHashTag" data-id="{{>_id.$id}}" data-name="{{>HashTagName}}"><span class="at_mention dd-tags" ><b>#{{>HashTagName}}</b></span> </div>
    <div id="hastag_spinner_{{>_id.$id}}" style="position:relative;"></div>
            <div class="social_bar search_bar">
            <a id="hashtag_search_{{>_id.$id}}" onclick="followUnfollowHashTag4Search('{{>_id.$id}}',{{if Status}} 'unfollow' {{else}} 'follow' {{/if}},'search');" class="follow_a"><i><img id="hash_profile_followunfollow_{{>_id.$id}}" data-placement="bottom" rel="tooltip"  data-original-title="{{if Status}}<?php echo Yii::t('translation','Unfollow'); ?> {{else}} <?php echo Yii::t('translation','Follow'); ?> {{/if}}" class="{{if Status }} follow {{else}} unfollow {{/if}}" src="/images/system/spacer.png"></i></a>
                <span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Conversations'); ?>"  class="s_conversations" src="/images/system/spacer.png"></i><b >{{>(Post+CurbsidePostId+GroupPostId)}}</b></span>
                <span><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Followers'); ?>"  class="s_followers" src="/images/system/spacer.png"></i><b id="search_hashtag_count_{{>_id.$id}}">{{>HashTagFollowers.length}}</b></span> 
                
            </div>
      </div> 
   {{/for}}
    </script>
    <script id="curbsideCategorySearchTmpl" type="text/x-jsrender"> 
        {{for categoryArray}}
         
   <div class="padding4 bordertop bghover" >
            
            <div name="searchCategory" data-id="{{>CategoryId}}" data-name="{{>CategoryName}}"><span class="at_mention dd-tags" ><b>{{>CategoryName}}</b></span> </div>
            <div class="social_bar search_bar">
                <a id="curbsideCateogry_search_{{>CategoryId}}" onclick="followUnfollowCategory4Search('{{>CategoryId}}',{{if Status}} 'unfollow' {{else}} 'follow' {{/if}});" class="follow_a"><i><img id="curbside_category_followunfollow_{{>CategoryId}}" data-placement="bottom" rel="tooltip"  data-original-title="{{if Status}} <?php echo Yii::t('translation','Unfollow'); ?> {{else}} <?php echo Yii::t('translation','Follow'); ?> {{/if}}" class="{{if Status }} follow {{else}} unfollow {{/if}}" src="/images/system/spacer.png"></i></a>            
                <span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Conversations'); ?>"  class="s_conversations" src="/images/system/spacer.png"></i><b id="search_category_count_{{>CategoryId}}">{{>(Post)}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Followers'); ?>"  class="s_followers" src="/images/system/spacer.png"></i><b id="curbsidecategory_FollowresCount_{{>CategoryId}}">{{>Followers.length}}</b></span> 
            </div>
    <div id="curbsideCateogry_spinner_{{>CategoryId}}" style="position:relative;"></div>
      </div>
    
   {{/for}}
    </script>
    <script id="postSearchTmpl" type="text/x-jsrender"> 
                 {{for postString}}
    {{if postExist == "yes" || curbPostExist == "yes"}}
            <div class="padding4 bordertop bghover">
                                    <div class="positionrelative ">
                                        <a class="socialicons s_p_icon socialicons_s_wh" href="#">
                                        <img src="/images/system/spacer.png" class="s_posts">                  
                                        </a>
                              
                                        <div id="postsWithDiv" onclick="getPostsForSearch()" class="search_p_data38  minheight30 paddingtop6 font15"><span><?php echo Yii::t('translation','Posts'); ?></span> <?php echo Yii::t('translation','with'); ?> <span>{{>searchText}}</span></div>  
                             
                                       
            </div>
                                    
                          </div>
      {{/if}}
       
         {{if newsExist == "yes"}}
            <div class="padding4 bordertop bghover">
                                    <div class="positionrelative ">
                                        <a class="socialicons s_p_icon socialicons_s_wh" href="#">
                                        <img src="/images/system/spacer.png" class="s_posts">                  
                                        </a>
                              
                                        <div id="postsWithDiv" onclick="getNewsForSearch()" class="search_p_data38  minheight30 paddingtop6 font15"><span><?php echo Yii::t('translation','News'); ?></span> <?php echo Yii::t('translation','with'); ?> <span>{{>searchText}}</span></div>  
                             
                                       
            </div>
                                    
                          </div>
      {{/if}}
              
              {{if gamesExist == "yes"}}
            <div class="padding4 bordertop bghover">
                                    <div class="positionrelative ">
                                        <a class="socialicons s_p_icon socialicons_s_wh" href="#">
                                        <img src="/images/system/spacer.png" class="s_posts">                  
                                        </a>
                              
                                        <div id="postsWithDiv" onclick="getGamesForSearch()" class="search_p_data38  minheight30 paddingtop6 font15"><span><?php echo Yii::t('translation','Games'); ?></span> <?php echo Yii::t('translation','with'); ?> <span>{{>searchText}}</span></div>  
                             
                                       
            </div>
                                    
                          </div>
      {{/if}}
        
        
          {{/for}}
                  
                  
    </script>
    <script id="projectSearchTmpl" type="text/x-jsrender">
        <div id="search_nodata">
        </div>
           <div class="row-fluid searchrow-fluid" >
                        <div class="span12">
                            <div class="span3" id="userSearchSpan">
                                <div class="search3" id="userSearchDiv">
                               
                                    
                                </div>
                                
                            </div>
                            <div class="span3" id="groupSearchSpan">
                                <div class="search3" id="groupSearchDiv">
                              
                               </div>
                            </div>
                            <div class="span2" id="hashtagSearchSpan">
                               <div class="search3" id="hashtagSearchDiv">
                                   
                               </div> 
                            </div>
                            <div class="span2" id="curbsideCategorySearchSpan">
                               <div class="search3" id="curbsideCategorySearchDiv">
                                   
                               </div> 
                            </div>
                            <div class="span2" id="postSearchSpan">
                                <div class="search3" id="postSearchDiv">
                                    
                                 
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
    </script>
   