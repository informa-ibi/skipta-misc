<div class="normaloutersection">
    <label>Option Value</label>
    <div class="normalsection">
        <div class="surveyradiobutton"> <input type="radio" class="styled "  disabled="true"></div>
        <div class="surveyremoveicon"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Delete option"/></div>
        <div class="row-fluid">
            <div class="span12">
                <div class="control-group controlerror"> 
                    <input type="hidden"  id="radio_hidden_<?php echo $widgetCount; ?>" class="radiohidden"/>
                    <input value="" type="text" class="textfield span12 radiotype" name="radio_<?php echo $widgetCount; ?>"  id="radioid_<?php echo $widgetCount; ?>" onblur="insertText(this.id)" onkeyup="insertText(this.id)" />
                    <div style="display:none"  class="errorMessage radioEmessage"  id="radioEmessage_<?php echo $widgetCount; ?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Custom.init();
    $("[rel=tooltip]").tooltip();
</script>