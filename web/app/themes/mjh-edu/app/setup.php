<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;


/**
 * Add logo support to theme
 */
function theme_prefix_setup() {

    add_theme_support( 'custom-logo', array(
        'height'      => 85,
        'width'       => 624,
        'flex-width' => true,
        'flex-height' => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
    /* Disable Admin Bar for All Users Except for Administrators */ 
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }


}
add_action( 'after_setup_theme', 'App\\theme_prefix_setup' );


/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    add_image_size( 'square@2x', 800, 800, true);
    add_image_size( 'square@1x', 400, 400, true);
    add_image_size( 'header', 1600, 550, true);
    add_image_size( 'homepage-header', 1600, 750);

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    /*register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);*/
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

//Add support for excerpt in pages
add_post_type_support( 'page', 'excerpt' );

/*Security measures*/
if(function_exists('remove_action')) {
    remove_action('wp_head', 'wp_generator');
}

// Redefine password from name and email, globally
add_filter( 'wp_mail_from', 'App\\wpse_new_mail_from' );
function wpse_new_mail_from( $old ) {
    return get_option('admin_email');
}

add_filter('wp_mail_from_name', 'App\\wpse_new_mail_from_name');
function wpse_new_mail_from_name( $old ) {
    return get_option('blogname');
}
//end

//Unset the tag body class as it conflicts with bootstrap css
function bs4_remove_tag_body_class( $classes ) {
    if ( false !== ( $class = array_search( 'tag', $classes ) ) ) {
        unset( $classes[$class] );
    }
    return $classes;
}
add_filter( 'body_class', 'App\\bs4_remove_tag_body_class' );


//Remove emoji scripts introduced by WP 4.2
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'App\\disable_emojicons_tinymce' );

}
add_action( 'init', 'App\\disable_wp_emojicons' );


add_filter( 'image_size_names_choose', 'App\\my_custom_sizes' );

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'square@2x' => __( 'Large square' ),
        'square@1x' => __( 'Medium square' ),
        'header' => __( 'Header hero' ),
    ) );
}


function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl','App\\my_login_logo_url' );

function my_login_logo_url_title() {
    return get_option('blogname');
}
add_filter( 'login_headertitle','App\\my_login_logo_url_title' );

//change the default WP login screen logo
function my_login_logo() {

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    ?>
    <style type="text/css">
        .login {
            background-color: #ccc;
        }
        #login {
            width:50%  !important;
        }
        .login h1 a {
            background-image: url('<?php echo $logo[0]; ?>') !important;
            background-size:100% auto !important;
            width:340px !important;
            height:auto
        }
        @media (max-width: 768px) {
          #login { width:95% !important; }
          .login h1 a {
            width:240px !important;
          }
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts','App\\my_login_logo', 1 );




/********************************************
/* Adding open graph sharing meta tags *****/
function hook_meta() {
    global $post;
    //default image, if there's none featured
    //image added via the options page under Settings --> Theme options
    $featured_img_url = get_field('social', 'option');
    $site_description = get_field('site_description', 'option');

    //Facebook
    $output='<meta property="og:type" content="website">';
    $output.='<meta property="og:site_name" content="'.get_bloginfo("name").'">';

    //Twitter
    $twitter_handle = get_field('twitter_handle', 'option');
    $output.='<meta name="twitter:card" content="summary_large_image">';
    $output.='<meta name="twitter:site" content="@'.$twitter_handle.'">';
    $output.='<meta name="twitter:creator" content="@'.$twitter_handle.'">';


    //if single post, use the content of the post
    if (is_single() || is_page()) {
        //check if featured image is set
        $featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );
        if( $featured ) {
            $featured_img_url = $featured[0];
        }
        //See if excerpt is set for this page or post
        $desc = get_the_excerpt($post->ID);
        if ($desc) {
            $desc = str_replace('"','&quot;',$desc);
        } else {
            //if not set, use generic one
            $desc = $site_description;
        }

        //Facebook
        $output.='<meta property="og:url" content="'.get_the_permalink($post->ID).'">';
        $output.='<meta property="og:title" content="'.str_replace('"','&quot;',get_the_title($post->ID)).' | '.get_bloginfo("name").'">';
        $output.='<meta name="description" property="og:description" content="'.$desc.'">';

        //Twitter
        $output.='<meta name="twitter:title" content="'.get_the_title($post->ID).' | '.get_bloginfo("name").'">';
        $output.='<meta name="twitter:description" content="'.$desc.'">';

    } else {
        //otherwise show general blog description and image
        //Facebook
        $output.='<meta property="og:title" content="'.get_bloginfo("name").'">';
        $output.='<meta property="og:url" content="'.get_bloginfo("url").'">';
        $output.='<meta property="description" content="'.$site_description.'">';
        $output.='<meta name="description" property="og:description" content="'.$site_description.'">';

        //Twitter
        $output.='<meta name="twitter:title" content="'.get_bloginfo("name").'">';
        $output.='<meta name="twitter:description" content="'.$site_description.'">';
    }
    //Facebook image
    $output.='<meta property="og:image" content="'.$featured_img_url.'">';

    //Twitter
    $output.='<meta name="twitter:image" content="'.$featured_img_url.'">';


    echo $output;
}
add_action('wp_head', __NAMESPACE__ . '\\hook_meta');
/* END meta tags ****************************/

