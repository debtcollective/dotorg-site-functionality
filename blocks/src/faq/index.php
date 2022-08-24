<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\Faq;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Render Block
 *
 * @param array  $block_attributes
 * @param string $content
 * @return string
 */
function render( $attributes, $content, $block ) {
	
	$wrapper_attributes = \get_block_wrapper_attributes(
		array(
			'class' => 'faq',
			'id'    => sprintf( 'faq-%s', ! empty( $attributes['anchor'] ) ? \esc_attr( $attributes['anchor'] ) : \esc_attr( spl_object_id( $block ) ) )
		)
	);

	$return = '';

	if ( $block->inner_blocks ) {

		$return = '<article ' . $wrapper_attributes . '>';

		foreach ( $block->inner_blocks as $inner_block ) {
			$return .= $inner_block->render();
		}

		$return .= '</article>';
	}

	return \apply_filters( __NAMESPACE__ . '\RenderHTML', $return, $attributes, $content, $block );
}

/**
 * Registers the `site-functionality/faq` block on the server.
 */
function register() {
	\register_block_type(
		__DIR__,
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\register' );
