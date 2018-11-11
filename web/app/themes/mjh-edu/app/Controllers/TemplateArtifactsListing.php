<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateArtifactsListing extends Controller
{
	var $artifacts;

    public function artifacts()
    {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array( 
            'post_type' => 'artifacts',
            'posts_per_page' => 9,
            'post_status' => 'publish',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'paged'=>$paged
        );
       
	    $this->artifacts = new WP_Query( $args);
        if($this->artifacts->posts){
            return $this->artifacts->posts;
        }else{
            return false;
        }
    }
    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPages() {
        return $this->artifacts->max_num_pages;
    }
	
}