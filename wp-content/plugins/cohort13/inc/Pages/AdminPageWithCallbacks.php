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

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->AddPages( $this->pages )->HasSubPage('View All')->addSubPages($this->subpages)->register();
    }

    public function createAdminMenus(){
        $this->pages= [
            [
                'page_title'=> 'Trainees',
                'menu_title'=> 'Trainees',
                'capability' => 'manage_options',
                'menu_slug'=> 'trainees',
                'callback'=> [$this->callbacks, 'viewTraineesCB'],
                'icon_url'=> 'dashicons-buddicons-buddypress-logo',
                'position'=> 105
            ],
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
                'parent_slug'=> 'trainees',
                'page_title' => 'Register Trainee',
                'menu_title' => 'Register Trainee',
                'capability' => 'manage_options',
                'menu_slug' => 'register_trainee',
                'callback' => [$this->callbacks, 'registerTraineeCB']
            ],
            [
                'parent_slug'=> 'trainees',
                'page_title' => 'Update Trainee',
                'menu_title' => 'Update Trainee',
                'capability' => 'manage_options',
                'menu_slug' => 'update_trainee',
                'callback' => [$this->callbacks, 'updateTraineeCB']
            ],
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

    public function setSettings(){
        $params = [
            [
                'option_group'=> 'cohort13_options_group',
                'option_name'=> 'first_name',
                'callback'=>[$this->callbacks, 'c13OptionsGroup']
            ],
            [
                'option_group'=> 'cohort13_options_group',
                'option_name'=> 'second_name',
            ],
            [
                'option_group'=> 'cohort13_options_group',
                'option_name'=> 'cohort_name',
            ]
        ];

        $this->settings->setSettings($params);
    }

    public function setSections(){
        $params = [
            [
                'id'=> 'c13_admin_index',
                'title'=> 'Cohort 13 Settings section',
                'callback' => [$this->callbacks, 'c13AdminIndex'],
                'page' => 'members_menu' //get this from menu slu of the first menu
            ]
        ];

        $this->settings->setSections($params);
    }

    public function setFields(){
        $params = [
            [
                'id'=> 'first_name', //identical to value of option_name
                'title'=> 'First Name',
                'callback'=> [$this->callbacks, 'c13InputText'],
                'page'=> 'members_menu',
                'section'=> 'c13_admin_index',
                'args'=>[
                    'label_for' => 'first_name',
                    'class'=> 'example-class'
                ]
            ],
            [
                'id'=> 'second_name', //identical to value of option_name
                'title'=> 'Second Name',
                'callback'=> [$this->callbacks, 'c13SecondName'],
                'page'=> 'members_menu',
                'section'=> 'c13_admin_index',
                'args'=>[
                    'label_for' => 'second_name',
                    'class'=> 'example-class'
                ]
            ],
            [
                'id'=> 'cohort_name', //identical to value of option_name
                'title'=> 'Cohort Name',
                'callback'=> [$this->callbacks, 'c13CohortName'],
                'page'=> 'members_menu',
                'section'=> 'c13_admin_index',
                'args'=>[
                    'label_for' => 'cohort_name',
                    'class'=> 'example-class'
                ]
            ],

        ];

        $this->settings->setFields($params);
    }

}