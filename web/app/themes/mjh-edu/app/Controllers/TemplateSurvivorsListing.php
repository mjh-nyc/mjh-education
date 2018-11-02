<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateSurvivorsListing extends Controller
{
	/**
	 * Constructor
	 *
	 * @return none
	 */
	public function TemplateSurvivorsListing()
	{

	}
	/**
	 * Get survivors listing
	 *
	 * @return array
	 */
	public function survivors(){
		$survivors = get_terms( array(
			'taxonomy' => 'survivors',
			'hide_empty' => false,
		) );
		if (!empty($survivors)) {
			$terms = array();
			foreach ($survivors as $term_id) {
				$term = get_category($term_id);
				$terms[] = array(
					'name' => $term->name,
					'link' => $this->getInitSurvivorStoryPostLink($term_id),
					'survivors_current_image' => get_field('survivors_current_image','survivors_'.$term->term_id),
					'survivors_past_image' => get_field('survivors_past_image','survivors_'.$term->term_id),
				);
			}
			return $terms;
		}else{
			return array();
		}
	}
	/**
	 * Get survivors permalink to their tagged survivor_story post type. Default to term link if no post found
	 *
	 * @return string
	 */
	private function getInitSurvivorStoryPostLink($term_id){
		$args = array(
			'post_type' => 'survivor_story',
			'posts_per_page' => 1,
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'survivors',
					'field'    => 'term_id',
					'terms'    => $term_id,
				),
			),
			'orderby' => 'menu_order',
			'order' => 'asc',
		);
		$survivor_stories = new WP_Query( $args);
		if($survivor_stories->post_count){
			$post = $survivor_stories->next_post();
			return get_permalink($post->ID);
		}else{
			return get_term_link($term_id);
		}
	}
}