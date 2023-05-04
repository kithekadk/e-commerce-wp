<?php 
/**
 * @package CustomPlugin
 */

/*
    Plugin Name: Basic Custom Plugin
    Plugin URI: http://............
    Description: This is the first plugin
    Version: 1.0.0
    Author: Cohort 13
    Author URI: http://cohort13/..........
    Licence: GPLv2 or later
    Text Domain: custom-plugin
*/

// SECURING THE PLUGIN

//method 1
if (!defined('ABSPATH')){
    die;
}

// method 2
defined('ABSPATH') or die('Hey you hacker, got you');

//method 3
if(!function_exists('add_action')){
    echo 'Got you!';
    exit;
}

class CustomPlugin{
    function __construct(){
        // echo 'Action Triggered';
        add_action('init', array($this, 'book_post_type'));
    }

    function activate(){
        // echo 'Plugin Activated';

        flush_rewrite_rules();
    }

    function deactivate(){
        echo 'Plugin Deactivated';
        flush_rewrite_rules();
    }

    function book_post_type(){
        register_post_type('book', [
            'public'=>true,
            'label'=> 'Books'
        ]);
    }

    static function uninstall(){

    }
}

if (class_exists('CustomPlugin')){
    $customPluginInstance = new CustomPlugin();
}

// activation
register_activation_hook(__FILE__, array($customPluginInstance, 'activate'));

//deactivation
register_deactivation_hook(__FILE__, array($customPluginInstance, 'deactivate'));