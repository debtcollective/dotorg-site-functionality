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
	}

	/**
	 * Dependencies
	 *
	 * @return void
	 */
	function dependencies() {
		include_once SITE_CORE_DIR . '/src/admin/options.php';
		$options = new Options( $this->version, $this->plugin_name );
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
