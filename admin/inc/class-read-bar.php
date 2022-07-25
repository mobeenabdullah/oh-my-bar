<?php
class Read_Bar_Settings {
    public function __construct() {
        add_action('admin_menu', array($this, 'rb_settings_init'));

        $switch_fields = [
            'rb_enable_bar',
            'rb_bar_shadow',
            'rb_bar_rounded',
            'rb_show_home_page',
            'rb_show_single_post',
            'rb_show_single_page',
            'rb_show_archive',
        ];
        foreach($switch_fields as $switch_field) {
            add_filter( 'pre_update_option_' . $switch_field , [$this, 'handle_switch_value'], 10, 2 );
        }
    }

    public function handle_switch_value( $new_value, $old_value ) {
        if($new_value !== 'on') {
            return esc_html('off');
        } else {
            return esc_html('on');
        }
    }
    
    public function rb_settings_init() {
        $rb_setting_fields_array = [
            'rb_enable_bar',
            'rb_background_color',
            'rb_foreground_color',
            'rb_background_opacity',
            'rb_bar_shadow',
            'rb_bar_rounded',
            'rb_bar_placement',
            'rb_bar_height',
            'rb_show_home_page',
            'rb_show_single_post',
            'rb_show_single_page',
            'rb_show_archive',            
        ];
        
        add_settings_section( 'read_bar_section', '', '', 'read_bar_setting' ); 

        foreach($rb_setting_fields_array as $field_name) {
            register_setting('read_bar_setting', $field_name);
        }

        add_settings_field(
            'rb_enable_bar_setting_field',
            __('Enable/Disable Read Bar', 'oh-my-bar'),
            array($this,'rb_enable_bar_cb'),
            'read_bar_setting',
            'read_bar_section'
        ); 
        
        add_settings_field(
            'rb_background_color_setting_field',
            __('Background', 'oh-my-bar'),
            array($this,'rb_background_color_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'default_value' => '#e6e6e6'
            )
        );

        add_settings_field(
            'rb_foreground_color_setting_field',
            __('Foreground', 'oh-my-bar'),
            array($this,'rb_foreground_color_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'default_value' => '#e3dc29'
            )
        );

        add_settings_field(
            'rb_background_opacity_setting_field',
            __('Background Opacity', 'oh-my-bar'),
            array($this,'rb_background_opacity_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'default_value' => 0,
            )
        );        
        
        add_settings_field(
            'rb_bar_shadow_setting_field',
            __('Shadow', 'oh-my-bar'),
            array($this,'rb_bar_shadow_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'default_value' => 'on',
            )
        ); 

        add_settings_field(
            'rb_bar_rounded_setting_field',
            __('Rounded', 'oh-my-bar'),
            array($this,'rb_bar_rounded_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'default_value' => 'on',
            )
        );

        add_settings_field(
            'rb_bar_placement_setting_field',
            __('Placement ', 'oh-my-bar'),
            array($this,'rb_bar_placement_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'default_value' => 'top',
            )
        );

        add_settings_field(
            'rb_bar_height_setting_field',
            __('Height', 'oh-my-bar'),
            array($this,'rb_bar_height_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'default_value' => 10,
            )
        );

        add_settings_field(
            'rb_display_on_setting_field',
            __('Display on', 'oh-my-bar'),
            array($this,'rb_display_on_cb'),
            'read_bar_setting',
            'read_bar_section',
            array(
                'single_post_default_value' => 'on',
            )
        );   

    }

    public function rb_enable_bar_cb() {
        ?>
        <div class="switch__wrapper">
            <input type="checkbox" id="rb-enable-bar" name="rb_enable_bar" value="on" <?php checked('on', esc_attr(get_option('rb_enable_bar')), true); ?>>
            <label class="switch__wrapper-label" for="rb-enable-bar"></label>        
        </div>    
        <?php
    }

    public function rb_background_color_cb($args) {
        $value = (empty(get_option('rb_background_color'))) ? $args['default_value'] : get_option('rb_background_color');
        ?>        
        <div class="color_field-wrapper color_background"> 
            <div class="color_switch-wrapper">
                <div class="color-picker-bg"></div>
                <div class="color-box" style="background-color: <?php echo esc_attr($value);?>;"></div>        
            </div>
            <input type="hidden" name="rb_background_color" value="<?php echo esc_attr($value); ?>">
        </div>
        <?php
    }

    public function rb_foreground_color_cb($args) {
        $value = (empty(get_option('rb_foreground_color'))) ? $args['default_value'] : get_option('rb_foreground_color');
        ?>
        <div class="color_field-wrapper color_foreground">
            <div class="color_switch-wrapper">
                <div class="color-picker-fg"></div>
                <div class="color-box" style="background-color: <?php echo esc_attr($value);?>;"></div>
            </div>
            <input type="hidden" name="rb_foreground_color" value="<?php echo esc_attr($value);?>">
        </div>
        <?php
    }

