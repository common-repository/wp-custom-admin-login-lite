<?php
/**
 * Tabs test file
 *
 * @package WP Custom Admin Login
 * @since 1.0.0
 */

/**
 * Hook controls for Header to Customizer.
 *
 * @since 1.0.0
 */
function wcal_tabs_customize_register( $wp_customize ) {

	if ( class_exists( 'WCAL_Customize_Control_Tabs' ) ) {

        		
        /**
        * Social Login section Tabs
        *
        */
        $wp_customize->add_setting( 'wcal_social_login_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 
            new WCAL_Customize_Control_Tabs( 
                $wp_customize, 'wcal_social_login_tab', array(
                    'section' => 'wcal_social_login',
                    'tabs'    => array(

                        'general' => array(
                            'nicename' => esc_html__( 'General', 'wp-custom-admin-login' ),
                            'icon'     => 'cogs',
                            'controls' => array(
                                'wcal_social_desc',
                                'wcal_social_header',
                                'wcal_social_or'
                            ),
                        ),

                        'facebook' => array(
                            'nicename' => esc_html__( 'Facebook', 'wp-custom-admin-login' ),
                            'icon'     => 'facebook',
                            'controls' => array(
                                'wcal_social_heading_facebook',
                                'wcal_fb_desc',
                                'wcal_enable_facebook_login',
                                'wcal_facebook_app_id',
                                'wcal_facebook_app_secret',
                                'wcal_facebook_label',

                            ),
                        ),
                        'twitter' => array(
                            'nicename' => esc_html__( 'Twitter', 'wp-custom-admin-login' ),
                            'icon'     => 'twitter',
                            'controls' => array(
                                'wcal_twitter_desc',
                                'wcal_social_heading_twitter',
                                'wcal_enable_twitter_login',
                                'wcal_twitter_app_id',
                                'wcal_twitter_app_secret',
                                'wcal_twitter_label',
                            ),
                        ),
                        'google' => array(
                            'nicename' => esc_html__( 'Google', 'wp-custom-admin-login' ),
                            'icon'     => 'google',
                            'controls' => array(
                                'wcal_google_desc',
                                'wcal_social_heading_google',
                                'wcal_enable_google_login',
                                'wcal_google_app_id',
                                'wcal_google_app_secret',
                                'wcal_google_label',
                            ),
                        ),
                    ),
                )
            )
        );	


        /**
        * Login form section Tabs
        *
        */
        $wp_customize->add_setting( 'wcal_login_form_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 
            new WCAL_Customize_Control_Tabs( 
                $wp_customize, 'wcal_login_form_tab', array(
                    'section' => 'wcal_login_section',
                    'tabs'    => array(

                        'general' => array(
                            'nicename' => esc_html__( 'General', 'wp-custom-admin-login' ),
                            'icon'     => 'cogs',
                            'controls' => array(
                                'wcal_lost_password_section',
                                'wcal_lost_password_text',
                                'wcal_remember_me_section',
                                'wcal_remember_me_text',
                                'wcal_registration_section',
                                'wcal_registration_text',
                                'wcal_registration_link_text',
                                'wcal_registration_url',
                                'wcal_backto_section',
                                'wcal_backto_text',
                                'wcal_backto_url',
                            ),
                        ),
                        'design' => array(
                            'nicename' => esc_html__( 'Design', 'wp-custom-admin-login' ),
                            'icon'     => 'paint-brush',
                            'controls' => array(
                                'wcal_form_customize',
                                'wcal_form_typography',
                                'wcal_form_font',
                                'wcal_form_text_align',
                                'wcal_form_font_style',
                                'wcal_form_text_transform',
                                'wcal_form_background_section',
                                'wcal_form_background_type',
                                'wcal_login_bg_color',
                                'wcal_login_image',
                                'wcal_form_background_size',
                                'wcal_form_background_repeat',
                                'wcal_form_background_position',
                                'wcal_login_label_color',
                                'form_field_title',
                                'wcal_login_field_bg_color',
                                'wcal_login_field_color',
                                'wcal_field_border',
                                'wcal_text_colors',
                                'wcal_header_color',
                                'wcal_tagline_color',
                                'wcal_label_color',
                                'wcal_remember_color',
                                'wcal_forgot_color',
                                'wcal_button_text_color',
                                'wcal_register_color',
                                'wcal_back_color',
                                'wcal_social_header_color',
                                'wcal_or_color',
                                'wcal_footer_text_color',

                            ),
                        )
                    ),
                )
            )
        );
        

        /**
        * Templates section Tabs
        *
        */
        $wp_customize->add_setting( 'wcal_template_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 
            new WCAL_Customize_Control_Tabs( 
                $wp_customize, 'wcal_template_tab', array(
                    'section' => 'wcal_template_section',
                    'tabs'    => array(

                        'templates' => array(
                            'nicename' => esc_html__( 'Templates', 'wp-custom-admin-login' ),
                            'icon'     => 'cogs',
                            'controls' => array(
                                'wcal_template',
                            ),
                        ),
                        'design' => array(
                            'nicename' => esc_html__( 'Design', 'wp-custom-admin-login' ),
                            'icon'     => 'paint-brush',
                            'controls' => array(
                                'wcal_customize_template',
                                'wcal_template_color',
                                'wcal_primary_color',
                                'wcal_secondary_color',
                                'wcal_tertiary_color',
                                'wcal_social_color',
                                'wcal_social_icon_color',
                                'wcal_tooltip_bg_color',
                                'wcal_tooltip_color',
                                'wcal_background_section',
                                'wcal_background_type',
                                'wcal_background_color',
                                'wcal_bg_image',
                                'wcal_background_size',
                                'wcal_background_repeat',
                                'wcal_background_position',
                                'wcal_image_overlay',
                                'wcal_image_overlay_color',
                                'wcal_background_video_type',
                                'wcal_background_video_yt_url',
                                'wcal_background_video_vimeo_url',
                                'wcal_background_video_url',
                                'wcal_disble_on_android',
                                'wcal_disble_on_ios',
                                'wcal_video_visible',
                                'wcal_video_mute',
                                'wcal_video_start_time',
                                'wcal_video_end_time',
                            ),
                        ),
                    ),
                )
            )
        );
        

        /**
        * Header section Tabs
        *
        */
        $wp_customize->add_setting( 'wcal_header_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 
            new WCAL_Customize_Control_Tabs( 
                $wp_customize, 'wcal_header_tab', array(
                    'section' => 'wcal_header_section',
                    'tabs'    => array(

                        'text' => array(
                            'nicename' => esc_html__( 'Text', 'wp-custom-admin-login' ),
                            'icon'     => 'font',
                            'controls' => array(
                                'wcal_header_title',
                                'wcal_header_description',
                            ),
                        ),
                        'logo' => array(
                            'nicename' => esc_html__( 'Logo', 'wp-custom-admin-login' ),
                            'icon'     => 'image',
                            'controls' => array(
                                'wcal_hide_logo',
                                'wcal_logo_image',
                                'wcal_logo_url',
                                'wcal_logo_title',
                            ),
                        ),
                    ),
                )
            )
        );

        /**
        * Footer section Tabs
        *
        */
        $wp_customize->add_setting( 'wcal_footer_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 
            new WCAL_Customize_Control_Tabs( 
                $wp_customize, 'wcal_footer_tab', array(
                    'section' => 'wcal_footer_section',
                    'tabs'    => array(

                        'text' => array(
                            'nicename' => esc_html__( 'Text', 'wp-custom-admin-login' ),
                            'icon'     => 'font',
                            'controls' => array(
                                'wcal_footer_text',
                            ),
                        ),
                        'social' => array(
                            'nicename' => esc_html__( 'Social Icons', 'wp-custom-admin-login' ),
                            'icon'     => 'image',
                            'controls' => array(
                                'wcal_social_icons',
                            ),
                        ),
                    ),
                )
            )
        );

	}

}
add_action( 'customize_register', 'wcal_tabs_customize_register' );
