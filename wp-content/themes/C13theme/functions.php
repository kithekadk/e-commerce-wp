<?php

function c13theme_script_enqueue(){
    wp_enqueue_style('customstyle', get_template_directory_uri().'/custom/custom.css', [], '3.1.1', 'all');
    wp_enqueue_script('customjs', get_template_directory_uri(). '/custom/custom.js',[], '1.0.0', true);

    // Using bootstrap
    wp_register_style('bootstrapcss', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], '5.2.3', 'all');

    wp_enqueue_style('bootstrapcss');

    wp_register_script('jsbootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], '5.2.3', false);
    wp_enqueue_script ('jsbootstrap');
}

add_action('wp_enqueue_scripts', 'c13theme_script_enqueue');

// ADDING MENUS - HEADER AND FOOTER

function c13theme_setup(){
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary Header');
    register_nav_menu('secondary', 'Footer Navigation');
}
// ADDING NAVWALKER CLASS
if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('init','c13theme_setup');


/**
 * THEME SUPPORT
 */

 add_theme_support('custom-background');
 add_theme_support('custom-header');
 add_theme_support('post-thumbnails');

 add_theme_support('post-formats',['aside', 'image', 'video']);

function c13theme_sidebar_Setup(){
    register_sidebar([
        'name'=> 'Sidebar',
        'id'=>'sidebar-1',
        'class'=>'custom',
        'description'=> 'Standard Sidebar',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => "</aside>\n",
		'before_title'   => '<h2 class="widgettitle">',
		'after_title'    => "</h2>\n",
        'show_in_rest'   => false
    ]);
}

add_action('widgets_init', 'c13theme_sidebar_Setup');

// Converting HTML TO HTML5 FOR  SEARCH FORM
add_theme_support('html5', ['search-form']);

// CUSTOM POST TYPE

function portfolio_post_type(){
    $labels = [
        'name'=> 'Portfolios',
        'singular_name'=> 'Portfolio',
        'add_new'=> 'Add Portfolio Item',
        'all_items'=> 'All Portfolios',
        'add_new_item'=> 'Edit Item',
        'new_item'=> 'New Items',
        'view_item'=> 'View Item',
        'search_item'=> 'Search Portfolio',
        'not_found'=> 'No Items found',
        'not_found_in_trash'=> 'No Items found in trash',
        'parent_item_colon'=> 'Parent Item'
    ];

    $args = [
        'labels'=> $labels,
        'public'=> true,
        'has_archive'=> true,
        'publicly_queryable'=> true,
        'query_var'=> true,
        'rewrite'=>true,
        'capability'=> 'post',
        'hierarchical' => false,
        'supports'=>[
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ],
        'taxonomies'=>[
            'category',
            'post_tag',
            'menu_position'=> 5,
            'exclude_from_search'=> false
        ]
    ];

    register_post_type('portfolio', $args);
}

add_action('init', 'portfolio_post_type');

// CUSTOM TAXONOMY
function career_custom_taxonomy(){
    $labels = [
        'name'=> 'Careers',
        'singular_name'=> 'Career',
        'search_items'=> 'Search Careers',
        'all_items'=>'All Careers',
        'parent_item'=> 'Parent Career',
        'parent_item_colon'=> 'Parent Career',
        'edit_item'=> 'Edit Career',
        'update_item'=> 'Update Career',
        'add_new_item'=> 'Add New Career',
        'new_item_name'=> 'New Career Name',
        'menu_name'=>'Careers'
    ];

    $args = [
        'labels'=> $labels,
        'hierarchical'=>true,
        'show_ui'=>true,
        'show_admin_column'=>true,
        'query_var'=>true,
        'rewrite'=>[
            'slug'=>'career'
        ]
        ];

    register_taxonomy('career', ['portfolio'], $args);

    // NON-HIERARCHICAL TAXONOMY
    register_taxonomy('software', ['portfolio'], [
        'hierarchical'=> false,
        'label'=> 'Software',
        'show_ui'=>true,
        'show_admin_column'=>true,
        'query_var'=>true,
        'rewrite'=>[
            'slug'=> 'software'
        ]
    ]);
}

add_action('init', 'career_custom_taxonomy');

// CUSTOM TERM FUNCTION

function customterm_get_terms($postID, $term){
    $termslist = wp_get_post_terms($postID, $term);

    $i = 0;

    $output = '';

    foreach ($termslist as $term){
        $i++;

        if ($i > 1){
            $output .= ', ';
        }

        // $output .= $term->name;
        // $output .= get_term_link($term);
        $output .= '<a href="'.get_term_link($term).'" >' .$term->name. '</a>';

    }

    return $output;
}

// GLOBAL VARIABLE
global $successmessage;
$successmessage;

global $errormessage;

// ADDING SHORTCODE

add_shortcode('c13code', function($atts){
    $attributes = shortcode_atts([
        'members'=>'Joel, Joy, Hope, Kimani',
        'no_of_trainees'=> 4
    ],$atts, 'c13code');

    return 'Members = '.$attributes['members']. ' No of trainees = '.$attributes['no_of_trainees'];
});

// NEW LOGIN URL
// function new_login_url($login_url){
//     $login_url = site_url(
//         'nicholas.php', 'login'
//     );

//     return $login_url;
// }

// add_filter('login_url', 'new_login_url');


// LIMITING LOGIN ATTEMPTS

function check_attempted_login($user, $username, $password){
    if(get_transient('attempted_login')){
        $datas = get_transient('attempted_login');

        if ($datas['tried'] >= 3){
            $until = get_option('_transient_timeout_' . 'attempted_login');
            $time = time_to_go($until);

            return new WP_Error('too_many_tried', sprintf(__('<strong>ERROR</strong>: You have reached authentication limit, please try after %1$s'), $time));
        }
    }

    return $user;
}

add_filter('authenticate', 'check_attempted_login', 30, 3);

function login_failed($username){
    if (get_transient('attempted_login')){
        $datas = get_transient('attempted_login');
        $datas['tried']++;

        if ($datas['tried'] <= 3)
            set_transient('attempted_login', $datas, 300);
        }else{
            $datas = array(
                'tried' => 1
            );
            set_transient ('attempted_login', $datas, 300);
        }
          
    
}

add_action('wp_login_failed', 'login_failed', 10, 1);

function time_to_go($timestamp){
    //converting mysql timestamp to php time
    $periods = array(
        "second",
        "minute",
        "hour",
        "day",
        "week",
        "month",
        "year"
    );

    $lengths = array(
        "60",
        "60",
        "24",
        "7",
        "4.35",
        "12"
    );

    $current_timestamp = time();
    $difference = abs($current_timestamp - $timestamp);

    for ($i = 0; $difference >= $lengths[$i] && $i < count($lengths)-1; $i ++ ){
        $difference /= $lengths[$i];
    }

    //adding the countdown if the remaining is less than a minute
    $difference = round($difference);

    if(isset($difference)){
        if($difference != 1){
            $periods[$i] .= "s";
            $output = "$difference $periods[$i]";
            return $output;
        }
    }
}

/**
 * WORDPRESS REST API
 * 
 * 
 * Creating custom field REST API
 */

 function custom_field_rest_api(){
    register_rest_field('post', 'custom_field1', ['get_callback'=>'get_custom_field']);
 }

 function get_custom_field($obj){
    $post_id = $obj['id'];

    echo '<pre>'; print_r($post_id); '</pre>';

    return get_post_meta($post_id, 'customField1', true);
 }

 add_action('rest_api_init', 'custom_field_rest_api');