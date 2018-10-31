<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
	/**
	 * Set variable for ACF `feature` group, field name `custom_feature`
	 *
	 * @return array
	 */
	public function featureCustomFeature(){
		$customFeatureObj = App::get_group_field('features', 'custom_feature');
		if(!empty($customFeatureObj) && !empty($customFeatureObj->ID) ){
			return App::setFeaturePostObjects($customFeatureObj);
		}
		return false;
	}
}
