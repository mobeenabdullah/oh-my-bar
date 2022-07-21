<?php 

class Read_Bar_Menu {
    public function __construct() {
        add_action('admin_menu', [$this, 'read_bar_menu']);
    }

    public function read_bar_menu() {
        add_menu_page( 
            __('Read Bar Settings', 'my-read-bar'),
            'Read Bar Settings',
            'manage_options',
            'read_bar_setting',
            array($this,'read_bar_setting_page_cb'),
            'dashicons-minus',
            100
        ); 
    }

    function read_bar_setting_page_cb() {
        if (!current_user_can('manage_options')) return;
        ?>
        <form method="post" action="options.php">
            <div class="wrap">     
                <h1 class="mpb-title"><?php echo esc_html(get_admin_page_title()); ?></h1>
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