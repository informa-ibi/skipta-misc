<script  id="detailedcommentTmpl_render" type="text/x-jsrender">
    {{for data.data}}
    {{for Comments}}
  <div class="commentsection">
          <div class="row-fluid commenteddiv">
          <div class="span12">
                 <div class=" stream_content">
                <ul>
                    <li class="media">
                    {{if NoOfArtifacts >0}}
                        <div class="padding5">
                        <div class="chat_subheader "><?php echo Yii::t('translation','Artifacts'); ?></div>                        
                        {{i = 0}}
                        {{for Artifacts}}
                        
                        {{if Extension=='mp4' || Extension=='mp3'}}
                        {{if #index == 1}}
                            <div class="row-fluid">
                            <div class="span12">
                              <div class="mediaimg">
                               <img src="/images/system/no-video-img.png" data-uri="{{>Uri}}" id="commentPlayVideodiv" class="commentPlayVideodiv"></div>
                            </div>
                            </div> 
                    {{/if}}
                    {{/if}}
                        {{/if}}
                                
                          {{/for}}      
                        <div class="row-fluid padding8top detailed_media" >
                        <div class="span12">
                        {{for Artifacts}}  
                        {{if Extension=='mp4' || Extension=='mp3'}}
                            <div class="span3">
                            <div class="d_img_outer_video_play">
                            <img src="/images/system/no-video-img.png">
                            </div>                            
                            </div>
                        {{else Extension == "jpg" || Extension == "png" || Extension == "giff" || Extension == "jpeg"}}
                            <div class="span3">
                             <div class="d_img_outer">
                            <img style="cursor:pointer;" src="{{>Uri}}" data-uri="{{>Uri}}"  class="imageimgdivid">
                            </div>
                            </div>
                        {{else Extension == "pdf"}}
                            <div class="span3">
                             <div class="d_img_outer">
                            <img style="cursor:pointer;" src="/images/system/pdf.png" data-uri="{{>Uri}}" id="commentPdfDiv" class="commentPdfDiv"/>
                            </div>
                            </div>
                        {{/if}}
                        {{/for}}
                        
                        </div>

                        </div>
                
                        </div>
                {{/if}}
          
                     <div class="media-body">
                  
          <div id="comment_new_text"></div>
                 
          <div class="media padding5">
                  <a href="#" class="pull-left marginzero smallprofileicon">
                    <img   src="{{>ProfilePic}}">                  </a>
                  <div class="media-body">
                   <span class="m_day"> <?php echo Yii::t('translation','few_sec_ago'); ?></span>
                   <div class="m_title"><a <a class="userprofilename"  data-id="{{>UserId}}" style="cursor:pointer">{{>DisplayName}}</a></div>
                   </div>
                </div>
                </div>
        </li>
                </ul>
            </div>
          
          </div>
          </div>

                </div>
        {{/for}}
        {{/for}}
</script>