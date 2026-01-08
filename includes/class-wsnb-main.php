<?php
/**
 * Main Plugin Controller Class
 *
 * @package WP_Simple_Notice_Bar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define( 'WSNB_VERSION', '1.0.0' );

require_once plugin_dir_path( __FILE__ ) . '../admin/settings.php';

class WSNB_Main {

    /**
     * Constructor
     */
    public function __construct() {
        $this->load_dependencies();
        $this->register_hooks();
    }

    /**
     * Load required plugin files
     */
    private function load_dependencies() {
        require_once plugin_dir_path( __FILE__ ) . 'class-wsnb-notice-bar.php';
    }

    /**
     * Register WordPress hooks
     */
    private function register_hooks() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'wp_footer', array( $this, 'render_notice_bar' ) );
    }

    /**
     * Enqueue CSS & JS
     */
    public function enqueue_assets() {
        wp_enqueue_style(
            'wsnb-style',
            plugin_dir_url( __FILE__ ) . '../assets/css/wsnb-style.css',
            array(),
            WSNB_VERSION
        );

        wp_enqueue_script(
            'wsnb-script',
            plugin_dir_url( __FILE__ ) . '../assets/js/wsnb-script.js',
            array( 'jquery' ),
            WSNB_VERSION,
            true
        );

        $default_text = get_option( 'wsnb_default_text', '🚀 This is a Simple Notice Bar (Practice Plugin)' );
        $bg_color = get_option( 'wsnb_bg_color', '#ffeb3b' );
       $text_color = get_option( 'wsnb_text_color', '#000000' );

        $custom_css = "
            #wsnb-notice-bar {
                background-color: {$bg_color} !important;
                color: {$text_color} !important;
            }";
        wp_add_inline_style( 'wsnb-style', $custom_css );
    }

    /**
     * Render notice bar
     */
    public function render_notice_bar() {
        $notice_bar = new WSNB_Notice_Bar();
        echo wp_kses_post( $notice_bar->get_notice_bar_html() );
    }
}

