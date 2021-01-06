<?php

class PropertyAPI {

	public function __construct() { }

	public function run() {
		add_action( 'rest_api_init', [ $this, 'register_api' ] );
	}

	public function register_api() {
		register_rest_route( 'pl/v1', 'properties', [
			'methods'             => 'GET',
			'callback'            => [ $this, 'get_rest_properties' ],
			'permission_callback' => '__return_true',
		] );
	}

	public function get_rest_properties( WP_REST_Request $request ) {
		global $wpdb, $table_prefix;

		$table      = $table_prefix . 'property_listing';
		$properties = $wpdb->get_results( "SELECT * FROM $table", ARRAY_A );
		$wpdb->flush();
		$response = new WP_REST_Response( $properties );
		$response->set_status( 200 );

		return $response;
	}
}
