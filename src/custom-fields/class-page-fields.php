<?php
/**
 * Page Fields
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\CustomFields;

use Site_Functionality\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PageFields extends Base {

	/**
	 * Custom fields
	 */
	public const FIELDS = array(
		'display_section_navigation' => 'string',
		'featured_image_is_hero'     => 'boolean',
		'field_display_name' => 'string'
	);

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		\add_action( 'init', array( $this, 'register_meta' ) );
		\add_action( 'acf/init', array( $this, 'register_fields' ) );
	}

	/**
	 * Register Fields
	 *
	 * @return void
	 */
	public function register_fields() {
		\acf_add_local_field_group(
			array(
				'key'                   => 'group_display_options_sidebar',
				'title'                 => \__( 'Display Options', 'site-functionality' ),
				'fields'                => array(
					array(
						'key'               => 'field_featured_image_is_hero',
						'label'             => __( 'Display Featured Image as Hero', 'site-functionality' ),
						'name'              => 'featured_image_is_hero',
						'type'              => 'true_false',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'message'           => '',
						'default_value'     => 0,
						'ui'                => 1,
						'ui_on_text'        => '',
						'ui_off_text'       => '',
					),
					array(
						'key'               => 'field_display_section_navigation',
						'label'             => \__( 'Display Section Navigation', 'site-functionality' ),
						'name'              => 'display_section_navigation',
						'type'              => 'radio',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							''         => \__( 'None', 'site-functionality' ),
							'sibling'  => \__( 'Sibling-page Navigation', 'site-functionality' ),
							'children' => \__( 'Sub-page Navigation', 'site-functionality' ),
						),
						'allow_null'        => 1,
						'other_choice'      => 0,
						'default_value'     => 'sibling',
						'layout'            => 'vertical',
						'return_format'     => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key'          => 'field_display_name',
						'label'        => __( 'Display Name', 'site-functionality' ),
						'name'         => 'display_name',
						'type'         => 'text',
						'instructions' => __( 'Alternate page title to display in section navigation.', 'site-functionality' ),
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'default',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'side',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
			)
		);

		\acf_add_local_field_group(
			array(
				'key'                   => 'group_display_options_full',
				'title'                 => __( 'Display Options', 'site-functionality' ),
				'fields'                => array(
					array(
						'key'               => 'field_featured_image_is_hero',
						'label'             => __( 'Display Featured Image as Hero', 'site-functionality' ),
						'name'              => 'featured_image_is_hero',
						'type'              => 'true_false',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'message'           => '',
						'default_value'     => 0,
						'ui'                => 1,
						'ui_on_text'        => '',
						'ui_off_text'       => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'page-templates/fullwidth.php',
						),
					),
					array(
						array(
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'page-templates/landing-page.php',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'side',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 1,
			)
		);

	}

	/**
	 * Register post meta with Rest API
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_meta/
	 *
	 * @return void
	 */
	public function register_meta() {
		foreach ( self::FIELDS as $name => $type ) {
			\register_post_meta(
				'page',
				$name,
				array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => $type,
				)
			);
		}
	}
}
