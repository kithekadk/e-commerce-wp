<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Base;

class Enqueue{
    public function register(){
        add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
    }

    function enqueueScripts(){
        wp_enqueue_style('cohort13pluginstyles', PLUGIN_URL.'assets/mystyle.css');
        wp_enqueue_script('cohort13pluginscript', PLUGIN_URL.'assets/myscript.js');

        // BOOTSTRAP
        wp_register_style('bootstrapstyle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], '5.2.3', 'all');
        wp_enqueue_style('bootstrapstyle');
        wp_register_script('bootstrapjs','https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], '5.2.3', true );
        wp_enqueue_script('bootstrapjs');
    }
}