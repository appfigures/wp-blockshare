<?php
/*
Plugin Name: Block Share
Plugin URI: http://newinternetorder.com/giveaway-heres-why-social-share-counters-suck-plus-what-i-can-give-you-that-doesnt/
Description: Adds tweet button to blockquotes
Author: Ariel M
Author URI: http://arielmichaeli.com/
Version: 1
License: GPL2
*/

function block_share($content) {
	// don't apply to unpublished posts because our url may not be correct
	if(get_post_status() != 'publish') return $content;

	$url = get_permalink();

	$twitter_via = get_option('bs_via', '');
	$block_pattern = get_option('bs_pattern', '/(<blockquote[^>]*>)(.*?)(<\/blockquote>)/is');

	// text is left blank intentionally
	$tweet_button = '<a href="https://twitter.com/intent/tweet?text=[title]&url='.$url.'&via='.$twitter_via.'"><span class="tweet"></span></a>';
	$facebook_button = '<a href="https://www.facebook.com/sharer/sharer.php?u='.$url.'&t=[title]"><span class="like"></span></a>';

	// look for the pattern and append buttons
	$content = preg_replace_callback(
			$block_pattern, 
			function($matches) use($tweet_button, $facebook_button) {
                        	return $matches[1] . $matches[2] .
					'<span class="blockshare">' .
					str_replace('[title]', urlencode($matches[2]), $tweet_button) . 
					str_replace('[title]', urlencode($matches[2]), $facebook_button) .	// TODO: not hardcode this!
					'</span>' .
					$matches[3];
                	},
			$content);

	return $content;
}

function blockshare_menu() {
	add_options_page('BlockShare', 'BlockShare', 'manage_options', 'blockshare', 'build_options');
}

function build_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	include(WP_PLUGIN_DIR.'/blockshare/options.php'); 
}

function admin_init_blockshare() {
	register_setting('blockshare', 'bs_via');
	register_setting('blockshare', 'bs_pattern');
	register_setting('blockshare', 'bs_twitter');
	register_setting('blockshare', 'bs_facebook');
}

// this functions adds the stylesheet to the head
function block_share_styles() {
	//wp_register_style('doctypes_styles', plugins_url('kk-social-share-starter.css', __FILE__));
	//wp_enqueue_style('doctypes_styles');
}

// HOOKS =============

if ( is_admin() ){
	add_action('admin_menu', 'blockshare_menu');
	add_action('admin_init', 'admin_init_blockshare');
}

add_filter('the_content', 'block_share');
//add_action('wp_enqueue_scripts', 'block_share_styles');
