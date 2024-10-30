<?php
	namespace MasterInstagramElementor;

	if (!defined('ABSPATH')) { exit; } // No, Direct access Sir !!!

	if( !class_exists('Master_Instagram_Feed_Elementor') ){

		final class Master_Instagram_Feed_Elementor {

			const VERSION = "1.0.0";


			private $_localize_settings = [];

			private static $plugin_path;
			private static $plugin_url;
			private static $plugin_slug;
			public static $plugin_dir_url;
			public static $plugin_name;

			private static $instance = null;

			public $pro_enabled;

			public static $miel_default_widgets;
			public static $miel_extensions;


			public static function get_instance() {
				if ( ! self::$instance ) {
					self::$instance = new self;

					self::$instance -> miel_init();
				}

				return self::$instance;
			}


			public function __construct() {

				$this->miel_constants();

				self::$plugin_slug = 'master-instagram-for-elementor';
				self::$plugin_path = untrailingslashit( plugin_dir_path( '/', __FILE__ ) );
				self::$plugin_url  = untrailingslashit( plugins_url( '/', __FILE__ ) );

				// Initialize Plugin
				add_action('plugins_loaded', [$this, 'miel_plugins_loaded']);

				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'miel_plugin_actions_links' ] );

				// Enqueue Styles and Scripts
				add_action( 'wp_enqueue_scripts', [ $this, 'miel_enqueue_scripts' ] );


				//Body Class
				add_filter( 'body_class', [ $this, 'miel_ea_body_class' ] );
				
				
			}
			



			public function miel_init_widgets() {

				//Master Instagram for Elementor for Elementor 
				require_once MIEL_ADDON . 'master-instagram-feed.php';

				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Addon\Master_Instagram_Feed() );	

			}



			/**
			 * Enqueue Plugin Styles and Scripts
			 *
			 */
			public function miel_enqueue_scripts() {


				
				wp_register_style( 'master-instagram-style', MIEL_PLUGIN_URL . '/assets/css/master-instagram-style.css' );
				wp_register_script( 'isotope', MIEL_PLUGIN_URL . '/assets/js/isotope.js', array('jquery'), '', true );

				// Master Table Enqueue Scripts */
				wp_enqueue_style('master-instagram-style');

				wp_enqueue_script( 'master-instagram-script', MIEL_PLUGIN_URL . '/assets/js/master-instagram-script.js', [ 'jquery' ], self::VERSION, true );

			}


			public function is_elementor_activated( $plugin_path = 'elementor/elementor.php' ) {
				$installed_plugins_list = get_plugins();

				return isset( $installed_plugins_list[ $plugin_path ] );
			}




		}


		Master_Instagram_Feed_Elementor::get_instance();

	}