    public function rb_background_opacity_cb($args) {
        $value = (empty(get_option('rb_background_opacity'))) ? $args['default_value'] : get_option('rb_background_opacity');        
        ?>
        <div class="range__slider slider_bg-transparent">
            <input type="range" min="0" max="100" step="1" name="rb_background_opacity" value="<?php echo esc_attr($value);?>" data-rangeslider>
            <div class="display__value-wrapper">
                <span class="output-value"></span>
                <span>%</span>
            </div>
        </div>
        <?php
    }

    public function rb_bar_shadow_cb($args) {
        $value = (get_option('rb_bar_shadow') === 'on' || get_option('rb_bar_shadow') === 'off') ? get_option('rb_bar_shadow') : $args['default_value'];
        ?>
        <div class="switch__wrapper">
            <input type="checkbox" id="rb-bar-shadow" name="rb_bar_shadow" value="on" <?php checked('on', esc_attr($value), true); ?>>
            <label class="switch__wrapper-label" for="rb-bar-shadow"></label>        
        </div>    
        <?php
    }

    public function rb_bar_rounded_cb($args) {
        $value = (get_option('rb_bar_rounded') === 'on' || get_option('rb_bar_rounded') === 'off') ? get_option('rb_bar_rounded') : $args['default_value'];
        ?>
        <div class="switch__wrapper">
            <input type="checkbox" id="rb-bar-rounded" name="rb_bar_rounded" value="on" <?php checked('on', esc_attr($value), true); ?>>
            <label class="switch__wrapper-label" for="rb-bar-rounded"></label>                    
        </div>        
        <?php
    } 

    public function rb_bar_placement_cb($args) {
        $value = (empty(get_option('rb_bar_placement'))) ? $args['default_value'] : get_option('rb_bar_placement');
        ?>
        <div class="bar__placement">
            <input type="radio" id="top" class="bar__placement-option" name="rb_bar_placement" value="top" <?php checked('top', esc_attr($value), true); ?>>            
            <input type="radio" id="bottom" class="bar__placement-option" name="rb_bar_placement" value="bottom" <?php checked('bottom', esc_attr($value), true); ?>>            
            <label for="top" class="bar__placement-label top-align">
                <span></span>
            </label>          
            <label for="bottom" class="bar__placement-label bottom-align">
                <span></span>
            </label>           
        </div>
        <?php
    }

    public function rb_bar_height_cb($args) {
        $value = (empty(get_option('rb_bar_height'))) ? $args['default_value'] : get_option('rb_bar_height');
        ?> 
        <div class="range__slider slider-height">
            <input type="range" min="0" max="20" step="1" name="rb_bar_height" value="<?php echo esc_attr($value);?>" data-rangeslider>
            <div class="display__value-wrapper">
                <span class="output-value"></span>
                <span>px</span>
            </div>            
        </div>
        <?php
    }

    public function rb_display_on_cb($args) {
        $single_post_value = (get_option('rb_show_single_post') === 'on' || get_option('rb_show_single_post') === 'off') ? get_option('rb_show_single_post') : $args['single_post_default_value'];
        ?>
        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_home_page" name="rb_show_home_page" value="on" <?php checked('on', esc_attr(get_option('rb_show_home_page')), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_home_page"></label>        
            <div class="switch__wrapper-text">            
                <span><?php esc_html_e('Front-page/Home Page ', 'oh-my-bar'); ?></span>
            </div>
        </div>

        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_single_post" name="rb_show_single_post" value="on" <?php checked('on', esc_attr($single_post_value), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_single_post"></label>
            <div class="switch__wrapper-text">                    
                <span><?php esc_html_e('Single Post', 'oh-my-bar'); ?></span>
            </div>
        </div>

        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_single_page" name="rb_show_single_page" value="on" <?php checked('on', esc_attr(get_option('rb_show_single_page')), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_single_page"><span></label>        
            <div class="switch__wrapper-text">            
                <?php esc_html_e('Single Page', 'oh-my-bar'); ?></span>
            </div>
        </div> 

        <div class="switch__wrapper display-on">
            <input type="checkbox" id="rb_show_archive" name="rb_show_archive" value="on" <?php checked('on', esc_attr(get_option('rb_show_archive')), true); ?>>
            <label class="switch__wrapper-label" for="rb_show_archive"></label>        
            <div class="switch__wrapper-text">            
                <span><?php esc_html_e('Archives & Categories', 'oh-my-bar'); ?></span>
            </div>
        </div>      
        <?php    
    }
}
new Read_Bar_Settings();