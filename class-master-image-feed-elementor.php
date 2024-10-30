<?php
namespace JLTELIMF;

use JLTELIMF\Libs\Assets;
use JLTELIMF\Libs\Helper;
use JLTELIMF\Libs\Featured;
use JLTELIMF\Inc\Classes\Recommended_Plugins;
use JLTELIMF\Inc\Classes\Notifications\Notifications;
use JLTELIMF\Inc\Classes\Pro_Upgrade;
use JLTELIMF\Inc\Classes\Row_Links;
use JLTELIMF\Inc\Classes\Upgrade_Plugin;
use JLTELIMF\Inc\Classes\Feedback;
use JLTELIMF\Inc\Addon\Image_Feed;

/**
 * Main Class
 *
 * @master-image-feed-elementor
 * Jewel Theme <support@jeweltheme.com>
 * @version     1.0.2
 */

// No, Direct access Sir !!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * JLT_Elementor_Image_Feed Class
 */
if ( ! class_exists( '\JLTELIMF\JLT_Elementor_Image_Feed' ) ) {

	/**
	 * Class: JLT_Elementor_Image_Feed
	 */
	final class JLT_Elementor_Image_Feed {

		const VERSION            = JLTELIMF_VER;

		const MINIMUM_PHP_VERSION = '5.4';

		const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

		private static $instance = null;

		/**
		 * what we collect construct method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			$this->includes();
			add_action( 'plugins_loaded', array( $this, 'jltelimf_plugins_loaded' ), 999 );
			// This should run earlier .
			//dd_action( 'plugins_loaded', [ $this, 'jltelimf_maybe_run_upgrades' ], -100 ); .

			// Add Elementor Widgets
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'jltelimf_init_widgets' ] );			
		}


		/**
		 * Init Widget
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltelimf_init_widgets() {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Image_Feed() );	
		}


		/**
		 * plugins_loaded method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltelimf_plugins_loaded() {
			$this->jltelimf_activate();

			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', array( $this, 'jltelimf_notice_missing_main_plugin' ) );
				return;
			}

			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'jltelimf_notice_minimum_elementor_version' ) );
				return;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', array( $this, 'jltelimf_notice_minimum_php_version' ) );
				return;
			}			
		}



		public function jltelimf_notice_missing_main_plugin() {
			$plugin = 'elementor/elementor.php';

			if ( $this->is_elementor_activated() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message = sprintf( 'Master Image Feed requires <b>Elementor</b> plugin to be active. Please activate Elementor to continue.', MIEL_TD );
				$button_text = esc_html__( 'Activate Elementor', MIEL_TD );

			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}

				$activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$message = sprintf( esc_html__( 'Master Image Feed requires %1$s"Elementor"%2$s plugin to be installed and activated. Please install Elementor to continue.', MIEL_TD ), '<strong>', '</strong>' );
				$button_text = esc_html__( 'Install Elementor', MIEL_TD );
			}

			$button = '<p><a href="' . esc_url_raw( $activation_url ) . '" class="button-primary">' . esc_html( $button_text ) . '</a></p>';

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p>%2$s</div>', $message , $button );

		}

		public function jltelimf_notice_minimum_elementor_version() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', MIEL_TD ),
				'<strong>' . esc_html__( 'Master Image Feed for Elementor', MIEL_TD ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', MIEL_TD ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function jltelimf_notice_minimum_php_version() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', MIEL_TD ),
				'<strong>' . esc_html__( 'Master Image Feed for Elementor', MIEL_TD ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', MIEL_TD ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}


		/**
		 * Version Key
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public static function plugin_version_key() {
			return Helper::jltelimf_slug_cleanup() . '_version';
		}

		/**
		 * Activation Hook
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public static function jltelimf_activate() {
			$current_jltelimf_version = get_option( self::plugin_version_key(), null );

			if ( get_option( 'jltelimf_activation_time' ) === false ) {
				update_option( 'jltelimf_activation_time', strtotime( 'now' ) );
			}

			if ( is_null( $current_jltelimf_version ) ) {
				update_option( self::plugin_version_key(), self::VERSION );
			}

			$allowed = get_option( Helper::jltelimf_slug_cleanup() . '_allow_tracking', 'no' );

			// if it wasn't allowed before, do nothing .
			if ( 'yes' !== $allowed ) {
				return;
			}
			// re-schedule and delete the last sent time so we could force send again .
			$hook_name = Helper::jltelimf_slug_cleanup() . '_tracker_send_event';
			if ( ! wp_next_scheduled( $hook_name ) ) {
				wp_schedule_event( time(), 'weekly', $hook_name );
			}
		}



		/**
		 * Run Upgrader Class
		 *
		 * @return void
		 */
		public function jltelimf_maybe_run_upgrades() {
			if ( ! is_admin() && ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Run Upgrader .
			$upgrade = new Upgrade_Plugin();

			// Need to work on Upgrade Class .
			if ( $upgrade->if_updates_available() ) {
				$upgrade->run_updates();
			}
		}

		/**
		 * Include methods
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function includes() {
			new Assets();
			new Recommended_Plugins();
			new Row_Links();
			new Pro_Upgrade();
			new Notifications();
			new Featured();
			new Feedback();
		}


		/**
		 * Initialization
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltelimf_init() {
			$this->jltelimf_load_textdomain();
		}


		/**
		 * Text Domain
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltelimf_load_textdomain() {
			$domain = 'master-image-feed-elementor';
			$locale = apply_filters( 'jltelimf_plugin_locale', get_locale(), $domain );

			load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, false, dirname( JLTELIMF_BASE ) . '/languages/' );
		}
		
		
		

		/**
		 * Returns the singleton instance of the class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof JLT_Elementor_Image_Feed ) ) {
				self::$instance = new JLT_Elementor_Image_Feed();
				self::$instance->jltelimf_init();
			}

			return self::$instance;
		}
	}

	// Get Instant of JLT_Elementor_Image_Feed Class .
	JLT_Elementor_Image_Feed::get_instance();
}