<?php
class Read_Bar_Settings {
    public function __construct() {
        add_action('admin_init', array($this, 'rb_settings_init'));
    }
    
    public function rb_settings_init() {
        $read_bar_settings_array = [
            'rb_background_color' => '#e6e6e6',
            'rb_foreground_color' => '#e3dc29',
            'rb_background_opacity' => 0,
            'rb_bar_shadow' => 1,
            'rb_bar_rounded' => 1,
            'rb_bar_placement' => 'top',
            'rb_bar_height' => 8,
            'rb_show_home_page' => 0,
            'rb_show_single_post' => 1,
            'rb_show_single_page' => 0,
            'rb_show_archive' => 0,            
        ];

        foreach($read_bar_settings_array as $key => $value) {
            register_setting('read_bar_setting', $key, ['default' => $value]);
        }
        
        $this->get_settings_feilds();

        add_settings_section( 'read_bar_section', '', '', 'read_bar_setting' ); 
        
        add_settings_field(
            'rb_background_color_setting_field',
            __('Background', 'oh-my-bar'),
            array($this,'rb_background_color_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'label_for'         => 'bg_color',
                'class'             => 'show_field custom_style_fields',
                'wporg_custom_data' => 'custom',
            )
        );

        add_settings_field(
            'rb_foreground_color_setting_field',
            __('Foreground', 'oh-my-bar'),
            array($this,'rb_foreground_color_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'label_for'         => 'foreground_color',
                'class'             => 'show_field custom_style_fields',
                'wporg_custom_data' => 'custom',
            )
        );

        add_settings_field(
            'rb_background_opacity_setting_field',
            __('Background Opacity', 'oh-my-bar'),
            array($this,'rb_background_opacity_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'label_for'         => 'bg_transparent',
                'class'             => 'show_field custom_style_fields',
                'wporg_custom_data' => 'custom',
            )
        );        
        
        add_settings_field(
            'rb_bar_shadow_setting_field',
            __('Shadow', 'oh-my-bar'),
            array($this,'rb_bar_shadow_cb'),
            'read_bar_setting',
            'read_bar_section'
        ); 

        add_settings_field(
            'rb_bar_rounded_setting_field',
            __('Rounded', 'oh-my-bar'),
            array($this,'rb_bar_rounded_cb'),
            'read_bar_setting',
            'read_bar_section'
        );

        add_settings_field(
            'rb_bar_placement_setting_field',
            __('Placement ', 'oh-my-bar'),
            array($this,'rb_bar_placement_cb'),
            'read_bar_setting',
            'read_bar_section'
        );

        add_settings_field(
            'rb_bar_height_setting_field',
            __('Height', 'oh-my-bar'),
            array($this,'rb_bar_height_cb'),
            'read_bar_setting',
            'read_bar_section'
        );

        add_settings_field(
            'rb_display_on_setting_field',
            __('Display on', 'oh-my-bar'),
            array($this,'rb_display_on_cb'),
            'read_bar_setting',
            'read_bar_section'
        );   

    }

    public function get_settings_feilds() {
            $this->background_color = get_option('rb_background_color');
            $this->foreground_color = get_option('rb_foreground_color');
            $this->background_opacity = get_option('rb_background_opacity'); 
            $this->bar_shadow = get_option('rb_bar_shadow');
            $this->bar_rounded = get_option('rb_bar_rounded');
            $this->bar_placement = get_option('rb_bar_placement'); 
            $this->bar_height = get_option('rb_bar_height');
            $this->show_home_page = get_option('rb_show_home_page'); 
            $this->show_single_post = get_option('rb_show_single_post'); 
            $this->show_single_page = get_option('rb_show_single_page'); 
            $this->show_archive_page = get_option('rb_show_archive');
    }

    public function rb_background_color_cb() {
        ?>        
        <div class="color_field-wrapper color_background"> 
            <div class="color-picker-bg"></div>
            <div class="color-box" style="background-color: <?php echo esc_attr($this->background_color);?>;"></div>        
            <input type="text" name="rb_background_color" value="<?php echo esc_attr($this->background_color);?>">
        </div>
        <?php
    }

