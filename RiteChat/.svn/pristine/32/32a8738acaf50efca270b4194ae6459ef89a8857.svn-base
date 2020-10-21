<?php 
if(is_object($surveyObj)){  ?>
<div class="padding10ltb">
    
     
     <div class="row-fluid">
         <div class="span12">
             <div class="span7"><h2 class="pagetitle">Market Research</h2></div>
             <div class="span4">
                 <div class="pull-right">
                 <div class="networkmode" data-surveyid="<?php echo $surveyObj->_id; ?>" data-groupname="<?php echo $surveyObj->SurveyRelatedGroupName; ?>"> <!-- This id firstStop is used for Joyride help -->
                   <input type="checkbox" id="analyticsswitch" data-on-label="Schedule Level" data-off-label="Group Level" />
                </div>
                 </div>
             </div>
             <div class="span1">
                 <div class="grouphomemenuhelp alignright tooltiplink"> <a  id="detailed_close_page_survey" class="detailed_close_page" rel="tooltip"  data-original-title="close" data-placement="bottom" data-toggle="tooltip"> <i class="fa fa-times"></i></a> </div>
             </div>
         </div>
     </div>   
    <div class="market_profile marginT10">
        
	<div class="m_profileicon">
            
            <div class="marginzero smallprofileicon largeprofileicon noBackGrUp">
                            
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
        
               <div class="row-fluid">
            <div class="span12">
                <div class="span4" id="schedule_dates"><span class="g_scheduleDate g_scheduleDateGameWall s_scheduleDateGameWall"><?php echo $sdate; ?></span> </div>
                <div class="span8">
                    <div class="media-status_survey">
                    <ul>
                        <li><div class="statusminibox extquestionscount">
                                <span><?php echo $surveyObj->QuestionsCount; ?></span>
                            </div>
                            </li>
                             <li><div class="statusminibox extuserscount">
                               <span><?php echo $surveyedCount; ?></span>
                            </div></li>
                    </ul></div>
                </div>
                
          </div> 
        </div>            
    
     </div>
     
     
     <div class="row-fluid groupseperator border-bottom">
     <div class="span12 "><h2 class="pagetitle paddingleft5">Market Research Survey </h2></div>
     </div>
     <div id="surveyviewspinner" style="position:relative;"></div>
     
     
     <div class="padding152010" style="">
        <?php $i = 1; foreach($surveyObj->Questions as $question){ ?>
     <div class="surveyquestionsbox">
      
     <div class="surveyareaheader surveyareaheader_analytics" >
         <div class="s_analytics_numbers"> <?php echo "$i)"; ?></div>
         <div id="spinner_analytics_<?php echo $i; ?>" class="positionrelative" ></div>
            <div class="s_analytics_question" id="quesiton_<?php echo $i; ?>"><?php echo $question['Question']; ?></div>   
          <div class="s_analyticsexport">
              <ul class="anlt_datepic liststylenone" >
              <li style="cursor:pointer; position: relative" class="dropdown analytics_export_opt">
                                    <a data-original-title="Advanced Options" rel="tooltip" data-placement="bottom" class="tooltiplink analytics_export " data-toggle="dropdown" id="drop2"><i><img src="/images/system/spacer.png" ><span class="fa fa-caret-down"></span></i></a>

                                    <div class="dropdown-menu analytics_export_div">

                                        <ul>

                                            <li class="" ><a onclick="openAnalyticspdf(this,'<?php echo $question['QuestionType']; ?>','<?php echo $i;?>')"  target="_blank"  id="ActivityPdf" name="ActivityPdf"><i><img src="/images/system/spacer.png"  class="pdf_doc"></i> Export as PDF</a></li>
                                            <li class="" ><a data-groupname="<?php echo $surveyObj->SurveyRelatedGroupName; ?>" data-surveyid="<?php echo $surveyObj->_id; ?>" data-questiontype="<?php echo $question['QuestionType']; ?>" data-scheduleid="<?php echo $scheduleId; ?>" data-questionid="<?php echo $question['QuestionId']; ?>" id="genereateXls" style="cursor:pointer" ><i><img src="/images/system/spacer.png" class="excel_doc"></i> Export as Excel</a></li>

                                        </ul>

                                    </div>
                                  </li>
              </ul>
          </div>
          
    
     </div>
     <div class="surveyanswerarea">
     <div class="paddingtblr1030">
     
     <div class="tab_1">
         <div class="row-fluid">
             <div class="span8">
                 <div class="answersection1 answersection1analytics" >
                    <div id="surveyChart_<?php echo $i; ?>" style='height: 400px;'></div>
                </div>
             </div>
             <?php if ($question['QuestionType'] != 3 && $question['QuestionType'] != 4){ ?>
             <div class="span4">
                 <div class="customtable">
                     <div class="customheader">
                         <div class="customcolumns"> Answer choices</div>
                          <div class="customcolumns"> Responses</div>
                          <div class="customcolumns">  </div>
                         
                     </div>
                     <div id="table_row_<?php echo $i; ?>" class="customgroup">
                     
                    </div>
                     
                      <div class="customrowsfooter" id="table_footer_<?php echo $i; ?>">
                        
                     </div>
                    
                 </div>
             </div>
             <?php } ?>
         </div>
         <?php if ($question['QuestionType'] == 3 || $question['QuestionType'] == 4){ ?>
         <div class="row-fluid padding8top">
             <div class="span8">
                 <div class="customtable customtable_ratrank">
                     <div class="customheader" id="table_head_<?php echo $i; ?>">
                        
                         
                     </div>
                     <div  class="customgroup" id="table_tr_<?php echo $i; ?>">
                     
                    </div>
                     
                      
                    
                 </div>
             </div>
         </div>
         <?php } ?>
     
     
     
     </div>
     </div>
     </div>
          
     </div>
     <?php $i++;} ?>  
     </div>
     
</div>
     <script type="text/javascript">         
         $("#surveysubmitbuttons").hide();   
         $('#analyticsswitch').bootstrapSwitch();
         $('#analyticsswitch').bootstrapSwitch('setState', true);
         $('label[for=analyticsswitch]').text("Group Level");
         $('#analyticsswitch').on('switch-change', function(e, data) {
            var groupName = $(this).closest("div.networkmode").attr("data-groupname");   
            var surveyId = $(this).closest("div.networkmode").attr("data-surveyid");
               var switchedValue = data.value ? 1 : 0;
               if (switchedValue == 1) {
                   $('label[for=analyticsswitch]').text("Group Level");
               } else {
                   $('label[for=analyticsswitch]').text('Schedule Level');
               }
               var scrollTp = $(window).scrollTop();
                scrollTp = Number(scrollTp);                
                $("#surveyviewspinner").css("top",scrollTp);
               loadSurveyAanlyticsByLevel(switchedValue,groupName,surveyId);

         });
        function loadSurveyAanlyticsByLevel(flag,gpName,surveyId){
            var queryString = "flag="+flag+"&groupName="+gpName+"&surveyId="+surveyId;     
            
            scrollPleaseWait('surveyviewspinner');
            if(flag == 0)
                ajaxRequest("/extendedSurvey/surveyAnalyticsByGroupName",queryString,loadSurveyAanlyticsByLevelHandler);
            else {
                ajaxRequest("/extendedSurvey/surveyAnalytics","ScheduleId=<?php echo $scheduleId; ?>&userId=<?php echo $userId; ?>",surveyAnalticsHandler);
                
                $("#schedule_dates").html('<span class="g_scheduleDate g_scheduleDateGameWall s_scheduleDateGameWall"><?php echo $sdate; ?></span>');
            }
        }
        
        function loadSurveyAanlyticsByLevelHandler(data){
//            alert(data.data.toSource())
            surveyAnalticsHandler(data.data);
            
            var sdatee = data.sdates;
            var htmlstr = "";
            for(var i=0; i<sdatee.length;i++){
                
                htmlstr += '<span class="g_scheduleDate g_scheduleDateGameWall s_scheduleDateGameWall">'+sdatee[i]+'</span>'
            }
            $("#schedule_dates").html(htmlstr);
        }

     </script>
     <script type="text/javascript">         
ajaxRequest("/extendedSurvey/surveyAnalytics","ScheduleId=<?php echo $scheduleId; ?>&userId=<?php echo $userId; ?>",surveyAnalticsHandler);
function surveyAnalticsHandler(data){ 
//    alert(data.toSource())
    scrollPleaseWaitClose('surveyviewspinner');
     var inc = 1;   
     var colorArray = ['#b87333','silver','gold','#e5e4e2']

             $.each(data.Questions, function(key, value) {
                  var userAnnotationArray = value.UserAnnotationArray;
                  var htmlstroption = "";
                  var htmlstrvaluep = "";
                  var htmltrovalue = " ";
                  var htmlstrcnt = "";
                  var totalvalue = 0;
                 $("#allchartsmaindiv").append("<div id='surveyChart" + key + "' style='height: 500px;'></div>");
                 if (value.QuestionType == 1 || value.QuestionType == 2 || value.QuestionType == 5) {
                     var dataArray = new Array();
                     dataArray.push(['Element', 'Percentage', {role: 'style'}, {role: 'tooltip'},{role: 'annotation'}]);
                     //alert(value.OptionsNewArray);
                     var colorArrayIndex = 0;
                     
                     $.each(value.OptionsPercentageArray, function(key1, value1) {
//                         alert(key1+"==="+value1+"==="+value.OptionsNewArray[key1])
                        var substr = key1.substr(0, 30);
                        if(key1.length > 30){
                            substr += "...";
                        }
                        htmlstroption += '<div class="customrows" >'+
                                            '<div class="customcolumns">'+substr+'</div>'+
                                            '<div class="customcolumns">'+value1+'%</div>'+
                                            '<div class="customcolumns">'+value.OptionsNewArray[key1]+'</div>'+
                                            '</div>';
                                    totalvalue += Number(value.OptionsNewArray[key1]);
//                        htmlstrvaluep += '<div class="customcolumns">'+value1+'</div>';
                        
                         key1 = "" + key1 + "";
                        
                         //if(key1 != "Other value "){
                         var annotation = '';
                         if(userAnnotationArray.indexOf(key1)>=0 && value1>0){
                             annotation = '*';
                         }                         
                         var newarray = [key1, value1, colorArray[colorArrayIndex], "Value:" + value.OptionsNewArray[key1],annotation];
                         dataArray.push(newarray);
                         //  }

                         colorArrayIndex++;
                     });

                     var data = google.visualization.arrayToDataTable(dataArray);
                     var options = {
                         //title: value.Question,
                         legend: 'none',
                         hAxis: {format: '#\'%\''},
                           annotations:{
                              alwaysOutside:true,
                             textStyle: {
                                  fontName: 'Times-Roman',
                                  fontSize: 18,
                                  bold: true,
                                  italic: true,
                                  color: 'red',     // The color of the text.
                                  auraColor: 'red', // The color of the text outline.
                                  opacity: 0.8          // The transparency of the text.
                            }
                          }

                     };
                     
                        $("#table_row_"+inc).html(htmlstroption);
                        $("#table_footer_"+inc).html('<div class="customcolumns">Total</div><div class="customcolumns"></div><div class="customcolumns">'+totalvalue+'</div>');
                 }else if(value.QuestionType == 3 || value.QuestionType == 4){ 
      var userSelectedOptionsArray = value.userSelectedOptionsArray;
      //userSelectedOptionsArray[userId]
      var dataArray = new Array();
      //var labelArray = new Array();
      var labelArray =  new Array();
      labelArray.push('Genre');
      htmlstroption = '<div class="customcolumns" > </div>';
       $.each(value.LabelName, function( key, value ) {
            htmlstroption += '<div class="customcolumns" >'+value+'</div>';
           labelArray.push(value);
            labelArray.push({ role: 'tooltip' });
             labelArray.push({ role: 'annotation' });
       });
       htmlstroption += '<div class="customcolumns" >Total</div><div class="customcolumns" >Avg</div>';
       dataArray.push(labelArray);
     
      //alert(dataArray);
      var i=0;
      htmltrovalue = '';
        $.each(value.OptionsPercentageArray, function( key1, value1 ) {
             var substr = key1.substr(0, 30);
                        if(key1.length > 30){
                            substr += "...";
                        }
                        htmltrovalue += '<div class="customrows" ><div class="customcolumns">'+substr+'</div>';
                                        
//                         htmlstroption += '<div class="customrows" >'+
//                                            '<div class="customcolumns">'+substr+'</div>'+
//                                            '<div class="customcolumns">'+value1+'%</div>'+
//                                            '<div class="customcolumns">1</div>'+
//                                            '</div>';
              key1 = ""+key1+"";
             var selectedOption =  userSelectedOptionsArray[i];
            var newarray = new Array();
              newarray.push(key1); 
              var j=1;
             var totalValue = 0; 
             var avg = 0;
             $.each(value1, function( k, v ) {
                 totalValue += value.OptionsNewArray[key1][k];
                 htmltrovalue += '<div class="customcolumns">'+v+'</div>';
                 var annotation;
                 if(j == selectedOption){
                     annotation = "*";
                 }else{
                    annotation = ""; 
                 }
               newarray.push(v);
               
               newarray.push("Value:"+value.OptionsNewArray[key1][k]);
                newarray.push(annotation);
                j++;
            });
            avg = Number(totalValue/(j-1));
               htmltrovalue += '<div class="customcolumns">'+totalValue+'</div>'+
                       '<div class="customcolumns">'+avg+'</div>'
               htmltrovalue += "</div>";
               dataArray.push(newarray); 
           
            i++;  
         });


var data = google.visualization.arrayToDataTable(dataArray);
      var options = {
        //title: value.Question,
        width: 600,
        height: 400,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true,
         hAxis: {format:'#\'%\''},
          annotations:{
                              alwaysOutside:true,
                             textStyle: {
                                  fontName: 'Times-Roman',
                                  fontSize: 18,
                                  bold: true,
                                  italic: true,
                                  color: 'red',     // The color of the text.
                                  auraColor: 'red', // The color of the text outline.
                                  opacity: 0.8          // The transparency of the text.
                            }
                          }
      };
      
      $("#table_head_"+inc).html(htmlstroption);
      $("#table_tr_"+inc).html(htmltrovalue);
 }
 else if(value.QuestionType == 6 || value.QuestionType == 7){ 
     
     
     
     var dataArray = new Array();
       dataArray.push(['Task', 'Hours per Day']);
         //alert(value.OptionsNewArray);
       totalvalue = 0;
       $.each(value.OptionsPercentageArray,function(k,v){
           
           htmlstroption += '<div class="customrows" >'+
                                            '<div class="customcolumns">'+k+'</div>'+
                                            '<div class="customcolumns">'+v+'%</div>'+
                                            '<div class="customcolumns">'+value.OptionsNewArray[k]+'</div>'+
                                            '</div>';
                                    totalvalue += value.OptionsNewArray[k];
       })
         $.each(value.OptionsNewArray, function( key1, value1 ) {
//             alert("==key=="+key1+"==value==="+value1)
             
                     key1 = "" + key1 + "";
                     var newarray = [key1, value1];
                     dataArray.push(newarray);
                 });

                 var data = google.visualization.arrayToDataTable(dataArray);


                 var options = {
                     //title: 'My Daily Activities',
                     is3D: true,
                     sliceVisibilityThreshold: 0
                 };

                 $("#table_row_"+inc).html(htmlstroption);
                        $("#table_footer_"+inc).html('<div class="customcolumns">Total</div><div class="customcolumns"></div><div class="customcolumns">'+totalvalue+'</div>');
    }
             if (value.QuestionType == 6 || value.QuestionType == 7) {
                 var chart = new google.visualization.PieChart(document.getElementById('surveyChart_' + inc));
             } else {
                 var chart = new google.visualization.BarChart(document.getElementById('surveyChart_' + inc));

             }
             chart.draw(data, options);
             
             inc++;

         });



     }
     
    function usabilityAnalyticsCaptureImg(chartContainer, obj,questionType,qNo) {
        var doc = chartContainer.ownerDocument;        
        saveAsImgUsability(chartContainer,obj,questionType,qNo);
        var img = doc.createElement('img');
        img.src = getImgData(chartContainer);
        img.id=chartContainer.id+"_img";
//        while (imgContainer.firstChild) {
//          imgContainer.removeChild(imgContainer.firstChild);
//          
//        }
        //imgContainer.appendChild(img);
        
       
      }
     function getImgData(chartContainer) {  
         try{
    var chartArea = chartContainer.getElementsByTagName('svg')[0].parentNode;
    var svg = chartArea.innerHTML;
    var doc = chartContainer.ownerDocument;
    var canvas = doc.createElement('canvas');
    canvas.setAttribute('width', chartArea.offsetWidth);
    canvas.setAttribute('height', chartArea.offsetHeight);

    canvas.setAttribute(
        'style',
        'position: absolute; ' +
        'top: ' + (-chartArea.offsetHeight * 2) + 'px;' +
        'left: ' + (-chartArea.offsetWidth * 2) + 'px;');
    doc.body.appendChild(canvas);
    canvg(canvas, svg);
    var imgData = canvas.toDataURL("image/png");
    canvas.parentNode.removeChild(canvas);
         }catch(err){
            // alert("error--"+err);
         }
    return imgData;
  }    
 function saveAsImgUsability(chartContainer, obj,questionType,qNo) {     
        var imgData = getImgData(chartContainer);
        saveImageFromBase64Usability(imgData, obj,questionType,qNo);
      }
      
 function saveImageFromBase64Usability(imgData, obj,questionType,qNo){
        var queryString = "imgData="+imgData;     
        
        ajaxRequest("/extendedSurvey/analyticsSaveImageFromBase64", queryString, function(data){saveImageFromBase64Usabilityhandler(data, obj,questionType,qNo);});  
    }
    
function saveImageFromBase64Usabilityhandler(data, obj,qType,qno){    
    scrollPleaseWaitClose("spinner_analytics_"+qno);
    window.open("/extendedSurvey/Pdf?question="+$("#quesiton_"+qno).text(),'_blank');
}

function openAnalyticspdf(obj,questionType,id){
    scrollPleaseWait("spinner_analytics_"+id)
    usabilityAnalyticsCaptureImg(document.getElementById('surveyChart_'+id), obj,questionType,id);
    
}

$("#genereateXls").die().live("click",function(){
   var surveyId = $(this).attr("data-surveyid");
   var scheduleId = $(this).attr("data-scheduleid");
   var qId = $(this).attr("data-questionid");
   var qType = $(this).attr("data-questiontype");
   var groupName = "";
   if($('label[for=analyticsswitch]').text() == "Schedule Level"){
       groupName = $(this).attr("data-groupname");
   }
   window.open("/extendedSurvey/generateSurveyAnalyticsXLS?surveyId="+surveyId+"&scheduleId="+scheduleId+"&qType="+qType+"&qId="+qId+"&groupName="+groupName);
});
</script>
     
     
     
     
      

  <?php       }
?>