<?php
/*Created on 8th October 2017*/
defined( 'ABSPATH' ) or die( 'No script kiddies please' );

/*
  Plugin Name: WP Custom Admin Login Lite - Free WordPress plugin to make a customized admin login page
  Description: A plugin to add unlimited customization to your admin login page.
  Version:     1.0.1
  Author:      8Degree Themes
  Author URI:  http://8degreethemes.com
  License:     GPL2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages
  Text Domain: wp-custom-admin-login-lite
 */

  if ( !class_exists( 'WP_Custom_Admin_Login_Lite' ) ) {
    class WP_Custom_Admin_Login_Lite {
      function __construct() {
        $this->define_constants();
        $this->includes();
      }

    function define_constants() {
      defined( 'WCAL_PATH' ) or define( 'WCAL_PATH', plugin_dir_path( __FILE__ ) );
      defined( 'WCAL_IMG_DIR' ) or define( 'WCAL_IMG_DIR', plugin_dir_url( __FILE__ ) . 'images' );
      defined( 'WCAL_CSS_DIR' ) or define( 'WCAL_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' );
      defined( 'WCAL_JS_DIR' ) or define( 'WCAL_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );
      defined( 'WCAL_VERSION' ) or define( 'WCAL_VERSION', '1.0.1' );
      defined( 'WCAL_TD' ) or define( 'WCAL_TD', 'wp-custom-admin-login-lite' );
      defined( 'WCAL_BASENAME' ) or define( 'WCAL_BASENAME', plugin_basename( __FILE__ ) );
    }

    function includes() {
      if ( !session_id() && !headers_sent() ) {
        session_start();
      }
      require_once WCAL_PATH . 'inc/classes/admin/wcal-init.php';
      require_once WCAL_PATH . 'inc/classes/admin/wcal-library.php';
      require_once WCAL_PATH . 'inc/classes/admin/wcal-enqueue.php';
      require_once WCAL_PATH . 'inc/classes/admin/wcal-admin.php';
      require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
      require_once WCAL_PATH . 'inc/classes/wcal-customizer.php';
      require_once WCAL_PATH . 'inc/classes/customizer-class/wcal-customizer-tabs/init.php';
      
      /*Check if Plugin is active*/
      $wcal_enable_plugin = !empty(get_option('wcal_enable_plugin'))? sanitize_text_field(get_option('wcal_enable_plugin')): '0';
      if($wcal_enable_plugin != '1'){
        require_once WCAL_PATH . 'inc/classes/wcal-admin-login-core.php';

        /*Get selected Template Value*/
        $wcal_template = !empty(get_option('wcal_template'))? sanitize_text_field(get_option('wcal_template')): 'wcal-template-1';

        if( $wcal_template == 'wcal-template-1' || $wcal_template == 'wcal-template-2' || $wcal_template == 'wcal-template-3' || $wcal_template == 'wcal-template-4' || $wcal_template == 'wcal-template-5' ){
          /*Call Admin Overwrite Class according to template*/
          require_once WCAL_PATH . 'inc/classes/wcal-templates/'.$wcal_template.'.php';  
        }
        

      }
    }

  }
  $wcal_object = new WP_Custom_Admin_Login_Lite();
}