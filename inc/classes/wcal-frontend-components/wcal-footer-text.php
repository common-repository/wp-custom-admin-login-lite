<?php
$wcal_footer_text = !empty(get_option('wcal_footer_text'))? wp_kses_post(get_option('wcal_footer_text')): '';

if(!empty($wcal_footer_text)){
	?>
	<div class="wcal-footer-text">
		<?php _e($wcal_footer_text);?>
	</div>
	<?php	
}