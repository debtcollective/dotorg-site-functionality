<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package site-functionality
 */
namespace Site_Functionality\Blocks;

include_once( \plugin_dir_path( __FILE__ ) . 'src/eventTout/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/dateTimeField/index.php' );

include_once( \plugin_dir_path( __FILE__ ) . 'src/membershipWidget/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/donationWidget/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/faqs/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/faq/index.php' );

include_once( \plugin_dir_path( __FILE__ ) . 'src/field/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/impactfulCallout/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/postmeta/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/purchaseAgreements/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/tout/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/buttonTout/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/userQuery/index.php' );
include_once( \plugin_dir_path( __FILE__ ) . 'src/taxonomySelector/index.php' );

const TEMPLATE_PARAMS = [
	'filter_prefix'             => 'site_functionality',
	'plugin_directory'          => SITE_CORE_DIR,
	'plugin_template_directory' => 'blocks/src/templates',
	'theme_template_directory'  => 'template-parts/components',
];

function get_template_params() {
	return TEMPLATE_PARAMS;
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function init() {

	/**
	 * Register custom pattern category
	 * 
	 * @see https://developer.wordpress.org/reference/functions/register_block_pattern_category/
	 */
	if ( class_exists( '\WP_Block_Patterns_Registry' ) ) {

		\register_block_pattern_category(
			'touts',
			[ 
				'label' => \_x( 'Heroes and touts.', 'Block pattern category', 'site-functionality' ) 
			]
		);

	}

  if ( function_exists( '\wp_set_script_translations' ) ) {
    /**
     * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
     * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
     * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
     */
    wp_set_script_translations( 'site-functionality', 'site-functionality' );
  }
}
\add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Enqueue Build Script
 * 
 * When using @wordpress/create-block set-up with multiple blocks, we get "Block ... is already registered." error because each block's block.json file calls the build script again.
 * Remove build script reference in block.json files
 * 
 * @link https://wordpress.slack.com/archives/C02QB2JS7/p1629116113108600
 *
 * @return void
 */
function enqueue_blocks_scripts() {
    $asset_file = require \plugin_dir_path( __FILE__ ) . 'build/index.asset.php';
    \wp_enqueue_script( 'site-functionality', \plugins_url( '/build/index.js', __FILE__ ), $asset_file['dependencies'], $asset_file['version'], false );
}
\add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_blocks_scripts' );

/**
 * Register custom block category
 * 
 * @see https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#managing-block-categories
 */
function register_block_category( $block_categories, $editor_context ) {
	if ( ! empty( $editor_context->post ) ) {
		array_push(
			$block_categories,
			[
				'slug'  => 'components',
				'title' => __( 'Components', 'site-functionality' ),
				'icon'  => 'block-default',
			],
			[
				'slug'  => 'fields',
				'title' => __( 'Fields', 'site-functionality' ),
				'icon'  => 'edit',
			]
		);
	}
	return $block_categories;
}
\add_filter( 'block_categories_all', __NAMESPACE__ . '\register_block_category', 10, 2 );