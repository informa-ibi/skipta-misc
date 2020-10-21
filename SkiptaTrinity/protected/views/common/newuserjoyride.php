<!-- Tip Content -->

<script type="text/javascript">
    var urlToLoad = '<?php echo $urlToLoad; ?>';
    var loginUserUniqueHandle = '<?php echo $loginUserUniqueHandle ?>';
    var previousStep = "";
    var stepLoaded = 0;
    function closeJoyride(divId)
    {
        //  alert($("div[data-index='" + divId + "' ]").html());
        // $("div[data-index='" + divId + "' ]").draggable();
    }
    function focusDiv(divId, joyrideDivId, index, position, fromClick)
    {

        if (divId != "" && divId != "undefined")
        {
            //  $("#"+joyrideDivId).addClass('joyrideHighlight');
            // alert();
            try
            {
                // eval('var myfunc = ' + divId);  myfunc(args, ...);
                // eval(divId + '();');
                eval('var myfunc = ' + divId);
                myfunc(index, position, fromClick);
            } catch (error)
            {

            }

            //  divId();

        }


    }

</script>

<!--[if lt IE 9]>
<style>
           .advancedtourguide .joyride-next-tip , .advancedtourguide .joyride-prev-tip, .advancedtourguide .advn_prev, .advancedtourguide .joyride-next-tip:hover, .advancedtourguide .joyride-prev-tip:hover, .advancedtourguide .advn_prev:hover {filter:none;background:none}
</style>
        <![endif]-->
<ol class="joyride-list " data-joyride>
    <?php
    try {

        //if (is_object($joyrideInfo)) {
        $i = 0;
        $j = 0;
        $fromPage = "";
        $opportunityId = "";
        $hasNext = false;
        $joyRideDivId = "";
        $firstLiDivId = "";
        $allSteps = 0;
        if (isset($nextOpportunity['OpportunityId'])) {
            $nextPageToLoadFromPage = $nextOpportunity['FromPage'];
            $nextPageToLoadOpportunityId = $nextOpportunity['OpportunityId'];
            $hasNext = true;
        }
        if (isset($joyrideInfo) && sizeof($joyrideInfo) > 0) {
            foreach ($joyrideInfo as $data) {
                ?>

                <?php
                if ($i == 0) {
                    $firstLiDivId = $data['DivId'];
                }
                $opportunityId = $data['OpportunityId'];
                $joyRideDivId = $data['DivId'];
                if ($data['Status'] == 1)
                    $allSteps = 1;
                ?>

                <li data-id="<?php echo $data['DivId'] ?>" data-text="<?php if ((!$hasNext && $i + 1 < sizeof($joyrideInfo)) || $hasNext)
                echo Yii::t('joyrideinfo', 'Next');
            else
                echo Yii::t('joyrideinfo', 'Done');
                ?>"  <?php if ($i == 1) echo "data-class='custom so-awesome'" ?> <?php if ($i > 0) echo "data-prev-text='" . Yii::t('joyrideinfo', 'Prev') . "'" ?>  

                            <?php if ($i == 0) echo "data-options='modal:false ; prev_button: false;  '";
                            else echo "data-options='  modal:false; prev_button: true; ' "; ?>
                    <h4><?php
                        $pageToInclude = strtolower(str_replace(' ', '', $data['Text']));
                        ?></h4>
                    <?php
                    include Yii::app()->basePath . '/views/includes/tourguide_' . $pageToInclude . '.php';
                    ?>
                    <?php if ($i == 0 && $opportunityId > 1) { ?> <input class="advn_prev" id="advPreviousbutton" type="button" value="<?php echo Yii::t('joyrideinfo', 'Prev') ?>" style="display:"  onclick="getNewUserJoyrideDetailsNext('<?php echo ($opportunityId - 1); ?>', 'Previous')"> <?php } ?>

                    <input type="hidden" value="<?php echo $data['DivId'] ?>" id="<?php echo $data['DivId'] . "_div" ?>">
                    <input type="hidden" value="<?php echo $data['Status'] ?> " id="stepStatus_<?php echo $i; ?>">
                    <input type="hidden" value="<?php echo $data['Position'] ?> " id="stepPosition_<?php echo $i; ?>">
                    <input type="hidden" value="<?php echo $data['FocusDivId'] ?> " id="stepFunction_<?php echo $i; ?>">
                   
                </li>


                <?php
                $j = $j + 1;
                $i = $i + 1;

                $fromPage = $data['FromPage'];
                $toPage = $data['NextPage'];
                $isFinished = (!$hasNext && ($i + 1) < sizeof($joyrideInfo)) || $hasNext ? "No" : 'Yes';
                ?>
                <script type="text/javascript">
                    if ('<?php echo $data['BlurDivId'] ?>' != "" && '<?php echo $isFinished ?>' == 'No')
                    {
                        var blurDivId = '<?php echo $data['BlurDivId'] ?>';
                        $("#" + blurDivId).blur(function() {
                            fireJoyRide();
                        })
                    }
                </script>

                <?php
            }
        }
        ?> 
      
        <?php
      
    } catch (Exception $exc) {
        error_log("Exexepitioonnnnnnnnnnnnnn" . $exc->getMessage());
    }
    ?>
