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
}

