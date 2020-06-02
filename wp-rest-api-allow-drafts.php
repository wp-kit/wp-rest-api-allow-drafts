<?php
	
/**
 * Plugin Name: WP Rest API Allow Drafts
 * Version: 1.0.0
 * Plugin URI: https://wpmailsmtp.com/
 * Description: Allows draft posts and pages to come through into WP Rest Api when requesting for single draft posts and pages by id when the referrer host name matches the home url
 * Author: Creative Little Dots & WPKit
 */
	
add_action('rest_api_init', function() {
	add_filter('user_has_cap', function($all, $cap, $args) {
		// if not requesting read post or pages then return caps
	    if(!in_array($args[0], ['read_page', 'read_post'])) return $all;
	    // if user can already rad private posts then return caps
	    if($args[0] == 'read_post' && $all['read_private_posts']) return $all;
	    if($args[0] == 'read_page' && $all['read_private_pages']) return $all;
	    // if user is the post author then return caps
	    $post = get_post($args[2]);
	    if($args[1] == $post->post_author) return $all;
	    $referer = null;
	    if ( $parts = parse_url( $_SERVER['HTTP_REFERER'] ) ) {
			$referer = $parts[ "scheme" ] . "://" . $parts[ "host" ];
		}
	    $can_read = $referer == get_option('home');
		if($can_read) {
	        foreach($cap as $c) {
	            $all[$c] = true;
	        }
	    }
		return $all;
	}, 10, 3);
});