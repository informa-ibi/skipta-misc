<script id="categoriesTmpl" type="text/x-jsrender"> 
    
          <div class="tabbable tabs-left">
    <ul id="myTab3" class="nav nav-tabs">
        <li class="active">
            <a href="#home3" data-toggle="tab">
            <?php echo Yii::t('translation','Category'); ?>
            </a>
        </li>
    	<li>
            <a href="#profile3" data-toggle="tab">
            <?php echo Yii::t('translation','Hash_tag'); ?>
            </a>
        </li>
    
        
    </ul>

    <div class="tab-content " style="overflow: hidden;" >
    <div id="categories_spinner"></div>
        <div class="tab-pane in active " id="home3" >
        <div class="collapse  curb_hash_cat_minheight" id="cat_tab-content" >  
            
        {{if categoriescount > 0}}
            <ul class="outerbadges hashtag">
                
                {{for categories }}
                    {{if NumberOfPosts > 0}}
                    
                         <li id="curside_category_list_{{>CategoryId}}" class="curbside_category"><b onclick="CloseFilterData('curside_category_list_{{>CategoryId}}','curside_category_{{>CategoryId}}')" id="curside_category_{{>CategoryId}}" style="display:none;cursor: pointer;">X</b><a style="cursor: pointer;"  onClick="getCategoryPosts('{{>CategoryId}}','{{>CategoryName}}')" > <i id="curbsideFilter_category_{{>CategoryId}}" >{{>CategoryName}}</i> <span class="badge"> {{>NumberOfPosts}}</span> </a>
                             
                         </li>
                {{else}}
                     <li><a > {{>CategoryName}}  <span class="badge"> {{>NumberOfPosts}}</span></a></li>
                 {{/if}} 
                    {{/for}}
            </ul>
           {{else}} 
           <div style="text-align:center;">
           <?php echo Yii::t('translation','No_data_found'); ?>
           </div>
        {{/if}}</div>
                {{if categoriescount > 7}}         
           <div class="alignright clearboth morebtnpadding"> 
           
                            <a  class="more btn_toggle" data-toggle="collapse" data-target="#cat_tab-content, #Hide, #Show">
 <span id="Hide" class="collapse in"> <?php echo Yii::t('translation','more'); ?> <i class="fa fa-chevron-circle-down"></i></span>
   <span id="Show" class="collapse "><?php echo Yii::t('translation','close'); ?> <i class="fa fa-chevron-circle-up"></i></span>
</a>
                            </div>
                {{/if}}
        </div>

        <div class="tab-pane " id="profile3">
         <div class="collapse curb_hash_cat_minheight" id="hash_tab-content" >
               {{if hashtagscount > 0}}
           <ul class="outerbadges hashtag">
                {{for hashtags }}
              
                {{if CurbsidePostCount > 0}}                    
               <li {{for _id}}id="curbside_hashtag_list_{{>$id}}" class="curbside_hashtag"{{/for}}  data-hashtag="{{>HashTagName}}" class=""><b {{for _id}}onclick="CloseFilterData('curbside_hashtag_list_{{>$id}}','curside_hashtag_{{>$id}}')" id="curside_hashtag_{{>$id}}"  {{/for}} style="display:none;cursor: pointer;">X</b><a style="cursor: pointer;"  {{for _id}} onClick="getHashtagsPosts('{{>$id}}','{{>HashTagName}}')" {{/for}} > <i id="curbsideFilter_hastag_{{>$id}}">{{>HashTagName}}</i> <span class="badge">  {{if CurbsidePostCount!=null}}{{>CurbsidePostCount}} {{else}} 0 {{/if}}</span> </a>
                
                         
                {{else}}
                    <li><a > {{>HashTagName}} <span class="badge"> {{if CurbsidePostCount!=null}}{{>CurbsidePostCount}} {{else}} 0 {{/if}}</span></a></li>
                 {{/if}}
                       
                       
                  {{/for}}
              </ul>
     {{else}} 
            <div style="text-align:center;">
           <?php echo Yii::t('translation','No_data_found'); ?>
           </div>
        {{/if}}
                </div>
            {{if hashtagscount > 10}}
          <div class="alignright clearboth morebtnpadding"> 
           
                            <a  class="more btn_toggle" data-toggle="collapse" data-target="#hash_tab-content, #hash_Hide, #hash_Show">
 <span id="hash_Hide" class="collapse in"> <?php echo Yii::t('translation','more'); ?> <i class="fa fa-chevron-circle-down"></i></span>
   <span id="hash_Show" class="collapse "><?php echo Yii::t('translation','close'); ?><i class="fa fa-chevron-circle-up"></i></span>
</a>
                            </div>
             {{/if}}
        </div>

        
    </div>
          </div>

    </script>
   