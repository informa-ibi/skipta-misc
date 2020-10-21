<div id="calculator"  class="rightwidgettitle paddingt12">
    <i class="spriteicon">
        <img class="r_percentage" src="/images/system/spacer.png">
    </i>
    <span class="widgettitle " id="calclick" style="cursor: pointer;"><?php echo Yii::t('translation','Calculator'); ?> </span>
    <div class="calculator" id="collapseCal" >
            <form name="Calc">
                <div class="padding10b0">
                <div class="row-fluid ">
                <div class="span12 padding5">
                <label>WHAT is</label>
                <div class="row-fluid">
                <div class="span12">
                    <div class="span6" ><input name="Input" tabindex="1" size="16" class="span12 top_viewarea" type="text" maxlength="6" id="txtboxToFilter1"/></div>
                <div class="span4"> <label class="paddingtop6">% of</label> </div>
                </div>

                </div>
                <div class="row-fluid">
                <div class="span12">
                    <div class="span9" ><input name="Input" tabindex="2"size="16" class="span12 top_viewarea" type="text" maxlength="6" id="txtboxToFilter2" /></div>
                <div class="span3"> <label class="paddingtop6">?</label> </div>
                </div>
                </div>

                </div>
                </div>
                </div>

                <div class="calsplitter"></div>
                <div class="padding10b0">
                <div class="row-fluid ">
                <div class="span12 padding5">
                <div class="row-fluid">
                <div class="span12">
                    <div class="span6" ><input name="Input" tabindex="4"size="16" class="span12 top_viewarea" type="text" maxlength="6" id="txtboxToFilter3"/></div>
                <div class="span4"> <label class="paddingtop6">is</label> </div>
                </div>
                </div>
                <label>WHAT PERCENT of</label>
                <div class="row-fluid">
                <div class="span12">
                    <div class="span9" ><input name="Input" tabindex="5" size="16" class="span12 top_viewarea" type="text" maxlength="6" id="txtboxToFilter4"/></div>
                <div class="span3"> <label class="paddingtop6">?</label> </div>
                </div>

                </div>
                </div>
                </div>
                </div>

                <div class="calanswer">
                <div class="row-fluid ">
                <div class="span12 padding5">
                <input id="answerfield" name="Input" size="16"  class="span12 top_viewarea" type="text" placeholder="<?php echo Yii::t('translation','Answer'); ?>" disabled="disabled"/>
                </div>
                </div>
                </div>

        </form> 
    </div>
                
            </div>

<script type="text/javascript">
    $( "#calclick" ).click(function() {
    $( "#collapseCal" ).slideToggle( "slow", "");
    });
    var cal = false;
    function showCalculator(){
           $("#calculator").show();
           $("#userCalculatorWidget").hide();
    }
//    function getPercentageResults(val){
//        var res = 0;    
//        cal = true;
//        if(val != "" && val != "undefined" && val != 0){
//           var arr = val.split("%");
//            res = ((arr[0]/arr[1])*100);    
//         }
//        return res;
//    }
//    function checkAndClear(val){
//        if(cal == true){
//            Calc.Input.value = "";
//            cal = false;
//         }
//    }
    $(document).ready(function() {
    $("#txtboxToFilter1,#txtboxToFilter2,#txtboxToFilter3,#txtboxToFilter4").keydown(function (e) {
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
    });
    
    $("#txtboxToFilter2,#txtboxToFilter4").keypress(function(e){
       if(e.keyCode === 9 || e.keyCode === 13){           
           if($(this).attr('id') == "txtboxToFilter2"){
                calculatePercentile();
                
            }else if($(this).attr('id') == "txtboxToFilter4"){                
                getPercentageResults();
                
            }
       }
    });
    
    $("#txtboxToFilter1,#txtboxToFilter2,#txtboxToFilter3,#txtboxToFilter4").focusin(function(){
        if($(this).attr("id") === "txtboxToFilter1" || $(this).attr("id") === "txtboxToFilter2"){
            if($(this).attr("id") === "txtboxToFilter1"){
                $("#answerfield").val("");
            }
            $("#txtboxToFilter3,#txtboxToFilter4").val("");
        }
        if($(this).attr("id") === "txtboxToFilter3" || $(this).attr("id") === "txtboxToFilter4"){
            if($(this).attr("id") === "txtboxToFilter3"){
                $("#answerfield").val("");
            }
            $("#txtboxToFilter1,#txtboxToFilter2").val("");            
        }
    });
    function calculatePercentile(){
        var operand1 = Number($("#txtboxToFilter1").val());
        var operand2 = Number($("#txtboxToFilter2").val());   
        $("#txtboxToFilter3,#txtboxToFilter4").val("");
        if($("#txtboxToFilter1").val() !="" && $("#txtboxToFilter2").val() != "")
        $("#answerfield").val(((operand1/100)*operand2)).focus();
    }
    function getPercentageResults(){
        $("#txtboxToFilter1,#txtboxToFilter2").val("");
        var operand1 = Number($("#txtboxToFilter3").val());
        var operand2 = Number($("#txtboxToFilter4").val());  
        if($("#txtboxToFilter3").val() !="" && $("#txtboxToFilter4").val() != "")
            $("#answerfield").val(((operand1/operand2)*100)+"%").focus();
    }
});
    
</script>
