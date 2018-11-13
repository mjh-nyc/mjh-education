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
			case'/testimonies/':
				wp_redirect( $root_url.'/testimony-archives' );
				exit;
				break;
			case'/artifacts/':
				wp_redirect( $root_url.'/artifacts-archives' );
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
	if( !empty( $_SERVER['REDIRECT_URL'] ) ){
		$path =  $_SERVER['REDIRECT_URL'];
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
 * Redirect survivor and resource type taxonomy to related survivor-resource post
 *
 * @hook init
 * @return null
 */
function mjh_redirects_survivor_resources_category_taxonomy() {
	if( !empty( $_SERVER['REDIRECT_URL'] ) ){
		$path =  $_SERVER['REDIRECT_URL'];
		$pathHash = explode("/", substr($path, 1));
		if(is_array($pathHash) && $pathHash[0]=='survivor-resources') {
			if(!empty($pathHash[1]) && !empty($pathHash[2]) ){
				$termSlug = sanitize_title_for_query($pathHash[1]);
				$termSurvivors = get_term_by( 'slug', $termSlug, 'survivors');
				$termSlug = sanitize_title_for_query($pathHash[2]);
				$termResourceCategory = get_term_by( 'slug', $termSlug, 'resource_category');
				if(!empty($termSurvivors) && !empty($termResourceCategory)){
					$pParamHash = array('resource_category_term_id' => $termResourceCategory->term_id ,'survivors_term_id' => $termSurvivors->term_id );
					$survivor_resource = \App\Controllers\SingleSurvivor_resources::getResourceBySurvivorResourceCategory($pParamHash);
					if($survivor_resource->post_count) {
						$post = $survivor_resource->next_post();
						wp_redirect(get_permalink($post->ID));
						exit();
					}
				}
			}

		}
	}
}
add_action('init', 'mjh_redirects_survivor_resources_category_taxonomy',10, 0);

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

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @hook login_redirect
 * @return string
 */

function mjh_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if (isset($user->roles) && is_array($user->roles)) {
		//check for subscribers
		if (in_array('subscriber', $user->roles)) {
			// redirect them to another URL, in this case, the homepage
			$redirect_to =  home_url().'/my-account';
		}
	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'mjh_login_redirect', 10, 3 );