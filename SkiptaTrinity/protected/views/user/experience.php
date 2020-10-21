

<div id="<?php echo str_replace(" ","",$Experience); ?>_<?php echo $ExperienceId; ?>" class="experiencechild">
    <input id="UserCVForm_UserExperience_<?php echo $ExperienceId; ?>" type="hidden" name="UserCVForm[UserExperience][<?php echo $ExperienceId; ?>]" value="">
<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo str_replace(" ","",$Experience); ?>">
            <?php if($Experience == "ProfessionalDevelopment"){echo str_replace("Development"," Development",$Experience);}else{echo str_replace("Experience"," Experience",$Experience);}  ?>
        </a>
        <div class="sectionremove" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','Remove_section'); ?>" onclick="removeSection('<?php echo $ExperienceId; ?>','<?php echo str_replace(" ","",$Experience); ?>','EX_dropdown','Experience','')"><i class="fa fa-times"></i>
        </div>
    </div>
    <div id="collapse_<?php echo str_replace(" ","",$Experience); ?>" class="accordion-body collapse in experience">
        <div class="accordion-inner">

            <div class="row-fluid">
    <div class="span12">
        <div class="control-group controlerror">
            <div id="experience_<?php echo $ExperienceId; ?>" name="UserCVForm[UserExperience][<?php echo $ExperienceId; ?>]" class=" inputor editabledivs"  style="cursor: auto;" contentEditable="true" > </div>   

            <div style="display:none" id="UserCVForm_UserExperience_<?php echo $ExperienceId; ?>_em_" class="errorMessage"></div> 
        </div>
    </div>  
</div>
        </div>

    </div>
</div>
</div>





<script type="text/javascript">
 Custom.init();    

        $('.editabledivs').bind('paste', function (event) {
     
 var EditDivId=$(this).attr('id');
 var $this = $(this); //save reference to element for use laster
 setTimeout(function(){ //break the callstack to let the event finish
     var strippedText = strip_tags($this.html(),'<p><pre><span><i><b>');
   strippedText=strippedText.replace(/\s+/g, ' ');
 $this.html(strippedText) ;
 $this.find('*').removeAttr('style');
 var result = $('#'+EditDivId);
    result.focus();
    placeCaretAtEnd( document.getElementById(EditDivId) );

},0); 
    }); 
$("[rel=tooltip]").tooltip();
    </script>
