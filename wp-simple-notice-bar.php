<?php
/**
 * Plugin Name: WP Simple Notice Bar
 * Plugin URI: https://wordpress.org/plugins/wp-simple-notice-bar/
 * Description: A simple notice bar plugin for practice.    
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Amir
 * Author URI:        https://amir.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:      wsnb
 * Domain Path:       /languages
 */


require_once plugin_dir_path( __FILE__ ) . 'includes/class-wsnb-main.php';
new WSNB_Main();
