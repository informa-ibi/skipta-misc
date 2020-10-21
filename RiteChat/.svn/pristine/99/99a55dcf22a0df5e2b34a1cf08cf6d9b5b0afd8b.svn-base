<script  id="templateCongfigurationTmp_render" type="text/x-jsrender">
<div style="position: relative">

        <div  class="block">
        <div class="tablehead pull-left" >
                  
                  <div rel="tooltip" style="cursor: pointer;" onclick="createNewTemplateConfiguration()" role="button"  data-toggle="tooltip" title="Create Template">
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

                    <thead><tr><th >Title</th><th >File Name</th><th>Actions</th></tr></thead>
                    <tbody>
                        <tr id="noRecordsFound" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b>No records found</b></span>
                            </td>
                        </tr>
                        {{for data.data}}    
                        <tr class="odd">
                                    <td><div class="title_mobile" >{{>Title}}</div></td>
                                       
                           <td><div class="title_mobile" >{{>FileName}}</div></td>
                         
                        <td>  
                            <a id="editButton_{{>Id}}" rel="tooltip" style="cursor: pointer;" onclick="editTemplateConfigurationDetailsById('{{>id}}')" role="button"  data-toggle="tooltip" title="Edit Details" > <i class="fa fa-pencil-square"></i></a> 
                            <a rel="tooltip" style="cursor: pointer;" onclick="previewTemplate('{{>Title}}')" role="button"  data-toggle="tooltip" title="Preview Template" > <i class="icon-place-view"></i></a> 
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