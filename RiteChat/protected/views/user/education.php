
<div id="<?php echo str_replace(" ","",$EducationName); ?>_<?php echo $Id; ?>" data-id='<?php echo $EducationId; ?>' >

    <div id="<?php echo str_replace(" ","",$EducationName); ?>_<?php echo $EducationId; ?>" data-id='<?php echo $Id; ?>' class="educationchild">
        <div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?php echo str_replace(" ","",$EducationName); ?>">
            <?php echo $EducationName; ?>
        </a>
        <div class="sectionremove" data-placement="bottom" rel="tooltip"  data-original-title="Remove section" onclick="removeSection('<?php echo $EducationId; ?>','<?php echo str_replace(" ","",$EducationName); ?>','E_dropdown','Education','<?php echo $Id; ?>')"><i class="fa fa-times"></i>
        </div>
    </div>
    <div id="collapse_<?php echo str_replace(" ","",$EducationName); ?>" class="accordion-body collapse in">
        <div class="accordion-inner education">

            <div class="row-fluid">
                <div class="span12">
                    <div class="span4">

                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Name'); ?></label>
                        <div class="control-group controlerror marginbottom10">
                            <input type="text" name="UserCVForm[CollegeName][<?php echo $Id; ?>]" class="span12 textfield" maxlength="50" id="UserCVForm_CollegeName_<?php echo $Id; ?>">
                            <div style="display:none" id="UserCVForm_CollegeName_<?php echo $Id; ?>_em_" class="errorMessage"></div>
                        </div>
                    </div>
                    <div class="span4">

                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Specialization'); ?></label>
                        <div class="control-group controlerror marginbottom10">
                            <input type="text" name="UserCVForm[Specialization][<?php echo $Id; ?>]" class="span12 textfield" maxlength="50" id="UserCVForm_Specialization_<?php echo $Id; ?>">
                            <div style="display:none" id="UserCVForm_Specialization_<?php echo $Id; ?>_em_" class="errorMessage"></div>                        </div>
                    </div>
                    <div class="span4 divrelative">

                        <label><?php echo Yii::t('translation', 'User_Cv_Education_Year'); ?></label>
                        <div data-date="" data-date-format="mm/dd/yyyy" class="input-append date " id="Education_Year_<?php echo $Id; ?>">
                            <input type="text" name="UserCVForm[YearOfPassing][<?php echo $Id; ?>]" class="span12 textfield"  maxlength="50" id="UserCVForm_YearOfPassing_<?php echo $Id; ?>"> 

                            <div class="control-group controlerror"> 
                                <div style="display:none" id="UserCVForm_YearOfPassing_<?php echo $Id; ?>_em_" class="errorMessage"></div>                            </div>
                        </div>  
                    </div>
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