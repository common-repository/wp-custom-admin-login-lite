<?php
	$wcal_additonal_text = !empty(get_option('wcal_additonal_text'))? (wp_kses_post(get_option('wcal_additonal_text'))): '';
?>
<div class="wcal-additional-content">
	<?php _e($wcal_additonal_text);?>
</div>
