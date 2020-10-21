<script  id="templateCongfigurationTmp_render" type="text/x-jsrender">
<div style="position: relative">

        <div  class="block">
        <div class="tablehead pull-left" >
                  
                  <div rel="tooltip" style="cursor: pointer;" onclick="createNewTemplateConfiguration()" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Create_Template'); ?>">
                        <i class="fa fa-plus-circle"></i>
                        </div>
            </div>
            <div class="tablehead tableheadright pull-right">

            <div class="tabletopcorner tabletopcornerpaddingtop">
            </div>
            </div> 
            <span id="spinner_admin"></span>            
            <a class="block-heading" data-toggle="collapse">&nbsp;</a>
            <div id="tablewidget"  style="margin: auto;">
             <table class="table table-hover">

                    <thead><tr><th ><?php echo Yii::t('translation','Title'); ?></th><th ><?php echo Yii::t('translation','File_Name'); ?></th><th><?php echo Yii::t('translation','Actions'); ?></th></tr></thead>
                    <tbody>
                        <tr id="noRecordsFound" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b><?php echo Yii::t('translation','No_records_found'); ?></b></span>
                            </td>
                        </tr>
                        {{for data.data}}    
                        <tr class="odd">
                                    <td><div class="title_mobile" >{{>Title}}</div></td>
                                       
                           <td><div class="title_mobile" >{{>FileName}}</div></td>
                         
                        <td>  
                            <a id="editButton_{{>Id}}" rel="tooltip" style="cursor: pointer;" onclick="editTemplateConfigurationDetailsById('{{>id}}')" role="button"  data-toggle="tooltip" title="Edit Details" > <i class="fa fa-pencil-square"></i></a> 
                            <a rel="tooltip" style="cursor: pointer;" onclick="previewTemplate('{{>Title}}')" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Preview_Template'); ?>" > <i class="icon-place-view"></i></a> 
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
</div>

</script>