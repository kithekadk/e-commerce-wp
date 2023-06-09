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

    register_rest_route(    
        'portfolios/v1', 
        'c13-portfolios', 
        [
        'callback'=>'get_c13_portfolios',
        'method'=>'GET',
        'permission_callback'=>'custom_endpoint_permission',
        'args'=>[
            'meta_key'=>[
                'required'=>true,
                'default'=> '_edit_last',
                'validate_callback'=>function($param, $request, $key){
                    return !is_numeric($param);
                }
            ],
            'meta_value'=>[
                'required'=>true,
                'default'=>1,
                'validate_callback'=>function($param, $request, $key){
                    return is_numeric($param);
                }
            ]
            ],
        'schema'=> 'myportfolio_schema'
        ]);
 }

 function register_book_routes(){
    register_rest_route(
        'booksapi/v1',
        '/create',
        [
            'callback'=>'register_book',
            'methods'=>'POST',
            'permission_callback'=>'register_book_permission'
        ]
    );
}

 function register_book($request){
    $title = sanitize_text_field($request->get_param('title'));
    $author = sanitize_text_field($request->get_param('author'));
    $publisher = sanitize_text_field($request->get_param('publisher'));

    global $wpdb;
    $table_name = $wpdb->prefix . 'books';
    $id = wp_generate_uuid4();

    $result = $wpdb->insert(
        $table_name,
        [
            'bookid'=> $id,
            'title' => $title,
            'author' => $author,
            'publisher'=> $publisher
        ]
    );

    if($result){
    $response = array(
        'message'=> 'Book Created successfully',
        'bookid'=> $id,
        'title' => $title,
        'author' => $author,
        'publisher'=> $publisher
    );
    return new WP_REST_Response($response, 201);
    }else{
        $response = [
            'message'=> 'Book not created'
        ];
        return new WP_REST_Response($response, 404);
    }

    
 }


 function register_book_permission(){
    if (current_user_can('administrator')) {
        return true;
    } else {
        return false;
    }
}
 function myportfolio_schema(){
    $schema = [
        'schema'=>'',
        'title'=> 'all-portfolios',
        'type'=> 'object',
        'properties'=>[
            'id'=>[
                'description'=>esc_html__('Unique identifier of the the object', 'my-textdomain'),
                'type'=>'integer'
            ],
            'author'=>[
                'description'=>esc_html__('The creator of the object', 'my-textdomain'),
                'type'=> 'integer'
            ],
            'title'=>[
                'desctiption'=>esc_html__('This is the title of the portfolio', 'my-textdomain'),
                'type'=>'string'
            ],  
            'content'=>[
                'description'=>esc_html__('The content of the portfolios', 'my-textdomain'),
                'type'=>'string'
            ]
        ]
    ];

    return $schema;
 }

 function get_custom_field($obj){
    $post_id = $obj['id'];

    echo '<pre>'; print_r($post_id); '</pre>';

    return get_post_meta($post_id, 'customField1', true);
 }


 function get_c13_portfolios(WP_REST_Request $request){
    // echo '<pre>'; print_r($request); '</pre>';

    $meta_key = $request->get_param('meta_key');
    $meta_value = $request->get_param('meta_value');

    $args = [
        'post_type'=> 'portfolio',
        'status'=>'publish',
        'posts_per_query'=>10,
        'meta_query'=>[[
            'key'=> $meta_key,
            'value'=>$meta_value
        ]]
    ];

    $the_query = new WP_Query($args);

    $portfolios = $the_query->posts;

    if(empty($portfolios)){
        return new WP_Error(
            'no_data_found',
            'No Data Found',
            [
                'status'=> 404
            ]
        );
    }

    foreach($portfolios as $portfolio){
        $response = custom_rest_prepare_post($portfolio, $request);
        $data[] = custom_prepare_for_collection($response);
    }

    return rest_ensure_response($data);
 }

function custom_rest_prepare_post($post, $request){
    $post_data = [];
    $schema = myportfolio_schema();

    if(isset($schema['properties']['id'])){
        $post_data['id'] = (int) $post->ID;
    }
    if(isset($schema['properties']['author'])){
        $post_data['author'] = (int) $post->post_author;
    }
    if(isset($schema['properties']['content'])){
        $post_data['content'] = apply_filters('post_text', $post->post_content, $post);
    }
    if(isset($schema['properties']['title'])){
        $post_data['title'] = apply_filters('post_title', $post->post_title, $post);
    }

    return rest_ensure_response($post_data);
}

function custom_prepare_for_collection($response){
    if(!($response instanceof WP_REST_Response)){
        return $response;
    }

    $data = (array) $response->get_data();
    $links = rest_get_server()::get_compact_response_links($response);

    if(!empty($links)){
        $data['_links'] = $links;
    }

    return $data;
}
function custom_endpoint_permission(){
    if (is_user_logged_in()){
        return true;
    }else{
        return false;
    }
}

add_action('rest_api_init', 'custom_field_rest_api');
add_action('rest_api_init', 'register_book_routes');

function encrypting_user_pwds(){
    
        global $wpdb;

        $table_name = $wpdb->prefix.'users_new';

        $new_user_tbl = "CREATE TABLE IF NOT EXISTS ".$table_name."(
            username text NOT NULL,
            useremail text NOT NULL,
            phone int NOT NULL,
            password text NOT NULL
        );";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');

        dbDelta($new_user_tbl);

    if (isset($_POST['btnSubmitUser'])){

        $pwd = $_POST['password'];
        $hashed_pwd = wp_hash_password($pwd);

        $user_data = [
            'username'=>$_POST['username'],
            'useremail'=>$_POST['useremail'],
            'phone'=> $_POST['phoneno'],
            'password'=>$hashed_pwd
        ];

        // var_dump($user_data);

        $result = $wpdb->insert($table_name, $user_data);

        if ($result){
            echo "<script>alert('User created successfully');</script>";
        }else{
            echo "<script>alert('User Not created');</script>";
        }

    }
}

add_action('init', 'encrypting_user_pwds');

// function compare_password(){
//     global $wpdb;
//     $table_name = $wpdb->prefix.'users_new';

//     $result = $wpdb->get_results("SELECT * FROM $table_name WHERE username = 'Mwaniki'");

//     var_dump($result[0]->password);
//     $hashed_pwd = $result[0]->password;

//     if( wp_check_password('12345', $hashed_pwd)){
//         var_dump('PASSWORD MATCH');
//     }else{
//         var_dump('Password dont match');
//     }
// }

// add_action('init', 'compare_password');


function gettingToken(){

}