<?php

namespace DevHub;

/**
 * Custom template tags for this theme.
 */
require __DIR__ . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require __DIR__ . '/inc/extras.php';

/**
 * Customizer additions.
 */
require __DIR__ . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require __DIR__ . '/inc/jetpack.php';

if ( ! function_exists( 'loop_pagination' ) ) {
	require __DIR__ . '/php/loop-pagination.php';
}

if ( ! function_exists( 'breadcrumb_trail' ) ) {
	require __DIR__ . '/php/breadcrumb-trail.php';
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}


add_action( 'init', __NAMESPACE__ . '\\init' );


function init() {

	register_post_types();
	register_taxonomies();
	add_action( 'widgets_init', __NAMESPACE__ . '\\widgets_init' );
	add_action( 'pre_get_posts', __NAMESPACE__ . '\\pre_get_posts' );
	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\theme_scripts_styles' );
	add_filter( 'post_type_link', __NAMESPACE__ . '\\method_permalink', 10, 2 );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
}


/**
 * widgets_init function.
 *
 * @access public
 * @return void
 */
function widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wporg-developer' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="box gray widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1><div class="widget-content">',
	) );
}

/**
 * @param \WP_Query $query
 */
function pre_get_posts( $query ) {

	if ( $query->is_main_query() && $query->is_post_type_archive() ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}
}

/**
 * Register the function and class post types
 */
function register_post_types() {
	$supports = array(
		'comments',
		'custom-fields',
		'editor',
		'excerpt',
		'revisions',
		'title',
	);

	// Functions
	register_post_type( 'wpapi-function', array(
		'has_archive' => 'functions',
		'label' => __( 'Functions', 'wporg' ),
		'public' => true,
		'rewrite' => array(
			'feeds' => false,
			'slug' => 'reference/function',
			'with_front' => false,
		),
		'supports' => $supports,
	) );

	// Methods
	add_rewrite_rule( 'method/([^/]+)/([^/]+)/?$', 'index.php?post_type=wpapi-function&name=$matches[1]-$matches[2]', 'top' );

	// Classes
	register_post_type( 'wpapi-class', array(
		'has_archive' => 'classes',
		'label' => __( 'Classes', 'wporg' ),
		'public' => true,
		'rewrite' => array(
			'feeds' => false,
			'slug' => 'reference/class',
			'with_front' => false,
		),
		'supports' => $supports,
	) );

	// Hooks
	register_post_type( 'wpapi-hook', array(
		'has_archive' => 'hooks',
		'label' => __( 'Hooks', 'wporg' ),
		'public' => true,
		'rewrite' => array(
			'feeds' => false,
			'slug' => 'reference/hook',
			'with_front' => false,
		),
		'supports' => $supports,
	) );
}

/**
 * Register the file and @since taxonomies
 */
function register_taxonomies() {
	// Files
	register_taxonomy( 'wpapi-source-file', array( 'wpapi-class', 'wpapi-function', 'wpapi-hook' ), array(
		'label'                 => __( 'Files', 'wporg' ),
		'public'                => true,
		'rewrite'               => array( 'slug' => 'reference/files' ),
		'sort'                  => false,
		'update_count_callback' => '_update_post_term_count',
	) );

	// Package
	register_taxonomy( 'wpapi-package', array( 'wpapi-class', 'wpapi-function', 'wpapi-hook' ), array(
		'hierarchical'          => true,
		'label'                 => '@package',
		'public'                => true,
		'rewrite'               => array( 'slug' => 'reference/package' ),
		'sort'                  => false,
		'update_count_callback' => '_update_post_term_count',
	) );

	// @since
	register_taxonomy( 'wpapi-since', array( 'wpapi-class', 'wpapi-function', 'wpapi-hook' ), array(
		'hierarchical'          => true,
		'label'                 => __( '@since', 'wporg' ),
		'public'                => true,
		'rewrite'               => array( 'slug' => 'reference/since' ),
		'sort'                  => false,
		'update_count_callback' => '_update_post_term_count',
	) );
}

function method_permalink( $link, $post ) {
	if ( $post->post_type !== 'wpapi-function' || $post->post_parent == 0 )
		return $link;

	list( $class, $method ) = explode( '-', $post->post_name );
	$link = home_url( user_trailingslashit( "method/$class/$method" ) );
	return $link;
}

function theme_scripts_styles() {
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