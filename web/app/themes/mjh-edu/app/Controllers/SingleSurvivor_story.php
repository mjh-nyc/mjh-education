<?php
namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class SingleSurvivor_story extends Controller
{
	var $survivor_stories;

	/**
	 * Get survivor label for current survivor story post
	 *
	 * @return string
	 */
	public function survivor(){
		return SingleSurvivor_story::getSurvivor();
	}

	/**
	 * Static function to Get survivor label
	 *
	 * @return string
	 */
	public static function getSurvivor() {
		return App::postTermsString(get_the_ID(),'survivors');
	}

	/**
	 * Get current survivors total survivor stories posts
	 *
	 * @return array
	 */
	public function survivorStoriesChapters()
	{
		$survivor_terms = App::postTerms(get_the_ID(), 'survivors');
		if (!empty($survivor_terms)) {
			$survivor_term = array_shift($survivor_terms);
			$pParamHash = array('term_id' => $survivor_term->term_id);
			$survivor_stories = SingleSurvivor_story::getSurvivorStoriesBySurvivor($pParamHash);
			if ($survivor_stories->post_count) {
				$this->survivor_stories = $survivor_stories;
				return $survivor_stories->posts;
			}
		}
		return array();
	}

	/**
	 * Get previous/next survivor story based on results from survivorStoriesChapters
	 *
	 * @return array
	 */
	public function survivorStoryNextPrev(){
		if ($this->survivor_stories->post_count) {
			$posts = array();
			foreach ($this->survivor_stories->posts as $post) {
				$posts[] = $post->ID;
			}
			$current = array_search(get_the_ID(), $posts);
			$postNav = array('previous'=>0,'next'=>0);
			if(!empty($posts[$current - 1])){
				$postNav['previous'] =  $posts[$current - 1];
			}
			if(!empty($posts[$current + 1])){
				$postNav['next'] =  $posts[$current + 1];
			}
			return $postNav;
		}
		return array();
	}
	/**
	 * Static function to get survivor stories by survivor term
	 *
	 * @return object
	 */
	public static function getSurvivorStoriesBySurvivor($pParamHash){
		$args = array(
			'post_type' => 'survivor_story',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'survivors',
					'field'    => 'term_id',
					'terms'    => $pParamHash['term_id'],
				),
			),
			'orderby' => 'menu_order',
			'order' => 'asc',
		);
		if(!empty($pParamHash['posts_per_page'])){
			$args['posts_per_page'] = $pParamHash['posts_per_page'];
		}
		return new WP_Query($args);
	}
}

