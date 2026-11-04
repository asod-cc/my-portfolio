<?php
/**
 * Aurora theme functions.
 *
 * @package Aurora
 */

defined( 'ABSPATH' ) || exit;

define( 'AURORA_VERSION', '1.0.0' );

/**
 * Theme setup: editor styles and supports.
 */
function aurora_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_editor_style( 'assets/css/theme.css' );
}
add_action( 'after_setup_theme', 'aurora_setup' );

/**
 * Front-end assets.
 */
function aurora_assets() {
	wp_enqueue_style( 'aurora', get_theme_file_uri( 'assets/css/theme.css' ), array(), AURORA_VERSION );
	wp_enqueue_script( 'aurora', get_theme_file_uri( 'assets/js/theme.js' ), array(), AURORA_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'aurora_assets' );

/**
 * Pattern categories so the patterns are easy to find in the inserter.
 */
function aurora_pattern_categories() {
	register_block_pattern_category( 'aurora', array( 'label' => __( 'Aurora: Sections', 'aurora' ) ) );
	register_block_pattern_category( 'aurora-pages', array( 'label' => __( 'Aurora: Full pages', 'aurora' ) ) );
}
add_action( 'init', 'aurora_pattern_categories' );

/**
 * Extra block styles selectable from the block sidebar.
 */
function aurora_block_styles() {
	register_block_style( 'core/group', array( 'name' => 'glass', 'label' => __( 'Glass card', 'aurora' ) ) );
	register_block_style( 'core/heading', array( 'name' => 'gradient', 'label' => __( 'Gradient text', 'aurora' ) ) );
	register_block_style( 'core/button', array( 'name' => 'ghost', 'label' => __( 'Ghost', 'aurora' ) ) );
	register_block_style( 'core/button', array( 'name' => 'glow', 'label' => __( 'Gradient glow', 'aurora' ) ) );
	register_block_style( 'core/image', array( 'name' => 'framed', 'label' => __( 'Browser frame', 'aurora' ) ) );
	register_block_style( 'core/list', array( 'name' => 'checks', 'label' => __( 'Check marks', 'aurora' ) ) );
}
add_action( 'init', 'aurora_block_styles' );

/**
 * Elementor compatibility: let Elementor Pro theme-builder use every location.
 */
add_action(
	'elementor/theme/register_locations',
	function ( $manager ) {
		$manager->register_all_core_location();
	}
);

/**
 * Preload the two main fonts to avoid a flash of fallback text.
 */
function aurora_preload_fonts() {
	foreach ( array( 'inter-latin-400-normal.woff2', 'instrument-serif-latin-400-normal.woff2' ) as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $font ) )
		);
	}
}
add_action( 'wp_head', 'aurora_preload_fonts', 1 );

/**
 * Theme colour for mobile browsers.
 */
add_action(
	'wp_head',
	function () {
		echo '<meta name="theme-color" content="#07070d">' . "\n";
	},
	2
);
