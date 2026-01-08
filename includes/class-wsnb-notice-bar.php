<?php
/**
 * Notice Bar Class
 *
 * Handles the frontend notice bar output.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WSNB_Notice_Bar {

    /**
     * Get notice bar HTML
     *
     * @return string
     */
    public function get_notice_bar_html() {

        // Later this can come from database optionsss
       // $notice_text = '🚀 This is a Simple Notice Bar (Practice Plugin)';
        $notice_text = get_option( 'wsnb_default_text', '🚀 This is a Simple Notice Bar (Practice Plugin)' );

        ob_start();
        ?>
        <div id="wsnb-notice-bar">
            <span class="wsnb-text">
                <?php echo esc_html( $notice_text ); ?>
            </span>

            <button class="wsnb-close" aria-label="Close notice bar">
                &times;
            </button>
        </div>
        <?php
        return ob_get_clean();
    }
}