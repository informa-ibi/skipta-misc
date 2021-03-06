<?php include 'surveyAnalyticsScript.php'; ?>
<div class="row-fluid groupseperator headermarginzero" id="dashboardtop">
    <div class="span12 paddingtop10 border-bottom">
        <div class="span6"><h2 class="pagetitle" id="pagetitle">Survey Wall</h2></div>
        <div class="span6">
            <?php if (Yii::app()->session['IsAdmin'] == 1) { ?>
                <div class="gamefloatingmenu pull-right positionrelative" >                    
                    <ul>
                        <li  class="gamerightlist"><a  class="gameanalytics surveyanalytics"  ><img id="gameAnalytics" class=" tooltiplink cursor" rel="tooltip"  data-original-title="Analytics" src="/images/system/spacer.png" /></a></li>

                        <li class="gamerightlist positionrelative"><a href="#" class="filter" data-toggle="dropdown" ><img id="filter" class=" tooltiplink cursor" rel="tooltip"  data-original-title="Filter" src="/images/system/spacer.png" /></a>
                            <div class="dropdown dropdown-menu actionmorediv actionmoredivtop newgrouppopup newgrouppopupdivtop preferences_popup paddingzero gamefiltermenu">

                                <ul class="GameManagementActionsFilter SurveyFilterActions">
                                    <li><a class="Filter" style="cursor: pointer"><?php echo Yii::t('translation', 'Show_Survey_Wall'); ?></a></li> 

                                    <li><a class="FutureSchedule" style="cursor: pointer" ><?php echo Yii::t('translation', 'Future_Schedule_Survey'); ?></a></li>      
                                    <li><a class="SuspendedSurveys" style="cursor: pointer"><?php echo Yii::t('translation', 'SuspendedSurveys'); ?></a></li>
                                </ul>


                            </div>
                        </li>

                        <li class="gamerightlist"><a href="/survey" class="newgame"  ><img id="newgame" class=" tooltiplink cursor" rel="tooltip"  data-original-title="New Survey" src="/images/system/spacer.png" /></a></li>




                    </ul>
                </div>
            <?php } ?>  
        </div>
    </div>
    <div id="spinner_admin" style="position: relative;"></div>
</div>
<div id="surveyDashboardWallDiv">
    <ul id="surveyDashboardWall" class="ext_surveybox">

        <!-- End of grid blocks -->
    </ul>
</div>

<div id="analyticsdashboard" style="display: none"></div>
<div id="analyticsview" style="display: none"></div>


