<table cellpadding="0" cellspacing="0" class="customsurvaytable">
    <tr>
        <th class="col1"></th>
        <?php for ($i = 0; $i < ($thcount); $i++) { ?>
        <input type="hidden" name="ExtendedSurveyForm[LabelName][<?php echo $i . "_" . $widgetCount; ?>]" id="ExtendedSurveyForm_LabelName_hid_<?php echo $i . "_" . $widgetCount; ?>" class="label_hidden"/>
        <th id="th_labelname_<?php echo $i . "_" . $widgetCount; ?>">
        <div class="surveydeleteaction positionrelative">             
            <input  type="text" class="textfield textfieldtable" placeHolder="Label Name" name="LabelName_<?php echo $widgetCount; ?>" data-hiddenname="ExtendedSurveyForm_LabelName_hid_<?php echo $i . "_" . $widgetCount; ?>" id="ExtendedSurveyForm_LabelName_<?php echo $i . "_" . $widgetCount; ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
            <div class="control-group controlerror">
                <div style="display:none"  id="ExtendedSurveyForm_LabelName_<?php echo $i . "_" . $widgetCount; ?>_em_" class="errorMessage" style="font-weight:normal"></div>
            </div>
        </div>


    </th>  
<?php } ?>
<th></th>
</tr>

<?php for ($i = 0; $i < $thcount; $i++) { ?>

    <input type="hidden" name="ExtendedSurveyForm[OptionName][<?php echo $i . "_" . $widgetCount; ?>]" id="ExtendedSurveyForm_OptionName_hid_<?php echo $i . "_" . $widgetCount; ?>" class="option_hidden"/>
    <tr>
        <td>
            <div class="control-group controlerror">
                <input type="text" placeholder="Option Name" class="textfield textfieldtable option_text" name="OptionName_<?php echo $widgetCount; ?>" data-hiddenname="ExtendedSurveyForm_OptionName_hid_<?php echo $i . "_" . $widgetCount; ?>" id="ExtendedSurveyForm_Ranking_<?php echo $i . "_" . $widgetCount; ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
                <div style="display:none"  id="ExtendedSurveyForm_OptionName_<?php echo $i . "_" . $widgetCount; ?>_em_" class="errorMessage ranking_errmsg"></div>
            </div>
        </td>
        <?php for ($j = 0; $j < $radioOpCnt; $j++) { ?>
            <td><div class="positionrelative displaytable">
                    <input type="radio" class="styled ranking_radio" id="radio_<?php echo $i . "_" . $widgetCount; ?>" name="radio_<?php echo $i . "_" . $widgetCount; ?>" disabled="true"/>
                </div>
            </td>
        <?php } ?>


    </tr>
<?php } ?>
</table>
<script type="text/javascript">
    Custom.init();     
</script>