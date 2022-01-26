<?php
/**
 * Contact Form 7 Integration
 *
 * @since   1.0.0
 * @package Site_Functionality
 */

namespace Site_Functionality\Integration\ContactForm7;

use Site_Functionality\Abstracts\Base;
use Site_Functionality\Integration\ContactForm7\Options;
use Site_Functionality\Integration\ContactForm7\Process;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ContactForm7 extends Base {

	public const POST_TYPE = 'wpcf7_contact_form';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		if ( class_exists( '\WPCF7_ContactForm' ) ) {
			$this->dependencies();
		}
	}

	/**
	 * Dependencies
	 *
	 * @return void
	 */
	function dependencies() {
		include_once SITE_CORE_DIR . '/src/integration/contact-form-7/options.php';
		$options = new Options( $this->version, $this->plugin_name );

		include_once SITE_CORE_DIR . '/src/integration/contact-form-7/process.php';
		$process = new Process( $this->version, $this->plugin_name );
	}

}
