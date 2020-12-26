<?php

class PropertyListing
{
	
	public function __construct() {
		# code...
	}

	public function run()
	{
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_assets']);
	}

	public function enqueue_assets()
	{
		wp_enqueue_style( 'property-listing', plugin_dir_url( __DIR__ ).'assets/css/main-pl.css', [], true, 'all' );
		wp_enqueue_script('property-listing', plugin_dir_url( __DIR__ ).'assets/js/main-pl.js', array('jquery'), '1.0.0', true);
	}
}