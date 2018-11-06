<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateTimelineListing extends Controller
{

	var $page_template = 'timeline';
	var $selected_survivor;

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
			return get_term_by('slug', $survivor_slug, 'survivors');
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
				if (!array_key_exists($year, $timelineHash)) {
					$timelineHash[$year] = array('world-events' => array());
				}
				$timelineHash[$year]['world-events'][] = $timeline_item->ID;
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
				foreach ($timelines_survivor as $timeline_item) {
					$year = get_field('timeline_year', $timeline_item->ID);
					if (!array_key_exists($year, $timelineHash)) {
						$timelineHash[$year] = array('survivor-stories' => array());
					}
					$timelineHash[$year]['survivor-stories'][] = $timeline_item->ID;
				}
			}
		}
		ksort($timelineHash);
		return $timelineHash;

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
	 * Get survivors
	 *
	 * @return array
	 */
	public function survivors()
	{
		return TemplateSurvivorsListing::getSurvivors();
	}
}