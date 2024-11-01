<?php
if ( !class_exists( 'WCAL_Customizer' ) ) {

	class WCAL_Customizer extends WP_Customize_Control{

		/**
		 * Includes all the Cuztomizer settings
		 * 
		 * @since 1.0.0
		 */
		function __construct() {
			add_action('customize_register', array( $this, 'wcal_customize_register'));	
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'wcal_customize_control_js') );						
		}
		function wcal_customize_control_js() {
			wp_enqueue_style( 'wcal-font-awesome-style', WCAL_CSS_DIR . '/font-awesome.min.css', array(), '4.7.0');
			wp_enqueue_style( 'wcal-admin-css', WCAL_CSS_DIR . '/wcal-customize-control.css', array(), WCAL_VERSION );
			wp_enqueue_media();
			wp_enqueue_script( 'wcal-repeater-script', WCAL_JS_DIR . '/repeater-script.js',array( 'jquery','jquery-ui-sortable'));
			wp_enqueue_style('wcal-repeater-style', WCAL_CSS_DIR . '/repeater-style.css');
			wp_enqueue_script( 'wcal-wp-editor', WCAL_JS_DIR . '/wcal-wp-editor.js',array( 'jquery'));
			wp_enqueue_script( 'wcal_customizer_control', WCAL_JS_DIR . '/wcal-customize-controls.js', array( 'customize-controls', 'jquery', 'wp-color-picker'), null, true );
		}

		function wcal_customize_preview_js(){
			wp_enqueue_script( 'wcal_customizer_preview', WCAL_JS_DIR . '/wcal-customize-preview.js', array('jquery','customize-preview'), null, true);

		}

		/*sanitization callbacks*/
		function wcal_checkbox_sanitize($input) {
			if ( $input == 1 ) {
				return true;
			} else {

				return false;
			}
		}

		function wcal_number_sanitize( $int ) {
			return absint( $int );
		}

		function wcal_text_sanitize( $input ) {
			return wp_kses_post( force_balance_tags( $input ) );
		}
		function wcal_radio_sanitize_background_type($input) {
			$valid_keys = array(
				'color'  => 'Color',  
				'image'  => 'Image', 
				/*'slider' => 'Slider',*/
				'video'  => 'Video',
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_text_align($input) {
			$valid_keys = array(
				'left'  => 'Left',  
				'right'  => 'Right', 
				'center' => 'Center',
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_font_style($input) {
			$valid_keys = array(
				'normal'  => 'Normal',  
				'italic'  => 'Italic', 
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_text_transform($input) {
			$valid_keys = array(
				'none'   => 'None',
				'capitalize'  => 'Capitalize',  
				'uppercase'   => 'Uppercase',
				'lowercase'  => 'Lowercase',  
				'initial'   => 'Initial',
				'inherit'  => 'Inherit', 
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_background_size($input) {
			$valid_keys = array(
				'cover'   => 'Cover',  
				'contain' => 'Contain', 
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_background_repeat($input) {
			$valid_keys = array(
				'repeat'    => 'Repeat',  
				'repeat-x'  => 'Repeat-x', 
				'repeat-y'  => 'Repeat-y',
				'no-repeat' => 'No-repeat',	
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_background_position($input) {
			$valid_keys = array(
				'left top'      => 'left top',  
				'left center'   => 'left center', 
				'left bottom'   => 'left bottom',
				'right top'     => 'right top',	
				'right center'  => 'right center',  
				'right bottom'  => 'right bottom', 
				'center top'    => 'center top',
				'center center' => 'center center',	
				'center bottom' => 'center bottom',	
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_background_video_type($input) {
			$valid_keys = array(
				'youtube' => 'Youtube',  
				'vimeo'   => 'Vimeo', 
				'custom'  => 'Custom',
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}
		function wcal_radio_sanitize_login_type($input) {
			$valid_keys = array(
				'username-email' => 'Username or Email',  
				'username'       => 'Username only', 
				'email'          => 'Email only',
			);
			if ( array_key_exists( $input, $valid_keys ) ) {
				return $input;
			} else {
				return '';
			}
		}

		/*Repeater Sanitization Callback*/
		function wcal_sanitize_repeater($input){      
			$input_decoded = json_decode( $input, true );
			$allowed_html = array(
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'a'      => array(
					'href'   => array(),
					'class'  => array(),
					'id'     => array(),
					'target' => array()
				),
				'button' => array(
					'class' => array(),
					'id'    => array()
				)
			);    

			if(!empty($input_decoded)) {
				foreach ($input_decoded as $boxes => $box ){
					foreach ($box as $key => $value){
						$input_decoded[$boxes][$key] = sanitize_text_field( $value );
					}
				}
				return json_encode($input_decoded);
			}    
			return $input;
		}

		/*End of sanitization callbacks*/

		/*Active Callbacks*/
		/*Show hide background option*/
		function wcal_bg_option_color(){
			$wcal_bg_option = get_option('wcal_background_type','color');
			if($wcal_bg_option == 'color'){
				return true;
			}
			else{
				return false;
			}

		}

		/*Hide logo settings*/
		function wcal_hide_logo_settings(){
			$wcal_hide_logo = get_option('wcal_hide_logo');

			if($wcal_hide_logo == 1){
				return false;
			}else{
				return true;
			}
		}
		
		/*Register Customize options*/

		function wcal_customize_register($wp_customize){
			/*Inlcude the Alpha Color Picker control file.*/
			require_once WCAL_PATH . 'inc/classes/customizer-class/alpha-color-picker.php';
			require_once WCAL_PATH . 'inc/classes/customizer-class/wcal-repeater-class.php';
			require_once WCAL_PATH . 'inc/classes/customizer-class/google-font-dropdown-custom-control.php';
			require_once WCAL_PATH . 'inc/classes/customizer-class/wcal-header-control-class.php';
			require_once WCAL_PATH . 'inc/classes/customizer-class/text-editor-custom-control.php';
			require_once WCAL_PATH . 'inc/classes/customizer-class/textarea-custom-control.php';
			require_once WCAL_PATH . 'inc/classes/customizer-class/wcal-radio-image.php';
			

			$wp_customize->add_panel( 'wcal_panel', array(
				'priority'    => '10',
				'capability'  => 'edit_theme_options',
				'title'       => esc_html__('WP Custom Admin Login Lite', 'wp-custom-admin-login-lite'),
				'description' => __('This section allows you to customize the login page of your website.', 'wp-custom-admin-login-lite'),
			));

			/*Enable Plugin*/
			$wp_customize->add_section('wcal_activate_section', array(
				'title' => esc_html__('Enable Plugin', 'wp-custom-admin-login-lite'),
				'panel' => 'wcal_panel',
			));

			$wp_customize->add_setting( 'wcal_enable_plugin', array(
				'type'              => 'option',
				'capability'        => 'manage_options',
				'default'           => 0,
				'sanitize_callback' => array( $this, 'wcal_checkbox_sanitize'),
			));

			$wp_customize->add_control( 'wcal_enable_plugin', array(
				'type'        => 'checkbox',
				'section'     => 'wcal_activate_section',
				'label'       => __( 'Disable WP Custom Admin Login','wp-custom-admin-login-lite' ),
				'description' => __( 'Save setting and refresh to see changes','wp-custom-admin-login-lite' )
			));

			/*Select Template*/
			$wp_customize->add_section('wcal_template_section', array(
				'title' => __('Select Template', 'wp-custom-admin-login-lite'),
				'panel' => 'wcal_panel',
			));

			$wp_customize->add_setting(
				'wcal_template', array(
					'default'           => 'wcal-template-1',
					'type'              => 'option',
					'sanitize_callback' => 'esc_attr'
				));
			$imagepath =  WCAL_IMG_DIR . '/customize-images/';
			$wp_customize->add_control( new WCAL_Customize_Radioimage_Control(
				$wp_customize,
				'wcal_template',
				array(
					'section' =>      'wcal_template_section',
					'label'   =>      __('Admin Page Templates', 'wp-custom-admin-login-lite'),
					'type'    =>      'radioimage',
					'choices' =>      array(
						'wcal-template-1' => $imagepath.'wcal-template-1.png',
						'wcal-template-2' => $imagepath.'wcal-template-2.png',
						'wcal-template-3' => $imagepath.'wcal-template-3.png',
						'wcal-template-4' => $imagepath.'wcal-template-4.png',
						'wcal-template-5' => $imagepath.'wcal-template-5.png'
					)
				)
			));

				/*Header Section*/
				$wp_customize->add_section('wcal_header_section', array(
					'title' => __('Header Section', 'wp-custom-admin-login-lite'),
					'panel' => 'wcal_panel',
				));

				$wp_customize->add_setting( 'wcal_header_title', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => get_bloginfo('name'),
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control( 'wcal_header_title', array(
					'type'    => 'text',
					'section' => 'wcal_header_section',
					'label'   => __( 'Header Title','wp-custom-admin-login-lite' )
				));

		        // Add a textarea control
		        $wp_customize->add_setting( 'wcal_header_description', array(
					'default' => get_bloginfo( 'description' ),
					'type'    => 'option',
		        ) );
		        $wp_customize->add_control( new WCAL_Textarea_Custom_Control( $wp_customize, 'wcal_header_description', array(
		            'label'   => 'Header Description',
		            'section' => 'wcal_header_section',
		        ) ) );

			/*Display settings*/
			$wp_customize->add_section('wcal_display_section', array(
				'title' => __('Display Options', 'wp-custom-admin-login-lite'),
				'panel' => 'wcal_panel',
			));

			$wp_customize->add_setting( 'wcal_social_desc_register', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

			$wp_customize->add_control( new WCAL_Header_Control(
				$wp_customize,
				'wcal_social_desc_register',
				array(
					'section'     => 'wcal_display_section',
					'settings'    => 'wcal_social_desc_register',
					'input_attrs' => array(
						'desc' => __('Click ','wp-custom-admin-login-lite').'<a href='.admin_url( 'options-general.php' ).'>'.__('here','wp-custom-admin-login-lite').'</a>'.__(' to change Membership option','wp-custom-admin-login-lite'),

					)
				)
			));

			$wp_customize->add_setting( 'wcal_lost_password', array(
				'type'              => 'option',
				'capability'        => 'manage_options',
				'sanitize_callback' => array( $this, 'wcal_checkbox_sanitize'),
			));

			$wp_customize->add_control( 'wcal_lost_password', array(
				'type'    => 'checkbox',
				'section' => 'wcal_display_section',
				'label'   => __( 'Hide Lost Password','wp-custom-admin-login-lite' )
			));

			$wp_customize->add_setting( 'wcal_remember_me', array(
				'type'              => 'option',
				'capability'        => 'manage_options',
				'sanitize_callback' => array( $this, 'wcal_checkbox_sanitize'),
			));

			$wp_customize->add_control( 'wcal_remember_me', array(
				'type'    => 'checkbox',
				'section' => 'wcal_display_section',
				'label'   => __( 'Hide Remember me','wp-custom-admin-login-lite' )
			));

			$wp_customize->add_setting( 'wcal_back_to', array(
				'type'              => 'option',
				'capability'        => 'manage_options',
				'sanitize_callback' => array( $this, 'wcal_checkbox_sanitize'),
			));

			$wp_customize->add_control( 'wcal_back_to', array(
				'type'    => 'checkbox',
				'section' => 'wcal_display_section',
				'label'   => __( 'Hide Back to option','wp-custom-admin-login-lite' )
			));

			/*Logo Settings*/
			$wp_customize->add_setting( 'wcal_hide_logo', array(
				'type'              => 'option',
				'capability'        => 'manage_options',
				'sanitize_callback' => array($this, 'wcal_checkbox_sanitize'),
			));

			$wp_customize->add_control( 'wcal_hide_logo', array(
				'type'    => 'checkbox',
				'section' => 'wcal_header_section',
				'label'   => __( 'Hide Logo','wp-custom-admin-login-lite' )
			));

				$wp_customize->add_setting( 'wcal_logo_image', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'sanitize_callback' => 'sanitize_text_field'
				));

				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wcal_logo_image', array(
					'label'           => __( 'Set Logo', 'wp-custom-admin-login-lite' ),
					'section'         => 'wcal_header_section',
				) ) );			

				$wp_customize->add_setting( 'wcal_logo_url', array(
					'type'              => 'option',
					'default'           => home_url(),
					'capability'        => 'manage_options',
					'sanitize_callback' => 'esc_url_raw',
				));

				$wp_customize->add_control( 'wcal_logo_url', array(
					'type'            => 'url',
					'section'         => 'wcal_header_section',
					'label'           => __( 'Logo URL','wp-custom-admin-login-lite' ),
				));

				$wp_customize->add_setting( 'wcal_logo_title', array(
					'type'              => 'option',
					'default' => get_bloginfo( 'name', 'display' ),
					'capability'        => 'manage_options',
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control( 'wcal_logo_title', array(
					'type'            => 'text',
					'section'         => 'wcal_header_section',
					'label'           => __( 'Logo Hover Title','wp-custom-admin-login-lite' ),
				));

				/*Background Options*/

				$wp_customize->add_setting( 'wcal_customize_template', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 0,
					'sanitize_callback' => array( $this, 'wcal_checkbox_sanitize'),
				));

				$wp_customize->add_control( 'wcal_customize_template', array(
					'type'    => 'checkbox',
					'section' => 'wcal_template_section',
					'label'   => __( 'Enable Customization','wp-custom-admin-login-lite' ),
				));


				$wp_customize->add_setting( 'wcal_background_section', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_background_section',
					array(
						'section'     => 'wcal_template_section',
						'settings'    => 'wcal_background_section',
						'input_attrs' => array(
							'info' => __('Background', 'wp-custom-admin-login-lite'),
						)
					)
				));

				$wp_customize->add_setting('wcal_background_type', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 'color',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_type'),
				));

				$wp_customize->add_control('wcal_background_type', array(
					'type'     => 'select',
					'label'    => __('Select Background Type', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_template_section',
					'settings' => 'wcal_background_type',
					'choices'  => array( 
						'color'  => 'Color',  
						'image'  => 'Image', 
					)
				));

				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_background_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_background_color',
						array(
							'label'           => __( 'Background Color', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				$wp_customize->add_setting( 'wcal_bg_image', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'sanitize_callback' => 'esc_url',
				));

				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wcal_bg_image', array(
					'label'   => __( 'Set Background Image', 'theme_textdomain' ),
					'section' => 'wcal_template_section',
				) 
				) );

				$wp_customize->add_setting('wcal_background_size', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           =>'cover',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_size'),
				));

				$wp_customize->add_control('wcal_background_size', array(
					'type'     => 'select',
					'label'    => __('Select Background Size', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_template_section',
					'settings' => 'wcal_background_size',
					'choices'  => array( 
						'cover'   => 'Cover',  
						'contain' => 'Contain', 
					)
				));

				$wp_customize->add_setting('wcal_background_repeat', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           =>'no-repeat',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_repeat'),
				));

				$wp_customize->add_control('wcal_background_repeat', array(
					'type'     => 'select',
					'label'    => __('Select Background Repeat', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_template_section',
					'settings' => 'wcal_background_repeat',
					'choices'  => array( 
						'repeat'    => 'Repeat',  
						'repeat-x'  => 'Repeat-x', 
						'repeat-y'  => 'Repeat-y',
						'no-repeat' => 'No-repeat',						
					)
				));

				$wp_customize->add_setting('wcal_background_position', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 'center center',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_position'),
				));

				$wp_customize->add_control('wcal_background_position', array(
					'type'     => 'select',
					'label'    => __('Select Background Position', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_template_section',
					'settings' => 'wcal_background_position',
					'choices'  => array( 
						'left top'      => 'left top',  
						'left center'   => 'left center', 
						'left bottom'   => 'left bottom',
						'right top'     => 'right top',	
						'right center'  => 'right center',  
						'right bottom'  => 'right bottom', 
						'center top'    => 'center top',
						'center center' => 'center center',	
						'center bottom' => 'center bottom',	

					)
				));

				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_image_overlay_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_image_overlay_color',
						array(
							'label'           => __( 'Background Overlay Color', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
		
				$wp_customize->add_setting( 'wcal_template_color', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_template_color',
					array(
						'section'     => 'wcal_template_section',
						'settings'    => 'wcal_template_color',
						'input_attrs' => array(
							'info' => __('Template Colors', 'wp-custom-admin-login-lite'),
						)
					)
				));
				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_primary_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_primary_color',
						array(
							'label'           => __( 'Primary Color', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_secondary_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_secondary_color',
						array(
							'label'           => __( 'Secondary Color', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_tertiary_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_tertiary_color',
						array(
							'label'           => __( 'Tertiary Color', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				/*Social Color*/

				$wp_customize->add_setting( 'wcal_social_color', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_social_color',
					array(
						'section'     => 'wcal_template_section',
						'settings'    => 'wcal_social_color',
						'input_attrs' => array(
							'info' => __('Social Icon Colors', 'wp-custom-admin-login-lite'),
						)
					)
				));
				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_social_icon_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_social_icon_color',
						array(
							'label'           => __( 'Icon Color', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_tooltip_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_tooltip_color',
						array(
							'label'           => __( 'Tooltip Text', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				/* Alpha Color Picker setting.*/
				$wp_customize->add_setting(
					'wcal_tooltip_bg_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				/* Alpha Color Picker control.*/
				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_tooltip_bg_color',
						array(
							'label'           => __( 'Tooltip Background', 'wp-custom-admin-login-lite' ),
							'section'         => 'wcal_template_section',
							'show_opacity'    => true, /*Optional.*/
							'palette'         => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				/*Form Settings*/
				$wp_customize->add_section('wcal_login_section', array(
					'title' => __('Login Form', 'wp-custom-admin-login-lite'),
					'panel' => 'wcal_panel',
				));

				$wp_customize->add_setting( 'wcal_lost_password_section', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_lost_password_section',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'wcal_lost_password_section',
						'input_attrs' => array(
							'info' => __('Lost Password', 'wp-custom-admin-login-lite'),
						)
					)
				));

				$wp_customize->add_setting('wcal_lost_password_text', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => __('Lost your password?','wp-custom-admin-login-lite'),
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control('wcal_lost_password_text', array(
					'type'        => 'text',
					'label'       => __('Lost Password Text', 'wp-custom-admin-login-lite'),
					'description' => '',
					'section'     => 'wcal_login_section',
					'settings'    => 'wcal_lost_password_text',
				));

				$wp_customize->add_setting( 'wcal_remember_me_section', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_remember_me_section',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'wcal_remember_me_section',
						'input_attrs' => array(
							'info' => __('Remember Me', 'wp-custom-admin-login-lite'),
						)
					)
				));

				$wp_customize->add_setting('wcal_remember_me_text', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => __('Remember Me','wp-custom-admin-login-lite'),
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control('wcal_remember_me_text', array(
					'type'        => 'text',
					'label'       => __('Rememeber Me Text', 'wp-custom-admin-login-lite'),
					'description' => '',
					'section'     => 'wcal_login_section',
					'settings'    => 'wcal_remember_me_text',
				));

				$wp_customize->add_setting( 'wcal_registration_section', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_registration_section',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'wcal_registration_section',
						'input_attrs' => array(
							'info' => __('Registration', 'wp-custom-admin-login-lite'),
						)
					)
				));

				$wp_customize->add_setting('wcal_registration_text', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => __('Create an account?','wp-custom-admin-login-lite'),
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control('wcal_registration_text', array(
					'type'        => 'text',
					'label'       => __('Registration Text', 'wp-custom-admin-login-lite'),
					'description' => '',
					'section'     => 'wcal_login_section',
					'settings'    => 'wcal_registration_text',
				));


				$wp_customize->add_setting('wcal_registration_link_text', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => __('Register','wp-custom-admin-login-lite'),
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control('wcal_registration_link_text', array(
					'type'        => 'text',
					'label'       => __('Registration Link Text', 'wp-custom-admin-login-lite'),
					'description' => '',
					'section'     => 'wcal_login_section',
					'settings'    => 'wcal_registration_link_text',
				));


				$wp_customize->add_setting('wcal_registration_url', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default' => site_url().'/wp-login.php?action=register',
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control('wcal_registration_url', array(
					'type'     => 'text',
					'label'    => __('Registration URL', 'wp-custom-admin-login-lite'),
					'description' => __('Default value is: ','wp-custom-admin-login-lite').site_url().'/wp-login.php?action=register',
					'section'  => 'wcal_login_section',
					'settings' => 'wcal_registration_url',
				));

				$wp_customize->add_setting( 'wcal_backto_section', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_backto_section',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'wcal_backto_section',
						'input_attrs' => array(
							'info' => __('Back to Section', 'wp-custom-admin-login-lite'),
						)
					)
				));

				$wp_customize->add_setting('wcal_backto_text', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => __('Back to ', 'wp-custom-admin-login-lite').get_bloginfo('name'),
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control('wcal_backto_text', array(
					'type'     => 'text',
					'label'    => __('Back to Text', 'wp-custom-admin-login-lite'),
					'description' => '',
					'section'  => 'wcal_login_section',
					'settings' => 'wcal_backto_text',
				));


				$wp_customize->add_setting('wcal_backto_url', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => site_url(),
					'sanitize_callback' => array( $this, 'wcal_text_sanitize'),
				));

				$wp_customize->add_control('wcal_backto_url', array(
					'type'        => 'text',
					'label'       => __('Back to URL', 'wp-custom-admin-login-lite'),
					'description' => __('Default link: ','wp-custom-admin-login-lite').site_url(),
					'section'     => 'wcal_login_section',
					'settings'    => 'wcal_backto_url',
				));


				/*Form Background Settings*/
				$wp_customize->add_setting( 'wcal_form_customize', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 0,
					'sanitize_callback' => array( $this, 'wcal_checkbox_sanitize'),
				));

				$wp_customize->add_control( 'wcal_form_customize', array(
					'type'    => 'checkbox',
					'section' => 'wcal_login_section',
					'label'   => __( 'Enable Customization','wp-custom-admin-login-lite' ),
				));
				$wp_customize->add_setting( 'wcal_form_background_section', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_form_background_section',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'wcal_form_background_section',
						'input_attrs' => array(
							'info' => __('Background Settings', 'wp-custom-admin-login-lite'),
						)
					)
				));

				$wp_customize->add_setting('wcal_form_background_type', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 'color',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_type'),
				));

				$wp_customize->add_control('wcal_form_background_type', array(
					'type'     => 'select',
					'label'    => __('Select Background Type', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_login_section',
					'settings' => 'wcal_form_background_type',
					'choices'  => array( 
						'color' => 'Color',  
						'image' => 'Image', 
					)
				));

				$wp_customize->add_setting(
					'wcal_login_bg_color',
					array(
						'default'    => '#fff',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_login_bg_color',
						array(
							'label'        => __( 'Background Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				$wp_customize->add_setting( 'wcal_login_image', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'sanitize_callback' => 'esc_url_raw',
				));

				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wcal_login_image', array(
					'label'   => __( 'Set Login Background Image', 'theme_textdomain' ),
					'section' => 'wcal_login_section',

				) 
				) );

				$wp_customize->add_setting('wcal_form_background_size', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 'cover',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_size'),
				));

				$wp_customize->add_control('wcal_form_background_size', array(
					'type'     => 'select',
					'label'    => __('Select Background Size', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_login_section',
					'settings' => 'wcal_form_background_size',
					'choices'  => array( 
						'cover'   => 'Cover',  
						'contain' => 'Contain', 
					)
				));

				$wp_customize->add_setting('wcal_form_background_repeat', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 'no-repeat',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_repeat'),
				));

				$wp_customize->add_control('wcal_form_background_repeat', array(
					'type'     => 'select',
					'label'    => __('Select Background Repeat', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_login_section',
					'settings' => 'wcal_form_background_repeat',
					'choices'  => array( 
						'no-repeat' => 'No-repeat',
						'repeat'    => 'Repeat',  
						'repeat-x'  => 'Repeat-x', 
						'repeat-y'  => 'Repeat-y',

					)
				));

				$wp_customize->add_setting('wcal_form_background_position', array(
					'type'              => 'option',
					'capability'        => 'manage_options',
					'default'           => 'center center',
					'sanitize_callback' => array( $this, 'wcal_radio_sanitize_background_position'),
				));

				$wp_customize->add_control('wcal_form_background_position', array(
					'type'     => 'select',
					'label'    => __('Select Background Position', 'wp-custom-admin-login-lite'),
					'section'  => 'wcal_login_section',
					'settings' => 'wcal_form_background_position',
					'choices'  => array( 
						'left top'      => 'left top',  
						'left center'   => 'left center', 
						'left bottom'   => 'left bottom',
						'right top'     => 'right top',	
						'right center'  => 'right center',  
						'right bottom'  => 'right bottom', 
						'center top'    => 'center top',
						'center center' => 'center center',	
						'center bottom' => 'center bottom',	

					)
				));

				$wp_customize->add_setting( 'form_typography', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'form_typography',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'form_typography',
						'input_attrs' => array(
							'info' =>  __( 'Typography Settings', 'wp-custom-admin-login-lite' ),
						)
					)
				));

				// Add a Google Font control
				$wp_customize->add_setting( 'wcal_form_typography', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_form_typography',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'wcal_form_typography',
						'input_attrs' => array(
							'info' => __('Typography', 'wp-custom-admin-login-lite'),
						)
					)
				));
				
		        $wp_customize->add_setting( 'wcal_form_font', array(
					'default' => 'Open Sans',
					'type'    => 'option',
		        ) );
		        $wp_customize->add_control( new WCAL_Google_Font_Dropdown_Custom_Control( $wp_customize, 'wcal_form_font', array(
		            'label'   => 'Google Font Setting',
		            'section' => 'wcal_login_section'
		        ) ) );

				$wp_customize->add_setting( 'form_field_title', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'form_field_title',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'form_field_title',
						'input_attrs' => array(
							'info' => __( 'Form Fields','wp-custom-admin-login-lite' )
						)
					)
				));

				$wp_customize->add_setting(
					'wcal_login_field_bg_color',
					array(
						'default'    => '#fbfbfb',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_login_field_bg_color',
						array(
							'label'        => __( 'Field Background Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				$wp_customize->add_setting(
					'wcal_field_border',
					array(
						'default'    => '#ddd',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_field_border',
						array(
							'label'        => __( 'Field Border', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				$wp_customize->add_setting( 'wcal_text_colors', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_button') );

				$wp_customize->add_control( new WCAL_Header_Control(
					$wp_customize,
					'wcal_text_colors',
					array(
						'section'     => 'wcal_login_section',
						'settings'    => 'form_field_title',
						'input_attrs' => array(
							'info' => __( 'Text Colors', 'wp-custom-admin-login-lite' ),
						)
					)
				));


				$wp_customize->add_setting(
					'wcal_header_color',
					array(
						'default'    => '#0085BA',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_header_color',
						array(
							'label'        => __( 'Header Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				$wp_customize->add_setting(
					'wcal_tagline_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_tagline_color',
						array(
							'label'        => __( 'Tagline Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				$wp_customize->add_setting(
					'wcal_label_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_label_color',
						array(
							'label'        => __( 'Label Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				$wp_customize->add_setting(
					'wcal_remember_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_remember_color',
						array(
							'label'        => __( 'Remember me Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				$wp_customize->add_setting(
					'wcal_forgot_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_forgot_color',
						array(
							'label'        => __( 'Forgot Password Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				$wp_customize->add_setting(
					'wcal_button_text_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_button_text_color',
						array(
							'label'        => __( 'Button Text Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				$wp_customize->add_setting(
					'wcal_register_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_register_color',
						array(
							'label'        => __( 'Register Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);
				$wp_customize->add_setting(
					'wcal_back_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_back_color',
						array(
							'label'        => __( 'Back to Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				$wp_customize->add_setting(
					'wcal_footer_text_color',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_footer_text_color',
						array(
							'label'        => __( 'Footer Text Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				$wp_customize->add_setting(
					'wcal_form_button_text_active',
					array(
						'default'    => '',
						'type'       => 'option',
						'capability' => 'edit_theme_options',
					)
				);

				$wp_customize->add_control(
					new Customize_Alpha_Color_Control(
						$wp_customize,
						'wcal_form_button_text_active',
						array(
							'label'        => __( 'Button Active Color', 'wp-custom-admin-login-lite' ),
							'section'      => 'wcal_login_section',
							'show_opacity' => true, /*Optional.*/
							'palette'      => array(
								'rgb(150, 50, 220)',
								'rgba(50,50,50,0.8)',
								'rgba( 255, 255, 255, 0.2 )',
								'#00CC99' /* Mix of color types = no problem*/
							)
						)
					)
				);

				/*Additional Content*/
				$wp_customize->add_section('wcal_additional_content', array(
					'title' => __('Additional Content', 'wp-custom-admin-login-lite'),
					'panel' => 'wcal_panel',
				));

				// WP Text Editor
		        $wp_customize->add_setting( 'wcal_additonal_text', array(
					'type'    => 'option',
					'default' => '',
		        ) );
		        $wp_customize->add_control( new WCAL_Text_Editor_Custom_Control( $wp_customize, 'wcal_additonal_text', array(
		            'label'   => 'Additional Content Block',
		            'section' => 'wcal_additional_content'
		        ) ) );

				// Add a Google Font control
		        $wp_customize->add_setting( 'google_font_setting', array(
		        	'type'    => 'option',
		            'default'        => 'Open Sans',
		        ) );
		        $wp_customize->add_control( new WCAL_Google_Font_Dropdown_Custom_Control( $wp_customize, 'google_font_setting', array(
		            'label'   => 'Google Font Setting',
		            'section' => 'wcal_additional_content'
		        ) ) );

				/*Social Icons*/

				$wp_customize->add_setting( 'wcal_social_icons', array(
					'sanitize_callback' => array( $this, 'wcal_sanitize_repeater'),
					'type'              => 'option',
					'default'           => json_encode(
						array(
							array(
								'wcal_social_icon'    => '',
								'wcal_social_url'     => '',
								'wcal_social_tooltip' => '',
							)
						)
					)
				));

				$wp_customize->add_control(  new WCAL_Repeater_Controler( $wp_customize, 'wcal_social_icons', 
					array(
						'label'                => esc_html__('Social Icons','wp-custom-admin-login-lite'),
						'section'              => 'wcal_footer_section',
						'wcal_box_label'       => esc_html__('Social Icon','wp-custom-admin-login-lite'),
						'wcal_box_add_control' => esc_html__('Add Social Icon','wp-custom-admin-login-lite'),
					),
					array(
						'wcal_social_icon' => array(
							'type'        => 'icon',
							'label'       => esc_html__( 'Social Icon', 'wp-custom-admin-login-lite' ),
							'default'     => '',
							'class'       => 'un-bottom-block-cat1'
						),
						'wcal_social_url' => array(
							'type'        => 'text',
							'label'       => esc_html__( 'URL', 'wp-custom-admin-login-lite' ),
							'default'     => '',
							'class'       => 'un-bottom-block-cat1'
						),
						'wcal_social_tooltip' => array(
							'type'        => 'text',
							'label'       => esc_html__( 'Tooltip', 'wp-custom-admin-login-lite' ),
							'default'     => '',
							'class'       => 'un-bottom-block-cat1'
						)
					)
				));



				/*Footer Section*/
				$wp_customize->add_section('wcal_footer_section', array(
					'title' => __('Footer Section', 'wp-custom-admin-login-lite'),
					'panel' => 'wcal_panel',
				));

		        // Add a textarea control
		        $wp_customize->add_setting( 'wcal_footer_text', array(
					'default' => '',
					'type'    => 'option',
		        ) );
		        $wp_customize->add_control( new WCAL_Textarea_Custom_Control( $wp_customize, 'wcal_footer_text', array(
		            'label'   => __('Footer Text', 'wp-custom-admin-login-lite'),
		            'section' => 'wcal_footer_section',
		        ) ) );

		        // Add a textarea control
		        $wp_customize->add_section('wcal_css_section', array(
					'title' => __('Custom CSS Section', 'wp-custom-admin-login-lite'),
					'panel' => 'wcal_panel',
				));
		        $wp_customize->add_setting( 'wcal_css_editor', array(
					'default' => '',
					'type'    => 'option',
		        ) );
		        $wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'wcal_css_editor', array(
		            'label'   => __('Custom CSS Section', 'wp-custom-admin-login-lite'),
		            'section' => 'wcal_css_section',
		            'description' => __('Add your own css to the login page here.', 'wp-custom-admin-login-lite'),
		        ) ) );
			}

		}

		new WCAL_Customizer();
	}




