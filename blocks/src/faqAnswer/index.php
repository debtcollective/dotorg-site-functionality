<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\AccordionAnswer;

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
	$wrapper_attributes = \get_block_wrapper_attributes(
		array()
	);

	ob_start();

	if ( $block->inner_blocks ) :
		?>

		<div <?php echo $wrapper_attributes; ?>>

			<div class="answer-wrapper">

			<?php
			foreach ( $block->inner_blocks as $inner_block ) :

				echo $inner_block->render();

			endforeach;
			?>

			</div><!--.answer-wrapper-->

		</div>

		<?php
	endif;

	$return = \apply_filters( __NAMESPACE__ . '\RenderHTML', ob_get_clean(), $attributes, $content, $block );

	return $return;
}

/**
 * Registers the `site-functionality/accordion-answer` block on the server.
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
