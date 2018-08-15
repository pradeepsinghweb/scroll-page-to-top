<?php
/*
Plugin Name: Scroll Page To Top
Plugin URI: https://wordpress.org/plugins/scroll-page-to-top/
Description: Scroll Page To Top is a lightweight plugin that helps to add "Scroll to top / Back to top / Scroll Page to Top" feature in your WordPres site.
Author: Pradeep Singh
Version: 1.0
Author URI: https://github.com/pradeepsinghweb
Text Domain: scroll-page-to-top
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


class RPS_SCROLL_PAGE_TO_TOP
{
    private $rps_scroll_settings;
    function __construct() {
        $this->rps_scroll_settings = unserialize(get_option('_rps_scroll_page_to_top_settings'));
        add_action( 'wp_enqueue_scripts', array( $this, 'rps_scroll_page_to_top_scripts' ) );
        add_action( 'wp_head', array( $this, 'rps_scroll_page_to_top_styles' ) );
        add_action( 'wp_footer', array( $this, 'rps_scroll_page_to_top_button_script' ) );
    }
    public function rps_scroll_page_to_top_scripts(){
        wp_enqueue_script( 'rps_scroll_page_to_top_js',  plugin_dir_url(__FILE__).'js/jquery.scrollUp.min.js', array('jquery'), '2.4.1', true );
    }
    public function rps_scroll_page_to_top_styles(){
        ?>
        <style type="text/css">
            <?php if($this->rps_scroll_settings['rps_scroll_method'] == "simple_text"){
                echo '#rps_scroll_page_to_top {
                        background-color: '.$this->rps_scroll_settings['rps_bga_color'].';
                        color: '.$this->rps_scroll_settings['rps_text_color'].';
                        font-size: '.$this->rps_scroll_settings['rps_font_size'].'px;
                        border-radius: '.$this->rps_scroll_settings['rps_button_radius'].'px;
                        padding: '.$this->rps_scroll_settings['rps_button_padding'].';
                    }
                    #rps_scroll_page_to_top:hover {
                        background-color: '.$this->rps_scroll_settings['rps_hover_bga_color'].';
                        color: '.$this->rps_scroll_settings['rps_hover_text_color'].';
                    }
                ';
            }else{ ?>
                #rps_scroll_page_to_top {
                    padding: 0;
                    border-radius: 0px;
                }
            <?php } ?>
            <?php
            switch ($this->rps_scroll_settings['button_position']){
                case 'bottom_right' :{
                    echo '#rps_scroll_page_to_top {bottom: 20px;right: 20px;}';
                    break;
                }
                case 'bottom_left' :{
                    echo '#rps_scroll_page_to_top {bottom: 20px;left: 20px;}';
                    break;
                }
            }
            ?>
            #rps_scroll_page_to_top{
            <?php
                if($this->rps_scroll_settings['button_position'] == 'bottom_right'){
                    echo "right: {$this->rps_scroll_settings['distance_from_left_right']}px;";
                    echo "bottom: {$this->rps_scroll_settings['distance_from_bottom']}px;";
                }else if($this->rps_scroll_settings['button_position'] == 'bottom_left'){
                    echo "left: {$this->rps_scroll_settings['distance_from_left_right']}px;";
                    echo "bottom: {$this->rps_scroll_settings['distance_from_bottom']}px;";
                }
            ?>
            }
        </style>
        <?php
    }
    public function rps_scroll_page_to_top_button_script(){
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $.scrollUp({
                    scrollName: 'rps_scroll_page_to_top',// Element ID
                    scrollDistance: <?php echo $this->rps_scroll_settings['scroll_distance']; ?>,
                    scrollFrom: 'top',           // 'top' or 'bottom'
                    scrollSpeed: <?php echo $this->rps_scroll_settings['scroll_distance']; ?>,
                    easingType: 'linear',// Scroll to top easing (see http://easings.net/)
                    animation: '<?php echo $this->rps_scroll_settings['button_animation']; ?>',// Fade, slide, none
                    animationSpeed: <?php echo $this->rps_scroll_settings['scroll_speed']; ?>,
                    scrollTrigger: false,
                    scrollTarget: false,
                    scrollText: "<?php
                        if($this->rps_scroll_settings['rps_scroll_method'] == 'your_image'){
                            echo "<img src='". esc_url($this->rps_scroll_settings['rps_icon_image_url']) ."' width='{$this->rps_scroll_settings['rps_image_width']}px' height='{$this->rps_scroll_settings['rps_image_height']}px' alt=''/>";
                        }
                        else
                            echo $this->rps_scroll_settings['rps_label_text'];
                        ?>", // Text for element, can contain HTML
                    scrollTitle: false,          // Set a custom <a> title if required.
                    scrollImg: false,            // Set true to use image
                    activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
                    zIndex: 2147483647           // Z-Index for the overlay
                });
            });
        </script>
        <?php
    }
}

require_once plugin_dir_path( __FILE__ ) .'lib/settings.class.php';
new RPS_SCROLL_PAGE_TO_TOP();
