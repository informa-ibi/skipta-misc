<input type="hidden" name="ExtendedSurveyForm[MatrixType][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_MatrixType_hid_<?php echo $widgetCount; ?>"/>
<input type="hidden" name="ExtendedSurveyForm[NoofOptions][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_NoofOptions_hid_<?php echo $widgetCount; ?>" />
<input type="hidden" name="ExtendedSurveyForm[NoofRatings][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_NoofRatings_hid_<?php echo $widgetCount; ?>" />
<input type="hidden" name="ExtendedSurveyForm[Other][<?php echo $widgetCount; ?>]" id="ExtendedSurveyForm_NA_hid_<?php echo $widgetCount; ?>" class=""/>
<div class="paddingtblr1030">
    <div id="answerstabs_<?php echo $widgetCount; ?>" class="answerstabs">
        <ul class="tabsselection" data-questionno="<?php echo $widgetCount; ?>">
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
                            <select class="styled" id="loadwidgetType_<?php echo $widgetCount; ?>" name="loadwidgetType_<?php echo $widgetCount; ?>">
                                <option value="1">Ranking</option>
                                <option value="2">Rating</option>
                            </select>
                        </div>
                    </div>
                    <div class="span4" id="noofoptionsdiv_<?php echo $widgetCount; ?>">
                        <div class="pull-left labelalignment"><label>No.of Options:</label></div>
                        <div class="pull-left positionrelative">
                            <select style="" class="styled span6" data-error="ExtendedSurveyForm_NoofOptions_<?php echo $widgetCount; ?>_em_"   data-hiddenname="ExtendedSurveyForm_NoofOptions_hid_<?php echo $widgetCount; ?>" id="ExtendedSurveyForm_NoofOptions_<?php echo $widgetCount; ?>" name="ExtendedSurveyForm_NoofOptions_<?php echo $widgetCount; ?>">
                                <option value="">Please select</option>
                                <?php for($i=2;$i<10;$i++){ ?>
                                     <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                     <?php } ?>
                            </select>
                            <div class="control-group controlerror">
                                <div style="display:none"  id="ExtendedSurveyForm_NoofOptions_<?php echo $widgetCount; ?>_em_" class="errorMessage"></div>
                            </div>
                        </div>
                    </div>

                    <div class="span4" id="noofratingsdiv_<?php echo $widgetCount; ?>" style="display:none;">
                        <div class="pull-left labelalignment"><label>No.of Ratings:</label></div>
                        <div class="pull-left positionrelative">
                            
                            <select class="styled span6" data-error="ExtendedSurveyForm_NoofRatings_<?php echo $widgetCount; ?>_em_" data-idname="ExtendedSurveyForm_NoofRatings_" data-hiddenname="ExtendedSurveyForm_NoofRatings_hid_<?php echo $widgetCount; ?>" id="ExtendedSurveyForm_NoofRatings_<?php echo $widgetCount; ?>" name="ExtendedSurveyForm_NoofRatings_<?php echo $widgetCount; ?>">
                                <option value="">Please select</option>
                                <?php for($i=2;$i<10;$i++){ ?>
                                     <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                     <?php } ?>
                            </select>
                            <div class="control-group controlerror">
                                <div style="display:none"  id="ExtendedSurveyForm_NoofRatings_<?php echo $widgetCount; ?>_em_" class="errorMessage"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="paddingtop12" >
            <div id="rankingOrRating_<?php echo $widgetCount; ?>">

            </div>
            <div class="othersarea padding8top" style="display: none;" id="othervaluediv_<?php echo $widgetCount; ?>">
                <input type="checkbox" class="styled" id="othervalue_<?php echo $widgetCount; ?>" name="1"  > <i>N/A</i>
            </div>

        </div>
    </div>
</div>  

