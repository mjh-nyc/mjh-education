<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    /**
     * Return repeater field from Advanced Custom Fields
     *
     * @return array
     */
    public static function get_repeater_field($fieldname, $id=false)
    {
        //setup array holder
        $repeater_items = array();
        if (!$id){
            $id = get_the_ID();
        }
        // check if the repeater field has rows of data
        if( $fieldname && have_rows($fieldname,$id) ):
            $repeater_items = get_field($fieldname,$id);
        endif;
        return $repeater_items;
    }

    /**
     * Return a single ACF pro field, if $id is empty, will use current post's id
     * $fieldname must be passed
     *
     * @return varchar
     */
    public static function get_field($fieldname, $id=false)
    {
        $field_value = "";
        if (!$id){
            $id = get_the_ID();
        }
        if ($fieldname) {
            return get_field($fieldname,$id);
        } else {
            return false;
        }
    }
}
