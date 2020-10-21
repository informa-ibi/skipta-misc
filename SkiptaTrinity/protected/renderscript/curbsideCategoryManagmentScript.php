<script  id="curbsideCategoriesTmp_render" type="text/x-jsrender">
<div style="position: relative">

        <div  class="block">
        <div class="tablehead pull-left" >
                  
                  <div rel="tooltip" style="cursor: pointer;" onclick="createNewCurbsideCategory()" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Create_Category'); ?>">
                        <i class="fa fa-plus-circle"></i>
                        </div>
            </div>
            <div class="tablehead tableheadright pull-right">
            <div class="tabletopcorner">
                 <input type="text" placeholder="search" class="textfield textfieldsearch" id="searchTextId" onkeypress="return searchCurbsideCategory(event)" />
                             </div>
                 <div class="tabletopcorner">
                 <select id="filterCurbsideCategory" class="styled textfield textfielddatasearch">
                    <option value="all">
                        All
                    </option>
                    <option value="active">
                        Active
                    </option>
                    <option value="deleted">
                        Inactive
                    </option> 
                </select>
        </div>
                 <div class="btn-group pagesize tabletopcorner tabletopcornerpaddingtop" >
                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" data-placement="top">Page size<span class="caret"></span></button>
                <ul class="dropdown-menu" style="min-width:70px">
                    <li><a href="#" id="pagesize_5" onclick="setPageLength(5,'newCurbsideCategory')">5</a></li>
                    <li><a href="#" id="pagesize_10" onclick="setPageLength(10,'newCurbsideCategory')">10</a></li>
                    <li><a href="#" id="pagesize_15" onclick="setPageLength(15,'newCurbsideCategory')">15</a></li>                  
                </ul>
            </div>

            <div class="tabletopcorner tabletopcornerpaddingtop">
            <div class="label label-warning record_size " >+
                {{for data.total}}
                    {{>totalCount}}
                {{/for}} 
            </div>
            </div>
            </div>  
            <span id="spinner_admin"></span>
            <a class="block-heading" data-toggle="collapse">&nbsp;</a>
            <div id="tablewidget"  style="margin: auto;">
             <table class="table table-hover">
                       <?php  $name=Yii::t('translation', 'CurbsideConsult');?>
                    <thead><tr><th><?php echo $name?> Category</th><th>Post Count</th><th>Status</th><th class="data_t_hide">Created Date</th><th>Actions</th></tr></thead>
                    <tbody>
                        <tr id="noRecordsTR" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b><?php echo Yii::t('translation','No_records_found'); ?></b></span>
                            </td>
                        </tr>
                        {{for data.data}}    
                        <tr class="odd">
                            <td>
                                        <div id="curbsideCategory_editText_{{>Id}}" style="display: none">
                                        <input type="text" id="curbsideCategory_inputText_{{>Id}}" name="curbsideCategory_inputText_{{>Id}}" />
                                        </div>
                                        <div id="curbsideCategory_text_{{>Id}}" style="display: block">
                                        {{>CurbsideCategory}}
                                        </div>
                                 
                                   
                            </td> 
                     <td>
                                {{>NumberOfPosts}}
                            </td>
                            <td>
                                                
                                <div id="curbsideCategory_{{>Id}}">
                                
                                    {{if Status == 1}}
                                        Active
                                    {{else Status == 0}}
                                        Inactive
                                    {{/if}}

                                </div>   
                                <div id="curbsideCategory_edit_{{>Id}}" style="display: none" class="changestatus">
                                <div class="positionrelative" style="width:120px;">
                                    <select style="width:120px;" id="curbsidecategoryStatus" class="styled" data-id="{{>Id}}"  id="curbsideCategoryselect_{{>Id}}" >
                                                    {{if Status == 1}}
                                                        <option value="1" selected>
                                                                Active
                                                        </option>
                                                        <option value="0"> 
                                                                Inactive
                                                        </option>
                                                    {{else Status == 0}}
                                                    <option value="0" selected>
                                                            Inactive
                                                    </option>
                                                    <option value="1"> 
                                                            Active
                                                    </option>
                                            {{/if}}
                                    </select>
                                    </div>
                                </div>
                            </td>
                            <td class="data_t_hide">                          
                                {{>CreatedDate}}   
                            </td>
                     
                           
                      

                    <td>  
                    
                        {{if Status != 0}}
                        <a id="editButton_{{>Id}}"  rel="tooltip" style="cursor: pointer;" onclick="editCurbsideCategoryById('{{>Id}}','{{>CurbsideCategory}}')" role="button"  data-toggle="tooltip" data-original-title="Edit Category" > <i class="fa fa-pencil-square"></i></a> 
                        {{/if}}                     
                      
                      <a id="updateCategoryButton_{{>Id}}" rel="tooltip" style="cursor: pointer;display:none;" onclick="updateCurbsideCategoryTextById('{{>Id}}')" role="button"  data-toggle="tooltip" data-original-title="Update" > <i class="fa fa-pencil-square"></i></a> 

                        <a rel="tooltip" style="cursor: pointer;" onclick="changeCurbsideCategoryStatus('{{>Id}}','status')" role="button"  data-toggle="tooltip" data-original-title="Change Status" > <i class="icon-place-renewstatus"></i></a> 
                    </td>

                </tr>

                {{/for}}
            </tbody>

        </table>

        <div class="pagination pagination-right">
            <div id="pagination"></div>  

        </div>




    </div>        



</div>
</script>