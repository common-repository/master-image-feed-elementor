<?php
namespace JLTELIMF\Inc\Classes;

use JLTELIMF\Libs\RowLinks;

if ( ! class_exists( 'Row_Links' ) ) {
	/**
	 * Row Links Class
	 *
	 * Jewel Theme <support@jeweltheme.com>
	 */
	class Row_Links extends RowLinks {

		public $is_active;
		public $is_free;

		/**
		 * Construct method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			parent::__construct();

			$this->is_active = false;
			$this->is_free   = true;
		}


		/**
		 * Plugin action links
		 *
		 * @param [type] $links .
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function plugin_action_links( $links ) {
            $links[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				'https://master-addons.com/demos/instagram-feed/',
				__( 'Demo', 'master-image-feed-elementor' )
			);
            $links[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				'https://master-addons.com/docs',
				__( 'Docs', 'master-image-feed-elementor' )
			);
            $links[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				'https://master-addons.com',
				__( 'Upgrade', 'master-image-feed-elementor' )
			);
            
			return $links;
		}
	}
}