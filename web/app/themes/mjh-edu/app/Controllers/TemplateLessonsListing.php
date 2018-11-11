<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateLessonsListing extends Controller
{
	/**
	 * Constructor
	 *
	 * @return none
	 */
	public function TemplateLessonsListing()
	{

	}

	/**
	 * Get lessons listing
	 *
	 * @return array
	 */
	public function lessons(){
		return TemplateLessonsListing::getLessons();

	}
	/**
	 * Get lessons listing
	 *
	 * @return array
	 */
	public static function getLessons(){
		$args = array(
			'post_type' => 'lessons',
			'post_status' => 'publish',
			'posts_per_page'   => -1,
			'orderby' => 'menu_order',
			'order' => 'asc',
		);
		$lessons = new WP_Query( $args);
		if($lessons->post_count){
			return $lessons->posts;
		}else{
			return array();
		}
	}

}