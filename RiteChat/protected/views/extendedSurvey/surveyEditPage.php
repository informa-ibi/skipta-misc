<?php
$i = 0;
if(!empty($surveyObj) && sizeof($surveyObj)>0){    

    foreach ($surveyObj->Questions as $question) {
    if ($question['QuestionType'] == 1) {
        ?>
        <div class="QuestionWidget child" data-questionId="<?php echo ($i + 1); ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo ($i + 1); ?>">       
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionWidget_' . ($i + 1),
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
            <!--<form name="questionWidget_<?php //echo ($i + 1); ?>" id="questionWidget_<?php //echo ($i + 1); ?>" >-->
            <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo ($i + 1); ?>" value="1" />
            <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo ($i + 1); ?>" value="<?php echo $question['QuestionId']; ?>"/>

            <div class="surveyquestionsbox">
                <div class="surveyareaheader">

                    <div class="row-fluid">
                        <div class="span12 questionwidget">
                            <div class="control-group controlerror">
                                <label class="questionlabel" data-wid="<?php echo ($i + 1); ?>" style="cursor: pointer;">Question</label>


                                <input value="<?php echo $question['Question']; ?>" type="text" name="ExtendedSurveyForm[Question][<?php echo ($i + 1); ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>"/>
                                <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo ($i + 1); ?>" ></div>
                            </div>
                        </div>
                    </div>
                    <div id="spinner_<?php echo ($i + 1); ?>" style="position:relative;"></div>
                </div>

                <div class="surveyanswerarea" id="surveyanswerarea_<?php echo ($i + 1); ?>" >
                    <div class="paddingtblr1030">
                        <div id="answerstabs_<?php echo ($i + 1); ?>" class="answerstabs">
                            <ul class="tabsselection" data-questionno="<?php echo ($i + 1); ?>">
                                <li class="active" data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                                <li data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                                <li data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                                <li data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                                <li data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                                <li data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                            </ul>
                        </div>
                        <div class="tab_1">
                            
                            <div class="answersection1" id="answersection1_<?php echo ($i + 1); ?>" data-questionId="<?php echo ($i + 1); ?>" data-optionType="radio">
                                <?php $j = 0;                                
                                foreach ($question['Options'] as $rw) { ?>
                                    <input type="hidden" name="ExtendedSurveyForm[RadioOption][<?php echo ($j + 1) . "_" . ($i + 1); ?>]" id="ExtendedSurveyForm_RadioOption_hid_<?php echo ($j + 1) . "_" . ($i + 1); ?>" class="radiohidden" value="<?php echo $rw; ?>"/>
                                    <div class="normaloutersection">
                                        <label>Option Name </label>
                                        <div class="normalsection">
                                            <div class="surveyradiobutton"> <input type="radio" class="styled "  disabled="true"></div>
                                            
                                            <div class="row-fluid">
                                                <div class="span12">

                                                    <input value="<?php echo $rw; ?>" type="text" class="textfield span12 radiotype" data-hiddenname="ExtendedSurveyForm_RadioOption_hid_<?php echo ($j + 1) . "_" . ($i + 1); ?>"  name="radio_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_RadioOption_<?php echo ($j + 1) . "_" . ($i + 1); ?>" onkeyup="insertText(this.id)" />
                                                    <div class="control-group controlerror"> 
                                                        <div style="display:none" id="ExtendedSurveyForm_RadioOption_<?php echo ($j + 1) . "_" . ($i + 1); ?>_em_" class="errorMessage radioEmessage"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $j++;
                            } ?>
                                <input type="hidden" name="ExtendedSurveyForm[Other][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_Other_<?php echo ($i + 1); ?>" class="otherhidden" value="<?php echo $question['Other']; ?>"/>
                                <input type="hidden" name="ExtendedSurveyForm[OtherValue][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_OtherValue_<?php echo ($i + 1); ?>" class="otherhiddenvalue" value="<?php echo $question['OtherValue']; ?>"/>
                                <div class="othersarea" id="othersarea_<?php echo ($i + 1); ?>">
                                    <input value="<?php echo $question['Other']; ?>" <?php if($question['Other'] == 1) echo "checked='true'"; ?>  type="checkbox" class="styled othercheck" name="1" id="othercheck_<?php echo ($i + 1); ?>" /> <i>Others</i>      
                                </div>
                                <div class="row-fluid otherTextdiv" <?php if($question['Other'] != 1) echo "style='display:none;'";?>  id="otherTextdiv_<?php echo ($i + 1); ?>">
                                    <div class="span12">
                                        <input type="text"  id="otherText_<?php echo ($i + 1); ?>" class="span12 textfield othertext"  data-hiddenname="ExtendedSurveyForm_OtherValue_<?php echo ($i + 1); ?>"  onkeyup="insertText(this.id)" onblur="insertText(this.id)" value="<?php echo $question['OtherValue']; ?>"/>
                                        <div class="control-group controlerror">
                                            <div style="display:none"  id="ExtendedSurveyForm_OtherValue_<?php echo ($i + 1); ?>_em_" class="errorMessage othererr"></div>
                                        </div>
                                    </div>
                                </div>

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

            // alert('<?php //echo ($i+1); ?>')

        </script>

        <?php } else if ($question['QuestionType'] == 2) {
            ?>
        <div class="QuestionWidget child" data-questionId="<?php echo ($i + 1); ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo ($i + 1); ?>">       
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionWidget_' . ($i + 1),
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
            <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo ($i + 1); ?>" value="1" />
            <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo ($i + 1); ?>" value="<?php echo $question['QuestionId']; ?>"/>

            <div class="surveyquestionsbox">
                <div class="surveyareaheader">

                    <div class="row-fluid">
                        <div class="span12 questionwidget">
                            <div class="control-group controlerror">
                                <label class="questionlabel" data-wid="<?php echo ($i + 1); ?>" style="cursor: pointer;">Question</label>


                                <input value="<?php echo $question['Question']; ?>" type="text" name="ExtendedSurveyForm[Question][<?php echo ($i + 1); ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>"/>
                                <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo ($i + 1); ?>" ></div>
                            </div>
                        </div>
                    </div>
                    <div id="spinner_<?php echo ($i + 1); ?>" style="position:relative;"></div>
                </div>

                <div class="surveyanswerarea" id="surveyanswerarea_<?php echo ($i + 1); ?>" >
                    <div class="paddingtblr1030">
                        <div id="answerstabs_<?php echo ($i + 1); ?>" class="answerstabs">
                            <ul class="tabsselection" data-questionno="<?php echo ($i + 1); ?>">
                                <li  data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                                <li class="active" data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                                <li data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                                <li data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                                <li data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                                <li data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                            </ul>
                        </div>
                        <div class="tab_1">
                            
                            <div class="answersection1" id="answersection1_<?php echo ($i + 1); ?>" data-questionId="<?php echo ($i + 1); ?>" data-optionType="checkbox">
        <?php $j = 0;        
        foreach ($question['Options'] as $rw) {
             ?>
                                    <input type="hidden" name="ExtendedSurveyForm[CheckboxOption][<?php echo ($j + 1) . "_" . ($i + 1); ?>]" id="ExtendedSurveyForm_CheckboxOption_hid_<?php echo ($j + 1) . "_" . ($i + 1); ?>" class="checkboxhidden" value="<?php echo $rw; ?>" />

                                    <div class="normaloutersection">
                                        <label>Option Name</label>
                                        <div class="normalsection">
                                            <div class="surveyradiobutton"> 
                                                <div class="disabledelement"></div>
                                                <input type="checkbox" class="styled"></div>
                                            
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="control-group controlerror">
                                                        <input value="<?php echo $rw; ?>"  type="text" class="textfield span12 checkboxtype"  name="checkbox_<?php echo ($i + 1); ?>" data-hiddenname="ExtendedSurveyForm_CheckboxOption_hid_<?php echo ($j + 1) . "_" . ($i + 1); ?>" id="ExtendedSurveyForm_CheckboxOption_<?php echo ($j + 1) . "_" . ($i + 1); ?>" onkeyup="insertText(this.id)"/>
                                                        <div style="display:none"  id="ExtendedSurveyForm_CheckboxOption_<?php echo ($j + 1) . "_" . ($i + 1); ?>_em_" class="errorMessage radioEmessage checkboxEmessage"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            <?php $j++;
        } ?>
                                <input type="hidden" name="ExtendedSurveyForm[Other][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_Other_<?php echo ($i + 1); ?>" class="otherhidden" value="<?php echo $question['Other']; ?>"/>
                                <input type="hidden" name="ExtendedSurveyForm[OtherValue][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_OtherValue_<?php echo ($i + 1); ?>" class="otherhiddenvalue" value="<?php echo $question['OtherValue']; ?>"/>
                                <div class="othersarea" id="othersarea_<?php echo ($i + 1); ?>">
                                    <input value="<?php echo $question['Other']; ?>" <?php if($question['Other'] == 1) echo "checked='true'"; ?>  type="checkbox" class="styled othercheck" name="1" id="othercheck_<?php echo ($i + 1); ?>" /> <i>Others</i>      
                                </div>
                                <div class="row-fluid otherTextdiv" <?php if($question['Other'] != 1) echo "style='display:none;'";?>  id="otherTextdiv_<?php echo ($i + 1); ?>">
                                    <div class="span12">
                                        <input type="text"  id="otherText_<?php echo ($i + 1); ?>" class="span12 textfield othertext"  data-hiddenname="ExtendedSurveyForm_OtherValue_<?php echo ($i + 1); ?>"  onkeyup="insertText(this.id)" onblur="insertText(this.id)" value="<?php echo $question['OtherValue']; ?>"/>
                                        <div class="control-group controlerror">
                                            <div style="display:none"  id="ExtendedSurveyForm_OtherValue_<?php echo ($i + 1); ?>_em_" class="errorMessage othererr"></div>
                                        </div>
                                    </div>
                                </div>


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
            // alert('<?php //echo ($i+1); ?>')

        </script>

        <?php } else if ($question['QuestionType'] == 3) { ?>
        <div class="QuestionWidget child" data-questionId="<?php echo ($i + 1); ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo ($i + 1); ?>">       
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionWidget_' . ($i + 1),
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
            <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo ($i + 1); ?>" value="1" />
            <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo ($i + 1); ?>" value="<?php echo $question['QuestionId']; ?>"/>

            <div class="surveyquestionsbox">
                <div class="surveyareaheader">

                    <div class="row-fluid">
                        <div class="span12 questionwidget">
                            <div class="control-group controlerror">
                                <label class="questionlabel" data-wid="<?php echo ($i + 1); ?>" style="cursor: pointer;">Question</label>


                                <input value="<?php echo $question['Question']; ?>" type="text" name="ExtendedSurveyForm[Question][<?php echo ($i + 1); ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>"/>
                                <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo ($i + 1); ?>" ></div>
                            </div>
                        </div>
                    </div>
                    <div id="spinner_<?php echo ($i + 1); ?>" style="position:relative;"></div>
                </div>

                <div class="surveyanswerarea" id="surveyanswerarea_<?php echo ($i + 1); ?>" >
                    <input type="hidden" name="ExtendedSurveyForm[MatrixType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_MatrixType_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['MatrixType']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[NoofOptions][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['NoofOptions']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[NoofRatings][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NoofRatings_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['NoofRatings']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[Other][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NA_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['Other']; ?>"/>
                    <div class="paddingtblr1030">
                        <div id="answerstabs_<?php echo ($i + 1); ?>" class="answerstabs">
                            <ul class="tabsselection" data-questionno="<?php echo ($i + 1); ?>">
                                <li  data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                                <li  data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                                <li class="active" data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                                <li data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                                <li data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                                <li  data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                            </ul>
                        </div>
                        <div class="tab_3">
                            <div class="dropdownsectionarea dropdownmedium ">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="span4">
                                            <div class="pull-left labelalignment"><label>Type of Matrix:</label></div>
                                            <div class="pull-left positionrelative">
                                                <select class="styled" id="loadwidgetType_<?php echo ($i + 1); ?>" name="loadwidgetType_<?php echo ($i + 1); ?>" disabled="true">
                                                    <option value="1" <?php if ($question['MatrixType'] == 1) echo "Selected" ?>>Ranking</option>
                                                    <option value="2" <?php if ($question['MatrixType'] == 2) echo "Selected" ?>>Rating</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span4" id="noofoptionsdiv_<?php echo ($i + 1); ?>">
                                            <div class="pull-left labelalignment"><label>No.of Options:</label></div>
                                            <div class="pull-left positionrelative">
                                                <select disabled="true" style="width:150px" class="styled span6" data-error="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>_em_"   data-hiddenname="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>" name="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>">
                                                    <option value="">Please select</option>
        <?php for ($k = 2; $k < 10; $k++) { ?>
                                                        <option value="<?php echo $k; ?>" <?php if ($question['NoofOptions'] == $k) echo "Selected" ?>><?php echo $k; ?></option>
        <?php } ?>
                                                </select>
                                                <div class="control-group controlerror">
                                                    <div style="display:none"  id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>_em_" class="errorMessage"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="span4" id="noofratingsdiv_<?php echo ($i + 1); ?>" style="display:none;">
                                            <div class="pull-left labelalignment"><label>No.of Ratings:</label></div>
                                            <div class="pull-left positionrelative">

                                                <select style="width:150px" class="styled span6" data-error="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>_em_" data-idname="ExtendedSurveyForm_NoofRatings_" data-hiddenname="ExtendedSurveyForm_NoofRatings_hid_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>" name="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>">
                                                    <option value="">Please select</option>
        <?php for ($k = 2; $k < 10; $k++) { ?>
                                                        <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
        <?php } ?>
                                                </select>
                                                <div class="control-group controlerror">
                                                    <div style="display:none"  id="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>_em_" class="errorMessage">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="paddingtop12" >
                                <div id="rankingOrRating_<?php echo ($i + 1); ?>">
                                    <table cellpadding="0" cellspacing="0" class="customsurvaytable">
                                        <tr>
                                            <th class="col1"></th>
        <?php $j = 0;
        
        foreach ($question['LabelName'] as $rw) {
             ?>
                                            <input value="<?php echo $rw; ?>" type="hidden" name="ExtendedSurveyForm[LabelName][<?php echo ($j) . "_" . ($i + 1); ?>]" id="ExtendedSurveyForm_LabelName_hid_<?php echo ($j) . "_" . ($i + 1); ?>" class="label_hidden"/>
                                            <th id="th_labelname_<?php echo ($j) . "_" . ($i + 1); ?>">
                                            <div class="surveydeleteaction positionrelative">             
                                                <input  value="<?php echo $rw; ?>" type="text" class="textfield textfieldtable" placeHolder="Label Name" name="LabelName_<?php echo ($i + 1); ?>" data-hiddenname="ExtendedSurveyForm_LabelName_hid_<?php echo ($j) . "_" . ($i + 1); ?>" id="ExtendedSurveyForm_LabelName_<?php echo ($j) . "_" . ($i + 1); ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
                                                <div class="control-group controlerror">
                                                    <div style="display:none"  id="ExtendedSurveyForm_LabelName_<?php echo ($j) . "_" . ($i + 1); ?>_em_" class="errorMessage" style="font-weight:normal"></div>
                                                </div>
                                            </div>
                                            </th>  
            <?php $j++;
        } ?>
                                        <th></th>
                                        </tr>

        <?php $j = 0;
        
        foreach ($question['OptionName'] as $rw) {
            ?>

                                            <input value="<?php echo $rw; ?>" type="hidden" name="ExtendedSurveyForm[OptionName][<?php echo $j . "_" . ($i + 1); ?>]" id="ExtendedSurveyForm_OptionName_hid_<?php echo $j . "_" . ($i + 1); ?>" class="option_hidden"/>
                                            <tr>
                                                <td>
                                                    <div class="control-group controlerror">
                                                        <input value="<?php echo $rw; ?>" type="text" placeholder="Option Name" class="textfield textfieldtable option_text" name="OptionName_<?php echo ($i + 1); ?>" data-hiddenname="ExtendedSurveyForm_OptionName_hid_<?php echo $j . "_" . ($i + 1); ?>" id="ExtendedSurveyForm_Ranking_<?php echo $j . "_" . ($i + 1); ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
                                                        <div style="display:none"  id="ExtendedSurveyForm_OptionName_<?php echo $j . "_" . ($i + 1); ?>_em_" class="errorMessage ranking_errmsg"></div>
                                                    </div>
                                                </td>
            <?php for ($k = 0; $k < sizeof($question['OptionName']); $k++) { ?>
                                                    <td><div class="positionrelative displaytable">
                                                            <input type="radio" class="styled ranking_radio" id="radio_<?php echo $k . "_" . ($i + 1); ?>" name="radio_<?php echo $k . "_" . ($i + 1); ?>" disabled="true"/>
                                                        </div>
                                                    </td>
            <?php } ?>


                                            </tr>
            <?php $j++;
        } ?>
                                    </table>
                                </div>
                                <div class="othersarea padding8top" <?php if($question['Other'] == 0) echo "style='display:none;'" ?> id="othervaluediv_<?php echo ($i + 1); ?>">
                                    <input type="checkbox" class="styled" id="othervalue_<?php echo ($i + 1); ?>" name="1"  value="<?php echo $question['Other']; ?>"  <?php if($question['Other'] == 1) echo "checked='true'"; ?> > <i>N/A</i>
                                </div>

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
            // alert('<?php //echo ($i+1); ?>')

        </script>
    <?php } else if ($question['QuestionType'] == 4) { ?>
        <div class="QuestionWidget child" data-questionId="<?php echo ($i + 1); ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo ($i + 1); ?>">       
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'questionWidget_' . ($i + 1),
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
            <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo ($i + 1); ?>" value="1" />
            <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo ($i + 1); ?>" value="<?php echo $question['QuestionId']; ?>"/>

            <div class="surveyquestionsbox">
                <div class="surveyareaheader">

                    <div class="row-fluid">
                        <div class="span12 questionwidget">
                            <div class="control-group controlerror">
                                <label class="questionlabel" data-wid="<?php echo ($i + 1); ?>" style="cursor: pointer;">Question</label>


                                <input value="<?php echo $question['Question']; ?>" type="text" name="ExtendedSurveyForm[Question][<?php echo ($i + 1); ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>"/>
                                <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo ($i + 1); ?>" ></div>
                            </div>
                        </div>
                    </div>
                    <div id="spinner_<?php echo ($i + 1); ?>" style="position:relative;"></div>
                </div>

                <div class="surveyanswerarea" id="surveyanswerarea_<?php echo ($i + 1); ?>" >
                    <input type="hidden" name="ExtendedSurveyForm[MatrixType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_MatrixType_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['MatrixType']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[NoofOptions][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['NoofOptions']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[NoofRatings][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NoofRatings_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['NoofRatings']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[Other][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NA_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['Other']; ?>"/>
                    <div class="paddingtblr1030">
                        <div id="answerstabs_<?php echo ($i + 1); ?>" class="answerstabs">
                            <ul class="tabsselection" data-questionno="<?php echo ($i + 1); ?>">
                                <li  data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                                <li  data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                                <li class="active" data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                                <li data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                                <li data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                                <li  data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                            </ul>
                        </div>
                        <div class="tab_3">
                            <div class="dropdownsectionarea dropdownmedium ">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="span4">
                                            <div class="pull-left labelalignment"><label>Type of Matrix:</label></div>
                                            <div class="pull-left positionrelative">
                                                <select class="styled" id="loadwidgetType_<?php echo ($i + 1); ?>" name="loadwidgetType_<?php echo ($i + 1); ?>" disabled="true">
                                                    <option value="1" <?php if ($question['MatrixType'] == 1) echo "Selected" ?>>Ranking</option>
                                                    <option value="2" <?php if ($question['MatrixType'] == 2) echo "Selected" ?>>Rating</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span4" id="noofoptionsdiv_<?php echo ($i + 1); ?>">
                                            <div class="pull-left labelalignment"><label>No.of Options:</label></div>
                                            <div class="pull-left positionrelative">
                                                <select disabled="true" style="width:150px" class="styled span6" data-error="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>_em_"   data-hiddenname="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>" name="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>">
                                                    <option value="">Please select</option>
                                                    <?php for ($k = 2; $k < 10; $k++) { ?>
                                                        <option value="<?php echo $k; ?>" <?php if ($question['NoofOptions'] == $k) echo "Selected" ?>><?php echo $k; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="control-group controlerror">
                                                    <div style="display:none"  id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>_em_" class="errorMessage"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="span4" id="noofratingsdiv_<?php echo ($i + 1); ?>" >
                                            <div class="pull-left labelalignment"><label>No.of Ratings:</label></div>
                                            <div class="pull-left positionrelative">

                                                <select disabled="true" style="width:150px" class="styled span6" data-error="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>_em_" data-idname="ExtendedSurveyForm_NoofRatings_" data-hiddenname="ExtendedSurveyForm_NoofRatings_hid_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>" name="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>">
                                                    <option value="">Please select</option>
        <?php for ($k = 2; $k < 10; $k++) { ?>
                                                        <option value="<?php echo $k; ?>" <?php if ($question['NoofRatings'] == $k) echo "Selected" ?>><?php echo $k; ?></option>
        <?php } ?>
                                                </select>
                                                <div class="control-group controlerror">
                                                    <div style="display:none"  id="ExtendedSurveyForm_NoofRatings_<?php echo ($i + 1); ?>_em_" class="errorMessage">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="paddingtop12" >
                                <div id="rankingOrRating_<?php echo ($i + 1); ?>">
                                    <table cellpadding="0" cellspacing="0" class="customsurvaytable">
                                        <tr>
                                            <th class="col1"></th>
        <?php $j = 0;
        error_log("===Rating=survy Edit page===");
        foreach ($question['LabelName'] as $rw) {
            error_log("==Rating label==$rw"); ?>
                                            <input value="<?php echo $rw; ?>" type="hidden" name="ExtendedSurveyForm[LabelName][<?php echo ($j) . "_" . ($i + 1); ?>]" id="ExtendedSurveyForm_LabelName_hid_<?php echo ($j) . "_" . ($i + 1); ?>" class="label_hidden"/>
                                            <th id="th_labelname_<?php echo ($j) . "_" . ($i + 1); ?>">
                                            <div class="surveydeleteaction positionrelative">             
                                                <input  value="<?php echo $rw; ?>" type="text" class="textfield textfieldtable" placeHolder="Label Name" name="LabelName_<?php echo ($i + 1); ?>" data-hiddenname="ExtendedSurveyForm_LabelName_hid_<?php echo ($j) . "_" . ($i + 1); ?>" id="ExtendedSurveyForm_LabelName_<?php echo ($j) . "_" . ($i + 1); ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
                                                <div class="control-group controlerror">
                                                    <div style="display:none"  id="ExtendedSurveyForm_LabelName_<?php echo ($j) . "_" . ($i + 1); ?>_em_" class="errorMessage" style="font-weight:normal"></div>
                                                </div>
                                            </div>
                                            </th>  
                                                <?php $j++;
                                            } ?>
                                        </tr>

        <?php $j = 0;
        error_log("===Rating=survy Edit page===");
        foreach ($question['OptionName'] as $rw) {
            error_log("==Rating==$rw"); ?>   

                                            <input value="<?php echo $rw; ?>" type="hidden" name="ExtendedSurveyForm[OptionName][<?php echo $j . "_" . ($i + 1); ?>]" id="ExtendedSurveyForm_OptionName_hid_<?php echo $j . "_" . ($i + 1); ?>" class="option_hidden"/>
                                            <tr>
                                                <td>
                                                    <div class="control-group controlerror">
                                                        <input value="<?php echo $rw; ?>" type="text" placeholder="Option Name" class="textfield textfieldtable option_text" name="OptionName_<?php echo ($i + 1); ?>" data-hiddenname="ExtendedSurveyForm_OptionName_hid_<?php echo $j . "_" . ($i + 1); ?>" id="ExtendedSurveyForm_Ranking_<?php echo $j . "_" . ($i + 1); ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
                                                        <div style="display:none"  id="ExtendedSurveyForm_OptionName_<?php echo $j . "_" . ($i + 1); ?>_em_" class="errorMessage ranking_errmsg"></div>
                                                    </div>
                                                </td>

            <?php for ($k = 0; $k < sizeof($question['OptionName']); $k++) { ?>
                                                    <td><div class="positionrelative displaytable">
                                                            <input type="radio" class="styled ranking_radio" id="radio_<?php echo $k . "_" . ($i + 1); ?>" name="radio_<?php echo $k . "_" . ($i + 1); ?>" disabled="true"/>
                                                        </div>
                                                    </td>
            <?php } ?>

                                            </tr> 
            <?php $j++;
        } ?>     
                                    </table>
                                </div>
                                <div class="othersarea padding8top" <?php if($question['Other'] == 0) echo "style='display:none;'" ?> id="othervaluediv_<?php echo ($i + 1); ?>">
                                    <input type="checkbox" class="styled" id="othervalue_<?php echo ($i + 1); ?>" name="1"  value="<?php echo $question['Other']; ?>"  <?php if($question['Other'] == 1) echo "checked='true'"; ?> > <i>N/A</i>
                                </div>

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
            <?php if (empty($surveyId)) { ?>
                $("#othersarea_<?php echo ($i + 1); ?> span").live('click', function() {
                    var isChecked = 0;
                    if ($('#othercheck_<?php echo ($i + 1); ?>').is(':checked')) {
                        isChecked = 1;
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").show();
                    } else {
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").hide();
                    }
                    $("#ExtendedSurveyForm_Other_<?php echo ($i + 1); ?>").val(isChecked);

                });
        <?php } ?>
            // alert('<?php //echo ($i+1);  ?>')

        </script>
    <?php } else if ($question['QuestionType'] == 5) { ?>
        <div class="QuestionWidget child" data-questionId="<?php echo ($i + 1); ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo ($i + 1); ?>">       
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'questionWidget_' . ($i + 1),
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
            <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo ($i + 1); ?>" value="1" />
            <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo ($i + 1); ?>" value="<?php echo $question['QuestionId']; ?>"/>

            <div class="surveyquestionsbox">
                <div class="surveyareaheader">

                    <div class="row-fluid">
                        <div class="span12 questionwidget">
                            <div class="control-group controlerror">
                                <label class="questionlabel" data-wid="<?php echo ($i + 1); ?>" style="cursor: pointer;">Question</label>


                                <input value="<?php echo $question['Question']; ?>" type="text" name="ExtendedSurveyForm[Question][<?php echo ($i + 1); ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>"/>
                                <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo ($i + 1); ?>" ></div>
                            </div>
                        </div>
                    </div>
                    <div id="spinner_<?php echo ($i + 1); ?>" style="position:relative;"></div>
                </div>

                <div class="surveyanswerarea" id="surveyanswerarea_<?php echo ($i + 1); ?>" >
                    <input type="hidden" name="ExtendedSurveyForm[NoofOptions][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['NoofOptions']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[MatrixType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_MatrixType_hid_<?php echo ($i + 1); ?>"  value="<?php echo $question['MatrixType']; ?>"/>
                    <input type="hidden" name="ExtendedSurveyForm[TotalValue][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_TotalValue_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['TotalValue']; ?>"/>
                    <div class="paddingtblr1030">
                        <div id="answerstabs_<?php echo ($i + 1); ?>" class="answerstabs">
                            <ul class="tabsselection" data-questionno="<?php echo ($i + 1); ?>">
                                <li  data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                                <li  data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                                <li  data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                                <li class="active" data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                                <li  data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                                <li  data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                            </ul>
                        </div>
                        <div class="tab_5">
                            <div class="dropdownsectionarea dropdownsmall">
                                <div class="row-fluid">
                                    <div class="span3">
                                        <div class="pull-left labelalignment"><label>Total Value:</label></div>
                                        <div class="pull-left positionrelative">
                                            <input value="<?php echo $question['TotalValue']; ?>" type="text" class="span9 textfield" data-error="ExtendedSurveyForm_TotalValue_<?php echo ($i + 1); ?>_em_"  maxlength="4" size="8" data-hiddenname="ExtendedSurveyForm_TotalValue_hid_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_TotalValue_<?php echo ($i + 1); ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)">
                                            <div class="control-group controlerror">
                                                <div style="display:none"  id="ExtendedSurveyForm_TotalValue_<?php echo ($i + 1); ?>_em_" class="errorMessage"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span5">
                                        <div class="pull-left labelalignment"><label>No.of Options:</label></div>
                                        <div class="pull-left positionrelative">
                                            <select disabled="true" style="width:170px" class="styled span6" data-error="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>_em_"   data-hiddenname="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>" name="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>">
                                                <option value="">Please select</option>
        <?php for ($k = 2; $k < 10; $k++) { ?>
                                                    <option value="<?php echo $k; ?>" <?php if ($question['NoofOptions'] == $k) echo "Selected" ?>><?php echo $k; ?></option>
        <?php } ?>
                                            </select>
                                            <div class="control-group controlerror">
                                                <div style="display:none"  id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>_em_" class="errorMessage"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span4">
                                        <div class="pull-left labelalignment"><label>Unit type:</label></div>     
                                        <div class="pull-left positionrelative">
                                            <select disabled="true" style="width:120px" class="styled" id="unitypeddn_<?php echo ($i + 1); ?>" name="unittype_<?php echo ($i + 1); ?>">          
                                                <option value="1" <?php if ($question['MatrixType'] == 1) echo "Selected"; ?>>%</option>
                                                <option value="2" <?php if ($question['MatrixType'] == 2) echo "Selected"; ?>>$</option>               
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="answersection1" id="percentageWidget_<?php echo ($i + 1); ?>" data-questionId="<?php echo ($i + 1); ?>">
        <?php $j = 0;
        foreach ($question['OptionName'] as $rw) {
            error_log("==percentage dis==$rw"); ?>
                                    <input value="<?php echo $rw; ?>" type="hidden" name="ExtendedSurveyForm[OptionName][<?php echo $j . "_" . ($i + 1); ?>]" id="ExtendedSurveyForm_OptionName_hid_<?php echo $j . "_" . ($i + 1); ?>" class="percentagehidden"/>
                                    <div class="normaloutersection normalouter_<?php echo ($i + 1); ?>">
                                        <div class="normalsection normalsection4">
                                            <label>Option Name</label>
                                            <div class="row-fluid">
                                                <div class="span10">
                                                    <div class="span6">
                                                        <div class="control-group controlerror">
                                                            <input value="<?php echo $rw; ?>" type="text"  class="textfield span10 percentageOptionname" name="OptionName_<?php echo ($i + 1); ?>" data-hiddenname="ExtendedSurveyForm_OptionName_hid_<?php echo $j . "_" . ($i + 1); ?>" id="ExtendedSurveyForm_percentage_<?php echo $j . "_" . ($i + 1); ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="500">
                                                            <div style="display:none"  id="ExtendedSurveyForm_OptionName_<?php echo $j . "_" . ($i + 1); ?>_em_" class="errorMessage percentageOptionerr"></div>
                                                        </div>     
                                                    </div>
                                                    <div class="span2 positionrelative labelpercent">
                                                        <input  type="text" class="textfield span10" disabled="true"/> <label class="percentlbl perUnitType_<?php echo ($i + 1); ?>" > <?php if ($question['MatrixType'] == 1) {
                echo "%";
            } else {
                echo "$";
            } ?></label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        <?php $j++;} ?>
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
        <?php if (empty($surveyId)) { ?>
                $("#othersarea_<?php echo ($i + 1); ?> span").live('click', function() {
                    var isChecked = 0;
                    if ($('#othercheck_<?php echo ($i + 1); ?>').is(':checked')) {
                        isChecked = 1;
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").show();
                    } else {
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").hide();
                    }
                    $("#ExtendedSurveyForm_Other_<?php echo ($i + 1); ?>").val(isChecked);

                });
                $("#ExtendedSurveyForm_TotalValue_<?php echo ($i + 1); ?>").keydown(function(e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                            // Allow: Ctrl+A
                                    (e.keyCode == 65 && e.ctrlKey === true) ||
                                    // Allow: home, end, left, right
                                            (e.keyCode >= 35 && e.keyCode <= 39)) {
                                // let it happen, don't do anything
                                return;
                            }
                            // Ensure that it is a number and stop the keypress
                            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                e.preventDefault();
                            }
                        });
        <?php } ?>
            // alert('<?php //echo ($i+1);  ?>')

        </script>
    <?php } else if ($question['QuestionType'] == 6) { ?>
        <div class="QuestionWidget child" data-questionId="<?php echo ($i + 1); ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo ($i + 1); ?>">       
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'questionWidget_' . ($i + 1),
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
            <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo ($i + 1); ?>" value="1" />
            <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo ($i + 1); ?>" value="<?php echo $question['QuestionId']; ?>"/>

            <div class="surveyquestionsbox">
                <div class="surveyareaheader">

                    <div class="row-fluid">
                        <div class="span12 questionwidget">
                            <div class="control-group controlerror">
                                <label class="questionlabel" data-wid="<?php echo ($i + 1); ?>" style="cursor: pointer;">Question</label>


                                <input value="<?php echo $question['Question']; ?>" type="text" name="ExtendedSurveyForm[Question][<?php echo ($i + 1); ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>"/>
                                <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo ($i + 1); ?>" ></div>
                            </div>
                        </div>
                    </div>
                    <div id="spinner_<?php echo ($i + 1); ?>" style="position:relative;"></div>
                </div>

                <div class="surveyanswerarea" id="surveyanswerarea_<?php echo ($i + 1); ?>" >
                    <input value="<?php echo $question['NoofChars']; ?>" type="hidden" name="ExtendedSurveyForm[NoofChars][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NoofChars_hid_<?php echo ($i + 1); ?>"/>
                    <div class="paddingtblr1030">
                        <div id="answerstabs_<?php echo ($i + 1); ?>" class="answerstabs">
                            <ul class="tabsselection" data-questionno="<?php echo ($i + 1); ?>">
                                <li  data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                                <li  data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                                <li  data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                                <li data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                                <li class="active" data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                                <li  data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                            </ul>
                        </div>
                        <div class="tab_5">
                            <div class="dropdownsectionarea dropdownsmall">
                                <div class="pull-left labelalignment"><label>No.of Characters:</label></div>
                                <div class="pull-left positionrelative">
                                    <select disabled="true" class="styled span6" id="noofchars_<?php echo ($i + 1); ?>" name="noofchars_<?php echo ($i + 1); ?>">
                                        <option value="">Please select</option>
                                        <option value="100" <?php if ($question['NoofChars'] == "100") echo "Selected"; ?>>100</option>
                                        <option value="500" <?php if ($question['NoofChars'] == "500") echo "Selected"; ?>>500</option>
                                        <option value="1000" <?php if ($question['NoofChars'] == "1000") echo "Selected"; ?>>1000</option>
                                    </select>
                                    <div class="control-group controlerror">
                                        <div style="display:none"  id="ExtendedSurveyForm_NoofChars_<?php echo ($i + 1); ?>_em_" class="errorMessage"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="answersection1">
                                <div class="normaloutersection">
                                    <div class="normalsection normalsection5">

                                        <div class="row-fluid" id="rowfluidChars_<?php echo ($i + 1); ?>">
                                            <div class="span12">   
                                                <input value="" type="text" class="textfield span12" id="qAaTextField_<?php echo ($i + 1); ?>" disabled="true" <?php if ($question['NoofChars'] > "100") echo "style='display:none;'"; ?>/>
                                                <textarea class="span12" id="qAaTextarea_<?php echo ($i + 1); ?>" disabled="true" <?php if ($question['NoofChars'] <= "100") echo "style='display:none;'"; ?>></textarea>     
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
        <?php if (empty($surveyId)) { ?>
                $("#othersarea_<?php echo ($i + 1); ?> span").live('click', function() {
                    var isChecked = 0;
                    if ($('#othercheck_<?php echo ($i + 1); ?>').is(':checked')) {
                        isChecked = 1;
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").show();
                    } else {
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").hide();
                    }
                    $("#ExtendedSurveyForm_Other_<?php echo ($i + 1); ?>").val(isChecked);

                });
                $("#ExtendedSurveyForm_TotalValue_<?php echo ($i + 1); ?>").keydown(function(e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                            // Allow: Ctrl+A
                                    (e.keyCode == 65 && e.ctrlKey === true) ||
                                    // Allow: home, end, left, right
                                            (e.keyCode >= 35 && e.keyCode <= 39)) {
                                // let it happen, don't do anything
                                return;
                            }
                            // Ensure that it is a number and stop the keypress
                            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                e.preventDefault();
                            }
                        });
        <?php } ?>
            // alert('<?php //echo ($i+1);  ?>')

        </script>
    <?php } else if ($question['QuestionType'] == 7) { ?>
        <div class="QuestionWidget child" data-questionId="<?php echo ($i + 1); ?>" style="padding:15px 20px 15px 10px" id="QuestionWidget_<?php echo ($i + 1); ?>">       
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'questionWidget_' . ($i + 1),
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
            <input type="hidden" name="ExtendedSurveyForm[WidgetType][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_WidgetType_<?php echo ($i + 1); ?>" value="1" />
            <input type="hidden" name="ExtendedSurveyForm[QuestionId][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_QuestionId_<?php echo ($i + 1); ?>" value="<?php echo $question['QuestionId']; ?>"/>

            <div class="surveyquestionsbox">
                <div class="surveyareaheader">

                    <div class="row-fluid">
                        <div class="span12 questionwidget">
                            <div class="control-group controlerror">
                                <label class="questionlabel" data-wid="<?php echo ($i + 1); ?>" style="cursor: pointer;">Question</label>


                                <input value="<?php echo $question['Question']; ?>" type="text" name="ExtendedSurveyForm[Question][<?php echo ($i + 1); ?>]" class="span12 textfield" maxlength="5000" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>"/>
                                <div style="display:none" id="ExtendedSurveyForm_Question_<?php echo ($i + 1); ?>_em_" class="errorMessage questionserror" data-questionno="<?php echo ($i + 1); ?>" ></div>
                            </div>
                        </div>
                    </div>
                    <div id="spinner_<?php echo ($i + 1); ?>" style="position:relative;"></div>
                </div>

                <div class="surveyanswerarea" id="surveyanswerarea_<?php echo ($i + 1); ?>" >
                    <input type="hidden" name="ExtendedSurveyForm[NoofOptions][<?php echo ($i + 1); ?>]" id="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" value="<?php echo $question['NoofOptions']; ?>"/>
                    <div class="paddingtblr1030">
                        <div id="answerstabs_<?php echo ($i + 1); ?>" class="answerstabs">
                            <ul class="tabsselection" data-questionno="<?php echo ($i + 1); ?>">
                                <li  data-option="radio"><a class="surveyradio"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Radio widget"/></a></li>
                                <li  data-option="checkbox"><a  class="surveycheckbox"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Checkbox widget"/></a></li>
                                <li data-option="rating"><a class="surveyratingranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Rating/Ranking widget"/></a></li>
                                <li data-option="percent"><a  class="surveypercent"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Percentage Distribution widget"/></a></li>
                                <li data-option="QandA"><a class="surveyQandA"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="Question and Answer widget"/></a></li>
                                <li class="active" data-option="userRanking"><a  class="surveyuserranking"><img src="/images/system/spacer.png" data-placement="bottom" rel="tooltip"  data-original-title="User generated ranking widget"/></a></li>
                            </ul>
                        </div>
                        <div class="tab_6">        
                            <div class="dropdownsectionarea dropdownsmall">
                                <div class="row-fluid">
                                    <div class="span4">
                                        <div class="pull-left labelalignment"><label>No.of Options:</label></div>

                                        <div class="pull-left positionrelative">
                                            <select disabled="true" style="width:180px;" class="styled span6" data-error="ExtendedSurveyForm_NoofOption_<?php echo ($i + 1); ?>_em_"   data-hiddenname="ExtendedSurveyForm_NoofOptions_hid_<?php echo ($i + 1); ?>" id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>" name="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>">
                                                <option value="">Please select</option>
        <?php for ($k = 2; $k < 10; $k++) { ?>
                                                    <option value="<?php echo $k; ?>" <?php if ($question['NoofOptions'] == $k) echo "Selected" ?>><?php echo $k; ?></option>
        <?php } ?>
                                            </select>
                                            <div class="control-group controlerror">
                                                <div style="display:none"  id="ExtendedSurveyForm_NoofOptions_<?php echo ($i + 1); ?>_em_" class="errorMessage"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="answersection1" id="userGeneratedRankingwidget_<?php echo ($i + 1); ?>" data-questionId="<?php echo ($i + 1); ?>" data-optionType="usergeneratedRanking">
        <?php error_log("sizeof ====" . ($question['NoofOptions']));
        for ($k = 0; $k < ($question['NoofOptions']); $k++) {
            error_log("======k==value===$k"); ?>
                                    <div class="normaloutersection normalouter_<?php echo ($i + 1); ?>">
                                        <div class="normalsection normalsection6">
                                            <div class="row-fluid">
                                                <div class="span12">   
                                                    <div class="control-group controlerror">
                                                        <input type="text" placeholder="Option Name" class="textfield span5 userGeneratedOptions" name="OptionName_<?php echo ($i + 1); ?>" data-hiddenname="ExtendedSurveyForm_OptionName_hid_<?php echo $k . "_" . ($i + 1); ?>" id="ExtendedSurveyForm_userGRanking_<?php echo $k . "_" . ($i + 1); ?>" disabled="true" maxlength="500">
                                                        <div style="display:none"  id="ExtendedSurveyForm_OptionName_<?php echo $k . "_" . ($i + 1); ?>_em_" class="errorMessage usergeneratederrorMsg"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        <?php } ?>

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
        <?php if (empty($surveyId)) { ?>
                $("#othersarea_<?php echo ($i + 1); ?> span").live('click', function() {
                    var isChecked = 0;
                    if ($('#othercheck_<?php echo ($i + 1); ?>').is(':checked')) {
                        isChecked = 1;
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").show();
                    } else {
                        $("#otherTextdiv_<?php echo ($i + 1); ?>").hide();
                    }
                    $("#ExtendedSurveyForm_Other_<?php echo ($i + 1); ?>").val(isChecked);

                });
                $("#ExtendedSurveyForm_TotalValue_<?php echo ($i + 1); ?>").keydown(function(e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                            // Allow: Ctrl+A
                                    (e.keyCode == 65 && e.ctrlKey === true) ||
                                    // Allow: home, end, left, right
                                            (e.keyCode >= 35 && e.keyCode <= 39)) {
                                // let it happen, don't do anything
                                return;
                            }
                            // Ensure that it is a number and stop the keypress
                            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                e.preventDefault();
                            }
                        });
        <?php } ?>
            // alert('<?php //echo ($i+1);  ?>')

        </script>
    <?php
    }
    $i++;
}

 }else{echo 0;}
?>
