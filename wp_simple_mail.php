<?php

/*
Plugin Name: MyMailer
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Name Of The Plugin Author
Author URI: http://URI_Of_The_Plugin_Author
License: GPL2
*/

add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = SMTP_HOST;
	$phpmailer->SMTPAuth   = SMTP_AUTH;
	$phpmailer->Port       = SMTP_PORT;
	$phpmailer->Username   = SMTP_USER;
	$phpmailer->Password   = SMTP_PASS;
	$phpmailer->SMTPSecure = SMTP_SECURE;
	$phpmailer->From       = SMTP_FROM;
	$phpmailer->FromName   = SMTP_NAME;
}

add_filter('wp_mail_from', 'set_wp_mail_from');
function set_wp_mail_from($current_from) {
	if (SMTP_FROM) { 
		return SMTP_FROM;
	}
	
	if ($current_from) {
		return $current_from;
	}
	
	return get_bloginfo('admin_email');
}

add_filter('wp_mail_from_name', 'set_wp_mail_from');
function set_wp_mail_from_name($current_from_name) {
	if (SMTP_NAME) {
		return SMTP_NAME;	
	}
	
	if ($current_from_name) {
		return $current_from_name;
	}

	return get_bloginfo('name');
}


?>
