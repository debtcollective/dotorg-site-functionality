<?php
/**
 * Register and Render Block
 *
 * @since   1.0.0
 * @package Site_Functionality
 */
namespace Site_Functionality\Blocks\DateTime;

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

    switch ( $type ) {
        case 'date' :
            $format = \get_option( 'date_format' );
            $content = date( $format, strtotime( $attributes['content'] ) );
            break;
        case 'time' :
            $format = \get_option( 'time_format' );
            $timezone = \get_option( 'timezone_string' );
            $content = date( $format, strtotime( $attributes['content'] ) );
            break;
        // case 'tel' :
        //     $phoneUtil = PhoneNumberUtil::getInstance();
        //     $numberPrototype = $phoneUtil->parse( $attributes['content'], "US" );
        //     $content = $phoneUtil->format( $numberPrototype, PhoneNumberFormat::NATIONAL );
        //     break;
        case 'email' :
            $content = filter_var( $attributes['content'], FILTER_SANITIZE_EMAIL );
            break;
        case 'url' :
            $content = filter_var( $attributes['content'], FILTER_SANITIZE_URL );
            break;
        case 'number' :
            $content = filter_var( $attributes['content'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_THOUSAND );
            break;
        default :
            $content = \sanitize_text_field( $attributes['content'] );
            break;
    }

    $output = sprintf( '<p %s>%s</p>', $wrapper_attributes, $content );

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