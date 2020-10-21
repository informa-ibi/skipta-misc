<script  id="commentTmpl_instant_render" type="text/x-jsrender">
    {{for data.data}}
  <div class="commentsection">
          <div class="row-fluid commenteddiv">
          <div class="span12">
                 <div class=" stream_content">
                <ul>
                    <li class="media">
          
          {{if Resource.length!=0}}
   {{if ResourceLength > 2}}
     <div class="pull-left multiple "> 
            <div class="img_more1"></div>
            <div class="img_more2"></div>
    <a  class="pull-left  pull-left1 img_more postdetail" data-id="{{>streamId}}" data-postid="{{>PostId}}" data-categoryType="{{>CategoryType}}" data-postType="{{>Type}}">

    
          
           {{else}} 
 <a  class="pull-left img_single postdetail" data-id="{{>streamId}}" data-postid="{{>PostId}}" data-categoryType="{{>CategoryType}}" data-postType="{{>Type}}">
        {{/if}}
 
            {{for Resource}}
  
                 {{if ThumbNailImage!= ""}}
                
                             
               
                <div class="d_img_outer_video_play" style="cursor:pointer;" >
                 {{if Extension=='mp4' || Extension=='mov' || Extension=='flv'}}
                <div  class='PostdetailvideoThumnailDisplay ajaxUploadArtifact'>
                <img src="/images/icons/video_icon.png">
                </div>
                 {{/if}}
                <img id="comment_new_photo" src="{{>ThumbNailImage}}"  data-uri="{{>Uri}}" data-format="{{>Extension}}"/>    
                 </div>
                                
                {{/if}}
          {{/for}}   
                  </a></div>{{/if}}
          <div id="stream_view_commentscript_spinner_{{>PostId}}"></div>
                     <div class="media-body" style="padding:0 0 5px 10px">
                  
          <div id="comment_new_text"></div>
                 
          <div class="media">
                  <a href="#" class="pull-left marginzero smallprofileicon">
                    <img   src="{{>ProfilePic}}">                  </a>
                  <div class="media-body">
                   <span class="m_day"> <?php echo Yii::t('translation','few_sec_ago'); ?></span>
                   <div class="m_title"><a <a class="userprofilename"  data-id="{{>UserId}}" style="cursor:pointer">{{>DisplayName}}</a></div>
                   </div>
                </div>
            </div>
          {{if IsWebSnippetExist=='1'}}
            <div style="position: relative" class="Snippet_div">
  
     
                    {{for snippetdata}}                    
                    

                              
                                      <div class="row-fluid">
                                          <div class="span12">
                                              <div class="span3">
                                                <a href="{{>WebLink}}" target="_blank">   <img  style="width: 100px;height:100px" src="{{>WebImage}}"  class="e_img"/></a>
                                              </div> 
                                              <div class="span9">
                                                  <div class="paddinglr">
                                                  
                                                <label>{{>WebTitle}}</label>
                                                <label> <a href="{{>WebLink}}" target="_blank">{{>WebLink}} </a> </label>
                                                 <p>{{>Webdescription}}</p>
                                                  </div>
                                              </div>
                                              
                                          </div>
                                          
                                      </div>
                  
                       
                    {{/for}}
               
                    
            </div>
           {{/if}}
        
              
                    </li>
                </ul>
                     </div>
              </div></div></div>
              
        {{/for}}
</script>