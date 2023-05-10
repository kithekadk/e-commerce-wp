<?php

/**
 * @package Cohort13Plugin
 */

namespace Inc\Pages;

class AdminPage{
    function __construct(){

    }

    function register(){
        add_action('admin_menu', [$this, 'add_admin_page']);
    }

    function add_admin_page(){
        add_menu_page('Book Registration', 'Register Book', 'manage_options', 'register_book', [$this, 'admin_index_cb'], 'dashicons-welcome-write-blog', 110);
    }

    function admin_index_cb(){
        require_once PLUGIN_PATH.'templates/bookregister.php';

        
    }
}