<?php
$wcal_template = !empty(get_option('wcal_template'))? sanitize_text_field(get_option('wcal_template')): 'wcal-template-1';
$wcal_background_type = !empty(get_option('wcal_background_type'))? sanitize_text_field(get_option('wcal_background_type')): 'color';
$enable_jarallax = '';
$jarallax_attriutes = '';
if($wcal_background_type == 'image' ){
	$enable_jarallax = 'wcal-jarallax-image';
	
	$wcal_bg_image = !empty(get_option('wcal_bg_image'))? sanitize_text_field(get_option('wcal_bg_image')): '';
	$wcal_background_size = !empty(get_option('wcal_background_size'))? sanitize_text_field(get_option('wcal_background_size')): 'cover';
	$wcal_background_repeat = !empty(get_option('wcal_background_repeat'))? sanitize_text_field(get_option('wcal_background_repeat')): 'no-repeat';
	$wcal_background_position = !empty(get_option('wcal_background_position'))? sanitize_text_field(get_option('wcal_background_position')): 'center center';

	$jarallax_attriutes = 'data-imgSrc="'.$wcal_bg_image.'" ';
	$jarallax_attriutes.= 'data-imgSize="'.$wcal_background_size.'" ';
	$jarallax_attriutes.= 'data-imgRepeat="'.$wcal_background_repeat.'" ';
	$jarallax_attriutes.= 'data-imgPosition="'.$wcal_background_position.'" ';

	?>
		<div class="wcal-wrapper <?php esc_attr_e($wcal_template.' '.$enable_jarallax);?>" <?php _e($jarallax_attriutes);?>>
	<?php
}
if($wcal_background_type == 'video' ){
	$enable_jarallax = 'wcal-jarallax-video';

	$wcal_background_video_type = !empty(get_option('wcal_background_video_type'))? sanitize_text_field(get_option('wcal_background_video_type')): 'youtube';
	$wcal_disble_on_android = !empty(get_option('wcal_disble_on_android'))? sanitize_text_field(get_option('wcal_disble_on_android')): '0';
	$wcal_disble_on_ios = !empty(get_option('wcal_disble_on_ios'))? sanitize_text_field(get_option('wcal_disble_on_ios')): '0';
	$wcal_video_visible = !empty(get_option('wcal_video_visible'))? sanitize_text_field(get_option('wcal_video_visible')): '0';
	$wcal_video_mute = !empty(get_option('wcal_video_mute'))? sanitize_text_field(get_option('wcal_video_mute')): '1';
	$wcal_video_start_time = !empty(get_option('wcal_video_start_time'))? sanitize_text_field(get_option('wcal_video_start_time')): '0';
	$wcal_video_end_time = !empty(get_option('wcal_video_end_time'))? sanitize_text_field(get_option('wcal_video_end_time')): '';

	$jarallax_attriutes= 'data-mute="'.$wcal_video_mute.'" ';
	$jarallax_attriutes.= 'data-startTime="'.$wcal_video_start_time.'" ';
	if(!empty($wcal_video_end_time)){
		$jarallax_attriutes.= 'data-endTime="'.$wcal_video_end_time.'" ';
	}
	$jarallax_attriutes.= 'data-PlayOnlyVisible="'.$wcal_video_visible.'" ';
	$jarallax_attriutes.= 'data-noAndroid="'.$wcal_disble_on_android.'" ';
	$jarallax_attriutes.= 'data-noIos="'.$wcal_disble_on_ios.'" ';

	switch($wcal_background_video_type){
		case 'youtube':
		$wcal_background_video_yt_url = !empty(get_option('wcal_background_video_yt_url'))? sanitize_text_field(get_option('wcal_background_video_yt_url')): '';
		$wcal_video_source = $wcal_background_video_yt_url;
		break;
		case 'vimeo':
		$wcal_background_video_vimeo_url = !empty(get_option('wcal_background_video_vimeo_url'))? sanitize_text_field(get_option('wcal_background_video_vimeo_url')): '';
		$wcal_video_source = $wcal_background_video_vimeo_url;
		break;
		case 'custom':
		$wcal_background_video_url = !empty(get_option('wcal_background_video_url'))? sanitize_text_field(get_option('wcal_background_video_url')): '';
		$wcal_video_source = 'mp4:'.wp_get_attachment_url($wcal_background_video_url);
		break;
		default:
		$wcal_video_source = '';
	}
	$jarallax_attriutes.= 'data-video-src="'.$wcal_video_source.'"';

	?>
	<div class="wcal-wrapper <?php esc_attr_e($wcal_template.' '.$enable_jarallax);?>" <?php _e($jarallax_attriutes);?>>
	 
		<?php
	}



