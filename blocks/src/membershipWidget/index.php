<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\MembershipWidget;

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
        'class' => 'membership-widget',
        'id'    => 'membership-widget'
    ] );

    $options = \get_option( 'web_components' );
    
    ob_start();
    ?>

    <div <?php echo $wrapper_attributes; ?>>
        Requires Javascript to Work...
    </div>

    <script src="<?php echo \esc_url( 'https://www.google.com/recaptcha/api.js?render=' . \esc_url( $options['recaptcha_v3_site_key'] ) ); ?>"></script>

        <script>
            window.DC_DONATE_API_URL = "<?php echo \esc_attr( $options['donate_api_url'] ); ?>"
            window.DC_MEMBERSHIP_API_URL = "<?php echo \esc_attr( $options['membership_api_url'] ); ?>"
            window.DC_FUNDS_API_URL = "<?php echo \esc_attr( $options['funds_api_url'] ); ?>"
            window.DC_RECAPTCHA_V3_SITE_KEY = "<?php echo \esc_attr( $options['recaptcha_v3_site_key'] ); ?>"
            window.DC_STRIPE_PUBLIC_TOKEN = "<?php echo \esc_attr( $options['stripe_public_token'] ); ?>"
        </script>

    <?php
    $content = ob_get_clean();

    return $content;
}

/**
 * Registers the `site-functionality/membership-widget` block on the server.
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
}
\add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue' );