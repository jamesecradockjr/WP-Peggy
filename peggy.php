<?php 

/**
 * Plugin Name: WP Peggy
 * Plugin URI: http://www.yellahoose.com/peggy
 * Description: WordPress plugin for Peggy, software to make it harder for spambots to harvest email from web pages.
 * Version: 1.0
 * Author: James Cradock
 * Author URI: http://www.yellahoose.com/
 * License: TBD
 */
 
// Installation: Put this script in your plugins folder, then login to WordPress and activate WP Peggy.  
// Usage: [html_ent_email email="email@address.com" text="Some text to link to"] 
 
function html_ent_email_func($atts){ 

	extract(shortcode_atts(array(
		'email' => '',
		'text' 	=> '',
	), $atts));
	
	$url = "http://path/to/cgi-bin/peggy.pl?"; 
	$url .= "Email=". rawurlencode($atts['email']) ."&Text=". rawurlencode($atts['text']) ."&Submit=Submit&";
	$url .= "API=true"; 
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$res = curl_exec($ch);
	
	curl_close($ch);
	
	return trim($res); 
	
} 

add_shortcode("html_ent_email", "html_ent_email_func"); 

?>
