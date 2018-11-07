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
function mjh_meta_query( $query ) {
	if($query->is_category && empty($query-> is_admin) ){
		$query->set('posts_per_page', 9);
		$query->set('post_type', array('lessons','survivor_story','survivor_resources'));
	}
}
add_action( 'pre_get_posts', 'mjh_meta_query', 1 );