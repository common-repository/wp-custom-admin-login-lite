<?php

if ( !class_exists( 'WCAL_Admin_Login_Template_3' ) ) {
	class WCAL_Admin_Login_Template_3 extends WCAL_Admin_Login_Core{

		/**
		 * Includes all the Admin login filters and action
		 * 
		 * @since 1.0.0
		 */
		function __construct() {
			add_filter( 'login_head', array( $this,'wcal_header'));
			add_filter( 'login_footer', array( $this,'wcal_footer'));
			add_filter( 'login_form', array( $this,'wcal_login_form'));
		}

		/*Header*/
		function wcal_header(){
			$wcal_template = !empty(get_option('wcal_template'))? sanitize_text_field(get_option('wcal_template')): 'wcal-template-1';
			$wcal_background_type = !empty(get_option('wcal_background_type'))? sanitize_text_field(get_option('wcal_background_type')): 'color';
			
			if(!($wcal_background_type == 'color' || $wcal_background_type == 'slider')){
				$this->wcal_background();	/* wcal wrapper start */
			}else{
				?>
					<div class="wcal-wrapper <?php esc_attr_e($wcal_template);?>" ><!-- wcal wrapper start -->	
				<?php
			}
			
			
			?>
			<div class="wcal-content-outer"><!-- wcal-content-outer starts -->
			<div class="wcal-content-wrapper"><!-- wcal-content-wrapper starts -->
				
				<div class="wcal-content-wrapper-inner"><!-- wcal-content-wrapper-inner starts -->
			<?php 
			$this->wcal_backto_text();
			$this->wcal_logo();
			$this->wcal_header_text();
			
		}

		/*Login Form*/
		function wcal_login_form() {
			?>
			<div class="wcal-remember-forgot-wrapper">
				<?php
				$this->wcal_remember_me();
				$this->wcal_forgot_password();
				?>
			</div>
			<?php
		}

		/*Footer*/
		function wcal_footer(){
			?>
		</div><!-- wcal-content-wrapper-inner ends -->
			<?php $this->wcal_registration(); ?> 

			</div><!-- wcal-content-wrapper end -->
		</div><!-- wcal-content-outer end -->
			<div class="wcal-footer-wrapper">
				<?php 
				$this->wcal_footer_text();
				$this->wcal_social_icons();
				?>
			</div>
			</div><!-- wcal wrapper ends -->			
			<?php
			$this->wcal_custom_css();
		}
	}
	new WCAL_Admin_Login_Template_3();
}