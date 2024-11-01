<?php

if ( !class_exists( 'WCAL_Admin_Login_Template_1' ) ) {
	class WCAL_Admin_Login_Template_1 extends WCAL_Admin_Login_Core{

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
			<div class="wcal-content-wrapper"><!-- wcal-content-wrapper start -->	
			<div class="wcal-content-1">
			<?php $this->wcal_additional_content();?>
			</div>
			<div class="wcal-content-2"><!-- wcal-content-2 start -->	
			<div class="wcal-login-form-wrapper"><!-- wcal-login-form-wrapper start -->	
			<?php 
			$this->wcal_logo();
			$this->wcal_header_text();
		}

		/*Login Form*/
		function wcal_login_form() {
			$this->wcal_remember_me();
			?>
			<div class="wcal-login-forgot-wrapper"><!-- wcal-login-forgot-wrapper start -->	
				<?php
			$this->wcal_forgot_password();
			
		}

		/*Footer*/
		function wcal_footer(){
			$this->wcal_registration();?>
			</div><!-- wcal-login-form-wrapper ends -->
			<?php if(isset($_GET['action']) && ($_GET['action'] != 'register' || $_GET['action'] != 'lostpassword')):?>
			<?php else:?>
			</div><!-- wcal-content-2 ends -->	
			<?php endif;?>	
			
			<?php $this->wcal_backto_text();?>
			</div><!-- wcal-content-wrapper ends -->		
			</div><!--I'm here-->
			<div class="wcal-footer-wrapper">
				<?php 
				$this->wcal_footer_text();
				$this->wcal_social_icons();
				?>
			</div>

			
			<!-- wcal wrapper ends -->			
			<?php
			$this->wcal_custom_css();
			$this->wcal_customizer_css();
		}
	}
	new WCAL_Admin_Login_Template_1();
}