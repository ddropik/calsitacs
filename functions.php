<?php
/**
 * CALSboilerplate_underscores functions and definitions
 *
 * @package CALSboilerplate_underscores
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'calsboilerplate_underscores_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function calsboilerplate_underscores_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on CALSboilerplate_underscores, use a find and replace
	 * to change 'calsboilerplate_underscores' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'calsboilerplate_underscores', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'calsboilerplate_underscores' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'calsboilerplate_underscores_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // calsboilerplate_underscores_setup
add_action( 'after_setup_theme', 'calsboilerplate_underscores_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function calsboilerplate_underscores_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'calsboilerplate_underscores' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'calsboilerplate_underscores_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function calsboilerplate_underscores_scripts() {
	wp_enqueue_style( 'calsboilerplate_underscores-style', get_stylesheet_uri() );

	wp_enqueue_script( 'calsboilerplate_underscores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'calsboilerplate_underscores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'calsboilerplate_underscores_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//Page Slug Body Class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/*
 To display dynamically generated Copyright date in the footer
 Credits to:  http://www.wpbeginner.com/wp-tutorials/how-to-add-a-dynamic-copyright-date-in-wordpress-footer/
 */
function comicpress_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}



/**
 * Register,enqueue and localize scripts for itacs ajax
 * @return [none] [description]
 */
function itacs_ajax_scripts(){

wp_register_script( 'ajaxjs', get_template_directory_uri() . '/js/ajax.js', array('jquery')); //register the script for later use in enqueue_script

wp_enqueue_script('ajaxjs'); //enque script

//Params: associate script handle, define response object name, make php data available to script(wordpress expects ajaxurl for ajax to work)
wp_localize_script( 'ajaxjs', 'MyAjax',  
	array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'my-special-string' )
		) 
);

} //END function itacs_ajax_scripts()

//hook itacs_ajax_scripts function into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'itacs_ajax_scripts' );


/**
 * The ajax server side event handler, it passes data to the javascript success callback function.
 * @return String returns JSON encoded string as the response to the JQuery Ajax request
 */
function itacs_ajax_callback(){ 
	
	$args = array( //parameters for get_posts function
	'posts_per_page'   => -1,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => '',
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'post_status'      => 'publish',
	'suppress_filters' => true 
	);

	$posts_array = get_posts( $args ); //variable containing all post data

	$newArray = array(); //declare an empty array to contain modifified version of $posts_array



	//iterate over $posts_array to add 'post_permalink' property to $newArray
	foreach($posts_array as $key_0 => $val_0){

		$newArray[$key_0]=$val_0; //duplicate all key-value pairs of posts_array object

		$thisID = $newArray[$key_0]->ID; //declare and define new variable for the ID property of the currently selected iteration

		$newArray[$key_0]->post_permalink = get_permalink($thisID); //add property 'post_permalink' for the permalink of currently selected iteration

	}

	$JSON_posts_array = json_encode($newArray); //Pass data from PHP array to JSON String using json_encode

	check_ajax_referer( 'my-special-string', 'security');
 	
	header( "Content-Type: application/json" ); //Explicity defines Content type as JSON

	echo $JSON_posts_array;
 	
	die(); // this is required to return a proper result
}

if ( is_admin() ) {
    add_action( 'wp_ajax_my_frontend_action', 'itacs_ajax_callback' ); // for users logged in, on frontend
    add_action( 'wp_ajax_nopriv_my_frontend_action', 'itacs_ajax_callback' ); // for non-logged in users, frontend
    //add_action( 'wp_ajax_my_backend_action', 'itacs_ajax_callback' ); //for logged in back end users
    // Add other back-end action hooks here
} else {
    // Add non-Ajax front-end action hooks here
}






