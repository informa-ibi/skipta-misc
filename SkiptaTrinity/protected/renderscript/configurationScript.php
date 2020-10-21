<script  id="configTmp_render" type="text/x-jsrender">
<div style="position: relative">
        <div  class="block">
        <div class="tablehead pull-left" >
                  
                  <span rel="tooltip" style="cursor: pointer;float:left;" onclick="createNewConfig()" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Create_New_Parameter'); ?>">
                        <i class="fa fa-plus-circle" style="vertical-align:top;"></i>
                            
                        </span>
                </div>
        <div class="tablehead pull-right" >
                <span rel="tooltip" class="pull-right" style="cursor: pointer;float:left;margin-right:8px;" onclick="refreshSettings()" role="button"  data-toggle="tooltip" title="<?php echo Yii::t('translation','Apply_Settings'); ?>">
                <img src="/images/icons/page_reload.png" />
                            </span>

            </div>
            <div class="tablehead tableheadright pull-right">
                 <div class="tabletopcorner">
                 
        </div>
            <div class="tabletopcorner tabletopcornerpaddingtop">
           
            </div>
            </div>  
            <span id="spinner_admin"></span>
            <a class="block-heading" data-toggle="collapse" style="text-decoration:none;">&nbsp;</a>
            <div id="tablewidget"  style="margin: auto;">
           
             <table class="table table-hover">
                       
                    <thead><tr><th>AccessKey</th><th>AccessValue</th><th>Actions</th></tr></thead>
                    <tbody>
                        <tr id="noRecordsTR" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b><?php echo Yii::t('translation','No_records_found'); ?></b></span>
                            </td>
                        </tr>
                        {{for data.data}}    
                        <tr class="odd">
                                    <td>{{>Key}}
                                                </td>
                                        <td>
                                              {{>Value}}
                                   </td>
                           <td>
                                       {{if Enable == 0}}
                                              <a rel="tooltip" style="cursor: pointer;" data-id="{{>Id}}" class="editparameter" role="button"  data-toggle="tooltip" data-original-title="<?php echo Yii::t('translation','edit'); ?>" > <i class="fa fa-pencil-square"></i></a> 
                                              {{/if}}
                                   </td>
                        </tr>

                {{/for}}
            </tbody>

        </table>





    </div>        



</div>
</script>