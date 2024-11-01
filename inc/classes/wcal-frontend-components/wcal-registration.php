<?php
$wcal_users_can_register = !empty(get_option('users_can_register'))? sanitize_text_field(get_option('users_can_register')): '0';

if($wcal_users_can_register){
	$wcal_registration_text = !empty(get_option('wcal_registration_text'))? wp_kses_post(get_option('wcal_registration_text')): '';
	$wcal_registration_link_text = !empty(get_option('wcal_registration_link_text'))? sanitize_text_field(get_option('wcal_registration_link_text')): __('Register','wp-custom-admin-login');
	$wcal_registration_url = !empty(get_option('wcal_registration_url'))? sanitize_text_field(get_option('wcal_registration_url')): site_url().'/wp-login.php?action=register';
	?>
	<div class="wcal-registration-wrapper">
		<?php 
			if(isset($_GET) && isset($_GET['action']) && $_GET['action'] === 'register'){
				
					?>
					<div class="wcal-registration-text">
						<?php _e($wcal_registration_text);?>
					</div>
					<div class="wcal-registration-link">
						<a href="<?php _e(get_admin_url());?>"><?php _e('Sign in');?></a>	
					</div>
					<?php
				
			}else{
				?>
					<div class="wcal-registration-text">
						<?php _e($wcal_registration_text);?>
					</div>
					<div class="wcal-registration-link">
						<a href="<?php esc_attr_e($wcal_registration_url);?>"><?php _e($wcal_registration_link_text);?></a>	
					</div>
				<?php

			}
		?>
	</div>
	<?php	

}