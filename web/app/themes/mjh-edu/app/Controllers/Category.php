<?php
namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class Category extends Controller
{
	var $paged = 1;
	var $posts_per_page;
	/**
	 * Constructor
	 *
	 */
	function Category()
	{
		$this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$this->posts_per_page = Category::categoryPostPerPage();
	}
	/**
	 * Get the $wp_query object which has the posts. Using WP core query ( view query_alter for config)
	 *
	 * @return object
	 */
	function categoryPosts(){
		global $wp_query;
		return $wp_query;
	}
	/**
	 * Calculate the counter start point for listing
	 *
	 * @return int
	 */
	public function currentStartCount(){
		$multiplier = $this->paged- 1;
		return $multiplier * $this->posts_per_page;
	}

	/**
	 * Get taxonomy information
	 *
	 * @return int
	 */
	public function catgoryTaxonomy(){
		return get_taxonomy( 'category' );
	}

	/**
	 * Static function to get post per page
	 *
	 * @return int
	 */
	public static function categoryPostPerPage(){
		return 9;
	}

}