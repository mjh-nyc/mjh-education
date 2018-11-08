<?php
/**
 * Actions/Filter functions for post query
 */

/**
 * Hook to modify the post query
 *
 * @hook pre_get_posts
 * @return null
 */
function mjh_meta_query_category( $query ) {
	if($query->is_category() && empty($query->is_admin()) && !empty($query->is_main_query()) ){
		$query->set('posts_per_page', \App\Controllers\Category::categoryPostPerPage());
		$query->set('post_type', array('lessons','survivor_story','survivor_resources','timeline'));
	}
}
add_action( 'pre_get_posts', 'mjh_meta_query_category', 1 );