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

    public function __construct(){
        $this->settings = new SettingsApi();
        
    $this->pages= [
        [
            'page_title'=> 'Book Registration',
            'menu_title'=> 'Register Book',
            'capability' => 'manage_options',
            'menu_slug'=> 'register_book',
            'callback'=> function(){
                echo '<h1> Cohort 13 Admin Page </h1>';
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
    }

    function register(){
        // add_action('admin_menu', [$this, 'add_admin_page']);
        $this->settings->AddPages( $this->pages )->register();
    }


    // function add_admin_page(){
    //     add_menu_page('Book Registration', 'Register Book', 'manage_options', 'register_book', [$this, 'admin_index_cb'], 'dashicons-welcome-write-blog', 110);
    // }

    // function admin_index_cb(){
    //     require_once $this->plugin_path.'templates/bookregister.php';  
    // }
}