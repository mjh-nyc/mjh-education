<?php

namespace App\Controllers;

use Sober\Controller\Controller;

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
	 * @return array
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
			$image = get_the_post_thumbnail_url($id, $size);
		} elseif (get_field('testimony_platform',$id)) {
			//this is a testimony, use the video screenshot as featured image
			$image = App::featuredTestimonailImageSrc('large',$id);
		}
		if (!$image) {
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
			$post_thumbnail_id = get_post_thumbnail_id($id);
			$image_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true);
		}
		return $image_alt;
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
		if (!$id){
			$id = get_the_ID();
		}
		return wp_get_post_categories($id);
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
	 * Return the post excerpt, if no ID provided, will use current post id
	 *
	 * @return string
	 */
	public static function postExcerpt($id=false)
	{
		if (!$id){
			$id = get_the_ID();
		}
		$excerpt = get_the_excerpt($id);
		if ($excerpt) {
			$excerpt = App::truncateString($excerpt, 16);
		}
		//also if the title is too long, hide the description
		if (strlen(get_the_title($id)) >30 && get_post_type($id)!='testimony') {
			return false;
		} else {
			return $excerpt;
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
}
