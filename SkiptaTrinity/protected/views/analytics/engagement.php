<?php
$dateFormat =  CommonUtility::getDateFormat();
    ?> 

<div class="row-fluid marginT10">
        <div class="sapn12">
            <div class="analytics_topleaders_box" style="border:0;box-shadow: 0 0 0 rgba(0, 0, 0, 0)" >
                                      <div id="engagement_daterange_error" class="alert alert-error" style="display: none;padding-left: 100px;"></div>
<div class="analytics_widgetheader">
                <div class="row-fluid">
                   
                    <div class="span12">
                         <div class="span4">
                            <div class="analytics_widgettitle">
                     <span class="">Engagement <i  class="cursor helpmanagement" data-id="EngagementHelpDescription_DivId" ><img src="/images/system/spacer.png" data-original-title="Engagement Help" rel="tooltip" data-placement="bottom" /></i></span>
                    
                </div>
                        </div>
                        <div class="span8">
                        <div class="analytics_datepicker pull-right">
                            <ul class="anlt_datepic">
                                <li>
<!--                                    <div class="row-fluid">-->
                                        <div class="pull-right">

                                            <div data-date="" data-date-format="<?php echo Yii::app()->params['DateFormat']?>" class="input-append date  pull-left " id="engDatePicker1">

                                                <label>Start Date</label>
                                                <input type="text"  id="Engagement_StartDate" readonly="readonly" class="textfield " maxlength="20" value="">    
                                                <span class="add-on">
                                                    <i class="fa fa-calendar"></i>
                                                </span>

                                            </div>

                                            <div data-date="" data-date-format="<?php echo Yii::app()->params['DateFormat']?>" class="input-append date pull-left " id="engDatePicker2">

                                                <label>End Date</label>
                                                <input type="text"  id="Engagement_EndDate"  readonly="readonly" class="textfield  " maxlength="20" value="">    
                                                <span class="add-on">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                               
                                            </div>

                                        </div>
<!--                                    </div>-->
                                </li>
                                <!-- -->
                                <li style="white-space:nowrap;cursor:pointer; position: relative" class="dropdown pull-left">
                                    <a data-original-title="Advanced Options" rel="tooltip" data-placement="bottom" class="tooltiplink analytics_export " data-toggle="dropdown" id="drop2"><i><img src="/images/system/spacer.png" ><span class="fa fa-caret-down"></span></i></a>

                                    <div class="dropdown-menu analytics_export_div">

                                        <ul>
                                            
                                            <li class="" ><a href="#"  target="_blank" onclick="openActivitypdf(this,'Engagement')" id="engagmentPdf" name="engagmentPdf"><i><img src="/images/system/spacer.png"  class="pdf_doc"></i> Export as PDF</a></li>
                                            <li class="" ><a href="#"  onclick="openActivityXls(this,'Engagement')" id="engagementXls"  target="_blank"><i><img src="/images/system/spacer.png" class="excel_doc" onclick="openActivityXls()"></i> Export as Excel</a></li>
                                        </ul>

                                    </div>
                                  </li>
                            </ul>
                        </div>
                       
                        
                         </div>
                        
                        
                    </div>
                    
                   
                </div>
