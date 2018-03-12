<?php
/**
 * Surfing-Chef functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Surfing-Chef
 */

if ( ! function_exists( 'surfing_chef_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function surfing_chef_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Surfing-Chef, use a find and replace
		 * to change 'surfing_chef' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'surfing_chef', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'surfing_chef' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'surfing_chef_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'surfing_chef_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function surfing_chef_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'surfing_chef_content_width', 640 );
}
add_action( 'after_setup_theme', 'surfing_chef_content_width', 0 );

/**
 * Register widget area(s).
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function surfing_chef_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'surfing_chef' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'surfing_chef' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Bar', 'surfing_chef' ),
		'id'            => 'top-bar',
		'class'         => '',
		'description'   => esc_html__( 'Add stuff here.', 'surfing_chef' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'surfing_chef_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function surfing_chef_scripts() {
	// Within <HEAD>
	
	// css and svg fontawesome made available
	wp_enqueue_style( 'surfing_chef-font-awesome-css', "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" );
	wp_enqueue_script( 'surfing_chef-font-awesome-svg', ("https://use.fontawesome.com/releases/v5.0.8/js/all.js" ), array(), false, false);
	
	// Within <BODY>

	// ensure jquery is loaded once
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), false, true);
	

	wp_enqueue_script('sc-custom-script', get_template_directory_uri() .'/js/sc-scripts.js', array('jquery'), false, true);

	// wp_enqueue_script( 'surfing_chef-navigation', get_template_directory_uri() . '/js/navigation.js', array(), false, true );

	// wp_enqueue_script( 'surfing_chef-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), false, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'surfing_chef-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'surfing_chef_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

