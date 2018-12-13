<?php
/**
 * undercore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package undercore
 */

if ( ! function_exists( 'undercore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * NOTE: Gutenberg add_theme_supports are defined here, but most functions are
	 * in inc/gutenberg.php
	 */
	function undercore_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on undercore, use a find and replace
		 * to change 'undercore' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'undercore', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'undercore' ),
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
		add_theme_support( 'custom-background', apply_filters( 'undercore_custom_background_args', array(
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

		/**
		 *                                                  djh Dec 13, 2018
		 * Add custom color palette to the editor.
		 * Uses default Foundation 6 colors, or custom Theme Settings
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
		 */
		$editor_color_palette = undercore_gutenberg_editor_color_palette();
		add_theme_support( 'editor-color-palette', $editor_color_palette );


		/**
		 *                                                  djh Dec 13, 2018
		 * Add custom font sizes to the editor.
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
		 */
		$editor_font_sizes = undercore_gutenberg_editor_font_sizes();
		add_theme_support( 'editor-font-sizes', $editor_font_sizes );
		// turn off custom font sizes by default
		if ( ! get_option( 'options_uc_allow_custom_font_sizes' ) ) {
			add_theme_support('disable-custom-font-sizes');
		}


		/**
		 *                                                  djh Dec 13, 2018
		 * Add support for responsive embeds.
		 *
		 */
		add_theme_support( 'responsive-embeds' );


		/**
		 *                                                  djh Dec 13, 2018
		 * Add support for Block Styles.
		 * @todo set css for block styles
		 */
		add_theme_support( 'wp-block-styles' );


		/**
		 *                                                  djh Dec 13, 2018
		 * Add support for full/wide-align images.
		 * @todo set css for align-wide images
		 */ 
		add_theme_support( 'align-wide' );


	}
endif;
add_action( 'after_setup_theme', 'undercore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function undercore_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'undercore_content_width', 640 );
}
add_action( 'after_setup_theme', 'undercore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function undercore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'undercore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'undercore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'undercore_widgets_init' );

/**
 * Enqueue scripts and styles.
 * TODO: Split Foundation into separate css files, 
 *       enqueue conditionally from Theme Settings > Site Configuration
 *       Document Fast Velocity Minify settings for combination
 */
function undercore_scripts() {
	$version = undercore_current_version();

	// EXAMPLES
	// wp_enqueue_style( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
	// wp_enqueue_script( string $handle, string $src = '', array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )

	wp_enqueue_style( 'undercore-style', get_stylesheet_uri() );

	wp_enqueue_style( 'undercore-styles', get_template_directory_uri() . '/dist/assets/css/styles.css', array(), $version, 'all');

	wp_enqueue_script( 'undercore-navigation', get_template_directory_uri() . '/dist/assets/js/navigation.js', array(), $version, true );

	wp_enqueue_script( 'undercore-skip-link-focus-fix', get_template_directory_uri() . '/dist/assets/js/skip-link-focus-fix.js', array(), $version, true );

	// Enqueue Foundation scripts
	wp_enqueue_script( 'foundation-scripts', get_template_directory_uri() . '/dist/assets/js/app.js', array( 'jquery' ), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'undercore_scripts' );


/**
 * Helper functions.     DJH Dec 12, 2018
 */
require get_template_directory() . '/inc/helpers.php';

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
 * Gutenberg customizations.     DJH Dec 13, 2018
 */
require get_template_directory() . '/inc/gutenberg.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load Advanced Custom Fields compatibility file. DJH Dec 12, 2018 
 */
if ( function_exists('acf_add_options_page') ) {
    require get_template_directory() . '/inc/acf.php';
}



