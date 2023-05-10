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


// Checking if composer exists
if(file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once(dirname(__FILE__).'/vendor/autoload.php');
}

// GLOBAL VARIABLES STORING THE PATHS
define ('PLUGIN_PATH', plugin_dir_path(__FILE__));
define ('PLUGIN_URL', plugin_dir_url(__FILE__));
define ('PLUGIN_BASENAME', plugin_basename(__FILE__));

use Inc\Base;
function activate_c13plugin(){
    Base\Activate::activate();
}

function deactivate_c13plugin(){
    Base\Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate_c13plugin');

register_deactivation_hook(__FILE__, 'deactivate_c13plugin');

if(class_exists('Inc\\Init')){
    Inc\Init::register_services(); //considers all classes as services
}