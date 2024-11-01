<?php
if(!class_exists('WCAL_Init')){
	class WCAL_Init{
		function __construct(){
			add_action('init',array($this,'WCAL_init'));
		}
		
		function WCAL_init(){
			load_plugin_textdomain('wp-custom-admin-login-lite', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' ); 
		}
	}
	
	new WCAL_Init();
}