<?php

// Prevent direct file access
if ( ! defined( 'WPINC' ) ) {
	exit;
}

/*
 * @wordpress-plugin
 * Plugin Name:       Dealers League Marine
 * Plugin URI:        https://dealearsleague.com
 * Description:       Manage, list, broker and sell your boats online, book a charter or advertise your repair shop. The largest and most complete WordPress boat plugin.
 * Version:           2.0.0
 * Author:            josephbydesign, dealersleague
 * Author URI:        https://profiles.wordpress.org/josephbydesign/, https://dealersleague.com
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
