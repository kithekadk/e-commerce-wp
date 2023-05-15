<?php

/**
 * @package Cohort13Plugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

use \Inc\Api\CallBacks\AdminCallbacks;

class AdminPageWithCallbacks extends BaseController{

    public $settings;

    public $callbacks;

    public $pages;
    public $subpages;

    function register(){
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();


        $this->createAdminMenus();

        $this->createSubMenus();

        $this->settings->AddPages( $this->pages )->HasSubPage('View Members')->addSubPages($this->subpages)->register();
    }

    public function createAdminMenus(){
        $this->pages= [
            [
                'page_title'=> 'Members Menu',
                'menu_title'=> 'Members Menu',
                'capability' => 'manage_options',
                'menu_slug'=> 'members_menu',
                'callback'=> [$this->callbacks, 'viewMembers'],
                'icon_url'=> 'dashicons-welcome-write-blog',
                'position'=> 110
            ]
        ];
    }

    public function createSubMenus(){
        $this->subpages =[
            [
                'parent_slug'=> 'members_menu',
                'page_title' => 'Register members',
                'menu_title' => 'Register members',
                'capability' => 'manage_options',
                'menu_slug' => 'register_members',
                'callback' => [$this->callbacks, 'registerMembers']
            ],
            [
                'parent_slug'=> 'members_menu',
                'page_title' => 'Update Members',
                'menu_title' => 'Update Members',
                'capability' => 'manage_options',
                'menu_slug' => 'update_members',
                'callback' => [$this->callbacks, 'updateMembers']
            ]
        ];
    }

}