</div>
                <div id="engagementImg_div" style="display: none;"></div>
                 <div id="engagement_Reports" style="position: relative;"></div>
                <div class="row-fluid">
                    <div class="sapn12 positionrelative">
                        

                       <div id="engagement_chart_div"  >
                           <div style="padding-bottom:10px">
                             <div class="dashboardbox dashboardboxpadding6 padding-bottom marginbottom10px dashboardboxgrey" style="min-height: 100px;">
                                 <div class="row-fluid" style="padding-bottom:6px">
                                     <div class="span12">
                                         <div class="dashboardboxpadding6">
                                 <div class="row-fluid">
                                     <div class="span12">
                                         <div id="loadingsmallinner_Stream" class="loaded"><span class="loadingsmallinner"></span> </div>
                                         <div class="dashboardbox_title paddinbbottom9">
                                             Stream
                                         </div>
                                     </div>
                                 </div>

 <div id="Stream_Engagement_Chart" ></div>
                                         </div>
                                     </div>
                                      </div>

                            

                            <div class="row-fluid analyticsrow-fluid">
                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_NormalPosts" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                    Posts
                                                </div>
                                            </div>
                                        </div>
                                        <div id="NormalPosts_Engagement_Chart"></div>  
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_SurveyPosts" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                    Quick Poll
                                                </div>
                                            </div>
                                        </div>
                                        <div id="SurveyPosts_Engagement_Chart"></div> 
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_EventPosts" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                    Event Posts
                                                </div>
                                            </div>
                                        </div>
                                        <div id="EventPosts_Engagement_Chart"></div>  
                                        
                                    </div>
                                </div>    

                            </div>
                                  </div>
                           </div>
                           <div style="padding-bottom:10px">
                             <div class="dashboardbox dashboardboxpadding6 padding-bottom marginbottom10px dashboardboxgrey">
                               <div class="row-fluid" style="padding-bottom: 6px">
                                 <div class="span12">
                                     <div class=" dashboardboxpadding6 padding-bottom ">     
                                         <div class="row-fluid">
                                             <div class="span12">
                                                 <div id="loadingsmallinner_Groups" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                 <div class="dashboardbox_title paddinbbottom9">
                                                     Groups
                                                 </div>
                                             </div>
                                         </div>
                                         <div id="Groups_Engagement_Chart"></div>
                                     </div>
                                 </div>
                             </div>
                            <div class="row-fluid analyticsrow-fluid">
                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_GroupNormalPosts" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                    Posts
                                                </div>
                                            </div>
                                        </div>
                                        <div id="GroupNormalPosts_Engagement_Chart"></div>  
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_GroupSurveyPosts" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                   Quick Poll
                                                </div>
                                            </div>
                                        </div>
                                         <div id="GroupSurveyPosts_Engagement_Chart"></div> 
                                       
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_GroupEventPosts" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                     Event Posts
                                                </div>
                                            </div>
                                        </div>
                                        <div id="GroupEventPosts_Engagement_Chart"></div>  
                                    </div>
                                </div>    

                            </div>
                             </div>
                           </div>
                           <div style="padding-bottom:10px">
                                 <div class="dashboardbox dashboardboxpadding6 padding-bottom marginbottom10px dashboardboxgrey">
                                 
                             <div class="row-fluid">
                                 <div class="span12">
                                     <div class=" dashboardboxpadding6 padding-bottom ">     
                                         <div class="row-fluid">
                                             <div class="span12">
                                                 <div id="loadingsmallinner_CurbsidePosts" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                 <div class="dashboardbox_title paddinbbottom9">
                                                     Curbside Consult
                                                 </div>
                                             </div>
                                         </div>
                                         <div id="CurbsidePosts_Engagement_Chart"></div>
                                     </div>
                                 </div>
                             </div>
                                 </div>
                           </div>
                           <div style="padding-bottom:10px">
                                     <div class="dashboardbox dashboardboxpadding6 padding-bottom marginbottom10px dashboardboxgrey">
                            <div class="row-fluid analyticsrow-fluid">
                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                 <div id="loadingsmallinner_News" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                    News
                                                </div>
                                            </div>
                                        </div>
                                        <div id="News_Engagement_Chart"></div>
                                    </div>
                                </div>

                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div id="loadingsmallinner_Games" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                   <?php echo Yii::t('translation','Games'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Game_Engagement_Chart"></div>
                                       
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class=" dashboardboxpadding6 padding-bottom ">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                  <div id="loadingsmallinner_Hashtag" class="loaded"><span class="loadingsmallinner"></span> </div>
                                                <div class="dashboardbox_title paddinbbottom9">
                                                      Hashtag
                                                </div>
                                            </div>
                                        </div>
                                         <div id="Hashtag_Engagement_Chart"></div>
                                    </div>
                                </div>    

                            </div> 
                                     </div>
                           </div>
                             
                         </div>

                        
                    </div>
                </div>

                
                
            </div>
        </div>
    </div>


   <script type="text/javascript" language="javascript">
google.load("visualization", "1", {packages:["corechart"]});
var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0); 
    
 var engagmentCheckin = $('#engDatePicker1').datepicker({
        onRender: function(date) {
            return date.valueOf() > now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if ((ev.date.valueOf() > engagementCheckout.date.valueOf()) || engagementCheckout.date.valueOf()!="") {
//            var newDate = new Date(ev.date)
//            newDate.setDate(newDate.getDate() + 0);
//            engagementCheckout.setValue(newDate);
        }
        engagmentCheckin.hide();
        $('#engDatePicker2')[0].focus();
    }).data('datepicker');
    
    var engagementCheckout = $('#engDatePicker2').datepicker({
        onRender: function(date) {
            return date.valueOf() > now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        engagementCheckout.hide();
       // alert(new Date($("#Engagement_StartDate").val().valueOf())+"---"+new Date($("#Engagement_EndDate").val().valueOf()));
        if(new Date($("#Engagement_StartDate").val().valueOf()) > new Date($("#Engagement_EndDate").val().valueOf())){
          
            $('#engagement_daterange_error').show();
            $('#engagement_daterange_error').html("End Date should be greater than Start Date.");
            $('#engagement_daterange_error').fadeOut(3000);
        }else{
            $('#engagement_daterange_error').hide();
           getEngagementDetails('des');
          
        }
      
    }).data('datepicker');



function getEngagementDetails(flag){
    if($("#Engagement_StartDate").val()=="" && $("#Engagement_EndDate").val()==""){
     
    SetDatesForAnalytics('Engagement_StartDate','Engagement_EndDate');   
 }
    
     scrollPleaseWait('engagement_Reports');
      var startDate ;
      var endDate;
    
           startDate = $("#Engagement_StartDate").val();
           endDate = $("#Engagement_EndDate").val();

   
    

    var queryString1 = "startDate="+startDate+"&endDate="+endDate+'&divId=Stream';

    ajaxRequest('/analytics/GetEngagementDetails', queryString1, function(data) {

        getEngagementDetailsHandler(data,'Stream');

    });
    var queryString2 = "startDate="+startDate+"&endDate="+endDate+'&divId=NormalPosts';

    ajaxRequest('/analytics/GetEngagementDetails', queryString2, function(data) {

        getEngagementDetailsHandler(data,'NormalPosts');

    });
    var queryString3 = "startDate="+startDate+"&endDate="+endDate+'&divId=SurveyPosts';

    ajaxRequest('/analytics/GetEngagementDetails', queryString3, function(data) {

        getEngagementDetailsHandler(data,'SurveyPosts');

    });
    var queryString4 = "startDate="+startDate+"&endDate="+endDate+'&divId=EventPosts';

    ajaxRequest('/analytics/GetEngagementDetails', queryString4, function(data) {

        getEngagementDetailsHandler(data,'EventPosts');

    });
    var queryString5 = "startDate="+startDate+"&endDate="+endDate+'&divId=GroupNormalPosts';

    ajaxRequest('/analytics/GetEngagementDetails', queryString5, function(data) {

        getEngagementDetailsHandler(data,'GroupNormalPosts');

    });


    var queryString6 = "startDate="+startDate+"&endDate="+endDate+'&divId=GroupSurveyPosts';

    ajaxRequest('/analytics/GetEngagementDetails', queryString6, function(data) {

        getEngagementDetailsHandler(data,'GroupSurveyPosts');

    });
    var queryString7 = "startDate="+startDate+"&endDate="+endDate+'&divId=GroupEventPosts';

    ajaxRequest('/analytics/GetEngagementDetails', queryString7, function(data) {

        getEngagementDetailsHandler(data,'GroupEventPosts');

    });
    var queryString8 = "startDate="+startDate+"&endDate="+endDate+'&divId=CurbsidePosts';

    ajaxRequest('/analytics/GetEngagementDetails', queryString8, function(data) {

        getEngagementDetailsHandler(data,'CurbsidePosts');

    });
    var queryString9 = "startDate="+startDate+"&endDate="+endDate+'&divId=Groups';

    ajaxRequest('/analytics/GetEngagementDetails', queryString9, function(data) {

        getEngagementDetailsHandler(data,'Groups');

    });
    var queryString10 = "startDate="+startDate+"&endDate="+endDate+'&divId=News';

    ajaxRequest('/analytics/GetEngagementDetails', queryString10, function(data) {

        getEngagementDetailsHandler(data,'News');

    });
     var queryString11 = "startDate="+startDate+"&endDate="+endDate+'&divId=Game';

    ajaxRequest('/analytics/GetEngagementDetails', queryString11, function(data) {

        getEngagementDetailsHandler(data,'Game');

    });
       var queryString12 = "startDate="+startDate+"&endDate="+endDate+'&divId=Hashtag';

    ajaxRequest('/analytics/GetEngagementDetails', queryString12, function(data) {

        getEngagementDetailsHandler(data,'Hashtag');

    });
     

   
   
    // ajaxRequest('/analytics/getEngagementDetails',queryString, getEngagementDetailsHandler);
}
function getEngagementDetailsHandler(data1,divId){ 
    scrollPleaseWaitClose('engagement_Reports'); 
    var data = data1.result;
    var Titles=new Array();    
    Titles=['Stream','NormalPosts','SurveyPosts','EventPosts','GroupNormalPosts','GroupSurveyPosts','GroupEventPosts','CurbsidePosts','Groups','News','Compete','Hashtag'];

   
var data2 = data1.result;

      var resultData=data1.result;
      var statesArray = [];
      for(var j in resultData){

      var stateitem = resultData[j];

      statesArray.push(stateitem);

      }

      
     var data = google.visualization.arrayToDataTable(statesArray);
//
      var options = {
        //title: Titles[i],
        backgroundColor: '#fff',
       // backgroundColor:{fill:'red'},
       areaOpacity:0.5,
     //  animation:{duration:2,easing:'inAndOut',startup:true},
        // tooltip: {trigger: 'selection'},
         focusTarget:'category',
        height: 300, width: 100 + "%",
        vAxis:{viewWindowMode:'explicit'},
       // aggregationTarget: 'category',
        selectionMode: 'multiple',
        legend: {position: 'top', maxLines: 5},
        colors: ['#9ACD32', '#FFD700', '#ff0000', '#00FF00', '#FF00FF', '#008B8B', '#1E90FF', '#FF69B4', '#800080', '#A0522D', '#4682B4', '#9ACD32', '#800000'],
        // vAxis: {title: 'Accumulated Rating'},
        isStacked: true
    };
      var chart = new google.visualization.SteppedAreaChart(document.getElementById(divId+'_Engagement_Chart'));
      chart.draw(data, options);
   //analyticsCaptureImg(document.getElementById('engagement_chart_div'), document.getElementById('engagementImg_div'));
}






</script>             
                