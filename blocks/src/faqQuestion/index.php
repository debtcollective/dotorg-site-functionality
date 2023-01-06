<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\FaqQuestion;

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
			// 'id'    => sprintf( 'faq-%s', ! empty( $attributes['anchor'] ) ? \esc_attr( $attributes['anchor'] ) : \esc_attr( spl_object_id( $block ) ) )
		)
	);

	ob_start();

	if ( isset( $attributes['question'] ) ) :
		?>
		<div <?php echo $wrapper_attributes; ?>>

			<h3>
				<?php echo \apply_filters( 'the_title', $attributes['question'] ); ?>
			</h3>
			<a href="#" class="chevron">
				<svg width="27" height="42" viewBox="0 0 27 42" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M0.499999 5.28333L5.41892 0.500001L26.5 21L5.41891 41.5L0.499994 36.7167L16.6622 21L0.499999 5.28333Z" fill="white"/>
				</svg>
			</a>
		</div>
		<?php
	endif;

	$return = \apply_filters( __NAMESPACE__ . '\RenderHTML', ob_get_clean(), $attributes, $content, $block );

	return $return;
}

/**
 * Registers the `site-functionality/faq-question` block on the server.
 */
function register() {
	\register_block_type(
		__DIR__,
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
\add_action( 'init', __NAMESPACE__ . '\register' );
