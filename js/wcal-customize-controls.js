/*
 WP Custom Admin Login - Customize Control js

 Version 1.0.0

 Created on : 10 October, 2017, 10:22:04 AM
 Author     : 8Degree Themes
 */
 
(function( $ ) {
    // Codes here.
    wp.customize.bind( 'ready', function() {
    	var customize = this;

        /*Checkbox Logic*/
        //Logo Settings
        customize( 'wcal_hide_logo', function( value ) {
            /*var wcal_logo_width = customize.control( 'wcal_logo_width' ).container.find( 'input' );
            var wcal_logo_height = customize.control( 'wcal_logo_height' ).container.find( 'input' );
            var wcal_logo_padding = customize.control( 'wcal_logo_padding' ).container.find( 'input' );*/
            var wcal_logo_url = customize.control( 'wcal_logo_url' ).container.find( 'input' );
            var wcal_logo_title = customize.control( 'wcal_logo_title' ).container.find( 'input' );
            var wcal_logo_image = customize.control( 'wcal_logo_image' ).container.find( 'button' );
            
            /*Default Values*/
            /*wcal_logo_width.prop( 'disabled', value.get() );
            wcal_logo_height.prop( 'disabled', value.get() );
            wcal_logo_padding.prop( 'disabled', value.get() );*/
            wcal_logo_url.prop( 'disabled', value.get() );
            wcal_logo_title.prop( 'disabled', value.get() );
            wcal_logo_image.prop( 'disabled', value.get() );
            
            /*OnChange*/
            value.bind( function( to ) {
                /*wcal_logo_width.prop( 'disabled', to );
                wcal_logo_height.prop( 'disabled', to );
                wcal_logo_padding.prop( 'disabled', to );*/
                wcal_logo_url.prop( 'disabled', to );
                wcal_logo_title.prop( 'disabled', to );
                wcal_logo_image.prop( 'disabled', to );
            } );
        });

        //Google Captcha Settings
        customize( 'wcal_enable_google', function( value ) {
            var wcal_google_secret = customize.control( 'wcal_google_secret' ).container.find( 'input' );
            var wcal_google_site = customize.control( 'wcal_google_site' ).container.find( 'input' );
            var wcal_google_error = customize.control( 'wcal_google_error' ).container.find( 'input' );
            var wcal_enable_on_login = customize.control( 'wcal_enable_on_login' ).container.find( 'input' );
            var wcal_enable_on_register = customize.control( 'wcal_enable_on_register' ).container.find( 'input' );
            /*var wcal_enable_on_forget_password = customize.control( 'wcal_enable_on_forget_password' ).container.find( 'input' );*/
            
            /*Default Values*/
            wcal_google_secret.prop( 'disabled', !value.get() );
            wcal_google_site.prop( 'disabled', !value.get() );
            wcal_google_error.prop( 'disabled', !value.get() );
            wcal_enable_on_login.prop( 'disabled', !value.get() );
            wcal_enable_on_register.prop( 'disabled', !value.get() );
            /*wcal_enable_on_forget_password.prop( 'disabled', !value.get() );*/
            
            /*OnChange*/
            value.bind( function( to ) {
                wcal_google_secret.prop( 'disabled', !to );
                wcal_google_site.prop( 'disabled', !to );
                wcal_google_error.prop( 'disabled', !to );
                wcal_enable_on_login.prop( 'disabled', !to );
                wcal_enable_on_register.prop( 'disabled', !to );
                /*wcal_enable_on_forget_password.prop( 'disabled', !to );*/
            } );
        });

        /*Social Login Settings*/
        //Facebook Settings
        customize( 'wcal_enable_facebook_login', function( value ) {
            var wcal_facebook_app_id = customize.control( 'wcal_facebook_app_id' ).container.find( 'input' );
            var wcal_facebook_app_secret = customize.control( 'wcal_facebook_app_secret' ).container.find( 'input' );
            var wcal_facebook_label = customize.control( 'wcal_facebook_label' ).container.find( 'input' );
            
            /*Default Values*/
            wcal_facebook_app_id.prop( 'disabled', !value.get() );
            wcal_facebook_app_secret.prop( 'disabled', !value.get() );
            wcal_facebook_label.prop( 'disabled', !value.get() );
            
            /*OnChange*/
            value.bind( function( to ) {
                wcal_facebook_app_id.prop( 'disabled', !to );
                wcal_facebook_app_secret.prop( 'disabled', !to );
                wcal_facebook_label.prop( 'disabled', !to );

            } );
        });
        //Twitter Settings
        customize( 'wcal_enable_twitter_login', function( value ) {
            var wcal_twitter_app_id = customize.control( 'wcal_twitter_app_id' ).container.find( 'input' );
            var wcal_twitter_app_secret = customize.control( 'wcal_twitter_app_secret' ).container.find( 'input' );
            var wcal_twitter_label = customize.control( 'wcal_twitter_label' ).container.find( 'input' );
            
            /*Default Values*/
            wcal_twitter_app_id.prop( 'disabled', !value.get() );
            wcal_twitter_app_secret.prop( 'disabled', !value.get() );
            wcal_twitter_label.prop( 'disabled', !value.get() );
            
            /*OnChange*/
            value.bind( function( to ) {
                wcal_twitter_app_id.prop( 'disabled', !to );
                wcal_twitter_app_secret.prop( 'disabled', !to );
                wcal_twitter_label.prop( 'disabled', !to );

            } );
        });
        //Google Settings
        customize( 'wcal_enable_google_login', function( value ) {
            var wcal_google_app_id = customize.control( 'wcal_google_app_id' ).container.find( 'input' );
            var wcal_google_app_secret = customize.control( 'wcal_google_app_secret' ).container.find( 'input' );
            var wcal_google_label = customize.control( 'wcal_google_label' ).container.find( 'input' );
            
            /*Default Values*/
            wcal_google_app_id.prop( 'disabled', !value.get() );
            wcal_google_app_secret.prop( 'disabled', !value.get() );
            wcal_google_label.prop( 'disabled', !value.get() );
            
            /*OnChange*/
            value.bind( function( to ) {
                wcal_google_app_id.prop( 'disabled', !to );
                wcal_google_app_secret.prop( 'disabled', !to );
                wcal_google_label.prop( 'disabled', !to );

            } );
        });

        /*Select Option Logic*/
        customize( 'wcal_image_overlay', function( value ) {
            var wcal_image_overlay_color = customize.control( 'wcal_image_overlay_color' );
            wcal_image_overlay_color.toggle(value.get());
            value.bind( function( to ) {
                wcal_image_overlay_color.toggle( to );
            } );
        } );
        //Background Settings
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



        //Form Background Settings
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

        /*Script for image selected from radio option*/
        $('.controls#wcal-img-container li .wcal-image-title-wrap').click(function(){
            $('.controls#wcal-img-container li').each(function(){
                $(this).find('.wcal-image-title-wrap').removeClass ('wcal-radio-img-selected') ;
            });
            $(this).addClass ('wcal-radio-img-selected') ;
        });

        $('.layout-thmub-section #wcal-img-container li img').click(function(){
            $('.layout-thmub-section #wcal-img-container li').each(function(){
                $(this).find('img').removeClass ('wcal-radio-img-selected') ;
            });
            $(this).addClass ('wcal-radio-img-selected') ;
        });

        $('#tm-img-container-meta li img').click(function(){
            $('#tm-img-container-meta li').each(function(){
                $(this).find('img').removeClass ('wcal-radio-img-selected') ;
            });
            $(this).addClass ('wcal-radio-img-selected') ;
        });

    } ); //end of customize bind ready
})( jQuery ); //end of jQuery