<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

if ( !class_exists( 'WCAL_Admin' ) ) {

	class WCAL_Admin extends WCAL_Library {

		function __construct() {
			parent::__construct();

			add_action( 'admin_menu', array( $this, 'wcal_admin_menu' ) );
			add_action( 'admin_menu', array( $this, 'wcal_how_to' ) );
			add_filter( 'plugin_action_links_' . WCAL_BASENAME, array( $this, 'add_setting_link' ) );
		}

		function wcal_admin_menu() {
			global $submenu;

    		$menu_slug = 'wp-custom-admin-login-lite'; 
    		
    		$user = wp_get_current_user();
    		$user_id = $user->ID;

    		if(current_user_can( 'manage_options', $user_id )){
    			add_menu_page( __('WP Custom Admin Login Lite','wp-custom-admin-login-lite'), __('WP Custom Admin Login Lite','wp-custom-admin-login-lite'), 'manage_options', $menu_slug, array($this,'wcal_settings'), 'dashicons-art');
    		}
    		    		
    		$url_1 = 'admin.php?page=wp-custom-admin-login-lite';
    		$url_2 = get_admin_url().'customize.php?url='.wp_login_url(); 
    		

    		$submenu[$menu_slug][] = array('General Settings', 'manage_options', $url_1);
    		$submenu[$menu_slug][] = array('Start Customizing', 'manage_options', $url_2);
    		
		}

		function wcal_how_to(){
			add_submenu_page(
					'wp-custom-admin-login-lite', 
					__( 'How to use', 'ultimate-author-box' ), 
					__( 'How to use', 'ultimate-author-box' ), 
					'manage_options', 
					'wcal-how-to', 
					array( $this, 'wcal_how_to_page' ) );
		}

		function wcal_how_to_page(){
			include WCAL_PATH . 'inc/classes/admin/wcal-how-to.php';
		}

		function wcal_settings() {
			include(WCAL_PATH . 'inc/views/backend/wcal-settings.php');
		}

		function no_permission() {
			die( 'No script kiddies please!!' );
		}

		function add_setting_link( $links ) {
			$settings_link = array(
				'<a href="' . admin_url( 'admin.php?page=wp-custom-admin-login-lite' ) . '">' . __( 'Settings', WCAL_TD ) . '</a>',
			);
			return array_merge( $links, $settings_link );
		}

	}

	new WCAL_Admin();
}