    public function rb_foreground_color_cb() {
        ?>
        <div class="color_field-wrapper color_foreground">
            <div class="color-picker-fg"></div>
            <div class="color-box" style="background-color: <?php echo esc_attr($this->foreground_color);?>;"></div>
            <input type="text" name="rb_foreground_color" value="<?php echo esc_attr($this->foreground_color);?>">
        </div>
        <?php
    }

    public function rb_background_opacity_cb() {
        ?>
        <div class="range__slider slider_bg-transparent">
            <input type="range" min="0" max="100" step="1" name="rb_background_opacity" value="<?php echo esc_attr($this->background_opacity);?>" data-rangeslider>
            <input class="output-value" disabled />
        </div>
        <?php
    }

    public function rb_bar_shadow_cb() {
        ?>
        <div class="switch__wrapper">
            <input type="checkbox" id="rb-bar-shadow" name="rb_bar_shadow" value="1" <?php checked(1, esc_attr($this->bar_shadow), true); ?>>
            <label class="switch__wrapper-label" for="rb-bar-shadow"></label>        
        </div>    
        <?php
    }

    public function rb_bar_rounded_cb() {
        ?>
        <div class="switch__wrapper">
            <input type="checkbox" id="rb-bar-rounded" name="rb_bar_rounded" value="1" <?php checked(1, esc_attr($this->bar_rounded), true); ?>>
            <label class="switch__wrapper-label" for="rb-bar-rounded"></label>                    
        </div>        
        <?php
    } 

    public function rb_bar_placement_cb() {
        ?>
        <div class="bar__placement">
            <input type="radio" id="top" class="bar__placement-option" name="rb_bar_placement" value="top" <?php checked('top', esc_attr($this->bar_placement), true); ?>>            
            <input type="radio" id="bottom" class="bar__placement-option" name="rb_bar_placement" value="bottom" <?php checked('bottom', esc_attr($this->bar_placement), true); ?>>            
            <label for="top" class="bar__placement-label top-align">
                <span></span>
            </label>          
            <label for="bottom" class="bar__placement-label bottom-align">
                <span></span>
            </label>           
        </div>
        <?php
    }

    public function rb_bar_height_cb() {       
        ?>
        <div class="range__slider slider-height">
            <input type="range" min="0" max="20" step="1" name="rb_bar_height" value="<?php echo esc_attr($this->bar_height);?>" data-rangeslider>
            <input class="output-value" disabled />
        </div>
        <?php
    }

    public function rb_display_on_cb() {    
        ?>    
        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_home_page" name="rb_show_home_page" value="1" <?php checked(1, esc_attr($this->show_home_page), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_home_page"></label>        
            <div class="switch__wrapper-text">            
                <span><?php esc_html_e('Front-page/Home Page ', 'oh-my-bar'); ?></span>
            </div>
        </div>

        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_single_post" name="rb_show_single_post" value="1" <?php checked(1, esc_attr($this->show_single_post), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_single_post"></label>
            <div class="switch__wrapper-text">                    
                <span><?php esc_html_e('Single Post', 'oh-my-bar'); ?></span>
            </div>
        </div>

        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_single_page" name="rb_show_single_page" value="1" <?php checked(1, esc_attr($this->show_single_page), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_single_page"><span></label>        
            <div class="switch__wrapper-text">            
                <?php esc_html_e('Single Page', 'oh-my-bar'); ?></span>
            </div>
        </div> 

        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_archive" name="rb_show_archive" value="1" <?php checked(1, esc_attr($this->show_archive_page), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_archive"></label>        
            <div class="switch__wrapper-text">            
                <span><?php esc_html_e('Archives & Categories', 'oh-my-bar'); ?></span>
            </div>
        </div>      
        <?php    
    }
}
new Read_Bar_Settings();