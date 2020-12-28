<?php

class PropertyListingActivator
{
	public static function activate()
	{
		global $table_prefix, $wpdb;

		$table_name = 'property_listing';
		$table_name = $table_prefix . $table_name;

		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			
			$sql = "CREATE TABLE `$table_name` (";
			$sql .= "`property_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,";
			$sql .= "`property_added_by` INT UNSIGNED NOT NULL,";
			$sql .= "`property_name` VARCHAR(255) NOT NULL DEFAULT '',";
			$sql .= "`property_url` TEXT NULL,";
			$sql .= "`property_description` TEXT NULL,";
			$sql .= "`property_type` ENUM('commercial', 'residential', 'industrial') NOT NULL DEFAULT 'residential',";
			$sql .= "`property_status` ENUM('On Sale', 'Sold') NOT NULL DEFAULT 'On Sale',";
			$sql .= "`property_image` TEXT NULL,";
			$sql .= "`created_at` TIMESTAMP NULL DEFAULT NULL,";
			$sql .= "`updated_at` TIMESTAMP NULL DEFAULT NULL";
			$sql .= ");";

			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
            dbDelta($sql);
		}
	}
}