<?php 
if(is_object($surveyObj)){  ?>
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
     
     <div class="padding152010" style="">
         <?php $i = 1; foreach($surveyObj->Questions as $question){ ?>
       <div class="surveyquestionsbox">
     <div class="surveyanswerarea surveyanswerviewarea">
     <div class="paddingtblr30">
         
 	<div class="questionview"><div class="questionview_numbers"><?php echo "$i)"; ?></div> <?php echo $question['Question']; ?></div>
     <div class="answersection">
      <div id="surveyChart_<?php echo $i; ?>" style='height: 400px;'></div>
         
     </div>
         
     </div>
     </div>
         
     </div>
         <?php $i++;} ?>  
         
     </div>
     
     
     
     
     <script type="text/javascript">         
         $("#surveysubmitbuttons").hide();         
     </script>
     <script type="text/javascript">         
ajaxRequest("/extendedSurvey/surveyAnalytics","ScheduleId=<?php echo $scheduleId; ?>&userId=<?php echo $userId; ?>",surveyAnalticsHandler);
function surveyAnalticsHandler(data){           
     var inc = 1;   
     var colorArray = ['#b87333','silver','gold','#e5e4e2']

             $.each(data.Questions, function(key, value) {
                  var userAnnotationArray = value.UserAnnotationArray;
                 $("#allchartsmaindiv").append("<div id='surveyChart" + key + "' style='height: 500px;'></div>");
                 if (value.QuestionType == 1 || value.QuestionType == 2 || value.QuestionType == 5) {
                     var dataArray = new Array();
                     dataArray.push(['Element', 'Percentage', {role: 'style'}, {role: 'tooltip'},{role: 'annotation'}]);
                     //alert(value.OptionsNewArray);
                     var colorArrayIndex = 0;
                     $.each(value.OptionsPercentageArray, function(key1, value1) {

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
                 }else if(value.QuestionType == 3 || value.QuestionType == 4){ 
      var userSelectedOptionsArray = value.userSelectedOptionsArray;
      //userSelectedOptionsArray[userId]
      var dataArray = new Array();
      //var labelArray = new Array();
      var labelArray =  new Array();
      labelArray.push('Genre');
       $.each(value.LabelName, function( key, value ) {
           labelArray.push(value);
            labelArray.push({ role: 'tooltip' });
             labelArray.push({ role: 'annotation' });
       });
       dataArray.push(labelArray);
     
      //alert(dataArray);
      var i=0;
        $.each(value.OptionsPercentageArray, function( key1, value1 ) {
             
              key1 = ""+key1+"";
             var selectedOption =  userSelectedOptionsArray[i];
            var newarray = new Array();
              newarray.push(key1); 
              var j=1;
             $.each(value1, function( k, v ) {
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
 }
 else if(value.QuestionType == 6 || value.QuestionType == 7){ 
     
     
     
     var dataArray = new Array();
       dataArray.push(['Task', 'Hours per Day']);
         //alert(value.OptionsNewArray);
       
         $.each(value.OptionsNewArray, function( key1, value1 ) {
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
</script>
     
     
     
     
      

  <?php       }
?>