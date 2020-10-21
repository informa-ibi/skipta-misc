<div class="streamsectionarea" style="display:none" id="streamsectionarea">
    <form name="questionviewwidget" id="questionviewwidget">
        
    
    <div  id="questionviewarea">
        
    </div>  
        
        <div class="surveybuttonarea alignright" id="surveysubmitbuttons" style="display:none">
            <input type="button" value="Save" name="commit" class="btn" id="submitQuestion"> <input type="submit" value="Cancel" name="commit" class="btn btn_gray ">
        </div>
    </div>
    
    </div>
    </form>
    <div class="row-fluid" style="position:relative" id="streamsectionarea_spinner"></div>
    <div style="display:none" id="streamsectionarea_error">
            <div class="ext_surveybox NPF lineheightsurvey">
                <center class="ndm" id="errorTitle" ></center>
            </div>
        </div>
	</div>
        
        
        
        
    
     <script type="text/javascript">
         $(document).ready(function() {
            doAjax();
             var UserId = 0;
                 var Groupname = "";
                 var isOuter = false;
             function doAjax(){     
                 UserId = 0;
                 Groupname = "";
                 <?php if(isset($_GET['userId']) && !empty($_GET['userId'] )){?>
                     UserId = '<?php echo $_GET['userId']; ?>';
                 <?php } ?>
                     <?php if(isset($_GET['groupName']) && !empty($_GET['groupName'] )){?>
                     Groupname = '<?php echo $_GET['groupName']; ?>';
    //                 if(Groupname == "public"){
    //                     Groupname = "0";
    //                 }
                 <?php } ?>
                     <?php if(isset($_GET['isOuter']) && !empty($_GET['isOuter'])){ ?>
                         isOuter = true;
                     <?php } ?>
                         if(isOuter == true){
                             $("#streamsectionarea").removeClass();
                         }
                     scrollPleaseWait('streamsectionarea_spinner');
                 ajaxRequest("/outside/renderQuestionView", "UserId="+UserId+"&GroupName="+Groupname, function(data) {
            renderSurveyView(data)
        }, "html");
             }
             function renderSurveyView(html){  
              scrollPleaseWaitClose('streamsectionarea_spinner');
             var strArr = html.split("_"); 
             if($.trim(strArr[0]) == "LoadReports" || $.trim(strArr[0]) == "NotScheduled"){ 
                $("#questionviewwidget").hide();
                $("#streamsectionarea_error").show();
                if($.trim(strArr[0]) == "NotScheduled")
                    $("#errorTitle").html("Right now</br> there is no schedule with this Group name");
                else{
                    $("#streamsectionarea").show();
//                    $("#surveyQuestionArea").hide();
                    $("#errorTitle").html("<?php echo $_GET['groupName']; ?> Analytics");
                    var scheduleId = strArr[1];
                    ajaxRequest("/extendedSurvey/surveyAnalytics","ScheduleId="+scheduleId,surveyAnalticsHandler)
                }
            } else if(!$.isNumeric(html)){            
                 $("#questionviewwidget,#streamsectionarea,#surveysubmitbuttons").show();
                 $("#streamsectionarea_error").hide();
                 
                $("#questionviewarea").html(html);
            }  else {
                $("#questionviewwidget").hide();
                $("#streamsectionarea_error").show();
                $("#errorTitle").html("Sorry, Please check UserId or Group Name.")
            }
         }
            <?php if(isset($this->tinyObject)){ ?>
                $(".streamsectionarea").each(function(){
                    if($(this).attr("id") == "streamsectionarea"){
                        $(this).removeClass("streamsectionarea");
                    }
                });
            <?php } ?>
         });
</script>