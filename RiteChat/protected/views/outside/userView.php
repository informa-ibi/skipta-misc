<?php 
if(is_object($surveyObj)){ ?>
<input type="hidden" value="<?php echo $userId; ?>" name="QuestionsSurveyForm[UserId]" />
<input type="hidden" value="<?php echo $scheduleId; ?>" name="QuestionsSurveyForm[ScheduleId]" />
<input type="hidden" name="QuestionsSurveyForm[SurveyId]" value="<?php echo $surveyObj->_id; ?>" id="QuestionsSurveyForm_SurveyId">
<input type="hidden" name="QuestionsSurveyForm[SurveyTitle]" value="<?php echo $surveyObj->SurveyTitle; ?>" id="QuestionsSurveyForm_SurveyTitle">
<input type="hidden" name="QuestionsSurveyForm[SurveyDescription]" value="<?php echo $surveyObj->SurveyDescription; ?>" id="QuestionsSurveyForm_SurveyDescription">
<input type="hidden" name="QuestionsSurveyForm[SurveyLogo]" value="<?php echo $surveyObj->SurveyLogo; ?>" id="QuestionsSurveyForm_SurveyLogo">
<input type="hidden" name="QuestionsSurveyForm[Questions]" value="" id="QuestionsSurveyForm_Questions">
<input type="hidden" name="QuestionsSurveyForm[SurveyRelatedGroupName]" value="<?php echo $surveyObj->SurveyRelatedGroupName; ?>" id="QuestionsSurveyForm_SurveyRelatedGroupName">

<div class="padding10ltb">
    
     <h2 class="pagetitle">Market Research</h2>
    <div class="market_profile marginT10">
	<div class="m_profileicon"><div class="marginzero smallprofileicon largeprofileicon noBackGrUp">
                            
                            <div class="positionrelative editicondiv editicondivProfileImage no_border ">
                                
                                <div style="display: none;" class="edit_iconbg top75">
                                    <div id="UserProfileImage"><div class="qq-uploader"><div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Upload a file<input type="file" multiple="multiple" capture="camera" name="file" style="position: absolute; right: 0px; top: 0px; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;"></div></div></div>


                                    
                                </div>
<!--                                <img id="profileImagePreviewId" src="" alt="" />-->
                               <img alt="" src="<?php echo $surveyObj->SurveyLogo; ?>" id="profileImagePreviewId">
                            </div>
                
                            <div><ul id="uploadlist_logo" class="qq-upload-list"></ul></div>
                        </div></div>
                        
	   	 <div class="row-fluid padding-bottom5 padding-top35 mobilepadding-top35 ">
                    <div class="span12">
                    <div class="ext_surveyTitle"><?php echo $surveyObj->SurveyTitle; ?></div>
                     <?php if($surveyObj->SurveyRelatedGroupName != "0"){?><div class="ext_groupTitle  padding8top"><?php echo $surveyObj->SurveyRelatedGroupName; ?></div> <?php } ?> 
                     <div class="extcontent padding8top"><?php echo $surveyObj->SurveyDescription; ?> </div>
                    </div>
                    </div>
                                
    
     </div>
     
     
     <div class="row-fluid groupseperator border-bottom">
     <div class="span12 "><h2 class="pagetitle paddingleft5">Market Research Survey </h2></div>
     </div>
     <div id="surveyviewspinner" style="position:relative;"></div>
     <div class="padding152010" style="" id="surveyQuestionArea">
         <?php 
         $i = 1; 
         foreach($surveyObj->Questions as $question){ 
            
            if($question['QuestionType'] == 1){ ?>             
                    <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionviewWidget_' . ($i),
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
         <?php 
//            echo $form->hiddenField($QuestionsSurveyForm,"WidgetType[$i]",array("value"=>1));
//            echo $form->hiddenField($QuestionsSurveyForm,"QuestionId[$i]",array("value"=>1));
//            echo $form->hiddenField($QuestionsSurveyForm,"Other[$i]",array("value"=>1));
//            echo $form->hiddenField($QuestionsSurveyForm,"OtherValue[$i]",array("value"=>1));
//            echo $form->hiddenField($QuestionsSurveyForm,"OptionsSelected[$i]",array("value"=>1));
         ?>
         <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="1" />
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[Other][<?php echo ($i); ?>]" id="QuestionsSurveyForm_Other_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OtherValue][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_OtherValue_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>"/>
                    <div class="surveyquestionsbox" data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                        
                                <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_OptionsSelected_<?php echo $i; ?>_em_" class="errorMessage"></div>
                            
                     <div class="surveyanswerarea surveyanswerviewarea">
                     <div class="paddingtblr30">
                        <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                     <div class="answersection">
                      <?php $j = 1;foreach($question['Options'] as $rw){ ?>   
                         <div class="normalsection ">
                             <div class="surveyradiobutton radiooption_<?php echo ($i); ?>" data-optionid="<?php echo ($j."_".$i); ?>"> <input value="<?php echo ($j); ?>" type="radio" class="styled " name="radio_<?php echo $i;?>" id="optionradio_<?php echo $j."_".$i;?>"></div>
                         <div class="answerview"><?php echo $rw; ?></div>
                        </div>
                      <?php $j++; } ?>
                         <?php if($question['Other'] == 1){ ?>
                             <div class="normalsection">
                            <div class="surveyradiobutton otherradio_<?php echo ($i); ?>" data-optionvalue="<?php echo ($j); ?>"> <input type="radio" class="styled" name="radio_<?php echo $i;?>" ></div>
                             <div class="row-fluid">
                            <div class="span12">
                                <input  type="text" class="textfield span4" placeHolder="<?php echo $question['OtherValue'];?>"  id="othervalue_<?php echo ($i); ?>" data-hiddenname="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>"  onkeyup="insertText(this.id)" onblur="insertText(this.id)"/>
                                <div class="control-group controlerror">
                                <div style="display:none"  id="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>_em_" class="errorMessage"></div>
                            </div>
                            </div>
                            </div>
                            </div>
                         <?php } ?>
                     </div>
                     </div>
                     </div>
                    </div>
             <?php $this->endWidget(); ?>  
         <script type="text/javascript">
                  $(".radiooption_<?php echo ($i); ?>").live('click',function(){                                           
                      var oid = $(this).attr("data-optionid");
                      var value = $("#optionradio_"+oid).val();
                      $("#QuestionsSurveyForm_Other_<?php echo ($i); ?>,#QuestionsSurveyForm_OtherValue_<?php echo ($i); ?>").val("");
                      $("#QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>").val(value);
                  });
                  $(".otherradio_<?php echo ($i); ?>").live('click',function(){
                      var value = $(this).attr("data-optionvalue");
                      $("#QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>").val(value);
                      $("#QuestionsSurveyForm_Other_<?php echo ($i); ?>").val(1);
                  });
          </script>
         <?php }else if($question['QuestionType'] == 2){ ?>
             <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionviewWidget_' . ($i),
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="2" />
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[Other][<?php echo ($i); ?>]" id="QuestionsSurveyForm_Other_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OtherValue][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_OtherValue_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>"/>
            <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                
                                <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_OptionsSelected_<?php echo $i; ?>_em_" class="errorMessage"></div>
                            
                <div class="surveyanswerarea surveyanswerviewarea">
                     <div class="paddingtblr30">
                        <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                     <div class="answersection">
                      <?php $j=1; foreach($question['Options'] as $rw){ ?>   
                         <div class="normalsection ">
                        <div class="surveyradiobutton radiooption_<?php echo ($i); ?>" data-optionid="<?php echo ($j."_".$i); ?>"> <input type="checkbox" class="styled " data-type="checkbox" name="checkbox_<?php echo $i;?>" value="<?php echo $j;?>" id="optioncheckbox_<?php echo $j."_".$i;?>"></div>
                         <div class="answerview"><?php echo $rw; ?></div>
                        </div>
                      <?php $j++;} ?>
                         <?php if($question['Other'] == 1){ ?>
                             <div class="normalsection">
                            <div class="surveyradiobutton othercheckbox_<?php echo ($i); ?>" data-optionid="<?php echo ($j."_".$i); ?>"> <input type="checkbox" class="styled checkboxradio_<?php echo $i; ?>" data-type="othercheckbox" name="checkbox_<?php echo $i;?>" id="otherCheckbox_<?php echo ($j."_".$i); ?>"></div>
                             <div class="row-fluid">
                            <div class="span12">
                                <input  type="text" class="textfield span4" placeHolder="<?php echo $question['OtherValue'];?>"  id="othervalue_<?php echo ($i); ?>" data-hiddenname="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>"  onkeyup="insertText(this.id)" onblur="insertText(this.id)"/>
                                <div class="control-group controlerror">
                                <div style="display:none"  id="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>_em_" class="errorMessage"></div>
                            </div>
                            </div>
                            </div>
                            </div>
                         <?php } ?>
                     </div>
                     </div>
                     </div>
            </div>
          <?php $this->endWidget(); ?>
          <script type="text/javascript">                  
                  $(".othercheckbox_<?php echo ($i); ?>").live("click",function(){
                    var oid = $(this).attr("data-optionid");
                    if($("#otherCheckbox_"+oid).is(":checked")){
                        $("#QuestionsSurveyForm_Other_<?php echo ($i); ?>").val(1);
                    }else{
                        $("#QuestionsSurveyForm_Other_<?php echo ($i); ?>").val("");
                    }                     
                  });
                  $(".checkbox").die();
                  $(".surveyradiobutton").live('click',function(){                      
                      var checkboxvalues = "";
                      $("input[name='checkbox_<?php echo $i;?>']").each(function(key, value) {
                          var $this = $(this);                         
                            if($this.is(":checked")){                                
                                if(checkboxvalues == ""){
                                    checkboxvalues = $this.val();
                                }else{
                                    if(checkboxvalues.search($this.val()) < 0){
                                        checkboxvalues = checkboxvalues+","+$this.val();
                                    }
                                    
                                }                                
                            }
                            
                        });
                        if(checkboxvalues != 0 && checkboxvalues != ""){
                            $("#QuestionsSurveyForm_OptionsSelected_<?php echo $i;?>").val(checkboxvalues);
                        }
                        
                  });
          </script>
              
         <?php } else if($question['QuestionType'] == 3){ ?>
 <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionviewWidget_' . ($i),
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="3" />
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[Other][<?php echo ($i); ?>]" id="QuestionsSurveyForm_Other_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OtherValue][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_OtherValue_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>"/>
                       <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                           <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_OptionsSelected_<?php echo $i; ?>_em_" class="errorMessage"></div>
                        <div class="surveyanswerarea surveyanswerviewarea">
                        <div class="paddingtblr30">
                           <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                        <div class="answersection">
                       <div class="paddingtop12">
                        <table cellpadding="0" cellspacing="0" class="customsurvaytable customsurvaytableview">
                        <tr>
                        <th class="col1"></th>
                        <?php foreach($question['LabelName'] as $rw){?>
                            <th><?php echo $rw; ?></th>
                        <?php } ?>
                            <?php if($question['Other'] == 1) { ?>
                                <th>N/A</th>
                            <?php } ?>
                        </tr>
                        
                            <?php $k = 1;foreach($question['OptionName'] as $rw){ ?>
                        <?php if($question['Other'] != 1) { ?>
                        <input class="questionOptionhidden_<?php echo ($k."_".$i); ?>" type="hidden" name="QuestionsSurveyForm[OptionValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValue_<?php echo ($k."_".$i); ?>"/>
                        <?php } ?>
                        <tr>
                        <td><?php echo $rw; ?></td>
                            <?php $ik = 0;for($j=1;$j<=$question['NoofOptions'];$j++){ ?>
                                <td><div  class="positionrelative displaytable radioTable_<?php echo $j."_".$i; ?>" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                        <input type="radio" class="styled radiotype_<?php echo $i; ?>" name="ranking_<?php echo $k; ?>" id="rankingRadio_<?php echo $k; ?>" value="<?php echo $j;?>" data-name="<?php echo $j ?>" data-col="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>"/>
                                </div></td>
                                <script type="text/javascript">
                                    var prev = 0;
                                    var value = "";                                   
                                    
                                    <?php //if($ik == 0 ){ ?> 
                                        $("div.radioTable_<?php echo $j."_".$i; ?> span.radio").live("click",function(){
                                            <?php $ik++; ?>
                                        
                                        $("div.radioTable_<?php echo $j."_".$i; ?> span.radio").each(function(key){                                         
                                            $(this).attr("style","background-position:0 0");
//                                            alert($(this).siblings('.radiotype_<?php echo $i; ?>').val())
                                            if($(this).siblings('.radiotype_<?php echo $i; ?>').is(':checked') == false){
                                                var idd = $(this).siblings('.radiotype_<?php echo $i; ?>').attr('data-hidname')

//                                                $("#"+idd).val("");
                                                
                                            }
                                            if($(this).siblings('.radiotype_<?php echo $i; ?>').val() != ""){
                                                
                                            }
                                            $(this).siblings('.radiotype_<?php echo $i; ?>').attr('checked',false);
                                        });                                        
                                         $(this).attr("style","background-position:0 -50px");
                                         $(this).siblings('.radiotype_<?php echo $i; ?>').attr('checked',true);
//                                         $(".questionOptionhidden_<?php //echo ($k."_".$i); ?>").each(function(){
//                                             var value = $(this).val();
//                                             var $thisq = $(this);
//                                             $("div.radioTable_<?php //echo $j."_".$i; ?> span.radio").each(function(){                                         
//                                            $("#QuestionsSurveyForm_OptionValue_<?php //echo ($k."_".$i); ?>").val("")
//                                                if($(this).attr("style") == "background-position:0 0"){
////                                                    $thisq.val("");
//                                                }
//                                            });  
//                                         });
//                                        ik = 0;
                                    });
                                    
                                    <?php // } ?>
                                    
                                     
                                </script>
                            <?php } ?>
                                <?php if($question['Other'] == 1) { ?>
                                <input type="hidden" name="QuestionsSurveyForm[OptionValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValue_<?php echo ($k."_".$i); ?>"/>
                                <td><div class="positionrelative displaytable radioTable_<?php echo $j; ?>" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                 <input type="radio" class="styled radiotype_<?php echo $i; ?>" name="ranking_<?php echo $k; ?>" id="otherradioranking_<?php echo $k; ?>" value="<?php echo $j;?>" data-name="<?php echo $j ?>"/>
                                </div></td>
                            <?php } ?>
                                </tr>
                                
                            <?php $k++;} ?>
                        

                        </table>


                      </div>
                        </div>
                        </div>
                        </div>
                     </div>
          <?php $this->endWidget(); ?>
         <script type="text/javascript">
             var prev = 0;
                   $(".displaytable").live('click',function(){                 
                        //Custom.clear();
//                        $("div.radioTable_<?php echo $j."_".$i; ?> span.radio").each(function(){                                         
////                                                        $(this).attr("style","background-position:0 0");
//                                  if($(this).attr("style") == "background-position:0 0"){
//                                      $(".questionOptionhidden_<?php echo ($k."_".$i); ?>").each(function(){
//                                          //alert($(this).val())
//                                      });
//                                  }
//
//                            });
                        var oid = $(this).attr("data-optionid");
                        var hidId = $(this).attr("data-hidname");                 
                        $("#"+hidId).val($(this).attr("data-name"));
                         var checkboxvalues = "";                                                  
                        $(".radiotype_<?php echo $i; ?>").each(function(){
                            var $this = $(this);
                           if($(this).is(":checked")){
                               if(checkboxvalues == ""){
                                   checkboxvalues = $this.val();
                               }else{
                                   checkboxvalues = checkboxvalues+","+$this.val();  
                               }
                           }
                        });     
                       if(checkboxvalues != 0 && checkboxvalues != ""){
                           $("#QuestionsSurveyForm_OptionsSelected_<?php echo $i;?>").val(checkboxvalues);
                       } 


                    }); 
//                 var col, el;
//                $("input[type=radio]").live('click',function() {
//                   el = $(this);
//                   col = el.data("col");
//                   alert("col==="+col)
//                   $("input[data-col=" + col + "]").prop("checked", false);
//                   el.prop("checked", true);
//                });
         </script>
         <?php } else if($question['QuestionType'] == 4){ ?>
         <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionviewWidget_' . $i,
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="4" />
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[Other][<?php echo ($i); ?>]" id="QuestionsSurveyForm_Other_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OtherValue][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_OtherValue_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>"/>
                <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                    <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_OptionsSelected_<?php echo $i; ?>_em_" class="errorMessage"></div>                        
                    
                    <div class="surveyanswerarea surveyanswerviewarea">
                        <div class="paddingtblr30">
                           <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                        <div class="answersection">
                       <div class="paddingtop12">
                        <table cellpadding="0" cellspacing="0" class="customsurvaytable customsurvaytableview">
                        <tr>
                        <th class="col1"></th>
                        <?php foreach($question['LabelName'] as $rw){?>
                            <th><?php echo $rw; ?></th>
                        <?php } ?>
                            <?php if($question['Other'] == 1) { ?>
                                <th>N/A</th>
                            <?php } ?>
                        </tr>
                        
                            <?php $k = 1;foreach($question['OptionName'] as $rw){ ?>
                    <input type="hidden" name="QuestionsSurveyForm[OptionValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValue_<?php echo ($k."_".$i); ?>" class="optionvalueclass_<?php echo $i; ?>"/>
                        <tr>
                        <td><?php echo $rw; ?></td>
                            <?php for($j=1;$j<=$question['NoofRatings'];$j++){ ?>
                                <td><div class="positionrelative displaytable radioRatingTable" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                        <input type="radio" class="styled radiotype_rat_<?php echo $i; ?>" name="rating_<?php echo $k; ?>" id="ratingRadio_<?php echo $k; ?>" value="<?php echo $j;?>" />
                                </div></td>
                            <?php } ?>
                                <?php if($question['Other'] == 1) { ?>
                                <td><div class="positionrelative displaytable radioRatingTable" data-name="<?php echo $j ?>">
                                 <input type="radio" class="styled radiotype_rat_<?php echo $i; ?>" name="rating_<?php echo $k; ?>" id="ratingRadio_<?php echo $k; ?>" value="<?php echo $j;?>"/>
                                </div></td>
                            <?php } ?>
                                </tr>
                            <?php $k++;} ?>
                        

                        </table>


                      </div>
                        </div>
                        </div>
                        </div>
                     </div>
         <?php $this->endWidget(); ?>
         <script type="text/javascript">
             $(".radioRatingTable").live('click',function(){
                 var oid = $(this).attr("data-optionid");
                 
                 var hidId = $(this).attr("data-hidname");
                 
                  $("#"+hidId).val($(this).attr("data-name"));
                  var checkboxvalues = "";                        
                 var value = $("#rankingRadio_"+oid).val();
                 $(".radiotype_rat_<?php echo $i; ?>").each(function(){
                     var $this = $(this);
                    if($(this).is(":checked")){
                        if(checkboxvalues == ""){
                            checkboxvalues = $this.val();
                        }else{
                            checkboxvalues = checkboxvalues+","+$this.val();  
                        }
                    }
                 });     
                 
                if(checkboxvalues != 0 && checkboxvalues != ""){
                    $("#QuestionsSurveyForm_OptionsSelected_<?php echo $i;?>").val(checkboxvalues);
                }
             });             
         </script>
         <?php } else if($question['QuestionType'] == 5){ ?>
         <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionviewWidget_' . ($i),
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="5" />
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[TotalCalValue][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_TotalCalValue_<?php echo ($i); ?>"/>
                <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                    <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_TotalCalValue_<?php echo $i; ?>_em_" class="errorMessage"></div>    
                        <div class="surveyanswerarea surveyanswerviewarea">
                        <div class="paddingtblr30">
                           <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                           <?php $k = 1; foreach($question['OptionName'] as $rw){ ?>
                           <input type="hidden" name="QuestionsSurveyForm[DistValue][<?php echo ($k."_".$i); ?>]" id="QuestionsSurveyForm_DistValue_hid_<?php echo ($k."_".$i); ?>" />
                       <div class="answersection">
                     <div class="normalsection ">
                     <div class="row-fluid">
                     <div class="span12">
                     <div class="span6">
                     <div class="surveyradiobutton top3"><?php echo $k; ?>)</div>
                     <div class="answerview"><?php echo $rw; ?> </div>
                     </div>
                     <div class="span2 total" data-num="<?php echo $question['TotalValue']; ?>">
                     <div class="positionrelative pricetype">
                     <div class="percentdiv"><?php if( $question['MatrixType'] == 1) echo "%"; else echo "$";?> </div>
                     <input type="text" class="textfield span12 distvalue" id="QuestionsSurveyForm_DistValue_<?php echo $k."_".$i; ?>" data-hiddenname="QuestionsSurveyForm_DistValue_hid_<?php echo $k."_".$i; ?>" onkeyup="insertText(this.id);" onblur="insertText(this.id);updateValues(this,'<?php echo $i; ?>')" onkeydown="allowNumerics(event,this,'<?php echo $i; ?>')">
                     </div>
                     </div>

                     </div>
                     </div>

                    </div>

                    </div>
                           <?php $k++;} ?>
                       
                    </div>
                    </div>
                
         <?php $this->endWidget(); ?>
                    <script type="text/javascript">
                    function updateValues(obj,qno){
                        var totalvalue = $("#"+obj.id).closest('div.total').attr("data-num");
                        var calValue = 0;
                        $(".distvalue").each(function(){
                           var $this = $(this);
                           calValue = calValue+Number($this.val());                           
                        });
                        $("#QuestionsSurveyForm_OptionsSelected_"+qno).val(calValue);
                        if(calValue == totalvalue ){
                            $("#QuestionsSurveyForm_TotalCalValue_"+qno).val(calValue);
                            
                        }
                    }
                    </script>
         <?php } else if($question['QuestionType'] == 6){ ?>
         <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionviewWidget_' . ($i),
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="6" />
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[UserAnswer][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_UserAnswer_hid_<?php echo ($i); ?>"/>
                     <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                         <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_UserAnswer_<?php echo $i; ?>_em_" class="errorMessage"></div>    
                        <div class="surveyanswerarea surveyanswerviewarea">
                        <div class="paddingtblr30">
                           <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                        
                           <div class="answersection">
                         <div class="normalsection paddingleftzero ">
                        <div class="row-fluid">
                         <div class="span12">
                         
                         <?php if($question['NoofChars'] <= 100){ ?>
                            <div class="answerview" id="100chars">
                                <input type="text" class="textfield span12" value="" id="userquestionanswer100_<?php echo $i; ?>" data-hiddenname="QuestionsSurveyForm_UserAnswer_hid_<?php echo $i; ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="<?php echo $question['NoofChars']; ?>"> 
                            </div>
                         <?php } else{ ?> 
                            
                         <div class="answerview" id="morethan500chars">
                             <textarea class="textfield span12" name="" id="userquestionanswer500_<?php echo $i; ?>" data-hiddenname="QuestionsSurveyForm_UserAnswer_hid_<?php echo $i; ?>" onkeyup="insertText(this.id)" onblur="insertText(this.id)" maxlength="<?php echo $question['NoofChars']; ?>"></textarea>                             
                         </div>
                        <?php } ?>
                         </div>
                          

                         </div>
                         </div>

                        </div>


                        </div>


                        </div>
                        </div>
                      
         <?php $this->endWidget(); ?>         
         <?php } else if($question['QuestionType'] == 7){ ?>
          <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'questionviewWidget_' . ($i),
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="7" />
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_OptionsSelected_hid_<?php echo ($i); ?>"/>
                <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                    <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_OptionsSelected_<?php echo $i; ?>_em_" class="errorMessage"></div>    
                        <div class="surveyanswerarea surveyanswerviewarea">
                        <div class="paddingtblr30">
                           <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                        
                           <div class="answersection">
                            <?php for($j=1; $j<=$question['NoofOptions']; $j++){?>
                               <input type="hidden" name="QuestionsSurveyForm[UsergeneratedRanking][<?php echo ($j."_".$i); ?>]" id="QuestionsSurveyForm_UsergeneratedRanking_hid_<?php echo ($j."_".$i); ?>" />
                                <div class="normalsection ">
                                <div class="row-fluid">
                                <div class="span12">
                                <div class="span4">
                                <div class="surveyradiobutton top3 top8"><?php echo $j; ?> )</div>
                                <div class="answerview"><input type="text" class="textfield span12" id="QuestionsSurveyForm_OptionValue_<?php echo $j."_".$i; ?>" data-hiddenname="QuestionsSurveyForm_UsergeneratedRanking_hid_<?php echo $j."_".$i; ?>" onkeyup="insertText(this.id);updateValue('QuestionsSurveyForm_OptionsSelected_hid_<?php echo ($i); ?>',this.id);" onblur="insertText(this.id)"> </div>
                                </div>


                                </div>
                                </div>

                               </div>   
                            <?php } ?>

                        </div>


                        </div>
                        </div>
                        </div>
         <?php $this->endWidget(); ?>    
         <script type="text/javascript">
         function updateValue(id,resId){             
             $("#"+id).val($("#"+resId).val());
         }
         </script>
         <?php } ?>
     <?php $i++;} ?>
     
     
     
  

<script type="text/javascript">
Custom.init();
var qCount = '<?php echo sizeof($surveyObj->Questions); ?>';
</script>
<script type="text/javascript">
    function allowNumerics(e,obj,qno){
       
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
        
    
    }
    
    
        Custom.init();
        var Garray = new Array();
            var isValidate = 0;
            var isValidated = false; 
        $("#submitQuestion").live("click",function(){          
//            var data = $("#questionviewwidget").serialize();             
             
             for(var i =1; i<=qCount;i++){
                    ValidateQuestions(i, qCount);                
             }
        });
        function insertText(id) {
            var pId = $("#" + id).attr("data-hiddenname");            
            $("#" + pId).val($("#" + id).val());
        }
        
        function ValidateQuestions(qNo,qCnt){
            scrollPleaseWait('surveyviewspinner');
//            alert($("#QuestionsSurveyForm_OptionsSelected_"+qNo).val())
            var data = $("#questionviewWidget_"+qNo).serialize();
//            alert(data.toSource())
            Garray[qNo - 1] = data;            

            $.ajax({
                type: 'POST',
                url: '/outside/validateQuestions?surveyTitle=' + $("#QuestionsSurveyForm_SurveyTitle").val() + '&SurveyDescription=' + $("#QuestionsSurveyForm_SurveyDescription").val() + '&questionsCount=' + qCnt+"&SurveyGroupName="+$("#QuestionsSurveyForm_SurveyRelatedGroupName").val()+"&SurveyLogo="+$("#QuestionsSurveyForm_SurveyLogo").val(),
                data: data,
                success: function(data) {
                    var data = eval(data);                    
                     
                     if (data.status == 'success') {
                            isValidate++;                    
                        }                
                        
                       ValidateQuestionsHandler(data)

                },
                error: function(err) { 
                },
                dataType: 'json'
            });
        }
        function ValidateQuestionsHandler(data){
            var data = eval(data);
            if (data.status == 'success') {
                if(isValidate == qCount){ 
                    isValidated = true;
                }
                saveAnswersForQuestions();

            } else {
                scrollPleaseWaitClose('surveyviewspinner');
                isValidate = 0;
                var error = [];
                if (typeof (data.error) == 'string') {

                    var error = eval("(" + data.error.toString() + ")");

                } else {
                    var error = eval(data.error);
                }
                $.each(error, function(key, val) {     
                        var strArr = key.split("_");  
//                        alert(strArr[1])
                        if($.trim(strArr[1]) == "OptionValue"){                            
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").text("Please fill the fields");
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").show();
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").fadeOut(9000);
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").addClass('error');
                            
                        }else if ($("#" + key + "_em_")) {                            
                            $("#" + key + "_em_").text(val);
                            $("#" + key + "_em_").show();
                            $("#" + key + "_em_").fadeOut(9000);
                            $("#" + key).parent().addClass('error');
                        }



                });
            }
        }
        
        function saveAnswersForQuestions(){
            scrollPleaseWait("extededsurvey_spinner");
            $("#QuestionsSurveyForm_Questions").val(JSON.stringify(Garray));
            var data = $("#questionviewwidget").serialize();
            if(isValidated == true){
                isValidate = 0;
                isValidated = false;
            $.ajax({
                type: 'POST',
                url: '/outside/validateSurveyAnswersQuestion',
                data: data,
                success: function(data) {
                    scrollPleaseWaitClose('surveyviewspinner');
                    $("#surveysubmitbuttons").hide();
                    $("#surveyQuestionArea").html(data);
                },
                error: function(data) { // if error occured

                },
                dataType: 'html'
            });
        }
        }
        function SaveSurveyAnswers(){
            
        }
    </script>

  <?php       }else{echo $errMessage; }
?>