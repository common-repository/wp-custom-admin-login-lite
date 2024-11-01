/**
 * Script fort the customizer tabs control interactions.
 *
 * @since    1.1.43
 * @package WP Custom Admin Login
 *
 * @author 8Degree Themes
 */

/* global wp */

var wcal_customize_control_tabs = function ( $ ) {
	'use strict';

	$(
		function () {
			var customize = wp.customize;

			// Switch tab based on customizer partial edit links.
			customize.previewer.bind(
				'tab-previewer-edit', function( data ) {
					$( data.selector ).trigger( 'click' );
				}
			);

			customize.previewer.bind(
				'focus-control',  function( data ) {
                    /**
					 * This timeout is here because in firefox this happens before customizer animation of changing panels.
					 * After it change panels with the input focused, the customizer was moved to right 12px. We have to make sure
					 * that the customizer animation of changing panels in customizer is done before focusing the input.
                     */
                    setTimeout( function(){ $('.customize-pane-child').find( '#_customize-input-' + data ).focus(); } , 100 );
				}
			);


            // Hide all controls
			$( '.wcal-tabs-control' ).each(
				function () {
					var customizerSection = $( this ).closest( '.accordion-section' );
					// Hide all controls in section.
					hideAllExceptCurrent( customizerSection );

					// Show controls under first radio button.
					var shownCtrls = $( this ).find( '.wcal-customizer-tab > input:checked' ).data( 'controls' );
					showControls( customizerSection, shownCtrls );
				}
			);

			$( '.wcal-customizer-tab > label' ).on(
				'click', function () {
					var customizerSection = $( this ).closest( '.accordion-section' );
					var controls          = $( this ).prev().data( 'controls' );

					// Hide all controls in section
					hideAllExceptCurrent( customizerSection );
					showControls( customizerSection, controls );

					/*Background Settings*/
					customize( 'wcal_background_type', function( value ) {

						var colorControls = [
						'wcal_background_color',
						'wcal_bg_image',
						'wcal_background_size',
						'wcal_background_repeat',
						'wcal_background_position',
						'wcal_image_overlay',
						'wcal_image_overlay_color',
						/*'wcal_slider_images',*/
						'wcal_background_video_type',
						'wcal_background_video_yt_url',
						'wcal_background_video_vimeo_url',
						'wcal_background_video_url',
						'wcal_disble_on_android',
						'wcal_disble_on_ios',
						'wcal_video_visible',
						'wcal_video_mute',
						'wcal_video_start_time',
						'wcal_video_end_time'
						];

						$.each( colorControls, function( index, id ) {
							customize.control( id, function( control ) {
								/* Toggling function */
								var wcal_toggle = function( display ) {
									switch(display){
										case 'color':
										if(id =='wcal_background_color'){
											control.toggle( true );
										}else{
											control.toggle( false );
										}
										break;
										case 'image':
										if( id == 'wcal_bg_image' || id == 'wcal_background_size' || id == 'wcal_background_repeat' || id == 'wcal_background_position' || id == 'wcal_image_overlay' || id == 'wcal_image_overlay_color'){ 
											control.toggle( true );
										}else{
											control.toggle( false );
										}
										break;
                            /*case 'slider':
                            if(id =='wcal_slider_images' || id == 'wcal_image_overlay' || id == 'wcal_image_overlay_color'){
                                control.toggle( true );
                            }else{
                                control.toggle( false );
                            }
                            break;*/
                            case 'video':
                            if( id == 'wcal_background_video_type' || id == 'wcal_background_video_yt_url' || id == 'wcal_background_video_vimeo_url' || id == 'wcal_background_video_url' || id == 'wcal_disble_on_android' || id == 'wcal_disble_on_ios' || id == 'wcal_video_visible' || id == 'wcal_video_mute' || id == 'wcal_video_start_time' || id == 'wcal_video_end_time' || id == 'wcal_image_overlay' || id == 'wcal_image_overlay_color'){
                            	control.toggle( true );

                                //Background Video Settings
                                customize( 'wcal_background_video_type', function( value ) {

                                	var colorControls = [
                                	'wcal_background_video_yt_url',
                                	'wcal_background_video_vimeo_url',
                                	'wcal_background_video_url',
                                	];

                                	$.each( colorControls, function( index, id ) {
                                		customize.control( id, function( control ) {
                                			/* Toggling function */
                                			var wcal_toggle = function( display ) {
                                				switch(display){
                                					case 'youtube':
                                					if(id =='wcal_background_video_yt_url'){
                                						control.toggle( true );
                                					}else{
                                						control.toggle( false );
                                					}
                                					break;
                                					case 'vimeo':
                                					if( id == 'wcal_background_video_vimeo_url' ){ 
                                						control.toggle( true );
                                					}else{
                                						control.toggle( false );
                                					}
                                					break;
                                					case 'custom':
                                					if(id =='wcal_background_video_url'){
                                						control.toggle( true );
                                					}else{
                                						control.toggle( false );
                                					}
                                					break;
                                				}
                                			};

                                			/*Default*/
                                			wcal_toggle( value.get() );
                                			/*onChange*/
                                			value.bind( wcal_toggle );
                                		} );
                                	} );
                                } );
                            }else{
                            	control.toggle( false );
                            }
                            break;
                        }
                    };

                    /*Default*/
                    wcal_toggle( value.get() );
                    /*onChange*/
                    value.bind( wcal_toggle );
                } );
				} );
				} );


				customize( 'wcal_form_background_type', function( value ) {

					var colorControls = [
					'wcal_login_bg_color',
					'wcal_login_image',
					'wcal_form_background_size',
					'wcal_form_background_repeat',
					'wcal_form_background_position'
					];

					$.each( colorControls, function( index, id ) {
						customize.control( id, function( control ) {
							/* Toggling function */
							var wcal_toggle = function( display ) {
								switch(display){
									case 'color':
									if(id =='wcal_login_bg_color'){
										control.toggle( true );
									}else{
										control.toggle( false );
									}
									break;
									case 'image':
									if( id == 'wcal_login_image' || id == 'wcal_form_background_size' || id == 'wcal_background_repeat' || id == 'wcal_form_background_position' ){ 
										control.toggle( true );
									}else{
										control.toggle( false );
									}
									break;
								}
							};

							/*Default*/
							wcal_toggle( value.get() );
							/*onChange*/
							value.bind( wcal_toggle );
						} );
					} );
				} ); 
				}
				);
		}
	);
};

wcal_customize_control_tabs( jQuery );

/**
 * Handles showing the controls when the tab is clicked.
 *
 * @param customizerSection
 * @param controlsToShowArray
 */
function showControls( customizerSection, controlsToShowArray ) {
	'use strict';
	jQuery.each(
		controlsToShowArray, function ( index, controlId ) {
			var parentSection = customizerSection[ 0 ];
			if ( controlId === 'widgets' ) {
				jQuery( parentSection ).children( 'li[class*="widget"]' ).css( 'display', 'list-item' );
				return true;
			}
			jQuery( '#customize-control-' + controlId ).css( 'display', 'list-item' );
		}
	);
}

/**
 * Utility function that hides all the controls in the panel except the tabs control.
 *
 * @param customizerSection
 * @param controlId
 */
function hideAllExceptCurrent( customizerSection ) {
	'use strict';
	jQuery( customizerSection ).children( 'li.customize-control' ).css( 'display', 'none' );
}
