<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Base;

class SettingsLinks{
    
    function __construct(){
        // $this->pluginfilename = PLUGIN_BASENAME;
    }

    // public $pluginfilename;
    function register(){
        // add_filter("plugin_action_links_$this->pluginfilename", [$this, 'settings_link']);
        add_filter("plugin_action_links_".PLUGIN_BASENAME, [$this, 'settings_link']);
    }

    public function settings_link($links){
        $registerbooklink = '<a href="admin.php?page=register_book">Register Book </a>';

        array_push($links, $registerbooklink);

        return $links;
    }
}