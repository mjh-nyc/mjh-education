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
			$cats = array();
			foreach ($survivors as $cat_id) {
				$cat = get_category($cat_id);
				$cats[] = array(
					'name' => $cat->name,
					'link' => get_term_link($cat->term_id),
					'survivors_current_image' => get_field('survivors_current_image','survivors_'.$cat->term_id),
					'survivors_past_image' => get_field('survivors_past_image','survivors_'.$cat->term_id),
				);
			}
			return $cats;
		}else{
			return array();
		}
	}
}