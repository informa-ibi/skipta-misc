( function( $ ) {
$( document ).ready(function() {
$('#css3menu1').prepend('<div id="indicatorContainer"><div id="pIndicator"><div id="cIndicator"></div></div></div>');
    var activeElement = $('#css3menu1>ul>li:first');

    $('#css3menu1>ul>li').each(function() {
        if ($(this).hasClass('active')) {
            activeElement = $(this);
        }
    });


	var posLeft = activeElement.position().left;
	var elementWidth = activeElement.width();
	posLeft = posLeft + elementWidth/2 -6;
	if (activeElement.hasClass('has-sub')) {
		posLeft -= 6;
	}

	$('#css3menu1 #pIndicator').css('left', posLeft);
	var element, leftPos, indicator = $('#css3menu1 pIndicator');
	
	$("#css3menu1>ul>li").hover(function() {
        element = $(this);
        var w = element.width();
        if ($(this).hasClass('has-sub'))
        {
        	leftPos = element.position().left + w/2 - 12;
        }
        else {
        	leftPos = element.position().left + w/2 - 6;
        }

        $('#css3menu1 #pIndicator').css('left', leftPos);
    }
    , function() {
    	$('#css3menu1 #pIndicator').css('left', posLeft);
    });

	$('#css3menu1>ul').prepend('<li id="menu-button"><a>Menu</a></li>');
	$( "#menu-button" ).click(function(){
    		if ($(this).parent().hasClass('open')) {
    			$(this).parent().removeClass('open');
    		}
    		else {
    			$(this).parent().addClass('open');
    		}
    	});
});
} )( jQuery );