</ol>
<script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>
<script>





                    $(document).ready(function() {
                        // $(document).foundation('joyride', 'start');

                        if ('<?php echo $allSteps ?>' == 1)
                        {
                            $(document)
                                    .foundation({joyride: {pre_ride_callback: function(obj) {

                                            },
                                            pre_step_callback: function(index, obj) {
                                                //alert("pre_step_callback");
                                                var joyrideDivId = $(this.$target)[0].id;

                                                $(".joyrideHighlight").removeClass('joyrideHighlight');

                                                $(".joyride-modal-bg").hide();
                                                var joyrideDivId = $(this.$target)[0].id;

                                                var StepStatusObj = $("div[data-index='" + index + "' ]").find("input[id=stepStatus_" + index + "]");


                                                if (StepStatusObj.attr('id') == 'stepStatus_' + index && StepStatusObj.attr('value') == 0)
                                                {
                                                    if ('<?php echo $allSteps ?>' == 1)
                                                    {
                                                        $("div[data-index='" + index + "' ]").hide();
                                                        StepStatusObj.attr('value', 1);
                                                        $("#nextBtn").click();

                                                    }
                                                    else
                                                    {
                                                       
                                                        $("div[data-index='" + index + "' ]").attr('style', 'display:none');
                                                    }

                                                }

                                                var StepPositionObj = $("div[data-index='" + index + "' ]").find("input[id=stepPosition_" + index + "]");
                                                var stepFunctionObj = $("div[data-index='" + index + "' ]").find("input[id=stepFunction_" + index + "]");
                                               
                                                setTimeout(function() {

                                                    //if($.trim(stepFunctionObj.attr('value'))!="highlightNews")
                                                    focusDiv(stepFunctionObj.attr('value'), joyrideDivId, index, StepPositionObj.attr('value'))


                                                }, 300);


                                                $(".joyride-tip-guide").hide();
                                            },
                                            post_step_callback: function(index, obj) {

                                                $(".joyrideHighlight").removeClass('joyrideHighlight');

                                                var joyrideDivId = $(this.$target)[0].id;

                                                if (joyrideDivId != '')
                                                {
                                                    saveOrUpdateTourgideUserState(joyrideDivId, '<?php echo $opportunityId ?>');
                                                }





                                                // alert(target);
                                            },
                                            post_ride_callback: function() {
                                

                                            }

                                        }})
                                    .foundation('joyride', 'start');
                           
                            $(".joyride-tip-guide").addClass("advancedtourguide");
                            $(".joyride-tip-guide").draggable({containment: "document"});
                            
                            $("#joyrideClose").live('click', function() {

                                var parent = $(this).parent();
                                var parentAgain = parent.find("input[type=hidden]");
                                if (parentAgain.attr("id") == parentAgain.attr('value') + "_div")
                                {
                                    saveOrUpdateTourgideUserState(parentAgain.attr('value'), '<?php echo $opportunityId ?>');
                                }

                            }
                            );
                            $(".joyride-prev-tip").live('click', function() {

                                var parent = $(this).parent();
                                var currentIndex = parent.parent().attr("data-index");


                                for (var i = currentIndex - 1; i >= currentIndex - 1; i--)
                                {
                                    var obj = $("div[data-index='" + (i) + "' ]")
                                    var child = obj.children("div:first");
                                    var parentAgain = child.find("input[type=hidden]");

                                    if ($("#" + parentAgain.attr('value')).length > 0)
                                    {
                                        $(this).prev();
                                        adjustJoyRidePosition()
                                        break;
                                    }
                                    else if (i == 0)
                                    {
                                        var oppId = '<?php echo ($opportunityId - 1); ?>';
                                        if (oppId > 0)
                                            getNewUserJoyrideDetailsNext('<?php echo ($opportunityId - 1); ?>', 'Previous')
                                    }
                                    else
                                    {
                                        continue;
                                    }
                                }

                            

                            }
                            );

                            $(".joyride-next-tip").bind('click', function() {
                                var sizeOfList = '<?php echo $i ?>';

                                var stepLoaded = 1;
                                var parent = $(this).parent();

                                var currentIndex = parent.parent().attr("data-index");



                                for (var i = currentIndex; i <= sizeOfList - 1; i++)
                                {
                                    var obj = $("div[data-index='" + (i) + "' ]")
                                    var child = obj.children("div:first");
                                    var parentAgain = child.find("input[type=hidden]");

                                    if ($("#" + parentAgain.attr('value')).length > 0 && sizeOfList > 1)
                                    {
                                        if (i == sizeOfList - 1)
                                        {
                                            var hasNext = '<?php echo $hasNext ?>';
                                            if (hasNext)
                                                getNewUserJoyrideDetailsNext('<?php echo $nextPageToLoadOpportunityId ?>', "Next");
                                        }
                                        else
                                        {
                                            $(this).next();
                                            break;
                                        }


                                    }
                                    else if (i == sizeOfList - 1)
                                    {
                                        var hasNext = '<?php echo $hasNext ?>';
                                        if (hasNext)
                                            getNewUserJoyrideDetailsNext('<?php echo $nextPageToLoadOpportunityId ?>', "Next");
                                    }
                                    else
                                    {
                                        continue;
                                    }
                                }

                               

                            }
                            );

                            $(".joyride-tip-guide").ready(function() {
                                $(".joyride-tip-guide").hide();
                               
                            })
                          

                        }
                    });




</script>