<?php
/**
 *
 * setting page for notice bar plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
* create plugin option page    
*/

function wsnb_add_admin_menu() { 

    add_options_page( 'WP Simple Notice Bar', 'Simple Notice Bar', 'manage_options', 'wp_simple_notice_bar', 'wsnb_options_page','dashicons-admin-generic',100 );

}

add_action( 'admin_menu', 'wsnb_add_admin_menu' );

function wsnb_settings_init() { 

    register_setting( 'wsnb_options_group', 'wsnb_default_text' );
    register_setting( 'wsnb_options_group','wsnb_bg_color', 'sanitize_hex_color' );
    register_setting( 'wsnb_options_group', 'wsnb_text_color', 'sanitize_hex_color' );

    add_settings_section(
        'wsnb_settings_section',
        __( 'Settings', 'wsnb' ),
        null,
        'wp_simple_notice_bar'
    );

    add_settings_field( 
        'wsnb_default_text', 
        __( 'Default Notice Text', 'wsnb' ), 
        'wsnb_default_text_render', 
        'wp_simple_notice_bar', 
        'wsnb_settings_section' 
    );

    add_settings_field('wsnb_bg_color',
        __('Notice Bar Background Color', 'wsnb'),
        'wsnb_bg_color_render',
        'wp_simple_notice_bar',
        'wsnb_settings_section'
    );

    add_settings_field( 
        'wsnb_text_color', 
        __( 'Notice Bar Text Color', 'wsnb' ), 
        'wsnb_text_color_render', 
        'wp_simple_notice_bar', 
        'wsnb_settings_section' 
    );

    function wsnb_default_text_render() { 

        $option = get_option( 'wsnb_default_text', '🚀 This is a Simple Notice Bar (Practice Plugin)' );
        ?>
        <input type='text' name='wsnb_default_text' value='<?php echo esc_attr( $option ); ?>' style="width: 400px;">
        <?php

    }

    function wsnb_bg_color_render() {
        $color = get_option('wsnb_bg_color', '#ffeb3b' ); // Default to yellow if not set
        ?>
        <input type="color" name="wsnb_bg_color" value="<?php echo esc_attr( $color ); ?>" class="wsnb-color-field" data-default-color="#ffeb3b" />
        <?php
    }
    
    function wsnb_text_color_render() {
        $color = get_option('wsnb_text_color', '#000000' ); // Default to black if not set
        ?>
        <input type="color" name="wsnb_text_color" value="<?php echo esc_attr( $color ); ?>" class="wsnb-color-field" data-default-color="#000000" />
          <?php   
    }

}

add_action( 'admin_init', 'wsnb_settings_init' );

function wsnb_options_page() { 

    ?>
    <h1>WP Simple Notice Bar Settings</h1>
    <form action="options.php" method="post">
    <?php
    settings_fields( 'wsnb_options_group' );
    do_settings_sections( 'wp_simple_notice_bar' );
    submit_button( 'Save Settings' );
    ?>
    </form>
    <?php


}

// Add settings link to plugins page
function wsnb_add_settings_link($links) {
    $settings_link = '<a href="admin.php?page=wp_simple_notice_bar">' . __('Settings') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
 add_filter('plugin_action_links_wp-simple-notice-bar/wp-simple-notice-bar.php', 'wsnb_add_settings_link');