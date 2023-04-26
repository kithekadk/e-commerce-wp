<?php

function c13theme_script_enqueue(){
    wp_enqueue_style('customstyle', get_template_directory_uri().'/custom/custom.css', [], '1.0.0', 'all');
    wp_enqueue_script('customjs', get_template_directory_uri(). '/custom/custom.js',[], '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'c13theme_script_enqueue');

// ADDING MENUS - HEADER AND FOOTER

function c13theme_setup(){
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary Header');
    register_nav_menu('secondary', 'Footer Navigation');
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