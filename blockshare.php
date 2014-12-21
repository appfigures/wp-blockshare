<?php
/*
Plugin Name: BlockShare
Plugin URI: http://arielmichaeli.com/plugins/blockshare
Description: Adds tweet/like buttons to blockquotes
Author: Ariel M./appFigures 2014
Author URI: http://arielmichaeli.com/
Version: 1.0
License: MIT
*/

function block_share($content) {
	// don't apply to unpublished posts because our url may not be correct
	if(get_post_status() != 'publish') return $content;

	$url = get_permalink();

	$twitter_via = get_option('bs_via');

	// text is left blank intentionally
	$tweet_button = '<a href="https://twitter.com/intent/tweet?text=[title]&url='.$url.'&via='.$twitter_via.'"><span class="icon-twitter"></span></a>';
	$facebook_button = '<a href="https://www.facebook.com/sharer/sharer.php?u='.$url.'&t=[title]"><span class="icon-facebook"></span></a>';

	// look for the pattern and append buttons
	$content = preg_replace_callback(
			get_pattern(), 
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

function get_pattern() {
        $opener = str_replace('/', '\/', get_option('bs_opener'));
        $closer = str_replace('/', '\/', get_option('bs_closer'));

	if(is_null_or_empty($opener) || is_null_or_empty($closer)) return '/(<blockquote[^>]*>)(.*?)(<\/blockquote>)/is';

	$pattern = '/('.$opener.')(.*?)('.$closer.')/is';
	return $pattern;
}

function is_null_or_empty($str) {
	return (!isset($str) || trim($str)==='');
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
	register_setting('blockshare', 'bs_opener');
	register_setting('blockshare', 'bs_closer');
	register_setting('blockshare', 'bs_twitter');
	register_setting('blockshare', 'bs_facebook');
	register_setting('blockshare', 'bs_custom_css');
}

// this functions adds the stylesheet to the head
function block_share_styles() {
	$custom_css = get_option('bs_custom_css');
	if($custom_css) return;

	wp_register_style('doctypes_styles', plugins_url('blockshare.css', __FILE__));
	wp_enqueue_style('doctypes_styles');
}

// HOOKS =============

if ( is_admin() ){
	add_action('admin_menu', 'blockshare_menu');
	add_action('admin_init', 'admin_init_blockshare');
}

add_filter('the_content', 'block_share');
add_action('wp_enqueue_scripts', 'block_share_styles');
