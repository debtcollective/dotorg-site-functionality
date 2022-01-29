<?php
/**
 * Site Options Page
 *
 * @since   1.0.0
 * @package Core_Functionality
 */

namespace Site_Functionality\Integration\ContactForm7;

use Site_Functionality\Abstracts\Base;
use Site_Functionality\Integration\ContactForm7\Options;
use Site_Functionality\Integration\ContactForm7\ContactForm7;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Process extends Base {
	/**
	 * Options
	 *
	 * @var array
	 */
	public $options = array();

	/**
	 * Base API URL
	 *
	 * @var string
	 */
	private $base_url;

	/**
	 * Endpoint for submission
	 *
	 * @var string
	 */
	private $endpoint = 'forms/%id%/submissions';

	/**
	 * API Key
	 *
	 * @var string
	 */
	private $api_key;

	/**
	 * Form ID Key
	 *
	 * @var string
	 */
	private $form_id_key = 'form-id';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		$this->options  = \get_option( Options::OPTION_NAME );
		$this->base_url = isset( $this->options['base_url'] ) ? \esc_url( $this->options['base_url'] ) : null;
		$this->api_key  = isset( $this->options['api_key'] ) ? \esc_attr( $this->options['api_key'] ) : null;

		if ( $this->base_url && $this->api_key ) {
			\add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			\add_action( 'wpcf7_before_send_mail', array( $this, 'process_form' ), 10, 3 );
		} else {
			// Add some sort of notification that these must be available in order to process for
		}
	}

	/**
	 * Process the form
	 *
	 * @link https://contactform7.com/2020/07/28/accessing-user-input-data/
	 *
	 * @param object  $contact_form
	 * @param boolean $abort
	 * @param object  $submission
	 * @return void
	 */
	public function process_form( $contact_form, &$abort, $submission ) {
		$form_id = $contact_form->id();
		$data    = $submission->get_posted_data();

		if ( true === $abort || ! in_array( $form_id, $this->options['forms'] ) ) {
			return;
		}

		if ( isset( $data[ $this->form_id_key ] ) ) {

			try {
				$response = $this->send_data( $data );
				$submission->set_response( \wp_remote_retrieve_response_message( $response ) );
				error_log( 'Request: ' . json_encode( $response ) );

				if ( \is_wp_error( $response ) ) {
					error_log( 'WP_Error Response: ' . json_encode( $response ) );
					throw new \Exception( \wp_remote_retrieve_response_message( $response ) );
				} elseif ( 200 === \wp_remote_retrieve_response_code( $response ) ) {
					$result = json_decode( \wp_remote_retrieve_body( $response ) );
					error_log( 'Result: ' . json_encode( $result ) );
					$submission->set_status( 'api-success' );
				} else {
					throw new \Exception( \wp_remote_retrieve_response_message( $response ) );
					$submission->set_status( 'unexpected-response' );
				}
			} catch ( \Exception $exception ) {
				$submission->set_response( $exception );
				$submission->set_status( 'api-failure' );
			}
			error_log( 'Form Response: ' . $submission->get_response() );
		}
	}

	/**
	 * Send the Data
	 *
	 * @param array $data
	 * @return object
	 */
	public function send_data( $data ) {
		if( ! isset( $data['email'] ) && ! isset( $data['telephone'] ) ) {
			throw new \Exception( \esc_attr__( 'Submissions require either email or telephone, but either the fields don\'t exist or they were not filled in.', 'site-functionality' ) );
		}

		$args = array(
			'action_network:referrer_data' => array(
				'website'  => \esc_url( \get_home_url() ),
			),
			'person'   => array(
				'email_addresses' => array(
					array(
						'address' => \sanitize_email( $data['email'] ),
					),
				),
			),
			'source'   => 'dotorg',
		);

		if ( isset( $data['first-name'] ) ) {
			$args['person']['given_name'] = \sanitize_text_field( $data['first-name'] );
		}
		if ( isset( $data['last-name'] ) ) {
			$args['person']['family_name'] = \sanitize_text_field( $data['last-name'] );
		}
		if ( isset( $data['telephone'] ) ) {
			$args['person']['phone_numbers'][]['number'] = \sanitize_text_field( $data['telephone'] );
		}
		if ( isset( $data['an-tag'] ) ) {
			$args['add_tags'][] = \sanitize_text_field( $data['an-tag'] );
		}

		$endpoint = str_replace( '%id%', $data[ $this->form_id_key ], $this->endpoint );
		$url      = \esc_url( $this->base_url . $endpoint );

		$options = array(
			'method'      => 'POST',
			'headers'     => array(
				'Content-Type'   => 'application/json',
				'OSDI-API-Token' => $this->api_key,
			),
			'timeout'     => 100,
			'redirection' => 5,
			'body'        => json_encode( $args ),
		);

		return \wp_remote_post(
			$url,
			$options
		);
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

	/**
	 * Load JS
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
	 *
	 * @param string $hook
	 * @return void
	 */
	function enqueue_scripts() {
		\wp_enqueue_script( 'site-functionality-cf7-js', SITE_CORE_DIR_URI . 'assets/js/cf7.js', array( 'jquery' ), '', true );
	}



}
