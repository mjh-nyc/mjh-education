<?php
//https://discourse.roots.io/t/sage9-controller-for-single-custom-post-type/13818/2
namespace App\Controllers;

use Sober\Controller\Controller;

class SingleSurvivor_resources extends Controller
{

	/**
     * Get quiz questions for the Geography Quiz Resource page
     *
     * @return intval
     */
    public static function get_quiz_questions_count($id=false)
    {
        if (!$id){
            $id = get_the_ID();
        }
        $quizQuestionCount = count(App::get_repeater_field('quiz_questions',$id));
        if ($quizQuestionCount > 0) {
        	return $quizQuestionCount;
        } else {
        	return 0;
        }
    }

	/**
     * Get quiz questions for the Geography Quiz Resource page
     *
     * @return array
     */
    public static function get_quiz_questions($id=false)
    {
        if (!$id){
            $id = get_the_ID();
        }
        $questions = App::get_repeater_field('quiz_questions');
        return $questions;
    }

    /**
     * Get quiz questions for the Geography Quiz Resource page
     *
     * @return string
     */
    public static function get_next_quiz_question($id=false)
    {
        if (!$id){
            $id = get_the_ID();
        }
        $current_question = App::get_uri_param('question');
        if ($current_question < SingleSurvivor_resources::get_quiz_questions_count()-1) {
        	$current_question++;
        	$link = get_the_permalink($id).'?question='.$current_question;
        	return $link;
        } else {
        	return false;
        }
    }

	/**
	 * Get survivor label for current survivor resource
	 *
	 * @return string
	 */
	public function survivor(){
		return SingleSurvivor_story::getSurvivor();
	}

	/**
	 * Get media resources for this post
	 *
	 * @return array
	 */
    public function mediaResources(){
		if($this->checkResourceCategory('media-resources')){
			//Get media resource fields
			$mediaResourcesHash = array();
			//Books
			$mediaResourcesHash['books'] = get_field('select_books');
			//Website
			$mediaResourcesHash['websites'] = get_field('select_websites');
			//Films
			$mediaResourcesHash['films'] = get_field('select_films');
			return $mediaResourcesHash;
		}
		return array();
	}

	/**
	 * Check resource_category type of this post
	 *
	 * @return boolean
	 */
	private function checkResourceCategory($term_slug){
		$terms = wp_get_post_terms(get_the_ID(),'resource_category');
		if(!empty($terms)){
			foreach($terms as $term){
				if($term_slug == $term->slug){
					return true;
				}
			}
		}
		return false;
	}
}

