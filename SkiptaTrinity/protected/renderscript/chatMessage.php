<!--    max-chat start-->
<script id="chatMessageTmpl" type="text/x-jsrender"> 
      {{for data}}
      {{if message!=""}}
     <div class="row-fluid paddingtop4">
    <div class="span12">
    <div class="span9">
    <div class="media">
                  <a class="pull-left  miniprofileicon" href="#">
                    <img src="{{>profilePicture}}">              
                 </a>
                  <div class="media-body">
                  {{>message}}
                   </div>
                </div>
                
                </div>
    <div class="span3"><div class="chat_time"><i class="fa fa-comment"></i> {{>createdOn}}</div></div>
    </div>
    </div>
      {{/if}}
    {{/for}}
    </script>
    <script id="chatUserListTmpl" type="text/x-jsrender">
                {{for data}} 
                 <ul>
      <li id="li_showChatArea_{{>userId}}" name="li_showChatArea">    
        
    <div class="media" id="showChatArea_{{>userId}}" onclick="removeSearchFlag();showChatArea('{{>userId}}','{{>displayName}}')">
                  <a id="chatProfileImg_{{>userId}}" class="pull-left  miniprofileicon chatprofilegreen " href="#">
                    <img src="{{>profilePicture}}"> 
                  </a>
                  <div class="media-body" style="padding-right:15px">
                  {{>displayName}} <i class="fa fa-comments-o chatStatus" style="display:none" id="offlineIcon_{{>userId}}"></i>
                   </div>
                </div>
         </li>
  
 </ul>
     {{/for}}   
                </script>
    <script id="chatUsersListTmpl" type="text/x-jsrender">
                {{for data}} 
                 <ul id="ul_{{>userObj.UserId}}">
      <li id="li_showChatArea_{{>userObj.UserId}}" name="li_showChatArea">    
        
    <div class="media" id="showChatArea_{{>userObj.UserId}}" onclick="removeSearchFlag();showChatArea('{{>userObj.UserId}}','{{>userObj.DisplayName}}')">
                  <a id="chatProfileImg_{{>userObj.UserId}}" class="pull-left  miniprofileicon {{if userStatus=='loggedIn'}}chatprofilegreen{{/if}}{{if userStatus=='offline'}}chatprofilegrey{{/if}} " href="#">
                    <img src="{{>userObj.profile70x70}}"> 
                  </a>
                  <div class="media-body" style="padding-right:15px">
                 {{>shortName}} <i class="fa fa-comments-o chatStatus" style="display:none" id="offlineIcon_{{>userObj.UserId}}"></i>
                   </div>
                </div>
         </li>
  
 </ul>
     {{/for}}   
                </script>
                  <script id="searchUsersListTmpl" type="text/x-jsrender">
                {{for data}} 
                 <ul id="ul_{{>userObj.UserId}}">
      <li id="li_showChatArea_{{>userObj.UserId}}" name="li_showChatArea">    
        
    <div class="media" id="showChatArea_{{>userObj.UserId}}" >
                  <a id="chatProfileImg_{{>userObj.UserId}}" onclick="removeSearchFlag();showChatArea('{{>userObj.UserId}}','{{>userObj.DisplayName}}')" class="pull-left  miniprofileicon {{if userStatus=='loggedIn'}}chatprofilegreen{{/if}}{{if userStatus=='offline'}}chatprofilegrey{{/if}} " href="#">
                    <img src="{{>userObj.profile70x70}}"> 
                  </a>
                  <div class="media-body" style="" >
                 <div onclick="removeSearchFlag();showChatArea('{{>userObj.UserId}}','{{>userObj.DisplayName}}')"> {{>shortName}}</div><i class="fa fa-comments-o chatStatus" style="display:none" id="offlineIcon_{{>userObj.UserId}}"></i>
                 <div class="inboxbutton" id="inboxbutton_{{>userObj.UserId}}">
                  <button data-id="{{>userObj.UserId}}" class="{{if userInInbox == 'yes'}}inboxb{{else}}movetoinboxb{{/if}}">{{if userInInbox == 'yes'}}Inbox{{else}}Move to Inbox{{/if}}</button>
            </div>   
            </div>
         
           
          
         
                </div>
         </li>
  
 </ul>
     {{/for}}   
                </script>
<!--    max-chat end-->

<!--    min-chat start-->
<script id="minChatMessageTmpl" type="text/x-jsrender"> 
      {{for data}}
    {{if message!=""}}
   <div class="row-fluid paddingtop4">
    <div class="span12">

    <div class="media">
      <a href="#" class="pull-left  miniprofileicon">
         <img src="{{>profilePicture}}">                  </a>
      <div class="media-body">
       {{>message}}
       </div>
    </div>

    <div class="chat_time"><i class="fa fa-comment"></i> {{>createdOn}}</div>
    </div>
    </div>
{{/if}}
    {{/for}}
    </script>


  <script id="minchatFullTmpl" type="text/x-jsrender">
   {{for data}} 
 
    <div class="minchatbox" id="minchatUser_{{>userId}}">
    <div class="minichat" id="minichat_{{>userId}}">
    <div >
    <div class="m_c_header" id="m_c_header_{{>userId}}">
   <div class="m_c_header_text" id="min_minChatHeader_{{>userId}}" name="min_minChatHeader" data-id="minHeader_{{>userId}}" >{{>minUserName}}</div>
   <div class="m_c_header_icons"><i class="fa fa-plus" data-id="minchatEnlarge_{{>userId}}_{{>userName}}" name="minChatEnlarge"></i><i class="fa fa-times" data-id="minchatClose_{{>userId}}" name="minChatClose"></i></div>
    </div>
   <div class="m_c_chatdisplay" style="display:none" id="minBody_{{>userId}}">
        <div class="scroll-pane" id="minchatScrollPane_{{>userId}}" style="height: 300px">
        <div id="minChatData_{{>userId}}">
        {{for jsonData}}
{{if message!=""}}
   <div class="row-fluid paddingtop4">
    <div class="span12">

    <div class="media">
      <a href="#" class="pull-left  miniprofileicon">
         <img src="{{>profilePicture}}">                   </a>
      <div class="media-body">
       {{>message}}
       </div>
    </div>

    <div class="chat_time"><i class="fa fa-comment"></i> {{>createdOn}}</div>
    </div>
    </div>
    {{/if}}
    {{/for}}
    
        </div>
   <div id="minChatStatus_{{>userId}}" style="color: gray;display: none;">
             ...
         </div>
        </div>
   </div>
   <div class="m_c_chatwrite" style="display:none" id="minWrite_{{>userId}}">
   <div class="row-fluid">
   <div class="span12">
   <textarea class="span12" id="mjmMinChatMessage_{{>userId}}" name="mjmMinChatMessage" data-id="{{>userId}}" placeholder="<?php echo Yii::t('translation','Enter_message_here'); ?>..."></textarea>
   </div></div></div>
   </div>
    </div>
    </div>
  
 
  {{/for}}
 
        
                </script>

<!--    min-chat end-->
        
   