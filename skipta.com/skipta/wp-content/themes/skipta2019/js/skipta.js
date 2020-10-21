// Fixed Top Nav Scroll Options
jQuery(window).scroll(function () {
    var $this = jQuery(this),
        $adspace = jQuery('#ad-space');
    if ($this.scrollTop() > 740) {
        $adspace.addClass('fixed-top');
    } else {
        $adspace.removeClass('fixed-top');
    }
}); 
// Community Selector
jQuery(function() {
    jQuery('#communityselector').change(function(){
        jQuery('.community').hide();
        jQuery('#' + jQuery(this).val()).show();
        });
    });

//Gravity Forms - W9 PDF (SSN Field)
jQuery(document).ready(function($){	
    $(".w9-ssn input").on("change paste keyup", function() {	
    $(".w9-ssn-1 input").val($(this).val().substr(0, 3));	
    $(".w9-ssn-2 input").val($(this).val().substr(4, 2));	
    $(".w9-ssn-3 input").val($(this).val().substr(7, 4));	
    //console.log($(this).val().substr(0, 2));	
});	

//Gravity Forms - W9 PDF (EIN Field)	
    $(".w9-ein input").on("change paste keyup", function() {	
        $(".w9-ein-1 input").val($(this).val().substr(0, 2));	
        $(".w9-ein-2 input").val($(this).val().substr(3, 7));	
    });	
});