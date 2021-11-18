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

    if( ! is_admin() ) {
        \wp_enqueue_script( 'react' );
        \wp_enqueue_script( 'react-dom' );
        \wp_enqueue_script( 'dc-web-components' );
    }

    $wrapper_attributes = \get_block_wrapper_attributes( [ 
        'class' => 'donation-widget',
        'id'    => 'donation-widget'
    ] );
    
    ob_start();
    ?>

    <div <?php echo $wrapper_attributes; ?>>
        Requires Javascript to Work...
    </div>

    <?php
    if( isset( $_ENV ) ) : ?>

    <script src="<?php echo \esc_url( 'https://www.google.com/recaptcha/api.js?render=' . \esc_url( $_ENV['DC_RECAPTCHA_V3_SITE_KEY'] ) ); ?>"></script>

        <script>
            window.DC_DONATE_API_URL = "<?php echo \esc_attr( $_ENV['DC_DONATE_API_URL'] ); ?>"
            window.DC_MEMBERSHIP_API_URL = "<?php echo \esc_attr( $_ENV['DC_MEMBERSHIP_API_URL'] ); ?>"
            window.DC_FUNDS_API_URL = "<?php echo \esc_attr( $_ENV['DC_FUNDS_API_URL'] ); ?>"
            window.DC_RECAPTCHA_V3_SITE_KEY = "<?php echo \esc_attr( $_ENV['DC_RECAPTCHA_V3_SITE_KEY'] ); ?>"
            window.DC_STRIPE_PUBLIC_TOKEN = "<?php echo \esc_attr( $_ENV['DC_STRIPE_PUBLIC_TOKEN'] ); ?>"
        </script>

    <?php endif;

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
\add_action( 'init', __NAMESPACE__ . '\register' );

/**
 * Filter script tag
 * 
 * @link https://developer.wordpress.org/reference/hooks/script_loader_tag/
 *
 * @param string $tag
 * @param string $handle
 * @return string $tag
 */
function script_loader_tag( $tag, $handle, $src ) {
    if ( $handle === 'react' || $handle === 'react-dom' ) {
        $tag = str_replace( '<script', '<script crossorigin', $tag );
    }
    if ( $handle === 'donation-widget-no-script' ) {
        $tag = str_replace( '<script', '<script nomodule', $tag );
    }
    return $tag;    
}
\add_filter( 'script_loader_tag',  __NAMESPACE__ . '\script_loader_tag', 10, 3 );

/**
 * Register Script
 * 
 * @link https://developer.wordpress.org/reference/functions/wp_register_script/
 *
 * @return void
 */
function enqueue() {
    if( ! is_admin() ) {
        \wp_deregister_script( 'react' );
        \wp_deregister_script( 'react-dom' );
    }

    \wp_register_script( 'react', 
        \esc_url( 'https://unpkg.com/react@17/umd/react.development.js' ),
        [],
        false,
        false
    );
    \wp_register_script( 'react-dom', 
        \esc_url( 'https://unpkg.com/react-dom@17/umd/react-dom.development.js' ),
        [],
        false,
        false
    );
    \wp_register_script( 'dc-web-components', 
        SITE_CORE_DIR_URI .'blocks/build/webComponents.js',
        [ 'react', 'react-dom' ],
        false,
        true
    );
    // \wp_register_script( 'donation-widget', 
    //     SITE_CORE_DIR_URI .'blocks/src/assets/js/@debtcollective/union-component/build/index.module.js',
    //     [ 'react', 'react-dom' ],
    //     false,
    //     true
    // );
    // \wp_register_script( 'donation-widget-no-script', 
    //     SITE_CORE_DIR_URI .'blocks/src/assets/js/@debtcollective/union-component/build/index.js',
    //     [ 'react', 'react-dom' ],
    //     false,
    //     true
    // );
    // \wp_enqueue_script( 'react' );
    // \wp_enqueue_script( 'react-dom' );
    // \wp_enqueue_script( 'debtcollective-widgets' );
}
\add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue' );
