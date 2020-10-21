<?php

	/* ------------------------------------
	:: INIT THEME OPTIONS
	------------------------------------ */	
	
	require_once get_template_directory() . '/lib/admin/acoda-redux/admin-init.php';

	/* ------------------------------------
	:: ENQUEUE SCRIPTS
	------------------------------------ */

	function acoda_scripts()
	{
		if ( !is_admin() )
		{
			global 	$dynamix_options;
			wp_enqueue_style( 'acoda-style', get_bloginfo('stylesheet_url'), false, null );
					
				
			wp_enqueue_script('jquery');

			// Lightbox
			if( acoda_settings('lightbox') != false )
			{		
				$path 		=  acoda_settings('lightbox_path');
				$thumbnail  =  acoda_settings('lightbox_thumbnail');
				$opacity	=  acoda_settings('lightbox_opacity');
				$infinite	=  acoda_settings('lightbox_infinite');
				$slideshow	=  acoda_settings('lightbox_slideshow');
				$arrows		=  acoda_settings('lightbox_arrows');	
				$classes	=  acoda_settings('lightbox_classes');	
				$skin 		=  acoda_settings('lightbox_skin');
					
				
				$lightbox_options = array(
					'classes'		=> $classes,
					'path'			=> $path,
					'thumbnail'		=> $thumbnail,
					'opacity'		=> $opacity,
					'infinite'		=> $infinite,
					'slideshow'		=> $slideshow,
					'arrows'		=> $arrows,	
					'skin'			=> $skin,	
				);
				
				wp_enqueue_script( 'ilightbox', get_template_directory_uri().'/js/ilightbox.packed.js', array( 'jquery' ) );
				wp_localize_script('ilightbox', 'options', $lightbox_options );
				
				wp_enqueue_style( 'ilightbox', get_template_directory_uri(). '/css/ilightbox.css', false, null );
				wp_enqueue_style( 'ilightbox-'. $skin, get_template_directory_uri(). '/css/ilightbox/'. $skin .'-skin/skin.css', false, null );
				
			}
	
			
			// Main Script
			wp_enqueue_script( 'acoda-script', get_template_directory_uri().'/js/acoda-script.pack.js', array( 'jquery' ) );
	

			
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			{
				wp_enqueue_script( 'comment-reply' );
			}	
			
			// Font Awesome
			wp_enqueue_style('fontawesome',	get_template_directory_uri() .'/css/font-icons/fontawesome/css/fontawesome-all.min.css', false, null);	
        	
			// Remove Contact Form 7 Styling
			wp_deregister_style('contact-form-7');	
			
		
			// Sticky Header
			$acoda_sticky_menu 	  = acoda_settings('sticky_menu');	
			$acoda_sticky_sidebar = acoda_settings('sticky_sidebar');	
			
			if( $acoda_sticky_menu == true || $acoda_sticky_sidebar == true )
			{
				$elements = array(
					'menu'		=> $acoda_sticky_menu,
					'sidebar'	=> $acoda_sticky_sidebar,
				);		
				
				wp_enqueue_script( 'waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), true );	
				wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri().'/js/waypoints-sticky.min.js', array('jquery','waypoints'), true );
				wp_localize_script('waypoints-sticky', 'elements', $elements );
			}
								
		}
	}    

	add_action( 'wp_enqueue_scripts', 'acoda_scripts' );



	/* ------------------------------------
	:: THEME SETUP
	------------------------------------ */
	
	function acoda_theme_setup()
	{		
		/* ------------------------------------
		:: THEME PREFIX * DO NOT CHANGE *
		------------------------------------ */
	
		define( 'ACODA_THEME_PREFIX', 'dynamix' ); 
		update_option( 'acoda_theme', ACODA_THEME_PREFIX );
	
		/* ------------------------------------
		:: CORE FUNCTIONS
		------------------------------------ */
	
		require_once get_template_directory() . '/functions-core.php';	
		
		/* ------------------------------------
		:: THEME SETUP
		------------------------------------ */	
		
		require_once get_template_directory().'/theme-setup.php';
	
		/* ------------------------------------
		:: CUSTOM WIDGETS
		------------------------------------ */	
		
		require_once get_template_directory() .'/lib/admin/custom-widgets.php';
	
		/* ------------------------------------
		:: BREADCRUMBS
		------------------------------------ */
	
		require_once get_template_directory() .'/lib/inc/breadcrumbs.php';
	
		/* ------------------------------------
		:: TITLE TAG
		------------------------------------ */	
		
		add_theme_support( 'title-tag' );
	
		/* ------------------------------------
		:: THUMBNAILS
		------------------------------------ */
	
		add_theme_support( 'post-thumbnails' ); 
		
		if ( function_exists( 'add_image_size' ) ) 
		{ 
			add_image_size( 'blog_thumb', 220, 165, true ); 
			add_image_size( 'blog_medium', 412, 232, true ); 
		}		
	
		/* ------------------------------------
		:: POST FORMATS SUPPORT
		------------------------------------ */
	
		add_theme_support( 'post-formats', array( 'aside', 'link', 'status', 'quote', 'image' , 'video', 'audio', 'gallery' ));
	
		/* ------------------------------------
		:: AUTOMATIC FEED LINKS
		------------------------------------ */
	
		add_theme_support( 'automatic-feed-links' );
		
		
		/* ------------------------------------
		:: TRANSLATION
		------------------------------------ */
	
		load_theme_textdomain( 'dynamix', get_template_directory() . '/languages' );
	
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		
		if ( is_readable( $locale_file ) )
		{
			require_once( $locale_file );
		}
	
		/* ------------------------------------
		:: BUILD SKIN PRESETS + CUSTOMIZER
		------------------------------------ */
		
		if( is_admin() )
		{
			acoda_skin_presets();	
		}
		
		/* ------------------------------------
		:: VISUAL COMPOSER EXTENDED
		------------------------------------ */
		
		require_once get_template_directory() .'/lib/inc/shortcodes.php';

		/* ------------------------------------
		:: WOOCOMMERCE
		------------------------------------ */
		
		add_theme_support( 'wc-product-gallery-zoom' );
    	add_theme_support( 'wc-product-gallery-lightbox' );
    	add_theme_support( 'wc-product-gallery-slider' );
		
	}
	
	add_action( 'after_setup_theme', 'acoda_theme_setup' );	

	$theme_options = get_option('dynamix_options');

	if( !empty( $theme_options['jquery_migrate_disable'] ) )
	{
		if( $theme_options['jquery_migrate_disable'] == true )
		{
			function acoda_remove_jquery_migrate( $scripts ) {
				if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
					$script = $scripts->registered['jquery'];

					if ( $script->deps ) { // Check whether the script has any dependencies
						$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
					}
				}
			}	

			add_action( 'wp_default_scripts', 'acoda_remove_jquery_migrate' );
		}
	}

	if( !empty( $theme_options['emoji_disable'] )  )
	{
		if( !empty( $theme_options['emoji_disable'] ) )
		{		
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
			remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
			remove_action( 'admin_print_styles', 'print_emoji_styles' );	
		}
	}