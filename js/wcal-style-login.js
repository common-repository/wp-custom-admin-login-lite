/*
 WP Custom Admin Login

 Version 1.0.0
 
 Created on : 10 October, 2017, 10:22:04 AM
 Author     : 8Degree Themes
 */

 jQuery(document).ready(function ($) {
 	/*Add Plugin Active class*/
 	$('.login').addClass('wcal-login-active');
 	$('#wp-submit').addClass('wcal-wp-submit');
	
	$('#login').addClass('wcal-login');
	$('#loginform').addClass('wcal-loginform');

 	/*Default Clearance*/
 	/*Remove default Logo*/
 	$('.login.wcal-login-active').find('#login').find('h1').remove();
 	$('.login.wcal-login-active').find('#login').find('p#nav').remove();
 	$('.login.wcal-login-active').find('#login').find('p#backtoblog').remove();

	/*Template 18 - height / width calculation*/
	$(window).on("load", function(){
		var edcm_height = $('.wcal-template-18 .wcal-content-wrapper-inner, .wcal-template-21 .wcal-content-wrapper-inner').outerHeight();
		var edcm_width = $('.wcal-template-18 .wcal-content-wrapper-inner, .wcal-template-21 .wcal-content-wrapper-inner').outerWidth();
		edcm_max_val = Math.max(edcm_height, edcm_width);
		$('.wcal-template-18 .wcal-content-wrapper .wcal-content-wrapper-inner,.wcal-template-21 .wcal-content-wrapper-inner').css({
			'max-width' : edcm_max_val,
			'max-height' : edcm_max_val
		});
		/*console.log('Height: '+edcm_height);
		console.log('Width: '+edcm_width);
		console.log('edcm_max_val: '+edcm_max_val);*/
	});

	/*Jarallax Parallax Background*/
	$(window).on('load',function () {
        jarallax(document.querySelectorAll('.wcal-jarallax-image'), {
		imgSrc: $('.wcal-jarallax-image').data('imgsrc'),
		imgSize: $('.wcal-jarallax-image').data('imgsize'),
		imgPosition: $('.wcal-jarallax-image').data('imgposition'),
		imgRepeat: $('.wcal-jarallax-image').data('imgrepeat')
		});

		jarallax(document.querySelectorAll('.wcal-jarallax-video'));
    });


	var wcal_template = wcal_js_obj.wcal_template || 'wcal-template-1';
	
	if(wcal_template == 'wcal-template-1'){
		var wcal_login_field_type = 'wcal_label_icon_right';	
	}
	if(wcal_template == 'wcal-template-2' || wcal_template == 'wcal-template-3' || wcal_template == 'wcal-template-4' || wcal_template == 'wcal-template-8' || wcal_template == 'wcal-template-13' || wcal_template == 'wcal-template-16' || wcal_template == 'wcal-template-17' || wcal_template == 'wcal-template-20' || wcal_template == 'wcal-template-24' || wcal_template == 'wcal-template-25'){
		var wcal_login_field_type = 'wcal_placeholder_only';	
	}
	if(wcal_template == 'wcal-template-5' || wcal_template == 'wcal-template-9' || wcal_template == 'wcal-template-10' || wcal_template == 'wcal-template-11' || wcal_template == 'wcal-template-12' || wcal_template == 'wcal-template-26'){
		var wcal_login_field_type = 'wcal_label_only';	
	}
	if(wcal_template == 'wcal-template-6' || wcal_template == 'wcal-template-7' || wcal_template == 'wcal-template-14' || wcal_template == 'wcal-template-18' || wcal_template == 'wcal-template-19' || wcal_template == 'wcal-template-21' || wcal_template == 'wcal-template-22' || wcal_template == 'wcal-template-23' || wcal_template == 'wcal-template-27'){
		var wcal_login_field_type = 'wcal_placeholder_icon_left';	
	}
	if(wcal_template == 'wcal-template-15'){
		var wcal_login_field_type = 'wcal_label_view_password';	
	}
	switch(wcal_login_field_type){
		case 'wcal_label_icon_right':
			$('#loginform,#registerform,#lostpasswordform').find('label').each(function( indexInArray , value){
				$(this).find('br').remove();
				if ( $(this).parent().is( "p" ) ) {
					$(this).unwrap();
				}
				if($(this).attr('for') == 'user_login'){
					/*Adding wcal custom class*/
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-login-field');
					var login_label = $(this).text();
					var login_icon = '<i class="fa fa-user"></i>';
					$(this).append(login_icon);
				}	
				if($(this).attr('for') == 'user_pass'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-password-field');
					var password_label = $(this).text();
					var password_icon = '<i class="fa fa-lock"></i>';
					$(this).append(password_icon);
				}
				if($(this).attr('for') == 'user_email'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-email-field');
					var email_label = $(this).text();
					var email_icon = '<i class="fa fa-envelope-o"></i>';
					$(this).append(email_icon);
				}
				/*Remove Remember me*/
				if($(this).attr('for') == 'rememberme'){
					$(this).remove();
				}	
			});
		break;
		case 'wcal_placeholder_only':
			$('#loginform,#registerform,#lostpasswordform').find('label').each(function( indexInArray , value){
				$(this).find('br').remove();
				if ( $(this).parent().is( "p" ) ) {
					$(this).unwrap();
				}
				if($(this).attr('for') == 'user_login'){
					/*Adding wcal custom class*/
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-login-field');
					var login_label = $(this).text();
					$('.wcal-login-label').remove();
					$(this).find('#user_login').attr('placeholder',login_label);
				}	
				if($(this).attr('for') == 'user_pass'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-password-field');
					var password_label = $(this).text();
					$('.wcal-login-label').remove();
					$(this).find('#user_pass').attr('placeholder',password_label);
				}
				if($(this).attr('for') == 'user_email'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-email-field');
					var email_label = $(this).text();
					$('.wcal-login-label').remove();
					$(this).find('#user_email').attr('placeholder',email_label);
				}
				/*Remove Remember me*/
				if($(this).attr('for') == 'rememberme'){
					$(this).remove();
				}	
			});
		break;
		case 'wcal_label_only':
			$('#loginform,#registerform,#lostpasswordform').find('label').each(function( indexInArray , value){
				$(this).find('br').remove();
				if ( $(this).parent().is( "p" ) ) {
					$(this).unwrap();
				}
				if($(this).attr('for') == 'user_login'){
					/*Adding wcal custom class*/
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-login-field');
				}	
				if($(this).attr('for') == 'user_pass'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-password-field');
				}
				if($(this).attr('for') == 'user_email'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-email-field');
				}
				/*Remove Remember me*/
				if($(this).attr('for') == 'rememberme'){
					$(this).remove();
				}	
			});
		break;
		case 'wcal_placeholder_icon_left':
			$('#loginform,#registerform,#lostpasswordform').find('label').each(function( indexInArray , value){
				$(this).find('br').remove();
				if ( $(this).parent().is( "p" ) ) {
					$(this).unwrap();
				}
				if($(this).attr('for') == 'user_login'){
					/*Adding wcal custom class*/
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-login-field');
					var login_label = $(this).text();
					$('.wcal-login-label').remove();
					$(this).find('#user_login').attr('placeholder',login_label);
					var login_icon = '<i class="fa fa-user"></i>';
					$(this).prepend(login_icon);
				}	
				if($(this).attr('for') == 'user_pass'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-password-field');
					var password_label = $(this).text();
					$('.wcal-login-label').remove();
					$(this).find('#user_pass').attr('placeholder',password_label);
					var password_icon = '<i class="fa fa-lock"></i>';
					$(this).prepend(password_icon);
				}
				if($(this).attr('for') == 'user_email'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-password-field');
					var email_label = $(this).text();
					$('.wcal-login-label').remove();
					$(this).find('#user_email').attr('placeholder',email_label);
					var password_icon = '<i class="fa fa-envelope-o"></i>';
					$(this).prepend(password_icon);
				}
				/*Remove Remember me*/
				if($(this).attr('for') == 'rememberme'){
					$(this).remove();
				}	
			});
		break;
		case 'wcal_label_view_password':
			$('#loginform,#registerform,#lostpasswordform').find('label').each(function( indexInArray , value){
				$(this).find('br').remove();
				if ( $(this).parent().is( "p" ) ) {
					$(this).unwrap();
				}
				if($(this).attr('for') == 'user_login'){
					/*Adding wcal custom class*/
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-login-field');
				}	
				if($(this).attr('for') == 'user_pass'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-password-field');
					var visible_icon = '<i class="fa fa-eye wcal-visibility-icon"></i>';
					$(this).append(visible_icon);
				}
				if($(this).attr('for') == 'user_email'){
					$(value).contents().eq(0).wrap('<span class="wcal-login-label"/>');
					$(this).addClass('wcal-email-field');
				}
				/*Remove Remember me*/
				if($(this).attr('for') == 'rememberme'){
					$(this).remove();
				}	
			});
		break;
	}

	/*Template 1 & Template 15 View Password */
	$('.wcal-loginform').find('.wcal-visibility-icon').on('mousedown',function(){
		$(this).siblings('#user_pass').attr('type', 'text');
	}).on('mouseup',function(){
		$(this).siblings('#user_pass').attr('type', 'password');
	});

	/*Template 13 content slider */
	$('.wcal-template-13').find('.wcal-slide-trigger').on('click',function(){
		$(this).closest('.wcal-content').siblings('.wcal-content').animate({
      width: "60px"
    }, {
      duration: 'show',
      easing: "swing"
    }).removeClass('wcal-active-content');
		$(this).closest('.wcal-content').animate({
      width: "460px"
    }, {
      duration: 'show',
      easing: "swing"
    }).addClass('wcal-active-content');
	});

	/*Template 4 show/hide social login*/
	$('.wcal-template-4').find('.wcal-hidden-trigger').on('click',function(){
		$(this).closest('.wcal-hidden-wrapper').toggleClass('wcal-active-content');
		$(this).siblings('.wcal-hidden-content').slideToggle();
		$('.wcal-jarallax-image').jarallax('onResize').jarallax('onScroll');
	});

	/*Template 2 tab active*/
	$('.wcal-login-active').find('#loginform').closest('.wcal-login').siblings('.wcal-pseudo-tabs').find('.wcal-pseudo-tab-1').addClass('wcal-active-tab');
	$('.wcal-login-active').find('#registerform').closest('.wcal-login').siblings('.wcal-pseudo-tabs').find('.wcal-pseudo-tab-2').addClass('wcal-active-tab');


	/*Template 9 on focus*/
	$('.wcal-login-active').find('.wcal-template-9,.wcal-template-10').find('#user_login, #user_pass, #user_email').
	on('focus',function(){
		$(this).closest('label').addClass('wcal-label-focus');
	}).
	on('blur',function(){
		$(this).closest('label').removeClass('wcal-label-focus');
	});

	/*Template 15*/
	$('.wcal-wrapper.wcal-template-15').closest('.wcal-login-active').addClass('wcal-template-15 wcal-background-color');

	/*Template 12 background class*/
	$('.wcal-login-active').find('.wcal-wrapper-outer.wcal-template-12').closest('.wcal-login-active').addClass('wcal-template-12');

	


	


});
