<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateTimelineListing extends Controller
{

	var $page_template = 'timeline';
	var $selected_survivor;
	var $selected_survivor_timeline_init_post_id;

	/**
	 * Constructor
	 *
	 * @return none
	 */
	public function TemplateTimelineListing()
	{

	}

	/**
	 * Get survivor story querystring
	 *
	 * @return string
	 */
	public function survivorStoryQueryVar(){
		$slug = get_query_var('survivor-story');
		if( !empty($slug) ){
			return trim($slug);
		}else{
			return '';
		}
	}

	/**
	 * Get survivors term by slug
	 *
	 * @return array
	 */
	public function survivorTerm(){
		$survivor_slug = $this->survivorStoryQueryVar();
		if(!empty($survivor_slug)) {
			$this->selected_survivor = get_term_by('slug', $survivor_slug, 'survivors');
			return $this->selected_survivor;
		}
		return false;
	}

	public function survivorImage(){
		if($this->selected_survivor){
			$img = get_field('survivors_past_image','survivors_'.$this->selected_survivor->term_id);
			if(!empty($img)){
				return $img['sizes']['thumbnail'];
			}
		}
		return false;
	}

	/**
	 * Get lessons listing
	 *
	 * @return array
	 */
	public function timelines(){
		$pParamHash = array();
		$term = get_term_by( 'slug', 'world-events', 'timeline_category' );
		if(!empty($term)){
			$pParamHash['tax_query'][] = array(
				'taxonomy' => 'timeline_category',
				'field'    => 'term_id',
				'terms'    => $term->term_id,
			);
		}
		$timelines = TemplateTimelineListing::getTimeline($pParamHash);
		$timelineHash = array();
		if($timelines) {
			foreach ($timelines as $timeline_item) {
				$year = get_field('timeline_year', $timeline_item->ID);
				$timestamp = $this->getTimestamp($timeline_item->ID);

				if (!array_key_exists($year, $timelineHash)) {
					$timelineHash[$year] = array('world-events' => array());
				}
				$item =array('post_id'=>$timeline_item->ID,'related_items'=>array());
				$terms = App::postTerms($timeline_item->ID, 'category');
				if($terms){
					foreach($terms as $term){
						$termsHash[] = $term->term_id;
					}
					$related_items =  App::getRelatedPostByTerm($termsHash,'category',$timeline_item->ID, array('lessons','survivor_story','survivor_resources'));
					if(!empty($related_items->post_count)){
						$item['related_items'] = $related_items->posts;
					}
				}
				$timelineHash[$year]['world-events'][$timestamp] = $item;
				ksort($timelineHash[$year]['world-events']);
			}
		}
		$survivor_term = $this->survivorTerm();
		if(!empty($survivor_term)){
			$term = get_term_by( 'slug', 'survivor-stories', 'timeline_category' );
			if(!empty($term) ){
				$pParamHashSurvivor = array();
				$pParamHashSurvivor['tax_query'][] = array(
					'taxonomy' => 'timeline_category',
					'field'    => 'term_id',
					'terms'    => $term->term_id,
				);
				$pParamHashSurvivor['tax_query'][] = array(
					'taxonomy' => 'survivors',
					'field'    => 'term_id',
					'terms'    => $survivor_term->term_id,
				);
				$timelines_survivor = TemplateTimelineListing::getTimeline($pParamHashSurvivor);
			}
			if($timelines_survivor) {
				foreach ($timelines_survivor as $key => $timeline_item) {
					$timestamp = $this->getTimestamp($timeline_item->ID);
					$year = get_field('timeline_year', $timeline_item->ID);
					if (!array_key_exists($year, $timelineHash)) {
						$timelineHash[$year] = array('survivor-stories' => array());
					}
					$item =array('post_id'=>$timeline_item->ID);
					$timelineHash[$year]['survivor-stories'][$timestamp] = $item;
					ksort($timelineHash[$year]['survivor-stories']);
					if($key==0){
						$this->selected_survivor_timeline_init_post_id = $timeline_item->ID;
					}

				}
			}
		}
		ksort($timelineHash);
		return $timelineHash;
	}

	/**
	 * Get timestamp for timeline hash
	 *
	 * @return timestamp
	 */
	private function getTimestamp($post_id){
		$year = get_field('timeline_year', $post_id);
		if(!$month = get_field('timeline_month', $post_id)){
			$month = 1;
		}
		if(!$day = get_field('timeline_day', $post_id)){
			$day = 1;
		}
		return strtotime($year.'-'.$month.'-'.$day);
	}
	/**
	 * Get lessons listing
	 *
	 * @return array
	 */
	public static function getTimeline($pParamHash){
		$args = array(
			'post_type' => 'timeline',
			'post_status' => 'publish',
			'posts_per_page'   => -1,
			'meta_key' => 'timeline_year',
			'orderby' => 'meta_value',
			'order' => 'asc',
		);
		$args = array_merge($args, $pParamHash);
		$timeline = new WP_Query( $args);
		if($timeline->post_count){
			return $timeline->posts;
		}else{
			return array();
		}

	}

	/**
	 * Getter for page_template
	 *
	 * @return string
	 */
	public function pageTemplate()
	{
		return $this->page_template;
	}

	/**
	 * Getter for selected_survivor
	 *
	 * @return string
	 */
	public function selectedSurvivor()
	{
		return $this->selected_survivor;
	}

	/**
	 * Getter for selected_survivor
	 *
	 * @return string
	 */
	public function selectedSurvivorTimelineInitPostId()
	{
		return $this->selected_survivor_timeline_init_post_id;
	}


	/**
	 * Get survivors
	 *
	 * @return array
	 */
	public function survivors()
	{
		return TemplateSurvivorsListing::getSurvivors();
	}
}