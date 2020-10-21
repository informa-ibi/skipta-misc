<?php
include 'emailCredentialsConfigurationScript.php';
include 'emailCredentialsCreationForm.php';
include 'templateConfigurationScript.php';
include 'templateConfigurationCreationForm.php';
?>
<div class="padding10 ">

    <h3 class="pagetitle" style="display:none">Email Accounts</h3>
    <div id="emailConfigurationManagement_div" style="display:none"></div>

    <h3 class="pagetitle">Email Templates</h3>
    <div id="templateManagement_div"></div>

    <h3 class="pagetitle">Disclosures</h3>
    <div id="tosView_div"><div style="position: relative">

        <div  class="block">
        <div class="tablehead pull-left" >
            </div>
            <div class="tablehead tableheadright pull-right">

            <div class="tabletopcorner tabletopcornerpaddingtop">
            </div>
            </div> 
            <span id="spinner_admin"></span>            
            <a class="block-heading" data-toggle="collapse">&nbsp;</a>
            <div id="tablewidget"  style="margin: auto;">
             <table class="table table-hover">

                    <thead><tr><th class="curdTh3Wdth" >Name</th><th class="curdTh1Wdth">File Name</th><th class="curdTh1Wdth">Actions</th></tr></thead>
                    <tbody>
                        <tr id="noRecordsFound" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b>No records found</b></span>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td><div class="title_mobile" >TOS_TemplateFileName</div></td>
                            <td><div class="title_mobile" ><?php echo YII::app()->params['TOS_TemplateFileName'];?></div></td>
                             <td>  
                            <a rel="tooltip" style="cursor: pointer;" onclick="previewTosAndPolicyTemplate('termsOfServices')" role="button"  data-toggle="tooltip" title="Preview Template" > <i class="icon-place-view"></i></a> 
                           </td>
                        </tr>
                        <tr class="odd">
                            <td><div class="title_mobile" >Privacy Policy_TemplateFileName</div></td>
                            <td><div class="title_mobile" ><?php echo YII::app()->params['Privacy Policy_TemplateFileName'];?></div></td>
                            <td>  
                            <a rel="tooltip" style="cursor: pointer;" onclick="previewTosAndPolicyTemplate('privacyPolicy')" role="button"  data-toggle="tooltip" title="Preview Template" > <i class="icon-place-view"></i></a> 
                           </td>
                        </tr>
            </tbody>
        </table>
    </div>        


</div>
</div></div>

</div>
<script type="text/javascript">
    getEmailConfigurationDetailsHandler(<?php echo $data; ?>);
    getTemplateConfigurationHandler(<?php echo $templateData; ?>);
</script>
<script type="text/javascript">
    function previewTosAndPolicyTemplate(templateType)
 {
     $('#newModal').modal('show');
     $('#newModal_btn_primary').hide();
     $('#newModalLabel').text('Preview');
     $('#newModal_btn_close').hide();
     var queryString = "templateType="+templateType;
     ajaxRequest("/admin/getPreviewTemplate", queryString, getpreviewTosAndPolicyTemplateHandler,'html');
 }
 function getpreviewTosAndPolicyTemplateHandler(data) {
    $('#newModal_body').html(data);
 }

</script>
