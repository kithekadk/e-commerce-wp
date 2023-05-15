<?php
/**
 * @package Cohort13Plugin
 */

// Inject autoload/composer
namespace Inc\Base;

class BaseController{
    public $plugin_path;

    public $plugin_url;

    public $plugin_basename;
    public $successmessage;

    public $errormessage;

    function __construct(){
        $this->plugin_path = plugin_dir_path(dirname(__FILE__,2));

        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));

        $this->plugin_basename = plugin_basename(dirname(__FILE__, 3)).'/cohort13.php';

        $this->successmessage;

        $this->errormessage;
    }
}
