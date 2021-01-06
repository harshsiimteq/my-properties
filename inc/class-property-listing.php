<?php

class PropertyListing {

	public function __construct() { }

	public function run() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		add_action( 'admin_menu', [ $this, 'setup_menu' ] );
		add_action( 'init', [ $this, 'dequeue_styles' ], 100 );
		add_action( 'wp_dashboard_setup', [ $this, 'properties_panel' ] );
		add_action( 'init', [ $this, 'property_short_code' ] );
	}

	public function enqueue_assets( $hook ) {
		$lookup_hooks = [
			'toplevel_page_properties',
			'properties_page_add-property',
		];

		if ( in_array( $hook, $lookup_hooks ) ) {
			wp_enqueue_style( 'property-listing', plugin_dir_url( __DIR__ ) . 'assets/css/main-pl.css', [], TRUE, 'all' );
			wp_enqueue_style( 'property-listing-custom', plugin_dir_url( __DIR__ ) . 'assets/css/custom-pl.css', [], TRUE, 'all' );
			wp_enqueue_script( 'property-listing', plugin_dir_url( __DIR__ ) . 'assets/js/main-pl.js', [ 'jquery' ], '1.0.0', TRUE );
		}

	}

	public function dequeue_styles() {
		wp_dequeue_style( 'forms-css' );
	}

	public function setup_menu() {
		add_menu_page( 'properties', 'Properties', 'manage_options', 'properties', [
			$this,
			'main_menu',
		], 'dashicons-admin-site-alt2' );
		add_submenu_page(
			'properties',
			'Add Property',
			'Add Property',
			'manage_options',
			'add-property',
			[ $this, 'add_property_menu' ]
		);
	}

	public function main_menu() {
		global $wpdb, $table_prefix;
		$table_name = 'property_listing';
		$table_name = $table_prefix . $table_name;
		if ( isset( $_POST['update-property'] ) && $_POST['update-property'] == 'update-property' ) {
			$property_id = isset( $_POST['property_id'] ) ? $_POST['property_id'] : 0;
			$this->updateProperty( $property_id );
			$property = $this->getSingleProperty( $property_id );
			pl_get_template( 'single-property.php', [
				'property' => $property,
			] );
		} else if ( isset( $_POST['delete-property'] ) ) {
			$property_id = isset( $_POST['property_id'] ) ? $_POST['property_id'] : 0;
			$wpdb->delete( $table_name, [ 'property_id' => $property_id ] );
			$properties = $this->getProperties();
			pl_get_template( 'main.php', [
				'properties' => $properties,
			] );
		} else if ( isset( $_GET['property_id'] ) && isset( $_GET['action'] ) && $_GET['action'] == 'edit' && ! empty( $_GET['property_id'] ) && $_GET['property_id'] > 0 ) {
			$id       = isset( $_GET['property_id'] ) ? $_GET['property_id'] : 0;
			$property = $this->getSingleProperty( $id );
			pl_get_template( 'single-property.php', [
				'property' => $property,
			] );
		} else {
			$properties = $this->getProperties();
			pl_get_template( 'main.php', [
				'properties' => $properties,
			] );
		}
	}

	public function getSingleProperty( $id ) {
		global $wpdb, $table_prefix;
		$table_name = 'property_listing';
		$table_name = $table_prefix . $table_name;
		$sql        = "SELECT * FROM `{$table_name}` WHERE property_id = {$id};";

		return $wpdb->get_row( $sql, ARRAY_A );
	}

	public function getProperties() {
		global $wpdb, $table_prefix;
		$table_name = 'property_listing';
		$table_name = $table_prefix . $table_name;
		$sql        = "SELECT * FROM `{$table_name}`;";

		return $wpdb->get_results( $sql, ARRAY_A );
	}

	public function add_property_menu() {
		if ( isset( $_POST ) && ! empty( $_POST ) ) {
			$this->addProperty( $_POST );
			pl_get_template( 'main.php' );
		} else {
			pl_get_template( 'add-property.php' );
		}
	}

	public function addProperty( $data ) {
		global $wpdb, $table_prefix;
		$table_name = 'property_listing';
		$table_name = $table_prefix . $table_name;

		$property_name        = isset( $_POST['property_name'] ) ? sanitize_text_field( $_POST['property_name'] ) : '';
		$property_url         = isset( $_POST['property_url'] ) ? sanitize_text_field( $_POST['property_url'] ) : '';
		$property_description = isset( $_POST['property_description'] ) ? sanitize_text_field( $_POST['property_description'] ) : '';
		$property_type        = isset( $_POST['property_type'] ) ? sanitize_text_field( $_POST['property_type'] ) : '';
		$property_status      = isset( $_POST['property_status'] ) ? sanitize_text_field( $_POST['property_status'] ) : '';
		$image                = isset( $_FILES['property_image'] ) ? $_FILES['property_image'] : NULL;
		$image_url            = '';
		if ( ! is_null( $image ) ) {
			$upload_overrides = [ 'test_form' => FALSE ];
			$movefile         = wp_handle_upload( $image, $upload_overrides );
			if ( $movefile && ! isset( $movefile['error'] ) && isset( $movefile['url'] ) ) {
				$image_url = $movefile['url'];
			}
		}

		$wpdb->insert( $table_name, [
			'property_name'        => $property_name,
			'property_url'         => $property_url,
			'property_description' => $property_description,
			'property_type'        => $property_type,
			'property_status'      => $property_status,
			'property_added_by'    => get_current_user_id(),
			'property_image'       => $image_url,
			'created_at'           => date( 'Y-m-d H:i:s' ),
		] );
	}

	public function updateProperty( $id ) {
		global $wpdb, $table_prefix;
		$table_name           = 'property_listing';
		$table_name           = $table_prefix . $table_name;
		$property_name        = isset( $_POST['property_name'] ) ? sanitize_text_field( $_POST['property_name'] ) : '';
		$property_url         = isset( $_POST['property_url'] ) ? sanitize_text_field( $_POST['property_url'] ) : '';
		$property_description = isset( $_POST['property_description'] ) ? sanitize_text_field( $_POST['property_description'] ) : '';
		$property_type        = isset( $_POST['property_type'] ) ? sanitize_text_field( $_POST['property_type'] ) : '';
		$property_status      = isset( $_POST['property_status'] ) ? sanitize_text_field( $_POST['property_status'] ) : '';
		$image                = isset( $_FILES['property_image'] ) ? $_FILES['property_image'] : NULL;
		$image_url            = '';
		if ( ! is_null( $image ) ) {
			$upload_overrides = [ 'test_form' => FALSE ];
			$movefile         = wp_handle_upload( $image, $upload_overrides );
			if ( $movefile && ! isset( $movefile['error'] ) && isset( $movefile['url'] ) ) {
				$image_url = $movefile['url'];
			}
		}
		if ( ! empty( $image_url ) ) {
			$wpdb->update( $table_name, [
				'property_name'        => $property_name,
				'property_url'         => $property_url,
				'property_description' => $property_description,
				'property_type'        => $property_type,
				'property_status'      => $property_status,
				'property_added_by'    => get_current_user_id(),
				'property_image'       => $image_url,
				'updated_at'           => date( 'Y-m-d H:i:s' ),
			], [ 'property_id' => $id ] );
		} else {
			$wpdb->update( $table_name, [
				'property_name'        => $property_name,
				'property_url'         => $property_url,
				'property_description' => $property_description,
				'property_type'        => $property_type,
				'property_status'      => $property_status,
				'property_added_by'    => get_current_user_id(),
				'updated_at'           => date( 'Y-m-d H:i:s' ),
			], [ 'property_id' => $id ] );
		}
	}

	public function properties_panel() {
		wp_add_dashboard_widget( 'properties_stats', 'My Properties', [ $this, 'properties_panel_data' ] );
	}

	public function properties_panel_data() {
		global $wpdb, $table_prefix;
		$table           = $table_prefix . 'property_listing';
		$property_counts = $wpdb->get_var( "SELECT COUNT(*) FROM $table" );
		echo "You have listed total <strong>$property_counts properties</strong>.";
	}

	public function property_short_code() {
		add_shortcode( 'properties', [ $this, 'render_short_code_data' ] );
	}

	public function render_short_code_data( $atts, $content = NULL ) {
		global $wpdb, $table_prefix;

		$table = $table_prefix . 'property_listing';

		$attributes = shortcode_atts([
			'count' => 10,
			'latest' => true
		], $atts);

		$count = $attributes['count'];
		$latest = $attributes['latest'];
		if ($latest) {
			$properties = $wpdb->get_results("SELECT * FROM $table ORDER BY property_id DESC LIMIT $count", ARRAY_A);
		} else {
			$properties = $wpdb->get_results("SELECT * FROM $table ORDER BY property_id ASC LIMIT $count", ARRAY_A);
		}
		$properties = $this->transformProperty($properties);
		print_r($properties);
	}

	public static function transformProperty( $properties ) {
		$data = [];

		foreach ($properties as $key => $property) {
			$data[$key]['property_name'] = $property['property_name'];
			$data[$key]['property_url'] = $property['property_url'];
			$data[$key]['property_type'] = $property['property_type'];
			$data[$key]['property_status'] = $property['property_status'];
			$data[$key]['property_image'] = $property['property_image'];
		}

		return $data;
	}
}