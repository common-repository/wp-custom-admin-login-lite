<?php

if ( !class_exists( 'WCAL_Library' ) ) {

	class WCAL_Library {
		function __construct(){
		
		}
		function print_array( $array ) {
			echo "<pre>";
			print_r( $array );
			echo "</pre>";
		}

	}

}