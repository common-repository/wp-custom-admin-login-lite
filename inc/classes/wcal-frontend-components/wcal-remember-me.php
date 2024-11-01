
<?php
$wcal_remember_me = !empty(get_option('wcal_remember_me'))? sanitize_text_field(get_option('wcal_remember_me')): '0';
if(!$wcal_remember_me){
	$wcal_remember_me_text = !empty(get_option('wcal_remember_me_text'))? sanitize_text_field(get_option('wcal_remember_me_text')): __('Remember me','wp-custom-admin-login');
	?>
	<div class="wcal-remember-me-wrapper">
		<input name="rememberme" type="checkbox" id="wcal-rememberme" value="forever">
		<label for="wcal-rememberme"><?php _e($wcal_remember_me_text);?></label>
	</div>
	<?php	
}