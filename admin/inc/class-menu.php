<?php

/**
 * Menu and settings page for the plugin.
 *
 * @package    Oh_My_Bar
 * @subpackage Oh_My_Bar/inc
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Read_Bar_Menu {

	/**
	 * Registering admin menu for Read Bar
     *
	 * @since    0.1.0
	 */
    public function __construct() {
        add_action('admin_menu', [$this, 'read_bar_menu']);
    }

	/**
     * Adding menu page for Read Bar
     *
	 * @since    0.1.0
	 */
    public function read_bar_menu() {
        add_menu_page(
            __('Read Bar Settings', 'my-read-bar'),
            'Oh My Bar',
            'manage_options',
            'read_bar_setting',
            array($this,'read_bar_setting_page_cb'),
            'dashicons-minus',
            100
        );
    }

	/**
	 * Read bar settings callback
     *
	 * @since    0.1.0
	 */
    function read_bar_setting_page_cb() {
        if (!current_user_can('manage_options')) return;
        ?>
        <form method="post" action="options.php">
            <div class="omb_main-wrapper">
                <h1 class="omb-title"><?php echo esc_html(get_admin_page_title()); ?></h1>
                <?php
                settings_errors();
                if(wp_verify_nonce('test-nonce') || isset($_GET[ 'tab' ]) ) {
                    $tabValue = sanitize_text_field($_GET[ 'tab' ]);
                    $active_tab = isset($tabValue) ? $tabValue : 'setting-options';
                }
                settings_fields('read_bar_setting');
                do_settings_sections('read_bar_setting');
                submit_button('Save Changes');
                ?>
            </div>
        </form>
        <?php
    }
}
new Read_Bar_Menu();
