<script  id="helpMangementTmp_render" type="text/x-jsrender">
<div style="position: relative">

        <div  class="block">
        <div class="tablehead pull-left" >
                  
                  <div rel="tooltip" style="cursor: pointer;" onclick="createNewHelpIconDescription()" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Create_Help'); ?>">
                        <i class="fa fa-plus-circle"></i>
                        </div>
            </div>
            <div class="tablehead tableheadright pull-right">
            <div class="tabletopcorner">
                 <input type="text" placeholder="search" class="textfield textfieldsearch " id="searchTextId" onkeypress="return searchHelpIconDescription(event)" />
                             </div>
                 <div class="tabletopcorner">
                 <select id="filterHelpIconDescriptionTitle" class="styled textfieldsearch">
                    <option value="all">
                        <?php echo Yii::t('translation','All'); ?>
                    </option>
                    <option value="active">
                        <?php echo Yii::t('translation','Active'); ?>
                    </option>
                    <option value="deleted">
                        <?php echo Yii::t('translation','Inactive'); ?>
                    </option> 
                </select> 
        </div>
                 <div class="btn-group pagesize tabletopcorner tabletopcornerpaddingtop" >
                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" data-placement="top"><?php echo Yii::t('translation','Page_size'); ?><span class="caret"></span></button>
                <ul class="dropdown-menu" style="min-width:70px">
                    <li><a href="#" id="pagesize_5" onclick="setPageLength(5,'newHelpDescription')">5</a></li>
                    <li><a href="#" id="pagesize_10" onclick="setPageLength(10,'newHelpDescription')">10</a></li>
                    <li><a href="#" id="pagesize_15" onclick="setPageLength(15,'newHelpDescription')">15</a></li>                  
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

                    <thead><tr><th class="curdTh3Wdth" >Title</th><th class="data_t_hide">Content</th><th class="curdTh1Wdth">Cue</th><th class="curdTh4Wdth" >Status</th><th class="curdTh2Wdth data_t_hide"  >Video</th><th class="curdTh2Wdth">Actions</th></tr></thead>
                    <tbody>
                        <tr id="noRecordsTR" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b><?php echo Yii::t('translation','No_records_found'); ?></b></span>
                            </td>
                        </tr>
                        {{for data.data}}    
                        <tr class="odd">
                                    <td><div class="title_mobile" >{{>Name}}</div></td>
                                       
                            <td  class="data_t_hide">
                                        {{:~getSubString(Description, 75)}}
                                   
                            </td> 
                     <td><div class="title_mobile" >{{>Cue}}</div></td>
                            <td>
                                                
                                <div id="helpIconDescriptionId_{{>Id}}">
                                    {{if Status == 1}}
                                       <?php echo Yii::t('translation','Active'); ?>
                                    {{else Status == 0}}
                                        <?php echo Yii::t('translation','Inactive'); ?>
                                    {{/if}}

                                </div>    
                                <div id="helpIconDescription_edit_{{>Id}}" style="display: none" class="changestatus">
                                <div class="positionrelative" style="width:120px;">
                                    <select style="width:120px;" class="styled" id="helpIconStatus" data-id="{{>Id}}"  id="helpIconDescriptionSelect_{{>Id}}" >
                                                    {{if Status == 1}}
                                                        <option value="1" selected>
                                                                <?php echo Yii::t('translation','Active'); ?>
                                                        </option>
                                                        <option value="0"> 
                                                                <?php echo Yii::t('translation','Inactive'); ?>
                                                        </option>
                                                    {{else Status == 0}}
                                                    <option value="0" selected>
                                                            <?php echo Yii::t('translation','Inactive'); ?>
                                                    </option>
                                                    <option value="1"> 
                                                           <?php echo Yii::t('translation','Active'); ?>
                                                    </option>
                                            {{/if}}
                                    </select>
                                    </div>
                                </div>
                            </td>
                            <td class="data_t_hide"> 
                                     {{if VideoPath != " " && VideoPath != "null" && VideoPath != null}}
                                <i class="fa fa-video-camera video"></i> 
                                 {{/if}}
                            </td>
                            

                    <td>  
                       {{if Status != 0}}
                        <a id="editButton_{{>Id}}" rel="tooltip" style="cursor: pointer;" onclick="editHelpIconDescriptionById('{{>Id}}','{{>Name}}')" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Edit'); ?>" > <i class="fa fa-pencil-square"></i></a> 
                       {{/if}}                     

                        <a rel="tooltip" style="cursor: pointer;" onclick="changeHelpIconDescriptionStatus('{{>Id}}','Status')" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Change_Status'); ?>" > <i class="icon-place-renewstatus"></i></a> 
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