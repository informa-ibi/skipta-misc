<div id="<?php echo str_replace(" ","",$Intersts); ?>_<?php echo $InterestId; ?>" class="interestschild">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a  class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo str_replace(" ","",$Intersts); ?>">
                <?php echo str_replace("Interests"," Interests",$Intersts); ?> <i data-original-title="<?php echo Yii::t('translation','Type_And_Press_Enter_Button'); ?>" rel="tooltip" data-placement="bottom" data-id="cvid" style="font-weight: normal;top:7px;right:auto;float:left;margin-left:5px;" class="fa fa-question helpmanagement helpicon top10  tooltiplink"></i>
            </a>
            <div class="sectionremove"  data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Remove_section'); ?>" onclick="removeSection('<?php echo $InterestId; ?>', '<?php echo str_replace(" ","",$Intersts); ?>', 'In_dropdown', 'Interests','')"><i class="fa fa-times"></i>
            </div>
        </div>
        <div id="collapse_<?php echo str_replace(" ","",$Intersts); ?>" class="accordion-body collapse in interests">
            <div class="accordion-inner">

                <div class="row-fluid">
                    <div class="span12">
                        
                        <div class="padding-bottom5">
                        <span id="UserCVForm_UserInterests_<?php echo $InterestId;?>_currentMentions" > </span>
                        </div>
                        <div class="control-group controlerror">
                            <input type="text"    name="UserCVForm[UserInterests][<?php echo $InterestId; ?>]" class="span12 textfield " value="" onkeyup="PublicationAuthors(event,this,'Interests')" maxlength="50" id="UserCVForm_UserInterests_<?php echo $InterestId; ?>">

                            <div style="display:none" id="UserCVForm_UserInterests_<?php echo $InterestId; ?>_em_" class="errorMessage"></div> 
                         <div id="UserCVForm_UserInterests_<?php  echo $InterestId;?>_error" class="errorMessage" style="display:none;"></div>
                        </div>
                    
                    </div> 

                    
                </div>
            </div>

        </div>
    </div>
</div>

<script type='text/javascript'>
  $("[rel=tooltip]").tooltip();
</script>

