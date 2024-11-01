<?php
$wcal_social_icons_raw = !empty(get_option('wcal_social_icons'))? (get_option('wcal_social_icons')): array();
if(!empty($wcal_social_icons_raw)){
	$wcal_social_icons = json_decode($wcal_social_icons_raw);
	?>
	<div class="wcal-social-icons">
		<div class="wcal-social-icons-list-wrapper">
			<?php
			foreach($wcal_social_icons as $wcal_social_icon){
				$wcal_icon = $wcal_social_icon->wcal_social_icon;
				$wcal_social_url = $wcal_social_icon->wcal_social_url;
				$wcal_social_tooltip = $wcal_social_icon->wcal_social_tooltip;
				if(!empty($wcal_social_url)){
					?>
					<div class="wcal-social-icons-list-item"><a href="<?php _e($wcal_social_url);?>" target="_blank">
						<i class="wcal-social-icons <?php _e($wcal_icon);?>"></i>
						<?php 
							if(!empty($wcal_social_tooltip)){
								?>
								<div class="wcal-social-tooltip"><?php _e($wcal_social_tooltip);?></div>
								<?php
							}
						?>
						</a>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<?php
}