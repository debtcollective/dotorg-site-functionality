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
		'field_display_name'         => 'string',
		'event_heading_upcoming'     => 'string',
		'event_scope_upcoming'       => 'string',
		'event_sort_upcoming'        => 'string',
		'event_heading'              => 'string',
		'event_scope'                => 'string',
		'event_sort'                 => 'string',
	);

	/**
	 * Scope options
	 *
	 * @var array
	 */
	public $scope;

	/**
	 * Sort options
	 *
	 * @var array
	 */
	public $sort;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		\add_action( 'init', array( $this, 'register_meta' ) );
		\add_action( 'acf/init', array( $this, 'register_fields' ) );

		$this->scope = array(
			'future' => __( 'Upcoming', 'site-functionality' ),
			'past'   => __( 'Past', 'site-functionality' ),
			'all'    => __( 'All', 'site-functionality' ),
		);

		$this->sort = array(
			'DESC' => __( 'Desc - Z to A (newest to oldest)', 'site-functionality' ),
			'ASC'  => __( 'Asc - A to Z (oldest to newest)', 'site-functionality' ),
		);
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

		/**
		 * Events Page Template
		 */
		\acf_add_local_field_group(
			array(
				'key'                   => 'group_display_options_events_page',
				'title'                 => __( 'Display Options', 'site-functionality' ),
				'fields'                => array(
					array(
						'key'          => 'field_has_sidebar',
						'label'        => __( 'Display Sidebar', 'site-functionality' ),
						'name'         => 'has_sidebar',
						'type'         => 'true_false',
						'instructions' => __( 'Display sidebar on page.', 'site-functionality' ),
						'ui'           => 1,
					),
					array(
						'key'          => 'field_display_name',
						'label'        => __( 'Display Name', 'site-functionality' ),
						'name'         => 'display_name',
						'type'         => 'text',
						'instructions' => __( 'Alternate page title to display in section navigation.', 'site-functionality' ),
					),
					array(
						'key'               => 'field_display_section_navigation',
						'label'             => \__( 'Display Section Navigation', 'site-functionality' ),
						'name'              => 'display_section_navigation',
						'type'              => 'radio',
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
						'key'               => 'field_separator_upcoming',
						'label'             => __( 'Upcoming Events', 'site-functionality' ),
						'name'              => '',
						'type'              => 'separator',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'message'           => '',
						'new_lines'         => 'wpautop',
						'esc_html'          => 0,
					),
					array(
						'key'          => 'field_heading_upcoming',
						'label'        => __( 'Heading', 'site-functionality' ),
						'name'         => 'event_heading_upcoming',
						'type'         => 'text',
						'instructions' => __( 'Heading for Upcoming Events.', 'site-functionality' ),
					),
					array(
						'key'           => 'field_event_scope_upcoming',
						'label'         => __( 'Scope', 'site-functionality' ),
						'name'          => 'event_scope_upcoming',
						'type'          => 'select',
						'instructions'  => __( 'Select whether to display events upcoming, in past or all.', 'site-functionality' ),
						'choices'       => $this->scope,
						'default_value' => 'future',
						'ui'            => 1,
						'return_format' => 'value',
					),
					array(
						'key'           => 'field_event_sort_upcoming',
						'label'         => __( 'Sort', 'site-functionality' ),
						'name'          => 'event_sort_upcoming',
						'type'          => 'select',
						'instructions'  => __( 'Select how to sort upcoming events.', 'site-functionality' ),
						'choices'       => $this->sort,
						'default_value' => 'ASC',
						'ui'            => 1,
						'return_format' => 'value',
					),
					array(
						'key'               => 'field_separator',
						'label'             => __( 'Past Events', 'site-functionality' ),
						'name'              => '',
						'type'              => 'separator',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'message'           => '',
						'new_lines'         => 'wpautop',
						'esc_html'          => 0,
					),
					array(
						'key'          => 'field_event_heading',
						'label'        => __( 'Heading', 'site-functionality' ),
						'name'         => 'event_heading',
						'type'         => 'text',
						'instructions' => __( 'Heading for Past Events.', 'site-functionality' ),
					),
					array(
						'key'           => 'field_event_scope',
						'label'         => __( 'Scope', 'site-functionality' ),
						'name'          => 'event_scope',
						'type'          => 'select',
						'instructions'  => __( 'Select whether to display events upcoming, in past or all.', 'site-functionality' ),
						'choices'       => $this->scope,
						'default_value' => 'past',
						'ui'            => 1,
						'return_format' => 'value',
					),
					array(
						'key'           => 'field_event_sort',
						'label'         => __( 'Sort', 'site-functionality' ),
						'name'          => 'event_sort',
						'type'          => 'select',
						'instructions'  => __( 'Select how to sort past events.', 'site-functionality' ),
						'choices'       => $this->sort,
						'default_value' => 'DESC',
						'ui'            => 1,
						'return_format' => 'value',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_template',
							'operator' => '==',
							'value'    => 'page-templates/events-page.php',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'side',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'active'                => true,
				'show_in_rest'          => 0,
			)
		);

		/**
		 * Events Archive Template
		 */
		\acf_add_local_field_group(
			array(
				'key'                   => 'group_display_options_events_archive',
				'title'                 => __( 'Display Options', 'site-functionality' ),
				'fields'                => array(
					array(
						'key'          => 'field_has_sidebar',
						'label'        => __( 'Display Sidebar', 'site-functionality' ),
						'name'         => 'has_sidebar',
						'type'         => 'true_false',
						'instructions' => __( 'Display sidebar on page.', 'site-functionality' ),
						'ui'           => 1,
					),
					array(
						'key'          => 'field_display_name',
						'label'        => __( 'Display Name', 'site-functionality' ),
						'name'         => 'display_name',
						'type'         => 'text',
						'instructions' => __( 'Alternate page title to display in section navigation.', 'site-functionality' ),
					),
					array(
						'key'               => 'field_display_section_navigation',
						'label'             => \__( 'Display Section Navigation', 'site-functionality' ),
						'name'              => 'display_section_navigation',
						'type'              => 'radio',
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
						'key'           => 'field_event_scope',
						'label'         => __( 'Events Scope', 'site-functionality' ),
						'name'          => 'event_scope',
						'type'          => 'select',
						'instructions'  => __( 'Select whether to display events upcoming, in past or all.', 'site-functionality' ),
						'choices'       => $this->scope,
						'default_value' => 'past',
						'ui'            => 1,
						'return_format' => 'value',
					),
					array(
						'key'           => 'field_event_sort',
						'label'         => __( 'Events Sort', 'site-functionality' ),
						'name'          => 'event_sort',
						'type'          => 'select',
						'instructions'  => __( 'Select how to sort events.', 'site-functionality' ),
						'choices'       => $this->sort,
						'default_value' => 'DESC',
						'ui'            => 1,
						'return_format' => 'value',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_template',
							'operator' => '==',
							'value'    => 'page-templates/events-archive.php',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'side',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'active'                => true,
				'show_in_rest'          => 0,
			)
		);

		/**
		 * People Archive Template
		 */
		\acf_add_local_field_group(
			array(
				'key'                   => 'group_display_options_special',
				'title'                 => __( 'Display Options', 'site-functionality' ),
				'fields'                => array(
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
							'param'    => 'post_template',
							'operator' => '==',
							'value'    => 'page-templates/people-archive.php',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'side',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'active'                => true,
				'show_in_rest'          => 0,
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
