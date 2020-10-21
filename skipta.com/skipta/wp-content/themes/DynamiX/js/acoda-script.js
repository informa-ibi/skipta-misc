/* acoda Javascript Combination File
---------------------------------------------*/

(function($) {
	
	"use strict";
	
	/*
	* hoverFlow - A Solution to Animation Queue Buildup in jQuery
	* Version 1.00
	*
	* Copyright (c) 2009 Ralf Stoltze, http://www.2meter3.de/code/hoverFlow/
	* Dual-licensed under the MIT and GPL licenses.
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
	*/

	
	$.fn.hoverFlow = function(type, prop, speed, easing, callback) {
		// only allow hover events
		if ($.inArray(type, ['mouseover', 'mouseenter', 'mouseout', 'mouseleave']) == -1) {
			return this;
		}
	
		// build animation options object from arguments
		// based on internal speed function from jQuery core
		var opt = typeof speed === 'object' ? speed : {
			complete: callback || !callback && easing || $.isFunction(speed) && speed,
			duration: speed,
			easing: callback && easing || easing && !$.isFunction(easing) && easing
		};
		
		// run immediately
		opt.queue = false;
			
		// wrap original callback and add dequeue
		var origCallback = opt.complete;
		opt.complete = function() {
			// execute next function in queue
			$(this).dequeue();
			// execute original callback
			if ($.isFunction(origCallback)) {
				origCallback.call(this);
			}
		};
		
		// keep the chain intact
		return this.each(function() {
			var $this = $(this);
		
			// set flag when mouse is over element
			if (type == 'mouseover' || type == 'mouseenter') {
				$this.data('jQuery.hoverFlow', true);
			} else {
				$this.removeData('jQuery.hoverFlow');
			}
			
			// enqueue function
			$this.queue(function() {				
				// check mouse position at runtime
				var condition = (type == 'mouseover' || type == 'mouseenter') ?
					// read: true if mouse is over element
					$this.data('jQuery.hoverFlow') !== undefined :
					// read: true if mouse is _not_ over element
					$this.data('jQuery.hoverFlow') === undefined;
					
				// only execute animation if condition is met, which is:
				// - only run mouseover animation if mouse _is_ currently over the element
				// - only run mouseout animation if the mouse is currently _not_ over the element
				if(condition) {
					$this.animate(prop, opt);
				// else, clear queue, since there's nothing more to do
				} else {
					$this.queue([]);
				}
			});

		});
	};
	


	/* :: 	Detect CSS3 Transition Support								      
	---------------------------------------------*/

	$.support.transition = (function(){
		var thisBody = document.body || document.documentElement,
			thisStyle = thisBody.style,
			support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined;
		return support;
	})();
		
	if( $.support.transition === false )
	{
		$( 'body' ).addClass('non_CSS3');
	}
	

	function vcCleanElements()
	{	
		$('.vc_row-parent').each(function(index, element) 
		{
           if( $(this).find('.overlay-wrap').length > 1 )
			{
				$(this).find('.overlay-wrap:last').remove();
			}

           if( $(this).find('.vc_general.vc_parallax').length > 1 )
			{
				$(this).find('.vc_general.vc_parallax:last').remove();
			}			

           if( $(this).find('.row-slider-wrap').length > 1 )
			{
				$(this).find('.row-slider-wrap:last').remove();
			}			
        });
	}
	
	
	/* :: Row Video Background
	---------------------------------------------*/	
	

	
	function rowVideoBackground()
	{
		$('.custom-row .video-wrap').each(function(i){
			
			var	vid_ratio = 1280/720,
				rowWidth = $(this).closest('.custom-row').outerWidth()+20,
				rowHeight = $(this).closest('.custom-row').outerHeight(),
				videoWidth = rowWidth,
				width_chk = rowWidth,
				min_w = vid_ratio * (rowHeight);
			
			$(this).removeClass('center');	
			
			var video_height = Math.ceil( rowWidth / vid_ratio );
			
			if( video_height < rowHeight )
			{
				video_height = rowHeight;
				width_chk = video_height * vid_ratio;
			}
			
			if( width_chk > rowWidth )
			{
				videoWidth = width_chk;	
				$(this).addClass('center');
			}
		
			$(this).find('video').width( Math.ceil( videoWidth ) ).height( video_height );

		});
	};	
	
    function rowShapes(state) {
        if ($("body").hasClass("compose-mode") && "resize" == state) {
            $(".vc_row-parent > .row-shape-wrap").remove();
        }
        $(".vc_column_container .row-shape-wrap").each(function() {
            var flexiShape = $(this);
            if ("load" == state && !$("body").hasClass("compose-mode")) {
                $(this).insertAfter($(this).parents(".vc_row-parent *:last"));
            } else {
                if ($("body").hasClass("compose-mode") && state == "resize") {
                    flexiShape.addClass("clone").clone().insertBefore($(this).parents(".vc_row-parent *:last"));
                }
            }
        });
    }	
	

	/* :: Row Full Height
	---------------------------------------------*/	
	
	function rowHeight()
	{
		var	window_height = $(window).height(),
			window_width = $(window).width(),
			setRowHeight,
			newRowHeight,
			rowHeight,
			headerFloatHeight,
			headerHeight = 0;
		
		// Check if on mobile device with dock panel present
		if( window_width <= 1024 && $('.dock-panel-wrap').length )
		{
			window_height = window_height - $('.dock-panel-wrap').height();
		}
		
		// Push content down in first row if using Floating Header
		if( $('#header-wrap').hasClass('header_float') )
		{
			headerFloatHeight = $('.header-float-wrap').height();
			//$('#content .entry > .wpb_row.row:first-child .row-inner-wrap:first-child').css('padding-top', headerFloatHeight );
		}
		
		if( $('#header-wrap').length && ! $('#container').hasClass('header_float') ) 
		{
			headerHeight = headerHeight + $('#header-wrap').height();
		}	
		
		if( window_width >= 1025 && $('#wpadminbar').length )
		{
			window_height = window_height - $('#wpadminbar').height();
		}
		

		$('.row.full_row_height').not('.acoda-page-animate .custom-row.full_row_height').each(function(i)
		{
			if( $(this).is(':first-child') && headerHeight > 0 )
			{
				rowHeight = ( $(this).outerHeight() <= ( window_height - headerHeight ) ? ( window_height - headerHeight ) : 'auto' );

				$(this).css({ 
					'min-height' : rowHeight,
					'height' : rowHeight
				});				
			}
		});
	};		

	/* :: Waypoint Columns
	---------------------------------------------*/		

	function waypointColumns()
	{
		$('.dynamic-frame .columns.acoda-animate-in').not('.dynamic-frame .columns.acoda-animate-in.loaded').each(function(i)
		{
			if ( jQuery.isFunction( jQuery.fn.waypoint ) ) 
			{
				jQuery(this).waypoint(function(down)
				{
					var column = $(this);
					setTimeout(function() 
					{
						column.addClass('loaded');
					}, 20*i);
				},
				{
					offset: '100%'
				});			
			}
			else
			{
				var column = $(this);
				setTimeout(function() 
				{
					column.addClass('loaded');
				}, 50*i);				
			}		
		});	
	}


	/* :: Branding Middle
	---------------------------------------------*/
	
	function brandingMiddle()
	{
		if( $('#header-wrap').hasClass('middle') )
		{
			var menuItems = $('#acoda_dropmenu > li').length / 2,
				menuPosition = parseInt(menuItems-1);


			$('#acoda_dropmenu').children(':eq('+ menuPosition +')').after('<li class="menu-middle-logo"></li>');

			$( "#header-logo" ).appendTo( ".menu-middle-logo" );				
		}
    }
  



	/* :: Add One Page Nav
	---------------------------------------------*/		

	function onePageNav()
	{
		// Add One Page Nav
		if( $('#container').hasClass('anchorlink-nav') )
		{		
			var	anchors	= '',
				slides 	= 1;
			
			$('.row.link_anchor').each(function()
			{
				if( $(this) !== undefined )
				{
		
					anchors += '<li><a href="#'+ $(this).attr('data-anchor-link') +'">&nbsp;</a></li>'; 
					
					slides ++;
				}
		   });	
		
			if( anchors !== '' )
			{
				$('#container .main-wrap .content-wrap').append('<nav class="anchorlink-nav"><ul>'+ anchors +'</ul></nav>');
				
	
				$('nav.anchorlink-nav a').on( "click", function()
				{
					var target = $(this.hash),
						anchor_name = this.hash.slice(1);		
													
					acodaAnchorScroll( target, anchor_name );	
					
				});
			}
		}
	}
	

		/* :: Anchor Scroll								      
		---------------------------------------------*/
	
		function acodaAnchorScroll( target, anchor_name )
		{
			var	target = $( target ),
				header_height = $('#header').height();
				
		
			if( jQuery('#container').hasClass('sticky-header') )
			{				
				header_height = 70;					
			}	
			
			$('#container').unbind('touchmove');
			$('body').removeClass('dock-active');
			$('.dock-panel,.dock-tab').removeClass('inactive');
			$('.dock-tab-wrapper').removeClass('show');
			
			target = target.length ? target : $('[name=' + anchor_name +']');
	
			if ( target.length )
			{
				$('html,body').stop().animate({
				scrollTop: target.offset().top - header_height
				}, 1000);
				return false;
			}
			else
			{
				$('.row.link_anchor').each(function() 
				{
					if( $(this).attr('data-anchor-link') === anchor_name )
					{
						$('html,body').stop().animate({
						scrollTop: $(this).offset().top - header_height
						}, 1000);
						return false;							
					}
				});
			}
		}
	
	/* :: Footer Fill
	---------------------------------------------*/	
		
	function footerFill()
	{
		if( ! $('#container').hasClass('acoda-page-animate') )
		{
			var	browser_height = $(window).height(),
				site_height = $('.site-inwrap').outerHeight(),
				footer = $('#footer-wrap'),
				footer_height = footer.outerHeight(),
				min_height = '';
	
			if( site_height < browser_height && footer.length )
			{
				min_height = browser_height - site_height;		
				footer.css( 'min-height', min_height + footer_height );
			}
			else if( site_height > browser_height && footer.length )
			{
				min_height = browser_height - site_height;		
				footer.css( 'min-height', min_height + footer_height );
			}	
		}
	}	

	function pinnedSidebar()
	{
	
		if( $('#container').hasClass('sidebar-pinned') )
		{
			var	site_width = $('#main-wrap').outerWidth(),
				sidebar = $('.acoda-sidebar'),
				content = $('#content'),
				content_width = $('.content-wrap').width(),
				combine_width = 0,
				sidebar_width = 0,
				total_width,
				break_width,
				margin;
		
			
			$('.acoda-sidebar').each(function() {
				sidebar_width += $(this).outerWidth( true );
			});	
			
			
			combine_width = $('#content').width() + ( sidebar_width * 2 );
		
			/*if( ! sidebar.hasClass('right') )
			{
				total_width = content_width;
				break_width = sidebar_width;
			}
			else
			{
				break_width = content_width;
				total_width = site_width;
			}*/
			
			break_width = content_width;
			total_width = site_width;
		
	
			if( break_width < total_width && combine_width < site_width && sidebar.length )
			{
				margin = ( site_width - content_width ) / 2;
				
				$('#content.columns').addClass('pinned');
				
				sidebar.each(function() 
				{
					if( $(this).hasClass('right') )
					{
						sidebar.css({ 
							'right': '-'+ margin +'px',
							'position':'absolute'
						});							
					}	
					else
					{
						sidebar.css({ 
							'left': '-'+ margin +'px',
							'position':'absolute'
						});							
					}
				});
				
				if( content.hasClass('layout_four') || content.hasClass('layout_two') )
				{	
					if( !$('#header-wrap').hasClass('layout_left') )
					{
						content.css({ 
							'margin-left': sidebar_width / 2 +'px',
						});
					}
				}	
			}
			else 
			{
				$('#content.columns').removeClass('pinned');
				
				sidebar.css({ 
					'left':'auto',
					'right':'auto',
					'position':'relative'
				});	
				
				content.css({ 
					'margin': 0
				});
			}
		}
	}	
	
	/* :: Drop Menu Position
	---------------------------------------------*/		

	function headerLeftSticky()
	{			
		var	browser_width = $(window).width(),
			$scrollingDiv = $(".header_left #header-wrap.sticky_menu_logo");

		if( browser_width > 768 )
		{			
			$(window).scroll(function(){			
				$scrollingDiv
					.stop()
					.css({"marginTop": ($(window).scrollTop() ) + "px"} );			
			});
		}
		else
		{
			$scrollingDiv.stop().css({"marginTop": "0px" });	
		}
	}
	

	/* :: Drop Menu Position
	---------------------------------------------*/		

	function setDropDownMenuPosition()
	{		
		// Fix Sticky
		if( $('.sticky-wrapper').length )
		{
			$('.sticky-wrapper').css('min-height', $('#header').height() );	
		}
		
		$(".layout_top #acoda-tabs ul li.mega-menu").not('.layout_top #acoda-tabs .dock-tab-wrapper ul li.mega-menu').each( function()
		{		
			var menu_items = $(this),
				header_width = $('#header > .inner-wrap').width(),
				menu_width = $('#acoda-tabs').width(),
				browser_width = $(window).width(),
				offset = ( browser_width - header_width ) / 2,
				trigger_size 	= menu_items.width(),
				columns = 0,
				position = $(this).position();
								
			if( browser_width > 768 )
			{			
				$( menu_items ).find("ul.sub-menu:first").css({
					 'max-width' : header_width,
					 'width' : header_width,
				});
				
				columns = $( menu_items ).find("ul.sub-menu:first > li").size();
				
				 $( menu_items ).find("ul.sub-menu:first li").not("ul.sub-menu:first li li").css({
					 'max-width' : ( header_width -2 ) / columns,
					 'width' : '100%'
				});
				
				$( menu_items ).find('ul.sub-menu:first').offset({ left: offset });	
				
				if( ! $( menu_items ).find("ul.sub-menu:first .pointer").length )
				{
					$( menu_items ).find("ul.sub-menu:first").prepend('<span class="pointer"></span>');
				}
				
				$( menu_items ).find('span.pointer').css('left', ( header_width - menu_width ) + position.left + ( trigger_size / 2 ) - 9 );
				
			}
			else
			{
				 $( menu_items ).find("ul.sub-menu:first li").not("ul.sub-menu:first li li").css({
					 'max-width' : 'none',
					 'width' : '100%'
				});
				
				$(menu_items).find('ul.sub-menu:first').css({ left: 0 });					
				
			}
		});		
	}	

	/* :: Floating Header
	---------------------------------------------*/	
	
	function setFloatingHeaderOffset()
	{
		var	header_height = 0,
			dock_height = 0,
			offset_value,
			browser_width 	= $(window).width();			
		
		if( $('#container').hasClass('header_float') && ! $('#header-wrap').hasClass('height_100') )
		{
 			$('.header-float-wrap').children().each(function()
			{
				if( $(this).hasClass('sticky-wrapper') ) // ignore sticky-wrapper height
				{
					header_height = header_height + $(this).find('#header-wrap').height();
				}
				else
				{
					header_height = header_height + $(this).height();
				}
			});
				
				
			// Mobile Dock when not Layout 1
			if( browser_width < 1025 && ! $('.dock-panel-wrap').hasClass('dock_layout_1') )
			{
				dock_height = $('.dock-panel-wrap').not('#header-wrap .dock-panel-wrap').height();
			}
				
			offset_value = header_height + dock_height;		
			
			if( ! $(".main-wrap.header_float .entry > .wpb_row:first-child > .vc_column_container > .vc_column-inner > .wpb_wrapper").is(':empty') )
			{
				offset_value = offset_value + 30;
			}

			$(".main-wrap.header_float .entry > .wpb_row:first-child").css({ 'padding-top': offset_value });
			
			if( $('.intro-wrap').length )
			{
				offset_value = $('.intro-wrap').height();
				
				$(".main-wrap.header_float .entry > .wpb_row:first-child").css({ 'padding-bottom': offset_value });
			}
		}

		if( browser_width < 1025 && $('.dock-panel-wrap').hasClass('dock_float') )
		{
			dock_height = $('.dock-panel-wrap').height();
			$('#header-wrap').css({ 'margin-top' : dock_height });
		}
		else if( browser_width >= 1025 && $('.dock-panel-wrap').hasClass('dock_float') )
		{
			$('#header-wrap').css({ 'margin-top' : 'auto' });
		}
	}		

	/* :: Dock Element Position
	---------------------------------------------*/		

	function setDockElementPosition( trigger, element )
	{		
		var	browser_width 	= $(window).width(),
			site_height 	= $(window).innerHeight();
		
		var scroll = $(window).scrollTop();

		// If Loading or Resizing
		if( !element )
		{
			$( '.dock-tab-trigger' ).each( function() {
				var element 		= ".dock-tab-wrapper."+ $(this).attr('data-show-dock'),
					pointer 		= $( element +" .pointer"),
					trigger 		= $(this),
					trigger_pos 	= $(this).parent('.dock-tab').position(),
					trigger_offset	= $(this).offset(),
					dock_wrap_top 	= 0,
					trigger_size 	= trigger.outerWidth(),
					margin_right,
					margin_left,
					top,
					element_w;	
					

				if( $( element ).parents('.dock-panel-wrap').hasClass('main_nav') )
				{
					element_w = $( '.dock-panel-wrap.main_nav '+ element ).width() - ( trigger_size + 8 );
				}
				else
				{
					element_w = $( '.dock-panel-wrap.top_bar '+ element ).width() - ( trigger_size + 8 );
				}					
							
				if( browser_width >= 1025 )
				{
					// Set Max Height For Inner Scrolling
					$( element ).find('.infodock-innerwrap').css({ 
						'max-height' : site_height - ( trigger_pos.top + 55 )
					});		
												

					if( $('.dock-panel-wrap').hasClass('dockpanel_type_2') || $('.dock-panel-wrap').hasClass('dockpanel_type_3') )
					{
						$( element ).css({ 
							'width' : browser_width,
							'height' : site_height
						});
						
						if( $('#wpadminbar').length )
						{
							top = $('#wpadminbar').height();
						}
						else
						{
							top = 0;		
						}
						
						top = $(window).scrollTop();
						
						console.log( top );
						
						// Set position
				
						if( $('.dock-panel-wrap').hasClass('dockpanel_type_2') )
						{
							$( element ).offset({ top: top, left: - $( element ).width() });	
						}
						else
						{
							$( element ).offset({ top: top, left: 0 });	
						}
					}								
					else
					{
						if( $('#header-wrap').hasClass('layout_left') )
						{
							$( element ).css({ 
								'left' : trigger_pos.left,
								'top' : '100%',
							});		
						}
						else
						{
							$( element ).css({ 
								'left' : trigger_pos.left,
								'top' : '100%',
								'margin-left' : - element_w
							});		
						}						
					}								
				}
				else
				{	
					// Set Max Height For Inner Scrolling
					$( element ).find('.infodock-innerwrap').css({ 
						'max-height' : site_height
					});		

			
					$( element ).css({ 
						'width' : browser_width,
						'height' : site_height
					});		
						
					if( $('#wpadminbar').length )
					{
						top = $('#wpadminbar').height();
					}
					else
					{
						top = 0;		
					}
					
					top = $(window).scrollTop();
						
					// Set position
					$( element ).offset({ top: top, left: - $( element ).width() });		
					
				}
			});


		}
		else
		{
			var pointer = $( element +" .pointer"),
				trigger_pos 		= trigger.parent('.dock-tab').position(),
				trigger_offset		= trigger.offset(),
				trigger_size 		= trigger.width(),
				dock_wrap_top = 0,
				margin_right,
				margin_left,
				element_w,
				top;		
			

			if( $( element ).parents('.dock-panel-wrap').hasClass('main_nav') )
			{
				element_w = $( '.dock-panel-wrap.main_nav '+ element ).width() - ( trigger_size + 8 );	
			}
			else
			{
				element_w = $( '.dock-panel-wrap.top_bar '+ element ).width() - ( trigger_size + 8 );	
			}				
		
						
			if( browser_width >= 1025 )
			{
				// Set Max Height For Inner Scrolling
				$( element ).find('.infodock-innerwrap').css({ 
					'max-height' : site_height - ( trigger_pos.top + 55 )
				});	
				

				if( $('.dock-panel-wrap').hasClass('dockpanel_type_2') || $('.dock-panel-wrap').hasClass('dockpanel_type_3') )
				{
					$( element ).css({ 
						'width' : browser_width,
						'height' : site_height
					});		
					
					top = $(window).scrollTop();
					
					if( $('.dock-panel-wrap').hasClass('dockpanel_type_2') )
					{
						$( element ).offset({ top: top, left: - $( element ).width() });	
					}
					else
					{
						$( element ).offset({ top: top, left: 0 });	
					}
				}									
				else
				{			
					if( $('#header-wrap').hasClass('layout_left') )
					{
						$( element ).css({ 
							'left' : trigger_pos.left,
							'top' : '100%',
						});		
					}
					else
					{
						$( element ).css({ 
							'left' : trigger_pos.left,
							'top' : '100%',
							'margin-left' : - element_w
						});	
						
						$( pointer ).css({ 
							'left' : 'auto'
						});							
					}	
	
				}							
				
			}
			else
			{			
				// Set Max Height For Inner Scrolling
				$( element ).find('.infodock-innerwrap').css({ 
					'max-height' : site_height
				});		
				
				$( element ).css({ 
					'width' : browser_width,
					'height' : site_height
				});
						
				if( $('#wpadminbar').length )
				{
					top = $('#wpadminbar').height();
				}
				else
				{
					top = 0;		
				}
				
				top = $(window).scrollTop();
						
				// Set position
				$( element ).offset({ top: top, left: - $( element ).width() });	
			}
		}
	}		

	/* :: acoda functions
	---------------------------------------------*/
	
	jQuery(document).ready( function($) 
	{
		/* :: Row Video / Row Height / Drop Menu Pos
		---------------------------------------------*/
	
		rowVideoBackground();
		setDropDownMenuPosition();	
		headerLeftSticky();
		setDockElementPosition();
		setFloatingHeaderOffset();
		waypointColumns();
		brandingMiddle();
		footerFill();
		pinnedSidebar();
		rowShapes("load");
					

	
		/* :: Header Search											      
		---------------------------------------------*/
		
		$('#panelsearchsubmit').click(function()
		{
			if( $("#panelsearchform").hasClass("disabled") )
			{
				$( "#panelsearchform" ).switchClass( "disabled","active");
			} 
			else if( $("#panelsearchform").hasClass("active") )
			{
				if($("#panelsearchform #drops").val()!='')
				{
					$("#panelsearchform").submit();
				}
				else
				{
					$( "#panelsearchform" ).switchClass( "active", "disabled");		
				}
			}
		});
	
		
		/* :: Navigation												      
		---------------------------------------------*/
	
		
		$('#acoda-tabs ul li').not('#acoda-tabs #megaMenu ul li,.layout_top #acoda-tabs ul li.mega-menu ul li').hover(
			function(e)
			{				
				$(this).addClass('not-edge').removeClass('edge');
				
				if( $('ul', this).length ) 
				{
					var elm = $('ul:first', this),
						off = elm.offset(),
						l = off.left,
						w = elm.width(),
						docH = $("#container").height(),
						docW = $("#container").width(), 
						isEntirelyVisible = ( l + w <= docW );
		
					if( !isEntirelyVisible ) 
					{
						$(this).addClass('edge').removeClass('not-edge');
					} 
					else 
					{
						$(this).removeClass('edge').addClass('not-edge');
					}
				}
					
				
				if( $('body').hasClass('non_CSS3') )
				{
					$(this).addClass('visible');

					$(this).find('ul:first').delay(200).hoverFlow(e.type,
					{ 
						height: "show",
						opacity:1
					}, 400,function()
					{
						$(this).css("overflow", "visible");	
					});	
				}
				else
				{
					menuOverflowVisible();
					//$('#acoda-tabs ul li.hasdropmenu').removeClass('visible');
					$(this).addClass('visible').find('ul:first').addClass('active');		
				}
				
			}, 
			function(e)
			{				
				if( $('body').hasClass('non_CSS3') )
				{
					$(this).find('ul:first').delay(400).hoverFlow(e.type,
					{ 
						height: "hide",
						opacity:0
					}, 250,function()
					{
						$(this).hide();	
					});		
				}
				else
				{
					// Remove active class
					menuOverflowHide( $(this) ); 
					$(this).find('ul:first').removeClass('active');
				}
			}
		);

		
		var menuVisibility = setTimeout( menuOverflowHide, 500 );
		
		function menuOverflowHide(element)
		{
			if( element )
			{
				setTimeout( function()
				{
					element.removeClass('visible');
				}, 200 );
			}
			else
			{
				$('#acoda-tabs').find('li.hasdropmenu').removeClass('visible');
			}
		}
		
		function menuOverflowVisible()
		{
			clearTimeout( menuVisibility );
		}		
		
		$('#acoda-tabs').mouseleave(function()
		{
			menuVisibility = setTimeout( menuOverflowHide, 500 );
		});
		
		/* :: Add target blank										      
		---------------------------------------------*/
	
		$('.target_blank a').each(function()
			{
				$(this).click(
					function(event)
					{
						event.preventDefault();
						event.stopPropagation();
						window.open(this.href, '_blank');
					}
			   );
			}
		);
	
	
		/* :: Back to top Animation									      
		---------------------------------------------*/
	
		$('.hozbreak-top a,.autototop i').click(
			function()
			{
				 $('html, body').animate({ scrollTop: '0px' }, 600);
				 return false;
			}
		);
		
		$(function () { // run this code on page load (AKA DOM load)
		 
			/* set variables locally for increased performance*/
			var scroll_timer;
			var displayed = false;
			var $message = $('div.autototop a').not('.acoda-page-animate div.autototop a');
			var $window = $(window);
			var top = $(document.body).children(0).position().top;
		 
			/* react to scroll event on window*/
			$window.scroll(
				function ()
				{
					window.clearTimeout(scroll_timer);
					scroll_timer = window.setTimeout(function () { // use a timer for performance
						if($window.scrollTop() <= top) // hide if at the top of the page
						{
							displayed = false;
							$message.removeClass('show');
						}
						else if(displayed === false) // show if scrolling down
						{
							displayed = true;
							$message.stop(true, true).addClass('show').click(function () { $message.removeClass('show'); });
						}
					}, 100);
				}
			);
		});

		/*if( window.location.hash )
		{
			var anchor_name	= window.location.hash.substring(1),
				target 			= window.location.hash;	
				
			acodaAnchorScroll( target, anchor_name );				
		}	*/

		if( window.location.hash )
		{
			var target 		= window.location.hash,
				anchor_name = window.location.hash.substring(1),
				scroll_timer;
			
			window.location.hash = '';
			
			scroll_timer = window.setTimeout(function () 
			{		
				acodaAnchorScroll( target, anchor_name );
						
			}, 500 );				
		}			
					
	
		$('a[href*="#"]:not([href="#"])').not('.ui-tabs-nav a, a.vc_carousel-control,.vc_tta-panel-heading a,.vc_tta-tab a,.vc_pagination-item a').on( "click", function()
		{
			if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) 
			{
				var target = $(this.hash),
					anchor_name = this.hash.slice(1);		
					
				acodaAnchorScroll( target, anchor_name );
			}
		});

		
	
	/* :: 	Social Icons Animate									      
	---------------------------------------------*/
		
		// Show Social Icons
		$("a.socialinit").on("click", function(event)
		{		
			if( $(this).hasClass('socialhide') )
			{
				$("div.socialicons").not('div.socialicons.display,div.socialicons.init').fadeOut('slow');
			}
			else
			{
				$("div.socialicons").not('div.socialicons.display,div.socialicons.init').fadeIn('slow');
			}
			
			$(this).toggleClass('socialhide');
			
			return false;
		});	
		
		
		// Global Hide Dock Elements
		$('#container').bind('click', function(event)
		{
			if ( !$(event.target).parents().is(".dock-tab") && !$(event.target).parents().is("#acoda-tabs") && !$(event.target).parents().is(".dock-tab-wrapper") && !$(event.target).parents().is(".trigger-dock-menu") )
			{
				$( '.dock-panel > li,ul.dock-panel' ).removeClass('inactive');
				$( 'body' ).removeClass('dock-active');
				
				$( ".dock-tab-wrapper,#acoda-tabs" ).removeClass( 'show', 200, function()
				{
					if( !$( ".dock-tab-wrapper" ).hasClass( 'show' ) && !$( "#acoda-tabs" ).hasClass( 'show' ) )
					{
						$('#header-wrap').removeClass( 'active', 200 );	
					}
				});	
			}
		});	
		
		$('.dock-tab-wrapper .pointer').bind('click', function()
		{
			$('#container').unbind('touchmove');
			$( '.dock-panel > li,ul.dock-panel' ).removeClass('inactive');
			$( 'body' ).removeClass('dock-active');		

			$( ".dock-tab-wrapper.show" ).addClass( 'hide' );	

			 setTimeout(function () {      
				$( ".dock-tab-wrapper,#acoda-tabs").removeClass("show hide");   

			}, 300);	
		});			
		
		$(document).keyup(function(e)
		{
  			if (e.keyCode === 27)
			{
				$('#container').unbind('touchmove');
				$( '.dock-panel > li,ul.dock-panel' ).removeClass('inactive');
				$( 'body' ).removeClass('dock-active');		
				
				$( ".dock-tab-wrapper.show" ).addClass( 'hide' );	
				
				 setTimeout(function () {      
					$( ".dock-tab-wrapper,#acoda-tabs").removeClass("show hide");   
			 
				}, 300);				
			} 
		});
	
		// Show / Hide Dock Elements
		$('.dock-tab-trigger').bind('click', function(event)
		{		
			event.preventDefault();
			
		
			if( ! $( '.dock-tab-wrapper' ).hasClass('show') )
			{
				$('body').addClass('dock-active');
			}
			else
			{
				$('body').removeClass('dock-active');	
			}			

			if( $('.dock-panel-wrap').hasClass('dockpanel_type_1') )
			{
				if( $( this ).parent('li').hasClass('inactive') )
				{
					$('.dock-panel > li').removeClass('inactive');				
				}
				else
				{
					$('.dock-panel > li').removeClass('inactive');	
					$( this ).parent('li').addClass('inactive');
				}				
			}
			else
			{
				$('.dock-panel-wrap').find('ul.dock-panel').toggleClass('inactive');				
			}			
					
			var element = $(this).attr('data-show-dock');	
			
			setDockElementPosition( $(this) , '.dock-tab-wrapper.'+ element );
	
			$( '.dock-tab-wrapper,#acoda-tabs' ).not( '.dock-tab-wrapper.'+ element ).removeClass( 'show' ,200 );
				
			
			$( '.dock-tab-wrapper.'+ element ).toggleClass('show',200).promise().done(function()
			{	
				if( $( this ).hasClass('show') )
				{					
					if( $( this ).find('.infodock-innerwrap').prop('scrollHeight') <= $( this ).height() )
					{
						$('#container').bind('touchmove', function(e)
						{
								e.preventDefault();						
						});
					}
					

					$( '.dock-tab-wrapper.'+ element ).find('input').delay(400).queue(function(focus){
						$(this).focus();
						focus();
					});
				}	
					
				
				if( ( element === 'dock-menu' ) && $( this ).hasClass('show') )
				{
					$( '.dock-tab-wrapper.'+ element ).find('.dock_menu li' ).removeClass('show');
					$( '.dock-tab-wrapper.'+ element ).find('.dock_menu li' ).each(function(i)
					{
						var menuItem = $(this);
						setTimeout(function()
						{
							menuItem.addClass('show');
						}, 100*i );
					});
				}
				else
				{
					$( '.dock-tab-wrapper' ).find('.dock_menu li' ).delay(300).queue(function(remove){
						$(this).removeClass('show'); 
						remove();
					});	
				}
			});
		});
	
	
		$('#searchsubmit,#panelsearchsubmit').hover(function () {
			if( $.browser.msie && $.browser.version < 9 ) {
				//
			} else {
				$(this).animate({opacity:0.6},100);
			}
		});
	
		$('#searchsubmit,#panelsearchsubmit').mouseout(function () {
			
			if( $.browser.msie && $.browser.version < 9 ) {
				//
			} else {		
				$(this).animate({opacity:1},170);
			}
		});		
		
		$(window).scroll(function(){
			$(".intro-text,.parallax-fade .vc_column_container").css("opacity", 1 - $(window).scrollTop() / 350);
		});		
	
	
		/* :: 	Gallery Image Hover 									      
		---------------------------------------------*/
			
		$(document).on({
			mouseenter: function ()
			{		
				var element = $(this);
				
				if( $.support.transition === false )
				{
					$(this).find('a.action-icons i').animate({opacity:1}, 500 );
					$(this).find('span.action-hover').animate({opacity:0.8}, 500 );
				}
				else
				{
					if( $(this).find('.lightbox-wrap').length ) 
					{
						$(this).delay(200).queue(function(icon)
						{
							$(this).find('a.action-icons i').addClass('display');						
							icon();
						});
						
						$(this).find('span.action-hover').addClass('display');
					}
					else
					{
						$(this).find('a.action-icons i').addClass('display');
						$(this).find('span.action-hover').addClass('display');
					}
				}
			},
			mouseleave: function ()
			{
				if( $.support.transition === false )
				{
					$(this).find('a.action-icons i').animate({opacity:0}, 500 );
					$(this).find('span.action-hover').animate({opacity:0}, 500 );
				}
				else
				{			
					$(this).find('a.action-icons i').removeClass('display');
					$(this).find('span.action-hover').removeClass('display');
				}
			}
		},'.gridimg-wrap,ul.products > .product');
	
	
	
		/* :: 	Gallery Navigation Hover										  
		---------------------------------------------*/
		
		$('.gallery-wrap.nav-arrowhover,.gallery-wrap.nav-bulletarrowhover').hover(
			function()
			{
				if( $(window).width() > 1024 )
				{
					$(this).find('.slidernav-left,.slidernav-right').fadeTo(500,1);	
				}
			},
			function()
			{
				if( $(window).width() > 1024 )
				{				
					$(this).find('.slidernav-left,.slidernav-right').fadeTo(200,0);	
				}
			}
		);
	
	
		/* :: 	Woocommerce 										      	  
		---------------------------------------------*/	
	
		$(".button.add_to_cart_button").click(function(e)
		{
			$('.dock-tab .items-count').addClass('animate').delay(3000).queue(function(){
				$(this).removeClass('animate'); 
			});	
		});	
		
		
		// Preloader 
		clearTimeout( preloader );
		var preloader = setTimeout(function()
		{
			$("body").addClass("loaded");
		}, 1200 );		
			
	});

	$(window).load(function()
	{		
		rowHeight();
		$("body").addClass("loaded");
		var	dock_height = $('.dock-panel-wrap').height() + 70;
		$('.menu-sidebar-panel').css('padding-bottom', dock_height);
		$('.custom-row .video-wrap').addClass('active');
		setDockElementPosition();
		setFloatingHeaderOffset();
		onePageNav();	
		setDropDownMenuPosition();		
		
		var offset = 0,
			headerHeight = 0;		

		if( jQuery('#container').hasClass('sticky-header') )
		{
			// get  height values of header children
			$("#header-wrap .header-wrap-inner").children().each(function(){
				headerHeight = headerHeight + $(this).height();
			});
				
			offset = headerHeight;			
		}
	
		jQuery('.row.link_anchor').each(function()
		{
			var anchor_name = jQuery(this).attr('data-anchor-link'),
				anchor_link = '.row.link_anchor.anchor-' + anchor_name;
			
			// Check page is not using acoda-page-animate
			if( ! $('.acoda-page-animate').length )
			{	
				jQuery(anchor_link).waypoint(function(direction)
				{
					if( 'up' === direction )
					{
						jQuery('#acoda-tabs a,nav.anchorlink-nav a').each(function() 
						{
							jQuery(this).removeClass('waypoint_active');
							
							if( jQuery(this).attr('href') === '#' + anchor_name )
							{
								jQuery(this).addClass('waypoint_active');
							}
						});
					}
				},
				{
					offset: '-75%'
				});	

				jQuery(anchor_link).waypoint(function(direction)
				{
					if( 'down' === direction )
					{
						jQuery('#acoda-tabs a,nav.anchorlink-nav a').each(function() 
						{
							jQuery(this).removeClass('waypoint_active');
							
							if( jQuery(this).attr('href') === '#' + anchor_name )
							{
								jQuery(this).addClass('waypoint_active');
							}
						});
					}
				},
				{
					offset: '25%'
				});					
			}
					
        });
		
	});
	

	
	$(window).resize(function() 
	{
		// Footer Fill
		clearTimeout( footerFillTime );
		var footerFillTime = setTimeout(function()
		{
			footerFill();
		}, 500 );

		if( $( 'body' ).hasClass('compose-mode') )
		{
			vcCleanElements();
		}
		
        if ($("body").hasClass("compose-mode")) {
            var timeout = setTimeout(rowShapes("resize"), 500);
        }		

		rowVideoBackground();
		setDropDownMenuPosition();
		headerLeftSticky();
		setDockElementPosition();
		setFloatingHeaderOffset();		
		rowHeight();
		pinnedSidebar();
	});
	

})(jQuery);