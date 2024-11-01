<?php
	$wcal_customizer_css = !empty(get_option('wcal_css_editor'))? wp_kses_post(get_option('wcal_css_editor')): '';
	if(!empty($wcal_customizer_css)){
		?>
		<style class="wcal-customizer-css">
			<?php
				_e($wcal_customizer_css);
			?>
		</style>
		<?php	
	}
