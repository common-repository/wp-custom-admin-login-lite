<?php
$wcal_lost_password = !empty(get_option('wcal_lost_password'))? sanitize_text_field(get_option('wcal_lost_password')): '0';
if(!$wcal_lost_password){
	$wcal_lost_password_text = !empty(get_option('wcal_lost_password_text'))? sanitize_text_field(get_option('wcal_lost_password_text')): __('Lost your password?','wp-custom-admin-login');
	$wcal_lost_password_url = site_url().'/wp-login.php?action=lostpassword';
	?>
		<div class="wcal-lost-password">
			<a href="<?php esc_attr_e($wcal_lost_password_url);?>"><?php _e($wcal_lost_password_text);?></a>
		</div>
	<?php	
}