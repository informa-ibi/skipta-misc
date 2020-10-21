<script  id="emailCongfigurationTmp_render" type="text/x-jsrender">
<div style="position: relative">

        <div  class="block">
        <div class="tablehead pull-left" >
                  
                  <div rel="tooltip" style="cursor: pointer;" onclick="createNewEmailConfiguration()" role="button"  data-toggle="tooltip" title="New Configuration">
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

                    <thead><tr><th class="curdTh3Wdth" >Email</th><th class="curdTh1Wdth">SMTP Address</th><th class="curdTh2Wdth">Actions</th></tr></thead>
                    <tbody>
                        <tr id="noRecordsTR" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b>No records found</b></span>
                            </td>
                        </tr>
                        {{for data.data}}    
                        <tr class="odd">
                                    <td><div class="title_mobile" >{{>Email}}</div></td>
                                       
                           <td><div class="title_mobile" >{{>SMTPAddress}}</div></td>
                        <td>  
                            <a id="editButton_{{>Id}}" rel="tooltip" style="cursor: pointer;" onclick="editEmailConfigurationDetailsById('{{>id}}','{{>Email}}')" role="button"  data-toggle="tooltip" title="Edit Details" > <i class="fa fa-pencil-square"></i></a> 
                            <a rel="tooltip" style="cursor: pointer;" onclick="previewEmailConfigDetails('{{>id}}')" role="button"  data-toggle="tooltip" title="Preview Template" > <i class="icon-place-view"></i></a>
                        </td>
                </tr>
                {{/for}}
            </tbody>
        </table>
    </div>        


</div>
</div>

</script>
<script  id="emailConfigDetailsPreview_render" type="text/x-jsrender">
            <span id="spinner_admin"></span>
            <div class="row-fluid">
         <div class="span12">
             {{for data.data}}
         <div class="span8">
                  <table cellspacing="1" cellpadding="3" border="0" class="charttable3" >
                            
                   <tbody>
                            <tr>
                                <td class="l_label">Email  </td>
                                <td class="t_b ">: {{>Email}}</td>
                            </tr>
                             <tr>
                                <td class="l_label">Password  </td>
                                <td class="t_b "> : {{>Password}}</td>
                            </tr>
                            <tr>
                                <td class="l_label">SMTPAddress </td>
                                <td class="t_b ">: {{>SMTPAddress}}</td>
                            </tr>
                            <tr>
                                <td class="l_label">Port </td>
                                <td class="t_b ">: {{>Port}}</td>
                            </tr>
                            <tr>
                                <td class="l_label">Host </td>
                                <td class="t_b ">: {{>Host}}</td>
                            </tr>
                            <tr>
                                <td class="l_label">Encryption </td>
                                <td class="t_b ">: {{>Encryption}}</td>
                            </tr>
                            </tbody></table>  
             </div>
             
         </div>
            </div>
            </script>