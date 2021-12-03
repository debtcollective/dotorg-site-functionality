<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\TaxonomySelector;

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
    if ( ! isset( $attributes['term'] ) ) {
		return '';
    }
    
	$taxonomy = isset( $attributes['taxonomy'] ) ? \esc_attr( $attributes['taxonomy'] ) : 'post_tag' ;
	$term = \get_term( (int) $attributes['term'], $taxonomy );
	$is_linked = isset( $attributes['isLinked'] ) ? boolval( $attributes['isLinked'] ) : false ;

	$wrapper_attributes = \get_block_wrapper_attributes( array( 'class' => $taxonomy ) );

	return sprintf(
		'<div %1$s>%2$s%3$s%4$s</div>',
		$wrapper_attributes,
		( $is_linked ) ? '<a href="' . \esc_url( \get_term_link( $term, $taxonomy ) ) . '" rel="tag">' : '',
		\esc_html( $term->name ),
		( $is_linked ) ? '</a>' : ''
	);
}

/**
 * Registers the `site-functionality/taxonomy-term` block on the server.
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