<?php
$wcal_back_to = !empty(get_option('wcal_back_to'))? sanitize_text_field(get_option('wcal_back_to')): '0';
$wcal_template = !empty(get_option('wcal_template'))? sanitize_text_field(get_option('wcal_template')): 'wcal-template-1';
if(!$wcal_back_to){
	$wcal_backto_text = !empty(get_option('wcal_backto_text'))? sanitize_text_field(get_option('wcal_backto_text')): __('Back to ', 'wp-custom-admin-login').get_bloginfo('name');
	$wcal_backto_url = !empty(get_option('wcal_backto_url'))? sanitize_text_field(get_option('wcal_backto_url')): site_url();
	?>
	<div class="wcal-backto-wrapper">
		<div class="wcal-backto-link">
			<?php if(!($wcal_template == 'wcal-template-3' || $wcal_template == 'wcal-template-6') ):?>
				<i class="dashicons dashicons-arrow-left-alt"></i><a href="<?php esc_attr_e($wcal_backto_url);?>"><?php _e($wcal_backto_text);?></a>
			<?php endif;?>
			<?php if($wcal_template == 'wcal-template-3' || $wcal_template == 'wcal-template-6'):?>
				<a href="<?php esc_attr_e($wcal_backto_url);?>">
					<div class="wcal-cancel-img">
						<img src="<?php esc_attr_e(WCAL_IMG_DIR.'/template-3/cancel1.png');?>" title="<?php _e($wcal_backto_text);?>">
					</div>
				</a>
			<?php endif;?>
		</div>
	</div>
<?php	
}