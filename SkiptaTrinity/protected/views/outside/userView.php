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
     <?php if($surveyObj->IsBannerVisible == 1){ ?>
    <div id="userview_Bannerprofile"> 
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
                     <div class="extcontent padding8top wordwrap100" ><?php echo $surveyObj->SurveyDescription; ?> </div>
                    </div>
                    </div>
                                
    
     </div>
     </div>
<!--     <div class="row-fluid groupseperator border-bottom">
     <div class="span12 "><h2 class="pagetitle paddingleft5">Market Research Survey </h2></div>
     </div>-->
    <?php } ?>
     
     <div class="padding152010" style="" id="surveyQuestionArea">
<!--         <div id="userviewErrMessage" class="alert alert-error" style="display: none;"></div>-->
         <?php 
         $i = 1; 
         foreach($surveyObj->Questions as $question){ ?>
            <input type="hidden" name="QuestionsSurveyForm[IsMadatory][<?php echo ($i); ?>]" value="<?php echo $question['IsMadatory']; ?>" id="QuestionsSurveyForm_IsMadatory_<?php echo $i; ?>">
            <?php if($question['QuestionType'] == 1){ ?>             
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

         <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="1" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="2" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
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
                            <div class="surveyradiobutton othercheckbox_<?php echo ($i); ?>" data-optionid="<?php echo ($j."_".$i); ?>"> <input type="checkbox" value="other" class="styled checkboxradio_<?php echo $i; ?>" data-type="othercheckbox" name="checkbox_<?php echo $i;?>" id="otherCheckbox_<?php echo ($j."_".$i); ?>"></div>
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
                        
                        
                            $("#QuestionsSurveyForm_OptionsSelected_<?php echo $i;?>").val(checkboxvalues);
                        
                        
                  });
          </script>
              
         <?php } else if($question['QuestionType'] == 3){ // ranking...?>
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="3" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
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
                           <div class="MR_view_table"> 
                        <table cellpadding="0" cellspacing="0" class="customsurvaytable customsurvaytableview">
                        <tr>
                        <th class=""></th>
                        <?php $ln = 0; foreach($question['LabelName'] as $rw){?>
                        <th <?php if($question['StylingOption'] == 2){?> class="col2" <?php }?>>
                            <div><?php echo $rw; ?></div>
                            <?php if(isset($question['LabelDescription'][$ln]) && !empty($question['LabelDescription'][$ln])){ ?>
                            <div class="info_color"> <?php echo $question['LabelDescription'][$ln]; ?></div>
                            <?php $ln++;} ?>  
                        </th>
                        <?php } ?>
                            <?php if($question['Other'] == 1) { ?>
                                <th <?php if($question['StylingOption'] == 2){?> class="col2" <?php }?>>N/A</th>
                            <?php } ?>
                        </tr>
                        
                            <?php $anyOther = 0;$noofoptions=0; $k = 1;$optionsSize = sizeof($question['OptionName']);foreach($question['OptionName'] as $rw){ ?>
                        
                        <tr>                            
                        <?php if(trim($rw) != trim("")){ ?>
                            <?php if($optionsSize != $k || $question['AnyOther'] == 0){ ?>
                            <input class="questionOptionhidden_<?php echo ($k."_".$i); ?>" type="hidden" name="QuestionsSurveyForm[OptionValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValue_<?php echo ($k."_".$i); ?>"/>
                            <?php }else{ ?>
                            <input class="questionOptionhidden_<?php echo ($k."_".$i); ?>" type="hidden" name="QuestionsSurveyForm[OptionValueOther][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValueOther_<?php echo ($k."_".$i); ?>"/>
                            
                            <?php } ?>
                            
                        <td><?php if($optionsSize == $k && $question['AnyOther'] == 1){  ?>
                            <input type="hidden" name="QuestionsSurveyForm[OptionTextValue][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionTextValue_<?php echo ($k."_".$i); ?>" class="OptionTextValueclass_<?php echo $i; ?>"/>
                            <div  class="positionrelative surveydeleteaction"   data-hidname="QuestionsSurveyForm_OptionOtherValue_<?php echo $k."_".$i;?>">
                                <input maxlength="200" placeholder="<?php echo $rw; ?>" type="text" class="textfield textfieldtable" onblur="insertText(this.id)"  onkeyup="insertText(this.id)" name="OptionOtherValue_<?php echo $k; ?>" id="OptionOtherValue_<?php echo $i; ?>"  data-name="<?php echo $j ?>" data-col="<?php echo $j ?>" data-hiddenname="QuestionsSurveyForm_OptionTextValue_<?php echo $k."_".$i;?>" />
                                <div class="control-group controlerror">
                                <div style="display:none"  id="QuestionsSurveyForm_OptionTextValue_<?php echo $i; ?>_em_" class="errorMessage"></div>
                            </div>
                                    </div>
                            
                        <?php }else{ echo $rw; } ?></td>
                           
                            <?php 
                                 $ik = 0;  
                                 $totalOptions = $question['NoofOptions']+$question['AnyOther'];
                                 if($question['TextOptions'] ==1 || $question['TextOptions'] == 3) {
                                 for($j=1;$j<=($totalOptions);$j++){ ?>
                                    <?php if($optionsSize != $k || $question['AnyOther'] == 0){ ?>
                                    <td><div  class="positionrelative displaytable radioTable_<?php echo $j."_".$i; ?>" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                        <input type="radio" class="styled radiotype_<?php echo $i; ?>" name="ranking_<?php echo $k; ?>" id="rankingRadio_<?php echo $k; ?>" value="<?php echo $j;?>" data-name="<?php echo $j ?>" data-col="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>"/>
                                    </div></td>
                                    <?php }else{ ?>
                                    <td>
                                        <div  class="positionrelative displaytable radioTable_<?php echo $j."_".$i; ?>" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValueOther_<?php echo $k."_".$i;?>">
                                        <input type="radio" class="styled radiotype_<?php echo $i; ?>" name="ranking_<?php echo $k; ?>" id="rankingRadio_<?php echo $k; ?>" value="<?php echo $j;?>" data-name="<?php echo $j ?>" data-col="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValueOther_<?php echo $k."_".$i;?>"/>
                                    </div>
                                    </td>
                                    <?php } ?>
                                    
                                
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
                                
                                
                                 <?php }else if($question['TextOptions'] == 2){ 
                                     
                                     for($j=1;$j<=$question['NoofOptions'];$j++){ ?>
                                    <td><div  class="positionrelative surveydeleteaction radioTable_<?php echo $j."_".$i; ?>" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                            <input maxlength="<?php echo $question['TextMaxlength']; ?>"  type="text" class="textfield textfieldtable radiotype_<?php echo $k; ?> radiotypecol_<?php echo $j; ?> textoption_<?php echo $i; ?>" name="ranking_<?php echo $k; ?>" id="rankingRadio_<?php echo $k; ?>" data-row="<?php echo $k; ?>" data-col="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>"/>
                                    </div></td>
                                 <?php }  }?>
                                <?php if($question['Other'] == 1) { ?>
                                <!--<input type="hidden" name="QuestionsSurveyForm[OptionValue][<?php //echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValue_<?php //echo ($k."_".$i); ?>"/>-->
                                <td><div class="positionrelative displaytable radioTable_<?php echo $j; ?>" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                        <input type="radio" placeholder="" class="styled radiotype_<?php echo $i; ?>" name="ranking_<?php echo $k; ?>" id="otherradioranking_<?php echo $k; ?>" value="<?php echo $j;?>" data-name="<?php echo $j ?>"/>
                                </div></td>
                            <?php }
                                 if($question['TextOptions'] == 3){ ?>
                                <input class="questionOptionCommnetValue_<?php echo ($k."_".$i); ?>" type="hidden" name="QuestionsSurveyForm[OptionCommnetValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionCommnetValue_<?php echo ($k."_".$i); ?>"/>
                                        <td><div  class="positionrelative surveydeleteaction"   data-hidname="QuestionsSurveyForm_OptionCommnetValue_<?php echo $k."_".$i;?>">
                                                <input placeholder="<?php echo $question['JustificationPlaceholders'][$k-1]; ?>" maxlength="200" type="text" class="textfield textfieldtable" onblur="insertText(this.id)"  onkeyup="insertText(this.id)" name="OptionCommnetValue_<?php echo ($k."_".$i); ?>" id="OptionCommnetValue_<?php echo ($k."_".$i); ?>"  data-name="<?php echo $j ?>" data-col="<?php echo $j ?>" data-hiddenname="QuestionsSurveyForm_OptionCommnetValue_<?php echo $k."_".$i;?>" />
                                    </div></td>
                                <?php } ?>
                                </tr>
                                
                                
                        <?php $k++; }
                            
                                } ?>
                                
                        

                        </table>
                           </div>

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
//                        $("div.radioTable_<?php //echo $j."_".$i; ?> span.radio").each(function(){                                         
////                                                        $(this).attr("style","background-position:0 0");
//                                  if($(this).attr("style") == "background-position:0 0"){
//                                      $(".questionOptionhidden_<?php //echo ($k."_".$i); ?>").each(function(){
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
                    $(".surveydeleteaction").live("blur",function(){
                     var checkboxvalues = "";
                        $(".textoption_<?php echo $i; ?>").each(function(){
                            var $this = $(this);
                            if($this.val() != "" && $this.val() != 0){
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
         <?php } else if($question['QuestionType'] == 4){ //rating... ?>
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
           <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="4" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[Other][<?php echo ($i); ?>]" id="QuestionsSurveyForm_Other_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OtherValue][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_OtherValue_<?php echo ($i); ?>"/>
        
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>" />
                <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                    <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_OptionsSelected_<?php echo $i; ?>_em_" class="errorMessage"></div>                        
                    
                    <div class="surveyanswerarea surveyanswerviewarea">
                        <div class="paddingtblr30">
                           <div class="questionview"><div class="questionview_numbers"><?php echo $i; ?>)</div> <?php echo $question['Question']; ?></div>
                        <div class="answersection">
                       <div class="paddingtop12">
                        <div class="MR_view_table"> 
                        <table cellpadding="0" cellspacing="0" class="customsurvaytable customsurvaytableview">
                        <tr>
                        <th class=""></th>
                        <?php $labelsSize = $question['NoofRatings']; $lb =1; $rv = 1; foreach($question['LabelName'] as $rw){
                            ?>
                        
                            <th <?php if($question['StylingOption'] == 2){?> class="col2" <?php }?>>
                            <div><?php echo $rw; ?></div>
                            <?php if(isset($question['LabelDescription'][$lb-1]) && !empty($question['LabelDescription'][$lb-1])){ ?>
                                <div  class="info_color"> <?php echo $question['LabelDescription'][$lb-1]; ?></div>
                            <?php } ?>   
                                
                        </th>
                        <?php $lb++; } ?>
                            <?php if($question['Other'] == 1) { ?>
                                <th <?php if($question['StylingOption'] == 2){?> class="col2" <?php }?>>N/A</th>
                            <?php } ?>
                        </tr>
                        
                            <?php $k = 1;$anyOther = 0;$noofoptions=0;$optionsSize = sizeof($question['OptionName']);foreach($question['OptionName'] as $rw){ ?>
                    
                        <tr>
                            <?php if(trim($rw) != trim("")){ ?>
                            
                            <?php if($question['TextOptions'] != 2){ ?>
                                <?php if($optionsSize != $k || $question['AnyOther'] == 0){ ?>
                                    <input type="hidden" name="QuestionsSurveyForm[OptionValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValue_<?php echo ($k."_".$i); ?>" class="optionvalueclass_<?php echo $i; ?>"/>
                            <?php }else{ ?>
                                    <input class="optionvalueclass_<?php echo ($k."_".$i); ?>" type="hidden" name="QuestionsSurveyForm[OptionValueOther][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionValueOther_<?php echo ($k."_".$i); ?>"/>
                            <?php } ?>
                             <?php } ?>                                
                             
                            <td><?php if($optionsSize == $k && $question['AnyOther'] == 1){  ?>
                                <input type="hidden" name="QuestionsSurveyForm[OptionTextValue][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionTextValue_<?php echo ($k."_".$i); ?>" class="OptionTextValueclass_<?php echo $i; ?>" />
                            <div  class="positionrelative surveydeleteaction"   data-hidname="QuestionsSurveyForm_OptionOtherValue_<?php echo $k."_".$i;?>">
                                <input maxlength="200" placeholder="<?php echo $rw; ?>" type="text" class="textfield textfieldtable" onblur="insertText(this.id)"  onkeyup="insertText(this.id)" name="OptionOtherValue_<?php echo $k; ?>" id="OptionOtherValue_<?php echo $i; ?>"  data-name="<?php echo $j ?>" data-col="<?php echo $j ?>" data-hiddenname="QuestionsSurveyForm_OptionTextValue_<?php echo $k."_".$i;?>" />
                                <div class="control-group controlerror">
                                <div style="display:none"  id="QuestionsSurveyForm_OptionTextValue_<?php echo $i; ?>_em_" class="errorMessage"></div>
                            </div>
                                    </div>
                            
                        <?php }else{ echo $rw;} ?></td>
                                <?php 
                                    if($question['TextOptions'] ==1 || $question['TextOptions'] == 3) {
                                        for($j=1;$j<= $question['NoofRatings'];$j++){ ?>
                                        <?php if($optionsSize != $k || $question['AnyOther'] == 0){ ?>
                                        <td><div class="positionrelative displaytable radioRatingTable" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                        <input type="radio" class="styled radiotype_rat_<?php echo $i; ?>" name="rating_<?php echo $k; ?>" id="ratingRadio_<?php echo $k; ?>" value="<?php echo $j;?>" />
                                        </div></td>
                                        <?php }else if($optionsSize == $k && $question['AnyOther'] == 1){ ?>
                                         <td><div class="positionrelative displaytable radioRatingTable" data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValueOther_<?php echo $k."_".$i;?>">
                                        <input type="radio" class="styled radiotype_rat_<?php echo $i; ?>" name="rating_<?php echo $k; ?>" id="ratingRadio_<?php echo $k; ?>" value="<?php echo $j;?>" />
                                        </div></td>
                                        <?php }?>
                                            
                                        <?php }
                                        if($question['TextOptions'] == 3){ ?>
                                             
                                        <?php }
                                    }else if($question['TextOptions'] == 2){ $ratingsSize = $question['NoofRatings']; ?>
                                        <input type="hidden" name="QuestionsSurveyForm[OptionTextMValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionTextMValue_<?php echo ($k."_".$i); ?>" class="optionvalueclass_<?php echo $i; ?>"/>
                                    
                                    
                                   
                                         <?php  for($j=0;$j<$question['NoofRatings'];$j++){ ?>
                                    <?php if($optionsSize != $k  || $question['AnyOther'] == 0){ ?>
                                    <td>
                                       
                                        <div  class="positionrelative surveydeleteaction " data-optionid="<?php echo $k; ?>" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                            <input type="text" onkeyup="allowNumericsAndCheckFields(event,this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>');updateTextRadiohiddenFields(this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>','<?php echo $question['TextMaxlength']; ?>')"  onkeydown="allowNumericsAndCheckFields(event,this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>');updateTextRadiohiddenFields(this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>','<?php echo $question['TextMaxlength']; ?>')" class="textfield textfieldtable questionType4_matrix_<?php echo $i; ?>"  name="QuestionsSurveyForm[TextOptionValues][<?php echo ($rv."_".$j."_".$i); ?>]"  onblur="updateTextRadiohiddenFields(this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>','<?php echo $question['TextMaxlength']; ?>')"/>
                                    </div>
                                    
                                        </td>
                                    <?php }else if($optionsSize == $k && $question['AnyOther'] == 1){?>
                                        <td>
                                       
                                        <div  class="positionrelative surveydeleteaction ">
                                        <input class="optionvalueclass_<?php echo ($k."_".$i); ?> textfield textfieldtable"  type="text" name="QuestionsSurveyForm[OptionMatrixValueOther][<?php echo ($rv."_".$j); ?>]"   id="QuestionsSurveyForm_OptionValueOther_<?php echo ($k."_".$i); ?>" onkeyup="allowNumericsAndCheckFields(event,this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>');updateTextRadiohiddenFields(this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>','<?php echo $question['TextMaxlength']; ?>')"  onkeydown="allowNumericsAndCheckFields(event,this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>');updateTextRadiohiddenFields(this,'<?php echo $k; ?>','<?php echo $i; ?>','<?php echo $j; ?>','<?php echo $question['TextMaxlength']; ?>')"/>
                                        </div>
                                        </td>
                                    <?php } ?>
                                        
                                 <?php } $rv++; }?>
                                
                               
                                
                                <?php if($question['Other'] == 1) { ?>
                                <td><div class="positionrelative displaytable radioRatingTable" data-name="<?php echo $j ?>" data-hidname="QuestionsSurveyForm_OptionValue_<?php echo $k."_".$i;?>">
                                 <input type="radio" class="styled radiotype_rat_<?php echo $i; ?>" name="rating_<?php echo $k; ?>" id="ratingRadio_<?php echo $k; ?>" value="<?php echo $j;?>"/>
                                </div></td>
                            <?php } 
                                if($question['TextOptions'] == 3){ ?>
                                <input class="questionOptionCommnetValue_<?php echo ($k."_".$i); ?>" type="hidden" name="QuestionsSurveyForm[OptionCommnetValue][<?php echo ($k."_".$i); ?>]"   id="QuestionsSurveyForm_OptionCommnetValue_<?php echo ($k."_".$i); ?>"/>
                                        <td><div  class="positionrelative surveydeleteaction"   data-hidname="QuestionsSurveyForm_OptionCommnetValue_<?php echo $k."_".$i;?>">
                                                <input placeholder="<?php echo $question['JustificationPlaceholders'][$k-1]; ?>" maxlength="200" type="text" class="textfield textfieldtable" onblur="insertText(this.id)"  onkeyup="insertText(this.id)" name="OptionCommnetValue_<?php echo ($k."_".$i); ?>" id="OptionCommnetValue_<?php echo ($k."_".$i); ?>"  data-name="<?php echo $j ?>" data-col="<?php echo $j ?>" data-hiddenname="QuestionsSurveyForm_OptionCommnetValue_<?php echo $k."_".$i;?>" />
                                    </div></td>
                                <?php } ?>
                                </tr>
                            <?php $k++; $m++; } 
                            
                                } ?>
                                

                        </table>
                               
                           </div>

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
             $(".surveydeleteaction").live("blur",function(){
                     var checkboxvalues = ""; 
                        $(".textoption_<?php echo $i; ?>").each(function(){
                            var $this = $(this);
                            if($this.val() != "" && $this.val() != 0){
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="5" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[OptionsSelected][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_OptionsSelected_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[TotalCalValue][<?php echo ($i); ?>]"   id="QuestionsSurveyForm_TotalCalValue_<?php echo ($i); ?>"/>
         <input type="hidden" name="QuestionsSurveyForm[Other][<?php echo ($i); ?>]" id="QuestionsSurveyForm_Other_<?php echo ($i); ?>" />
         <input type="hidden" name="QuestionsSurveyForm[OtherValue][<?php echo ($i); ?>]"  id="QuestionsSurveyForm_OtherValue_<?php echo ($i); ?>" />
                <div class="surveyquestionsbox"  data-questionId="<?php echo $question['QuestionId']; ?>" data-questionno="<?php echo $i; ?>">
                    <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_TotalCalValue_<?php echo $i; ?>_em_" class="errorMessage"></div> 
                    <div class="alert alert-error" style="display:none"  id="QuestionsSurveyForm_OptionsSelected_<?php echo $i; ?>_em_" class="errorMessage"></div> 
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
                     <input type="text" class="textfield span12 distvalue_<?php echo $i; ?>" id="QuestionsSurveyForm_DistValue_<?php echo $k."_".$i; ?>" data-hiddenname="QuestionsSurveyForm_DistValue_hid_<?php echo $k."_".$i; ?>" onkeyup="insertText(this.id);" onblur="insertText(this.id);updateValues(this,'<?php echo $i; ?>')" onkeydown="allowNumerics(event,this,'<?php echo $i; ?>')">
                     </div>
                     </div>

                     </div>
                     </div>

                    </div>

                    </div>
                           <?php $k++;} ?>
                        <?php if($question['Other'] == 1){ ?>
                           <input type="hidden" name="QuestionsSurveyForm[DistValue][<?php echo ($k."_".$i); ?>]" id="QuestionsSurveyForm_DistValue_hid_<?php echo ($k."_".$i); ?>" />
                           <div class="answersection">
                             <div class="normalsection">                            
                             <div class="row-fluid">
                            <div class="span6">
                                <div class="surveyradiobutton top3"><?php echo $k; ?>)</div>
                                <div class="answerview"><input  type="text" class="textfield span4" placeHolder="<?php echo $question['OtherValue'];?>"  id="othervalue_<?php echo ($i); ?>" data-hiddenname="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>"  onkeyup="insertText(this.id)" onblur="insertText(this.id)" /></div>
                                <div class="control-group controlerror">
                                <div style="display:none"  id="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>_em_" class="errorMessage"></div>
                            </div>
                            </div>
                                 <div class="span2 total" data-num="<?php echo $question['TotalValue']; ?>">
                                <div class="positionrelative pricetype">
                                <div class="percentdiv"><?php if( $question['MatrixType'] == 1) echo "%"; else echo "$";?> </div>
                                <input type="text" class="textfield span12 distvalue_<?php echo $i; ?>" id="QuestionsSurveyForm_DistValue_<?php echo $k."_".$i; ?>" data-hiddenname="QuestionsSurveyForm_DistValue_hid_<?php echo $k."_".$i; ?>" onkeyup="insertText(this.id);" onblur="insertText(this.id);updateValues(this,'<?php echo $i; ?>')" onkeydown="allowNumerics(event,this,'<?php echo $i; ?>')" >
                                </div>
                                </div>
                            </div>
                            </div>
                               </div>
                         <?php } ?>
                    </div>
                    </div>
                    </div>
         
                
         <?php $this->endWidget(); ?>
                    <script type="text/javascript">
                    function updateValues(obj,qno){
                        var totalvalue = $.trim($("#"+obj.id).closest('div.total').attr("data-num"));
                        var calValue = 0;
                        $(".distvalue_"+qno).each(function(){
                           var $this = $(this);
                           calValue = calValue+Number($this.val());
                        });
                        $("#QuestionsSurveyForm_OptionsSelected_"+qno).val(calValue);
                        if(calValue == totalvalue ){
                            $("#QuestionsSurveyForm_TotalCalValue_"+qno).val(calValue);
                            
                        }else{
                             $("#QuestionsSurveyForm_TotalCalValue_"+qno).val("");                             
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="6" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
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
        <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="7" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
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
         <?php } else if($question['QuestionType'] == 8){ ?>             
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

                    <input type="hidden" name="QuestionsSurveyForm[WidgetType][<?php echo ($i); ?>]" value="1" id="QuestionsSurveyForm_WidgetType_<?php echo ($i); ?>"/>
                    <input type="hidden" name="QuestionsSurveyForm[QuestionId][<?php echo ($i); ?>]"  value="<?php echo $question['QuestionId']; ?>"/>
                    <input type="hidden" name="QuestionsSurveyForm[OtherJustification][<?php echo ($i); ?>]" id="QuestionsSurveyForm_Other_<?php echo ($i); ?>" />
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
                             <div class="surveyradiobutton confirmation_<?php echo ($i); ?>" data-questionid="<?php echo ($i); ?>" data-stype="<?php echo $question['SelectionType']; ?>" data-optionid="<?php echo ($j."_".$i); ?>" data-value="<?php echo ($j); ?>"> 
                                 <?php if($question['SelectionType'] == 1){ ?>
                                 <input value="<?php echo ($j); ?>" type="radio" class="styled " name="radio_<?php echo $i;?>" id="optionradio_<?php echo $j."_".$i;?>">
                                 <?php }else{ ?>
                                 <input value="<?php echo ($j); ?>" type="checkbox" class="styled " name="checkbox_<?php echo ($i);?>" id="optioncheckbox_<?php echo $j."_".$i;?>">
                                 <?php } ?>
                             </div>
                         <div class="answerview"><?php echo $rw; ?></div>
                        </div>
                      <?php $j++; } ?>
                         <div class="normaloutersection">
                            <div class="normalsection normalsection5">

                                <div class="row-fluid booleanwidget_<?php echo ($i); ?>"  id="rowfluidChars_<?php echo ($i); ?>" style="display:none">
                                    <div class="span12">                               
                                        <textarea placeholder="<?php echo $question['OtherValue']; ?>" class="span12" id="qAaTextarea_<?php echo ($i); ?>" data-hiddenname="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>"  onkeyup="insertText(this.id)" onblur="insertText(this.id)"></textarea>  
                                        <div class="control-group controlerror">
                                            <div style="display:none"  id="QuestionsSurveyForm_OtherValue_<?php echo $i; ?>_em_" class="errorMessage"></div>
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
         <script type="text/javascript">
                  $(".confirmation_<?php echo ($i); ?>").die().live('click',function(){                                   
                      var oid = $(this).attr("data-optionid");
                      var val = $(this).attr("data-value");
                      var value = "";
                      var stype = $(this).attr("data-stype");
                      var justf = '<?php echo $question['Justification']; ?>';
                      var qId = $(this).attr("data-questionid");                      
                      if(stype == 1){
                         value = $("#optionradio_"+oid).val();                         
                         $("#QuestionsSurveyForm_OptionsSelected_"+qId).val(value);
                         if(val == justf){                          
                            $("#QuestionsSurveyForm_Other_"+qId).val(1);
                            $("#rowfluidChars_"+qId).show();
                        }else{                            
                            $("#rowfluidChars_"+qId).hide();                            
                            $("#QuestionsSurveyForm_Other_"+qId).val("");
                        }
                         
                      }                    
                  });
                  var charray = new Array();
                  $(".surveyradiobutton").unbind('click').bind('click',function(){                      
                            var checkboxvalues = "";
                             
                             var oid = $(this).attr("data-optionid");
                        var val = $(this).attr("data-value");
                        var value = "";
                        var stype = $(this).attr("data-stype");
                        var justf = '<?php echo $question['Justification']; ?>';
                        var qId = $(this).attr("data-questionid");
                            //charray[ind++] = val;
                            //charray.push(val);
                           
                            $("input[name='checkbox_"+qId+"']").each(function(key, value) {
                                var $this = $(this);    
                                
                                  if($this.is(":checked")){                                
                                      if(checkboxvalues == ""){
                                          checkboxvalues = $this.val();
                                          charray[key] = $this.val();
                                      }else{
                                          if(checkboxvalues.search($this.val()) < 0){
                                              checkboxvalues = checkboxvalues+","+$this.val();
                                              charray[key] = $this.val();
                                          }

                                      }                                
                                  }else{
                                      checkboxvalues = checkboxvalues+",0";
                                      charray[key] = 0;
                                  }                                  

                              });
                              
                            if(stype == 2){ 
                                $("#QuestionsSurveyForm_OptionsSelected_"+qId).val(checkboxvalues);
                                if($.inArray(justf, charray ) >= 0 ){                                
                                  $("#rowfluidChars_"+qId).show();
                                  $("#QuestionsSurveyForm_Other_"+qId).val(1);
                                }else{

                                    $("#rowfluidChars_"+qId).hide();
                                    $("#QuestionsSurveyForm_Other_"+qId).val("");
                                }
                            }

                        });
                  
          </script>
         <?php }
     $i++;} ?>
     
     
     
  

<script type="text/javascript">
Custom.init();
var qCount = '<?php echo sizeof($surveyObj->Questions); ?>';
sessionStorage.globalSurveyFlag =1; 
</script>
<script type="text/javascript">
    function allowNumerics(e,obj,qno){       
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
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
            var options = "";
        $("#submitQuestion").live("click",function(){ 
            $(".errorMessage").hide();
            $(".alert-error").each(function(){
                    $(this).hide()
                 });
             for(var i =1; i<=qCount;i++){                 
                var widtype = $("#QuestionsSurveyForm_WidgetType_"+i).val();
        var isMandatory = $("#QuestionsSurveyForm_IsMadatory_"+i).val(); 
                //alert("isValidated=="+isValidated+"=isValidate="+isValidate+"==qCount==="+qCount+"=i=="+i)
                if(isMandatory == 1){
                    ValidateQuestions(i, qCount);
                }else{
//                    if(widtype == 3 || widtype == 4 ){                       
//                       options = $("#QuestionsSurveyForm_OptionsSelected_"+i).val();
//                       if(options != "" && options != 0){                           
//                            ValidateQuestions(i, qCount);
//                        }else{
//                            Garray[i - 1] = $("#questionviewWidget_"+i).serialize();
//                        }
//                        if(isValidate <= qCount){
//                            isValidate++;      
//                        }
//                    }
                       if($(".booleanwidget_"+i).is(":visible")){
                           ValidateQuestions(i, qCount);
                       }else if($.trim($("#QuestionsSurveyForm_OptionsSelected_"+i).val()) != "" && $("#QuestionsSurveyForm_OptionsSelected_"+i).val() ){
                               ValidateQuestions(i, qCount);                               
                        } else{
                           
                            Garray[i - 1] = $("#questionviewWidget_"+i).serialize();
                            if(isValidate <= qCount){
                                isValidate++;      
                            }                                                                                

                             if(isValidate == qCount){ 
                                isValidated = true;
                                saveAnswersForQuestions();
                            } 
                        }

                    }
               
                                    
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
                async: false,
                success: function(data) {
                    var data = eval(data);                    
                     
                     if (data.status == 'success') {
                            if(isValidate <= qCount){
                               isValidate++;      
                           }
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
             scrollPleaseWaitClose('surveyviewspinner');
            if (data.status == 'success') {                
                if(isValidate == qCount){ 
                    isValidated = true;
                    saveAnswersForQuestions();
                }
                

            } else {      
                 scrollPleaseWaitClose('surveyviewspinner');
                isValidate = 0; 
                isValidated = false;
                var error = [];
                if (typeof (data.error) == 'string') {

                    var error = eval("(" + data.error.toString() + ")");

                } else {
                    var error = eval(data.error);
                }
                $.each(error, function(key, val) {                       
                        var strArr = key.split("_");
                        if($.trim(strArr[1]) == "OptionValue"){                            
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").text("Please fill all the fields");
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").show();
                           // $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").fadeOut(9000);
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").addClass('error');                         
                        } else if($.trim(strArr[1]) == "TextOptionValues"){                            
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[4]+"_em_").text("Please fill all the fields");
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[4]+"_em_").show();
                           // $("#QuestionsSurveyForm_OptionsSelected_"+strArr[3]+"_em_").fadeOut(9000);
                            $("#QuestionsSurveyForm_OptionsSelected_"+strArr[4]+"_em_").addClass('error');
                            
                        }else if ($("#" + key + "_em_")) {                            
                            $("#" + key + "_em_").text(val);
                            $("#" + key + "_em_").show();
                          //  $("#" + key + "_em_").fadeOut(9000);
                            $("#" + key).parent().addClass('error');
                        }



                });
            }
        }
        
        function saveAnswersForQuestions(){
           // scrollPleaseWait("extededsurvey_spinner");
            $("#QuestionsSurveyForm_Questions").val(JSON.stringify(Garray));
            var data = $("#questionviewwidget").serialize(); 
            
            //alert("isValidated=="+isValidated+"=isValidate="+isValidate+"==qCount==="+qCount)
            if(isValidated == true){
                isValidate = 0;
                isValidated = false;
                $.ajax({
                    type: 'POST',
                    url: '/outside/validateSurveyAnswersQuestion',
                    data: data,
                    success: function(data) {                    
                        scrollPleaseWaitClose('surveyviewspinner');                                   
                        if(data != "error"){
                            $("#surveysubmitbuttons").hide();     
                            $("#surveyQuestionArea").html(data);
                        }else{
                            $("#userviewErrMessage").text("Please choose at least one survey");
                            $("#userviewErrMessage").show();
                            $("#userviewErrMessage").fadeOut(100000,function(){
                                $("#userviewErrMessage").hide();
                            });                        
    //                        $('body, html').animate({scrollTop : 0}, 800,function(){});
                        }
                        setTimeout(setIframeHeightInSurveySubmit,500);
                    },
                    error: function(data) { // if error occured
                        //alert(data.toSource())
                    },
                    dataType: 'html'
                });
            }else {
                isValidate = 0;
                $("#userviewErrMessage").text("Please choose at least one survey");
                $("#userviewErrMessage").show();
                $("#userviewErrMessage").fadeOut(100000,function(){
                    $("#userviewErrMessage").hide();
                });                        
            }
        }
        function SaveSurveyAnswers(){
            
        }
        function setIframeHeightInSurveySubmit(){
            var innerheight=1074;
            try{               
                
                var surveysubmitiframe = parent.document.getElementById("surveryId_iframe"),
                surveysubmitiframeWindow;
                surveysubmitiframeWindow = surveysubmitiframe.contentWindow || surveysubmitiframe.contentDocument.parentWindow;
                if(surveysubmitiframeWindow.document.body.offsetHeight != undefined && surveysubmitiframeWindow.document.body.offsetHeight != 'null'){
                    innerheight = surveysubmitiframeWindow.document.body.offsetHeight;
                    if(surveysubmitiframeWindow.document.body.offsetHeight <= 100){
                        innerheight = 306;
                    }
                }
                innerheight = Number(innerheight)+150;
                parent.document.getElementById("surveryId_iframe").setAttribute("style","height:"+innerheight+"px");
                var parentHeight = Number(innerheight)+100;
                parent.parent.document.getElementById("myIframeContent").setAttribute("style","height:"+parentHeight+"px");
//                parent.document.getElementById("surveyQuestionli").style.display = 'none';
//                parent.document.getElementById("sResults").className = 'active';          
                parent.document.getElementById("surveyQuestionli").className = 'active'; 
            }catch(err){

            }
        }
        function allowNumericsAndCheckFields(e,obj,rno,qno,col){       
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
    
//    var value = obj.value;
//            $("#QuestionsSurveyForm_OptionValue_"+rno+"_"+qno).val(value);    
//            $(".radiotype_"+rno).each(function(){
//               if($(this).val() != value) {
//                   $(this).val("");
//               }
//            });
//            
//            $(".radiotypecol_"+col).each(function(){
//               if($(this).val() != value) {
//                   $(this).val("");
//               }
//            });
    function updateTexthiddenFields(obj,rno,qno,col){
        var value = obj.value;        
        $("#QuestionsSurveyForm_OptionValue_"+rno+"_"+qno).val(value);    
        $(".radiotype_"+rno).each(function(){
           if($(this).val() != value) {
               $(this).val("");
           }
        });

        $(".radiotypecol_"+col).each(function(){
           if($(this).val() != value) {
               $(this).val("");
           }
        });
    }
    var str = "";
    function updateTextRadiohiddenFields(obj,rno,qno,col,maxValue){
        var value = obj.value;    
        
        if(Number(value) < 1 || Number(value) > maxValue ){            
            obj.value = "";
        }else{
                if(value != ""){
                    $("#QuestionsSurveyForm_OptionsSelected_"+qno).val(value);
                }else{
                    var cnt=0;
                    $(".questionType4_matrix_"+qno).each(function(){
                       var $this = $(this);
                       if($this.val() != ""){
                          cnt++; 
                      }
                    });

                    if(cnt == 0){
                        $("#QuestionsSurveyForm_OptionsSelected_"+qno).val("");
                    }
                }
        }
        
    }
    function checkFieldValue(obj,maxValue){        
        if(Number(obj.value) < 1 || Number(obj.value) > maxValue){            
            obj.value = "";
        }
    }

   
         $("#submitQuestion").show();

    </script>
    <script type="text/javascript">
         if("" != "<?php echo $spotMessage?>"){
           $("#spotCount").html("<?php echo $spotMessage?>");
           $(".spotMessage").show();  
        }
      var loginUserId = '<?php echo $this->tinyObject->UserId; ?>';
    var socketSurvey = io.connect('<?php echo Yii::app()->params['NodeURL']; ?>');
    var scheduleId = "<?php echo $scheduleId; ?>";
       pF1 = 1;
      ObjectA = {PF1:pF1,PF2:pF2,sCountTime:nodeSurveyTime,uniquekey:sessionStorage.old_key,pageName:"survey"};
       var jsonObject = JSON.stringify(ObjectA); 
    socketSurvey.emit('connectToSurvey', loginUserId,scheduleId,jsonObject);
     socketSurvey.on('connectToSurveyResponse', function(data) {
           data = eval("(" + data + ")");
           var userId = data.loginUserId;
           sessionStorage.userId = userId;
           sessionStorage.scheduleId = data.scheduleId;
        // alert(loginUserId.spotMessage);
           $("#spotCount").html(data.spotMessage);
           $(".spotMessage").show();
         ajaxRequest("/user/checkSession","",function(){}); 
        });
        
         function unsetSpotFromNode(){
        socketSurvey.emit('unsetSpotforSchedule', sessionStorage.userId,sessionStorage.scheduleId );
    }
    sessionStorage.scheduleId = "<?php echo $scheduleId; ?>"
    </script>


  <?php       }else{echo $errMessage; }
?>  