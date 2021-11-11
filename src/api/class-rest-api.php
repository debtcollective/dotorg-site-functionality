<?php
/**
 * Rest API Functions
 *
 * @since   1.0.0
 * @package Site_Functionality
 */

namespace Site_Functionality\API;

use Site_Functionality\Abstracts\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RestAPI extends Base {

	/**
	 * @var string
	 */
	const API_NAMESPACE = 'site-functionality/v1';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $version, $plugin_name ) {
		parent::__construct( $version, $plugin_name );

		\add_action( 'rest_api_init', 					[ $this, 'register_routes' ] );
		\add_filter( 'rest_user_query', 				[ $this, 'rest_user_modify_query' ], 10, 2 );
		\add_filter( 'rest_user_collection_params', 	[ $this, 'rest_user_collection_add_params' ], 10, 2 );

	}

	/**
	 * Register API Routes
	 *
	 * @return void
	 */
	public function register_routes() {
		\register_rest_route( self::API_NAMESPACE, '/roles', 
			[
				'methods' 				=> 'GET',
				'callback' 				=> [ $this, 'get_user_roles' ],
				'permission_callback' 	=> \__return_true(),
			]
		);
	}

	/**
	 * Get WP user roles
	 *
	 * @return array An array of user roles.
	 */
	public function get_user_roles() {
		return ( $roles = \wp_roles() ) ? $roles->role_names : [];
	}

	/**
	 * Add Param to user collection
	 * 
	 * @see: https://developer.wordpress.org/reference/hooks/rest_user_collection_params/
	 *
	 * @param array $query_params
	 * @return array $query_params
	 */
	public function rest_user_collection_add_params( $query_params ) : array {
		$query_params['is_public'] = [
			'description' => __( 'Query based on value of is_public field.', 'site-functionality' ),
            'type'        => 'boolean',
		];
		return $query_params;
	}

	/**
	 * Modify the user query
	 *
	 * @param array $prepared_args
	 * @param WP_REST_Request $request
	 * @return array $prepared_args
	 */
	public function rest_user_modify_query( $prepared_args, $request ) : array {
		if( $request['is_public'] ) {
			$prepared_args['meta_key'] = 'is_public';
			$prepared_args['meta_value'] = (bool) $request['is_public'];
		}
		return $prepared_args;
	}

}
