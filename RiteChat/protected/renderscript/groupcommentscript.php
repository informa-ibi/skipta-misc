<script  id="groupcommentTmpl_render" type="text/x-jsrender">
    {{for data.data}}
  <div class="commentsection">
          <div class="row-fluid commenteddiv">
          <div class="span12">
                 <div class=" stream_content">
                <ul>
                    <li class="media">
           <div class="media-body">
                  
          <div id="comment_new_text"></div></div>
          
          {{if Resource.length!=0}}
   {{if ResourceLength > 1}}
      <div class="pull-left multiple "> 
            <div class="img_more1"></div>
            <div class="img_more2"></div>
    <a  class="pull-left  pull-left1 img_more postdetail" data-postid="{{>PostId}}" data-categoryType="{{>CateogryType}}" data-postType="{{>Type}}">
   {{else}} 
   <a  class="pull-left img_single postdetail" data-postid="{{>PostId}}" data-categoryType="{{>CateogryType}}" data-postType="{{>Type}}">
        {{/if}}
 
            {{for Resource}}
  
                 {{if ThumbNailImage!= ""}}
                 {{if Extension=='mp4' || Extension=='mov' || Extension=='flv'}}
                <div  class='videoThumnailDisplay'><img src="/images/icons/video_icon.png"></div>
         {{/if}}
                     <img id="comment_new_photo" src="{{>ThumbNailImage}}"  />           
                
                 {{else}}
                                
                     <img id="comment_new_photo" src=""  />
                                
                {{/if}}
          {{/for}}   
                  </a></div>{{/if}}
          
                     <div class="media-body clearboth">
                  
          
                 
          <div class="media ">
                  <a href="#" class="pull-left marginzero smallprofileicon">
                    <img   src="{{>ProfilePic}}">                  </a>
                  <div class="media-body">
                   <span class="m_day"> few sec ago</span>
                   <div class="m_title"><a <a class="userprofilename"  data-id="{{>UserId}}" style="cursor:pointer">{{>DisplayName}}</a></div>
                   </div>
                </div>
                </div>
                    </li>
                </ul>
                     </div>
              </div></div></div>
              
        {{/for}}
</script>