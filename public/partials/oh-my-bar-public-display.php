<?php

class Display_Read_Bar {
    public function __construct() {
        add_action('wp_body_open', array($this,'omb_public_html'));
        add_action('wp_head', array($this,'omb_public_style'));    

        // Setting variables
        $this->enable_bar = get_option('rb_enable_bar');   
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

    public function omb_public_style() {        ?>
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
                <?php if($this->bar_shadow  === 'off') { ?>
                    box-shadow: none;
                <?php } else { ?>                    
                    box-shadow: 0px 0px 10px 0px <?php echo esc_html($this->foreground_color); ?>bf;
                <?php } ?>
                <?php if($this->bar_rounded  === 'off') { ?>
                    border-radius: 0;
                <?php } else { ?>
                    border-radius: 50px;
                <?php } ?>            
            }
            
            progress.my_progressbar::-moz-progress-bar {                
                background-color:<?php echo esc_html($this->foreground_color); ?>;                
                height:<?php echo esc_html($this->bar_height.'px'); ?>;
                <?php if($this->bar_shadow  === 'off') { ?>
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
    
    public function omb_public_html() {
        if( is_home() && $this->enable_bar === 'on' && $this->show_home_page === 'on' ) {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
        elseif (is_single() && $this->enable_bar === 'on' && $this->show_single_post === 'on') {
            ?>
            <progress value='0' class="my_progressbar" ></progress>
            <?php  
        }
        elseif(is_page() && $this->enable_bar === 'on' && $this->show_single_page === 'on') {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
        elseif(is_archive() && $this->enable_bar === 'on' && $this->show_archive_page === 'on') {
            ?>
            <progress value='0' class="my_progressbar"></progress>
            <?php
        }
    }
}

new Display_Read_Bar();