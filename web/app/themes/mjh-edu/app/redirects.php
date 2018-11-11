<?php
/**
 * Actions/Filter functions for code related to redirects
 */

/**
 * Redirect events archive to customize listing
 *
 * @hook init
 * @return null
 */
function mjh_redirects_events() {
	if( !empty( $_SERVER['REDIRECT_URL'] ) ){
		$path =  $_SERVER['REDIRECT_URL'];
		$root_url = get_bloginfo('url');

		switch($path){
			case'/events/':
				wp_redirect( $root_url.'/current-events' );
				exit;
				break;
		}

		switch($path){
			case'/lessons/':
				wp_redirect( $root_url.'/lesson-plans' );
				exit;
				break;
		}
	}
}
add_action( 'init', 'mjh_redirects_events' );

/**
 * Redirect glossary post to glossary listing by hash
 *
 * @hook template_redirect
 * @return null
 */
function mjh_glossary_redirect_post() {
	global $post;
	$queried_post_type = get_query_var('post_type');
	if ( is_single() && 'glossary' ==  $queried_post_type ) {
		$root_url = get_bloginfo('url');
		wp_redirect( $root_url.'/glossary/#'.$post->post_name, 301 );
		exit;
	}
}
add_action( 'template_redirect', 'mjh_glossary_redirect_post' );

/**
 * Redirect survivor taxonomy to related survivor-story post
 *
 * @hook init
 * @return null
 */
function mjh_redirects_survivor_taxonomy() {
	$path = '';
	if( !empty( $_SERVER['REDIRECT_URL'] ) ){
		$path =  $_SERVER['REDIRECT_URL'];
		$root_url = get_bloginfo('url');
		$pathHash = explode("/", substr($path, 1));
		$taxonomy = get_taxonomy( 'survivors' );
		if(is_array($pathHash) && !empty($taxonomy->rewrite['slug']) && $pathHash[0]==$taxonomy->rewrite['slug']) {
			if(!empty($pathHash[1])){
				$term = sanitize_title_for_query($pathHash[1]);
				$term = get_term_by( 'slug', $term, $taxonomy->name);
				if(!empty($term)){
					$pParamHash = array('posts_per_page'=>1,'term_id' => $term->term_id );
					$survivor_story = \App\Controllers\SingleSurvivor_story::getSurvivorStoriesBySurvivor($pParamHash);
					if($survivor_story->post_count) {
						$post = $survivor_story->next_post();
						wp_redirect(get_permalink($post->ID));
						exit();
					}
				}
			}

		}
	}
}
add_action('init', 'mjh_redirects_survivor_taxonomy',10, 0);

/**
 * Add query_var for timeline dropdown
 *
 * @hook query_vars
 * @return array
 */
function mjh_add_query_vars_timeline($aVars) {
	$aVars[] = "survivor-story";
	return $aVars;
}
add_filter('query_vars', 'mjh_add_query_vars_timeline');

/**
 * Add rewrite rule for timeline dropdown pretty url
 *
 * @hook rewrite_rules_array
 * @return array
 */
function mjh_add_rewrite_rules_timeline($aRules) {
	$aNewRules = array('timeline/survivor-story/([^/]+)/?$' => 'index.php?pagename=timeline&survivor-story=$matches[1]');
	$aRules = $aNewRules + $aRules;
	return $aRules;
}
add_filter('rewrite_rules_array', 'mjh_add_rewrite_rules_timeline');