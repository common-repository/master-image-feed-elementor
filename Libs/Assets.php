<?php
namespace JLTELIMF\Libs;

// No, Direct access Sir !!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Assets' ) ) {

	/**
	 * Assets Class
	 *
	 * Jewel Theme <support@jeweltheme.com>
	 * @version     1.0.2
	 */
	class Assets {

		/**
		 * Constructor method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'jltelimf_enqueue_scripts' ), 100 );
			add_action( 'admin_enqueue_scripts', array( $this, 'jltelimf_admin_enqueue_scripts' ), 100 );


			// Elementor Dependencies
			add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'jltelimf_editor_styles' ]);
		}

		/**
		 *
		 * Enqueue Elementor Editor Styles
		 *
		 */
		public function jltelimf_editor_styles() {
			wp_enqueue_style( 'master-image-feed-elementor-editor', JLTELIMF_ASSETS . 'css/master-image-feed-elementor-editor.css' );
		}


		/**
		 * Get environment mode
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function get_mode() {
			return defined( 'WP_DEBUG' ) && WP_DEBUG ? 'development' : 'production';
		}

		/**
		 * Enqueue Scripts
		 *
		 * @method wp_enqueue_scripts()
		 */
		public function jltelimf_enqueue_scripts() {

			// CSS Files .
			wp_enqueue_style( 'master-image-feed-elementor-frontend', JLTELIMF_ASSETS . 'css/master-image-feed-elementor-frontend.css', JLTELIMF_VER, 'all' );

			// JS Files .
			wp_register_script( 'master-image-feed-elementor-isotope', JLTELIMF_ASSETS . 'js/isotope.js', array('jquery'), '', true );
			wp_enqueue_script( 'master-image-feed-elementor-frontend', JLTELIMF_ASSETS . 'js/master-image-feed-elementor-frontend.js', array( 'jquery' ), JLTELIMF_VER, true );
		}


		/**
		 * Enqueue Scripts
		 *
		 * @method admin_enqueue_scripts()
		 */
		public function jltelimf_admin_enqueue_scripts() {
			// CSS Files .
			wp_enqueue_style( 'master-image-feed-elementor-admin', JLTELIMF_ASSETS . 'css/master-image-feed-elementor-admin.css', array( 'dashicons' ), JLTELIMF_VER, 'all' );

			// JS Files .
			wp_enqueue_script( 'master-image-feed-elementor-admin', JLTELIMF_ASSETS . 'js/master-image-feed-elementor-admin.js', array( 'jquery' ), JLTELIMF_VER, true );
			wp_localize_script(
				'master-image-feed-elementor-admin',
				'JLTELIMFCORE',
				array(
					'admin_ajax'        => admin_url( 'admin-ajax.php' ),
					'recommended_nonce' => wp_create_nonce( 'jltelimf_recommended_nonce' ),
				)
			);
		}
	}
}