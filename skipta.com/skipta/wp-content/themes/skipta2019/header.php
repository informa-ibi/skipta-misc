<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php if ( is_page('platformq') ) { ?>
	<script src="https://www.neuroserieslive.com/lms/js/pqEmbed/pqEmbed.js"></script>

	<?php } else { ?>
	<?php } ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
				<div class="site-branding">
					<a href="/" class="ga-top-logo"><img src="/wp-content/themes/skipta2019/images/skipta-informa-logo-top.png" alt="Skipta" class="main-logo"/></a>
					<div class="communities">Find Your Community</div>
				</div><!-- .site-branding -->

				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

					<div id="site-header-menu" class="site-header-menu">
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
											'menu_class' => 'primary-menu',
										)
									);
								?>
							</nav><!-- .main-navigation -->
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'social',
											'menu_class'  => 'social-links-menu',
											'depth'       => 1,
											'link_before' => '<span class="screen-reader-text">',
											'link_after'  => '</span>',
										)
									);
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
					</div><!-- .site-header-menu -->
				<?php endif; ?>
			</div><!-- .site-header-main -->

			<?php if ( get_header_image() ) : ?>
				<?php
					/**
					 * Filter the default twentysixteen custom header sizes attribute.
					 *
					 * @since Twenty Sixteen 1.0
					 *
					 * @param string $custom_header_sizes sizes attribute
					 * for Custom Header. Default '(max-width: 709px) 85vw,
					 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
					 */
					$custom_header_sizes = apply_filters( 'twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
				?>
				<div class="header-image">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div><!-- .header-image -->
			<?php endif; // End header image check. ?>
		</header><!-- .site-header -->
		
		<?php if ( is_front_page() ) {?>
		<style>
			.post-thumbnail {
				display: none;
			}
		</style>
		
		<?php } elseif ( is_page('platformq') ) {?>
		
		<?php } elseif ( is_page() ) {?>
		
		<?php } elseif ( is_home() ) {?>
		<style>
        /*** Blog - Feed ***/
		#banner {
            position: absolute;
            top: 43px;
            left: 17.7%;
            z-index: 1;
            font-size: 30px;
            line-height: 36px;
            font-style: italic;
            color: #7da329;
            font-weight: 400;
        }
        .site-main > article:first-of-type {
            margin-bottom: 0em;
            margin-top: 100px;
        }
        .site-main article {
	        background-color: #fff;
            border: solid 1px #d5d5d5;
            border-radius: 10px;
            padding: 30px;
            position: relative;
	        margin-bottom: 0em;
            margin-top: 20px;
            margin-left: 30px;
            margin-right: 30px;
        }
		.site-main article:last-of-type {
			margin-bottom: 2em;
	    }
		.site-content .post .entry-header {
            height: auto;
            background-image: none;
			margin: 55px 0 0 0;
         }
		.site-content .post .entry-header .entry-title {
            text-align: left;
            padding: 0;
            font-family: 'Gotham-Book', sans-serif;
            font-size: 18px;
            line-height: 1.6;
            margin: 0 0 0 150px;
        }
	    .site-content .post .entry-header .entry-title a {
            color: #007acc;
			font-style: normal;
        }
		.site-content .post .post-thumbnail {
            margin: 0;
            max-width: 130px;
            position: absolute;
            top: 90px;
        }   
		.site-content .post .entry-content {
            float: none !important;
            margin: 10px 0 0 150px;
            padding: 0;
            width: 87% !important;
        }
		.site-content .post .entry-footer {
            position: absolute;
            top: 20px;
		    width: 100% !important;
        }
		.site-content .post .entry-footer .byline .avatar {
            border: solid 1px #009acd;
            display: inline-block;
        }
		.site-content .post .entry-footer .byline .url {
            margin: 0 0 0 10px;
            font-weight: 800;
            font-family: 'Gotham-Book', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #009acd;
			box-shadow: none;
        }
		.site-content .post .entry-footer .posted-on {
            position: absolute;
			top: 15px;
			right: 60px;
			font-family: 'Gotham-Book', sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
		.site-content .post .entry-footer .posted-on a {
            color: #1f1f1f;
			box-shadow: none;
        }
		.site-content .post .entry-footer .cat-links {
            display: none;
        }	
		.site-content .post .entry-footer .edit-link {
            position: absolute;
            top: 160px;
        }		
		/*********************/
        /* Responsive Styles */
        /*********************/
        /* minimum 0px */
        @media (min-width: 0em) {
		    #banner {
                position: relative;
                top: 65px;
                left: auto;
				text-align: center;
			}
			.site-content .post .entry-footer {
                position: absolute;
                top: 10px;
                width: 86% !important;
            }
			.entry-footer > span:not(:last-child):after {
                content: "";
                display: none;
            }
			.site-content .post .entry-footer .posted-on {
                top: 0px;
                right: 0px;
		    }
			.site-content .post .post-thumbnail {
                margin: 5px 0;
                max-width: 100%;
                position: relative;
                top: 0px;
            }
			.site-content .post .entry-header .entry-title {
                margin: 0;
            }
			.site-content .post .entry-content {
                margin: 0;
                width: 100% !important;
            }
			.site-content .post .entry-content p {
				padding: 0;
            }
		/* minimum 910px */
        @media (min-width: 56.875em) {
		    #banner {
                position: absolute;
                top: 40px;
                left: 37%;
                text-align: left;
            }
		}
		/* minimum 985px */
		@media (min-width: 61.563em) {
		    .site-content .post .entry-footer {
                top: 20px;
                width: 90% !important;
            }
			.site-content .post .entry-footer .posted-on {
                top: 12px;
            }
		}
		/* minimum 1000px */
        @media (min-width: 62.500em) {
			#banner {
                left: 33%;
            }
		}
		/* minimum 1100px */
		@media (min-width: 68.750em) {
			#banner {
                left: 30%;
            }
		}	
		/* minimum 1200px */
		@media (min-width: 75.000em) {
			#banner {
                left: 27.5%;
            }
		}
		/* minimum 1300px */
		@media (min-width: 81.250em) {
			#banner {
                left: 25%;
            }
		}
		/* minimum 1400px */
		@media (min-width: 87.500em) {
			#banner {
                left: 23%;
            }
			.site-content .post .post-thumbnail {
                margin: 0;
                max-width: 130px;
                position: absolute;
                top: 90px;
            }
			.site-content .post .entry-header .entry-title {
                margin: 0 0 0 150px;
            }
			.site-content .post .entry-content {
                margin: 10px 0 0 150px;
                width: 79% !important;
            }
		}
		/* minimum 1550px */
		@media (min-width: 96.875em) {
			#banner {
                left: 21%;
            }
		}
		/* minimum 1750px */
		@media (min-width: 109.375em) {
		    #banner {
                left: 19%;
            }
			.site-content .post .entry-content {
                width: 85% !important;
            }
		}
		/* minimum 1900px */
		@media (min-width: 118.750em) {
			#banner {
                left: 17.7%;
            }
			.site-content .post .entry-content {
                width: 87% !important;
            }
		}

		</style>
        <div id="banner">Blog</div>
		
		<?php } elseif ( is_author() ) {?>
		<style>
		/*** Blog - By Author ***/
        #banner {
            position: absolute;
            top: 43px;
            left: 17.7%;
            z-index: 1;
            font-size: 30px;
            line-height: 36px;
            font-style: italic;
            color: #7da329;
            font-weight: 400;
        }
		#banner a {
			box-shadow: none;
			color: #7da329;
		}
        .site-main > article:first-of-type {
            margin-bottom: 0em;
            margin-top: 20px;
        }
        .site-main article {
	        background-color: #fff;
            border: solid 1px #d5d5d5;
            border-radius: 10px;
            padding: 30px;
            position: relative;
	        margin-bottom: 0em;
            margin-top: 20px;
            margin-left: 30px;
            margin-right: 30px;
        }
		.site-main article:last-of-type {
			margin-bottom: 2em;
	    }
		.site-main .page-header {
	        background-color: #fff;
            border: solid 1px #d5d5d5;
            border-radius: 10px;
            padding: 20px;
            position: relative;
	        margin-bottom: 0em;
            margin-top: 100px;
            margin-left: 30px;
            margin-right: 30px;
        }
		.site-main .page-header .page-title {
	        font-size: 24px;
            font-family: 'Gotham-Book', sans-serif;
            line-height: 30px;
            text-align: center;
        }
		.site-content .post .entry-header {
            height: auto;
            background-image: none;
			margin: 55px 0 0 0;
         }
		.site-content .post .entry-header .entry-title {
            text-align: left;
            padding: 0;
            font-family: 'Gotham-Book', sans-serif;
            font-size: 18px;
            line-height: 1.6;
            margin: 0 0 0 150px;
        }
	    .site-content .post .entry-header .entry-title a {
            color: #007acc;
			font-style: normal;
        }
		.site-content .post .post-thumbnail {
            margin: 0;
            max-width: 130px;
            position: absolute;
            top: 90px;
        }   
		.site-content .post .entry-content {
            float: none !important;
            margin: 10px 0 0 150px;
            padding: 0;
            width: 87% !important;
        }
		.site-content .post .entry-footer {
            position: absolute;
            top: 20px;
		    width: 100% !important;
        }
		.site-content .post .entry-footer .byline .avatar {
            border: solid 1px #009acd;
            display: inline-block;
        }
		.site-content .post .entry-footer .byline .url {
            margin: 0 0 0 10px;
            font-weight: 800;
            font-family: 'Gotham-Book', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #009acd;
			box-shadow: none;
        }
		.site-content .post .entry-footer .posted-on {
            position: absolute;
			top: 15px;
			right: 60px;
			font-family: 'Gotham-Book', sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
		.site-content .post .entry-footer .posted-on a {
            color: #1f1f1f;
			box-shadow: none;
        }
		.site-content .post .entry-footer .cat-links {
            display: none;
        }	
		.site-content .post .entry-footer .edit-link {
            position: absolute;
            top: 160px;
        }		
		/*********************/
        /* Responsive Styles */
        /*********************/
        /* minimum 0px */
        @media (min-width: 0em) {
		    #banner {
                position: relative;
                top: 65px;
                left: auto;
				text-align: center;
			}
			.site-content .post .entry-footer {
                position: absolute;
                top: 10px;
                width: 86% !important;
            }
			.entry-footer > span:not(:last-child):after {
                content: "";
                display: none;
            }
			.site-content .post .entry-footer .posted-on {
                top: 0px;
                right: 0px;
		    }
			.site-content .post .post-thumbnail {
                margin: 5px 0;
                max-width: 100%;
                position: relative;
                top: 0px;
            }
			.site-content .post .entry-header .entry-title {
                margin: 0;
            }
			.site-content .post .entry-content {
                margin: 0;
                width: 100% !important;
            }
			.site-content .post .entry-content p {
				padding: 0;
            }
		/* minimum 910px */
        @media (min-width: 56.875em) {
		    #banner {
                position: absolute;
                top: 40px;
                left: 37%;
                text-align: left;
            }
		}
		/* minimum 985px */
		@media (min-width: 61.563em) {
		    .site-content .post .entry-footer {
                top: 20px;
                width: 90% !important;
            }
			.site-content .post .entry-footer .posted-on {
                top: 12px;
            }
		}
		/* minimum 1000px */
        @media (min-width: 62.500em) {
			#banner {
                left: 33%;
            }
		}
		/* minimum 1100px */
		@media (min-width: 68.750em) {
			#banner {
                left: 30%;
            }
		}	
		/* minimum 1200px */
		@media (min-width: 75.000em) {
			#banner {
                left: 27.5%;
            }
		}
		/* minimum 1300px */
		@media (min-width: 81.250em) {
			#banner {
                left: 25%;
            }
		}
		/* minimum 1400px */
		@media (min-width: 87.500em) {
			#banner {
                left: 23%;
            }
			.site-content .post .post-thumbnail {
                margin: 0;
                max-width: 130px;
                position: absolute;
                top: 90px;
            }
			.site-content .post .entry-header .entry-title {
                margin: 0 0 0 150px;
            }
			.site-content .post .entry-content {
                margin: 10px 0 0 150px;
                width: 79% !important;
            }
		}
		/* minimum 1550px */
		@media (min-width: 96.875em) {
			#banner {
                left: 21%;
            }
		}
		/* minimum 1750px */
		@media (min-width: 109.375em) {
		    #banner {
                left: 19%;
            }
			.site-content .post .entry-content {
                width: 85% !important;
            }
		}
		/* minimum 1900px */
		@media (min-width: 118.750em) {
			#banner {
                left: 17.7%;
            }
			.site-content .post .entry-content {
                width: 87% !important;
            }
		}
			
		</style>
        <div id="banner"><a href="/blog" class="ga-blog-breadcrumb">Blog</a></div>
		<?php } else { ?>
		<style>
		/*** Blog ***/
        #banner {
            position: absolute;
            top: 43px;
            left: 17.7%;
            z-index: 1;
            font-size: 30px;
            line-height: 36px;
            font-style: italic;
            color: #7da329;
            font-weight: 400;
        }
		#banner a {
			box-shadow: none;
			color: #7da329;
		}
        .site-main > article:first-of-type {
            margin-bottom: 0em;
            margin-top: 100px;
        }
        .site-main article {
	        background-color: #fff;
            border: solid 1px #d5d5d5;
            border-radius: 10px;
            padding: 30px;
            position: relative;
	        margin-bottom: 0em;
            margin-top: 20px;
            margin-left: 30px;
            margin-right: 30px;
        }
		.site-main article:last-of-type {
			margin-bottom: 2em;
	    }
		.site-content .post .entry-header {
            height: auto;
            background-image: none;
			margin: 55px 0 0 0;
         }
		.site-content .post .entry-header .entry-title {
            text-align: left;
            padding: 0;
            font-family: 'Gotham-Book', sans-serif;
            font-size: 24px;
            line-height: 1.6;
            margin: 0;
			color: #1f1f1f;
			font-style: normal;
        }
	    .site-content .post .entry-header .entry-title a {
            color: #007acc;
			font-style: normal;
        }
		.site-content .post .post-thumbnail {
            margin: 10px 0 0 0;
            max-width: none;
            position: relative;
            top: 0;
        }   
		.site-content .post .entry-content {
            float: none !important;
            margin: 20px 0 0 0;
            padding: 0;
            width: 100% !important;
        }
		.site-content .post .entry-footer {
            position: absolute;
            top: 20px;
		    width: 100% !important;
        }
		.site-content .post .entry-footer .byline .avatar {
            border: solid 1px #009acd;
            display: inline-block;
        }
		.site-content .post .entry-footer .byline .url {
            margin: 0 0 0 10px;
            font-weight: 800;
            font-family: 'Gotham-Book', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #009acd;
			box-shadow: none;
        }
		.site-content .post .entry-footer .posted-on {
            position: absolute;
			top: 15px;
			right: 60px;
			font-family: 'Gotham-Book', sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
		.site-content .post .entry-footer .posted-on a {
            color: #1f1f1f;
			box-shadow: none;
        }
		.site-content .post .entry-footer .cat-links {
            display: none;
        }	
		.site-content .post .entry-footer .edit-link {
            position: absolute;
            top: 160px;
        }		
		.site-content .post-navigation {
			display: none;
		}
		/*********************/
        /* Responsive Styles */
        /*********************/
        /* minimum 0px */
        @media (min-width: 0em) {
		    #banner {
                position: relative;
                top: 65px;
                left: auto;
				text-align: center;
			}
			.site-content .post .entry-footer {
                position: absolute;
                top: 10px;
                width: 86% !important;
            }
			.entry-footer > span:not(:last-child):after {
                content: "";
                display: none;
            }
			.site-content .post .entry-footer .posted-on {
                top: 0px;
                right: 0px;
		    }
			.site-content .post .post-thumbnail {
                margin: 5px 0;
                max-width: 100%;
                position: relative;
                top: 0px;
            }
			.site-content .post .entry-header .entry-title {
                margin: 0;
            }
			.site-content .post .entry-content {
                margin: 0;
                width: 100% !important;
            }
			.site-content .post .entry-content p {
				padding: 0;
            }	
		/* minimum 910px */
        @media (min-width: 56.875em) {
		    #banner {
                position: absolute;
                top: 40px;
                left: 37%;
                text-align: left;
            }
		}
		/* minimum 985px */
		@media (min-width: 61.563em) {
		    .site-content .post .entry-footer {
                top: 20px;
                width: 90% !important;
            }
			.site-content .post .entry-footer .posted-on {
                top: 12px;
            }
		}
		/* minimum 1000px */
        @media (min-width: 62.500em) {
			#banner {
                left: 33%;
            }
		}
		/* minimum 1100px */
		@media (min-width: 68.750em) {
			#banner {
                left: 30%;
            }
		}	
		/* minimum 1200px */
		@media (min-width: 75.000em) {
			#banner {
                left: 27.5%;
            }
		}
		/* minimum 1300px */
		@media (min-width: 81.250em) {
			#banner {
                left: 25%;
            }
		}
		/* minimum 1400px */
		@media (min-width: 87.500em) {
			#banner {
                left: 23%;
            }
		}
		/* minimum 1550px */
		@media (min-width: 96.875em) {
			#banner {
                left: 21%;
            }
		}
		/* minimum 1750px */
		@media (min-width: 109.375em) {
		    #banner {
                left: 19%;
            }
		}
			
		</style>
        <div id="banner"><a href="/blog" class="ga-blog-breadcrumb">Blog</a></div>
        <?php } ?>
		
        <div id="content-wrapper">
		<div id="content" class="site-content">
