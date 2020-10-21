<?php
//links child theme to parent theme
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// changes length of exerpt
function new_excerpt_length($length) {
    return 60;
}
add_filter('excerpt_length', 'new_excerpt_length');


// Fixes empty <p> and <br> tags showing before and after shortcodes in the output content.
function pb_the_content_shortcode_fix($content) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
        ']<br>'   => ']'
    );
    return strtr($content, $array);
}
add_filter('the_content', 'pb_the_content_shortcode_fix');

// Adds Referral Tracking to Contact Form 7
function getRefererPage( $form_tag )
{
if (isset($_SERVER['HTTP_REFERER']) && $form_tag['name'] == 'referer-page' ) {
$form_tag['values'][] = htmlspecialchars($_SERVER['HTTP_REFERER']);
}
return $form_tag;
}
if ( !is_admin() ) {
add_filter( 'wpcf7_form_tag', 'getRefererPage' );
}

// Adds Custom field validation in CF7
add_filter( 'wpcf7_validate_text', 'alphanumeric_validation_filter', 20, 2 );
add_filter( 'wpcf7_validate_text*', 'alphanumeric_validation_filter', 20, 2 );

function alphanumeric_validation_filter( $result, $tag ) {
$tag = new WPCF7_Shortcode( $tag );

if ( 'ticket-pre' == $tag->name ) {
$name_of_the_input = isset( $_POST['ticket-pre'] ) ? trim( $_POST['ticket-pre'] ) : '';

if ( !preg_match('~\b(bhmed|yead)\b~i',$name_of_the_input) ) {
$result->invalidate( $tag, "Allowed characters are alphanumeric only" );
}
}

return $result;
}
// Adds Custom Fields to DPS
add_filter( 'display_posts_shortcode_output', 'be_display_posts_custom_fields', 10, 6 );
function be_display_posts_custom_fields( $output, $atts, $image, $title, $date, $excerpt ) {
	// Get our custom fields
	global $post;
	$community = esc_attr( get_post_meta( $post->ID, 'community', true ) );
	$image_url = esc_attr( get_post_meta( $post->ID, 'image_url', true ) );
	$views = esc_attr( get_post_meta( $post->ID, 'views', true ) );
	$likes = esc_attr( get_post_meta( $post->ID, 'likes', true ) );
	$follows = esc_attr( get_post_meta( $post->ID, 'follows', true ) );
	$comments = esc_attr( get_post_meta( $post->ID, 'comments', true ) );
	$post_url = esc_attr( get_post_meta( $post->ID, 'post_url', true ) );
	// If there's a value for the custom field, let's wrap them with <span>'s so you can control them with CSS
	if( isset( $community ) ) $community = '<span class="community ' . $community . '">' . $community . '</span> ';
	if( isset( $image_url ) ) $image_url = '<img src="' . $image_url . '" class="image-url" />';
	if( isset( $views ) ) $views = '<span class="views">' . $views . '</span> ';
	if( isset( $likes ) ) $likes = '<span class="likes">' . $likes . '</span> ';
	if( isset( $follows ) ) $follows = '<span class="follows">' . $follows . '</span> ';
	if( isset( $comments ) ) $comments = '<span class="comments">' . $comments . '</span> ';
	if( isset( $post_url ) ) $post_url = '<a href="' . $post_url . '" target="_blank" class="post-url ga-home-content-preview"></a> ';
	// Now let's rebuild the output. 
	$output = '<li>' . $post_url . $community . $date . '<div class="box"><div class="left">' . $image . $image_url . '</div><div class="right">' . $title . $excerpt . '</div></div>' . $views . $likes . $follows . $comments . '<div class="read-more">Show More</div></li>';
	// Finally we'll return the modified output
	return $output;
}

?>
