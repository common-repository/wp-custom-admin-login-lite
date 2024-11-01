<?php
$wcal_hide_logo = !empty(get_option('wcal_hide_logo'))? sanitize_text_field(get_option('wcal_hide_logo')): '0';

if(!$wcal_hide_logo){
	$wcal_logo_image = !empty(get_option('wcal_logo_image'))? sanitize_text_field(get_option('wcal_logo_image')): site_url(). '/wp-admin/images/w-logo-blue.png';
	$wcal_logo_url = !empty(get_option('wcal_logo_url'))? sanitize_text_field(get_option('wcal_logo_url')): site_url();
	$wcal_logo_title = !empty(get_option('wcal_logo_title'))? sanitize_text_field(get_option('wcal_logo_title')): get_bloginfo('name');
	?>
		<div class="wcal-logo">
			<a href="<?php esc_attr_e($wcal_logo_url); ?>" title="<?php esc_attr_e($wcal_logo_title); ?>"><img src="<?php esc_attr_e($wcal_logo_image);?>" alt="<?php esc_attr_e($wcal_logo_title); ?>"/></a>	
		</div>
	<?php	
}

