
<table cellpadding="0" cellspacing="0" class="customsurvaytable">
    <tr>
        <th class="col1"></th>
        <?php for ($i = 0; $i < $ratingsCnt; $i++) { ?>
        <input type="hidden" name="ExtendedSurveyForm[LabelName][<?php echo $i . "_" . $widgetCount; ?>]" id="ExtendedSurveyForm_LabelName_hid_<?php echo $i . "_" . $widgetCount; ?>" class="rankinghidden"/>
        <th >
        <div class="surveydeleteaction positionrelative">
            <input type="text" class="textfield textfieldtable" placeHolder="Label Name" name="LabelName_<?php echo $widgetCount; ?>" data-hiddenname="ExtendedSurveyForm_LabelName_hid_<?php echo $i . "_" . $widgetCount; ?>" id="ExtendedSurveyForm_LabelName_<?php echo $i . "_" . $widgetCount; ?>" onkeyup="insertText(this.id)"  onblur="insertText(this.id)"  maxlength="500">
            
        <div class="control-group controlerror">
            <div style="display:none"  id="ExtendedSurveyForm_LabelName_<?php echo $i . "_" . $widgetCount; ?>_em_" class="errorMessage" style="font-weight:normal"></div>
        </div>
            </div>
        
    </th>
<?php } ?>
</tr>

<?php for ($i = 0; $i < $thcount; $i++) { ?>    

    <input type="hidden" name="ExtendedSurveyForm[OptionName][<?php echo $i . "_" . $widgetCount; ?>]" id="ExtendedSurveyForm_OptionName_hid_<?php echo $i . "_" . $widgetCount; ?>" class="rankinghidden"/>
    <tr>
        <td>
            <input type="text" placeholder="Option Name" class="textfield textfieldtable" name="OptionName_<?php echo $widgetCount; ?>" data-hiddenname="ExtendedSurveyForm_OptionName_hid_<?php echo $i . "_" . $widgetCount; ?>" id="ExtendedSurveyForm_Ranking_<?php echo $i . "_" . $widgetCount; ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
            <div class="control-group controlerror">
                <div style="display:none"  id="ExtendedSurveyForm_OptionName_<?php echo $i . "_" . $widgetCount; ?>_em_" class="errorMessage"></div>
            </div>
        </td>

        <?php for ($j = 0; $j < $ratingsCnt; $j++) { ?>
            <td>
                <div class="positionrelative displaytable">
                    <input type="radio" class="styled "   id="1" name="1" disabled="true"/>
                </div>
            </td> 
        <?php } ?>
    </tr> 
<?php } ?>     
</table>
<script type="text/javascript">
    Custom.init();    
</script>