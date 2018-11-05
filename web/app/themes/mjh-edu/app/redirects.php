<?php
/**
 * Actions/Filter functions for code related to redirects
 */

/**
 * Redirect survivor taxonomy to related survivor-story post
 *
 * @hook init
 * @return null
 */

function redirects_survivor_taxonomy() {
	$path = '';
	if( !empty( $_SERVER['REDIRECT_URL'] ) ){
		$path =  $_SERVER['REDIRECT_URL'];
		$root_url = get_bloginfo('url');
		$pathHash = explode("/", substr($path, 1));
		$taxonomy = get_taxonomy( 'survivors' );
		if(is_array($pathHash) && !empty($taxonomy->rewrite['slug']) && $pathHash[0]=$taxonomy->rewrite['slug']) {
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
add_action('init', 'redirects_survivor_taxonomy',10, 0);