<script type="text/javascript">
    var pSurveyScheduleId = "";
    var g_filterValue = "";
    var g_pageNumber = 1;
    var g_searchText = "";
    var g_startLimit = 0;
    var g_pageLength = 10;
    var g_page = 1;
    Custom.init();
    getCollectionData('/extendedSurvey/LoadSurveyWall', 'ExtendedSurveyBean', 'surveyDashboardWall', 'No survey found', 'No more surveys');
    var optionsC = {
        itemWidth: '100%', // Optional min width of a grid item
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#surveyDashboardWall'), // Optional, used for some extra CSS styling
        offset: 20, // Optional, the distance between grid items
        outerOffset: 20, // Optional the distance from grid to parent
        flexibleWidth: '50%', // Optional, the maximum width of a grid item
        align: 'left'
    };
    var $window = $(window);

    function applyLayout() {
        optionsC.container.imagesLoaded(function() {
            optionsC.container.imagesLoaded(function() {
                // Create a new layout handler when images have loaded.
                handler = $('#surveyDashboardWall li.surveylist');

                if ($window.width() < 753) {
                    optionsC.itemWidth = '100%';
                    optionsC.flexibleWidth = '100%';

                }
                else if ($window.width() > 753 && $window.width() < 1000) {
                    optionsC.itemWidth = '100%';
                } else {

                    optionsC.itemWidth = '40%';
                }

                handler.wookmark(optionsC);

            });
        });
    }

    $window.resize(function() {
     $("#surveyDashboardWall").hide()
     setTimeout(function(){
         applyLayout();    
         $("#surveyDashboardWall").show()
     },200);
  
   
        });



    $(".edit_icon,.suspend_icon,.schedule_icon").live('click', function() {
        var $this = $(this);
        var surveyId = $this.closest('div.surveymenuicons').attr("data-id");
        var networkId = $this.closest('div.surveymenuicons').attr("data-networkId");
        //alert(surveyId); 
        var name = $this.attr("data-name");
        if (name == "edit_survey") { //edit survey...
            window.location.href = "/extendedSurvey/managesurvey/" + surveyId;
        } else if (name == "suspend_survey") { //suspend survey...
            var divid = "#survey_" + surveyId;
            //alert(divid);         
            suspendSurveyPopup(surveyId, networkId);
//        ajaxRequest("/extendedSurvey/suspendSurveyById", "surveyId="+surveyId, function(data){getSurveyGroupsHandler(data);});
//        $(divid).hide();
        } else if (name == "schedule_survey") { //schedule survey...
            if (pSurveyScheduleId != undefined && pSurveyScheduleId != null) {
                $("#survey_" + pSurveyScheduleId).show();
            }
            pSurveyScheduleId = surveyId;
//            $(".scheduleGameDiv").html('');
            scrollPleaseWait("spinner_survey_" + surveyId);
            ajaxRequest("/extendedSurvey/loadSurveySchedule", "surveyId=" + surveyId, function(data) {
                renderLoadSurveyScheduleHandler(data, surveyId)
            }, "html");
//                 $("#schedule_"+surveyId).load("/extendedSurvey/loadSurveySchedule","",
//                 function(data){
//                    applyLayout();
//                    }
//                        );  
//                 $("#schedule_"+surveyId).show();



        }
    });

    function renderLoadSurveyScheduleHandler(html, surveyId) {
        scrollPleaseWaitClose("spinner_survey_" + surveyId);
        $("#newModal .modal-dialog").removeClass('info_modal');
        $("#newModal .modal-dialog").removeClass('alert_modal');
        $("#newModal .modal-dialog").removeClass('error_modal');
        $("#newModalLabel").html("Schedule a Survey");
        $("#newModal_footer").hide();
        $("#newModal_body").html(html);
        $("#newModal").modal('show');
    }

    function suspendSurveyPopup(surveyId, networkId) {
        var actionType = "Suspend";
        var modelType = 'error_modal';
        var title = 'Suspend';
        var content = "Are you sure you want to suspend this survey?";
        var closeButtonText = 'No';
        var okButtonText = 'Yes';
        var okCallback = suspendSurveyCallback;
        var param = '' + surveyId + ',' + actionType + ',' + networkId;
        openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, param);
        $("#newModal_btn_close").show();
    }
    function suspendSurveyCallback(param) {
        var paramArray = param.split(',');
        var surveyId = paramArray[0];
        var actionType = paramArray[1];
        var networkId = paramArray[2];
        suspendSurvey(surveyId, actionType, networkId);
    }
    function suspendSurvey(surveyId, actionType, networkId) {
        scrollPleaseWait("spinner_survey_" + surveyId);
        ajaxRequest("/extendedSurvey/suspendSurvey", "surveyId=" + surveyId + "&actionType=" + actionType + "&networkId" + networkId, function(data, surveyId) {
            page = 1;
            isDuringAjax = false;

            $('#surveyDashboardWall').empty();
            $("#newModal").modal('hide');
            getCollectionData('/extendedSurvey/LoadSurveyWall', 'ExtendedSurveyBean', 'surveyDashboardWall', 'No survey found', 'No more surveys');
        });
    }
    $(".cancelschedule").live('click', function() {
        var $this = $(this);
        var surveyId = $this.attr("data-surveyId");
        var scheduleId = $this.attr("data-scheduleId");
        cancelScheduleSurveyConfirm(surveyId, scheduleId);
    });
    function cancelScheduleSurveyConfirm(surveyId, scheduleId) {
        var actionType = "CancelSchedule";
        var modelType = 'error_modal';
        var title = 'Cancel Schedule';
        var content = "Are you sure you want to cancel schedule this survey?";
        var closeButtonText = 'No';
        var okButtonText = 'Yes';
        var okCallback = cancelScheduleSurveyCallback;
        var param = '' + surveyId + ',' + scheduleId + ',' + actionType + '';
        openModelBox(modelType, title, content, closeButtonText, okButtonText, okCallback, param);
        $("#newModal_btn_close").show();
    }
    function cancelScheduleSurveyCallback(param) {
        var paramArray = param.split(',');
        var surveyId = paramArray[0];
        var scheduleId = paramArray[1];
        var actionType = paramArray[2];
        cancelScheduleSurvey(surveyId, actionType, scheduleId);
    }

    function cancelScheduleSurvey(surveyId, actionType, scheduleId) {
        scrollPleaseWait("spinner_survey_" + surveyId);
        ajaxRequest("/extendedSurvey/cancelSurveySchedule", "surveyId=" + surveyId + "&scheduleId=" + scheduleId, function(data, surveyId) {
            page = 1;
            isDuringAjax = false;
            $('#surveyDashboardWall').empty();
            $("#newModal").modal('hide');
            getCollectionData('/extendedSurvey/LoadSurveyWall', 'ExtendedSurveyBean', 'surveyDashboardWall', 'No survey found', 'No more surveys');
        });
    }
    $("ul.GameManagementActionsFilter li a").live("click", function() {
        $("#analyticsdashboard").hide();
        var filterString = $(this).attr('class');
        scrollPleaseWait('postSpinLoader');
        $(window).unbind("scroll");
        $('ul.GameManagementActionsFilter li').removeClass('active');
        $(this).parent().addClass('active');
        page = 1;
        isDuringAjax = false;
        $('#surveyDashboardWall').empty();
        var nodatastr = "No survey found";
        if (filterString == "Filter" || filterString == "FutureSchedule" || filterString == "SuspendedSurveys") {
            scrollPleaseWait('spinner_admin');
            if (filterString == "FutureSchedule") {
                $("#pagetitle").html("Future Schedule Survey Wall");
                nodatastr = "No Future Surveys Found";
            }
            else if (filterString == "SuspendedSurveys") {
                $("#pagetitle").html("Suspended Survey Wall");
                nodatastr = "No Suspended Surveys Found";
            } else {
                $("#pagetitle").html("Survey Wall");
            }
            getCollectionData('/extendedSurvey/LoadSurveyWall', 'filterString=' + filterString + '&ExtendedSurveyBean', 'surveyDashboardWall', nodatastr, 'No more surveys');
        }
        else {
            scrollPleaseWait('spinner_admin');
            getCollectionData('/extendedSurvey/LoadSurveyWall', 'ExtendedSurveyBean', 'surveyDashboardWall', 'No survey found', 'No more surveys');
        }
    });

    $(".surveyanalytics").click(function() {
        //  alert('click');
        $("#pagetitle").html("Survey Analytics");
        $("#surveyDashboardWallDiv,#analyticsview").hide();
        getSurveyAnalyticsDetails(0,"all","");        
        $("#analyticsdashboard").show();
        isDuringAjax = true;
//        ajaxRequest("/extendedSurvey/getSurveyAnalyticsData", {}, getSurveyAnalyticsHandler)
    });

   

    function getSurveyAnalyticsDetails(startLimit, filterValue, searchText) {
        if (filterValue == "" || filterValue == undefined) {
            filterValue = "all";
        }
        filterValue = $.trim(filterValue);
        g_filterValue = filterValue; // assgining filtervalue to global variable...
        if (startLimit == 0) {
            g_pageNumber = 1;
        }
        if (searchText == 'search') {
            searchText = "";
        }
        var queryString = "filterValue=" + filterValue + "&searchText=" + searchText + "&startLimit=" + startLimit + "&pageLength=" + g_pageLength;
        scrollPleaseWait('spinner_admin');
        ajaxRequest("/extendedSurvey/getSurveyAnalyticsData", queryString, getSurveyAnalyticsHandler)        
    }
