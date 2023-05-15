<?php

/**
 * @package Cohort13Plugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class AdminPage extends BaseController{

    public $settings;

    public $pages;
    public $subpages;

    public function __construct(){
        $this->settings = new SettingsApi();
        
    $this->pages= [
        [
            'page_title'=> 'Books Menu',
            'menu_title'=> 'Book Menu',
            'capability' => 'manage_options',
            'menu_slug'=> 'books_menu',
            'callback'=> function(){
                echo '<h1> Cohort 13 Books Menu </h1>';
            },
            'icon_url'=> 'dashicons-welcome-write-blog',
            'position'=> 110
        ],
        [
            'page_title'=> 'Contact US',
            'menu_title'=> 'Contact US',
            'capability' => 'manage_options',
            'menu_slug'=> 'contact_us',
            'callback'=> function(){
                echo '<h1> Contact US Page </h1>';
            },
            'icon_url'=> 'dashicons-buddicons-buddypress-logo',
            'position'=> 111
        ]
    ];

    $this->subpages =[
        [
            'parent_slug'=> 'books_menu',
            'page_title' => 'Register books',
            'menu_title' => 'Register Books',
            'capability' => 'manage_options',
            'menu_slug' => 'register_books',
            'callback' => function() {
                echo '<h1> Register Books </h1>';
            }
        ],
        [
            'parent_slug'=> 'books_menu',
            'page_title' => 'Update BOOK',
            'menu_title' => 'Update BOOK',
            'capability' => 'manage_options',
            'menu_slug' => 'update_books',
            'callback' => function() {
                echo '<h1> Update Book </h1>';
            }
        ],
        [
            'parent_slug'=> 'books_menu',
            'page_title' => 'View Authors',
            'menu_title' => 'View Authors',
            'capability' => 'manage_options',
            'menu_slug' => 'view_authors',
            'callback' => function() {
                echo '<h1> View Authors of the different Books </h1>';
            }
        ],
        [
            'parent_slug'=> 'contact_us',
            'page_title' => 'Facebook ',
            'menu_title' => 'Facebook',
            'capability' => 'manage_options',
            'menu_slug' => 'social_facebook',
            'callback' => function() {
                echo '<h1> View our Facebook page </h1>';
            }
        ],
        [
            'parent_slug'=> 'contact_us',
            'page_title' => 'Instagram',
            'menu_title' => 'Instagram',
            'capability' => 'manage_options',
            'menu_slug' => 'social_instagram',
            'callback' => function() {
                echo '<h1> View our Instagram page </h1>';
            }
        ],
        [
            'parent_slug'=> 'contact_us',
            'page_title' => 'Twitter',
            'menu_title' => 'Twitter',
            'capability' => 'manage_options',
            'menu_slug' => 'social_twitter',
            'callback' => function() {
                echo '<h1> View our Twitter page </h1>';
            }
        ]
    ];
    }

    function register(){
        // add_action('admin_menu', [$this, 'add_admin_page']);
        $this->settings->AddPages( $this->pages )->HasSubPage('View Books')->addSubPages($this->subpages)->register();
    }


    // function add_admin_page(){
    //     add_menu_page('Book Registration', 'Register Book', 'manage_options', 'register_book', [$this, 'admin_index_cb'], 'dashicons-welcome-write-blog', 110);
    // }

    // function admin_index_cb(){
    //     require_once $this->plugin_path.'templates/bookregister.php';  
    // }
}