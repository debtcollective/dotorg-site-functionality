<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\Field;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render Block
 *
 * @param array $block_attributes
 * @param string $content
 * @return string
 */
function render( $attributes, $content, $block ) {
    if( ! $attributes['content'] ) {
        return '';
    }

    $type = isset( $attributes['type'] ) ? \sanitize_title( $attributes['type'] ): 'text';

    $wrapper_attributes = \get_block_wrapper_attributes( [
        'class'         => $type,
    ] );

    $output = '<p ' . $wrapper_attributes . '>';

    $output .= \esc_attr( $attributes['content'] );

    $output .= '</p>';

    return $output;
}

/**
 * Registers the `site-functionality/field` block on the server.
 */
function register() {
	\register_block_type(
		__DIR__,
		[
			'render_callback' 	=> __NAMESPACE__ . '\render',
		]
	);
}
add_action( 'init', __NAMESPACE__ . '\register' );