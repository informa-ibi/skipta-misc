<div class="QuestionWidget" data-questionId="<?php echo $widgetCount; ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo $widgetCount; ?>">       
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'questionWidget_' . $widgetCount,
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'class' => "questionwidgetform",
            'style' => 'margin: 0px; accept-charset=UTF-8',
        ),
    ));
    ?>    
    <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo $widgetCount; ?>" value="1" />
    <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo $widgetCount; ?>" />
    
    <div class="surveyquestionsbox">
        <div class="surveyareaheader">
            <div class="subsectionremove" data-questionId="<?php echo $widgetCount; ?>">
                <img src="/images/system/spacer.png" class="surveyaddbutton" data-placement="bottom" rel="tooltip"  data-original-title="Remove question"/>
            </div>
            <div class="row-fluid">
                <div class="span12 questionwidget">
                    <div class="control-group controlerror">
                        <span class="child"><label class="questionlabel" data-wid="<?php echo $widgetCount; ?>" style="cursor: pointer;">Question</label></span>


                        <input type="text" name="ExtendedSurveyForm[Question][<?php echo $widgetCount; ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo $widgetCount; ?>" onblur="insertText(this.id)"/>
                        <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo "$widgetCount"; ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo "$widgetCount"; ?>" ></div>
                    </div>
                </div>
            </div>
            <div id="spinner_<?php echo $widgetCount; ?>" style="position:relative;"></div>
        </div>
        
        <div class="surveyanswerarea" id="surveyanswerarea_<?php echo $widgetCount; ?>" >
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
                            <input type="hidden" name="ExtendedSurveyForm[RadioOption][<?php echo $i . "_" . $widgetCount; ?>]" id="ExtendedSurveyForm_RadioOption_hid_<?php echo $i . "_" . $widgetCount; ?>" class="radiohidden" />
                            <div class="normaloutersection">
                                <label>Option Name </label>
                                <div class="normalsection">
                                    <div class="surveyradiobutton"> <input type="radio" class="styled "  disabled="true"></div>
                                    <div class="surveyremoveicon"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Remove option"/></div>
                                    <div class="row-fluid">
                                        <div class="span12">

                                            <input value="" type="text" class="textfield span12 radiotype" data-hiddenname="ExtendedSurveyForm_RadioOption_hid_<?php echo $i . "_" . $widgetCount; ?>"  name="radio_<?php echo $widgetCount; ?>" id="ExtendedSurveyForm_RadioOption_<?php echo $i . "_" . $widgetCount; ?>" onkeyup="insertText(this.id)"/>
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
                        <!--   <div class="surveybuttonarea alignright" style="display:none;">
                         <input type="button" value="Save" name="commit" class="btn" onclick="saveQuestion('<?php //echo $widgetCount;  ?>','radio')"> 
                         <input type="submit" value="Cancel" name="commit" class="btn btn_gray ">
                           </div>-->
                    </div>     

                </div>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        Custom.init();        
    });
    $("[rel=tooltip]").tooltip();
    <?php if(empty($surveyId)){ ?>
    $("#othersarea_<?php echo $widgetCount; ?> span").live('click', function() {
        var isChecked = 0;
        if ($('#othercheck_<?php echo $widgetCount; ?>').is(':checked')) {
            isChecked = 1;
            $("#otherTextdiv_<?php echo $widgetCount; ?>").show();
        } else {
            $("#otherTextdiv_<?php echo $widgetCount; ?>").hide();
        }
        $("#ExtendedSurveyForm_Other_<?php echo $widgetCount; ?>").val(isChecked);       

    });  
    <?php } ?>
   // alert('<?php //echo $widgetCount; ?>')


</script>