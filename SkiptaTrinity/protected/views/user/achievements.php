
<div id="<?php echo str_replace(" ","",$Achievement); ?>_<?php echo $AchievementId; ?>" class="achievementschild">
    <input id="UserCVForm_UserAchievements_<?php echo $AchievementId; ?>" type="hidden" name="UserCVForm[UserAchievements][<?php echo $AchievementId; ?>]">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse_<?php echo $Achievement; ?>">
                <?php echo $Achievement; ?>
            </a>
            <div class="sectionremove" data-placement="bottom" rel="tooltip"  data-original-title="<?php echo Yii::t('translation','close'); ?>" onclick="removeSection('<?php echo $AchievementId; ?>', '<?php echo str_replace(" ","",$Achievement); ?>', 'Am_dropdown', 'Achievements','')"><i class="fa fa-times"></i>
            </div>
        </div>
        <div id="collapse_<?php echo $Achievement; ?>" class="accordion-body collapse in achievements">
            <div class="accordion-inner">

                <div class="row-fluid">
                    <div class="span12">
                        
                        <div class="control-group controlerror">
                        <div id="achievements_<?php echo $AchievementId; ?>"  class=" inputor editableAchievementdiv"  contentEditable="true" > </div>   
                            <div style="display:none" id="UserCVForm_UserAchievements_<?php echo $AchievementId; ?>_em_" class="errorMessage"></div>                                           </div>
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
                                        

                                        
