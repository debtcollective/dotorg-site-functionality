<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\DonationWidget;

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

    $wrapper_attributes = \get_block_wrapper_attributes(); 
    
    ob_start();
    ?>

    <div <?php echo $wrapper_attributes; ?>>

        <DonationWidget />

    </div>

    <?php
    $content = ob_get_clean();

    return $content;
}

/**
 * Registers the `site-functionality/donation-widget` block on the server.
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