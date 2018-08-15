<?php
/**
 * Created by RPS Team
 * User: RPS
 * Date: 8/13/2018
 * Time: 9:42 AM
 */

class SCROLL_PAGE_TO_TOP_SETTINGS
{
    private $defail_settings;
    function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_enqueue_scripts',array( $this, 'scroll_to_top_add_color_picker' ));
        $this->defail_settings = array(
            'scroll_distance' => '300',
            'scroll_speed' => '300',
            'button_animation' => 'fade',
            'button_position' => 'bottom_right',
            'distance_from_left_right' => '20',
            'distance_from_bottom' => '20',
            'rps_scroll_method' => 'simple_text',
            'rps_label_text' => 'Scroll To Top',
            'rps_bga_color' => '#555',
            'rps_hover_bga_color' => '#999',
            'rps_text_color' => '#fff',
            'rps_hover_text_color' => '#fff',
            'rps_font_size' => '18',
            'rps_button_radius' => '0',
            'rps_button_padding' => '10px 20px',
            'rps_icon_image_url' => '',
            'rps_icon_image_id' => '',
            'rps_image_width' => '50',
            'rps_image_height' => '50'
        );
        add_action( 'activated_plugin', array($this, 'add_plugin_default_settings') );
    }
    public function scroll_to_top_add_color_picker( $hook ) {
        if( is_admin() ) {
             wp_enqueue_style( 'wp-color-picker' );
             wp_enqueue_script( 'wp-color-picker' );
            if ( ! did_action( "wp_enqueue_media" ) )
                wp_enqueue_media();
        }
    }
    public function add_plugin_default_settings(){
        if(!get_option('_rps_scroll_page_to_top_settings')){
            update_option('_rps_scroll_page_to_top_settings',serialize($this->defail_settings));
        }
    }

    function admin_menu() {
        add_options_page(
            'Scroll Page To Top',
            'Scroll Page To Top',
            'manage_options',
            'scroll_page_to_top',
            array(
                $this,
                'settings_page_callback'
            )
        );
    }

    function  settings_page_callback() {
        include_once "settings.tpl.php";
    }
    public function applyActions($action,$data){
        if(empty($action)) return array('status'=>false,'msg'=>"Error occurred! Form has no action.");
        if($action == 'RPS_SCROLL_PAGE_TO_TOP_SETTINGS'){
            $_scroll_page_to_top_settings = [];
            $is_nonce_valid = ( isset( $data['_wpnonce'] ) && wp_verify_nonce( $data['_wpnonce'], $action) ) ? true : false;
            if(!$is_nonce_valid) return array('status'=>false,'msg'=>"Error occurred! Failed security check.");
            if($data['scroll_page_to_top_resetall'] && $data['scroll_page_to_top_resetall'] == "Reset All Options"){
                $data = $this->defail_settings;
            }
            $_scroll_page_to_top_settings['scroll_distance'] = $data['scroll_distance'];
            $_scroll_page_to_top_settings['scroll_speed'] = $data['scroll_speed'];
            $_scroll_page_to_top_settings['button_animation'] = $data['button_animation'];
            $_scroll_page_to_top_settings['button_position'] = $data['button_position'];
            $_scroll_page_to_top_settings['distance_from_left_right'] = $data['distance_from_left_right'];
            $_scroll_page_to_top_settings['distance_from_bottom'] = $data['distance_from_bottom'];
            $_scroll_page_to_top_settings['rps_scroll_method'] = $data['rps_scroll_method'];
            $_scroll_page_to_top_settings['rps_label_text'] = $data['rps_label_text'];
            $_scroll_page_to_top_settings['rps_bga_color'] = $data['rps_bga_color'];
            $_scroll_page_to_top_settings['rps_hover_bga_color'] = $data['rps_hover_bga_color'];
            $_scroll_page_to_top_settings['rps_text_color'] = $data['rps_text_color'];
            $_scroll_page_to_top_settings['rps_hover_text_color'] = $data['rps_hover_text_color'];
            $_scroll_page_to_top_settings['rps_font_size'] = $data['rps_font_size'];
            $_scroll_page_to_top_settings['rps_button_radius'] = $data['rps_button_radius'];
            $_scroll_page_to_top_settings['rps_button_padding'] = $data['rps_button_padding'];
            $_scroll_page_to_top_settings['rps_icon_image_url'] = $data['rps_icon_image_url'];
            $_scroll_page_to_top_settings['rps_icon_image_id'] = $data['rps_icon_image_id'];
            $_scroll_page_to_top_settings['rps_image_width'] = $data['rps_image_width'];
            $_scroll_page_to_top_settings['rps_image_height'] = $data['rps_image_height'];

            update_option('_rps_scroll_page_to_top_settings',serialize($_scroll_page_to_top_settings));
            return array('status'=>true,'msg'=>"Settings saved.");
        }
        return array('status'=>false,'msg'=>"Error occurred!");
    }
}

new SCROLL_PAGE_TO_TOP_SETTINGS();