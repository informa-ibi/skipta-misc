<script id="userSearchTmpl" type="text/x-jsrender"> 
    {{for users}}
   
  <div class="padding4 bordertop bghover" name="searchUserProfile" data-id="{{>userId}}"  data-name="{{>uniqueHandle}}">
        <div class="positionrelative ">
          <a class="smallprofileicon s_p_icon" href="#">
              <img src="{{>profilePicture}}">     
           </a>
     <div class="search_p_data paddingtop12 minheight30">{{>displayName}}
         <div class="social_bar search_bar search_bar_noclear"><span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="Conversations"   class="s_conversations" src="/images/system/spacer.png"></i><b > {{>postCount}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="Followers"  class="s_followers" src="/images/system/spacer.png"></i><b >{{>followersCount}}</b></span> </div>
       </div>  
       </div>
                                    
 </div>       
   {{/for}}
    </script>
    <script id="groupSearchTmpl" type="text/x-jsrender">
        {{for groups}}
               
                  
        <div class="padding4 bordertop bghover">
               <div class="s_g_div" name="searchGroupDetail" data-id="{{>GroupId}}" data-type="group" data-name="{{>GroupName}}">
              <a class="pull-left marginzero s_g_icon" href="#">
                 <img src="{{>GroupImagesAndVideos}}">  
              </a>
         <div class="search_p_data ma ">
           {{>GroupName}}
         <div class="social_bar search_bar search_bar_noclear"><span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="Conversations"  class="s_conversations" src="/images/system/spacer.png"></i><b >{{>GroupPostsCount}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="Followers"  class="s_followers" src="/images/system/spacer.png"></i><b >{{>GroupMembersCount}}</b></span> </div>
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
           {{>SubGroupName}}
         <div class="social_bar search_bar search_bar_noclear"><span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="Conversations"  class="s_conversations" src="/images/system/spacer.png"></i><b >{{>PostIds.length}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="Followers"  class="s_followers" src="/images/system/spacer.png"></i><b >{{>SubGroupMembers.length}}</b></span> </div>
            </div>
        </div>
      </div>      
  
   
     {{/for}}
    </script>
    <script id="hashtagSearchTmpl" type="text/x-jsrender"> 
        {{for hashtagArray}}
         
   <div class="padding4 bordertop bghover" name="searchHashTag" data-id="{{>_id.$id}}" data-name="{{>HashTagName}}">
            <div><span class="at_mention dd-tags" ><b>#{{>HashTagName}}</b></span> </div>
            <div class="social_bar search_bar"><span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="Conversations"  class="s_conversations" src="/images/system/spacer.png"></i><b >{{>(Post+CurbsidePostId+GroupPostId)}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="Followers"  class="s_followers" src="/images/system/spacer.png"></i><b >{{>HashTagFollowers.length}}</b></span> </div>
      </div>
    
   {{/for}}
    </script>
    <script id="curbsideCategorySearchTmpl" type="text/x-jsrender"> 
        {{for categoryArray}}
         
   <div class="padding4 bordertop bghover" name="searchCategory" data-id="{{>CategoryId}}" data-name="{{>CategoryName}}">
            <div><span class="at_mention dd-tags" ><b>{{>CategoryName}}</b></span> </div>
            <div class="social_bar search_bar"><span class="margin-right10"><i><img data-placement="bottom" rel="tooltip"  data-original-title="Conversations"  class="s_conversations" src="/images/system/spacer.png"></i><b >{{>(Post)}}</b></span><span><i><img data-placement="bottom" rel="tooltip"  data-original-title="Followers"  class="s_followers" src="/images/system/spacer.png"></i><b >{{>Followers.length}}</b></span> </div>
      </div>
    
   {{/for}}
    </script>
    <script id="postSearchTmpl" type="text/x-jsrender"> 
                 {{for postString}}
    {{if postExist == "yes"}}
            <div class="padding4 bordertop bghover">
                                    <div class="positionrelative ">
                                        <a class="socialicons s_p_icon socialicons_s_wh" href="#">
                                        <img src="/images/system/spacer.png" class="s_posts">                  
                                        </a>
                              
                                        <div id="postsWithDiv" onclick="getPostsForSearch()" class="search_p_data38  minheight30 paddingtop6 font15"><span>Posts</span> with <span>{{>searchText}}</span></div>  
                             
                                       
            </div>
                                    
                          </div>
      {{/if}}
       {{if curbPostExist == "yes"}}
                 <div class="padding4 bordertop bghover">
                                    <div class="positionrelative ">
                                        <a class="socialicons s_p_icon socialicons_s_wh" href="#">
                                        <img src="/images/system/spacer.png" class="s_crubside">                  
                                        </a>

                                 <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
                                        <div id="curbPostsWithDiv" onclick="getCurbPostsForSearch()" class="search_p_data38  minheight30 paddingtop6 font15"><span> <?php echo $name?> </span> with <span>{{>searchText}}</span></div>  
                              
                                       

            </div>
                                    
                   </div>
          {{/if}} 
         {{if newsExist == "yes"}}
            <div class="padding4 bordertop bghover">
                                    <div class="positionrelative ">
                                        <a class="socialicons s_p_icon socialicons_s_wh" href="#">
                                        <img src="/images/system/spacer.png" class="s_posts">                  
                                        </a>
                              
                                        <div id="postsWithDiv" onclick="getNewsForSearch()" class="search_p_data38  minheight30 paddingtop6 font15"><span>News</span> with <span>{{>searchText}}</span></div>  
                             
                                       
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
   