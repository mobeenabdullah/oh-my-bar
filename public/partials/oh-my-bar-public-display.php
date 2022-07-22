<?php

class Display_Read_Bar {
    public function __construct() {    
        $this->background_color = (!empty(get_option('rb_background_color'))) ? get_option('rb_background_color') : "#e6e6e6";
        $this->foreground_color = (!empty(get_option('rb_foreground_color'))) ? get_option('rb_foreground_color') : "#e3dc29";
        $this->background_opacity = (!empty(get_option('rb_background_opacity'))) ? get_option('rb_background_opacity') : 0; 
        $this->bar_shadow = (!empty(get_option('rb_bar_shadow'))) ? get_option('rb_bar_shadow') : 1;
        $this->bar_rounded = (!empty(get_option('rb_bar_rounded'))) ? get_option('rb_bar_rounded') : 1;
        $this->bar_placement = (!empty(get_option('rb_bar_placement'))) ? get_option('rb_bar_placement') : "top"; 
        $this->bar_height = (!empty(get_option('rb_bar_height'))) ? get_option('rb_bar_height') : 10;
        $this->show_home_page = (!empty(get_option('rb_show_home_page'))) ? get_option('rb_show_home_page') : 0; 
        $this->show_single_post = (!empty(get_option('rb_show_single_post'))) ? get_option('rb_show_single_post') : 1; 
        $this->show_single_page = (!empty(get_option('rb_show_single_page'))) ? get_option('rb_show_single_page') : 0; 
        $this->show_archive_page = (!empty(get_option('rb_show_archive'))) ? get_option('rb_show_archive') : 0; 
        
    }

    public function register() {
        add_action('wp_body_open', array($this,'mpb_public_html'));
        add_action('wp_head', array($this,'mpb_public_style'));    
    }

    public function mpb_public_style() {        ?>
        <style>

            progress.my_progressbar {
                width: 100%;
                <?php 
                if($this->bar_placement === 'bottom') {
                    ?>
                position: fixed;
                bottom: 0;
                <?php 
                }                    
                ?>
                <?php 
                    $hex = $this->background_color;
                    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x"); 
                    $opacity =    $this->background_opacity/100;               
                ?>
                background-color:rgba(<?php echo esc_html($r . ',' .  $g . ',' .  $b . ',' .  $opacity); ?>);
                height:<?php echo esc_html($this->bar_height.'px'); ?>;
            }

            progress.my_progressbar::-webkit-progress-bar {                
                background-color:rgba(<?php echo esc_html($r . ',' .  $g . ',' .  $b . ',' .  $opacity); ?>);                
                height:<?php echo esc_html($this->bar_height.'px'); ?>;                
            }

            progress.my_progressbar::-webkit-progress-value {                
                background-color:<?php echo esc_html($this->foreground_color); ?>;                
                height:<?php echo esc_html($this->bar_height.'px'); ?>;
                <?php if(empty($this->bar_shadow)) { ?>
                    box-shadow: none;
                <?php } else { ?>                    
                    box-shadow: 0px 0px 10px 0px <?php echo esc_html($this->foreground_color); ?>bf;
                <?php } ?>
                <?php if(empty($this->bar_rounded)) { ?>
                    border-radius: 0;
                <?php } else { ?>
                    border-radius: 50px;
                <?php } ?>            
            }
            
            progress.my_progressbar::-moz-progress-bar {                
                background-color:<?php echo esc_html($this->foreground_color); ?>;                
                height:<?php echo esc_html($this->bar_height.'px'); ?>;
                <?php if(empty($this->bar_shadow)) { ?>
                    box-shadow: none;
                <?php } else { ?>                    
                        box-shadow: 0px 0px 10px 0px <?php echo esc_html($this->foreground_color); ?>bf;
                <?php } ?>
            }
            <?php 
                $total_height = $this->bar_height / 1.5;                
            ?>

            progress.my_progressbar.left_progressbar, progress.my_progressbar.right_progressbar {
                -webkit-appearance: none;
                appearance: none;
                position: fixed;
                top: 0;
                left: 0;
                transform: translate(calc(-50% + <?php echo esc_html($total_height .'px'); ?>), calc(50vh - 50%)) rotate(90deg);
                width: 100vh;
            }
            progress.my_progressbar.right_progressbar {
                transform: translate(calc(50% + -<?php echo esc_html($total_height .'px'); ?>), calc(50vh - 50%)) rotate(90deg);
                left: inherit;
                right: 0 !important;
            }
        </style>            
        <?php
    }
    
    public function mpb_public_html() {
        if( is_home() && !empty($this->show_home_page) ) {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
        elseif (is_single() && !empty($this->show_single_post) ) {
            ?>
            <progress value='0' class="my_progressbar" ></progress>
            <?php  
        }
        elseif(is_page() && !empty($this->show_single_page)) {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
        elseif(is_archive() && !empty($this->show_archive_page)) {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
    }
}