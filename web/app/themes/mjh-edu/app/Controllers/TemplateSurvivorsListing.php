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
		$survivors = TemplateSurvivorsListing::getSurvivors();
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
	 * Get survivors listing
	 *
	 * @return array
	 */
	public static function getSurvivors(){
		return get_terms( array(
			'taxonomy' => 'survivors',
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC'
		) );
	}
	
	/**
	 * Get survivors permalink to their tagged survivor_story post type. Default to term link if no post found
	 *
	 * @return string
	 */
	private function getInitSurvivorStoryPostLink($term_id){
		$pParamHash = array('posts_per_page'=>1,'term_id' => $term_id );
		$survivor_stories = SingleSurvivor_story::getSurvivorStoriesBySurvivor($pParamHash);
		if($survivor_stories->post_count){
			$post = $survivor_stories->next_post();
			return get_permalink($post->ID);
		}else{
			return get_term_link($term_id);
		}
	}
}