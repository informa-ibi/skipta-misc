<div class="alert alert-success" id="sucmsg" style='text-align:center;display:none;'></div>
<div class="padding10ltb">
    <h2 class="pagetitle" id="pagetitle_s">Create Market Research</h2>     
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'questionWidget',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'style' => 'margin: 0px; accept-charset=UTF-8',
        ),
    ));
    ?>
    <?php echo $form->hiddenField($ExtendedSurveyForm, 'SurveyId'); ?>
    <?php echo $form->hiddenField($ExtendedSurveyForm, 'Questions'); ?>
    <?php echo $form->hiddenField($ExtendedSurveyForm, 'SurveyLogo'); ?>
    <?php echo $form->hiddenField($ExtendedSurveyForm, 'SurveyRelatedGroupName', array("value"=>"Public")); ?>
    <?php echo $form->hiddenField($ExtendedSurveyForm, 'Status'); ?>
    
    

    <div class="market_profile marginT10" id="survey_profilediv">
        <div class="m_profileicon">
            <div><i class="fa fa-question helpicon helpmanagement top10  tooltiplink" style="z-index:999;  " data-placement="bottom" rel="tooltip" data-original-title="Please click on the rounded icon and upload a logo."></i> </div>
            <div class="marginzero smallprofileicon largeprofileicon ">
                
                <div class="positionrelative editicondiv editicondivProfileImage no_border edit_iconbg editicondivProfileImagelarge">
                    <div id='SurveyImage'></div>
