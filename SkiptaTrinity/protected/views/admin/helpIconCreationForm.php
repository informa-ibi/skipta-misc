<div class="modal fade" id="addNewHelpIcon" tabindex="-1" role="dialog" aria-labelledby="PasswordPoliciesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" id="NewHelpIcon_header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div id="NewHelpIconLabel" style="display: none">
                                <h4 class="modal-title" >New Help Bubble</h4>
                            </div>
                            <div id="UpdateHelpIconLabel" style="display: none">
                                <h4 class="modal-title" >Update Help Bubble</h4>
                            </div>
                            
                        </div>
                        <div>
                           
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'helpIconCreation-form',
                                        'enableClientValidation' => true,
                                        'enableAjaxValidation' => false,
                                        'clientOptions' => array(
                                            'validateOnSubmit' => true,
                                        ),
                                        //'action'=>Yii::app()->createUrl('//user/forgot'),
                                        'htmlOptions' => array(
                                            'style' => 'margin: 0px; accept-charset=UTF-8',
                                        ),
                                    ));
                                    ?>
                            <div id="categoryCreationSpinLoader"></div>
                                <div class="signdiv">
                                    <div class="alert-error" id="errmsgForHelpIcon" style='display: none'></div>
                                    <div class="alert-success" id="sucmsgForHelpIcon" style='display: none'></div>          
                                    <div class="row-fluid">
                                        <div class="span12">
                                         <?php echo $form->hiddenField($helpIconCreation,"id");?>
                                          
                                                     <?php echo $form->labelEx($helpIconCreation, Yii::t('translation', 'HelpIcon_Name')); ?>   
                                                        <?php echo $form->textField($helpIconCreation, 'name', array("placeholder" => '', 'maxlength' => 40, 'class' => 'styled span12 textfield')); ?>  
                                                        <div class="control-group controlerror">
                                                    <?php echo $form->error($helpIconCreation, 'name'); ?>
                                                </div>
                                                        <?php echo $form->labelEx($helpIconCreation, Yii::t('translation', 'HelpIcon_Description')); ?>
                                                    <div id="editableDescription" class="styled inputor"  contentEditable="true" ></div>
                                                    <?php echo $form->hiddenField($helpIconCreation, 'description', array('class' => 'span12')); ?>
                                                       
                                                        <div class="control-group controlerror">
                                                            <?php echo $form->error($helpIconCreation, 'description'); ?>
                                                        </div>
                                                  
                                                         <?php echo $form->labelEx($helpIconCreation, Yii::t('translation', 'HelpIcon_Cue')); ?>
                                                        <?php echo $form->textarea($helpIconCreation, 'cue', array("id" => "cue",'maxlength' => '250','class' => 'styled span12 textfield')); ?>
                                                             <div class="control-group controlerror">
                                                            <?php echo $form->error($helpIconCreation, 'cue'); ?>
                                                        </div>
                                              <div id="ArtifactSpinLoader_uploadfile"></div>
                                              

                                              <div class="pull-left whitespace">
                                                  <div class="advance_enhancement">
                                                      <ul><li class="dropdown pull-left ">
                                                              <div id="uploadfile" data-placement="bottom" rel="tooltip"  data-original-title="Only mov,mp4 formats allowed"></div>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>

                                              
<!--                                            <div id="uploadfile11"  data-placement="bottom" rel="tooltip"  data-original-title="Only mov,mp4 formats allowed"></div>-->
                                                        <div id="preview_HelpCreactionForm" class="preview" style="display:none">
                                                            <ul id="previewul_HelpCreactionForm">

                                                            </ul>
                                                        </div>
                                            <div id="appendlist"><ul class="qq-upload-list" id="uploadlist"></ul></div>
                                        </div>
                                    </div>
                                    
                                  
                                    
                                   <?php echo $form->hiddenField($helpIconCreation,'artifacts',array('value'=>'')); ?>
                                    <div class="headerbuttonpopup h_center padding8top">
                                        <?php echo CHtml::Button(Yii::t('translation', 'Create'),array('id' => 'newHelpIconId','class' => 'btn pull-right','onclick'=>'createHelp();')); ?> 
                                    </div>
                                    <?php echo CHtml::resetButton(Yii::t('translation', 'Clear'), array("id" => 'NewHelpIconReset', "style" => "display:none")); ?>

                                </div>
                                <?php $this->endWidget(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
<script type="text/javascript">
     $("[rel=tooltip]").tooltip();
 $("#editable").click(function()
    {
        $(this).animate({"min-height": "50px", "max-height": "200px"}, "fast");
        return false;
    });

        var extensions ='"mov","mp4","mp3"';
        initializeFileUploader('uploadfile', '/admin/uploadVideo', '10*1024*1024', extensions,'1', 'HelpCreactionForm' ,'',previewVideo,displayVideoErrorMessage,"uploadlist");


        $('input[type=text]').keypress(function(){
  $('#'+this.id+'_em_').fadeOut(2000);
});
    $(document).ready(function($) {
    $("#editableDescription").val(" ");
        $("#NewHelpIconReset").click();
    });


 function createHelp() {
    var editorObject = $("#editableDescription.inputor");
         if($.trim($('#editableDescription').text()).length>0){
             $("#HelpIconcreationForm_description").val(getEditorText(editorObject)); 
         }else{
           $("#HelpIconcreationForm_description").val('');
         }
        $("#HelpIconcreationForm_artifacts").val(globalspace["HelpCreactionForm_Artifacts"]);
         var data = $("#helpIconCreation-form").serialize();
         ajaxRequest('/admin/createnewhelpicon', data, helpDescriptionIconCreationHandler,"json",createHelpBeforeSend)
         
}
function createHelpBeforeSend(){
     if (globalspace.removedFilePath != undefined) {
                    closeimage("", globalspace.removedFilePath, globalspace.removedFilePath, globalspace.removedFilePath, "HelpIconcreationForm_artifacts");
                }
                scrollPleaseWait("categoryCreationSpinLoader", "helpIconCreation-form");
}
</script>