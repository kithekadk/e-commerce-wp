<?php
/**
 * @package Cohort13Plugin
 */

/*
    Plugin Name: Cohort13 Plugin
    Plugin URI: http://.........
    Description: This is a plugin built by the jitu cohort 13 Wordpress
    Version: 1.0.0
    Author: Cohort13
    Author URI: http://cohort13...............
    Licence: GPLv2 or later
    Text Domain: cohort13-plugin
*/

// security check
defined('ABSPATH') or die('Security breaches identified');

class RegisterMembers{
    function __construct(){
        $this->plugin = plugin_basename(__FILE__);

        add_action('init', [$this, 'members_post_type']);

    }

    public function activate(){
        require_once plugin_dir_path(__FILE__). 'inc/cohort13-activate.php';
        Cohort13Activate::activate();
    }
    public function deactivate(){
        require_once plugin_dir_path(__FILE__). 'inc/cohort13-deactivate.php';
        Cohort13Deactivate::deactivate();
    }

    function members_post_type(){
        $labels = [
            'name'=> 'Members',
            'singular_name'=> 'Members',
            'add_new'=> 'Add Members Item',
            'all_items'=> 'All Memberss',
            'add_new_item'=> 'Edit Item',
            'new_item'=> 'New Items',
            'view_item'=> 'View Item',
            'search_item'=> 'Search Members',
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
                'menu_position'=> 6,
                'exclude_from_search'=> false
            ]
        ];
    
        register_post_type('members', $args);
    }

    public $plugin;
    function registerPage(){
        add_action('admin_menu', [$this, 'add_admin_page']);

        // SETTINGS LINK
        add_filter("plugin_action_links_$this->plugin", [$this, 'settings_link']);
    }

    // Settings LINK
    function settings_link($links){
        $settingslink = '<a href="admin.php?page=register_book">Register Book</a>';

        array_push($links, $settingslink);
        return $links;
    }

    function add_admin_page(){
        add_menu_page('Book Registration', 'Register Book', 'manage_options', 'register_book', [$this, 'admin_index_cb'], 'dashicons-welcome-write-blog', 110);
    }

    function admin_index_cb(){
        require_once plugin_dir_path(__FILE__).'templates/bookregister.php';
    }    

}

if (class_exists('RegisterMembers')){
    $RegisterMembersInstance = new RegisterMembers();
}

// register_activation_hook(__FILE__, [$RegisterMembersInstance, 'activate']);
// register_deactivation_hook(__FILE__, [$RegisterMembersInstance, 'deactivate']);

$RegisterMembersInstance->activate();
$RegisterMembersInstance->deactivate();
$RegisterMembersInstance->registerPage();