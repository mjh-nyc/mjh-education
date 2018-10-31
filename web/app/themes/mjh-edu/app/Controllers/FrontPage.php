<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
	/**
	 * Set variable for ACF `feature` group, field name `featured_lesson_plan`
	 *
	 * @return array
	 */
	public function featureLessonPlan(){
		$customFeatureObj = App::get_group_field('features', 'featured_lesson_plan');
		if(!empty($customFeatureObj) && !empty($customFeatureObj->ID) ){
			return App::setFeaturePostObjects($customFeatureObj);
		}
		return false;
	}
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
	/**
	 * Set variable for ACF `secondary_features` group, get all fields into an array
	 *
	 * @return array
	 */
	public function featureSecondaryFeatures(){
		$group_secondary_features = App::get_group_field('secondary_features');
		if(!empty($group_secondary_features)  ){
			$featureHash = array();
			foreach($group_secondary_features as $key=>$secondary_feature){
				if(!empty($secondary_feature->ID) ) {
					$featureHash[$key] = App::setFeaturePostObjects($secondary_feature);
				}
			}
			return $featureHash;
		}
		return false;
	}
}
