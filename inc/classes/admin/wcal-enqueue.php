<?php

if ( !class_exists( 'WCAL_Enqueue' ) ) {

	class WCAL_Enqueue {

		function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'register_backend_assets' ) );
		}

		function register_frontend_assets( ) {
			
		}

		function register_backend_assets( ) {
			wp_enqueue_style( 'wcal-font-awesome-style', WCAL_CSS_DIR . '/font-awesome.min.css', array(), '4.7.0');
			wp_enqueue_style( 'wcal-admin-css', WCAL_CSS_DIR . '/wcal-backend.css', array(), WCAL_VERSION );
		}

	}

	new WCAL_Enqueue();
}