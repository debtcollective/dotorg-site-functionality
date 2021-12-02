<?php
/**
 * Site Options Page
 *
 * @since   1.0.0
 * @package Core_Functionality
 */

namespace Site_Functionality\Admin;

use Site_Functionality\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Options extends Base {

	public $options = [];

	public const OPTION_NAME = 'web_components';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		\add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		\add_action( 'admin_init', [ $this, 'init_settings'  ] );

		$this->options = \get_option( self::OPTION_NAME );
	}

	/**
	 * Add Options Page
	 * 
	 * @link https://developer.wordpress.org/reference/functions/add_options_page/
	 *
	 * @return void
	 */
	public function add_admin_menu() {

		\add_options_page(
			\esc_html__( 'Site Settings', 'site-functionality' ),
			\esc_html__( 'Site Settings', 'site-functionality' ),
			'manage_options',
			'site-settings',
			array( $this, 'render_page' ),
			1
		);

	}

	/**
	 * Register Settings
	 *
	 * @return void
	 */
	public function init_settings() {

		/**
		 * @link https://developer.wordpress.org/reference/functions/register_setting/
		 */
		\register_setting(
			'site_settings',
			self::OPTION_NAME
		);

		/**
		 * @link https://developer.wordpress.org/reference/functions/add_settings_section/
		 */
		\add_settings_section(
			self::OPTION_NAME . '_section',
			'',
			false,
			self::OPTION_NAME
		);

		/**
		 * https://developer.wordpress.org/reference/functions/add_settings_field/
		 */
		\add_settings_field(
			'donate_api_url',
			__( 'Donate API URL', 'site-functionality' ),
			array( $this, 'render_donate_api_url_field' ),
			self::OPTION_NAME,
			self::OPTION_NAME . '_section'
		);
		\add_settings_field(
			'membership_api_url',
			__( 'Membership API URL', 'site-functionality' ),
			array( $this, 'render_membership_api_url_field' ),
			self::OPTION_NAME,
			self::OPTION_NAME . '_section'
		);
		\add_settings_field(
			'funds_api_url',
			__( 'Funds API URL', 'site-functionality' ),
			array( $this, 'render_funds_api_url_field' ),
			self::OPTION_NAME,
			self::OPTION_NAME . '_section'
		);
		\add_settings_field(
			'recaptcha_v3_site_key',
			__( 'Recaptcha Site Key', 'site-functionality' ),
			array( $this, 'render_recaptcha_v3_site_key_field' ),
			self::OPTION_NAME,
			self::OPTION_NAME . '_section'
		);
		\add_settings_field(
			'stripe_public_token',
			__( 'Stripe Public Token', 'site-functionality' ),
			array( $this, 'render_stripe_public_token_field' ),
			self::OPTION_NAME,
			self::OPTION_NAME . '_section'
		);

	}

	/**
	 * Render Settings Page
	 *
	 * @return void
	 */
	public function render_page() {

		// Check required user capability
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'site-functionality' ) );
		}

		// Admin Page Layout
		echo '<div class="wrap">' . "\n";
		echo '	<h1>' . \get_admin_page_title() . '</h1>' . "\n";
		echo '	<form action="options.php" method="post">' . "\n";

		\settings_fields( 'site_settings' );
		\do_settings_sections( self::OPTION_NAME );
		\submit_button();

		echo '	</form>' . "\n";
		echo '</div>' . "\n";

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	function render_donate_api_url_field() {

		// Set default value.
		$value = isset( $this->options['donate_api_url'] ) ? $this->options['donate_api_url'] : 'https://membership.debtcollective.org/donate';

		// Field output.
		echo '<input type="url" name="web_components[donate_api_url]" class="regular-text donate_api_url_field" placeholder="' . \esc_attr__( '', 'site-functionality' ) . '" value="' . \esc_attr( $value ) . '">';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	function render_membership_api_url_field() {

		// Set default value.
		$value = isset( $this->options['membership_api_url'] ) ? $this->options['membership_api_url'] : 'https://membership.debtcollective.org/subscriptions';

		// Field output.
		echo '<input type="url" name="web_components[membership_api_url]" class="regular-text membership_api_url_field" placeholder="' . \esc_attr__( '', 'site-functionality' ) . '" value="' . \esc_attr( $value ) . '">';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	function render_funds_api_url_field() {

		// Set default value.
		$value = isset( $this->options['funds_api_url'] ) ? $this->options['funds_api_url'] : 'https://membership.debtcollective.org/funds';

		// Field output.
		echo '<input type="url" name="web_components[funds_api_url]" class="regular-text funds_api_url_field" placeholder="' . \esc_attr__( '', 'site-functionality' ) . '" value="' . \esc_attr( $value ) . '">';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	function render_recaptcha_v3_site_key_field() {

		// Set default value.
		$value = isset( $this->options['recaptcha_v3_site_key'] ) ? $this->options['recaptcha_v3_site_key'] : '6Lfw_twZAAAAALGtiJ6np4Y_6D9LcdP4atBfA8Fh';

		// Field output.
		echo '<input type="password" name="web_components[recaptcha_v3_site_key]" class="regular-text recaptcha_v3_site_key_field" placeholder="' . \esc_attr__( '', 'site-functionality' ) . '" value="' . \esc_attr( $value ) . '">';

	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	function render_stripe_public_token_field() {

		// Set default value.
		$value = isset( $this->options['stripe_public_token'] ) ? $this->options['stripe_public_token'] : 'pk_live_GmPEInjwOnEJOp1xKbboweXA00JsHcOLf5';

		// Field output.
		echo '<input type="password" name="web_components[stripe_public_token]" class="regular-text stripe_public_token_field" placeholder="' . \esc_attr__( '', 'site-functionality' ) . '" value="' . \esc_attr( $value ) . '">';
	}

	/**
	 * Load Select 2
	 *
	 * @return void
	 */
	function admin_enqueue_scripts() {

		if( !wp_script_is( 'select2', 'enqueued' ) ) {
			\wp_enqueue_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
			\wp_enqueue_script( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ) );
		}

		\wp_enqueue_script( 'site-functionality-admin-scripts', SITE_CORE_DIR_URI . 'assets/js/options.js', array( 'select2' ) ); 
	}
}