<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\sectionNav;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Determine if post has children
 *
 * @param obj $post
 * @return boolean
 */
function has_parent( $post ) {
    if( ! $post ) {
        return false;
    }

	$children = \get_posts(
		array(
			'post_type'   => 'page',
			'post_parent' => $post->ID,
			'fields'      => 'ids',
		)
	);
	return count( $children ) > 0;
}


/**
 * Display Sibling Pages
 *
 * @param object $post
 * @return void
 */
function get_section_navigation( $post ) {
	if ( ! $post->post_parent ) {
		return;
	}
		$args = array(
			'child_of'    => $parent,
			'sort_column' => 'menu_order', // sort by menu order to enable custom sorting
			'depth'       => 1,
			'title_li'    => false,
			'link_before' => '<span class="hangover">',
			'link_after'  => '</span>',
			'echo'        => false,
		);
		return \wp_list_pages( $args );
}

/**
 * Display Subpages
 *
 * @param object $post
 * @return void
 */
function get_subpage_navigation( $post ) {
	if ( ! has_parent( $post ) ) {
		return;
	}
    $args = array(
        'child_of'    => $post->ID,
        'sort_column' => 'menu_order', // sort by menu order to enable custom sorting
        'depth'       => 1,
        'title_li'    => false,
        'link_before' => '<span class="hangover">',
        'link_after'  => '</span>',
        'echo'        => false,
    );
    return \wp_list_pages( $args );
}

/**
 * Render Block
 *
 * @param array  $block_attributes
 * @param string $content
 * @return string
 */
function render( $attributes, $content, $block ) {
    global $post;
    if( ! $post || ! is_a( $post, '\WP_Post' ) ) {
        return;
    }
    
	$wrapper_attributes = \get_block_wrapper_attributes( array( 'class' => 'pagenav' ) );

	$output = '<nav ' . $wrapper_attributes . '>';
        $output .= '<ul>';
        $section_navigation = $attributes['type'];
        if ( 'children' === $section_navigation ) {
            $output .= get_subpage_navigation( $post );
        } else {
            $output .= get_section_navigation( $post );
        }
        $output .= '</ul>';
	$output .= '</nav>';

	return $output;
}

/**
 * Registers the `site-functionality/section-nav` block on the server.
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
