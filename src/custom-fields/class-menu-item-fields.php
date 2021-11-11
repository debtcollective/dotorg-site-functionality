<?php
/**
 * Menu Fields
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

class MenuItemFields extends Base {

	/**
	 * Custom fields
	 */
	public const FIELDS = [
		'visibility'			=> 'string',
	];

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		\add_action( 'init',							[ $this, 'register_meta' ] );
		\add_action( 'acf/init', 						[ $this, 'register_fields' ] );
	}

	/**
	 * Register Fields
	 *
	 * @return void
	 */
	public function register_fields() {
		\acf_add_local_field_group( array(
			'key' => 'group_menu_items',
			'title' => __( 'Menu Item Visibility', 'site-functionality' ),
			'fields' => array(
				array(
					'key' => 'field_visibility',
					'label' => __( 'Visibility', 'site-functionality' ),
					'name' => 'visibility',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'all' => __( 'All Users', 'site-functionality' ),
						'authenticated' => __( 'Logged-in Users', 'site-functionality' ),
						'unauthenticated' => __( 'Logged-out Users', 'site-functionality' ),
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'default_value' => 'all',
					'layout' => 'vertical',
					'return_format' => 'value',
					'save_other_choice' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'nav_menu_item',
						'operator' => '==',
						'value' => 'all',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
			'show_in_rest' => 1
		));
		
	}

	/**
	 * Render Fields
	 *
	 * @param int $item_id
	 * @param object $item
	 * @return void
	 */
	public function render_fields( $item_id, $item ) {
		$visibility = \get_post_meta( $item_id, 'visibility', true );

		if( empty( $visibility ) ) $visibility = '';

		\wp_nonce_field( 'custom_menu_meta_nonce', '_custom_menu_meta_nonce_visibility' );
		?>
		
		<p class="field-visibility-attribute field-attr-visibility description description-wide">
			<div class="description"><?php _e( "Menu Visibility", 'site-functionality' ); ?></div>
			<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
			<label for="visibility-all">
				<input id="visibility-all" type="radio" name="visibility[<?php echo $item_id ;?>]" class="visibility-field" value="all" <?php echo checked( $visibility, 'all', false ) ?>><?php _e( 'Everyone', 'site-functionality' ); ?>
			</label>
			<label for="visibility-authenticated">
				<input id="visibility-authenticated" type="radio" name="visibility[<?php echo $item_id ;?>]" class="visibility-field" value="authenticated" <?php echo checked( $visibility, 'authenticated', false ) ?>><?php _e( 'Logged In Users', 'site-functionality' ); ?>
			</label>
			<label for="visibility-unauthenticated">
				<input id="visibility-unauthenticated" type="radio" name="visibility[<?php echo $item_id ;?>]" class="visibility-field" value="unauthenticated" <?php echo checked( $visibility, 'unauthenticated', false ) ?>><?php _e( 'Logged Out Users', 'site-functionality' ); ?>
			</label>

		</p>
		<?php
	}

	/**
	 * Save field data
	 * 
	 * @param int $menu_id
	 * @param int $menu_item_db_id
	 */
	public function save_fields( $menu_id, $menu_item_db_id ) {
		if ( ! isset( $_POST['_custom_menu_meta_nonce_visibility'] ) || ! \wp_verify_nonce( $_POST['_custom_menu_meta_nonce_visibility'], 'custom_menu_meta_nonce' ) ) {
			return $menu_id;
		}

		$new_visibility = isset( $_POST[ 'visibility' ][$menu_item_db_id] ) ? \sanitize_text_field( $_POST[ 'visibility' ][$menu_item_db_id] ) : 'all';

		\update_post_meta( $menu_item_db_id, 'visibility', $new_visibility );
	}

	/**
	 * Register post meta with Rest API
	 * 
	 * @see https://developer.wordpress.org/reference/functions/register_user_meta/
	 *
	 * @return void
	 */
	public function register_meta() {

		foreach( self::FIELDS as $name => $type  ) {
			\register_meta(
				'post', 
				$name, [
					'object_subtype'	=> 'nav_menu_item',
					'show_in_rest' 		=> true,
					'single' 			=> true,
					'type' 				=> $type,
				]
			);
		}
	}

}