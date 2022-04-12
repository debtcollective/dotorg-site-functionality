<?php
/**
 * Admin Customizations
 *
 * @since   1.0.0
 * @package Site_Functionality
 */

namespace Site_Functionality\Admin;

use Site_Functionality\Abstracts\Base;
use Site_Functionality\Admin\Options;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin extends Base {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		$this->dependencies();
		\add_filter( 'WpActionNetworkEvents\App\General\PostTypes\Event\Args', array( $this, 'modify_admin_menu' ) );
		\remove_action( 'admin_notices', 'lyte_admin_nag_apikey' );
	}

	/**
	 * Dependencies
	 *
	 * @return void
	 */
	public function dependencies() {
		include_once SITE_CORE_DIR . '/src/admin/options.php';
		$options = new Options( $this->version, $this->plugin_name );
	}

	/**
	 * Modify Admin Menu Name
	 *
	 * @param array $args
	 * @return array $args
	 */
	public function modify_admin_menu( $args ) {
		$args['labels']['menu_name'] = esc_attr__( 'Events', 'wp-action-network-events' );
		return $args;
	}

	/**
	 * Load admin JS
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 *
	 * @param string $hook
	 * @return void
	 */
	function admin_enqueue_scripts( $hook ) {
		\wp_enqueue_script( 'site-functionality-admin-js', SITE_CORE_DIR_URI . 'assets/js/admin.js', array( 'jquery' ), '', true );
	}

}
