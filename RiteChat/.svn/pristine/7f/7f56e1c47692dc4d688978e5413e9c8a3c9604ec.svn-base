<script id="snippetDetailTmpl" type="text/x-jsrender">
    <div class=" stream_content positionrelative">
    <div style="position: relative" class="Snippet_div ">
  
      {{if data.type=='post'}}
                    <button aria-hidden="true"   onclick="closeSnippetDiv();" class="close" type="button">×</button>
         {{else}} 
         
          <button aria-hidden="true"  data-dismiss="modal" onclick="closeCommentSnippetDiv('{{>data.CommentId}}');" class="close" type="button">×</button>
      
       {{/if}}

                    {{for data.snippetdata}} 
                  
                    <a href="{{>WebLink}}" target="_blank">

                              
                                     
                    {{if WebImage!=null && WebImage!="" &&  WebImage!="null"}}
                         <span  class=" pull-left img_single e_img" style="width:100px;" >  <img  style="" src="{{>WebImage}}" /> </span>
                         {{/if}}
  </a>
                         <div class="media-body"> 

                       <label>{{>WebTitle}}</label>
                       <label>{{>WebLink}}</label>
                        <p>{{>Webdescription}}</p>

                         </div>

                                              
                                         
                  
                      
                 
                    {{/for}}
               
                    
  </div></div>
</script>


