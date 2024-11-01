<?php
$wcal_header_title = !empty(get_option('wcal_header_title'))? sanitize_text_field(get_option('wcal_header_title')): '';
$wcal_header_description = !empty(get_option('wcal_header_description'))? sanitize_text_field(get_option('wcal_header_description')): '';
if(!empty($wcal_header_title) || !empty($wcal_header_description)){
?>
	<div class="wcal-header-text-wrapper">
		<div class="wcal-header-text"><?php _e($wcal_header_title);?></div>
		<div class="wcal-header-description"><?php _e(do_shortcode($wcal_header_description));?></div>
	</div>
<?php
}


