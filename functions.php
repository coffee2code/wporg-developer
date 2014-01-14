<?php
/**
 * wporg-developer functions and definitions
 *
 * @package wporg-developer
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wporg_developer_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wporg_developer_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wporg-developer, use a find and replace
	 * to change 'wporg-developer' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wporg-developer', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

}
endif; // wporg_developer_setup
add_action( 'after_setup_theme', 'wporg_developer_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function wporg_developer_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wporg-developer' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="box gray widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1><div class="widget-content">',
	) );
}
add_action( 'widgets_init', 'wporg_developer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wporg_developer_scripts() {
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600' );

	wp_enqueue_style( 'wporg-developer-style', get_stylesheet_uri() );

	wp_enqueue_style( 'wp-dev-sass-compiled', get_template_directory_uri() . '/main.css', array( 'wporg-developer-style' ) );

	wp_enqueue_script( 'wporg-developer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wporg-developer-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wporg_developer_scripts' );

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
