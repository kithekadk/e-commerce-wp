<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Base;

class SettingsLinks extends BaseController{

    // public $pluginfilename;
    function register(){
        // add_filter("plugin_action_links_$this->pluginfilename", [$this, 'settings_link']);
        add_filter("plugin_action_links_".$this->plugin_basename, [$this, 'settings_link']);
    }

    public function settings_link($links){
        $registerbooklink = '<a href="admin.php?page=register_book">Register Book </a>';

        array_push($links, $registerbooklink);

        return $links;
    }
}