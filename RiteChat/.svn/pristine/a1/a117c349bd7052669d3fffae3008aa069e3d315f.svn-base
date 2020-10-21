<input type="hidden" name="ExtendedSurveyForm[NoofChars][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_NoofChars_hid_<?php echo $widgetCount; ?>"/>
<div class="paddingtblr1030">
    <div id="answerstabs_<?php echo $widgetCount; ?>" class="answerstabs">
       <ul class="tabsselection" data-questionno="<?php echo $widgetCount; ?>">
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
                <select class="styled span6" id="noofchars_<?php echo $widgetCount; ?>" name="noofchars_<?php echo $widgetCount; ?>">
                    <option value="">Please select</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                </select>
                <div class="control-group controlerror">
                    <div style="display:none"  id="ExtendedSurveyForm_NoofChars_<?php echo $widgetCount; ?>_em_" class="errorMessage"></div>
                </div>
            </div>
        </div>
        <div class="answersection1">
            <div class="normaloutersection">
                <div class="normalsection normalsection5">

                    <div class="row-fluid" style="display:none" id="rowfluidChars_<?php echo $widgetCount; ?>">
                        <div class="span12">   
                            <input value="" type="text" class="textfield span12" id="qAaTextField_<?php echo $widgetCount; ?>" disabled="true"/>
                            <textarea class="span12" id="qAaTextarea_<?php echo $widgetCount; ?>" disabled="true"></textarea>     
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        Custom.init();
        $("[rel=tooltip]").tooltip(); 
    });
    $(".styled").css("width","200px");
    $("#noofchars_<?php echo $widgetCount; ?>").change(function() {
        var $this = $(this);
        if ($this.val() == 100){            
            $("#qAaTextarea_<?php echo $widgetCount; ?>").hide();
            $("#qAaTextField_<?php echo $widgetCount; ?>").show();
        }else if($this.val() > 100){            
            $("#qAaTextarea_<?php echo $widgetCount; ?>").show();
            $("#qAaTextField_<?php echo $widgetCount; ?>").hide();
        }
        if($this.val() >= 1){
            $("#rowfluidChars_<?php echo $widgetCount; ?>").show();
            $("#ExtendedSurveyForm_NoofChars_hid_<?php echo $widgetCount; ?>").val($this.val());
        }
        if($this.val() == ""){
            $("#surveyFormButtonId").hide();
        }else{
            $("#surveyFormButtonId").show();
        }
    });
</script>