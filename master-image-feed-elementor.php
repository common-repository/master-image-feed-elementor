<?php
/**
 * Plugin Name: Master Image Feed for Elementor
 * Plugin URI:  https://master-addons.com/demos/instagram-feed/
 * Description: Most advanced and feature rich Image Feed Addons for Elementor. It has Image Feed(Grid), Card Design, Masonry, Carousel, Lightbox etc
 * Version:     1.0.2
 * Author:      Jewel Theme
 * Author URI:  https://jeweltheme.com
 * Text Domain: master-image-feed-elementor
 * Domain Path: languages/
 * License:     GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package master-image-feed-elementor
 */

/*
 * don't call the file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( esc_html__( 'You can\'t access this page', 'master-image-feed-elementor' ) );
}

$jltelimf_plugin_data = get_file_data(
	__FILE__,
	array(
		'Version'     => 'Version',
		'Plugin Name' => 'Plugin Name',
		'Author'      => 'Author',
		'Description' => 'Description',
		'Plugin URI'  => 'Plugin URI',
	),
	false
);

// Define Constants.
if ( ! defined( 'JLTELIMF' ) ) {
	define( 'JLTELIMF', $jltelimf_plugin_data['Plugin Name'] );
}

if ( ! defined( 'JLTELIMF_VER' ) ) {
	define( 'JLTELIMF_VER', $jltelimf_plugin_data['Version'] );
}

if ( ! defined( 'JLTELIMF_AUTHOR' ) ) {
	define( 'JLTELIMF_AUTHOR', $jltelimf_plugin_data['Author'] );
}

if ( ! defined( 'JLTELIMF_DESC' ) ) {
	define( 'JLTELIMF_DESC', $jltelimf_plugin_data['Author'] );
}

if ( ! defined( 'JLTELIMF_URI' ) ) {
	define( 'JLTELIMF_URI', $jltelimf_plugin_data['Plugin URI'] );
}

if ( ! defined( 'JLTELIMF_DIR' ) ) {
	define( 'JLTELIMF_DIR', __DIR__ );
}

if ( ! defined( 'JLTELIMF_FILE' ) ) {
	define( 'JLTELIMF_FILE', __FILE__ );
}

if ( ! defined( 'JLTELIMF_SLUG' ) ) {
	define( 'JLTELIMF_SLUG', dirname( plugin_basename( __FILE__ ) ) );
}

if ( ! defined( 'JLTELIMF_BASE' ) ) {
	define( 'JLTELIMF_BASE', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'JLTELIMF_PATH' ) ) {
	define( 'JLTELIMF_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( ! defined( 'JLTELIMF_URL' ) ) {
	define( 'JLTELIMF_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
}

if ( ! defined( 'JLTELIMF_INC' ) ) {
	define( 'JLTELIMF_INC', JLTELIMF_PATH . '/Inc/' );
}

if ( ! defined( 'JLTELIMF_LIBS' ) ) {
	define( 'JLTELIMF_LIBS', JLTELIMF_PATH . 'Libs' );
}

if ( ! defined( 'JLTELIMF_ASSETS' ) ) {
	define( 'JLTELIMF_ASSETS', JLTELIMF_URL . 'assets/' );
}

if ( ! defined( 'JLTELIMF_IMAGES' ) ) {
	define( 'JLTELIMF_IMAGES', JLTELIMF_ASSETS . 'images' );
}

if ( ! class_exists( '\\JLTELIMF\\JLT_Elementor_Image_Feed' ) ) {
	// Autoload Files.
	include_once JLTELIMF_DIR . '/vendor/autoload.php';
	// Instantiate JLT_Elementor_Image_Feed Class.
	include_once JLTELIMF_DIR . '/class-master-image-feed-elementor.php';
}