// handler for getUserManagementDetails...
    function getSurveyAnalyticsHandler(data) {
        
        scrollPleaseWaitClose('spinner_admin');
        var item = {
            'data': data
        };
        $("#analyticsdashboard").html(
            $("#analyticsTmp_render").render(item)
        );
        if (g_pageNumber == undefined) {
            g_page = 1;
        } else {
            g_page = g_pageNumber;
        }
        if (g_filterValue != undefined) {
            $("#filterSurvey").val(g_filterValue);
        } else {
            g_filterValue = "all";
        }
         
        if(g_searchText != undefined && g_searchText != ""){
           
        }
        if (data.total.totalCount == 0) {
            $("#pagination").hide();
            $("#noRecordsTR").show();
        }
        $("#pagination").pagination({
            currentPage: g_page,
            items: data.total.totalCount,
            itemsOnPage: g_pageLength,
            cssStyle: 'light-theme',
            onPageClick: function(pageNumber, event) {
                g_pageNumber = pageNumber;
                var startLimit = ((parseInt(pageNumber) - 1) * parseInt(g_pageLength));
                getSurveyAnalyticsDetails(startLimit, g_filterValue, g_searchText);
            }

        });

        if ($.trim(data.searchText) != undefined && $.trim(data.searchText) != "undefined") {

            $('#searchTextId').val(data.searchText);
        }
        $("#searchTextId").val(g_searchText);
        Custom.init();
        $("[rel=tooltip]").tooltip();
    }

    function searchASurvey(event) {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            scrollPleaseWait('spinner_admin');
            if ($.trim($("#searchTextId").val()) != "") {
                var searchText = $.trim($("#searchTextId").val());
                g_searchText = searchText;
                getSurveyAnalyticsDetails(0, '', g_searchText);
            } else {
                g_searchText = "";
                getSurveyAnalyticsDetails(0,"","");
            }
            return false;

        }
    }

    $("#filterSurvey").live("change",
            function() {
                var value = $("#filterSurvey").val();
                var searchText = $("#searchTextId").val();
                g_searchText = searchText;
                g_filterValue = value;
                scrollPleaseWait('spinner_admin');
                getSurveyAnalyticsDetails(0, value, searchText);
            }
    );
    $("#detailed_close_page_survey").live('click',function(){
        $("#analyticsview").slideUp('slow','swing',function(){
            $("#analyticsdashboard,#dashboardtop").show();
        });
 
        
    });
</script>


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.wookmark.js"></script>