<script type="text/javascript">
//    $("#surveyFormButtonId").hide();


    $("#loadwidgetType_<?php echo $widgetCount; ?>").change(function() {
        var widgetType = $(this).val();
        $("#ExtendedSurveyForm_MatrixType_hid_<?php echo $widgetCount; ?>").val(widgetType);
        if (widgetType == 2) {
            $("#noofratingsdiv_<?php echo $widgetCount; ?>").show();
        } else {
            $("#noofratingsdiv_<?php echo $widgetCount; ?>").hide();
        }
        $("#rankingOrRating_<?php echo $widgetCount; ?>").empty();
        $("#othervaluediv_<?php echo $widgetCount; ?>").hide();
        $("#ExtendedSurveyForm_NoofOption_<?php echo $widgetCount; ?>,#ExtendedSurveyForm_NoofRatings_<?php echo $widgetCount; ?>").val("");
    });
    $("#ExtendedSurveyForm_NoofOptions_<?php echo $widgetCount; ?>").change(function(event) {
        var $this = $(this);
        var value = $this.val();
        $("#ExtendedSurveyForm_NoofOptions_hid_<?php echo $widgetCount; ?>").val(value);        
        var renderV = 0;
        var renTemp = 0;
        $(".option_text").each(function(){
            renderV++;
        });
        if(value > renderV){
//            value = value - renderV;
            var URL = "/extendedSurvey/renderRankingWidget";
            var queryString = "questionNo=<?php echo $widgetCount; ?>&optionsCount=" + $this.val()+"&radioOptions="+$this.val();
            var widgetType = $("#loadwidgetType_<?php echo $widgetCount; ?>").val();
             if(widgetType == 2){
                 URL = "/extendedSurvey/renderRatingWidget";
                 var optionValue = $("#ExtendedSurveyForm_NoofOptions_hid_<?php echo $widgetCount; ?>").val();
                 var ratingsValue = $("#ExtendedSurveyForm_NoofRatings_hid_<?php echo $widgetCount; ?>").val();
                 if(ratingsValue != "" && ratingsValue != 0){
                    queryString = "questionNo=<?php echo $widgetCount; ?>&optionsCount=" + optionValue + "&ratingsCount=" + ratingsValue;
                    ajaxRequest(URL, queryString, function(data) {
                        renderHandler(data, '<?php echo $widgetCount; ?>')
                    }, "html"); 
                 }
            }else{
            
                ajaxRequest(URL, queryString, function(data) {
                   renderHandler(data, '<?php echo $widgetCount; ?>')
               }, "html"); 
            }
            
            $("#ExtendedSurveyForm_MatrixType_hid_<?php echo $widgetCount; ?>").val(widgetType);            
                         
        }else if(value < renderV){
            var URL = "/extendedSurvey/renderRankingWidget";
                var queryString = "questionNo=<?php echo $widgetCount; ?>&optionsCount=" + $this.val()+"&radioOptions="+$this.val();
                ajaxRequest(URL, queryString, function(data) {
                   renderHandler(data, '<?php echo $widgetCount; ?>')
               }, "html"); 
        }
        if (value <= 0 || value > 10) {
            $("#rankingOrRating_<?php echo $widgetCount; ?>").empty();
            $("#othervaluediv_<?php echo $widgetCount; ?>").hide();            
        }
    });

    $("#ExtendedSurveyForm_NoofRatings_<?php echo $widgetCount; ?>").change(function(event) { 
        var $this = $(this);
        var ratingsValue = $this.val();
        $("#ExtendedSurveyForm_NoofRatings_hid_<?php echo $widgetCount; ?>").val(ratingsValue);
        var URL = "/extendedSurvey/renderRatingWidget";
        var widgetType = $("#loadwidgetType_<?php echo $widgetCount; ?>").val();
        var optionValue = $("#ExtendedSurveyForm_NoofOptions_<?php echo $widgetCount; ?>").val();
        $("#ExtendedSurveyForm_MatrixType_hid_<?php echo $widgetCount; ?>").val(widgetType);
        if ((ratingsValue > 1 && ratingsValue < 10) && (optionValue > 1 && optionValue < 10)) {
            ajaxRequest(URL, "questionNo=<?php echo $widgetCount; ?>&optionsCount=" + optionValue + "&ratingsCount=" + ratingsValue, function(data) {
                renderHandler(data, '<?php echo $widgetCount; ?>')
            }, "html");
        }
        if ((optionValue <= 0 || optionValue > 10) || (ratingsValue <= 0 || ratingsValue > 10)) {
            $("#rankingOrRating_<?php echo $widgetCount; ?>").empty();
            $("#othervaluediv_<?php echo $widgetCount; ?>").hide();
        }

    });
    
    $('#othervaluediv_<?php echo $widgetCount; ?> span.checkbox').live("click",
            function() {
                var isChecked = 0;
                if ($('#othervalue_<?php echo $widgetCount; ?>').is(':checked')) {
                    isChecked = 1;
                }
                $("#ExtendedSurveyForm_NA_hid_<?php echo $widgetCount; ?>").val(isChecked);
            }

    );

    function renderHandler(html, questionno) {
        $("#rankingOrRating_" + questionno).html(html);
        $("#othervaluediv_" + questionno).show();
    }
    $(document).ready(function() {
        Custom.init();
        $("[rel=tooltip]").tooltip();

    });    
</script>