<!--                                <img id="profileImagePreviewId" src="" alt="" />-->
                    <img alt="" src="<?php echo Yii::app()->params['ServerURL']; ?>/images/system/survey_img.png" id="surveyPreviewId">
                </div>
                
                <div><ul id="survey_logo" class="qq-upload-list"></ul></div>
            </div>
            <div class="control-group controlerror"  >

                <div id="SurveyImage_error" class="errorMessage marginbottom10 error"  style="display:none"></div>
                <?php echo $form->error($ExtendedSurveyForm, 'SurveyLogo'); ?>
            </div>
            
        </div>
        

        <div class="row-fluid padding-bottom15">
            <div class="span12">
                <?php echo $form->textField($ExtendedSurveyForm, 'SurveyTitle', array('maxlength' => '100', 'class' => 'span8', "placeholder" => "Title","onkeypress"=>"IsAlphaNumeric(event)")); ?>    
                <div class="control-group controlerror"> 
                    <?php echo $form->error($ExtendedSurveyForm, 'SurveyTitle'); ?>
                </div>


            </div>
        </div>
        <div class="row-fluid padding-bottom15">
            <div class="span8 positionrelative">
                <select name="surveyGroupName" id="surveyGroupName" class="span12 styled" >
                    <option value="Public">Please choose Survey related Group</option>
                    <?php if(isset($surveyGroupNames) && sizeof($surveyGroupNames) > 0){
                        foreach($surveyGroupNames as $rw){?>
                    <option value="<?php echo $rw->GroupName; ?>" data-url="<?php echo $rw->LogoPath; ?>"><?php echo $rw->GroupName; ?></option>                                      
                        <?php } }?>
                    <option value="other">Other</option>
                </select>
                <div class="control-group controlerror">
                      <?php echo $form->error($ExtendedSurveyForm, 'SurveyRelatedGroupName'); ?>
                 </div>
            </div>
        </div>
        
        <div class="row-fluid padding-bottom15">
            <div class="span8 positionrelative" id="othervalue" style="display:none;">
                <?php echo $form->textField($ExtendedSurveyForm, 'SurveyOtherValue', array('maxlength' => 50, 'class' => 'span12',"placeholder"=>"Other value")); ?> 
                <div class="control-group controlerror">
                      <?php echo $form->error($ExtendedSurveyForm, 'SurveyOtherValue'); ?>
                 </div>
                          
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $form->textArea($ExtendedSurveyForm, 'SurveyDescription', array('maxlength' => '3000', 'class' => 'survey_profiletitleedit span10', "contenteditable" => "true", "placeholder" => "Description","onkeypress"=>"IsAlphaNumeric(event)")); ?>    

                <div class="control-group controlerror"> 
                    <?php echo $form->error($ExtendedSurveyForm, 'SurveyDescription'); ?>
                </div>
            </div>
        </div>


    </div>
    
    <div class="row-fluid groupseperator border-bottom">
        
        <div class="span10 "><h2 class="pagetitle">Create Market Research Questions </h2></div>
        <div class="span2 ">            
            <div class="headeraddbuttonarea alignright" id="newQuestion"  >
                <img src="/images/system/spacer.png" class="surveyaddbutton" data-placement="bottom" rel="tooltip"  data-original-title="Add one more question"/>
            </div></div>
        <div id="extededsurvey_spinner" style="position: relative"></div>
        
    </div>
    <div id="surveySpinLoader" style="position:relative;"></div>
    <div id="extendedSurveyWidgets" class="mainclass">
        
    </div>
    <div class="row-fluid" id="surveyfooterids">
        <div class="span12 alignright padding10 bggrey">
            <?php echo CHtml::Button('Done', array('onclick' => 'saveSurveyForm();', 'class' => 'btn', 'id' => 'surveyFormButtonId')); ?> 

            <?php echo CHtml::resetButton('Cancel', array("id" => 'surveyResetId', 'onclick' => 'CancelSurveyForm();', 'class' => 'btn btn_gray')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<?php if(empty($surveyId)){ ?>
<script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>
<?php } ?>
<script type="text/javascript">
   
    var isValidate = 0;
    var isValidated = false;    
    var questionsCount = 1; 
    var timeOut = 200;
    <?php if(!empty($surveyId)){  ?>
        questionsCount = '<?php echo $surveyObj->QuestionsCount;?>';
        $("#newQuestion").hide();  
        $("#ExtendedSurveyForm_SurveyRelatedGroupName").val('<?php echo $surveyObj->SurveyRelatedGroupName; ?>');
        
       $("#surveyPreviewId").attr("src",$("#ExtendedSurveyForm_SurveyLogo").val());
       ajaxRequest("/extendedSurvey/renderEditForm", "surveyId=<?php echo $surveyId; ?>", function(data)
       { var str = '<div class="row-fluid">'+
            '<div class="span12" style="text-align:center;font-family:\'exo_2.0medium\'">'+
                '<h3>Sorry, No data found.</h3>'+
            '</div>'+
        '</div>';
       if(data != 0) $("#extendedSurveyWidgets").html(data); else { $("#extendedSurveyWidgets").html(str);$("#surveyfooterids,#survey_profilediv,#pagetitle_s").hide()}
    }, "html");
    <?php }else{?>
        questionsCount = 1;
    <?php } ?>
    var radioOptionsCount = 4;
    var checkboxOptionsCount = 4;
    var TotalQuestions = '<?php echo Yii::app()->params['TotalSurveyQuestions']; ?>';
    TotalQuestions = Number(TotalQuestions);
    var extensions = '"jpg","jpeg", "gif", "png", "tiff"';
    initializeFileUploader('SurveyImage', '/extendedSurvey/uploadImage', '10*1024*1024', extensions, 1, 'SurveyImage', '', SurveyPreviewImage, displayErrorForBannerAndQuestion, "survey_logo");
    var preq = 0;
    var nextq = 0;
    var i = 0;
    $("[rel=tooltip]").tooltip();    
    <?php if(empty($surveyId)){ ?> 
    ajaxRequest("/extendedSurvey/renderQuestionWidget", "questionNo=" + questionsCount, function(data) {
        renderQuestionwidgetHandler(data,"new","","","")
    }, "html");
    <?php } ?>
    function renderQuestionwidgetHandler(html,type, qType,qNo,opCnt,noofchars) {       
        scrollPleaseWaitClose("extededsurvey_spinner")
        if (type == "add") {
            $("#extendedSurveyWidgets").append(html);
        } else {
            $("#extendedSurveyWidgets").html(html);
        }

    }
    <?php if(empty($surveyId)){?>
    $(".surveyradio,.surveycheckbox,.surveyratingranking,.surveypercent,.surveyQandA,.surveyuserranking").live('click', function() {
        var $this = $(this);
       
        var questionNo = $this.closest("ul.tabsselection").data("questionno");
        scrollPleaseWait("spinner_"+questionNo);
        if ($.trim($this.attr("class")) == "surveyradio") {            
            var data = "";
            ajaxRequest("/extendedSurvey/renderRadioWidget", "questionNo=" + questionNo, function(data) {
                renderwidgetHandler(data, questionNo)
            }, "html");
//            customeAjaxRequestForSurvey("/extendedSurvey/renderRadioWidget",data,"","");
        } else if ($.trim($this.attr("class")) == "surveycheckbox") {             
            var data = "";            
            ajaxRequest("/extendedSurvey/renderCheckboxWidget", "questionNo=" + questionNo, function(data) {
                renderwidgetHandler(data, questionNo)
            }, "html");
        } else if ($.trim($this.attr("class")) == "surveyratingranking") {             
            var data = "";
            ajaxRequest("/extendedSurvey/renderRRWidget", "questionNo=" + questionNo, function(data) {
                renderwidgetHandler(data, questionNo)
            }, "html");
        } else if ($.trim($this.attr("class")) == "surveypercent") {             
            var data = "";
            ajaxRequest("/extendedSurvey/renderPercentageDist", "questionNo=" + questionNo, function(data) {
                renderwidgetHandler(data, questionNo)
            }, "html");
        } else if ($.trim($this.attr("class")) == "surveyQandA") {             
            var data = "";
            ajaxRequest("/extendedSurvey/renderQuestionAndAnswerWidget", "questionNo=" + questionNo, function(data) {
                renderwidgetHandler(data, questionNo)
            }, "html");
        } else if ($.trim($this.attr("class")) == "surveyuserranking") {            
            var data = "";
            ajaxRequest("/extendedSurvey/userGeneratedRankingWidget", "questionNo=" + questionNo, function(data) {
                renderwidgetHandler(data, questionNo)
            }, "html");
        }

    });
        
              $("#newQuestion").click(function() {
                questionsCount++;        
                if (questionsCount >= TotalQuestions) {
                    $("#newQuestion").hide();
                }
                scrollPleaseWait("extededsurvey_spinner");
                ajaxRequest("/extendedSurvey/renderQuestionWidget", "questionNo=" + questionsCount, function(data) {
                    renderQuestionwidgetHandler(data, "add")
                }, "html");
            });
            
   <?php }?>
    
    <?php if(empty($surveyId)){  ?> 
    $(".subsectionremove").live('click', function() {
        questionsCount--;
        if (questionsCount >= 1) {
            $(this).parents('div.QuestionWidget').remove();
            if (questionsCount < TotalQuestions) {
                $("#newQuestion").show();
            }
        } else {
            questionsCount = 1;
        }
        updateDivs();
    });
    <?php } ?>
    $(".questionlabel").live('click', function() {
        var $this = $(this);
        $this.parentsUntil('div.surveyareaheader').parent().parent().next().slideToggle();

    });
    <?php if(empty($surveyId)){ ?>
    $(".surveyremoveicon").live('click', function() {
        var $this = $(this);
        var questionno = $this.closest("div.answersection1").attr("data-questionId");
        var optionType = $this.closest("div.answersection1").attr("data-optionType");
        var totalOptions = 0;
        $("input[name='" + optionType + "_" + questionno + "']").each(function(key, value) {
            totalOptions++
        });

        if (optionType == "radio") {
            if (totalOptions > 1) {
//                $(this).closest('tr').find('.cost_of_items')
                $(this).closest("div.normaloutersection").prev('input').remove();
                totalOptions--;
                $this.closest("div.normaloutersection").remove();
                if (totalOptions < 6) {
                    $("#surveyaddoption_" + questionno).show();
                }
            }
        } else if (optionType == "checkbox") {
            if (totalOptions > 1) {
                $(this).closest("div.normaloutersection").prev('input').remove();
                totalOptions--;
                $this.closest("div.normaloutersection").remove();
                if (totalOptions < 6) {
                    $("#surveyaddoption_" + questionno).show();
                }
            }
        }

        preq = 0;
        nextq = 0;
        i = 0;
        updateDivs();


    });
    <?php } ?>
    $(".surveyaddoption").live('click', function() {
        var $this = $(this);
        var questionno = $this.data("questionno");
        var optionType = $this.attr("data-optionType");
        var totalOptions = 0;
        $("input[name='" + optionType + "_" + questionno + "']").each(function(key, value) {
            totalOptions++;
        });
        var URL = "/extendedSurvey/addRadioOptionWidget";
        if (optionType == "checkbox") {
            URL = "/extendedSurvey/addCheckboxOptionWidget";
        }
        totalOptions++;
        if (totalOptions > 5) {
            $(this).hide();
        }
        ajaxRequest(URL, "questionNo=" + questionno, function(data) {
            renderOptionwidgetHandler(data, questionno, optionType)
        }, "html");

    });
    function renderwidgetHandler(html, qNo,qType) {         
        scrollPleaseWaitClose("spinner_"+qNo);      
        $("#surveyanswerarea_" + qNo).html(html);                
    }
    function renderOptionwidgetHandler(html, qNo, opType) {
        $(html).insertBefore("#othersarea_" + qNo);
        var top = 0;
        $("input[name='" + opType + "_" + qNo + "']").each(function(key, value) {
            top++;
        });
        if (opType == "radio") {
            $("#radio_hidden_" + qNo).attr("name", "ExtendedSurveyForm[RadioOption][" + top + "_" + qNo + "]");
            $("#radio_hidden_" + qNo).attr("id", "ExtendedSurveyForm_RadioOption_" + top + "_" + qNo)
            $("#radioid_" + qNo).attr("id", "ExtendedSurveyForm_RadioOption_" + top);
            $("#ExtendedSurveyForm_RadioOption_" + top).attr("data-hiddenname", "ExtendedSurveyForm_RadioOption_" + top + "_" + qNo);
            $("#ExtendedSurveyForm_RadioOption_" + top).attr({
                'onkeyup': "insertText('ExtendedSurveyForm_RadioOption_" + top + "');",
                'onblur' : "insertText('ExtendedSurveyForm_RadioOption_" + top + "');"
            });
            $("#radioEmessage_" + qNo).attr("id", "ExtendedSurveyForm_RadioOption_" + top + "_" + qNo + "_em_");
        }
        if (opType == "checkbox") {
            $("#checkbox_hidden_" + qNo).attr("name", "ExtendedSurveyForm[CheckboxOption][" + top + "_" + qNo + "]");
            $("#checkbox_hidden_" + qNo).attr("id", "ExtendedSurveyForm_CheckboxOption_" + top + "_" + qNo)
            $("#checkboxid_" + qNo).attr("id", "ExtendedSurveyForm_CheckboxOption_" + top);
            $("#ExtendedSurveyForm_CheckboxOption_" + top).attr("data-hiddenname", "ExtendedSurveyForm_CheckboxOption_" + top + "_" + qNo);
            $("#ExtendedSurveyForm_CheckboxOption_" + top).attr({
                'onkeyup': "insertText('ExtendedSurveyForm_CheckboxOption_" + top + "');",
                'onblur' : "insertText('ExtendedSurveyForm_CheckboxOption_" + top + "');"
            });
            $("#checkboxEmessage_" + qNo).attr("id", "ExtendedSurveyForm_CheckboxOption_" + top + "_" + qNo + "_em_");
        }

    }
    function saveQuestion(no, optionType,totalQuestions) {
        scrollPleaseWait("extededsurvey_spinner");
        var data = $("#questionWidget_" + no).serialize();
        var noofratings = "";
//        if($("#ExtendedSurveyForm_NoofRatings_hid_"+no).length > 0){
//            noofratings = $("#ExtendedSurveyForm_NoofRatings_hid_"+no).val();
//        }
        $.ajax({
            type: 'POST',
            url: '/extendedSurvey/validateSurveyQuestion?surveyTitle=' + $("#ExtendedSurveyForm_SurveyTitle").val() + '&SurveyDescription=' + $("#ExtendedSurveyForm_SurveyDescription").val()+"&SurveyGroupName="+$("#ExtendedSurveyForm_SurveyRelatedGroupName").val()+"&SurveyOtherValue="+$("#ExtendedSurveyForm_SurveyOtherValue").val()+"&SurveyLogo="+$("#ExtendedSurveyForm_SurveyLogo").val(),
            data: data,
            success: function(data) {
                var data = eval(data);
                if (data.status == 'success') {
                    isValidate++;                    
                }                
                if(isValidate == totalQuestions){ 
                    isValidated = true;
                    surveyFinalSubmit();
                }
                surveyHandler(data)
            },
            error: function(data) { // if error occured
                // alert("Error occured.please try again==="+data.toSource());
                // alert(data.toSource());
                isValidated = false;
                isValidate = 0;
            },
            dataType: 'json'
        });
    }
    function surveyHandler(data) {           
        var data = eval(data);
        if (data.status == 'success') {            
                ;

        } else {
            $("#surveyFormButtonId").attr("disabled",false);
            isValidate = 0;
            isValidated = false;
            scrollPleaseWaitClose("extededsurvey_spinner");
            var lengthvalue = data.error.length;
            var msg = data.data;
            var error = [];
            if (typeof (data.error) == 'string') {

                var error = eval("(" + data.error.toString() + ")");

            } else {
                var error = eval(data.error);
            }

            if(typeof(data.oerror)=='string'){
                var errorStr=eval("("+data.oerror.toString()+")");
            }else{
                var errorStr=eval(data.oerror);
            }
            $.each(errorStr, function(key, val) { 
                
                if($("#"+key+"_em_") && val != ""){                     
                    $("#"+key+"_em_").text(val);                                                    
                    $("#"+key+"_em_").show();   
                    $("#"+key+"_em_").fadeOut(12000);
                   // $("#"+key).parent().addClass('error');
                }
                
                
            }); 
            $.each(error, function(key, val) {
                if (key == "ExtendedSurveyForm_SurveyDescription") {
                    if ($("#ExtendedSurveyForm_SurveyDescription").val() == "") {
                        $("#ExtendedSurveyForm_SurveyDescription_em_").text(val);
                        $("#ExtendedSurveyForm_SurveyDescription_em_").show();
                        $("#ExtendedSurveyForm_SurveyDescription_em_").fadeOut(12000);
                        $("#ExtendedSurveyForm_SurveyDescription").parent().addClass('error');
                    }
                } else if (key == "ExtendedSurveyForm_SurveyTitle") {
                    if ($("#ExtendedSurveyForm_SurveyTitle").val() == "") {
                        $("#ExtendedSurveyForm_SurveyTitle_em_").text(val);
                        $("#ExtendedSurveyForm_SurveyTitle_em_").show();
                        $("#ExtendedSurveyForm_SurveyTitle_em_").fadeOut(12000);
                        $("#ExtendedSurveyForm_SurveyTitle").parent().addClass('error');
                    }
                } else if (key == "ExtendedSurveyForm_SurveyLogo") {
                    $('#surveyLogo_error').html("Please upload Research Logo ");
                    $('#surveyLogo_error').show();
                    $('#surveyLogo_error').fadeOut(12000);
                } else {
                    if ($("#" + key + "_em_")) {
                        $("#" + key + "_em_").text(val);
                        $("#" + key + "_em_").show();
                        $("#" + key + "_em_").fadeOut(12000);
                        $("#" + key).parent().addClass('error');
                    }
                }
                

            });
        }
    }
    var Garray = new Array();
    function saveSurveyForm() {
        $("#surveyFormButtonId").attr("disabled",true);
        for (var i = 1; i <= questionsCount; i++) {            
            saveQuestion(i, "radio",questionsCount);
            Garray[i - 1] = $("#questionWidget_" + i).serialize();
        }

    }
    function surveyFinalSubmit(){
        $("#ExtendedSurveyForm_Questions").val(JSON.stringify(Garray));        
        if (isValidated == true) {
            var data = $("#questionWidget").serialize();             
            $.ajax({
                type: 'POST',
                url: '/extendedSurvey/SaveSurveyQuestion?surveyTitle=' + $("#ExtendedSurveyForm_SurveyTitle").val() + '&SurveyDescription=' + $("#ExtendedSurveyForm_SurveyDescription").val() + '&questionsCount=' + questionsCount+"&SurveyGroupName="+$("#ExtendedSurveyForm_SurveyRelatedGroupName").val()+"&SurveyOtherValue="+$("#ExtendedSurveyForm_SurveyOtherValue").val()+"&SurveyLogo="+$("#ExtendedSurveyForm_SurveyLogo").val(),
                data: data,
                success: surveyFinalHandler,
                error: function(data) { // if error occured
                    // alert("Error occured.please try again==="+data.toSource());
                    // alert(data.toSource());
                },
                dataType: 'json'
            });
        }
    }
    function surveyFinalHandler(data){
        $("#surveyFormButtonId").attr("disabled",false);
        data = eval(data);  
        scrollPleaseWaitClose("extededsurvey_spinner");
        if(data.status == "success"){            
            $("#sucmsg").css("display", "block");
             <?php if(empty($surveyId)){ ?> 
                $("#sucmsg").html("Created Successfully. Please wait automatically loaded the survey wall.");
             <?php }else {  ?>
                 $("#sucmsg").html("Updated Successfully. Please wait automatically loaded the survey wall.");
             <?php } ?>
            $("#sucmsg").fadeOut(9000,function(){
                window.location.href = "/surveywall";
            });
        }
    }
    function insertText(id) {
        var pId = $("#" + id).attr("data-hiddenname");
        $("#" + pId).val($("#" + id).val());
    }

    <?php if(empty($surveyId)){?>
    $('.mainclass').sortable({
            connectWith: '.child',
            handle: 'b',
            cursor: 'move',
            opacity: 1.8,
            start:function(){
                scrollPleaseWait('surveySpinLoader');
                updateDivs();
            },
            stop:function(){
                updateDivs();
                setTimeout(function(){
                    scrollPleaseWaitClose('surveySpinLoader');
                },1000);
            },
        });
    <?php } ?>
    function SurveyPreviewImage(id, fileName, responseJSON, type)
    {
        var data = eval(responseJSON);
        $('#ExtendedSurveyForm_SurveyLogo').val(data.filename);
        $('#surveyPreviewId').attr('src', data.filepath);

    }
    function displayErrorForBannerAndQuestion(message, type) {
        
        $('#' + type + '_error').html(message);
        // $('#'+type+'_error').css("padding-top:20px;");
        $('#' + type + '_error').show();
        $('#' + type + '_error').fadeOut(6000);
  
    }
    function updateDivs(){
        
        $(".subsectionremove").each(function(key) {
            $(this).attr("data-questionId", key + 1);
        });
        $(".surveyaddoption").each(function(key) {
            $(this).attr("data-questionno", key + 1);
        });
        $(".answerstabs").each(function(key) {
            $(this).attr("id", "answerstabs_" + (key + 1));
        });
        $(".tabsselection").each(function(key) {
            $(this).attr("data-questionno", (key + 1));
        });
        $(".answersection1").each(function(key) {
            $(this).attr("data-questionId", (key + 1));
            $(this).attr("id", "answersection1_" + (key + 1));
        });
        preq = 0;
        nextq = 0;
        i = 0;
        $(".checkboxtype").each(function(key) {
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            if (preq == 0) {
                i = 0;
                preq = qNo;
            }
            if (preq == qNo) {
                i++;
            } else {
                preq = qNo;
                i = 1;
            }
            $this.attr("name", "checkbox_" + ($this.closest("div.answersection1").attr("data-questionId")));
            $this.attr("data-hiddenname", "ExtendedSurveyForm_CheckboxOption_hid_" + (i) + "_" + qNo);
            $this.attr("id", "ExtendedSurveyForm_CheckboxOption_" + (i) + "_" + qNo);
        });
        preq = 0;
        nextq = 0;
        i = 0;
        $(".radiotype").each(function(key) {
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            if (preq == 0) {
                i = 0;
                preq = qNo;
            }
            if (preq == qNo) {
                i++;
            } else {
                preq = qNo;
                i = 1;
            }

            $this.attr("name", "radio_" + (qNo))
            $this.attr("data-hiddenname", "ExtendedSurveyForm_RadioOption_hid_" + (i) + "_" + qNo);
            $this.attr("id", "ExtendedSurveyForm_RadioOption_" + (i) + "_" + qNo);            
            $this.attr({
               'onkeyup':'insertText(this.id)',
               'onblur':'insertText(this.id)'
            });
        });
        $(".othersarea").each(function(key) {
            $(this).attr("id", "othersarea_" + (key + 1));            
        });
        preq = 0;
        nextq = 0;
        i = 0;
        
        $(".othercheck").each(function(){
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            if (preq == 0) {
                i = 0;
                preq = qNo;
            }
            if (preq == qNo) {
                i++;
            } else {
                preq = qNo;
                i = 1;
            }
            $this.attr("id","othercheck_"+qNo);
        });
        $(".otherhidden").each(function(){
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            
            $this.attr("id","ExtendedSurveyForm_Other_"+qNo);
            $this.attr("name","ExtendedSurveyForm[Other]["+qNo+"]");
        });
        $(".otherhiddenvalue").each(function(){
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            
            $this.attr("id","ExtendedSurveyForm_OtherValue_"+qNo);
            $this.attr("name","ExtendedSurveyForm[OtherValue]["+qNo+"]");
        });
        $(".otherTextdiv").each(function(){
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            
            $this.attr("id","otherTextdiv_"+qNo);
        });
        $(".othertext").each(function(){
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            
            $this.attr("id","otherText_"+qNo);
            $this.attr("data-hiddenname","ExtendedSurveyForm_OtherValue_"+qNo);
            
        });
        $(".othererr").each(function(){
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");            
            $this.attr("id","ExtendedSurveyForm_OtherValue_"+qNo+"_em_");
        });
        $(".QuestionWidget").each(function(key) {
            $(this).attr("data-questionId", (key + 1));
            $(this).attr("id", "QuestionWidget_" + (key + 1));

        });
        $(".questionlabel").each(function(key) {
            $(this).attr("data-wid", (key + 1));
        });
        $(".surveyanswerarea").each(function(key) {
            $(this).attr("id", "surveyanswerarea_" + (key + 1));

        });
        preq = 0;
        nextq = 0;
        i = 0;
        $(".radiohidden").each(function(key) {
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            if (preq == 0) {
                i = 0;
                preq = qNo;
            }
            if (preq == qNo) {
                i++;
            } else {
                preq = qNo;
                i = 1;
            }
            $this.attr("id", "ExtendedSurveyForm_RadioOption_hid_" + (i) + "_" + $this.closest("div.answersection1").attr("data-questionId"))
            $this.attr("name", "ExtendedSurveyForm[RadioOption][" + (i) + "_" + qNo + "]");

        });
        preq = 0;
        nextq = 0;
        i = 0;
        $(".checkboxhidden").each(function(key) {
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            if (preq == 0) {
                i = 0;
                preq = qNo;
            }
            if (preq == qNo) {
                i++;
            } else {
                preq = qNo;
                i = 1;
            }

            $this.attr("id", "ExtendedSurveyForm_CheckboxOption_hid_" + (i) + "_" + $this.closest("div.answersection1").attr("data-questionId"))
            $this.attr("name", "ExtendedSurveyForm[CheckboxOption][" + (i) + "_" + qNo + "]");

        });
        preq = 0;
        nextq = 0;
        i = 0;
        $(".radioEmessage").each(function(key) {
            var $this = $(this);
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            if (preq == 0) {
                i = 0;
                preq = qNo;
            }
            if (preq == qNo) {
                i++;
            } else {
                preq = qNo;
                i = 1;
            }
            $this.attr("id", "ExtendedSurveyForm_RadioOption_" + (i) + "_" + qNo + "_em_");
        });
        preq = 0;
        nextq = 0;
        i = 0;
        $(".checkboxEmessage").each(function(key) {
            var $this = $(this);
            if (preq == 0) {
                i = 0;
                preq = qNo;
            }
            if (preq == qNo) {
                i++;
            } else {
                preq = qNo;
                i = 1;
            }
            var qNo = $this.closest("div.answersection1").attr("data-questionId");
            $this.attr("id", "ExtendedSurveyForm_CheckboxOption_" + (i) + "_" + qNo + "_em_");
        });

        $(".questionserror").each(function(key) {
            var $this = $(this);
            var qNo = $this.attr("data-questionno");
            $this.attr("id", "ExtendedSurveyForm_Question_" + qNo + "_em_");
        });
        $(".questionwidgetform").each(function() {
            var $this = $(this);
            var qNo = $this.closest("div.QuestionWidget").attr("data-questionId");            
            $this.attr("id", "questionWidget_" + qNo);
        })
    }
    <?php if(!empty($surveyId)){?>
                $('#surveyGroupName').val('<?php echo $surveyObj->SurveyRelatedGroupName;?>');
                $("#surveyGroupName").attr("disabled",true);
                
        <?php } ?>
    $("#surveyGroupName").change(function(){
        var val = $(this).val();
        $("#ExtendedSurveyForm_SurveyRelatedGroupName").val(val);       
        
        if( val == "other"){
           $("#othervalue").show();
       }else{
           <?php foreach($surveyGroupNames as $rw){?> 
                if((val == '<?php echo $rw->GroupName;?>')){
                    
                    $("#surveyPreviewId").attr("src",'<?php echo Yii::app()->params['ServerURL'].$rw->LogoPath;?>');
                    $("#ExtendedSurveyForm_SurveyLogo").val('<?php echo $rw->LogoPath;?>');
                }
            <?php } ?>
           
//           $("#ExtendedSurveyForm_SurveyLogo").val($(this).attr("data-url"));
           $("#othervalue").hide();
       }        
    });
    
    function getSurveyGroups(){     
            ajaxRequest("/extendedSurvey/getSurveyGroups", '', function(data){getSurveyGroupsHandler(data);});
    }
    function getSurveyGroupsHandler(data){        
        $('#surveyGroupName option').remove();        
        var dataArr = data.data;        
        $('#surveyGroupName').append("<option value=''>Please Choose Group Name</option>");
        $.each(dataArr, function(i){           
            $('#'+id).append($("<option></option>")
            .attr("value",dataArr[i]['id'])
            .text(dataArr[i]['GroupName']));
        });        
           
        $('#surveyGroupName').append("<option value='other'>Other</option>");
    }
    function CancelSurveyForm(){
        window.location.href = "/surveywall";
    }

        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        specialKeys.push(9); //Tab
        specialKeys.push(46); //Delete
        specialKeys.push(36); //Home
        specialKeys.push(35); //End
        specialKeys.push(37); //Left
        specialKeys.push(39); //Right
        specialKeys.push(127);//Question mark
        specialKeys.push(96); //Space
        function IsAlphaNumeric(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            return ret;
        }
</script>