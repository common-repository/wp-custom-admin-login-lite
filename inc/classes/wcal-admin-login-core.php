<?php

if ( !class_exists( 'WCAL_Admin_Login_Core' ) ) {
	class WCAL_Admin_Login_Core extends WCAL_Library{

		/**
		 * Includes all the Admin login filters and action
		 * 
		 * @since 1.0.0
		 */
		function __construct() {
			add_filter( 'login_enqueue_scripts', array( $this,'wcal_login_enqueue_scripts'));
		}

		/*Enqueue Scripts*/
		function wcal_login_enqueue_scripts(){
			/*Login Page style script*/
			wp_enqueue_style('wcal-custom-login', WCAL_CSS_DIR. '/wcal-style-login.css','1.0.1' );
			wp_enqueue_style( 'wcal-font-awesome-style', WCAL_CSS_DIR . '/font-awesome.min.css', array(), '4.7.0');

			wp_enqueue_script( 'wcal-frontend', WCAL_JS_DIR . '/wcal-style-login.js', array( 'jquery','customize-preview','wcal-jarallax-js'), WCAL_VERSION );
			/*Jarallax*/
			wp_enqueue_style('wcal-jarallax-css', WCAL_CSS_DIR. '/jarallax.css' );
			wp_enqueue_script( 'wcal-jarallax-js', WCAL_JS_DIR . '/jarallax.js', array( 'jquery' ), '1.9.0' );
			wp_enqueue_script( 'wcal-jarallax-video-js', WCAL_JS_DIR . '/jarallax-video.min.js', array( 'jquery','wcal-jarallax-js' ), '1.9.0' );


			$wcal_template = !empty(get_option('wcal_template'))? sanitize_text_field(get_option('wcal_template')): 'wcal-template-1';

			wp_localize_script('wcal-frontend','wcal_js_obj',array(
				'wcal_ajax_url' => admin_url('admin-ajax.php'),
				'wcal_wpnonce'=>wp_create_nonce('wcal_wpnonce'),
				'wcal_template' => $wcal_template
			));

			$wcal_form_font = !empty(get_option('wcal_form_font'))? sanitize_text_field(get_option('wcal_form_font')): '';
			if(!empty($wcal_form_font)){
				$wcal_form_font1 = preg_replace('/\s+/', '+', $wcal_form_font);	
				wp_enqueue_style( 'wcal-google-fonts', '//fonts.googleapis.com/css?family='.$wcal_form_font1 );
			}
			wp_enqueue_style( 'wcal-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Rubik:300,300i,400,400i,500,500i,700,700i,900,900i|Roboto+Slab:100,300,400,700|Ubuntu:300,300i,400,400i,500,500i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Oxygen:300,400,700|Slabo+27px|Fira+Sans:300,400|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Cabin:400,400i,500,500i,600,600i,700,700i|Abel|Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i|Oswald:200,300,400,500,600,700|PT+Serif:400,400i,700,700i' );
		}

		/*Background Image / Video*/
		function wcal_background(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-background.php';
		}

		/*Additional Content*/
		function wcal_additional_content(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-additional-content.php';
		}

		/*Logo*/
		function wcal_logo(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-logo.php';	
		}

		/*Header Text*/
		function wcal_header_text(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-header-text.php';		
		}

		/*Forgot Password*/
		function wcal_forgot_password(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-forgot-password.php';			
		}

		/*Remember me*/
		function wcal_remember_me(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-remember-me.php';			
		}

		/*Registration*/
		function wcal_registration(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-registration.php';				
		}

		/*Backto Text*/
		function wcal_backto_text(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-backto-text.php';				
		}

		/*Footer Text*/
		function wcal_footer_text(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-footer-text.php';				
		}

		/*Social Icons*/
		function wcal_social_icons(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-social-icons.php';					
		}

		/*Custom CSS*/
		function wcal_custom_css(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-custom-css.php';						
		}
		/*Customizer CSS*/
		function wcal_customizer_css(){
			include WCAL_PATH . 'inc/classes/wcal-frontend-components/wcal-customizer-css.php';						
		}
	}
	new WCAL_Admin_Login_Core();
}