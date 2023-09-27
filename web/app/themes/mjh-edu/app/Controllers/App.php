<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class App extends Controller
{
	/**
	 * Get site name
	 *
	 * @return string
	 */
    public function siteName()
    {
        return get_bloginfo('name');
    }
	/**
	 * Get page title
	 *
	 * @return string
	 */
    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
		if (is_category()) {
			return sprintf(__('Theme Results: %s', 'sage'), get_query_var('category_name'));
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
	 * Return permalink
	 *
	 * @return varchar
	 */
	public static function getPermalink($id = false)
	{
		if($id){
			return get_permalink($id);
		}
		return get_permalink();
	}


	/**
	 * Return site logo image hash
	 *
	 * @return varchar
	 */
	public static function siteLogo()
	{
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		//print_r($image);
		//break;
		return $image[0];
	}

	/**
	 * Return featured image of post
	 *
	 * @return html
	 */
	public static function featuredImage($size='large',$id=false)
	{
		$image = "";
		if (!$id){
			$id = get_the_ID();
		}
		if (has_post_thumbnail( $id ) ) {
			$image = get_the_post_thumbnail( $id, $size );
		}
		return $image;
	}


	/**
	 * Return featured image description (used for photo credits)
	 *
	 * @return string
	 */
	public static function featuredImageDesc($id=false)
	{
		$image_desc = "";
		if ($id) {
			$image_desc = get_post($id)->post_content;
		}
		return $image_desc;
	}

	/**
	 * Return image thumbnail with attachmend id
	 *
	 * @return string
	 */
	public static function getAttachmentById($attachment_id=false,$size='large')
	{
		if($attachment_id){
			return wp_get_attachment_image_url( $attachment_id, $size );
		}
	}

	/**
	 * Return the post title, if no ID provided, will use current post id
	 *
	 * @return string
	 */
	public static function postTitle($id=false)
	{
		if (!$id){
			$id = get_the_ID();
		}
		return get_the_title($id);
	}

	/**
	 * Return the post categories
	 *
	 * @return array
	 */
	public static function postCategories($id=false)
	{
		if (!$id) {
			$id = get_the_ID();
		}
		$post_categories = wp_get_post_categories($id);
		if (!empty($post_categories)) {
			$cats = array();
			foreach ($post_categories as $cat_id) {
				$cat = get_category($cat_id);
				$cats[] = array('name' => $cat->name, 'link' => get_term_link($cat->term_id));
			}
			return $cats;
		}else{
			return array();
		}
	}

	/**
	 * Set themes taxonomy globally since shared among various content types
	 *
	 * @return array
	 */
	public function themes(){
		return App::postCategories();
	}

	/**
	 * Return the post terms
	 *
	 * @return array
	 */
	public static function postTerms($id=false, $taxonomy = '')
	{
		if (!$id){
			$id = get_the_ID();
		}
		return get_the_terms($id,$taxonomy);
	}


	/**
	 * Return the post categories in a string
	 *
	 * @return string
	 */
	public static function postTermsString($id=false, $taxonomy = '')
	{
		$terms = App::postTerms($id, $taxonomy);
		$term_string = '';
		if(!empty($terms)){
			foreach ($terms as $key=> $term){
				if($key > 0){
					$term_string.=", ";
				}
				$term_string.=$term->name;
			}
		}
		return $term_string;
	}

	/**
	 * Return the post categories in a string
	 *
	 * @return object
	 */
	public static function getRelatedPostByTerm($terms,$taxonomy,$post_id_exclude=false, $post_type_include = false)
	{
		$args = array(
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $terms,
				),
			),
			'orderby' => 'menu_order',
			'order' => 'asc',
		);

		if(!empty($post_type_include)){
			$args['post_type']  = $post_type_include;
		}

		if(!empty($post_id_exclude)){
			$args['post__not_in'] = array($post_id_exclude);
		}

		return new WP_Query($args);
	}


	/**
	 * Return the post excerpt, if no ID provided, will use current post id
	 *
	 * @return string
	 */
	public static function postExcerpt($id=false)
	{

		if (!$id){
			$id = get_the_ID();
		}

		if (has_excerpt($id)) {
			$excerpt = get_the_excerpt($id);
			$excerpt = App::truncateString($excerpt, 16);

			//also if the title is too long, hide the description
			//if (strlen(get_the_title($id)) >30) {
				//return false;
			//} else {
				return $excerpt;
			//}
		} else {
			return false;
		}

	}
	//used by various functions to truncate the string to specified number of words
	public static function truncateString($string, $limit=5) {
		if ($string) {
			if (str_word_count($string, 0) > $limit) {
				$words = str_word_count($string, 2);
				$pos = array_keys($words);
				$string = substr($string, 0, $pos[$limit]) . '...';
			}
			return $string;
		}
	}
	/**
	 * Return a formatted post array for featured posts,
	 *
	 * @postObj WP Post Object
	 * @return array
	 */
	public static function setFeaturePostObjects( $postObj ){
		if(is_object($postObj) && !empty($postObj->ID)) {
			$postHash = array();
			$postHash['ID'] = $postObj->ID;
            $postHash['post_type_label'] = get_post_type_object($postObj->post_type)->label;
			return $postHash;
		}else{
			return false;
		}
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

    /**
     * Get URL param
     *
     * @return intval
     */
    public static function get_uri_param($param)
    {
        if (!empty($_GET[$param])) {
            return $_GET[$param];
        } else {
            return 0;
        }
    }

    /**
     * get field data from a group
     *
     * @return varchar
     */
    public static function get_group_field($groupname, $fieldname=false, $id=false)
    {
        $field_value = "";
        if (!$id){
            $id = get_the_ID();
        }
        $groupname = get_field($groupname);
        if( $groupname ) {
			if(empty($fieldname)){
				return $groupname;
			}else {
				return $groupname[$fieldname];
			}
        }  else {
            return false;
        }

    }


    /**
     * Return featured image of post src only
     *
     * @return string
     */
    public static function featuredImageSrc($size='large',$id=false)
    {
        $image = "";
        if (!$id){
            $id = get_the_ID();
        }
        if (has_post_thumbnail( $id ) ) {
        	$thumb_id = get_post_thumbnail_id($id);
        	$thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
            $image = $thumb_url_array[0];
        } else {
            //use default image entered under social in theme toptions
            $image = get_field('social','option');
        }
        return $image;
    }

    /**
     * Return featured image alt, pass post ID
     *
     * @return string
     */
    public static function featuredImageAlt($id=false)
    {
        $image_alt = "";
        if ($id) {
        	$img_id  = get_post_thumbnail_id($id);
 			$image_alt = get_post_meta($img_id,'_wp_attachment_image_alt', true);
        }
        return $image_alt;
    }

    /**
     * Return featured image caption, pass post ID
     *
     * @return string
     */
    public static function featuredImageCaption($id=false)
    {
        $image_caption = "";
        if ($id) {
        	$thumbnail_id    = get_post_thumbnail_id($id);
  			$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

			if ($thumbnail_image && isset($thumbnail_image[0])) {
				$image_caption = $thumbnail_image[0]->post_excerpt;
			}
        }
        return $image_caption;
    }


	/**
	 * Check current template with variable
	 *
	 * @return boolean
	 */
	public static function isPageTemplate($page_template){
		$currentPageTemplate = get_page_template_slug();
		if($currentPageTemplate == $page_template){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * Get current page slug
	 *
	 * @return string
	 */
	public static function getCurrentPageSlug() {
		global $post;
		$post_slug=$post->post_name;
		return $post_slug;
	}

	/**
	 * Compares start and end date and cleans output if same day
	 *
	 * @return string
	 */
	public static function cleanDateOutput($start_date, $end_date){
		if( empty($end_date) ){
			return $start_date;
		}
		$start_date_day = date('Y-m-d', strtotime($start_date));
		$end_date_day = date('Y-m-d', strtotime($end_date));
		if($start_date_day == $end_date_day ){
			$date_output = $start_date;
		}else{
			$date_output = date('M j', strtotime($start_date))." &#8211; ".date('M j, Y', strtotime($end_date));
		}
		return $date_output;
	}
	/**
	 * Evaluate if an event is PAST, returns true if past, requires start and end dates
	 *
	 * @return bool
	 */
	public static function evalEventStatus($start_date, $end_date){
		return app::evalDateStatus($start_date, $end_date);
	}
	/**
	 * Evaluate if date is in the past
	 *
	 * @return bool
	 */
	public static function evalDateStatus($start_date, $end_date){
		//convert to timestamp
		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
		date_default_timezone_set('America/New_York');
		$now = strtotime('yesterday 11:59:59');
		if (!$start_date && !$end_date) {
			return false;
		} elseif($start_date == $end_date || !$end_date){
			//just look at the start date
			if ($now > $start_date) {
				return true; //passed
			} else {
				return false;
			}
		} else {
			//if the end date is in the future, this is not a past event
			//use the end date for comparison
			if ($now > $end_date) {
				return true; //passed

			} else {
				return false;
			}
		}
	}

	/**
	 * Get secondary nav items, pass current page/post ID
	 *
	 * @return array
	 */
	public static function getSubPageNav($id=false){
		if (!$id){
			$id = get_the_ID();
		}
		$pages = array();

		if (App::is_child($id) || App::is_ancestor($id)) {
			$parent_id = App::get_parent_id($id);
			$pages = App::get_submenu($parent_id);
		}
		return $pages;
	}
	/**
	 * Get Parent id (used from template as well, hence public declaration)
	 *
	 * @return int
	 */
	public static function get_parent_id( $id ) {
		$parent_id = wp_get_post_parent_id($id);
		if ($parent_id == 0) {
			//this is the parent, use its id
			$parent_id = $id;
		}
		return $parent_id;
	}
	/**
	 * Check if page is direct child
	 *
	 * @return boolean
	 */
	private static function is_child( $id ) {

		if( is_page() && (wp_get_post_parent_id( $id ) > 0) ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Check if page is an ancestor
	 *
	 * @return boolean
	 */
	public static function is_ancestor( $id ) {
		$children = get_pages( array( 'child_of' => $id ) );
		if( count( $children ) == 0 ) {
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Get the subnav page links
	 *
	 * @return array
	 */
	private static function get_submenu($parent) {
		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'menu_order',
			'hierarchical' => 1,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => $parent,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		);
		$pages = get_pages($args);
		return $pages;
	}
	/**
	 * Format pagination as numbered links
	 *
	 * @return string
	 */
	public static function get_posts_nav() {
		$args = array(
			'mid_size'           => 4,
			'prev_next'          => false,
		);
		$pagination = get_the_posts_pagination( $args );

		return $pagination;
	}
	/**
	 * Pagination for custom WP_Query executions
	 *
	 * @return string
	 */
	public static function paginate_links ($max_num_pages){
		$big = 999999999; // need an unlikely integer
		return paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'mid_size'  => 4,
			'prev_next' => false,
			'add_args' => true,
			'total' => $max_num_pages
		) );
	}

	/**
     * Return account links
     *
     * @return varchar
     */
    public static function get_account_links()
    {
    	$account_links='<a href="/my-account/" class="account-link animsition-link"><i class="fa fa-user-circle-o" aria-hidden="true"><span class="sr-only">{{ __("My Account / Log in","sage") }}</span></i></a>';
    	return $account_links;
    }

    /**
     * Get social channels, these come from the ACF options page under Settings-->Theme Options
     *
     * @return varchar
     */
    public static function get_social()
    {
        $social="";
        $facebook = get_field('facebook_link', 'option');
        $twitter = get_field('twitter_handle', 'option');
        $instagram = get_field('instagram_handle', 'option');
        $youtube = get_field('youtube_link', 'option');
        $young_friends = get_field('young_friends', 'option');

        if ($facebook) {
            $social .='<a href="'.$facebook.'" target="_blank" onclick="return trackOutboundLink(\''.$facebook.'\', true)"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
        }
        if ($twitter) {
            $social .='<a href="https://twitter.com/'.$twitter.'" target="_blank" onclick="return trackOutboundLink(\'https://twitter.com/'.$twitter.'\', true)"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
        }
        if ($instagram) {
            $social .='<a href="https://www.instagram.com/'.$instagram.'" target="_blank" onclick="return trackOutboundLink(\'https://www.instagram.com/'.$instagram.'\', true)"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
        }
        if ($youtube) {
            $social .='<a href="'.$youtube.'" target="_blank" onclick="return trackOutboundLink(\''.$youtube.'\', true)"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>';
        }
        if ($young_friends) {
            $social .='<a href="'.$young_friends.'" target="_blank" onclick="return trackOutboundLink(\''.$young_friends.'\', true)" class="yf"><img src="'.get_stylesheet_directory_uri().'/dist/images/young-friends.png" alt="'.__("Young Friends","sage").'"></a>';
        }

        return $social;
    }

    /**
	 * Modification of wp_link_pages() with an extra element to highlight the current page.
	 *
	 * @param  array $args
	 * @return void
	 */
	public static function numbered_in_page_links( $args = array () )
	{
	    $defaults = array(
	        'before'      => '<div class="chapter-nav__links">'
	    ,   'after'       => '</div>'
	    ,   'link_before' => ''
	    ,   'link_after'  => ''
	    ,   'pagelink'    => '%'
	    ,   'echo'        => 1
	        // element for the current page
	    ,   'highlight'   => 'span'
	    );

	    $r = wp_parse_args( $args, $defaults );
	    $r = apply_filters( 'wp_link_pages_args', $r );
	    extract( $r, EXTR_SKIP );

	    global $page, $numpages, $multipage, $more, $pagenow;

	    if ( ! $multipage )
	    {
	        return;
	    }

	    $output = $before;

	    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
	    {
	        $j       = str_replace( '%', $i, $pagelink );
	        $output .= ' ';

	        if ( $i != $page || ( ! $more && 1 == $page ) )
	        {
	            $output .= _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>";
	        }
	        else
	        {   // highlight the current page
	            // not sure if we need $link_before and $link_after
	            $output .= "<$highlight>{$link_before}{$j}{$link_after}</$highlight>";
	        }
	    }

	    return $output . $after;
	}
    /**
     * Verify user is logged out
     *
     */
	public static function verifyUserLoggedOut(){
		if(is_user_logged_in() ){
			wp_redirect( home_url() );
			exit;
		}
	}
    /**
     * Check if user signed up cookie is set
     *
     * @return boolean
     */
    public static function userSignedUp(){
        if( !empty($_COOKIE['mjhedu_signed_up']) ){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Get site navigations from MJH via rest api
     *
     * @return array
     */
    public function siteNavigations()
    {
        $navigations = array();
        $mjh_navigation_rest_api_url = get_field('mjh_navigation_rest_api_url', 'option');
        if (!empty($mjh_navigation_rest_api_url)) {
            $response = wp_remote_get($mjh_navigation_rest_api_url);
            if (is_array($response) && !is_wp_error($response)) {
                $response_body = json_decode($response['body'], true);
                if (!empty($response_body)) {
                    $navigations = $response_body;
                }
            }
        }
        return $navigations;
    }
}
