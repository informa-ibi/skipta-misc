<div class="paddingtblr1030">
    <div id="answerstabs_<?php echo $widgetCount; ?>" class="answerstabs">        
             <ul class="tabsselection" data-questionno="<?php echo $widgetCount; ?>">
                        <li class="active" data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                        <li data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                        <li data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                        <li data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                        <li data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                        <li data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                    </ul>
        
    </div>
    <div class="tab_1">
        <div class="addbuttonarea alignright" >
            <img src="/images/system/spacer.png" class="surveyaddbutton surveyaddoption" data-optionType="radio" data-questionno="<?php echo $widgetCount; ?>" id="surveyaddoption_<?php echo $widgetCount; ?>" data-placement="bottom" rel="tooltip"  data-original-title="Add one more option"/>
        </div>
        <div class="answersection1" id="answersection1_<?php echo $widgetCount; ?>" data-questionId="<?php echo $widgetCount; ?>" data-optionType="radio">

            <?php for ($i = 1; $i <= $radioLength; $i++) { ?>
                <input type="hidden" name="ExtendedSurveyForm[RadioOption][<?php echo $i . "_" . $widgetCount; ?>]" id="ExtendedSurveyForm_RadioOption_hid_<?php echo $i . "_" . $widgetCount; ?>" class="radiohidden"/>
                <div class="normaloutersection">
                    <label>Option Name </label>
                    <div class="normalsection">
                        <div class="surveyradiobutton"> <input type="radio" class="styled"  disabled="true"></div>
                        <div class="surveyremoveicon"><img src="/images/system/spacer.png"  data-placement="bottom" rel="tooltip"  data-original-title="Delete option"/></div>
                        <div class="row-fluid">
                            <div class="span12">

                                <input  type="text" class="textfield span12 radiotype"  name="radio_<?php echo $widgetCount; ?>" data-hiddenname="ExtendedSurveyForm_RadioOption_hid_<?php echo $i . "_" . $widgetCount; ?>" id="ExtendedSurveyForm_RadioOption_<?php echo $i . "_" . $widgetCount; ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)"/>
                                <div class="control-group controlerror">  
                                    <div style="display:none" id="ExtendedSurveyForm_RadioOption_<?php echo $i . "_" . $widgetCount; ?>_em_" class="errorMessage radioEmessage"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>


                <input type="hidden" name="ExtendedSurveyForm[Other][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_Other_<?php echo $widgetCount; ?>" class="otherhidden"/>
            <input type="hidden" name="ExtendedSurveyForm[OtherValue][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_OtherValue_<?php echo $widgetCount; ?>" class="otherhiddenvalue"/>
            <div class="othersarea" id="othersarea_<?php echo $widgetCount; ?>">
                <input type="checkbox" class="styled othercheck" name="1" id="othercheck_<?php echo $widgetCount; ?>" /> <i>Others</i>      
            </div>
            <div class="row-fluid otherTextdiv" style="display: none;" id="otherTextdiv_<?php echo $widgetCount; ?>">
                <div class="span12">
                    <input type="text"  id="otherText_<?php echo $widgetCount; ?>" class="span12 textfield othertext"  data-hiddenname="ExtendedSurveyForm_OtherValue_<?php echo $widgetCount; ?>"  onkeyup="insertText(this.id)" onblur="insertText(this.id)"/>
                    <div class="control-group controlerror">
                        <div style="display:none"  id="ExtendedSurveyForm_OtherValue_<?php echo $widgetCount; ?>_em_" class="errorMessage othererr"></div>
                    </div>
                </div>
            </div>

            <div class="surveybuttonarea alignright" style="display: none;">
                <input type="button" value="Save" name="commit" class="btn " onclick="saveQuestion('<?php echo $widgetCount; ?>')"> <input type="reset" value="Cancel" name="commit" class="btn btn_gray ">
            </div>
        </div>     

    </div>
</div>



<script type="text/javascript">
    function showmore(id) {
        document.getElementById(id).style.overflow = "visible";
        document.getElementById(id).style.height = " ";

    }
    $(document).ready(function() {
        Custom.init();
        $("[rel=tooltip]").tooltip();

    });   
    
</script>