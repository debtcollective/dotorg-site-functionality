<?php
/**
 * Site Options Page
 *
 * @since   1.0.0
 * @package Core_Functionality
 */

namespace Site_Functionality\Integration\ContactForm7;

use Site_Functionality\Abstracts\Base;
use Site_Functionality\Integration\ContactForm7\ContactForm7;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Options extends Base {

	/**
	 * Options
	 *
	 * @var array
	 */
	public $options = array();

	/**
	 * Forms selected
	 *
	 * @var array
	 */
	public $forms = array();

	/**
	 * Option Name
	 */
	public const OPTION_NAME = 'contact_form_7_integration_settings';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		\add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		\add_action( 'admin_init', array( $this, 'init_settings' ) );

		$this->options = \get_option( self::OPTION_NAME );
		$this->forms   = $this->get_forms_for_integration();
	}

	/**
	 * Add Submenu
	 *
	 * @return void
	 */
	public function add_admin_menu() {
		\add_submenu_page(
			'wpcf7',
			\esc_html__( 'Integration Settings', 'site-functionality' ),
			\esc_html__( 'Integration Settings', 'site-functionality' ),
			'manage_options',
			'wpcf7-integration-settings',
			array( $this, 'render_page' )
		);
	}

	/**
	 * Register settings
	 *
	 * @return void
	 */
	public function init_settings() {

		\register_setting(
			self::OPTION_NAME,
			self::OPTION_NAME
		);

		\add_settings_section(
			self::OPTION_NAME . '_section',
			__( 'Action Network Integration Settings', 'site-functionality' ),
			false,
			self::OPTION_NAME
		);
		\add_settings_field(
			'base_url',
			__( 'Base URL', 'site-functionality' ),
			array( $this, 'render_base_url_field' ),
			self::OPTION_NAME,
			self::OPTION_NAME . '_section'
		);
		\add_settings_field(
			'api_key',
			__( 'API Key', 'site-functionality' ),
			array( $this, 'render_api_key_field' ),
			self::OPTION_NAME,
			self::OPTION_NAME . '_section'
		);
		\add_settings_field(
			'forms',
			__( 'Forms to Process', 'site-functionality' ),
			array( $this, 'render_forms_field' ),
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

		if ( ! \current_user_can( 'manage_options' ) ) {
			\wp_die( \esc_html__( 'You do not have sufficient permissions to access this page.', 'site-functionality' ) );
		}

		echo '<div class="wrap">' . "\n";
		echo '	<h1>' . \get_admin_page_title() . '</h1>' . "\n";
		echo '	<form action="options.php" method="post">' . "\n";

		\settings_fields( self::OPTION_NAME );
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
	function render_base_url_field() {
		$value = isset( $this->options['base_url'] ) ? $this->options['base_url'] : 'https://actionnetwork.org/api/v2';

		printf( '<input type="text" name="%s[base_url]" class="regular-text base_url_field" placeholder="%s" value="%s">', \esc_attr( self::OPTION_NAME ), \esc_attr__( 'https://actionnetwork.org/api/v2', 'site-functionality' ), \esc_attr( $value ) );
	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	function render_api_key_field() {
		$value = isset( $this->options['api_key'] ) ? $this->options['api_key'] : '';

		printf( '<input type="password" name="%s[api_key]" class="regular-text api_key_field" placeholder="%s" value="%s">', \esc_attr( self::OPTION_NAME ), '', \esc_attr( $value ) );
	}

	/**
	 * Render Field
	 *
	 * @return void
	 */
	function render_forms_field() {
		$value = isset( $this->options['forms'] ) ? $this->options['forms'] : array();

		asort( $this->forms );

		foreach ( $this->forms as $id => $title ) {
			printf( '<div class="row"><input type="checkbox" name="%s[forms][]" class="forms_field" value="%s" %s> <label>%s</label></div>', 
				\esc_attr( self::OPTION_NAME ), 
				$id, 
				( in_array( $id, $value ) ? 'checked="checked"' : '' ), 
				\esc_html( $title )
			);
		}
		echo '<p class="description">' . \esc_html__( 'Select the forms that should be submitted to Action Network.', 'site-functionality' ) . '</p>';
	}

	/**
	 * Get all the forms
	 *
	 * @return array
	 */
	public function get_forms() : array {
		$args  = array(
			'post_type'      => ContactForm7::POST_TYPE,
			'posts_per_page' => 100,
		);
		$query = new \WP_Query( $args );
		return $query->get_posts();
	}

	/**
	 * Get the Forms
	 *
	 * @return array
	 */
	public function get_forms_for_integration() : array {
		$forms = $this->get_forms();
		return array_column( $forms, 'post_title', 'ID' );
	}

}
