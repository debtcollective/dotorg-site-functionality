<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\SidebarLink;

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
	$wrapper_attributes = \get_block_wrapper_attributes();

	$output = '<li ' . $wrapper_attributes . '>';

	if ( isset( $attributes['url'] ) && $attributes['url'] ) {
		$output .= sprintf(
			'<a href="%1$s"%2$s%3$s class="sidebar-link">',
			\esc_url( $attributes['url'] ),
			( isset( $attributes['linkTarget'] ) && $attributes['linkTarget'] ) ? ' target="' . $attributes['linkTarget'] . '"' : '',
			( isset( $attributes['linkTarget'] ) && $attributes['linkTarget'] ) ? ' rel="noreferrer noopener"' : ''
		);
	}

	foreach ( $block->inner_blocks as $inner_block ) {

		$output .= $inner_block->render();

	}

	if ( isset( $attributes['url'] ) && $attributes['url'] ) {
		$output .= '</a>';
	}

	$output .= '</li>';

	return $output;
}

/**
 * Registers the `site-functionality/sidebar-link` block on the server.
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
