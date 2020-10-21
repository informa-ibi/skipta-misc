<?php $dataFormat = CommonUtility::getDateFormat();?>
<script  id="analyticsTmp_render" type="text/x-jsrender">
<div style="position: relative">

        <div  class="block">
 
            <div  class="tablehead tableheadright pull-right">
            <div class="tabletopcorner">
                 <input type="text" placeholder="search title"  class="textfield textfieldsearch " id="searchTextId" onkeypress="return searchASurvey(event)" />
                             </div>

                 <div class="btn-group pagesize tabletopcorner tabletopcornerpaddingtop">
                <button data-toggle="dropdown" style="position:static" class="btn btn-mini dropdown-toggle" data-placement="top">Page size<span class="caret"></span></button>
                <ul class="dropdown-menu" style="min-width:70px;">
                    <li><a href="#" id="pagesize_5" onclick="setPageLength(5,'surveyanalytics')">5</a></li>
                    <li><a href="#" id="pagesize_10" onclick="setPageLength(10,'surveyanalytics')">10</a></li>
                    <li><a href="#" id="pagesize_15" onclick="setPageLength(15,'surveyanalytics')">15</a></li>                  
                </ul>
            </div>
            
            <div class="tabletopcorner tabletopcornerpaddingtop">
            <div class="label label-warning record_size" >+
                {{for data.total}}
                    {{>totalCount}}
                {{/for}} 
            </div>
            </div>
            </div>
            <a class="block-heading" data-toggle="collapse">&nbsp;</a>
            <div id="tablewidget" style="margin: auto;">
                <span id="spinner_admin" style="position:relative;top:40px;"></span>
                <table class="table table-hover">

                    <thead><tr><th>Title</th><th>Related Group</th><th class="data_t_hide">SchedulDates</th><th  class="data_t_hide">#Questions</th><th>#Surveyed Users</th><th>Actions</th></tr></thead>
                    <tbody>
                        <tr id="noRecordsTR" style="display: none">
                            <td colspan="8">
                                <span class="text-error"> <b>No records found</b></span>
                            </td>
                        </tr>
                        {{for data.data}}    
                        <tr class="odd">
                            <td>
                                {{>SurveyTitle}} 
                            </td>  
                            <td  class="data_t_hide">
                                        {{if SurveyRelatedGroupName != "0" }}        
                                           {{>SurveyRelatedGroupName}}
                                           {{else}}
                                            Public
                                            {{/if}}
                            </td>
                            <td id="usertype_{{>UserId}}"  class="data_t_hide">
                                                {{>StartDate}} to {{>EndDate}}
                            </td>
                            <td>
                                        {{>QuestionsCount}}
                            </td>
                           
                            <td class="data_t_hide">                          
                                {{>SurveyedUsersCount}}   
                            </td>
                            

                    <td>    
                                {{if SurveyedUsersCount !=  0 }}
                                <a id="viewanalytics" rel="tooltip" data-srvid="{{>SurveyId.$id}}" data-scid="{{>ScheduleId.$id}}"  style="cursor: pointer;"  role="button"  data-placement="bottom"  data-original-title="View Analytics" > <i class="icon-place-analytics"></i></a>                         
                                {{/if}}
   
                    </td>

                </tr>

                {{/for}}
            </tbody>

        </table>

        <div class="pagination pagination-right">
            <div id="pagination"></div>  

        </div>




    </div>        

</div>

</div>
</script>
<script type="text/javascript">
$("#viewanalytics").live("click",function(){
   var surveyId = $(this).data("srvid"); 
   var scheduleId = $(this).data("scid");   
   scrollPleaseWait('spinner_admin');
   ajaxRequest("/extendedSurvey/viewAdminSurveyAnalytics","surveyId="+surveyId+"&ScheduleId="+scheduleId,viewAdminSurveyAnalticsHandler, "html");
});
function viewAdminSurveyAnalticsHandler(html){    
    scrollPleaseWaitClose('spinner_admin');
    $("#analyticsdashboard,#dashboardtop").hide();
    $("#analyticsview").html(html).show();
}
</script>