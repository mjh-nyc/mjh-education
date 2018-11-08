<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateCategoryListing extends Controller
{
	/**
	 * Constructor
	 *
	 * @return none
	 */
	public function TemplateCategoryListing()
	{

	}
	/**
	 * Get category taxonomy listing
	 *
	 * @return array
	 */
	public function categories(){
		$categories = get_categories( );
		if (!empty($categories)) {
			return $categories;
		}else{
			return array();
		}
	}
}