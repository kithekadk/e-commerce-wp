<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Api\CallBacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController{

    public function viewMembers(){
        return require_once $this->plugin_path.'templates/viewMembers.php'; 
    }

    public function registerMembers(){
        return require_once $this->plugin_path.'templates/registerMembers.php';
    }

    public function updateMembers(){
        return require_once $this->plugin_path.'templates/updateMembers.php';
    }

}