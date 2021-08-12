<?php

// Prevent direct file access
if ( ! defined( 'WPINC' ) ) {
	exit;
}

/*
 * @wordpress-plugin
 * Plugin Name:       Dealers League Marine Development
 * Plugin URI:        https://dealearsleague.com
 * Description:       Manage, list, broker and sell your boats online, book a charter or advertise your repair shop. The largest and most complete WordPress boat plugin.
 * Version:           1.2.0
 * Author:            <a href="https://profiles.wordpress.org/josephbydesign/">josephbydesign</a>, <a href="https://dealersleague.com">dealersleague</a>
 * Author URI:        https://dealersleague.com
 * Text Domain:       dlmarine
 * Domain Path:       /languages
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

use dealersleague\marine\wordpress\Dealers_League_Marine;

function dealers_league_marine_plugin() {
	$plugin = new Dealers_League_Marine();
	$plugin->load();
	$plugin->load_plugin_textdomain();

}

register_activation_hook(__FILE__,'my_custom_plugin_activate');
function my_custom_plugin_activate() {
	flush_rewrite_rules();
}

add_action( 'plugins_loaded', 'dealers_league_marine_plugin', 99 );

add_filter("broker_name_filter","broker_name_filter_call");
function broker_name_filter_call($arg){
	if(isset($_GET['filter']) && isset($_GET['id']) && $_GET['id'] != "undefined"){

		$ar = [
			"post_type" => "boat",
			"post_status" => "publish",

			"meta_query" => [
				[
					"key" => "listing_broker_id",
					"value" => $_GET['id'],
					"compare" => "LIKE"
				]
			]
		];
		return $ar;
	}
	 return $arg;
}

// Self-Hosted-WordPress-Plugin-repository
add_action( 'init', 'activate_au' );
function activate_au() {
	require_once ( 'wp_autoupdate.php' );
	$plugin_current_version = '1.2.0';
	$plugin_remote_path = plugin_dir_url( __FILE__ ) . 'update.php';
	$plugin_slug = plugin_basename( __FILE__ );
	$license_user = '';
	$license_key = '';
	new WP_AutoUpdate ( $plugin_current_version, $plugin_remote_path, $plugin_slug, $license_user, $license_key );
}